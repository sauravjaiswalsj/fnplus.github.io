<?php
$file = 'cookies.txt';
file_put_contents($file,'');

if(isset($_REQUEST['regno']) && isset($_REQUEST['pass']))
{
	require_once('curl.php');
	require_once('simple_html_dom.php');
	$cc = new cURL(); 
	if($data = $cc->get('evarsity.srmuniv.ac.in/srmswi/usermanager/youLogin.jsp?txtSN='.$_REQUEST["regno"].'&txtPD='.$_REQUEST["pass"].'&txtPA=1'))
	{	
		$html = str_get_html($data);
		if($test = $html->find('div[class=paneltitle01]'))
		{		
		
			
			if($data = $cc->get('evarsity.srmuniv.ac.in/srmswi/resource/StudentDetailsResources.jsp?resourceid=12'))
			{
				$html = str_get_html($data);
				$table = $html->find('table');
				$tr = $table[0]->find('tr'); 
				if($data = $cc->get('evarsity.srmuniv.ac.in/srmswi/resource/StudentDetailsResources.jsp?resourceid=5'))
				{				
					$html = str_get_html($data);
					$table = $html->find('table');					
					$otr = $table[1]->find('tr');								
					$nos = count($tr)-4;
//					echo "\n";
					echo "{";
					// for($i=0;$i<$nos;$i++)
					// {
					// 	$td = $tr[$i+3]->find('td');					
					// 	if($i==$nos-1)
					// 			echo " \"".rtrim(ltrim($td[0]->plaintext,' '),' ')."\"],\n";
					// 	else
					// 			echo " \"".rtrim(ltrim($td[0]->plaintext,' '),' ')."\",";
					// }
					echo "\"subjects\":[";
					$nos = count($tr)-6;
					
						for($i=0;$i<$nos;$i++)	
						{		
							$td = $tr[$i+5]->find('td');							
								//echo " \"".rtrim(ltrim($td[0]->plaintext," ")," ")."\" : ";
							  echo "\"".$td[2]->plaintext."\",";
						
						    	//echo " } ,\n";
						}
						$td = $tr[$nos+5]->find('td');		    
						   // echo " \"total\" : ";
							//	echo "\n";
								echo "\"".$td[2]->plaintext."\"";
						
					echo "],";
					
					for($i=0;$i<$nos;$i++)	
						{		
							$td = $tr[$i+5]->find('td');							
								//echo " \"".rtrim(ltrim($td[0]->plaintext," ")," ")."\" : ";
							  echo "\"".$td[2]->plaintext."\":";
							  echo "{\n";			
							//	echo " \"sub-desc\" : \"".rtrim(ltrim($td[1]->plaintext," ")," ")."\",\n";
									echo " \"Date\" : \"".$td[0]->plaintext."\",\n";
									echo " \"Type\" : \"".$td[1]->plaintext."\",\n";
								echo " \"Number\" : \"".$td[2]->plaintext."\",\n";
								echo " \"Narration\" : \"".$td[3]->plaintext."\",\n";
								echo " \"Amount\" : \"".$td[4]->plaintext."\"\n";
							//	echo " \"avg-attd\" : ".$td[7]->plaintext."\n";   
						    	echo " } ,\n";
						}
						
							$td = $tr[$nos+5]->find('td');		    
						  echo "\"".$td[2]->plaintext."\":";
								echo " { \n";
								echo " \"Date\" : \"".$td[0]->plaintext."\",\n";
									echo " \"Type\" : \"".$td[1]->plaintext."\",\n";
								echo " \"Number\" : \"".$td[2]->plaintext."\",\n";
								echo " \"Narration\" : \"".$td[3]->plaintext."\",\n";
								echo " \"Amount\" : \"".$td[4]->plaintext."\"\n";
						//		echo " \"avg-attd\" : ".$td[7]->plaintext."\n";   		
						    	echo " },\n";
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