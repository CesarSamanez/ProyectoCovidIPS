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
$sql="SELECT COUNT(uuid) total FROM positivos";
$res=$conn->query($sql);
if($res->num_rows > 0){
  while($row= $res->fetch_assoc()){
    echo $row["total"];
  }
}
$sql="SELECT DISTINCT(departamento) FROM positivos";
$res=$conn->query($sql);
if($res->num_rows > 0){
  while($row= $res->fetch_assoc()){
    $depnom=$row["departamento"];
    $sql="SELECT COUNT(uuid) total FROM positivos WHERE departamento='$depnom'";
    echo $depnom." ";
    $depcant=$conn->query($sql);
    if($depcant->num_rows > 0){
      $num=$depcant->fetch_assoc();
      echo $num["total"]."<br>";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
  </head>
  <body>
    <p>Hola</p>
  </body>
</html>
