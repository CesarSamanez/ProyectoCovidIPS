<?php
$url = "localhost";
$username = "test";
$password = "EkMGdb5c";
$dbname = "data";

$conn = new mysqli($url, $username, $password, $dbname);
$totalpruebas=0;
$totalPositivos=0;
$pruebaNuevas=0;
$positivosNuevos=0;
$fechahoy=date("d-m-Y");
$fechaayer = date("d-m-Y", strtotime($fechahoy. "-1 day"));
$pruebasayer;

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
ini_set('display_errors', 1);
$sql="SELECT COUNT(uuid) total FROM positivos";
$res=$conn->query($sql);
if($res->num_rows > 0){
  while($row= $res->fetch_assoc()){
    $totalPositivos+=$row["total"];
  }
}
$sql="SELECT cantidad from pruebas ORDER BY cantidad DESC LIMIT 2";
$res=$conn->query($sql);
if($res->num_rows > 0){
  $row= $res->fetch_array();
  $totalpruebas= $row[0];
  $row= $res->fetch_array();
  $pruebasayer=$row[0];
}
$sql="SELECT * FROM positivos WHERE STR_TO_DATE(fecha_resultado,'%d/%m/%Y') = STR_TO_DATE($fechaayer, '%d/%m/%Y')";
$res=$conn->query($sql);
if($res->num_rows > 0){
  echo "pepe";
  while($row= $res->fetch_assoc()){
    $positivosNuevos++;
  }
}
echo "Pruebas totales:".$totalpruebas."\n";
echo "Positivos:".$totalPositivos."\n";
echo "Negativos:".($totalpruebas-$totalPositivos)."\n";
echo "Pruebas nuevas:".($totalpruebas-$pruebasayer)."\n";
echo "Positivos Nuevos:".$positivosNuevos."\n";


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
  </head>
  <body>
  </body>
</html>
