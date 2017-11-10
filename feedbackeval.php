<?php
session_start();
if($_SERVER["REQUEST_METHOD"]== "POST"){
    $db="learnX";
        $servername="localhost";
        $user="root";
        $pass="";
        $conn=mysqli_connect($servername,$user,$pass,$db);
    $comment=$_POST["comment"];
    $feed=$_POST["feed"];$aid=$_SESSION["acct_id"];
    $ins="insert into Feedback(feedback,comments,acct_id)
    values($feed,$comment,$aid)";
    if(mysqli_query($conn,$ins)){
        echo '<script>alert("Thank You For Your Feedback.")</script>';
            echo '<script>window.location.assign("homepage.php");</script>';
    }
}

?>