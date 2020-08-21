<?php
$servername = "localhost";
$username = "test";
$password = "EkMGdb5c";
$dbname = "data";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
ini_set('display_errors', 1);
//
//total hoy
$fecha_actual = date("d-m-Y");


$datapro=[];
$dataprocant=[];
$dataproval=[];

for($i=0;$i<30;$i++){
	$hoy = date("Y-m-d",strtotime($fecha_actual."- $i days"));
	
	$fecha1="";
	for($k=0;$k<strlen($hoy);$k++){
		$restp = substr($hoy, $k, 1);
		if($restp != '-'){
			$fecha1=$fecha1.$restp;
		}
	}
	
	$sql="SELECT * FROM positivos where fecha_resultado='$fecha1'";
	$res=$conn->query($sql);
	if($res->num_rows==0){
	}else{
		$datapro[0]=$fecha1;
		$index=1;
		$limit=$i+30;
		for($l=$i+1;$l<$limit;++$l){
			$temp=date("Y-m-d",strtotime($fecha_actual."- $l days"));
			$fechatemp="";
			for($k=0;$k<strlen($temp);$k++){
				$restp = substr($temp, $k, 1);
				if($restp != '-'){
					$fechatemp=$fechatemp.$restp;
				}
			}
			$datapro[$index]=$fechatemp;
			$index++;
		}
		$total=0;
		$sql="SELECT COUNT(uuid) total FROM positivos";
		$res=$conn->query($sql);
		if($res->num_rows > 0){
			while($row= $res->fetch_assoc()){
				$total=$row["total"];
			}
		}
		$sum=0;
		for($t=0;$t<30;++$t){
			$varfecha=$datapro[$t];
			$sql="SELECT COUNT(uuid) total FROM positivos WHERE fecha_resultado='$varfecha'";
			$res=$conn->query($sql);
			if($res->num_rows > 0){
			  while($row= $res->fetch_assoc()){
				$dataprocant[$t]=$row["total"];
				$sum+=$row["total"];
			  }
			}
		}
		$totalini=$total-$sum;
		for($s=29;$s>-1;--$s){
			$totalini=$totalini+$dataprocant[$s];
			$dataproval[$s]=$totalini;
		}
		
		break;
	}
}
/*
echo('<pre>');
var_dump($datapro);
echo('</pre>');

echo('<pre>');
var_dump($dataprocant);
echo('</pre>');
*/
$x=[
1,
2,
3,
4,
5,
6,
7,
8,
9,
10,
11,
12,
13,
14,
15,
16,
17,
18,
19,
20,
21,
22,
23,
24,
25,
26,
27,
28,
29,
30

];
$y=[];
$r=0;
for($s=29;$s>-1;--$s){
	$y[$r]=$dataproval[$s];
	$r++;
}
/*for($s=29;$s>-1;--$s){
	echo $dataproval[$s]."<br>";
}*/
/*
$y=[
317782,
320374,
322849,
327746,
331981,
334360,
337455,
341642,
346042,
350553,
355661,
360712,
362933,
366670,
371450,
377405,
382835,
388702,
394286,
397233,
404273,
407282,
413962,
421116,
428322,
434674,
437737,
444813,
451666,
455409


];
$x=[
1,
2,
3,
4,
5,
6,
7,
8,
9,
10,
11,
12,
13,
14,
15,
16,
17,
18,
19,
20,
21,
22,
23,
24,
25,
26,
27,
28,
29,
30

];*/
/*$y=[
10,40,120,300,800,500

];
$x=[
1,
2,
3,
4,
5,
6
];*/
$n=30;
$yp =[];
for($i=0;$i<$n;$i++){
	$yp[$i]=log($y[$i]);
}
$xyp =[];
for($i=0;$i<$n;$i++){
	$xyp[$i]=$x[$i]*$yp[$i];
}
$x2 =[];
for($i=0;$i<$n;$i++){
	$x2[$i]=$x[$i]*$x[$i];
}
$sx=0;
for($i=0;$i<$n;$i++){
	$sx+=$x[$i];
}
$sy=0;
for($i=0;$i<$n;$i++){
	$sy+=$y[$i];
}
$syp=0;
for($i=0;$i<$n;$i++){
	$syp+=$yp[$i];
}

$sxyp=0;
for($i=0;$i<$n;$i++){
	$sxyp+=$xyp[$i];
}

$sx2=0;
for($i=0;$i<$n;$i++){
	$sx2+=$x2[$i];
}

$b=(($n*$sxyp)-($sx*$syp))/(($n*$sx2)-($sx*$sx));
$ap=($syp/$n)-($b*($sx/$n));
$a=pow(2.7182818,$ap);

//echo $a."<br>".$b."<br>";
$value=[];
$k=0;
for($p=31;$p<38;++$p){
	$value[$k]=$a*(pow(2.7182818,$b*$p));
	$k++;
	//cho $value."<br>";
}

$nombre="peru";
$v1=round($value[0]);
$v2=round($value[1]);
$v3=round($value[2]);
$v4=round($value[3]);
$v5=round($value[4]);
$v6=round($value[5]);
$v7=round($value[6]);

$sqlin="TRUNCATE proyeccion";
$in=$conn->query($sqlin);

$sqlin="INSERT INTO proyeccion VALUES('peru','$v1','$v2','$v3','$v4','$v5','$v6','$v7')";
$in=$conn->query($sqlin);	

?>
