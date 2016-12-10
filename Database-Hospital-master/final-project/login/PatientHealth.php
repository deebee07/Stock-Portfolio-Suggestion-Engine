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

  <body >
     <div class="formfirst">
      
   <a href="profile.php"><button name="doctor" class="button button-doctor"/>Home</button></a>&nbsp;<a href="doctor.php"><button name="doctor" class="button button-doctor"/>Find Doctor</button></a>&nbsp;<a href="PatientHealth.php"><button name="doctor" class="button button-doctor"/>Health Details </button></a>&nbsp;<a href="billing.php"><button name="doctor" class="button button-doctor"/>Billing </button></a> <br><br>
<?php
     $con = new PDO("mysql:host=localhost;dbname=finalPatientCare","root");
     $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 
    

    $query = "select PATIENT.Admit_Date as ' Admit Date ', PATIENT.Discharge_Date as ' Discharge Date ', TREATMENT.Type as ' Treatment Type ', EMPLOYEE.FName as ' Doctor ', RECORD.Reading_Type as ' Reading ', RECORD.Value as ' Reading Value ', room.Room_Type as 'Room Type' from EMPLOYEE, PATIENT, TREATMENT, treatment_patient, stay, RECORD, ROOM where stay.Patient_ID = Patient.Patient_ID AND stay.Room_ID = room.Room_ID AND PATIENT.Main_Doctor = `EMPLOYEE`.`Employee_ID` AND PATIENT.Patient_ID = treatment_patient.Patient_ID AND treatment.Treatment_ID = treatment_patient.Treatment_ID AND stay.Patient_ID = RECORD.Patient_ID AND PATIENT.Patient_ID = RECORD.Patient_ID AND `PATIENT`.`Email_Address` = "."'$username'";
     
    $ps = $con->prepare($query);   
    $ps->execute();
    $data = $ps->fetchAll(PDO::FETCH_ASSOC);
    
    print "<table>";
    print "<tr><th colspan='16'>Health Record of Patient</th></tr>";
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
    


?>
<br><a href="logout.php"><button name="logout" style="width: 100%;display: block;" class="button"/>logout</button></a>
          </div>
     </div> 
      
   </body>
</html>