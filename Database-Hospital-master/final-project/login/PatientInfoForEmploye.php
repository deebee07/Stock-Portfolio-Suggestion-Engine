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

  <body >
     <div class="formfirst">
   <a href="profile.php"><button name="doctor" class="button button-doctor"/>Home</button></a>&nbsp;<a href="doctor.php"><button name="doctor" class="button button-doctor"/>Find a Doctor</button></a>&nbsp;<a href="PatientInfoForEmploye.php"><button name="doctor" class="button button-doctor"/>Patients Info </button></a>&nbsp;<a href="PatientVisit.php"><button name="doctor" class="button button-doctor"/>Patients Visit </button></a> <br><br>
<?php
     $con = new PDO("mysql:host=localhost;dbname=finalPatientCare","root");
     $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 
    
    $query = "select PATIENT.Patient_ID as 'Patient ID', PATIENT.FName as 'Firstname', PATIENT.LName as 'Lastname', PATIENT.Date_of_Birth as 'Birth Date', PATIENT.Apartment_Num as 'Apt. No.', PATIENT.Street_Address as 'St. Address', PATIENT.City as 'City', PATIENT.State as 'State', PATIENT.Country as Country, PATIENT.ZIP_Code as 'Zip Code' from PATIENT, EMPLOYEE,treatment_patient, treatment where Patient.Patient_ID = treatment_patient.Patient_ID AND treatment_patient.Treatment_ID=treatment.Treatment_ID AND PATIENT.Main_Doctor = `EMPLOYEE`.`Employee_ID` AND `EMPLOYEE`.`Email_Address` = "."'$username'";
  
    $ps = $con->prepare($query);   
    $ps->execute();
    $data = $ps->fetchAll(PDO::FETCH_ASSOC);
    print "<table>";
    print "<tr><th colspan='16'>Patients Information</th></tr>";
    $temp = 0;
    foreach ($data as $row) {
    print "<tr>";
    foreach ($row as $name => $value) {
        if($temp == 0){
          
    print "<th>$name</th>";
        } 
    }  $temp++; 
    print "</tr><br>";
    print "<tr>";
    foreach ($row as $name => $value) {
    print "<td>$value</td>";
    }
        
    print "<td><form action='patientHospitalStay.php' method='post'><button>Show </button></form></td>";
    print "</tr>";
    }
    print "</table>";
    


?>
          </div>

<div>
<div class="formfirst1">
  
<?php
     
    $query = "SELECT P.Patient_ID as 'Patient ID', P.FName as 'First Name', P.LName as 'Last Name',R.Reading_Type as 'Type of Reading', R.Value as 'Reading Value', TIMESTAMPDIFF(YEAR, P.Date_of_Birth, CURRENT_DATE)as 'AGE'  FROM RECORD R, PATIENT P, Employee WHERE P.Main_Doctor = `EMPLOYEE`.`Employee_ID` AND P.Patient_ID = R.Patient_ID AND ((R.Reading_Type = 'Oxygen' and R.Value < 60 ) OR (R.Reading_Type = 'Systolic Blood' and R.Value > 159 ) OR (R.Reading_Type = 'Diastolic Blood' and R.Value > 99 ) OR (R.Reading_Type = 'Heart Rate' and R.Value > 100 ) OR (R.Reading_Type = 'Heart Rate' and R.Value < 60 ) ) AND `EMPLOYEE`.`Email_Address` = "."'$username'";

   
    $ps = $con->prepare($query);   
    $ps->execute();
    $data = $ps->fetchAll(PDO::FETCH_ASSOC);
    print "<table >";
    print "<tr><b><th colspan='16'>Patients that led to Alerts</th></b></tr>";
    $temp = 0;
    foreach ($data as $row) {
    print "<tr>";
    foreach ($row as $name => $value) {
        if($temp == 0){
          
    print "<th>$name</th>";
        } 
    }  $temp++; 
    print "</tr>";
    print "<tr>";
    foreach ($row as $name => $value) {
    print "<td class='alert' style='color:#660000;'>$value</td>";
    }
        
    
    print "</tr>";
    }
    print "</table>";
    
?></div><div class='alert' style="color:#660000; font-size: 25px; float:right; margin-top:-20%;margin-right:15%;"><b><p><center>ALERT!!!</p>URGENT CARE REQUIRED</center> </b></div>
          </div>

     </div> <a href="logout.php"><button name="logout" style="width: 100%;display: block;" class="button"/>logout</button></a> 
      
   </body>
</html>