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
   <a href="profile.php"><button name="doctor" class="button button-doctor"/>Home</button></a>&nbsp;<a href="doctor.php"><button name="doctor" class="button button-doctor"/>Find Doctor</button></a>   <?php 
if($usertype=="Employee"){
print "<a href='PatientInfoForEmploye.php'><button name='doctor' class='button button-doctor'/>Patient Info</button></a>&nbsp;<a href='PatientVisit.php'><button name='doctor' class='button button-doctor'/>Patients Visit </button></a>";}
else{
print "<a href='PatientHealth.php'><button name='doctor' class='button button-doctor'/>Health Details</button></a>";
    print "&nbsp;<a href='billing.php'><button name='doctor' class='button button-doctor'/>Billing </button></a>";

}
 ?>
 
          
          <form style="width:40%;float:left;" action="doctorsearch.php" method="post" enctype="multipart/form-data">
          <div class="field-wrap" style="color: rgba(255, 255, 255,0.5);">
               <br> Find a Doctor:
              </div>
          <div class="top-row">
            
              <div class="field-wrap" style="color: rgba(255, 255, 255,0.5);">
              
                First Name
            
              <input type="text" name="check_array[]"  />
            </div>
        </div><br/>
              
          <div class="top-row">
              
            <div class="field-wrap" style="color: rgba(255, 255, 255,0.5);">
              
                Last Name
             
              <input type="text" name="check_array[]" />
            </div>
          </div><br/>
              
         <div class="top-row">
              
            <div class="field-wrap" style="color: rgba(255, 255, 255,0.5);">
             
                Department
              <input type="text" name="check_array[]" />
            </div>
          </div><br/>
                           
		 <!-- <div class="radio">
		    <input type="radio" name="check_array[]" value="M"  /> Male
			<input type="radio" name="check_array[]" value="F" style="margin-left:15px;"/> Female
			<input type="radio" name="check_array[]" value="other" style="margin-left:15px;"> Other</input>
          </div>-->
             
        <div class="top-row">
            
        
              <div class="field-wrap" style="color: rgba(255, 255, 255,0.5);">
           
                City
              <input type="text" name="check_array[]" />
            </div></div><br>
          
              <div class="top-row">
            <div class="field-wrap" style="color: rgba(255, 255, 255,0.5);">
              
                State
              <input type="text" name="check_array[]" />
            </div>
          </div><br>   
             
           <div class="top-row">
            <div class="field-wrap" style="color: rgba(255, 255, 255,0.5);">
              
                Country<input type="text" name="check_array[]"  />
            </div></div><br/>
        
              <div class="top-row">
              <div class="field-wrap" style="color: rgba(255, 255, 255,0.5);">
              
                Zip Code<input type="text" name="check_array[]" />
            </div>
          </div><br/>
        
         
          
		
		  <button style="width:95%;" type="submit" class="button button-block"/>Search</button><br>
          
          </form>
<div id="map" style="margin-top:10%;width:60%;height:645px"></div>
<script>
function initMap() {
        var uluru = {lat: 37.3357235, lng: -121.8791294};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 17,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCvNGOGAdKfc3PBSP95e_GiahNRirXWj-8&callback=initMap"></script>
    
    
<br/><a href="logout.php"><button name="logout" class="button button-blocklogout"/>logout</button></a> 
  
  </div>
 
  
  
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

       <script src="js/index.js"></script>   

    
    
    
  </body>
</html>
