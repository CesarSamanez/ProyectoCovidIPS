xhhtp1 = new XMLHttpRequest();
let i;
let j;
let depName="AMAZONAS";
xhhtp1.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      let data = JSON.parse(this.responseText);
      document.getElementById("total").innerHTML = data["regionPOS"];
      document.getElementById("totalPCR").innerHTML = data["regionPCR"];
      document.getElementById("totalPR").innerHTML = data["regionPR"];
      document.getElementById("totalM").innerHTML = data["regionM"];
      document.getElementById("totalF").innerHTML = data["regionF"];
	  let canti=data["cantdep"];
	  let options="";
	  for(i=0;i<canti;i++){
		  options+="<option value='"+data["depart"][i]+"'>"+data["depart"][i]+"</option>";
		}
	document.getElementById("regionName").innerHTML=options;
		let cantip=data["cantprov"];
		let contentp="";
		for(j=0;j<cantip;j++){
			contentp+="<tr><td style='color: black;'>";
			contentp+=data["provHOY"][j][0];
			contentp+="</td><td>"
			contentp+=data["provHOY"][j][2];
			contentp+="</td><td>";
			contentp+=data["provHOY"][j][1];
			contentp+="</td><td>";
			contentp+=data["provHOY"][j][3];
			contentp+="</td></tr>";
		}
		document.getElementById("contentTable").innerHTML=contentp;
		console.log(this.responseText);
	}
  };
  xhhtp1.open("GET","situacion_24_regional_hoy.php?depname=" + depName,true);
  xhhtp1.send();

//
function setData() {
	  
  let depData = new XMLHttpRequest();
  depData.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      let data = JSON.parse(this.responseText);
      document.getElementById("total").innerHTML = data["regionPOS"];
      document.getElementById("totalPCR").innerHTML = data["regionPCR"];
      document.getElementById("totalPR").innerHTML = data["regionPR"];
      document.getElementById("totalM").innerHTML = data["regionM"];
      document.getElementById("totalF").innerHTML = data["regionF"];
	  let cantip=data["cantprov"];
		let contentp="";
		for(j=0;j<cantip;j++){
			contentp+="<tr><td style='color: black;'>";
			contentp+=data["provHOY"][j][0];
			contentp+="</td><td>"
			contentp+=data["provHOY"][j][2];
			contentp+="</td><td>";
			contentp+=data["provHOY"][j][1];
			contentp+="</td><td>";
			contentp+=data["provHOY"][j][3];
			contentp+="</td></tr>";
		}
		document.getElementById("contentTable").innerHTML=contentp;
    }
  };
  depData.open("GET","situacion_24_regional_hoy.php?depname=" + depName,true);
  depData.send();
}
//

function loadData() {
  depName = document.getElementById("regionName").value;
  setData();
}
