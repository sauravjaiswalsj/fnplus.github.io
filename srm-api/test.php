<?php include 'head.php'; ?>

<?php
// function crypto_rand_secure($min, $max)
// {
//     $range = $max - $min;
//     if ($range < 1) return $min; // not so random...
//     $log = ceil(log($range, 2));
//     $bytes = (int) ($log / 8) + 1; // length in bytes
//     $bits = (int) $log + 1; // length in bits
//     $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
//     do {
//         $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
//         $rnd = $rnd & $filter; // discard irrelevant bits
//     } while ($rnd > $range);
//     return $min + $rnd;
// }

// function getToken($length)
// {
//     $token = "";
//     $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
//     $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
//     $codeAlphabet.= "0123456789";
//     $max = strlen($codeAlphabet); // edited

//     for ($i=0; $i < $length; $i++) {
//         $token .= $codeAlphabet[crypto_rand_secure(0, $max-1)];
//     }

//     return $token;
// }

// $regno='RA1411008020062';



define("DB_HOST", "localhost");
define("DB_USER", "hashbird_hash");
define("DB_PASSWORD", "hash123");
define("DB_DATABASE", "hashbird_erp");

	$conn1 = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);


$query = "SELECT * FROM user_login where sex='Female'";
$runthis = mysqli_query($conn1,$query);

while($want = mysqli_fetch_assoc($runthis))
  {
  ?>

  <div class="row-fluid">
    <div class="span4" style="text-align:justify;">
     
<img src="https://hashbird.com/gogrit.in/workspace/srm-api/studentImages/<?php echo $want['regno']; ?>.jpg" style="width:200px;height:300px;">
    <h5> <?php echo $want['name']; ?>
</h5>
       <h6> <?php echo $want['regno']; ?>
</h6>
      <hr>
    </div>

  
  <?php  
  
}




?>