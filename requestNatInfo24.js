xhhtp1 = new XMLHttpRequest();
let i;
xhhtp1.onreadystatechange = function () {
  if (this.readyState == 4 && this.status == 200) {
    let data = JSON.parse(this.responseText);
    document.getElementById("ptotal").innerHTML = data["totalHOY"];
    document.getElementById("total").innerHTML = data["totalPOS"];
    document.getElementById("totalPCR").innerHTML = data["totalPCR"];
    document.getElementById("totalPR").innerHTML = data["totalPR"];
    document.getElementById("totalM").innerHTML = data["totalM"];
    document.getElementById("totalF").innerHTML = data["totalF"];
	let total=data["depat"];
	let table="";
	let table2="";
	for(i=0;i<total;i++){
		table+="<tr><td style='color: black;'>";
		table+=data["depaHOY"][i][0];
		table+="</td><td>"
		table+=data["depaHOY"][i][2];
		table+="</td><td>";
		table+=data["depaHOY"][i][1];
		table+="</td><td>";
		table+=data["depaHOY"][i][3];
		table+="</td></tr>";
		
	}
	document.getElementById("contentTable").innerHTML=table;
	
	
    console.log(this.responseText);
  }
};

xhhtp1.open("GET", "situacion_24_nacional_hoy.php", true);
xhhtp1.send();