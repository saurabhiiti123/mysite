<?php
session_start();
if($_SERVER["REQUEST_METHOD"]== "POST"){
    
        $conn=mysqli_connect("localhost","root","","learnX");
    $comment=$_POST["comment"];
    $feed=$_POST["feed"];$aid=$_SESSION["acct_id"];$cid=$_SESSION["course_id"];
    $ins="insert into Feedback(feedback,comments,acct_id,course_id)
    values($feed,'$comment',$aid,$cid)";
    if(mysqli_query($conn,$ins)){
        echo '<script>alert("Thank You For Your Feedback.")</script>';
            echo '<script>window.location.assign("homepage.php");</script>';
    }
    else{
       echo  mysqli_error($conn);
    }
}

?>