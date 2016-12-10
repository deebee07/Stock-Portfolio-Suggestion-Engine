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
   

$queryD = "SELECT rd.Reading_Type, td.month, COUNT(rf.No_of_alerts) as Alert_Count FROM patient_dimension p, time_dimension td, record_dimension rd, record_fact rf WHERE p.Patient_ID = rf.Patient_ID AND rd.Record_ID = rf.Record_ID and rd.Reading_Type = 'Systolic Blood' GROUP BY td.month";


    $ps = $con->prepare($queryD);   
    $ps->execute();
    $data = $ps->fetchAll(PDO::FETCH_ASSOC);
    
   
    $d1 = [];
    foreach ($data as $row) {
    $d1[] =  $row['Alert_Count'];
    }
    

?>

<?php
     $con = new PDO("mysql:host=localhost;dbname=patientcareanalytical","root");
     $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 
   

$queryD = "SELECT rd.Reading_Type, td.month, COUNT(rf.No_of_alerts) as Alert_Count FROM patient_dimension p, time_dimension td, record_dimension rd, record_fact rf WHERE p.Patient_ID = rf.Patient_ID AND rd.Record_ID = rf.Record_ID and rd.Reading_Type = 'Diastolic Blood' GROUP BY td.month";


    $ps = $con->prepare($queryD);   
    $ps->execute();
    $data = $ps->fetchAll(PDO::FETCH_ASSOC);
    
   
    $d2 = [];
    foreach ($data as $row) {
    $d2[] =  $row['Alert_Count'];
    }
    

?>

<?php
     $con = new PDO("mysql:host=localhost;dbname=patientcareanalytical","root");
     $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 
   

$queryD = "SELECT rd.Reading_Type, td.month, COUNT(rf.No_of_alerts) as Alert_Count FROM patient_dimension p, time_dimension td, record_dimension rd, record_fact rf WHERE p.Patient_ID = rf.Patient_ID AND rd.Record_ID = rf.Record_ID and rd.Reading_Type = 'Sugar fasting' GROUP BY td.month";


    $ps = $con->prepare($queryD);   
    $ps->execute();
    $data = $ps->fetchAll(PDO::FETCH_ASSOC);
    
   
    $d3 = [];
    foreach ($data as $row) {
    $d3[] =  $row['Alert_Count'];
    }
    

?>

<?php
     $con = new PDO("mysql:host=localhost;dbname=patientcareanalytical","root");
     $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 
   

$queryD = "SELECT rd.Reading_Type, td.month, COUNT(rf.No_of_alerts) as Alert_Count FROM patient_dimension p, time_dimension td, record_dimension rd, record_fact rf WHERE p.Patient_ID = rf.Patient_ID AND rd.Record_ID = rf.Record_ID and rd.Reading_Type = 'Heart rate' GROUP BY td.month";


    $ps = $con->prepare($queryD);   
    $ps->execute();
    $data = $ps->fetchAll(PDO::FETCH_ASSOC);
    
   
    $d4 = [];
    foreach ($data as $row) {
    $d4[] =  $row['Alert_Count'];
    }
    

?>



<script type="text/javascript">
        var h1 = [<?php echo join($d1, ',') ?>];
        var h2 = [<?php echo join($d2, ',') ?>];
        var h3 = [<?php echo join($d3, ',') ?>];
        var h4 = [<?php echo join($d4, ',') ?>];
      
</script>







        <script type="text/javascript">




$(function () {



$('#container2').highcharts({
        chart: {
            type: 'line',
                        style: {
                                fontFamily: 'Avenir-Bold'
                        },
        },
        credits: {
    enabled: false
  },
        title: {
            text: 'Month-wise analysis of alerts types'
        },
        subtitle: {
            text: 'Source: Analytical Database'
        },
        xAxis: {
            title: {
                text: 'Month'
            },
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: 'Number of Alerts to main doctor'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
        series: [{
            name: 'Systolic Blood',
            color:'#A9E838',
            data: h1
        }, {
            name: 'Diastolic Blood',
            color:'#53B700',
            data: h2
        },
         {
            name: 'Sugar fasting',
            color:'#108000',
            data: h3
        },
        {
            name: 'Heart rate',
            color:'#108000',
            data: h4
}
        ]
    });

});



  </script>

<?php
     $con = new PDO("mysql:host=localhost;dbname=patientcareanalytical","root");
     $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 
   

$queryD = "SELECT p.sex,rd.Reading_Type, sum(rf.No_of_alerts)*-1 as 'Number of Alerts' FROM patient_dimension p, time_dimension td, record_dimension rd, record_fact rf WHERE p.Patient_ID = rf.Patient_ID AND rd.Record_ID = rf.Record_ID AND p.Sex = 'm' GROUP BY rd.Reading_Type";


    $ps = $con->prepare($queryD);   
    $ps->execute();
    $data = $ps->fetchAll(PDO::FETCH_ASSOC);
    
   
    $mm1 = [];
    foreach ($data as $row) {
    $mm1[] =  $row['Number of Alerts'];
    }
    

?>
<?php
     $con = new PDO("mysql:host=localhost;dbname=patientcareanalytical","root");
     $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 
   

$queryD = "SELECT p.sex,rd.Reading_Type, sum(rf.No_of_alerts) as 'Number of Alerts' FROM patient_dimension p, time_dimension td, record_dimension rd, record_fact rf WHERE p.Patient_ID = rf.Patient_ID AND rd.Record_ID = rf.Record_ID AND p.Sex = 'f' GROUP BY rd.Reading_Type";


    $ps = $con->prepare($queryD);   
    $ps->execute();
    $data = $ps->fetchAll(PDO::FETCH_ASSOC);
    
   
    $ff1 = [];
    foreach ($data as $row) {
    $ff1[] =  $row['Number of Alerts'];
    }
    

?>


<script type="text/javascript">
        var mm1 = [<?php echo join($mm1, ',') ?>];
        var ff1 = [<?php echo join($ff1, ',') ?>];
     
      
</script>




<script type="text/javascript">
// Data gathered from http://populationpyramid.net/germany/2015/
$(function () {
    // Age categories
    var categories = ['Diastolic Blood','Heart rate','Sugar fasting','Systolic Blood'  ];
    $(document).ready(function () {
        Highcharts.chart('container1', {
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Gender-wise analysis of alerts'
            },
            subtitle: {
                text: 'Source: Analytical Database'
            },
            credits: {
    enabled: false
  },
            xAxis: [{
                categories: categories,
                reversed: false,
                labels: {
                    step: 1
                }
            }, { // mirror axis on right side
                opposite: true,
                reversed: false,
                categories: categories,
                linkedTo: 0,
                labels: {
                    step: 1
                }
            }],
            yAxis: {
                title: {
                    text: null
                },
                labels: {
                    formatter: function () {
                        return Math.abs(this.value);
                    }
                }
            },

            plotOptions: {
                series: {
                    stacking: 'normal'
                }
            },

            tooltip: {
                formatter: function () {
                    return '<b>' + this.series.name + ', age ' + this.point.category + '</b><br/>' +
                        'Population: ' + Highcharts.numberFormat(Math.abs(this.point.y), 0);
                }
            },

            series: [{
                name: 'Male',
                data: mm1
            }, {
                name: 'Female',
                data: ff1
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
        <h3><b style="color:#008000">Trend of Patient Alerts: SLICE AND DICE</b></h3>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="row">
      <div class="col-md-12">
        
      </div>
    </div>

    
    <div class="row">
      <div class="chart"><div id="container1"></div></div>
    </div>
  </div>

  <div class="col-md-6 gutter-fix">
    <div class="row">
      <div class="col-md-12">
        
      </div>
    </div>
    <div class="row">
      <div class="chart"><div id="container2"></div></div>
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