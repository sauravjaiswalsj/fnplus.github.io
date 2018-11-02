<?php
$file = 'cookies.txt';
file_put_contents($file,'');

if(isset($_GET['regno']))
{
	require_once('curl.php');
	require_once('simple_html_dom.php');
	$cc = new cURL(); 
	if($data = $cc->get('evarsity.srmuniv.ac.in/srmswi/usermanager/youLogin.jsp?txtSN=RA1411008020062&txtPD=chandan111&txtPA=1'))
	{	
		$html = str_get_html($data);
		if($test = $html->find('div[class=paneltitle01]'))
		{		
		
			
			if($data = $cc->get('http://evarsity.srmuniv.ac.in/srmswi/usermanager/StudentParentLoginInner.jsp?action=1&registerno='.$_GET['regno']))
			{
				echo $data;
				
				
			}
		}
	}
}