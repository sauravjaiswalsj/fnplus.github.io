<?php

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
			if ($data = $cc->get('evarsity.srmuniv.ac.in/srmswi/resource/StudentDetailsResources.jsp?resourceid=7'))
			{
				$html = str_get_html($data);
				$table = $html->find('table');
				$tr = $table[0]->find('tr');
				if ($data = $cc->get('evarsity.srmuniv.ac.in/srmswi/resource/StudentDetailsResources.jsp?resourceid=5'))
				{
					$html = str_get_html($data);
					$table = $html->find('table');
					$otr = $table[1]->find('tr');
					$nos = count($tr) - 4;
					echo " {\"updated\" : {\"date\" :   \n";
					for ($i = 0; $i < 1; $i++)
					{
						$td = $tr[$i + 1]->find('td');
						if ($i == $nos - 1) echo " \"" . null/*substr(rtrim(ltrim($td[0]->plaintext, ' ') , ' ') , -11)*/. "\"],\n";
						else echo " \"" . null/*substr(rtrim(ltrim($td[0]->plaintext, ' ') , ' ') , -11)*/ . "\"},";
					}

					echo " \"subjects\" : [";
					for ($i = 0; $i < $nos; $i++)
					{
						$td = $tr[$i + 3]->find('td');
						if ($i == $nos - 1) echo " \"" . rtrim(ltrim($td[0]->plaintext, ' ') , ' ') . "\"],\n";
						else echo " \"" . rtrim(ltrim($td[0]->plaintext, ' ') , ' ') . "\",";
					}

					$nos = count($tr) - 4;
					for ($i = 0; $i < $nos; $i++)
					{
						$td = $tr[$i + 3]->find('td');
						echo " \"" . rtrim(ltrim($td[0]->plaintext, " ") , " ") . "\" : ";
						echo " { \n";
						echo " \"sub-desc\" : \"" . rtrim(ltrim($td[1]->plaintext, " ") , " ") . "\",\n";
						echo " \"max-hrs\" : " . $td[2]->plaintext . ",\n";
						echo " \"attd-hrs\" : " . $td[3]->plaintext . ",\n";
						echo " \"abs-hrs\" : " . $td[4]->plaintext . ",\n";
						echo " \"avg-attd\" : " . $td[7]->plaintext . ",\n";
						echo " \"od-hrs\" : " . $td[6]->plaintext . "\n";
						echo " } ,\n";
					}

					$td = $tr[$nos + 3]->find('td');
					echo " \"total\" : ";
					echo " { \n";
					echo " \"tot-hrs\" : " . $td[1]->plaintext . ",\n";
					echo " \"tot-attd-hrs\" : " . $td[2]->plaintext . ",\n";
					echo " \"tot-abs-hrs\" : " . $td[3]->plaintext . ",\n";
					echo " \"tot-avg-attd\" : " . $td[6]->plaintext . ",\n";
					echo " \"od-hrs\" : " . $td[5]->plaintext . "\n";
					echo " } ,\n";
					echo "\"error\":false \n";
					echo " } ";
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
				echo "\"error_msg\":\"Unable to connect to Student Details\",";
				echo "\"code\":\"300\"}";
			}
		}
		else
		{
			echo "{\n\"error\":true,";
			echo "\"error_msg\":\"Invalid Credentials\",";
			echo "\"code\":\"100\"}";
		}
	}
	else
	{
		echo " {\n  \"error\":\"Unable to connect to SRM HOME\", \n";
		echo "\"error_msg\":\"Unable to connect to SRM HOME\",";
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