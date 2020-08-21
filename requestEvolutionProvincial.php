<?php 
  $conexion=mysqli_connect('localhost','test','EkMGdb5c','data');

 $reg=$_GET["depname"];
 $prov=$_GET["provname"];

  $sql="SELECT fecha,cantidad from pruebas_region WHERE departamento=$reg AND provincia=$prov ORDER BY fecha DESC  ";
  $result=mysqli_query($conexion,$sql) or die ("No puedo realizar la consulta");
  $result2=mysqli_query($conexion,$sql) or die ("No puedo realizar la consulta");

  $i=0;
  while ($array=$result->fetch_array()){
    if($i>28) break;
        $aux=$array['fecha'];
        $fechas[$i]=substr($aux,0,4)."-".substr($aux,4,2)."-".substr($aux,6,2);
        $provinciaTotal[$i]=$array['cantidad'];
        $i++;
    }

  $j=0;
  while ($array2=$result2->fetch_array()){
    if($j>29) break;
        $provinciaTotalAux[$j]=$array2['cantidad']  ;
        $j++;
    }

  for ($i=0; $i<count($provinciaTotalAux)-1 ; $i++) {
    $provinciaDia[$i]=$provinciaTotalAux[$i] - $provinciaTotalAux[$i+1];
    }


    $data["fechas"]=array_reverse($fechas);
    $data["cantidadProvincial"]=array_reverse($provinciaDia);
    $data["cantidadTotalProvincial"]=array_reverse($provinciaTotal);
    echo json_encode($data);

 ?>