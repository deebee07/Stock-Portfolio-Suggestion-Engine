<?php

    session_start();
    $username= $_SESSION['login_user'];
    $usertype= $_SESSION['login_usertype'];
    
    $email = filter_input(INPUT_POST,"Patient_ID");

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
      
   <a href="profile.php"><button name="doctor" class="button button-doctor"/>Home</button></a>&nbsp;<a href="doctor.php"><button name="doctor" class="button button-doctor"/>Find Doctors</button></a>&nbsp;<a href="PatientInfoForEmploye.php"><button name="doctor" class="button button-doctor"/>Patients Info </button></a>&nbsp;<a href="PatientVisit.php"><button name="doctor" class="button button-doctor"/>Patients Visit </button></a> 
<?php
     $con = new PDO("mysql:host=localhost;dbname=finalPatientCare","root");
     $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 
    
    $query = "select PATIENT.Patient_ID as 'Patient ID', PATIENT.Date_of_Birth as 'Birth Date', treatment.Type as 'Type of Treatment', (Admit_Date) as 'Admit Date', Discharge_Date as 'Discharge Date', TIMESTAMPDIFF(DAY, Admit_Date, Discharge_Date) as 'Number Of Days'from PATIENT, treatment, treatment_patient, EMPLOYEE where Patient.Patient_ID = treatment_patient.Patient_ID AND treatment_patient.Treatment_ID = treatment.Treatment_ID AND PATIENT.Main_Doctor = `EMPLOYEE`.`Employee_ID` AND `EMPLOYEE`.`Email_Address` = "."'$username'"." ORDER BY `Number Of Days` DESC";
   
     
    $ps = $con->prepare($query);   
    $ps->execute();
    $data = $ps->fetchAll(PDO::FETCH_ASSOC);
    
    print "<table>";
    print "<tr><th colspan='16'>Number of Days spent by patient in Hospital</th></tr>";
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
    print "</tr>";
    }
    print "</table>";
    


?><br/><a href="logout.php"><button name="logout" style="width: 100%;display: block;" class="button"/>logout</button></a> 
          </div>
     </div> 
      
   </body>
</html>