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
      
   <a href="profile.php"><button name="doctor" class="button button-doctor"/>Home</button></a>&nbsp;<a href="doctor.php"><button name="doctor" class="button button-doctor"/>Find Doctors</button></a>&nbsp;<a href="PatientHealth.php"><button name="doctor" class="button button-doctor"/>Health Details </button></a>&nbsp;<a href="billing.php"><button name="doctor" class="button button-doctor"/>Billing </button></a> <br><br>
<?php
     $con = new PDO("mysql:host=localhost;dbname=finalPatientCare","root");
     $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 
   
    $query = "SELECT COUNT(VISIT.Employee_ID) as 'Number of visits', PATIENT.Dues as 'Patient Dues', ROOM.Room_Charge as 'Room Charge', TREATMENT.Cost as 'Treatment Cost', (PATIENT.Dues)+(TREATMENT.COST)+(ROOM.Room_Charge) as 'Total' FROM visit, ROOM, TREATMENT, EMPLOYEE, PATIENT, treatment_patient, stay where EMPLOYEE.Employee_ID = VISIT.Employee_ID AND VISIT.Patient_ID = (SELECT Patient_ID FROM PATIENT WHERE PATIENT.Email_Address = '".$username."')  AND  treatment.Treatment_ID= treatment_patient.Treatment_ID AND stay.Room_ID = room.Room_ID AND stay.Patient_ID = PATIENT.Patient_ID AND PATIENT.Patient_ID = treatment_patient.Patient_ID AND PATIENT.Email_Address = '".$username."' GROUP by 'Number of visits'";

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


 $queryEmp = "SELECT EMPLOYEE.FName, VISIT.Timestamp from VISIT, PATIENT, EMPLOYEE where VISIT.Employee_ID = EMPLOYEE.Employee_ID AND VISIT.Patient_ID = PATIENT.Patient_ID AND PATIENT.Email_Address = '".$username."'";

    $ps = $con->prepare($queryEmp);   
    $ps->execute();
    $data = $ps->fetchAll(PDO::FETCH_ASSOC);
    
    print "<table>";
    print "<tr><th colspan='16'>Patient Attended by Doctors</th></tr>";
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
<br/><a href="logout.php"><button name="logout" style="width: 100%;display: block;" class="button"/>logout</button></a> 
          </div>
     </div> 
      
   </body>
</html>