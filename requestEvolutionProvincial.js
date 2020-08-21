let i;
let myChart;
let myChart2;
let depName
let provName
let info;
let fechas;
let cantidadRegional;



    dep = new XMLHttpRequest();
      dep.onreadystatechange = function () {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("combDep").innerHTML = this.responseText;
          }
        };
      dep.open("GET", "requestDepartamentos.php", true);
      dep.send();


function loadPositive() {
  let positive = new XMLHttpRequest();
  positive.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      info =  JSON.parse(this.responseText);
      document.getElementById("actualizadoA").innerHTML = "Actualizado a las 00:00 de " + info["fechas"][28];
      if (!myChart) {
        setGraph();
      } else {
        updateGraph();
      }
    }
  };
  positive.open(
    "GET",
    "requestEvolutionProvincial.php?depname="+depName+"&provname="+provName,
    true
  );
  positive.send();
}

 async function setGraph() {
  const bd_brandProduct2 = 'rgba(0,181,233,0.9)'
    const bd_brandService2 = 'rgba(0,173,95,0.9)'
    const brandProduct2 = 'rgba(0,181,233,0.2)'
    const brandService2 = 'rgba(0,173,95,0.2)'
  ctx = document.getElementById("evolucion_provincial");

  if (ctx) {
     ctx.height = 150;
        myChart = new Chart(ctx, {
          type: 'line',
          data: {
            labels:  info['fechas'],
          datasets: [          
             {
              label: 'Contagiados',
              backgroundColor: brandProduct2,
              borderColor: bd_brandProduct2,
              pointHoverBackgroundColor: '#fff',
              borderWidth: 0,
              data: info['cantidadTotalProvincial']
            }
          ]
        },
       options: {
          maintainAspectRatio: true,
          legend: {
            display: true
          },
          responsive: true,
         
          elements: {
            point: {
              radius: 0,
              hitRadius: 10,
              hoverRadius: 4,
              hoverBorderWidth: 3
            },
            line: {
              tension: 0
            }
          }


        },
        async: false

      });
  }

  ctx2 = document.getElementById("aumento_contagiados_provincial");
  if (ctx2) {
     ctx2.height = 150;
        myChart2 = new Chart(ctx2, {
          type: 'line',
          data: {
            labels:  info['fechas'],
          datasets: [          
             {
              label: 'Aumento de contagiados',
              backgroundColor: brandProduct2,
              borderColor: bd_brandProduct2,
              pointHoverBackgroundColor: '#fff',
              borderWidth: 0,
              data: info['cantidadProvincial']
            }
          ]
        },
       options: {
          maintainAspectRatio: true,
          legend: {
            display: true
          },
          responsive: true,
         
          elements: {
            point: {
              radius: 0,
              hitRadius: 10,
              hoverRadius: 4,
              hoverBorderWidth: 3
            },
            line: {
              tension: 0
            }
          }


        },
        async: false

      });
  }
}

async function loadData() {
      depName = document.getElementById("regionName").value;
      provName = document.getElementById("provinciaName").value;
      loadPositive();
  }



function loadProvincias(){
  prov = new XMLHttpRequest();
  prov.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("combProv").innerHTML = this.responseText;
    }
  };
  depName=document.getElementById("regionName").value;
  prov.open("GET", "requestProvincias.php?depName=" + depName, true);
  prov.send();
}

function updateGraph() {
  removeData();
  console.log("12312321342");
  addData();
  console.log("123123234234234234324");
}

function removeData() {
  myChart.data.datasets.forEach((dataset) => {
    dataset.data = [];
  });
   myChart2.data.datasets.forEach((dataset) => {
    dataset.data = [];
  });

}

function addData() {
 
  myChart.data.datasets.forEach((dataset) => {
    dataset.data = info['cantidadTotalProvincial'];
  });
myChart.update();
  console.log("123123123123123");
   myChart2.data.datasets.forEach((dataset) => {
    dataset.data = info['cantidadProvincial'];   
  });
  
  myChart2.update();

}

loadData();