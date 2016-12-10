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

         <?php
     $con = new PDO("mysql:host=localhost;dbname=finalPatientCare","root");
     $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 
     $patient_id = filter_input(INPUT_POST, "patient_id");
 

    $query = "INSERT INTO `VISIT`(`Patient_ID`, `Employee_ID`, `Timestamp`) VALUES (".$patient_id.", (select Employee_ID from EMPLOYEE where EMPLOYEE.Email_Address = '".$username."'), CURRENT_TIMESTAMP)";
   
    $ps = $con->prepare($query);   
    $ps->execute();
      $query1 = "UPDATE PATIENT, EMPLOYEE SET `Dues`= ((EMPLOYEE.Visit_Charge)+(PATIENT.Dues)) where PATIENT.Patient_ID = '".$patient_id."' AND EMPLOYEE.Email_Address = '".$username."'";
  $ps = $con->prepare($query1);   
    $ps->execute();
      
    print "Patient Attended";


?>
</div>



     </div> <br/><a href="logout.php"><button name="logout" style="width: 100%;display: block;" class="button"/>logout</button></a> 
      
   </body>
</html>