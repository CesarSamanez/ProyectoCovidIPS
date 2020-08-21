<?php
$servername = "localhost";
$username = "test";
$password = "EkMGdb5c";
$dbname = "data";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
ini_set('display_errors', 1);
$data = json_decode(file_get_contents('php://input'), true);
$depName = $data["depName"];
$provName = $data["provName"];
$sql="SELECT COUNT(IF(edad >= 1 && edad <= 20 && sexo = 'MASCULINO', 1, NULL)),
COUNT(IF(edad >= 1 && edad <= 20 && sexo = 'FEMENINO', 1, NULL)),
COUNT(IF(edad >= 21 && edad <= 40 && sexo = 'MASCULINO', 1, NULL)),
COUNT(IF(edad >= 21 && edad <= 40 && sexo = 'FEMENINO', 1, NULL)),
COUNT(IF(edad >= 41 && edad <= 60 && sexo = 'MASCULINO', 1, NULL)),
COUNT(IF(edad >= 41 && edad <= 60 && sexo = 'FEMENINO', 1, NULL)),
COUNT(IF(edad >= 61 && edad <= 80 && sexo = 'MASCULINO', 1, NULL)),
COUNT(IF(edad >= 61 && edad <= 80 && sexo = 'FEMENINO', 1, NULL)),
COUNT(IF(edad >= 81 && sexo = 'MASCULINO', 1, NULL)),
COUNT(IF(edad >= 81 && sexo = 'FEMENINO', 1, NULL))
FROM positivos
WHERE departamento = $depName AND provincia = $provName";
$res=$conn->query($sql);
if($res->num_rows > 0){
  $row= $res->fetch_row();
  for($i=0; $i<5; $i++){
    $data[0][$i]=(int)$row[$i*2];
    $data[1][$i]=(int)$row[$i*2+1];
  }
}
echo json_encode($data);
?>