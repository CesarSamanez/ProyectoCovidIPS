<?php
$servername = "localhost";
$username = "test";
$password = "EkMGdb5c";
$dbname = "data";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$depName=$_GET["depName"];
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
ini_set('display_errors', 1);
$sql="SELECT DISTINCT(provincia) FROM positivos WHERE departamento=$depName ORDER BY provincia";
$res=$conn->query($sql);

$i=0;
if($res->num_rows > 0){
  echo "<select name='provincia' id='provinciaName' onchange='loadData()'>";
  
  while($row= $res->fetch_row()){
    echo utf8_encode("<option value=\"'$row[0]'\">$row[0]</option>");
    $i++;
  }
  echo "<option value='provincia'>Todos</option>";
  echo "</select>";
}

?>