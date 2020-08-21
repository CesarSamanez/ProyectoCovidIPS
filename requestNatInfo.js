fetch("requestNatTotal.php")
  .then((response) => response.json())
  .then((data) => {
    document.getElementById("ptotal").innerHTML = data["ptotal"].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    document.getElementById("total").innerHTML = data["total"].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    document.getElementById("totalPCR").innerHTML = data["prueba"]["pcr"].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    document.getElementById("totalPR").innerHTML = data["prueba"]["pr"].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    document.getElementById("totalM").innerHTML = data["sexo"]["m"].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    document.getElementById("totalF").innerHTML = data["sexo"]["f"].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    document.getElementById("actualizadoA").innerHTML = "Actualizado a las 00:00 de " + data["fecha"];
  });

fetch("requestAllDepInfo.php")
  .then((response) => response.text())
  .then((dataTable) => {
    document.getElementById("dataTable").innerHTML = dataTable;
  });

let ageInfo;
let interval = 20;
let iter = 5;
let labels = [];
for (let i = 0; i < iter; i++) {
  labels[i] = "" + (1 + i * interval) + "-" + (i + 1) * interval;
}

fetch("requestNatAgeInfo.php")
  .then((response) => response.json())
  .then((data) => {
    ageInfo = data;
    setGraph();
  });

function setGraph() {
  let ctx = document.getElementById("barChart");
  if (ctx) {
    ctx.height = 200;
    let myChart = new Chart(ctx, {
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

fetch("requestAllProvInfo.php", {
  method: "POST",
  body: JSON.stringify({ depName: "AMAZONAS" }),
})
  .then((response) => response.text())
  .then((provTable) => {
    console.log(provTable);
  });
