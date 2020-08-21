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
$vfuturo=[];


$sql="SELECT * FROM proyeccion WHERE nombre='peru'";
$res=$conn->query($sql);
if($res->num_rows > 0){
  while($row= $res->fetch_assoc()){
	 $vfuturo[0]=$row["d1"];
	 $vfuturo[1]=$row["d2"];
	 $vfuturo[2]=$row["d3"];
	 $vfuturo[3]=$row["d4"];
	 $vfuturo[4]=$row["d5"];
	 $vfuturo[5]=$row["d6"];
	 $vfuturo[6]=$row["d7"];
  }
}
/*
echo('<pre>');
var_dump($vfuturo);
echo('</pre>');*/
echo json_encode($vfuturo);
?>
