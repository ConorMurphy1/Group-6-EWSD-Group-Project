<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Page Title</title>
  
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
    <p>Text passage B goes here</p>
  </div>

    
  <div class="container-box d-none" id="containerC">
    <p>Text passage C goes here</p>
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
    const labels = ['2021-08-25', '2021-08-26', '2021-08-27', '2021-08-28', '2021-08-29', '2021-08-30', '2021-08-31'];
    const datapoints = [1,2,3,4,5,6,7]; 
    const data = {
      labels: labels,
      datasets: [{
        label: 'Weekly Sales',
        data: datapoints,
        backgroundColor: [
          'rgba(255, 26, 104, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)',
          'rgba(0, 0, 0, 0.2)'
        ],
        borderColor: [
          'rgba(255, 26, 104, 1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)',
          'rgba(0, 0, 0, 1)'
        ],
        borderWidth: 1
      }]
    };

    // config 
    const config = {
      type: 'bar',
      data,
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    };

    // render init block
    const myChart = new Chart(
      document.getElementById('myChart'),
      config
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
