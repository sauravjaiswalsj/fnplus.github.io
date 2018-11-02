<?php
$file = 'cookies.txt';
file_put_contents($file, '');

if (isset($_GET['regno']) && isset($_GET['pass']))
{
	require_once ('curl.php');

	require_once ('simple_html_dom.php');

	$cc = new cURL();
	if ($data = $cc->get('evarsity.srmuniv.ac.in/srmswi/usermanager/youLogin.jsp?txtSN=' . $_GET["regno"] . '&txtPD=' . $_GET["pass"] . '&txtPA=1'))
	{
		$html = str_get_html($data);
		if ($test = $html->find('div[class=paneltitle01]'))
		{
			if ($data = $cc->get('evarsity.srmuniv.ac.in/srmswi/resource/StudentDetailsResources.jsp?resourceid=5'))
			{
				$html = str_get_html($data);
				$table = $html->find('table');
				$tr = $table[0]->find('tr');
				echo " { \n";
				$td = $tr[3]->find('td');
				echo "\"monday\": [";
				for ($i = 0; $i < 7; $i++)
				{
					$subcode = explode(",", $td[$i + 1]->plaintext);
					if ($i == 6) echo "\"" . $subcode[0] . "\"],\n";
					else echo "\"" . $subcode[0] . "\",";
				}

				$td = $tr[4]->find('td');
				echo "\"tuesday\": [";
				for ($i = 0; $i < 7; $i++)
				{
					$subcode = explode(",", $td[$i + 1]->plaintext);
					if ($i == 6) echo "\"" . $subcode[0] . "\"],\n";
					else echo "\"" . $subcode[0] . "\",";
				}

				$td = $tr[5]->find('td');
				echo "\"wednesday\": [";
				for ($i = 0; $i < 7; $i++)
				{
					$subcode = explode(",", $td[$i + 1]->plaintext);
					if ($i == 6) echo "\"" . $subcode[0] . "\"],\n";
					else echo "\"" . $subcode[0] . "\",";
				}

				$td = $tr[6]->find('td');
				echo "\"thursday\": [";
				for ($i = 0; $i < 7; $i++)
				{
					$subcode = explode(",", $td[$i + 1]->plaintext);
					if ($i == 6) echo "\"" . $subcode[0] . "\"],\n";
					else echo "\"" . $subcode[0] . "\",";
				}

				$td = $tr[7]->find('td');
				echo "\"friday\": [";
				for ($i = 0; $i < 7; $i++)
				{
					$subcode = explode(",", $td[$i + 1]->plaintext);
					if ($i == 6) echo "\"" . $subcode[0] . "\"],\n";
					else echo "\"" . $subcode[0] . "\",";
				}

				echo " \"error\":false \n";
				echo " } ";
			}
			else
			{
				echo " {\n  \"error\":\"Unable to connect to TimeTable Detais\", \n";
				echo "  \"code\":\"303\" \n }";
			}
		}
		else
		{
			echo " {\n  \"error\":\"Wrong Regno Password\", \n";
			echo "  \"code\":\"100\" \n }";
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
	echo " {\n  \"error\":\"Something Went Wrong\", \n";
	echo "  \"code\":\"500\" \n }";
}

?>