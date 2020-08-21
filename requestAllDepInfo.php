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
$sql="SELECT departamento, 
COUNT(IF(metododx = 'PCR', 1, NULL)) as 'PCR', 
COUNT(IF(metododx = 'PR', 1, NULL)) as 'PR' 
FROM positivos 
GROUP BY departamento";
$res=$conn->query($sql);
echo "<table class='table table-borderless table-data3' id='provDataTable'>";
echo "<thead>";
echo "<tr>";
echo "<th>Departamento</th>";
echo "<th>PCR</th>";
echo "<th>Prueba Rapida</th>";
echo "<th>Contagiados</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";
$i=0;
if($res->num_rows > 0){
  while($row= $res->fetch_row()){
    $pcr = (int)$row[1];
    $pr = (int)$row[2];
    $total = $pcr + $pr;
    echo "<tr>";
    echo utf8_encode("<td id='Dep$i' style='color: black;'>$row[0]</td>");
    echo "<td id='PCR$i'>$pcr</td>";
    echo "<td id='PR$i'>$pr</td>";
    echo "<td id='Num$i'>$total</td>";
    echo "</tr>";
    $i++;
  }
}
echo "</tbody>";
echo "</table>";