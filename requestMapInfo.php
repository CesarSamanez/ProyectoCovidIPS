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
$sql="SELECT departamento, COUNT(uuid) FROM positivos GROUP BY departamento";
$res=$conn->query($sql);
$i=0;
$data = [];
if($res->num_rows > 0){
    while($row= $res->fetch_row()){
        $data[$i]=[$row[0], (int)$row[1]];
        $i++;
    }
}

echo json_encode($data);
?>

