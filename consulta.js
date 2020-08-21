let i;
let depName;
let provName;
let distName;
let sexo;
let prueba;

depsRq = new XMLHttpRequest();
depsRq.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("combDep").innerHTML = this.responseText;
    }
  };
depsRq.open("GET", "requestDepartamentos.php", true);
depsRq.send();


function loadProvincias(){
  provsRq = new XMLHttpRequest();
  provsRq.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("combProv").innerHTML = this.responseText;
    }
  };
  depName=document.getElementById("regionName").value;
  provsRq.open("GET", "requestProvincias.php?depName=" + depName, true);
  provsRq.send();
}

function loadData() {
  distRq = new XMLHttpRequest();
  distRq.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("combDist").innerHTML = this.responseText;
    }
  };
  depName=document.getElementById("regionName").value;
  provName=document.getElementById("provinciaName").value;

  distRq.open("GET", "requestListDistritos.php?depName=" + depName + "&provName=" + provName, true);
  distRq.send();  
  
}

async function makeQuery(){
  let infoRq = new XMLHttpRequest();
  infoRq.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      let data = JSON.parse(this.responseText);
      document.getElementById("total").innerHTML = data["total"];
      document.getElementById("actualizadoA").innerHTML = "Actualizado a las 00:00 de " + data["fecha"];
    }
  };

  depName=document.getElementById("regionName").value;
  provName=document.getElementById("provinciaName").value;
  distName=document.getElementById("distritoName").value;
  sexo=document.getElementById("sexo").value;
  prueba=document.getElementById("prueba").value;
  lowage=document.getElementById("low").value;
  highage=document.getElementById("high").value;

  infoRq.open("GET", 
  "consulta.php?depName=" + depName + 
  "&provName=" + provName + 
  "&distName=" + distName + 
  "&sexo=" + sexo + 
  "&prueba=" + prueba +
  "&low=" + lowage +
  "&high=" + highage
  , true);
  infoRq.send();
}