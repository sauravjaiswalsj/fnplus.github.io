<?php

header('Content-Type: application/json');

$file = 'cookies.txt';
file_put_contents($file, '');

if (isset($_REQUEST['regno']) && isset($_REQUEST['pass']))
{
	require_once ('curl.php');

	require_once ('simple_html_dom.php');

	$cc = new cURL();
	if ($data = $cc->get('evarsity.srmuniv.ac.in/srmswi/usermanager/youLogin.jsp?txtSN=' . $_REQUEST["regno"] . '&txtPD=' . $_REQUEST["pass"] . '&txtPA=1'))
		{
			$html = str_get_html($data);
			if ($test = $html->find('div[class=paneltitle01]'))
			{
				if ($data = $cc->get('evarsity.srmuniv.ac.in/srmswi/resource/StudentDetailsResources.jsp?resourceid=16'))
					{
						$html = str_get_html($data);
						$table = $html->find('table');
						$tr = $table[0]->find('tr');

						$preJson = array();
						$currentTest = array();
						$subjects  = array();

						for ($i=2; $i < sizeof($tr); $i++) { 
							if(sizeof($tr[$i]->find('td')) == 1){
								if(sizeof($subjects) != 0){
									$currentTest["subjects"] = $subjects;
									array_push($preJson, $currentTest);
									$subjects = [];  ////////// *
								}
								$currentTest = array();
								$currentTest["name"] = rtrim(ltrim($tr[$i]->find('td')[0]->plaintext));
								$subjects  = [];
							}
							else if(sizeof($tr[$i]->find('td')) == 3){
								$item = array();
								$item["CODE"] = rtrim(ltrim($tr[$i]->find('td')[0]->plaintext));
								$item["NAME"] = rtrim(ltrim($tr[$i]->find('td')[1]->plaintext));
								$item["MARKS"] = rtrim(ltrim($tr[$i]->find('td')[2]->plaintext));
								array_push($subjects, $item);
							}
						}
						
						////////////// REMIND ARJUN TO CHECK THIS LOGIC WHEN THE 2ND CT MARKS ARE UPLOADED //////////////
						if(sizeof($subjects) != 0){
							$currentTest["subjects"] = $subjects;
							array_push($preJson, $currentTest);
						}
						/////////////////////////////////////////////////////////////////////////////////////////////////

						echo json_encode(array("test-performance" => $preJson));
					}
				else
					{
						echo "{\n\"error\":true,";
						echo "\"error_msg\":\"Unable to connect to Student Detais\",";
						echo "\"code\":\"300\"}";
					}
			}
			else
				{
					echo "{\n\"error\":true,";
					echo "\"error_msg\":\"INVALID CREDENTIALS FOLKS\",";
					echo "\"code\":\"100\"}";
				}
		}
	else
		{
			echo " {\n  \"error\":\"Unable to connect to SRM HOME\", \n";
			echo "  \"code\":\"200\" \n }";
		}
}
else
	{
		echo "{\n\"error\":true,";
		echo "\"error_msg\":\"Something Went Wrong\",";
		echo "\"code\":\"500\"}";
	}

?>