<?php
		$servername = "localhost";
$username = "hashbird_hash";
$password = "hash123";
$dbname = "hashbird_erp";

try {
    	$connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    	$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    	$connection1 = mysqli_connect($server_name,$username,$password,$dbname);
    	//mysqli_set_charset($connection, 'utf8');
    }
catch(PDOException $e)
    {
    	die("OOPs something went wrong");
    }

$response = array("error" => FALSE);


     
      if(isset($_REQUEST['noteid']))
     {
	  $search_query=$_REQUEST['noteid'];
	   $sql1 = "UPDATE `notes` SET  `status` =  '0' WHERE `id`='$search_query'";
	  
          $statement1 = mysqli_query($connection1,$sql1);
          
          if($statement1){
          	$response['error']=FALSE;
          	$response['error_msg']="Deleted Successfully";
          	
          }else
          {
          	
          	$response['error']=TRUE;
          	$response['error_msg']="Some Error Occured please report";
          	
          	
          }
          
          echo json_encode($response);
   	
     	
     }
     
     
     
		  
?>