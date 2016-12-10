<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">



  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Stock Engine</title>

  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/final-project/boot.css">


  <!-- Bootstrap -->

</head>



<body>
  <div class="header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6 logo">
          <a href="/">
            <div class="pull-left"><!-- <img src="/static/images/qb_logo.png"> --></div>
            <div class="header-title pull-left vcenter">Stock Engine</div>
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
<div class="container">
  <div class="content">
    <div class="selection center-block">
      <div class="row">


        <div class="col-sm-3">
          <div class="row"><a href="fact-finance.php"><img class="center-block" src="/final-project/img/hospital-finance.jpg" height="250" width="250"></a></div>
          <div class="row"><h4 class="text-center"><a href="fact-finance.php" style="color:#6b6c72;" > Visit Finance</a></h4></div>
        </div>

        <div class="col-sm-3">
          <div class="row center-block"><a href="fact-housing.php"><img class="center-block" src="/final-project/img/hospital-house.png" height="250" width="250"><a></div>
          <div class="row"><h4 class="text-center"><a href="fact-housing.php" style="color:#6b6c72;">Housing</a></h4></div>
        </div>

        <div class="col-sm-3">
          <div class="row center-block"><a href="fact-alert.php"><img class="center-block" src="/final-project/img/hospital-alert.jpeg" height="250" width="250"></a></div>
          <div class="row"><h4 class="text-center"><a href="fact-alert.php" style="color:#6b6c72;">Alerts</a></h4></div>
        </div>

        <div class="col-sm-3">
          <div class="row center-block"><a href="fact-facts.php"><img class="center-block" src="/final-project/img/hospital-facts.png" height="250" width="250"></a></div>
          <div class="row"><h4 class="text-center"><a href="fact-facts.php" style="color:#6b6c72;">Health Facts</a></h4></div>
        </div>


      </div>
  </div>
</div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->

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

