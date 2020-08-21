<?php
$servername = "localhost";
$username = "test";
$password = "EkMGdb5c";
$dbname = "data";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
ini_set('display_errors', 1);

$totalPruebas;
$totalPositivos;
$pruebasNuevas;
$positivosNuevos;
$positivosayer;
$pruebasayer;
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql="SELECT cantidad from pruebas ORDER BY cantidad DESC LIMIT 2";
$res=$conn->query($sql);
if($res->num_rows > 0){
  $row= $res->fetch_array();
  $totalPruebas= $row[0];
  $row= $res->fetch_array();
  $pruebasayer=$row[0];
}

$sql="SELECT contagios from pruebas ORDER BY contagios DESC LIMIT 2";
$res=$conn->query($sql);
if($res->num_rows > 0){
  $row= $res->fetch_array();
  $totalPositivos=$row[0];
  $row= $res->fetch_array();
  $positivosayer=$row[0];
}

$sql="SELECT fecha FROM pruebas ORDER BY fecha DESC LIMIT 1";  
  $res=$conn->query($sql);
  if($res->num_rows > 0){
    while($row= $res->fetch_row()){
      $data["fecha"]=$row[0];
    }
  } 
  
$data["ptotal"]= $totalPruebas;
$data["total"]= $totalPositivos;
$data["pnuevas"]= $totalPruebas - $pruebasayer;
$data["totalnuevas"]= $totalPositivos - $positivosayer;

  echo json_encode($data);
?>