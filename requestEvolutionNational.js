
xhhtp1 = new XMLHttpRequest();

xhhtp1.onreadystatechange = function () {
  if (this.readyState == 4 && this.status == 200) {
    let data = JSON.parse(this.responseText);
    document.getElementById("actualizadoA").innerHTML = "Actualizado a las 00:00 de " + data["fechas"][0];

    //AUMENTO CONTAGIADOS

     const bd_brandProduct2 = 'rgba(0,181,233,0.9)'
    const bd_brandService2 = 'rgba(0,173,95,0.9)'
    const brandProduct2 = 'rgba(0,181,233,0.2)'
    const brandService2 = 'rgba(0,173,95,0.2)'

    var ctx = document.getElementById("evolucion_nacional");
    if (ctx) {
      ctx.height = 150;
      var myChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: data['fechas'].reverse(),
          datasets: [          
             {
              label: 'Contagiados',
              backgroundColor: brandProduct2,
              borderColor: bd_brandProduct2,
              pointHoverBackgroundColor: '#fff',
              borderWidth: 0,
              data:  data['cantidad'].reverse()
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


        }

      });
    }

     var ctx2 = document.getElementById("aumento_contagiados");
    if (ctx2) {
      ctx2.height = 150;
      var myChart = new Chart(ctx2, { 
        type: 'line',
        data: {
          labels: data['fechas'],
          datasets: [          
             {
              label: 'Aumento diario',
              backgroundColor: brandProduct2,
              borderColor: bd_brandProduct2,
              pointHoverBackgroundColor: '#fff',
              borderWidth: 0,
              data:  data['cantidadDia'].reverse()
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


        }

      });
    }

     //AUMENTO CONTAGIADOS
        var ctx3 = document.getElementById("porcentaje_positividad");
    if (ctx3) {
      ctx3.height = 150;
      var myChart = new Chart(ctx3, {
        type: 'line',
        data: {
          labels: data['fechas'],
          datasets: [          
             {
              label: 'Porcentaje positividad',
              backgroundColor: brandProduct2,
              borderColor: bd_brandProduct2,
              pointHoverBackgroundColor: '#fff',
              borderWidth: 0,
              data: data['porcentaje'].reverse()
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


        }

      });
    }

  console.log(this.responseText);
  }
};

xhhtp1.open("GET", "requestEvolutionNational.php", true);
xhhtp1.send();
