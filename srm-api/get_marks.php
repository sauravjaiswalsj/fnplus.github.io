<?php
$file = 'cookies.txt';
file_put_contents($file, '');

if (isset($_REQUEST['regno']) && isset($_REQUEST['pass']))
{
	require_once ('curl.php');

	require_once ('simple_html_dom.php');
	
	header("Access-Control-Allow-Origin: *");

	$cc = new cURL();
	if ($data = $cc->get('evarsity.srmuniv.ac.in/srmswi/usermanager/youLogin.jsp?txtSN=' . $_REQUEST["regno"] . '&txtPD=' . $_REQUEST["pass"] . '&txtPA=1'))
	{
		$html = str_get_html($data);
		if ($test = $html->find('div[class=paneltitle01]') || !$html->find('div[plaintext^=Information @ your Desktop]'))
		{
			if ($data = $cc->get('evarsity.srmuniv.ac.in/srmswi/resource/StudentDetailsResources.jsp?resourceid=16'))
			{
				$html = str_get_html($data);
				$table = $html->find('table');
				$tr = $table[0]->find('tr');
				if ($data = $cc->get('evarsity.srmuniv.ac.in/srmswi/resource/StudentDetailsResources.jsp?resourceid=5'))
				{
					$html = str_get_html($data);
					$table = $html->find('table');
					$otr = $table[1]->find('tr');
					$nos = count($tr) - 3;

					//					echo "\n";

					echo "{";
					echo "\"subjects\":[";
					$nos = count($tr) - 3;
					for ($i = 0; $i < $nos; $i++)
					{
						$td = $tr[$i + 3]->find('td');

						// echo " \"".rtrim(ltrim($td[0]->plaintext," ")," ")."\" : ";

						$daa1.= "\"" . $td[0]->plaintext . "\",";

						// echo " } ,\n";

					}

					// $daa1.= "\"\"";

					echo rtrim($daa1, ',');
					echo "],";
					for ($i = 0; $i < $nos; $i++)
					{
						$td = $tr[$i + 3]->find('td');

						// echo " \"".rtrim(ltrim($td[0]->plaintext," ")," ")."\" : ";

						$daa.= "\"" . $td[0]->plaintext . "\":";
						$daa.= "{\n";

						//	echo " \"sub-desc\" : \"".rtrim(ltrim($td[1]->plaintext," ")," ")."\",\n";

						$daa.= " \"CODE\" : \"" . $td[0]->plaintext . "\",\n";
						$daa.= " \"NAME\" : \"" . $td[1]->plaintext . "\",\n";
						$daa.= " \"MARKS\" : \"" . $td[2]->plaintext . "\"\n";

						//	echo " \"avg-attd\" : ".$td[7]->plaintext."\n";

						$daa.= " } ,\n";
					}

					echo $daa;
					echo "\"error\":false \n";
					echo "}";
				}
				else
				{
					echo "{\n\"error\":true,";
					echo "\"error_msg\":\"Unable to connect to Time Table Detais\",";
					echo "\"code\":\"302\"}";
				}
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