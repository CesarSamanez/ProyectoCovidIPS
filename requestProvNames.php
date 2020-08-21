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
$sql="SELECT DISTINCT(provincia) FROM positivos WHERE departamento='$depName'";
$res=$conn->query($sql);
echo "<table class='table table-borderless table-data3' id='provDataTable'>";
echo "<thead>";
echo "<tr>";
echo "<th>Provincia</th>";
echo "<th>PCR</th>";
echo "<th>Prueba Rapida</th>";
echo "<th>Contagiados</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";
$i=0;
if($res->num_rows > 0){
  while($row= $res->fetch_row()){
    echo "<tr>";
    echo utf8_encode("<td id='Prov$i'>$row[0]</td>");
    echo "<td id='PCR$i'>Cargando...</td>";
    echo "<td id='PR$i'>Cargando...</td>";
    echo "<td id='Num$i'>Cargando...</td>";
    echo "</tr>";
    $i++;
  }
}
echo "</tbody>";
echo "</table>";
?>