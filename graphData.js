let ageRq = new XMLHttpRequest();
let ageInfo;
let interval = 20;
let iter = 5;
let labels = [];
for (let i = 0; i < iter; i++) {
  labels[i] = "" + (1 + i * interval) + "-" + (i + 1) * interval;
}
ageRq.onreadystatechange = function () {
  if (this.readyState == 4 && this.status == 200) {
    ageInfo = JSON.parse(this.responseText);
    setGraph();
  }
};
ageRq.open(
  "GET",
  "requestAgeInfo.php?column=0&interval=" + interval + "&iter=" + iter,
  true
);
ageRq.send();
function setGraph() {
  var ctx = document.getElementById("barChart");
  if (ctx) {
    ctx.height = 200;
    var myChart = new Chart(ctx, {
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
