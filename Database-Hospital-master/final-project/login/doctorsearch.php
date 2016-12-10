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
<?php

   


if($_SERVER["REQUEST_METHOD"] == "POST") {
	 
     $con = new PDO("mysql:host=localhost;dbname=finalPatientCare","root");
     $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	 $array = $_POST['check_array'];
     
    $selectQuery = 'select * from EMPLOYEE';
    $whereString = '';
    
    foreach($array as $key => $value) { 
        if(!empty($value)){
            switch ($key) {
                case 0:
                    $whereString = 'FName = "'.$value.'"';
                    break;
                case 1:
                    if(empty($whereString))
                        $whereString = 'LName = "'.$value.'"';
                    else
                        $whereString = $whereString.' AND LName = "'.$value.'"';
                    break;
                case 2:
                    if(empty($whereString))
                        $whereString = 'Department = "'.$value.'"';
                    else
                        $whereString = $whereString.' AND Department = "'.$value.'"';
                    break;
              
                case 3:
                    if(empty($whereString))
                        $whereString = 'City = "'.$value.'"';
                    else
                        $whereString = $whereString.' AND City = "'.$value.'"';
                    break;
                case 4:
                    if(empty($whereString))
                        $whereString = 'State = "'.$value.'"';
                    else
                        $whereString = $whereString.' AND State = "'.$value.'"';
                    break;
                case 5:
                if(empty($whereString))
                        $whereString = 'Country = "'.$value.'"';
                    else
                        $whereString = $whereString.' AND Country = "'.$value.'"';
                    break;
                case 6:
                    if(empty($whereString))
                        $whereString = 'ZIP_Code = "'.$value.'"';
                    else
                        $whereString = $whereString.' AND ZIP_Code = "'.$value.'"';
                    break;



            }
        }
    }
    
    if(!empty($whereString))
        $selectQuery = $selectQuery.' where '.$whereString.';';
   
    $ps = $con->prepare($selectQuery);   
    $ps->execute();
    $data = $ps->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($data as $row) {
   
    print "<div style='height:100%;width:100%;float:left;color: rgba(255, 255, 255, 0.5);font-size: 22px;background-color: rgba(19, 35, 47, 0.9)'>";
    print "Name: ".$row['FName']."   ".$row['MidName']."   ".$row['LName']."<br/>";
    print "Department: ".$row['Department']."<br/>";
    print "Country: ".$row['Country']."<br/>";
    print "Gender: ".$row['Sex']."<br/>";
    print "Street Address: ".$row['Street_Address']."<br/>";
    print "City: ".$row['City']."<br/>";
    print "State/Province/County: ".$row['State']."<br/>";
    print "Zip/Postal Code: ".$row['ZIP_Code']."<br/>";
    print "Email Address: ".$row['Email_Address']."<br/>";
    print "<br><br></div>";
    }  
    
        
}


?>
     </div> <br/><a href="logout.php"><button name="logout" style="width: 100%;display: block;" class="button"/>logout</button></a> 
      
   </body>
</html>