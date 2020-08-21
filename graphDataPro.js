/*
var config = {
			type: 'line',
			data: {
				labels: ['4', '5', '6', '7', '8', '9', '10'],
				datasets: [{
					label: 'Proyeccion Nacional',
					borderColor: "rgba(0, 123, 255, 0.9)",
				borderWidth: "0",
				backgroundColor: "rgba(0, 123, 255, 0.5)",
				fontFamily: "Poppins",
					//backgroundColor: window.chartColors.red,
					//borderColor: window.chartColors.red,
					data: [
						10,
						11,
						12,
						13,
						14,
						15,
						16
					],
					fill: false,
				}]
			},
			options: {
				responsive: true,
				title: {
					display: true,
					text: 'Proyeccion'
				},
				tooltips: {
					mode: 'index',
					intersect: false,
				},
				hover: {
					mode: 'nearest',
					intersect: true
				},
				scales: {
					xAxes: [{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Dias'
						}
					}],
					yAxes: [{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Valor esperado'
						}
					}]
				}
			}
		};



window.onload = function() {
			var ctx = document.getElementById('line2Chart').getContext('2d');
			window.myLine = new Chart(ctx, config);
};


*/




let ageRq = new XMLHttpRequest();
let datapro;
let interval = 20;
let iter = 5;
let labels = [];
for (let i = 0; i < iter; i++) {
  labels[i] = "" + (1 + i * interval) + "-" + (i + 1) * interval;
}
ageRq.onreadystatechange = function () {
  if (this.readyState == 4 && this.status == 200) {
    datapro = JSON.parse(this.responseText);
    setGraph();
  }
};
ageRq.open(
  "GET",
  "proyeccion_nacional.php",
  true
);
ageRq.send();
function setGraph() {
  var ctx = document.getElementById("line2Chart");
  if (ctx) {
    ctx.height = 400;
	ctx.width = 600;
    var myChart = new Chart(ctx, {
      tFamily: "Poppins",
	  type: 'line',
			data: {
				labels: ['1 dia', '2 dias', '3 dias', '4 dias', '5 dias', '6 dias', '7 dias'],
				datasets: [{
					label: 'Proyección Nacional',
					borderColor: "rgba(0, 123, 255, 0.9)",
				borderWidth: "0",
				backgroundColor: "rgba(0, 123, 255, 0.5)",
				fontFamily: "Poppins",
					//backgroundColor: window.chartColors.red,
					//borderColor: window.chartColors.red,
					data: [
						datapro[0],
						datapro[1],
						datapro[2],
						datapro[3],
						datapro[4],
						datapro[5],
						datapro[6]
					],
					fill: false,
				}]
			},
			options: {
				responsive: true,
				title: {
					display: true,
					text: 'Proyección'
				},
				tooltips: {
					mode: 'index',
					intersect: false,
				},
				hover: {
					mode: 'nearest',
					intersect: true
				},
				scales: {
					xAxes: [{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Dias'
						}
					}],
					yAxes: [{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Valor esperado'
						}
					}]
				}
			}
    });
}
 }
