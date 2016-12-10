<!DOCTYPE HTML>
<html>
  <head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Performance Trend</title>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
 

    <!-- Bootstrap -->
    <link rel="stylesheet" href="/final-project/boot.css">

    <script type="text/javascript">
            /* When the user clicks on the button,
    toggle between hiding and showing the dropdown content */
    function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
    }

    // Close the dropdown menu if the user clicks outside of it
    window.onclick = function(event) {
      if (!event.target.matches('.dropbtn')) {

        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
          var openDropdown = dropdowns[i];
          if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
          }
        }
      }
    }</script>

<?php
     $con = new PDO("mysql:host=localhost;dbname=patientcareanalytical","root");
     $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 
   

$queryD = "SELECT td.month,r.Room_Type, s.Room_charge*s.Ndays as charge FROM patient_dimension p , employee_dimension e , time_dimension td, room_dimension r, stay_fact s WHERE s.Patient_ID = p.Patient_ID and s.Employee_ID = e.Employee_ID and s.Time_ID = td.Time_ID and s.Room_ID = r.Room_ID and r.Room_Type = 'General' GROUP by td.month";


    $ps = $con->prepare($queryD);   
    $ps->execute();
    $data = $ps->fetchAll(PDO::FETCH_ASSOC);
    
   
    $d1 = [];
    foreach ($data as $row) {
    $d1[] =  $row['charge'];
    }
    

?>

<?php
     $con = new PDO("mysql:host=localhost;dbname=patientcareanalytical","root");
     $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 
   

$queryD = "SELECT td.month,r.Room_Type, s.Room_charge*s.Ndays as charge FROM patient_dimension p , employee_dimension e , time_dimension td, room_dimension r, stay_fact s WHERE s.Patient_ID = p.Patient_ID and s.Employee_ID = e.Employee_ID and s.Time_ID = td.Time_ID and s.Room_ID = r.Room_ID and r.Room_Type = 'Semi-Deluxe' GROUP by td.month";


    $ps = $con->prepare($queryD);   
    $ps->execute();
    $data = $ps->fetchAll(PDO::FETCH_ASSOC);
    
   
    $d2 = [];
    foreach ($data as $row) {
    $d2[] =  $row['charge'];
    }
    

?>


<?php
     $con = new PDO("mysql:host=localhost;dbname=patientcareanalytical","root");
     $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 
   

$queryD = "SELECT td.month,r.Room_Type, s.Room_charge*s.Ndays as charge FROM patient_dimension p , employee_dimension e , time_dimension td, room_dimension r, stay_fact s WHERE s.Patient_ID = p.Patient_ID and s.Employee_ID = e.Employee_ID and s.Time_ID = td.Time_ID and s.Room_ID = r.Room_ID and r.Room_Type = 'Deluxe' GROUP by td.month";


    $ps = $con->prepare($queryD);   
    $ps->execute();
    $data = $ps->fetchAll(PDO::FETCH_ASSOC);
    
   
    $d3 = [];
    foreach ($data as $row) {
    $d3[] =  $row['charge'];
    }
    

?>





<script type="text/javascript">
        var l1 = [<?php echo join($d1, ',') ?>]
        var l2 = [<?php echo join($d2, ',') ?>]
        var l3 = [<?php echo join($d3, ',') ?>]
</script>

  


    <script type="text/javascript">
$(function () {
    Highcharts.chart('container1', {
        chart: {
            type: 'spline'
        },
        credits: {
    enabled: false
  },
        title: {
            text: 'Monthly revenue based on room types'
        },
        subtitle: {
            text: 'Source: Analytical Database'
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: 'In Dollars'
            },
            labels: {
                formatter: function () {
                    return this.value;
                }
            }
        },
        tooltip: {
            crosshairs: true,
            shared: true
        },
        plotOptions: {
            spline: {
                marker: {
                    radius: 4,
                    lineColor: '#666666',
                    lineWidth: 1
                }
            }
        },
        series: [{
            name: 'General',
            marker: {
                symbol: 'square'
            },
            data: l1

        }, {
            name: 'Semi-Delux',
            marker: {
                symbol: 'diamond'
            },
            data: l2
        },
        {
            name: 'Delux',
            marker: {
                symbol: 'diamond'
            },
            data: l3
        }]
    });
});
    </script>



<?php
     $con = new PDO("mysql:host=localhost;dbname=patientcareanalytical","root");
     $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 
   

$queryD = "SELECT * FROM `Room_occupancy`";


    $ps = $con->prepare($queryD);   
    $ps->execute();
    $data = $ps->fetchAll(PDO::FETCH_ASSOC);

    $df1 = [];
    $df2 = [];

    foreach ($data as $row) {
    $df1[] =  $row['Room_ID'];
    $df2[] =  $row['Date_time'];
    }
    

?>



<script type="text/javascript">

        var cl1 = [<?php echo '"'.implode('","', $df2).'"' ?>];
        var dd1 = [<?php echo join($df1, ',') ?>];
</script>


    <script type="text/javascript">
$(function () {
    $.getJSON('https://www.highcharts.com/samples/data/jsonp.php?filename=usdeur.json&callback=?', function (data) {

        Highcharts.chart('container', {
            chart: {
                zoomType: 'x'
            },
            title: {
                text: 'Rooms occupied in hospital over time'
            },
            subtitle: {
                text: document.ontouchstart === undefined ?
                        'Click and drag in the plot area to zoom in' : 'Pinch the chart to zoom in'
            },
            credits: {
    enabled: false
  },
            xAxis: {
              categories:cl1

            },
            yAxis: {
                title: {
                    text: 'Rooms Occupied'
                }
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                area: {
                    fillColor: {
                        linearGradient: {
                            x1: 0,
                            y1: 0,
                            x2: 0,
                            y2: 1
                        },
                        stops: [
                            [0, Highcharts.getOptions().colors[0]],
                            [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                        ]
                    },
                    marker: {
                        radius: 2
                    },
                    lineWidth: 1,
                    states: {
                        hover: {
                            lineWidth: 1
                        }
                    },
                    threshold: null
                }
            },

            series: [{
                type: 'area',
                name: 'Patient Room Occupany over time',
                data: dd1
            }]
        });
    });
});
    </script>


</head>

<body>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->

  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>

  <div class="header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6 logo">
          <a href="/">
            <div class="pull-left"><!-- <img src="/static/images/qb_logo.png"> --></div>
            <div class="header-title pull-left vcenter">San Jose State Hospital</div>
          </a>
        </div>
        <div class="col-md-6 menu vcenter">
          <ul>
            <li><a href="/final-project/login/index.php">Employee/Patient Login or Sign Up</a></li>
           <!--  <li><a href="#">Patient Sign Up</a></li> -->
          </ul>
        </div>
      </div>
    </div>
  </div>

 



<div class="container-fluid">
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <h3><b style="color:#008000">Trend of Housing : DRILL DOWN</b></h3>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="row">
      <div class="col-md-12">
        <h4></h3>
      </div>
    </div>

    
    <div class="row">
      <div class="chart"><div id="container1"></div></div>
    </div>
  </div>

  <div class="col-md-6 gutter-fix">
    <div class="row">
      <div class="col-md-12">
        <h4></h3>
      </div>
    </div>
    <div class="row">
      <div class="chart"><div id="container"></div></div>
    </div>
  </div>

</div>
</div>
</div>

<script>
  $(window).on('resize',function() {
   var docHeight = $(window).height();
   var footerHeight = $('#footer').height();
   var footerTop = $('#footer').position().top + footerHeight;

   if (footerTop < docHeight) {
    $('#footer').css('margin-top', -30 + (docHeight - footerTop) + 'px');
   }
  });
  $(document).ready(function() {
      $(window).trigger('resize');
  });
</script>

<div id="footer">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
          <div>Send feedback to contact@sanjosehospital.com</div>
          <a href="#">Report Issues</a>
      </div>
    </div>
  </div>
</div>
</body>
</html>
