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
   <a href="profile.php"><button name="doctor" class="button button-doctor"/>Home</button></a>&nbsp;<a href="doctor.php"><button name="doctor" class="button button-doctor"/>Find Doctor</button></a>
    <?php 
if($usertype=="Employee"){
print "<a href='PatientInfoForEmploye.php'><button name='doctor' class='button button-doctor'/>Patient Info</button></a>&nbsp;<a href='PatientVisit.php'><button name='doctor' class='button button-doctor'/>Patients Visit </button></a>";

}
else{
print "<a href='PatientHealth.php'><button name='doctor' class='button button-doctor'/>Health Details</button></a>";
print "&nbsp;<a href='billing.php'><button name='doctor' class='button button-doctor'/>Billing </button></a>";
}
 ?>
<?php

    try{
    $con = new PDO("mysql:host=localhost;dbname=finalPatientCare","root");
    $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 
    if($usertype=="Patient"){ 
    $img = "user.png";
    $query = "select * from PATIENT where Email_Address=:user";
    }else{
    $img = "doctor.png";
    $query = "select * from Employee where Email_Address=:user";
    }
    $ps = $con->prepare($query);
    $ps->bindParam(':user', $username); 
    $ps->execute();
    $data = $ps->fetchAll(PDO::FETCH_ASSOC);
        
    print "<div>";
    
    print "<div style='width:30%;height:50%;float:left;margin-top:2%;'>";
    print "<img style='margin-left:6%; float:left;margin-top:20px;height:250px' src='img/".$img."'>";
    print "</div>";
    foreach ($data as $row) {
    print "<div style='height:80%;width:70%;float:left;margin-top:2%;color: rgba(255, 255, 255, 0.5);font-size: 22px;'>";
    
    print "Name: ".$row['FName']."   ".$row['MidName']."   ".$row['LName']."<br/>";
    print "Country: ".$row['Country']."<br/>";
    print "Date of Birth: ".$row['Date_of_Birth']."<br/>";
    print "State/Province/County: ".$row['State']."<br/>";
    print "Street Address: ".$row['Street_Address']."<br/>";
    print "City: ".$row['City']."<br/>";
    print "State/Province/County: ".$row['State']."<br/>";
    print "Zip/Postal Code: ".$row['ZIP_Code']."<br/>";
    print "Email Address: ".$row['Email_Address']."<br/><br/>";
    print "</div>";
    }
    print "</div>";    
   /* 
    print "<table border='1' width=95%>";
    print "<tr><th colspan='12'>Patient Information</th></tr>";
    foreach ($data as $row) {
    print "<tr>";
    foreach ($row as $name => $value) {
    print "<th>$name</th>";
    }
    
    print "</tr><br>";
    print "<tr>";
    foreach ($row as $name => $value) {
        
        if($name == "Image"){
            print "<td><img height=42 width=42 src=data:image/jpeg;base64,".base64_encode( $value )." /></td>";
        } else {
            print "<td>$value</td>";
        }
    }
    //print "<td><button  />Edit</button></td>";
    print "</tr>";
    
    }
    print "</table>";
     */   }
        
    catch(PDOException $ex) {
                echo 'ERROR: '.$ex->getMessage();
            } 
     
    
    
?>
  
 <a href="logout.php"><button name="logout" class="button button-blocklogout"/>logout</button></a> 
  
  
  
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

       <script src="js/index.js"></script>   

    
    
    
  </body>
</html>