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

  $j=0;
  while ($array2=$result2->fetch_array()){
    if($j>29) break;
        $cantidadTotalAux[$j]=$array2['cantidad']  ;
        $j++;
    }

  for ($i=0; $i<count($cantidadTotalAux)-1 ; $i++) {
    $departamentoDia[$i]=$cantidadTotalAux[$i] - $cantidadTotalAux[$i+1];
    }

    $data["fechas"]=array_reverse($fechas);
    $data["cantidadRegional"]=array_reverse($departamentoDia);
   $data["cantidadTotalRegional"]=array_reverse($departamentoTotal);
    echo json_encode($data);

 ?>