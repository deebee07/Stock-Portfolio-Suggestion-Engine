<?php

    session_start();
    $username= $_SESSION['login_user'];
    $usertype= $_SESSION['login_usertype'];
?>
<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Patient Profile</title>
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
    
    <link rel="stylesheet" href="css/normalize.css">

    
        <link rel="stylesheet" href="css/boot.css">

    
    
    
  </head>

  <body>
     <div class="formfirst">
   <a href="profile.php"><button name="doctor" class="button button-doctor"/>Home</button></a>&nbsp;<a href="doctor.php"><button name="doctor" class="button button-doctor"/>Find a Doctor</button></a>&nbsp;<a href="PatientInfoForEmploye.php"><button name="doctor" class="button button-doctor"/>Patients Info </button></a>&nbsp;<a href="PatientVisit.php"><button name="doctor" class="button button-doctor"/>Patients Visit </button></a> <br><br>

<form action="visit.php" method="post">
     <div class="field-wrap">
            <label>
              Patient ID<span class="req">*</span>
            </label>
            <input type="text" name="patient_id" required autocomplete="off"/>
          </div>
    <button name="submit" type="submit" class="button button-doctor"/>Submit</button>
</form>
<br/><a href="logout.php"><button name="logout" style="width: 100%;display: block;" class="button"/>logout</button></a> 
</div>



     </div> 
      
   </body>
</html>