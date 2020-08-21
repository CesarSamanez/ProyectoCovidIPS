<?php
$servername = "localhost";
$username = "test";
$password = "EkMGdb5c";
$dbname = "data";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$provName=$_GET["provName"];
$depName=$_GET["depName"];
$conn->set_charset("utf8");
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
ini_set('display_errors', 1);
$sql="SELECT DISTINCT(distrito) FROM positivos WHERE departamento=$depName AND provincia=$provName";
$res=$conn->query($sql);
echo "<table class='table table-borderless table-data3' id='distDataTable'>";
echo "<thead>";
echo "<tr>";
echo "<th>Distrito</th>";
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
    echo "<td id='Dist$i'>$row[0] </td>";
    echo "<td id='PCR$i'>Cargando...</td>";
    echo "<td id='PR$i'>Cargando...</td>";
    echo "<td id='Num$i'>Cargando...</td>";
    echo "</tr>";
    $i++;
  }
  echo "</tbody>";
  echo "</table>";
}

?>