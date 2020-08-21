<?php
  $conexion=mysqli_connect('localhost','test','EkMGdb5c','data');

  $sql="SELECT fecha,cantidad,contagios from pruebas ORDER BY fecha DESC  ";
  $result=mysqli_query($conexion,$sql) or die ("No puedo realizar la consulta");

  $j=0;
  while ($array=$result->fetch_array()){
    if($j>30) break;
        $contagiosAux[$j]=$array['contagios'];
        $j++;
    }
//
  $sumxy=0;
  $sumx=0;
  $sumx2=0;
  $sumy=0;

  for ($z=1; $z<31; $z++) {
    $sumxy+=$contagiosAux[$z-1]*($z);
    $sumy+=$contagiosAux[$z-1];
    $sumx+=$z;
    $sumx2+=($z*$z);
    $z++;
  }
  $p1=$sumxy*30;
  $p2=$sumx*$sumy;
  $p3=$sumx2*30;
  $p4=$sumx*$sumx;

  $m=($p1 - $p2)/($p3 - $p4);
  $b=($sumy/30) - $m*($sumx/30);
//

  for ($i=0; $i<16 ; $i++) {
    $contagiooo[$i]=round($m*(45-$i)+$b);
  }
//
  $doo = 15;
    for($i=0; $i<16;$i++){
      $dias[$i] = $doo;
      $doo--;
    }

  $data["fechas"]= $dias;
  $data["cantidad"]= $contagiooo;


    echo json_encode($data);
 ?>
