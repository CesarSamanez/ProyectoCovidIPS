let i;
let ageChart;
let provNum;
let depName;
let ageInfo;
let interval = 20;
let iter = 5;
let labels = [];
let column = document.currentScript.getAttribute("col");

for (let i = 0; i < iter; i++) {
  labels[i] = "" + (1 + i * interval) + "-" + (i + 1) * interval;
}

function getDepTotal() {
  let depRq = new XMLHttpRequest();
  depRq.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      let data = JSON.parse(this.responseText);
      document.getElementById("total").innerHTML = data["total"].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      document.getElementById("totalPCR").innerHTML = data["prueba"]["pcr"].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      document.getElementById("totalPR").innerHTML = data["prueba"]["pr"].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      document.getElementById("totalM").innerHTML = data["sexo"]["m"].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      document.getElementById("totalF").innerHTML = data["sexo"]["f"].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      document.getElementById("actualizadoA").innerHTML =
        "Actualizado a las 00:00 de " + data["fecha"];
    }
  };
  depRq.open(
    "GET",
    "requestDepNum.php?depname=" + depName + "&total=1&prueba=1&sexo=1&orden=1",
    true
  );
  depRq.send();
}

function loadAgeData() {
  fetch("requestDepAgeInfo.php", {
    method: "POST",
    body: JSON.stringify({ depName: depName }),
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

async function loadProvincias() {
  depName = document.getElementById("regionName").value;
  fetch("requestAllProvInfo.php", {
    method: "POST",
    body: JSON.stringify({ depName: depName }),
  })
    .then((response) => response.text())
    .then((provTable) => {
      document.getElementById("provTable").innerHTML = provTable;
    });
  getDepTotal();
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
window.onload = () => {
  fetch("requestDepartamentos.php")
    .then((response) => {
      return response.text();
    })
    .then((combo) => {
      document.getElementById("combDep").innerHTML = combo;
      let urlString = window.location.href;
      let url = new URL(urlString);
      let urlName = url.searchParams.get("depName");
      if (urlName) {
        let urlNameNorm = urlName
          .normalize("NFD")
          .replace(/[\u0300-\u036f]/g, "");
        if (urlNameNorm == "CUZCO") urlNameNorm = "CUSCO";
        document.getElementById("regionName").value = urlNameNorm;
      }
      loadProvincias();
    });
};
