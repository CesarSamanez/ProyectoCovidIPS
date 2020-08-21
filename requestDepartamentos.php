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
$sql="SELECT DISTINCT(departamento) FROM positivos ORDER BY departamento";
$res=$conn->query($sql);

$i=0;
if($res->num_rows > 0){
  echo "<select name='select' id='regionName' onchange='loadProvincias()'>";
  
  while($row= $res->fetch_row()){
    echo utf8_encode("<option value=\"'$row[0]'\">$row[0]</option>");
    $i++;
  }
  echo "<option value='departamento'>Todos</option>";
  echo "</select>";
}
?>