<?php
  $conexion=mysqli_connect('localhost','test','EkMGdb5c','data');

  $reg=$_GET["depname"];


  $sql="SELECT fecha,cantidad from pruebas_departamento WHERE departamento='$reg' ORDER BY fecha DESC  ";
  $result=mysqli_query($conexion,$sql) or die ("No puedo realizar la consulta");
  $result2=mysqli_query($conexion,$sql) or die ("No puedo realizar la consulta");

  $i=0;
  while ($array=$result->fetch_array()){
    if($i>28) break;
        $aux=$array['fecha'];
        $fechas[$i]=substr($aux,0,4)."-".substr($aux,4,2)."-".substr($aux,6,2);
        $departamentoTotal[$i]=$array['cantidad'];
        $i++;
    }
//
$doo = 15;
  for($i=0; $i<16;$i++){
    $dias[$i] = $doo;
    $doo--;
  }

$sumxy=0;
$sumx=0;
$sumx2=0;
$sumy=0;
$cont = count($departamentoTotal);
for ($z=1; $z<$cont; $z++) {
 $sumxy+=$departamentoTotal[$z-1]*($z);
 $sumy+=$departamentoTotal[$z-1];
 $sumx+=$z;
 $sumx2+=($z*$z);
 $z++;
}
$p1=$sumxy*$cont;
$p2=$sumx*$sumy;
$p3=$sumx2*$cont;
$p4=$sumx*$sumx;

$m=($p1 - $p2)/($p3 - $p4);
$b=($sumy/$cont) - $m*($sumx/$cont);

for ($i=0; $i<16 ; $i++) {
 $contagiooo[$i]=round($m*($cont+15-$i)+$b);
}

 $data["fechas"]=($fechas);
 $data["dias"]=array_reverse($dias);
 $data["cantidadTotalRegional"]=array_reverse($contagiooo);

    echo json_encode($data);

 ?>
