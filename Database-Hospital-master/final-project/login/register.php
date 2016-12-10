<?php

 if($_SERVER["REQUEST_METHOD"] == "POST") {
	 
     $con = new PDO("mysql:host=localhost;dbname=finalPatientCare","root");
     $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
     
	 $firstname = filter_input(INPUT_POST, "firstname");
     $midname = filter_input(INPUT_POST, "midname");
	 $lastname = filter_input(INPUT_POST, "lastname");
	 $gender = filter_input(INPUT_POST, "gender");
     $usertype = filter_input(INPUT_POST, "usertype");
     $dateofbirth = filter_input(INPUT_POST, "datetime-local");
     $streetaddress = filter_input(INPUT_POST, "Street_Address");
     $city = filter_input(INPUT_POST, "city");
     $state = filter_input(INPUT_POST, "state");
     $country = filter_input(INPUT_POST, "country");
	 $email = filter_input(INPUT_POST, "email");
	 $password = filter_input(INPUT_POST, "password");
	 $zipcode = filter_input(INPUT_POST, "zipcode");
	 

	 $image = @addslashes(file_get_contents($_FILES['image']['tmp_name']));
	
	
     if($usertype=="Patient"){
     $sql = "
     START TRANSACTION;
INSERT INTO LOGIN (Email, Password, Type)
  VALUES('$email', '$password', '$usertype');
INSERT INTO PATIENT (FName, LName, Date_of_Birth, MidName, Street_Address, City, State, Country, ZIP_Code, Image, Sex, Admit_Date, Discharge_Date, Email_Address, Dues, Treatment_ID, Main_Doctor)
  VALUES ('$firstname', '$lastname', '$dateofbirth', '$midname', '$streetaddress', '$city', '$state', '$country', '$zipcode','$gender', 'null', 'null', '$email', 'null', 'null', 'null');
COMMIT;";
     }else{
     $sql = "
     START TRANSACTION;
INSERT INTO LOGIN (Email, Password, Type)
  VALUES('$email', '$password', '$usertype');
INSERT INTO EMPLOYEE (FName, LName, Date_of_Birth, MidName, Street_Address, City, State, Country, ZIP_Code, Image, Sex, Department, Employee_Type, Email_Address, Visit_Charge)
  VALUES ('$firstname', '$lastname', '$dateofbirth', '$midname', '$streetaddress', '$city', '$state', '$country', '$zipcode','$gender', 'null', 'null', '$email', 'null');
COMMIT;";
        
     }
     
	 $ps = $con->prepare($sql);   
     $ps->execute();
     
	 
	if ($ps) {
    header("location: first.php");
} else{
	header("location: page404.php");
 }

 }
?>