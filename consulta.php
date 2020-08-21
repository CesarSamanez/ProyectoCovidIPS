<?php
$servername = "localhost";
$username = "test";
$password = "EkMGdb5c";
$dbname = "data";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);


$depname=$_GET["depName"];
$provname=$_GET["provName"];
$distName=$_GET["distName"];
$sexo=$_GET["sexo"];
$prueba=$_GET["prueba"];
$low=$_GET["low"];
$high=$_GET["high"];
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
ini_set('display_errors', 1);

$sql="SELECT COUNT(uuid) FROM positivos WHERE departamento =$depname AND provincia=$provname AND distrito=$distName AND sexo=$sexo AND metododx=$prueba AND edad >= $low AND edad <= $high ";
$res=$conn->query($sql);
if($res->num_rows > 0){
  while($row= $res->fetch_row()){
    $data["total"]= $row[0];
  }
}
$sql="SELECT fecha FROM pruebas ORDER BY fecha DESC LIMIT 1";  
  $res=$conn->query($sql);
  if($res->num_rows > 0){
    while($row= $res->fetch_row()){
      $data["fecha"]=$row[0];
    }
  } 
echo json_encode($data);
?>