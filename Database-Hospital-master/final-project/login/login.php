<?php
 session_start();
 $error='';
 if(isset($_POST['submit'])){
	 if(empty($_POST['email'])||empty($_POST['password'])||empty($_POST['usertype'])){
		 $error = "Wrong email/password or Choose right User type";
         echo $error;
	 }
	 else{
		$email = filter_input(INPUT_POST,"email");
		$password = filter_input(INPUT_POST,"password");
        $usertype = filter_input(INPUT_POST,"usertype"); 
		$email = stripslashes($email);
		$password = stripslashes($password);
        $usertype = stripslashes($usertype);
		$email = mysql_real_escape_string($email);
		$password = mysql_real_escape_string($password);
        $usertype = mysql_real_escape_string($usertype);
		$con = new PDO("mysql:host=localhost;dbname=finalPatientCare","root");
        $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 
       
		$sql = "select * from LOGIN where Password='$password' AND Email='$email'";
       
         
         
		$ps = $con->prepare($sql);   
        $ps->execute();
        
		if($ps){
			$_SESSION['login_user']=$email;
            $_SESSION['login_usertype']=$usertype;
			header("location: profile.php");
			
		}else{
			$error="Email or password is invalid";
			echo $error;
		}
	 }
 }


?>