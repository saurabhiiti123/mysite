<!doctype html>
<html>
    <body>
      <?php
if($_SERVER["REQUEST_METHOD"]== "POST"){
    $first_name=$_POST["first_name"];
    $last_name=$_POST["last_name"];
    $email=$_POST["Email"];
    $phone_no=$_POST["phone_no"];
    $q_level=$_POST["q_level"];
    $city=$_POST["city"];
    $country=$_POST["country"];
    $password=$_POST["password"];
    $age=$_POST["age"];
    $exper=$_POST["experience"];
    $subject=$_POST["subject"];
    
    $servername="localhost";
    $username="root";
    $pass="";
    $db="learnX";
    $conn=mysqli_connect($servername,$username,$pass,$db);
    //inserting values in instructor table
    $sql="insert into Account(first_name,last_name,email_id,password,phone_no,city,country,q_level)
    values ('$first_name','$last_name','$email','$password','$phone_no','$city','$country','$q_level');";
    if(!mysqli_query($conn,$sql)){
        echo '<script>
            alert("Soory!!! there is a problem registering");     
              </script> ';
    }
    
    
   $select="select acct_id from Account order by acct_id desc limit 1;";
    $row=mysqli_query($conn,$select);
    
    $row=mysqli_fetch_assoc($row);
    $acc=$row["acct_id"];
    $sql="insert into Instructor
    values ($acc,'$age','$exper','$subject');";
    if(mysqli_query($conn,$sql))
    {
        
        echo '<script>
            alert("you are registered") ; 
            window.location.assign("signin.html");
              </script> ';
        
        
    }
    else{
        echo '<script>
            alert("Soory!!! there is a problem registering\n  Try again");   
            window.location.assign("signin.html");
              </script> ';
        
        
    }
    
    mysqli_close($conn);
    
}
?>
    
    </body>
</html>
