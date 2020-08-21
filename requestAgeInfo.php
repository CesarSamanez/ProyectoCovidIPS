<?php
$servername = "localhost";
$username = "test";
$password = "EkMGdb5c";
$dbname = "data";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$column=$_GET["column"];
$name=$_GET["name"];
$interval=$_GET["interval"];
$iter=$_GET["iter"];
switch ($column) {
    case '0':
        $sql=$conn->prepare("SELECT COUNT(uuid) FROM positivos WHERE edad BETWEEN ? AND ? AND sexo = ?");
        $sql->bind_param("iis", $lower, $upper, $sexo);
        break;
    case '1':
        $sql=$conn->prepare("SELECT COUNT(uuid) FROM positivos WHERE departamento=? AND edad BETWEEN ? AND ? AND sexo=?");
        $sql->bind_param("siis", $name, $lower, $upper, $sexo);
        break;
    case '2':
        $sql=$conn->prepare("SELECT COUNT(uuid) FROM positivos WHERE provincia=? AND edad BETWEEN ? AND ? AND sexo=?");
        $sql->bind_param("siis", $name, $lower, $upper, $sexo);
        break;
    default:
        echo "Opcion incorrecta";
        break;
}
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
ini_set('display_errors', 1);

for($i=0; $i<$iter; $i++){
    $lower=1+($i*$interval);
    $upper=($i+1)*$interval;
    $sexo="masculino";
    $sql->execute();
    
    $res=$sql->get_result();
    if(!$res){
        trigger_error('Invalid query: ' . $sql->error);
    }else{
        if($res->num_rows >0){
            $row=$res->fetch_row();
            $data[0][$i]=$row[0];
        }
        $sexo="femenino";
        $sql->execute();
        $res=$sql->get_result();
        if($res->num_rows >0){
            $row=$res->fetch_row();
            $data[1][$i]=$row[0];
        }
    }
}
echo json_encode($data);
?>