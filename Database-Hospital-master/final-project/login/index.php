<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Sign-Up/Login Form</title>



   
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
      <link rel="stylesheet" href="/final-project/boot.css">

    
    
    
  </head>

  <body>
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
            <li><a href="/final-project/login/index.php">Home</a></li>
           <!--  <li><a href="#">Patient Sign Up</a></li> -->
          </ul>
        </div>
      </div>
    </div>
  </div>


      <div class="container">
        <div class="content">
       

    <div action="register.php" enctype="multipart/form-data">
      
     <!--  <ul style="margin-top:20px;" class="tab-group">
        <li class="tab active"><a href="#signup">Sign Up</a></li>
        <li class="tab"><a href="#login">Log In</a></li>
      </ul> -->
      
      <div class="tab-content">
        <div style="width:65%;float:left;"  id="signup">   
          <h1> Patient Sign Up </h1>
          
          <form style="margin-top:8%;" action="register.php" method="post" enctype="multipart/form-data">
          
          <div class="top-row">
            <div class="field-wrap">
              <div style="width:15%;float:left;"><label>
                First Name<span class="req">*</span>
             </label></div>
              <input style="width:35%;margin-bottom:5px;" type="text" name="firstname" required autocomplete="off" />

               
            </div>
        
              <div class="field-wrap">
              <div style="width:15%;float:left;"><label>
                Mid Name<span class="req">*</span>
             </label></div>
              <input style="width:35%;margin-bottom:5px;" type="text" name="midname" />
               
            </div>
          
              
            <div class="field-wrap">
              <div style="width:15%;float:left;"><label>
                Last Name<span class="req">*</span>
             </label></div>
              <input style="width:35%;margin-bottom:5px;" type="text" name="lastname" required autocomplete="off"/>
               
            </div>
          </div>
               <div class="field-wrap">
              <div style="width:15%;float:left;"><label>
                Date of Birth<span class="req">*</span>
             </label></div>
              <input style="width:35%;margin-bottom:5px;" type="date" name="datetime-local" />
               </div>
               <div class="field-wrap">
               <label>
               Sex<span class="req">* &nbsp;</span>
		  </label>
		    <input type="radio" name="gender" value="male"  /> Male
			<input type="radio" name="gender" value="female" style="margin-left:15px;"/> Female
			<input type="radio" name="gender" value="other" style="margin-left:15px;"/> Other
      </label>
      </div>
         
             
        <div class="top-row">
            <div class="field-wrap">
              <div style="width:15%;float:left;"><label>
                St. Address<span class="req">*</span>
              </label></div>
              <input style="width:35%;margin-bottom:5px;" type="text" name="Street_Address" required autocomplete="off" />
              
            </div>
        
              <div class="field-wrap">
              <div style="width:15%;float:left;"><label>
                City<span class="req">*</span>
              </label></div>
              <input style="width:35%;margin-bottom:5px;" type="text" name="city" required autocomplete="off"/>
            </div>
          
              
            <div class="field-wrap">
              <div style="width:15%;float:left;"><label>
                State<span class="req">*</span>
              </label></div>
              <input style="width:35%;margin-bottom:5px;" type="text" name="state" required autocomplete="off"/>
            </div>
          
            <div class="field-wrap" >
              <div style="width:15%;float:left;"><label>
                Country<span class="req">*</span>
              </label></div>
              <input style="width:35%;margin-bottom:5px;" type="text" name="country" required autocomplete="off" />
            </div>
        
              <div class="field-wrap" >
              <div style="width:15%;float:left;"><label>
                Pin Code<span class="req">*</span>
              </label></div>
              <input style="width:35%;margin-bottom:5px;" type="text" name="zipcode" required autocomplete="off"/>
            </div>
          </div>
              
        
          <div class="field-wrap">
            <div style="width:15%;float:left;"><label>
              Email Address<span class="req">*</span>
            </label></div>
            <input style="width:35%;margin-bottom:5px;" type="email" name="email" required autocomplete="off"/>
			
          </div>
          
          <div class="field-wrap">
            <div style="width:15%;float:left;"><label>
              Set A Password<span class="req">*</span>
            </label></div>
            <input style="width:35%;margin-bottom:5px;" type="password" name="password" required autocomplete="off"/>
          </div>
              
           <div class="field-wrap">User Type
		    <input style="margin-left:4%" type="radio" name="usertype" value="Patient"  /> Patient
			<input style="margin-left:4%" type="radio" name="usertype" value="Employee" style="margin-left:15px;"/> Employee
			
          </div> 
        
		  <button style="width:50%;background-color:#393A3D;color:white;margin-top:3px;" type="submit" class="button button-block"/>Get Started</button>
          
          </form>

        </div>
      <div ><img style="margin-left:6%; float:left;margin-top:20px;" src="img/user.png"></div>
        <div style="width:35%;float:left;margin-top:1%;background-color:#99999B" id="login">   
          <div style="margin-left:4%;"><h1>Login</h1>
          
          <form action="login.php" method="post">
          
            <div class="field-wrap">
            <div style="width:34%;float:left;"><label>
              Email Address<span class="req">*</span>
            </label></div>
            <input style="width:60%;margin-bottom:10px;" type="email" name="email" required autocomplete="off"/>
          </div>
          
          <div class="field-wrap">
            <div style="width:34%;float:left;"><label>
              Password<span class="req">*</span>
            </label></div>
            <input style="width:60%;" type="password" name="password" required autocomplete="off"/>
          </div>
          
            <div style="margin-top:10px;" class="field-wrap">User Type:
		    <input style="margin-left:3%" type="radio" name="usertype" value="Patient"  /> Patient
			<input type="radio" name="usertype" value="Employee" style="margin-left:15px;"/> Employee
			
          </div> 
          
          <center><button style="width:50%;background-color:#393A3D;color:white;margin-top:3px;" name="submit" type="submit" class="button button-block"/>Log In</button></center><br/>
          
          </form>
            </div>
        </div>
        
      </div><!-- tab-content -->
      
</div> <!-- /form -->
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

       <script src="js/index.js"></script>   

    
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
