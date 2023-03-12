<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Report Analysis</title>
  
<!-- Bootstrap CSS file -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Bootstrap JavaScript file -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<style>
.container-box {
  border: 1px solid #ccc;
  padding: 10px;
  margin-top: 10px;
}

.d-none {
  display: none;
}


.chartCard {

  display: flex;
  align-items: center;
  justify-content: center;
}
.chartBox {
  width: 700px;
  padding: 20px;
  border-radius: 20px;
  border: solid 3px rgba(54, 162, 235, 1);
  background: white;
}
    

</style>

</head>
<body>
  
<div class="container">
  <div class="form-group">
    <label for="options">Choose an option:</label>
    <select class="form-control" id="options">
      <option value="A">Ideas Per Department</option>
      <option value="B">Ideas Per Department in %</option>
      <option value="C">Num of Contributors Per Department</option>
    </select>
  </div>
  
  <div class="form-group">
    <label for="options">Choose an event:</label>
    <select class="form-control" id="options">
      <option value="A">valentine's day</option>
      <option value="B">B</option>
    </select>
  </div>
  
  <div id="containerA">
    <div class="chartCard">
      <div class="chartBox">
        <canvas id="myChart"></canvas>
        <input type="date" onchange="filterDate()" id="startdate" value="2021-08-25">
        <input type="date" onchange="filterDate()" id="enddate" value="2021-08-31">
      </div>
    </div>
  </div>
  
  <div class="container-box d-none" id="containerB">
    <div class="chartCard">
      <div class="chartBox">
        <canvas id="ideaPerDeptPercent"></canvas>
        <input type="date" onchange="filterDate()" id="startdate" value="2021-08-25">
        <input type="date" onchange="filterDate()" id="enddate" value="2021-08-31">
      </div>
    </div>
  </div>

    
  <div class="container-box d-none" id="containerC">
    <div class="chartCard">
      <div class="chartBox">
        <canvas id="usersPerDept"></canvas>
        <input type="date" onchange="filterDate()" id="startdate" value="2021-08-25">
        <input type="date" onchange="filterDate()" id="enddate" value="2021-08-31">
      </div>
    </div>
  </div>


</div>

<script>
var options = document.getElementById('options');
var containerA = document.getElementById('containerA');
var containerB = document.getElementById('containerB');

options.addEventListener('change', function() {
  if (options.value === 'A') {
    containerA.classList.remove('d-none');
    containerB.classList.add('d-none');
    containerC.classList.add('d-none');
  } 
  else if (options.value === 'B') {
    containerB.classList.remove('d-none');
    containerA.classList.add('d-none');
    containerC.classList.add('d-none');
  }
  else if (options.value === 'C') {
    containerC.classList.remove('d-none');
    containerA.classList.add('d-none');
    containerB.classList.add('d-none');
  }
});

</script>


<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.umd.min.js"></script>

<script>
    // setup 

    function getRandomColor() {
      var min = 1;  // minimum value for each color component
      var max = 256;  // maximum value for each color component
      var red = Math.floor(Math.random() * (max - min) + min);
      var green = Math.floor(Math.random() * (max - min) + min);
      var blue = Math.floor(Math.random() * (max - min) + min);
      return 'rgba(' + red + ',' + green + ',' + blue + ',0.2)';
    }

    var backgroundColors = [];
    var borderColors = [];

    for (var i = 0; i < 9; i++) {
      var color = getRandomColor();
      backgroundColors.push(color);
      borderColors.push(color.replace('0.2', '1'));
    }


    var departments = @json($departmentsArray);

    var ideaCounts = @json($ideaCountArray);

    var idea_Dept_Percentage = @json($idea_Department_Percentage);

    var usersPerDept = @json($usersPerDept);
    
    console.log(usersPerDept);


    const data = {
      labels: departments,
      datasets: [{
        data: ideaCounts,
        backgroundColor: backgroundColors,
        borderColor: borderColors,
        borderWidth: 1
      }]
    };

    // config 
    const config = {
      type: 'bar',
      data,
      options: {
          plugins: {
            legend: {
                display: false // hide the legend
            },
            tooltip: {
              callbacks : {
                label : (context) => {
                  console.log(context.raw)
                  return ` value: ${context.raw.value} , Department : ${context.raw.status}`;
                }
              }
            }
          },
          scales: {
              yAxes: [{
                  ticks: {
                      beginAtZero: true
                  }
              }]
          }
      }
    };

    // config for percentage ideas count per department
    
    const IdeaDeptPercentData = {
      labels: departments,
      datasets: [{
        data: idea_Dept_Percentage,
        backgroundColor: backgroundColors,
        borderColor: borderColors,
        borderWidth: 1
      }]
    };

    // config 
    const Idea_Dept_Percent_config = {
      type: 'bar',
      data: IdeaDeptPercentData,
      options: {
          plugins: {
            legend: {
                display: false // hide the legend
            },
            tooltip: {
              callbacks : {
                label : (context) => {
                  console.log(context.raw)
                  return ` value: ${context.raw.value} , Department : ${context.raw.status}`;
                }
              }
            }
          },
          scales: {
              yAxes: [{
                  ticks: {
                      beginAtZero: true
                  }
              }]
          }
      }
    };

    // Contributors per Department
    
    const contributorsPerDept = {
      labels: departments,
      datasets: [{
        data: usersPerDept,
        backgroundColor: backgroundColors,
        borderColor: borderColors,
        borderWidth: 1
      }]
    };

// config 
  const usersPerDept_config = {
    type: 'bar',
    data: contributorsPerDept, // add the data property here
    options: {
      plugins: {
        legend: {
          display: false // hide the legend
        },
        tooltip: {
          callbacks: {
            label: (context) => {
              console.log(context.raw)
              return ` ${context.raw.value} users uploaded idea from ${context.raw.status} Department`;
            }
          }
        }
      },
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      }
    }
  };





 

    // render init block
    const myChart = new Chart(
      document.getElementById('myChart'),
      config
    );

    const Idea_Dept_Percent = new Chart(
      document.getElementById('ideaPerDeptPercent'),
      Idea_Dept_Percent_config
    );

    const usersPerDeptChart = new Chart(
      document.getElementById('usersPerDept'),
      usersPerDept_config
    );

    // Instantly assign Chart.js version
    const chartVersion = document.getElementById('chartVersion');
    chartVersion.innerText = Chart.version;


    function filterDate() 
    {
      const labels2 = [...labels];
      console.log(labels2);

      const startdata = document.getElementById('startdate');
      const enddate = document.getElementById('enddate');

      //get the index number in array
      const indexstartdate = labels2 .indexOf(startdate.value);
      const indexenddate = labels2 .indexOf(enddate.value);
      // console.log(indexstartdate);

      // slice the array only showing the selected section
      const filterDate = labels2.slice(indexstartdate, indexenddate +1 );

      //replace the labels in the chart
      myChart.config.data.labels = filterDate;

      //datapoints
      const datapoints2 = [...datapoints];
      const filterDatapoints = datapoints2.slice(indexstartdate, indexenddate +1 ); 
      myChart.config.data.datasets[0].data = filterDatapoints;

     myChart.update();

      
    }
    
    </script>



  
</body>
</html>
