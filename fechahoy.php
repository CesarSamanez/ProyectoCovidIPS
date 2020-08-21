<?php
$servername = "localhost";
$username = "test";
$password = "EkMGdb5c";
$dbname = "data";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
ini_set('display_errors', 1);
//
//total hoy
$fecha_actual = date("d-m-Y");
for($i=0;$i<30;$i++){
	$hoy = date("Y-m-d",strtotime($fecha_actual."- $i days"));
	$j=$i+1;
	$ayer = date("Y-m-d",strtotime($fecha_actual."- $j days"));
	/*$rest = substr($hoy, 0, 1);
	if($rest == '0'){
		$hoy=substr($hoy, 1, strlen($hoy)-1);
	}*/
	
	$hoyfecha="";
	//echo $hoy."<p>Tiempo vacio</p><br>";
	for($k=0;$k<strlen($hoy);$k++){
		$restp = substr($hoy, $k, 1);
		if($restp != '-'){
			$hoyfecha=$hoyfecha.$restp;
		}
	}
	
	$sql="SELECT * FROM positivos where fecha_resultado='$hoyfecha'";
	$res=$conn->query($sql);
	if($res->num_rows==0){
		//echo $hoy."<br>";
		//echo $ayer."<br>";
		//echo $hoyfecha."<br>";
	}else{
		//echo "check hoy-->".$hoy."<br>";
		//echo "check ayer-->".$ayer."<br>";
		//echo "check hoy positivos -->".$hoyfecha."<br>";
		break;
	}
}

?>
