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


  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <style type="text/css">
#container, #sliders {
    min-width: 310px; 
    max-width: 800px;
    margin: 0 auto;
}
#container {
    height: 400px; 
}
    </style>

    <?php
     $con = new PDO("mysql:host=localhost;dbname=patientcareanalytical","root");
     $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 
   

$queryD = "SELECT e.FName As Doctor, Sum(s.Visit_Charge) as Visit_Fees FROM patient_dimension p , employee_dimension e , time_dimension td, visit_fact s WHERE s.Patient_ID = p.Patient_ID and s.Employee_ID = e.Employee_ID and s.Time_ID = td.Time_ID group by doctor";


    $ps = $con->prepare($queryD);   
    $ps->execute();
    $data = $ps->fetchAll(PDO::FETCH_ASSOC);
    
   
    $f1 = [];
    $f2 = [];
    
    foreach ($data as $row) {
    $f1[] =  $row['Doctor'];
    $f2[] = $row['Visit_Fees'];
   
   
     
    }
    




?>



<script type="text/javascript">
        var l1 = [<?php echo join($f2, ',') ?>]
        var category = [<?php echo '"'.implode('","', $f1).'"' ?>];
</script>

    <script type="text/javascript">
$(function () {
    // Set up the chart
    var chart = new Highcharts.Chart({
        chart: {
            renderTo: 'container',
            type: 'column',
            options3d: {
                enabled: true,
                alpha: 15,
                beta: 15,
                depth: 50,
                viewDistance: 25
            }
        },
        credits: {
    enabled: false
  },
        title: {
            text: 'Doctor salary'
        },
        subtitle: {
            text: 'Source: Analytical Database'
        },

        xAxis: {
            
            categories: category
        },

         yAxis: {
            
            title: 'In US Dollars'
        }
        ,
        plotOptions: {
            column: {
                depth: 25
            }
        },
        series: [{
          name: 'Doctor Names',
            data: l1
        }]
    });






    function showValues() {
        $('#alpha-value').html(chart.options.chart.options3d.alpha);
        $('#beta-value').html(chart.options.chart.options3d.beta);
        $('#depth-value').html(chart.options.chart.options3d.depth);
    }

    // Activate the sliders
    $('#sliders input').on('input change', function () {
        chart.options.chart.options3d[this.id] = this.value;
        showValues();
        chart.redraw(false);
    });

    showValues();
});
    </script>


    <?php
     $con = new PDO("mysql:host=localhost;dbname=patientcareanalytical","root");
     $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 
   

$queryD = "SELECT s.Room_charge*s.Ndays as stay_charge, s.Ndays*e.Visit_Charge as doc_charge FROM patient_dimension p , employee_dimension e , time_dimension td, room_dimension r, stay_fact s WHERE s.Patient_ID = p.Patient_ID and s.Employee_ID = e.Employee_ID and s.Time_ID = td.Time_ID and s.Room_ID = r.Room_ID group by p.Patient_ID";


    $ps = $con->prepare($queryD);   
    $ps->execute();
    $data = $ps->fetchAll(PDO::FETCH_ASSOC);
    
   
    $fff1 = [];
    $fff2 = [];
    $fff3 = [];

    $i=1;
    foreach ($data as $row) {
    $fff1[] =  $row['stay_charge'];
    $fff2[] = $row['doc_charge'];
    $fff3[]=$i;

    $i++;
   
   
     
    }
    
?>




<script type="text/javascript">
var ll1 = [<?php echo join($fff1, ',') ?>]
var ll2 = [<?php echo join($fff2, ',') ?>]
var catt = [<?php echo join($fff3, ',') ?>]


</script>


    <script type="text/javascript">
$(function () {
    Highcharts.chart('container2', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Patient Treatment Analysis'
        },
        xAxis: {
            categories: catt,
            labels:
{
  enabled: false
}
        },
        yAxis: [{
            min: 0,
            title: {
                text: 'Cost of Treatment'
            }
        }, {
            title: {
                text: 'In Dollars'
            },
            opposite: true
        }],
        legend: {
            shadow: false
        },
        tooltip: {
            shared: true
        },
        plotOptions: {
            column: {
                grouping: false,
                shadow: false,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Stay_Charge',
            color: 'rgba(165,170,217,1)',
            data: ll1,
           
           
        }, {
            name: 'Visit_Charge',
            color: 'rgba(126,86,134,.9)',
            data: ll2,
           
       
        }]
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
        <h3><b style="color:#008000">Trend of Visits Cost : ROLL UP</b></h3>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="row">
      <div class="col-md-12">
        
      </div>
    </div>

    
    <div class="row">
      <div class="chart"><div id="container"></div></div>
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
