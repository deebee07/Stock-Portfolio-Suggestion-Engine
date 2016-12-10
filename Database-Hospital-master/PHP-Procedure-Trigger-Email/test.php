<?php
require_once('PHPMailer/PHPMailerAutoload.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded


    

     $con = new PDO("mysql:host=localhost;dbname=finalPatientCare","root");
     $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 
   
    $query = "SELECT email, patient_id, record_id,record_val,record_type, time_stamp from notification where sent = 0";

    $ps = $con->prepare($query);   
    $ps->execute();
    $data = $ps->fetchAll(PDO::FETCH_ASSOC);
    foreach ($data as $row) {
 
    
    	$patient_id = $row['patient_id'];
    	$record_type = $row['record_type'];
    	$record_val = $row['record_val'];
    	$record_id = $row['record_id'];
    	$time_stamp = $row['time_stamp'];
    	$email = $row['email'];
    	$msg = "Patient with patient id =".$patient_id ." recorded abnormal reading -->". $record_type. "=" . $record_val . " at timestamp" . $time_stamp;
        echo $msg;

        $mail             = new PHPMailer();

$body             = $msg;


$mail->IsSMTP(); // telling the class to use SMTP

$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->SMTPSecure = "tls";                 // sets the prefix to the servier
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port       = 587;                   // set the SMTP port for the GMAIL server
$mail->Username   = "connectedeventsapi@gmail.com";  // GMAIL username
$mail->Password   = "connectedeventsapi123";            // GMAIL password



$mail->Subject    = "Hospital Alert";



$mail->MsgHTML($body);

$address = $email;
$mail->AddAddress($address);


if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    $query1 = "Update notification set sent = 1 where notification.patient_id =". $patient_id;

    $ps = $con->prepare($query1);   
    $ps->execute();
    
}

       /*mail(email,"Alert", $msg );
       $querydel = "Delete from notification where time_stamp =". $time_stamp . "and record_type =". $record_type . "patient_id =" . $patient_id  ;
        $ps1 = $con->prepare($querydel);   
        $ps1->execute();*/
         
    } 

    ?>