<?php
session_start();
$cid=$_SESSION["course_id"];
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $username="root";
    $servername="localhost";
    $password="";$db="learnX";
    $conn=mysqli_connect($servername,$username,$password,$db);

    $max=$_POST["Maximum"];
    $min=$_POST["Minimum"];
    $q1=$_POST["q1"];
    $a1=$_POST["a1"];
    $q2=$_POST["q2"];
    $a2=$_POST["a2"];

    $sql="insert into Exam(course_id,question_1,question_2,ans_1,ans_2,min_qualify_marks,max_marks)
    	values($cid,'$q1','$q2','$a1','$a2',$min,$max);";

	if(mysqli_query($conn,$sql))
		{echo '<script>alert("Exam created successfully");
					window.location.assign("course_page.php");</script>
			';}

	else
		echo mysqli_error($conn);
	mysqli_close($conn);
}
?>
