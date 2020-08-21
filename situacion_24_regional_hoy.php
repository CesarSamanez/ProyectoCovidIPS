<?php

$servername = "localhost";
$username = "test";
$password = "EkMGdb5c";
$dbname = "data";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$reg=$_GET["depname"];
//echo $reg;
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
ini_set('display_errors', 1);


//total positivos
$sql="SELECT COUNT(uuid) total FROM hoy WHERE departamento='$reg'";
$res=$conn->query($sql);
if($res->num_rows > 0){
  while($row= $res->fetch_assoc()){
	$regionPOS=$row["total"];
	$data["regionPOS"]=$regionPOS;
   //echo "\$REGIONPOS -> ".$regionPOS."<br>";
  }
}

//total p rapida hoy
$sql="SELECT COUNT(uuid) tp FROM hoy WHERE metododx='PR' AND departamento='$reg'";
$res=$conn->query($sql);
if($res->num_rows > 0){
  while($row= $res->fetch_assoc()){
	  $regionPR=$row["tp"];
	  $data["regionPR"]=$regionPR;
    //echo "\$totalPR -> ".$regionPR."<br>";
  }
}
//total pruebas oleculars
$sql="SELECT COUNT(uuid) tp FROM hoy WHERE metododx='PCR' AND departamento='$reg'";
$res=$conn->query($sql);
if($res->num_rows > 0){
  while($row= $res->fetch_assoc()){
	  $regionPCR=$row["tp"];
	  $data["regionPCR"]=$regionPCR;
    //echo "\$totalPCR -> ".$regionPCR."<br>";
  }
}
//PRUEBAS HOY VARONES
$sql="SELECT COUNT(uuid) tp FROM hoy WHERE sexo='MASCULINO' AND departamento='$reg'";
$res=$conn->query($sql);
if($res->num_rows > 0){
  while($row= $res->fetch_assoc()){
	  $regionM=$row["tp"];
	  $data["regionM"]=$regionM;
    //echo "\$totalM -> ".$regionM."<br>";
  }
}
//PRUEBAS HOY FEmeni
$sql="SELECT COUNT(uuid) tp FROM hoy WHERE sexo='FEMENINO' AND departamento='$reg'";
$res=$conn->query($sql);
if($res->num_rows > 0){
  while($row= $res->fetch_assoc()){
	  $regionF=$row["tp"];
	  $data["regionF"]=$regionF;
    //echo "\$totalF -> ".$regionF."<br>";
  }
}


//departa
//SELECT COUNT(uuid) FROM `positivos` WHERE departamento='arequipa' AND provincia='arequipa'
$sql="SELECT DISTINCT(provincia) FROM hoy WHERE departamento='$reg' ORDER BY provincia";
$res=$conn->query($sql);
$provHOY=[[]];
$i=0;
if($res->num_rows > 0){
  while($row= $res->fetch_assoc()){
    $pronom=$row["provincia"];
    $sql="SELECT COUNT(uuid) total FROM hoy WHERE departamento='$reg' AND metododx='PR' AND provincia='$pronom'";
	$provHOY[$i][0]=$pronom;
    $depcant=$conn->query($sql);
    if($depcant->num_rows > 0){
      $num=$depcant->fetch_assoc();
	  $proPR=$num["total"];
	  $provHOY[$i][1]=$proPR;
    }
	$sql="SELECT COUNT(uuid) total FROM hoy WHERE departamento='$reg' AND metododx='PCR' AND provincia='$pronom'";
    $depcant=$conn->query($sql);
    if($depcant->num_rows > 0){
      $num=$depcant->fetch_assoc();
      $proPCR=$num["total"];
	  $provHOY[$i][2]=$proPCR;
    }
	$sql="SELECT COUNT(uuid) total FROM hoy WHERE departamento='$reg' AND provincia='$pronom'";
    $depcant=$conn->query($sql);
    if($depcant->num_rows > 0){
      $num=$depcant->fetch_assoc();
      $proT=$num["total"];
	  $provHOY[$i][3]=$proT;
    }
	//correcion tildes
	$mystring = $provHOY[$i][0];
	//1
	$findme = "N INVE";
	$pos = strpos($mystring, $findme);
	if ($pos == 1) {
		$provHOY[$i][0]="EN INVESTIGACIÓN";
	}
	//2
	$findme = "ATEM DEL MAR";
	$pos = strpos($mystring, $findme);
	if ($pos == 1) {
		$provHOY[$i][0]="DATEM DEL MARAÑON";
	}
	//3
	$mystring = $provHOY[$i][0];
	$findme = "ERRE";
	$pos = strpos($mystring, $findme);
	if ($pos == 1) {
		$provHOY[$i][0]="FERREÑAFE";
	}
	//fin correcion
	
	$i++;
  }
}

$data["provHOY"]=$provHOY;
$data["cantprov"]=$i;

//departamento

$sql="SELECT DISTINCT(departamento) FROM hoy ORDER BY departamento";
$depart=$conn->query($sql);
$k=0;
if($depart->num_rows > 0){
	while($fila= $depart->fetch_assoc()){
		$d[$k]=$fila["departamento"];
		$k++;
	}
}

$data["depart"]=$d;
$data["cantdep"]=$k;

/*
echo('<pre>');
var_dump($provHOY);
echo('</pre>');
*/
echo json_encode($data);


?>
