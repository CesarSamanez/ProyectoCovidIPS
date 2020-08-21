<?php
  $conexion=mysqli_connect('localhost','test','EkMGdb5c','data');

  $sql="SELECT fecha,cantidad,contagios from pruebas ORDER BY fecha DESC  ";
  $result=mysqli_query($conexion,$sql) or die ("No puedo realizar la consulta");
  $result2=mysqli_query($conexion,$sql) or die ("No puedo realizar la consulta");

  $i=0;
  while ($array=$result->fetch_array()){
    if($i>28) break;
        $fechas[$i]=$array['fecha'];
        $cantidad[$i]=$array['cantidad'];
        $contagios[$i]=$array['contagios']  ;
        $i++;
    }

  $j=0;
  while ($array2=$result2->fetch_array()){
    if($j>29) break;
        $contagiosAux[$j]=$array2['contagios']  ;
        $j++;
    }

  for ($i=0; $i<count($contagiosAux)-1 ; $i++) {
    $contagiosDia[$i]=$contagiosAux[$i] - $contagiosAux[$i+1];
    }

  for ($i=0; $i<count($cantidad) ; $i++) {
    $porcentaje[$i]=round((($contagios[$i]/$cantidad[$i])*100), 2);
  }



/*
    $sql2="SELECT contagios from pruebas ORDER BY contagios DESC ";
    $result2=mysqli_query($conexion,$sql2) or die ("No puedo realizar la consulta");


  $j=0;
  while ($array=$result2->fetch_array()){
    if($j>28 ) break;
        $cantidad[$j]=$array['contagios'];
        $j++;
    }
*/




  $data["fechas"]= $fechas;
  $data["cantidad"]= $contagios;
  $data["cantidadDia"]=$contagiosDia;
  $data["porcentaje"]=$porcentaje;

    echo json_encode($data);
 ?>
