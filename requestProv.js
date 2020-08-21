let i;
let provNum;
let depName;
let provName;

let ageChart;
let ageInfo;
let interval = 20;
let iter = 5;
let labels = [];


depsRq = new XMLHttpRequest();
depsRq.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("combDep").innerHTML = this.responseText;
      loadProvincias();
      loadAgeData();
    }
  };
depsRq.open("GET", "requestDepartamentos.php", true);
depsRq.send();

for (let i = 0; i < iter; i++) {
  labels[i] = "" + (1 + i * interval) + "-" + (i + 1) * interval;
}

function getProvTotal() {
  let provRq = new XMLHttpRequest();
  provRq.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      let data = JSON.parse(this.responseText);
      document.getElementById("total").innerHTML = data["total"].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      document.getElementById("totalPCR").innerHTML = data["prueba"]["pcr"].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      document.getElementById("totalPR").innerHTML = data["prueba"]["pr"].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      document.getElementById("totalM").innerHTML = data["sexo"]["m"].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      document.getElementById("totalF").innerHTML = data["sexo"]["f"].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      document.getElementById("actualizadoA").innerHTML = "Actualizado a las 00:00 de " + data["fecha"];
    }
  };
  provRq.open(
    "GET",
    "requestProvNum.php?provname=" + provName + "&total=1&prueba=1&sexo=1&orden=1",
    true
  );
  provRq.send();
}
function getDistNames() {
  distnamesRq = new XMLHttpRequest();
  distnamesRq.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("distTable").innerHTML = this.responseText;
    }
  };
  distnamesRq.open("GET", "requestDistInfo.php?depName="+depName+"&provName=" + provName, true);
  distnamesRq.send();
}

function loadProvincias(){
  namesRq = new XMLHttpRequest();
  namesRq.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("combProv").innerHTML = this.responseText;
      provName = document.getElementById("provinciaName").value;
      getDistNames();
      getProvTotal();
      loadAgeData();
    }
  };
  depName=document.getElementById("regionName").value;
  namesRq.open("GET", "requestProvincias.php?depName=" + depName, true);
  namesRq.send();

}

function loadData() {
  provName = document.getElementById("provinciaName").value;
  getDistNames();
  getProvTotal();
  loadAgeData();
}

function loadAgeData() {
  fetch("requestProvAgeInfo.php", {
    method: "POST",
    body: JSON.stringify({ depName: depName, provName: provName }),
  })
  .then(res => res.json())
  .then(data => {
    ageInfo = data;
    if (!ageChart) {
      setGraph();
    } else {
      updateGraph();
    }
  });
}

function setGraph() {
  ctx = document.getElementById("barChart");
  if (ctx) {
    ctx.height = 200;
    ageChart = new Chart(ctx, {
      type: "bar",
      defaultFontFamily: "Poppins",
      data: {
        datasets: [
          {
            label: "Hombres",
            data: ageInfo[0],
            borderColor: "rgba(0, 123, 255, 0.9)",
            borderWidth: "0",
            backgroundColor: "rgba(0, 123, 255, 0.5)",
            fontFamily: "Poppins",
          },
          {
            label: "Mujeres",
            data: ageInfo[1],
            borderColor: "rgba(255,0,0,0.9)",
            borderWidth: "0",
            backgroundColor: "rgba(255,0,0,0.5)",
            fontFamily: "Poppins",
          },
        ],
      },
      options: {
        legend: {
          position: "top",
          labels: {
            fontFamily: "Poppins",
          },
        },
        scales: {
          xAxes: [
            {
              ticks: {
                fontFamily: "Poppins",
              },
              labels: labels,
            },
          ],
          yAxes: [
            {
              ticks: {
                beginAtZero: true,
                fontFamily: "Poppins",
              },
            },
          ],
        },
      },
    });
  }
}

function updateGraph() {
  ageChart.options.scales.xAxes[0] = {
    ticks: {
      fontFamily: "Poppins",
    },
    labels: labels,
  };
  removeData();
  addData();
}

function removeData() {
  ageChart.data.datasets.forEach((dataset) => {
    dataset.data = [];
  });
}

function addData() {
  let j = 0;
  ageChart.data.datasets.forEach((dataset) => {
    dataset.data = ageInfo[j];
    j++;
  });
  ageChart.update();
}