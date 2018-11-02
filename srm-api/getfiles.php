<?php
$servername = "localhost";
$username = "hashbird_hash";
$password = "hash123";
$dbname = "hashbird_erp";
try
{
	$connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$connection1 = mysqli_connect($server_name, $username, $password, $dbname);

	// mysqli_set_charset($connection, 'utf8');

}

catch(PDOException $e)
{
	die("OOPs something went wrong");
}

//  if(isset($_REQUEST['searchQuery']))
//   {
// $search_query=$_REQUEST['searchQuery'];
//  $sql = "SELECT * FROM registered_users,more_detail WHERE registered_users.ID = more_detail.uid AND registered_users.NAME LIKE '%$search_query%'";
//     //   $sql = "SELECT * FROM registered_users WHERE NAME LIKE '%$search_query%'";
//        $statement = $connection->prepare($sql);
// // $statement->bindParam(':search_query', $search_query, PDO::PARAM_STR);
//        $statement->execute();
//        if($statement->rowCount())
//        {
//   $row_all = $statement->fetchall(PDO::FETCH_ASSOC);
//  // $row_all['image']= "chandan";
//   header('Content-type: application/json');
// 	    echo json_encode($row_all);
//        }
//        elseif(!$statement->rowCount())
//        {
//   echo "no rows";
//        }
//   }

if (isset($_REQUEST['regno']) && isset($_REQUEST['subject']))
{
	$search_query = $_REQUEST['regno'];
	$subc = addslashes($_REQUEST['subject']);
	$sql1 = "SELECT * FROM user_login WHERE regno='$search_query'";

	//   $sql = "SELECT * FROM registered_users WHERE NAME LIKE '%$search_query%'";

	$statement1 = mysqli_query($connection1, $sql1);

	// $statement->bindParam(':search_query', $search_query, PDO::PARAM_STR);

	while ($data = mysqli_fetch_assoc($statement1))
	{
		$dept = $data['dept'];
		$batch = $data['batch'];
	}

	$sql = "SELECT * FROM notes WHERE batch='$batch' AND dept='$dept' AND sub_code='$subc' AND status='1' ORDER BY uploaded DESC";

	//   $sql = "SELECT * FROM registered_users WHERE NAME LIKE '%$search_query%'";

	$statement = $connection->prepare($sql);

	// $statement->bindParam(':search_query', $search_query, PDO::PARAM_STR);

	$statement->execute();
	if ($statement->rowCount())
	{
		$row_all = $statement->fetchall(PDO::FETCH_ASSOC);

		// $row_all['image']= "chandan";

		header('Content-type: application/json');
		echo json_encode($row_all);
	}
	elseif (!$statement->rowCount())
	{
		echo "no rows";
	}

	//   $row_all = $statement->fetchall(PDO::FETCH_ASSOC);
	//  // $row_all['image']= "chandan";
	// //   header('Content-type: application/json');
	// 	  //  echo json_encode($row_all);
	//        }
	//        elseif(!$statement->rowCount())
	//        {
	//   echo "no rows";
	//        }

}

?>