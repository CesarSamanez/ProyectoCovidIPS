<?php
$servername = "localhost";
$username = "test";
$password = "EkMGdb5c";
$dbname = "data";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$provname=$_GET["provname"];
$distname=$_GET["distname"];
$conn->set_charset("utf8");
//Total, por tipo de prueba, por sexo
//Genera la consulta respectiva si es == 1
$t=$_GET["total"];
$p=$_GET["prueba"];
$s=$_GET["sexo"];
$data["orden"]=$_GET["orden"];
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
ini_set('display_errors', 1);

if($p==1){
  $sql="SELECT COUNT(uuid) FROM positivos WHERE provincia= '$provname' AND distrito= '$distname' AND metododx='pr'";
  $res=$conn->query($sql);
  if($res->num_rows > 0){
    while($row= $res->fetch_row()){
      $data["prueba"]["pr"]=$row[0];
    }
  }
  $sql="SELECT COUNT(uuid) FROM positivos WHERE provincia= '$provname' AND distrito= '$distname' AND metododx='pcr'";  
  $res=$conn->query($sql);
  if($res->num_rows > 0){
    while($row= $res->fetch_row()){
      $data["prueba"]["pcr"]=$row[0];
    }
  }
}
  echo json_encode($data);

?>