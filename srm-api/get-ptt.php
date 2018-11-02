<?php
$file = 'cookies.txt';
file_put_contents($file, '');

function getSubjectName($sub, $scode)
{
	$subjectName = "";
	$done = [];
	for ($i = 0; $i < sizeof($scode); $i++)
	{
		if (!in_array(trim($scode[$i]) , $done))
		{
			array_push($done, trim($scode[$i]));
			$subjectName.= $sub[trim($scode[$i]) ] . " / ";
		}
	}

	$subjectName = trim($subjectName, " / ");

	if($subjectName == "") $subjectName = "Free slot";

	return $subjectName;
}

if (isset($_REQUEST['regno']) && isset($_REQUEST['pass']))
{
	require_once ('curl.php');

	require_once ('simple_html_dom.php');
	
	header('Content-Type: application/json');
	header('Access-Control-Allow-Origin: *');

	$cc = new cURL();
	if ($data = $cc->get('evarsity.srmuniv.ac.in/srmswi/usermanager/youLogin.jsp?txtSN=' . $_REQUEST["regno"] . '&txtPD=' . $_REQUEST["pass"] . '&txtPA=1'))
	{
		$html = str_get_html($data);
		if ($test = $html->find('div[class=paneltitle01]') || !$html->find('div[plaintext^=Information @ your Desktop]'))
		{
			if ($data = $cc->get('evarsity.srmuniv.ac.in/srmswi/resource/StudentDetailsResources.jsp?resourceid=5'))
			{
				$html = str_get_html($data);
				$table = $html->find('table');
				$tr = $table[0]->find('tr');
				$otr = $table[1]->find('tr');
				for ($i = 2; $i < count($otr); $i++)
				{
					$td = $otr[$i]->find('td');
					$sub[rtrim(ltrim($td[0]->plaintext, ' ') , ' ') ] = rtrim(ltrim($td[1]->plaintext, ' ') , ' ');
				}

				echo " { \n";
				$td = $tr[3]->find('td');
				echo "\"monday\": [";

				for ($i = 0; $i < 8; $i++)
				{
					$subcode = explode(",", $td[$i + 1]->plaintext);
					if ($i == 7) echo "\"" . getSubjectName($sub, $subcode) . "\"],\n";
					else echo "\"" . getSubjectName($sub, $subcode) . "\",";
				}

				$td = $tr[4]->find('td');
				echo "\"tuesday\": [";
				for ($i = 0; $i < 8; $i++)
				{
					$subcode = explode(",", $td[$i + 1]->plaintext);
					if ($i == 7) echo "\"" . getSubjectName($sub, $subcode) . "\"],\n";
					else echo "\"" . getSubjectName($sub, $subcode) . "\",";
				}

				$td = $tr[5]->find('td');
				echo "\"wednesday\": [";
				for ($i = 0; $i < 8; $i++)
				{
					$subcode = explode(",", $td[$i + 1]->plaintext);
					if ($i == 7) echo "\"" . getSubjectName($sub, $subcode) . "\"],\n";
					else echo "\"" . getSubjectName($sub, $subcode) . "\",";
				}

				$td = $tr[6]->find('td');
				echo "\"thursday\": [";
				for ($i = 0; $i < 8; $i++)
				{
					$subcode = explode(",", $td[$i + 1]->plaintext);
					if ($i == 7) echo "\"" . getSubjectName($sub, $subcode) . "\"],\n";
					else echo "\"" . getSubjectName($sub, $subcode) . "\",";
				}

				$td = $tr[7]->find('td');
				echo "\"friday\": [";
				for ($i = 0; $i < 8; $i++)
				{
					$subcode = explode(",", $td[$i + 1]->plaintext);
					if ($i == 7) echo "\"" . getSubjectName($sub, $subcode) . "\"],\n";
					else echo "\"" . getSubjectName($sub, $subcode) . "\",";
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
