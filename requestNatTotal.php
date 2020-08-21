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
$sql="SELECT ( SELECT cantidad FROM pruebas ORDER BY cantidad DESC LIMIT 1), 
COUNT(uuid),
COUNT(IF(metododx = 'PCR', 1, NULL)) as 'PCR',
COUNT(IF(metododx = 'PR', 1, NULL)) as 'PR',
COUNT(IF(sexo = 'MASCULINO', 1, NULL)) as 'Masculino',
COUNT(IF(sexo = 'FEMENINO', 1, NULL)) as 'Femenino',
(SELECT fecha FROM pruebas ORDER BY fecha DESC LIMIT 1) as 'Fecha'
FROM positivos";

$res=$conn->query($sql);
if($res->num_rows > 0){
  $row= $res->fetch_row();
  $data["ptotal"]= $row[0];
  $data["total"]= $row[1];
  $data["prueba"]["pcr"]=$row[2];
  $data["prueba"]["pr"]=$row[3];
  $data["sexo"]["m"]=$row[4];
  $data["sexo"]["f"]=$row[5];
  $data["fecha"]=$row[6];
}

echo json_encode($data);
?>