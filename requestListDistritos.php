<?php
$servername = "localhost";
$username = "test";
$password = "EkMGdb5c";
$dbname = "data";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$depName=$_GET["depName"];
$provName=$_GET["provName"];
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
ini_set('display_errors', 1);
$sql="SELECT DISTINCT(distrito) FROM positivos WHERE departamento=$depName AND provincia=$provName ORDER BY distrito";
$res=$conn->query($sql);

$i=0;
if($res->num_rows > 0){
  echo "<select name='distrito' id='distritoName'>";
  
  while($row= $res->fetch_row()){
    echo utf8_encode("<option value=\"'$row[0]'\">$row[0]</option>");
    $i++;
  }
  echo "<option value='distrito'>Todos</option>";
  echo "</select>";
}

?>