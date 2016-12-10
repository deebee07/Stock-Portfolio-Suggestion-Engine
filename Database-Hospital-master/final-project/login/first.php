<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>\Login Form</title>
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
    
    <link rel="stylesheet" href="css/normalize.css">

    
        <link rel="stylesheet" href="css/boot.css">

    
    
    
  </head>

  <body>

    <div class="form" action="register.php" enctype="multipart/form-data">
      
      
      
        <?php
		include('login.php');
		if(isset($_SESSION['login_user'])){
		header("location: profile.php");
		}
		?>
        <div id="login">   
          <h1>Login Here!!!</h1>
          
          <form action="login.php" method="post">
          
            <div class="field-wrap">
            <label>
              Email Address<span class="req">*</span>
            </label>
            <input type="email" name="email" required autocomplete="off"/>
          </div>
          
          <div class="field-wrap">
            <label>
              Password<span class="req">*</span>
            </label>
            <input type="password" name="password" required autocomplete="off"/>
          </div>
        
          <div class="radio">
		    <input type="radio" name="usertype" value="Patient"  /> Patient
			<input type="radio" name="usertype" value="Employee" style="margin-left:15px;"/> Employee
			
          </div> 
          
          <button name="submit" type="submit" class="button button-block"/>Log In</button>
          
          </form>

        </div>
        
      </div><!-- tab-content -->
      
</div> <!-- /form -->
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

       <script src="js/index.js"></script>   

    
    
    
  </body>
</html>
