<?php
$url = "localhost";
$username = "test";
$password = "EkMGdb5c";
$dbname = "data";

$conn = new mysqli($url, $username, $password, $dbname);
$totalPositivos=0;
$molecular=0;
$rapida=0;
$hombres=0;
$mujeres=0;
$distritos=[];
$depName=$_GET["depName"];
$provName=$_GET["depName"];
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
ini_set('display_errors', 1);
$sql="SELECT * FROM positivos WHERE departamento='Arequipa' AND provincia='Arequipa'";
$res=$conn->query($sql);
if($res->num_rows > 0){
  while($row= $res->fetch_array()){
    $totalPositivos++;
    if ($row[4]=="PCR"){
      $molecular++;
    }else if ($row[4]=="PR"){
      $rapida++;
    }
    if ($row[6]=="FEMENINO"){
      $mujeres++;
    }else $hombres++;
  }
}
$i=0;
$sql="SELECT DISTINCT distrito FROM positivos WHERE departamento='Arequipa' AND provincia='Arequipa'";
$res=$conn->query($sql);
if($res->num_rows > 0){
  while($row= $res->fetch_array()){
    $distritos[$i]=$row[0];
    $i++;
  }
}
foreach ($distritos as $key) {
  echo $key."\n";
}

echo "Positivos:".$totalPositivos."\n";
echo "PCR:".$molecular."\n";
echo "PR:".$rapida."\n";
echo "Hombres:".$hombres."\n";
echo "Mujeres:".$mujeres."\n";


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
