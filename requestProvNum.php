<?php
$servername = "localhost";
$username = "test";
$password = "EkMGdb5c";
$dbname = "data";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$provname=$_GET["provname"];
$t=$_GET["total"];
$p=$_GET["prueba"];
$s=$_GET["sexo"];
$data["orden"]=$_GET["orden"];
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8");
ini_set('display_errors', 1);
if($t==1){
 $sql="SELECT COUNT(uuid) FROM positivos WHERE provincia=$provname";
  $res=$conn->query($sql);
  if($res->num_rows > 0){
    while($row= $res->fetch_row()){
      $data["total"]=$row[0];
    }
  }  
}

if($p==1){
  $sql="SELECT COUNT(uuid) FROM positivos WHERE provincia=$provname AND metododx='pr'";
  $res=$conn->query($sql);
  if($res->num_rows > 0){
    while($row= $res->fetch_row()){
      $data["prueba"]["pr"]=$row[0];
    }
  }
  $sql="SELECT COUNT(uuid) FROM positivos WHERE provincia=$provname AND metododx='pcr'";  
  $res=$conn->query($sql);
  if($res->num_rows > 0){
    while($row= $res->fetch_row()){
      $data["prueba"]["pcr"]=$row[0];
    }
  }
}
if($s==1){
  $sql="SELECT COUNT(uuid) FROM positivos WHERE provincia=$provname AND sexo='masculino'";
  $res=$conn->query($sql);
  if($res->num_rows > 0){
    while($row= $res->fetch_row()){
      $data["sexo"]["m"]=$row[0];
    }
  }
  $sql="SELECT COUNT(uuid) FROM positivos WHERE provincia=$provname AND sexo='femenino'";  
  $res=$conn->query($sql);
  if($res->num_rows > 0){
    while($row= $res->fetch_row()){
      $data["sexo"]["f"]=$row[0];
    }
  } 
  $sql="SELECT fecha FROM pruebas ORDER BY fecha DESC LIMIT 1";  
  $res=$conn->query($sql);
  if($res->num_rows > 0){
    while($row= $res->fetch_row()){
      $data["fecha"]=$row[0];
    }
  } 
}
  echo json_encode($data);

?>