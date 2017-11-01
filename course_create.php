<?php
session_start();
$acct_id=$_SESSION["acct_id"];
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $username="root";
    $servername="localhost";
    $password="";$db="learnX";
    $conn=mysqli_connect($servername,$username,$password,$db);
    $course_name=$_POST["name"];
    $description=$_POST["description"];
    $contents=$_POST["contents"];
    $prereq=$_POST["prereq"];
    $duration=$_POST["duration"];
    $reputation=$_POST["reputation"];
    $insert="insert into Courses (course_name,description,contents,duration,prerequisite,repu_required)
    values('$course_name','$description','$contents','$duration','$prereq','$reputation');";
      if(!mysqli_query($conn,$insert)){
          echo '<script>alert("There is a problem creating course\n  Try again");</script>';
      }
   
    $select="select course_id from Courses order by course_id desc limit 1;";
    $row=mysqli_query($conn,$select);
    
    $row=mysqli_fetch_assoc($row);
    $acc=$row["course_id"];
    $sql="insert into Creates
    values($acct_id,$acc,current_timestamp());";
    
    if(mysqli_query($conn,$sql)){
          echo '<script>alert("Course successfully created");</script>';
      }
    else{
        echo '<script>alert("There is a problem creating course\n  Try again");</script>';
    }
    
}
?>