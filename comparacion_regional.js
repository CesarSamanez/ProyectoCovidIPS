let i;
let ageChart;
let provNum;
let depName;
let depName2;
let ageInfo;
let interval = 20;
let iter = 5;
let labels = [];
let column = document.currentScript.getAttribute("col");
deps1Rq = new XMLHttpRequest();
deps1Rq.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("combDep1").innerHTML = this.responseText;
      loadData1();
    }
  };

deps1Rq.open("GET", "requestDepartamentosComparacion.php?combo=1", true);
deps1Rq.send();

deps2Rq = new XMLHttpRequest();
deps2Rq.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("combDep2").innerHTML = this.responseText;
      loadData2();
    }
  };

deps2Rq.open("GET", "requestDepartamentosComparacion.php?combo=2", true);
deps2Rq.send();

function getDepTotal() {
  let depRq = new XMLHttpRequest();
  depRq.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      let data = JSON.parse(this.responseText);
      document.getElementById("total").innerHTML = data["total"];
      document.getElementById("totalPCR").innerHTML = data["prueba"]["pcr"];
      document.getElementById("totalPR").innerHTML = data["prueba"]["pr"];
      document.getElementById("totalM").innerHTML = data["sexo"]["m"];
      document.getElementById("totalF").innerHTML = data["sexo"]["f"];
      document.getElementById("actualizadoA").innerHTML = "Actualizado a las 00:00 de " + data["fecha"];
    }
  };
  depRq.open(
    "GET",
    "requestDepNum.php?depname=" + depName + "&total=1&prueba=1&sexo=1&orden=1",
    true
  );
  depRq.send();
}
function getDepTotal2() {
    let depRq2 = new XMLHttpRequest();
    depRq2.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        let data = JSON.parse(this.responseText);
        document.getElementById("total2").innerHTML = data["total"];
        document.getElementById("totalPCR2").innerHTML = data["prueba"]["pcr"];
        document.getElementById("totalPR2").innerHTML = data["prueba"]["pr"];
        document.getElementById("totalM2").innerHTML = data["sexo"]["m"];
        document.getElementById("totalF2").innerHTML = data["sexo"]["f"];
        document.getElementById("actualizadoA").innerHTML = "Actualizado a las 00:00 de " + data["fecha"];
      }
    };
    depRq2.open(
      "GET",
      "requestDepNum.php?depname=" + depName2 + "&total=1&prueba=1&sexo=1&orden=1",
      true
    );
    depRq2.send();
  }

function loadAgeData() {
  let ageRq = new XMLHttpRequest();
  for (let i = 0; i < iter; i++) {
    labels[i] = "" + (1 + i * interval) + "-" + (i + 1) * interval;
  }
  ageRq.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      ageInfo = JSON.parse(this.responseText);
      if (!ageChart) {
        setGraph();
      } else {
        updateGraph();
      }
    }
  };
  ageRq.open(
    "GET",
    "requestAgeInfo.php?column=" +
      column +
      "&name=" +
      depName +
      "&interval=" +
      interval +
      "&iter=" +
      iter,
    true
  );
  ageRq.send();
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

async function loadData1() {
  depName = document.getElementById("regionName1").value;
  getDepTotal();
  loadAgeData();
}
async function loadData2() {
    depName2 = document.getElementById("regionName2").value;
    getDepTotal2();
    loadAgeData();
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

