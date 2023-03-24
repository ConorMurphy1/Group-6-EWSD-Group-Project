@extends('layouts.app')
@section('content')
    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Statistical Analysis Report for QA Coordinator</title>
        <style>
            * {
                margin: 0;
                padding: 0;
                font-family: sans-serif;
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

        <form method="GET" action="{{ route('reportQACoordinator.index') }}">

         
            @if (!empty($eventName))
                <div class="row" style="font-size: 20px; padding: 10px 0px 20px 20px;">
                    <strong style="color:blue;"> Statistical Analysis Report for {{ $eventName }} (Event)</strong>
                </div>
            @else
                <div class="row" style="font-size: 20px; padding: 10px 0px 20px 20px;">
                    <strong style="color:blue;"> OverView Statistical Analysis Report {{ $eventName }} </strong>
                </div>
            @endif


            <div class="form-group">
                <label for="options">Choose an event:</label>
                <select class="form-control" id="event-select" style="max-width: 800px;">
                    <option value="">Select Event to export</option>
                    @foreach (\App\Models\Event::all() as $event)
                        @if ($event->end_date < today())
                            <option value="{{ $event->id }}">{{ $event->name }} (Finished Event)</option>
                        @else
                            <option value="{{ $event->id }}">{{ $event->name }} (Active Event)</option>
                        @endif
                    @endforeach
                </select>
                <input type="hidden" id="selected-event" value="" name="event">
                <br>
                <button class="btn btn-primary" type="submit" title="Filter Event" style="display:block;">Filter</button>

            </div>
        </form>

        <div class="row" style="font-size: 20px; padding: 10px 0px 20px 20px;">
            <strong>Total {{ $staffCount }} Staff Users from {{ $department_name }} Departments : </strong>
        </div>

        <div class="row">
            <div class="col-md-6" style="margin-bottom: 30px;">
                <div class="chartCard">
                    <div class="chartBox">
                        <span><strong>Anonymous Post Upload Indicator</strong></span>
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="chartCard" style="margin-bottom: 30px;">
                    <div class="chartBox">
                        <span><strong>Total Comments Participants: </strong></span>
                        <canvas id="myChart1"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6" style="margin-bottom: 30px;">
                <div class="chartCard">
                    <div class="chartBox">
                        <span><strong>Active Participants in the event</strong></span>
                        <canvas id="myChart2"></canvas>
                    </div>
                </div>
            </div>

        </div>


        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.umd.min.js"></script>
        <script>
            function getRandomColor() {
                var min = 1; // minimum value for each color component
                var max = 256; // maximum value for each color component
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

            // setup 
            const data = {
                labels: ['Mon', 'Tue', 'Wed'],
                datasets: [{
                    label: 'Weekly Sales',
                    data: [40, 30, 30],
                    backgroundColor: [
                        'rgba(255, 26, 104, 1)', //red
                        'rgba(255, 206, 86, 1)', //yellow
                        'rgba(75, 192, 192, 1)' //green
                    ],
                    needleValue: {{ $percentageAnonymous }},
                    borderColor: 'white',
                    borderWidth: 2,
                    cutout: '95%',
                    circumference: 180,
                    rotation: 270,
                    borderRadius: 5
                }]
            };

            //gaugeNeedle block 
            const gaugeNeedle = {

                id: 'gagueNeedle',
                afterDatasetDraw(chart, args, options) {
                    const {
                        ctx,
                        config,
                        data,
                        chartArea: {
                            top,
                            bottom,
                            left,
                            right,
                            width,
                            height
                        }
                    } = chart;
                    ctx.save();

                    const needleValue = data.datasets[0].needleValue;
                    const dataTotal = data.datasets[0].data.reduce((a, b) => a + b, 0);
                    const angle = Math.PI + (1 / dataTotal * needleValue * Math.PI);
                    const cx = width / 2;
                    const cy = chart._metasets[0].data[0].y;
                    let lineLength;

                    if (window.innerWidth > 1024) {
                        lineLength = height - (ctx.canvas.offsetTop + 230);
                    } else if (window.innerWidth > 768) {
                        lineLength = height - (ctx.canvas.offsetTop + 130);
                    } else if (window.innerWidth > 425) {
                        lineLength = height - (ctx.canvas.offsetTop + 300);
                    } else {
                        lineLength = height - (ctx.canvas.offsetTop + 160);
                    }
                    console.log(ctx.canvas.offsetTop);

                    //needle
                    ctx.translate(cx, cy);
                    ctx.rotate(angle);
                    ctx.beginPath();
                    ctx.moveTo(0, -2);
                    ctx.lineTo(lineLength, 0);
                    ctx.lineTo(0, 2);
                    ctx.fillStyle = '#444';
                    ctx.fill();
                    //needle dot
                    ctx.translate(-cx, -cy);
                    ctx.beginPath();
                    ctx.arc(cx, cy, 5, 0, 10);
                    ctx.fill();
                    ctx.restore();

                    ctx.font = '50px Helvetica';
                    ctx.fillStyle = '#444';
                    ctx.fillText(needleValue + '%', cx, cy + 50);
                    ctx.textAlign = 'center';
                }
            };
            // config 
            const config = {
                type: 'doughnut',
                data,
                options: {
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            yAlign: 'bottom',
                            displayColors: false,
                            callbacks: {
                                label: function(tooltipItem, data) {
                                    const tracker = tooltipItem.dataset.needleValue;
                                    return `Tracker Score: ${tracker}%`;
                                },
                                title: function() {
                                    return '';
                                }
                            }
                        }
                    }
                },
                plugins: [gaugeNeedle]
            };

            // render init block
            const myChart = new Chart(
                document.getElementById('myChart'),
                config
            );

            // Instantly assign Chart.js version
            const chartVersion = document.getElementById('chartVersion');
            chartVersion.innerText = Chart.version;
        </script>


        <script>
            // setup
            const data1 = {
                labels: ['Staff Not Comment', 'Comment Staff'],
                datasets: [{
                    data: [{{ $percentageNotCommentingUsers }}, {{ $percentageCommentingUsers }}],
                    backgroundColor: backgroundColors,
                    borderColor: borderColors,
                    borderWidth: 1
                }]
            };

            // config
            const config1 = {
                type: 'pie',
                data: data1,
                options: {
                    plugins: {
                        legend: {
                            display: true
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            };


            // render init block
            const myChart1 = new Chart(
                document.getElementById('myChart1'),
                config1
            );
        </script>

        <script>
            // setup
            const data2 = {
                labels: ['Staff Posting Ideas', 'Staff Not Posting Ideas'],
                datasets: [{

                    data: [{{ $staffNotPostingIdeas }}, {{ $staffWithPostsCount }}],
                    backgroundColor: backgroundColors,
                    borderColor: borderColors,
                    borderWidth: 1
                }]
            };

            // config
            const config2 = {
                type: 'doughnut',
                data: data2,
                options: {
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            };

            // render init block
            const myChart2 = new Chart(
                document.getElementById('myChart2'),
                config2
            );
        </script>

        <script>
            document.getElementById('event-select').addEventListener('change', function() {
                document.getElementById('selected-event').value = this.value;
            });
        </script>

    </body>

    </html>
@endsection