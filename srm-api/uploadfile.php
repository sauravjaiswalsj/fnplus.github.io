<?php

//importing dbDetails file
//require_once 'dbDetails.php';

//this is our upload folder
function crypto_rand_secure($min, $max)
{
    $range = $max - $min;
    if ($range < 1) return $min; // not so random...
    $log = ceil(log($range, 2));
    $bytes = (int) ($log / 8) + 1; // length in bytes
    $bits = (int) $log + 1; // length in bits
    $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
    do {
        $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
        $rnd = $rnd & $filter; // discard irrelevant bits
    } while ($rnd > $range);
    return $min + $rnd;
}

function getToken($length)
{
    $token = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
    $codeAlphabet.= "0123456789";
    $max = strlen($codeAlphabet); // edited

    for ($i=0; $i < $length; $i++) {
        $token .= $codeAlphabet[crypto_rand_secure(0, $max-1)];
    }

    return $token;
}

		$servername = "localhost";
$username = "hashbird_hash";
$password = "hash123";
$dbname = "hashbird_erp";

try {
    	$connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    	$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    	$con = mysqli_connect($server_name,$username,$password,$dbname);
    	//mysqli_set_charset($connection, 'utf8');
    }
catch(PDOException $e)
    {
    	die("OOPs something went wrong");
    }











$upload_path = 'uploads/';

//Getting the server ip
$server_ip = gethostbyname(gethostname());

//creating the upload url
echo $upload_url = 'https://'.$server_ip.'/'.$upload_path;

//response array
$response = array();


if($_SERVER['REQUEST_METHOD']=='POST'){

    //checking the required parameters from the request
    if(isset($_REQUEST['name']) and isset($_FILES['pdf']['name'])&& isset($_REQUEST['regno'])&& isset($_REQUEST['code'])&& isset($_REQUEST['desc'])){

        //connecting to the database
  //      $con = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME) or die('Unable to Connect...');

        //getting name from the request
        $name = $_REQUEST['name'];
        $regno = $_REQUEST['regno'];
        $code = $_REQUEST['code'];
        $desc = $_REQUEST['desc'];
        
    	   $sql1 = "SELECT * FROM user_login WHERE regno='$regno'";
	  
       //   $sql = "SELECT * FROM registered_users WHERE NAME LIKE '%$search_query%'";
          $statement1 = mysqli_query($con,$sql1);
	 // $statement->bindParam(':search_query', $search_query, PDO::PARAM_STR);
    
    while($data = mysqli_fetch_assoc($statement1)){
    	
    	$dept =  $data['dept'];
    	$batch = $data['batch'];
    	$author = $data['name'];
    	
    }
    
    $campus = $regno[10];
    
    
    
    
        

        //getting file info from the request
        $fileinfo = pathinfo($_FILES['pdf']['name']);

        //getting the file extension
        $extension = $fileinfo['extension'];

$token =  getToken(50);
        //file url to store in the database
        $file_url = $upload_url . $token . '.' . $extension;

        //file path to upload in the server
        $file_path = $upload_path . $token . '.'. $extension;
        $file_name = "https://hashbird.com/gogrit.in/workspace/srm-api/uploads/".$token. '.' .$extension;

        //trying to save the file in the directory
        try{
            //saving the file
             move_uploaded_file($_FILES['pdf']['tmp_name'],$file_path);
   $sql = "INSERT INTO  `notes` (

`id` ,
`name` ,
`desc` ,
`file` ,
`author`,
`regno` ,
`campus` ,
`batch` ,
`section` ,
`dept` ,
`sub_code` ,
`uploaded` ,
`status`
)
VALUES (
NULL ,  '$name',  '$desc',  '$file_name', '$author',  '$regno',  '$campus',  '$batch',  'X',  '$dept',  '$code', 
CURRENT_TIMESTAMP ,  '1'
)";
$cool = mysqli_query($con,$sql);

            //adding the path and name to database
            if($cool){

                //filling response array with values
                $response['error'] = false;
                $response['url'] = $file_url;
                $response['name'] = $name;
            }
            //if some error occurred
        }catch(Exception $e){
            $response['error']=true;
            $response['message']=$e->getMessage();
        } 
        //closing the connection
       // mysqli_close($con);
    }else{
        $response['error']=true;
        $response['message']='Please choose a file';
    }
    
    //displaying the response
    echo json_encode($response);
}

/*
We are generating the file name
so this method will return a file name for the image to be upload
// */
// function getFileName(){
//     $con = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME) or die('Unable to Connect...');
//     $sql = "SELECT max(id) as id FROM pdfs";
//     $result = mysqli_fetch_array(mysqli_query($con,$sql));

//     mysqli_close($con);
//     if($result['id']==null)
//         return 1;
//     else
//         return ++$result['id'];
// }