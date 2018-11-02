<?php
define("DB_HOST", "localhost");
define("DB_USER", "hashbird_hash");
define("DB_PASSWORD", "hash123");
define("DB_DATABASE", "hashbird_erp");

$file = 'cookies.txt';
file_put_contents($file,'');

// Function to get dept from regno //
// function getDept($regno){
// 	switch($regno[8]){
// 		case '3': return "CSE";
// 		case '8': return "IT";
// 		case '4': return "ECE";
// 		case '5': return "EEE";
// 		case '1': return "CIVIL";
// 	}
// }

function findCourse($data){
	for($i=0;$i<sizeof($data);$i++){
		$row = $data[$i]->find('td');
		if(rtrim(ltrim($row[0]->plaintext,' '),' ') == "Course Name"){
			return rtrim(ltrim($row[1]->plaintext,' '),' ');
		}
	}
	return "not found";
}

// if(isset($_REQUEST['regno']) && isset($_REQUEST['pass']))
// {
	require_once('curl.php');
	require_once('simple_html_dom.php');
	$conn1 =  mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);


$qry = "SELECT * FROM  `login`";
$qrn = mysqli_query($conn1,$qry);

while($dad=mysqli_fetch_assoc($qrn)){
	$re = $dad['regno'];
	$pa = $dad['pass'];
	
	$cc = new cURL(); 

	if($data = $cc->get('evarsity.srmuniv.ac.in/srmswi/usermanager/youLogin.jsp?txtSN='.$re.'&txtPD='.$pa.'&txtPA=1'))
	{	
	$html = str_get_html($data);
	$hml = $html;

		if($html->find('div[class=paneltitle01]'))
		{
			
				// $stmt = "INSERT INTO `hashbird_erp`.`login` (`id`, `regno`, `pass`) VALUES (NULL, '$re','$pa')";

        // $run = mysqli_query($conn1,$stmt);
			
			if($data = $cc->get('evarsity.srmuniv.ac.in/srmswi/resource/StudentDetailsResources.jsp?resourceid=1'))
			{
				$html = str_get_html($data);	
				$table = $html->find('table');
				$tr = $table[1]->find('tr'); 		

				if($data = $cc->get('evarsity.srmuniv.ac.in/srmswi/feepayment/StudentFeePayment.jsp'))
				{	
				 	$html = str_get_html($data);	
					$feetable = $html->find('table');					
					$feetr = $feetable[0]->find('tr'); 										
					$total = count($tr);					
					
					echo " { \n";

						$td = $tr[1]->find('td');
						$name = rtrim(ltrim($td[1]->plaintext,' '),' ');
						echo " \"name\" : \"".$name."\",\n";

						$td = $tr[2]->find('td');
						// $userRegno = rtrim(ltrim($td[1]->plaintext,' '),' '); //
						$regno = rtrim(ltrim($td[1]->plaintext,' '),' ');
						echo " \"regno\" : \"".$regno."\",\n";
					
						if($regno[3]=='4'){
						$td = $tr[4]->find('td');
						$course = rtrim(ltrim($td[1]->plaintext,' '),' ');
						echo " \"course\" : \"".$course."\",\n";
						 
}
else
{
		$td = $tr[3]->find('td');
		$course = rtrim(ltrim($td[1]->plaintext,' '),' ');
						echo " \"course\" : \"".$course."\",\n";
}

						$td = $tr[5]->find('td');
						// echo " \"dept\" : \"".rtrim(ltrim($td[1]->plaintext,' '),' ')."\",\n";
						$dept =findCourse($tr);
						echo " \"dept\" : \"".$dept."\",\n";

						$td = $feetr[2]->find('td');
						$input = $td[1]->find('input');
						$studentid = $input[0]->value;
						echo " \"studentid\" : \"".$studentid."\",\n";
						echo " \"folio_no\" : \"\","; // Dummy

						$td = $feetr[4]->find('td');
						$input = $td[1]->find('input');
						
						if($input[0]->value=="I")
							$sem = 1;
						else if($input[0]->value=="II")
							$sem = 2;
						else if($input[0]->value=="III")
							$sem = 3;
						else if($input[0]->value=="IV")
							$sem = 4;
						else if($input[0]->value=="V")
							$sem = 5;
						else if($input[0]->value=="VI")
							$sem = 6;
						else if($input[0]->value=="VII")
							$sem = 7;
						else if($input[0]->value=="VIII")
							$sem = 8;
						else if($input[0]->value=="IX")
							$sem = 9;
						else if($input[0]->value=="X")
							$sem = 10;
						else if($input[0]->value=="XI")
							$sem = 11;
						else if($input[0]->value=="XII")
							$sem = 12;												

						$year = ceil($sem/2);
						echo " \"semester\" : ".$sem.",\n";
						echo " \"year\" : ".$year.",\n";

						$td = $tr[$total-4]->find('td');
						$email =rtrim(ltrim($td[1]->plaintext,' '),' ');
						echo " \"email\" : \"".$email."\",\n";			

						$td = $tr[$total-8]->find('td');
						$dob =rtrim(ltrim($td[1]->plaintext,' '),' ');
						echo " \"dob\" : \"".$dob."\",\n";

						$td = $tr[$total-7]->find('td');
						$sex =rtrim(ltrim($td[1]->plaintext,' '),' ');
						echo " \"sex\" : \"".$sex."\",\n";

						$td = $tr[$total-5]->find('td');
						$address =rtrim(ltrim($td[1]->plaintext,' '),' ');
						echo " \"address\" : \"".$address."\",\n";

						$td = $tr[$total-3]->find('td');
						$pincode =rtrim(ltrim($td[1]->plaintext,' '),' ');
						echo " \"pincode\" : \"".$pincode."\",\n";
						
	$td = $tr[1]->find('td');
						$img = $td[2]->find('img');	
						$src = $img[0]->src;		
						$td = $tr[2]->find('td');				
						if($data = $cc->get('http://evarsity.srmuniv.ac.in/srmswi/resource/'.$src))
						{
							$file = rtrim(ltrim($td[1]->plaintext,' '),' ').'.jpg';
							$fp = fopen('studentImages/'.$file,'w');
							fwrite($fp, $data); 
							fclose($fp);				
						}
						else
						{
						
								echo "{\n\"error\":true,";
	echo "\"error_msg\":\"Unable to Download File from ERP\",";
	echo "\"code\":\"707\"}";
							
						}						
						
						
						echo " \"image\" : \"https://".$_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI'])."/studentImages/".$file."\",\n";
	echo " \"error_msg\" : \"Welcome ".$name."\",\n";

						echo " \"error\":false \n";

					echo " } ";

$cyear = date('Y',time());
$batch =  ($cyear-$year);

$check_if_already_there = "SELECT * FROM user_login WHERE studentid='$studentid'";
$run_check = mysqli_query($conn1,$check_if_already_there);

$check_count = mysqli_num_rows($run_check);


if($check_count<1)
{
	
	$query= "INSERT INTO  `user_login` (`id` ,`name` ,`regno` ,`course` ,`dept` ,`studentid` ,`batch` ,`email` ,`dob` ,`sex` ,`address` ,`pincode` ,`image`) 
	VALUES (NULL ,  '$name',  '$regno',  '$course',  '$dept',  '$studentid',  '$batch',  '$email',  '$dob',  '$sex',  '$address',  '$pincode', NULL)";
mysqli_query($conn1,$query);
	
}
else
{
	
	
	

}



						
				}
				else
				{
				
						echo "{\n\"error\":true,";
	echo "\"error_msg\":\"Unable to connect to Additional Details\",";
	echo "\"code\":\"301\"}";
					
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
// }
// else
// {
// 	echo "{\n\"error\":true,";
// 	echo "\"error_msg\":\"Something Went Wrong\",";
// 	echo "\"code\":\"500\"}";
// }	

// if($hml->find('div[class=navcenter01]'))
// 		{
			
// 			print_r($hml);
			
// 		}



?> 



