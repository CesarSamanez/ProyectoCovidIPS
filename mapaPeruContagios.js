let chart;
let data;
let options;
google.charts.load("current", {
  packages: ["geochart"],
  // Note: you will need to get a mapsApiKey for your project.
  // See: https://developers.google.com/chart/interactive/docs/basic_load_libs#load-settings
  mapsApiKey: "AIzaSyBvIw5T0mpPB8briPWqgt0gWdQbeKiB5_Q",
});
google.charts.setOnLoadCallback(drawRegionsMap);

function drawRegionsMap() {
  data = google.visualization.arrayToDataTable([
    ["Departamento", "Contagios"],
    ["AMAZONAS", 0],
    ["ANCASH", 0],
    ["APURÍMAC", 0],
    ["AREQUIPA", 0],
    ["AYACUCHO", 0],
    ["CAJAMARCA", 0],
    ["EL CALLAO", 0] /*errore*/,
    ["CUZCO", 0],
    ["HUÁNUCO", 0],
    ["HUANCAVELICA", 0],
    ["ICA", 0],
    ["JUNÍN", 0],
    ["LA LIBERTAD", 0],
    ["LAMBAYEQUE", 0],
    ["LIMA", 0],
    ["LORETO", 0],
    ["MADRE DE DIOS", 0],
    ["MOQUEGUA", 0],
    ["PASCO", 0],
    ["PIURA", 0],
    ["PUNO", 0],
    ["SAN MARTÍN", 0],
    ["TACNA", 0],
    ["TUMBES", 0],
    ["UCAYALI", 0],
  ]);

  options = {
    region: "PE", // Peru
    resolution: "provinces", //muestre las provincias/departamentos
    colorAxis: { colors: ["green","yellow","orange", "red"] },
    backgroundColor: "#81d4fa",
  };

  chart = new google.visualization.GeoChart(document.getElementById("mapPeru"));

  chart.draw(data, options);
  fetch("requestMapInfo.php")
    .then((response) => {
      return response.json();
    })
    .then((mapData) => {
      mapData = [["Departamento", "Contagios"], ...mapData];
      console.log(mapData);
      for (let dep of mapData) {
        switch (dep[0]) {
          case "APURIMAC":
            dep[0] = "APURÍMAC";
            break;
          case "SAN MARTIN":
            dep[0] = "SAN MARTÍN";
            break;
          case "HUANUCO":
            dep[0] = "HUÁNUCO";
            break;
          case "JUNIN":
            dep[0] = "JUNÍN";
            break;
          case "CUSCO":
            dep[0] = "CUZCO";
            break;
        }
      }
      data = google.visualization.arrayToDataTable(mapData);
      chart.draw(data, options);
    });
  google.visualization.events.addListener(chart, "select", () => {
    let selection = chart.getSelection();
    if (selection.length > 0) {
      console.log(data.getValue(selection[0].row, 0));
      window.open(
        "http://35.222.216.231/situacion_regional.html?depName='" +
          data.getValue(selection[0].row, 0)+"'"
      );
    }
  });
}

function resize() {
  chart = new google.visualization.GeoChart(document.getElementById("mapPeru"));
  options = {
    region: "PE", // Peru
    resolution: "provinces", //muestre las provincias/departamentos
    colorAxis: { colors: ["#00853f", "red"] },
    backgroundColor: "#81d4fa",
  };
  chart.draw(data, options);
}

window.onresize = resize;
