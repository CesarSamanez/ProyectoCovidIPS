xhhtp1 = new XMLHttpRequest();
let i;
xhhtp1.onreadystatechange = function () {
  if (this.readyState == 4 && this.status == 200) {
    let data = JSON.parse(this.responseText);
    document.getElementById("ptotal").innerHTML = data["ptotal"].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    document.getElementById("total").innerHTML = data["total"].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    document.getElementById("pnuevas").innerHTML = data["pnuevas"].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    document.getElementById("totalnuevas").innerHTML = data["totalnuevas"].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    console.log(data["ptotal"]-data["total"]);
    document.getElementById("actualizadoA").innerHTML = "Actualizado a las 00:00 de " + data["fecha"];
  }
};

xhhtp1.open("GET", "requestMainInfo.php", true);
xhhtp1.send();