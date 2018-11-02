<?php

$file = 'cookies.txt';
file_put_contents($file,'');

if(isset($_POST['regno']) && isset($_POST['pass']))
{
	require_once('curl.php');
	require_once('simple_html_dom.php');
	
	$cc = new cURL(); 

	if($data = $cc->get('evarsity.srmuniv.ac.in/srmswi/usermanager/youLogin.jsp?txtSN='.$_POST["regno"].'&txtPD='.$_POST["pass"].'&txtPA=1'))
	{	
	$html = str_get_html($data);

		if($html->find('div[class=paneltitle01]'))
		{		
			echo " {\n  \"login\":\"success\",";
			echo "\n  \"error\":false \n}";			
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