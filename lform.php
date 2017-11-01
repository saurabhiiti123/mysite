<?php
session_start();
    
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $username=$_POST["email"];
        $password=$_POST["password"];
        $db="learnX";
        $servername="localhost";
        $user="root";
        $pass="";
        $conn=mysqli_connect($servername,$user,$pass,$db);
        $sql="select * from Learner inner join Account on Account.acct_id=Learner.acct_id
        where Account.email_id='$username' and Account.password='$password';";
        if(($row=mysqli_fetch_assoc(mysqli_query($conn,$sql)))!=NULL){
            $_SESSION["acct_id"]=$row["acct_id"];
            echo $_SESSION["acct_id"];
            echo '<script>alert("'.$username.'Logged in");window.location.assign("course_page.php");</script>';
            
            
        }
        else {
            echo '<script>alert("wrong entries");
                window.location.assign("login.html");</script>';
        }
    }
?>