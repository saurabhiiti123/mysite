<?php
    session_start();
   if($_SERVER["REQUEST_METHOD"]=="POST"){
       $acct_id=$_SESSION['acct_id'];
       $course_id=$_SESSION['course_id'];
       $question=$_POST["question"];
       $conn=mysqli_connect("localhost","root","","learnX");
       $sql="insert into DiscussionForum(course_id,question,answer,acct_id)
       values($course_id,'$question',' ',$acct_id);";
       if(!mysqli_query($conn,$sql))
           echo "Valuse not inserted".mysqli_error($conn);
       mysqli_close($conn);
       
   }
    if($_SERVER["REQUEST_METHOD"]=="GET"){
        $conn=mysqli_connect("localhost","root","","learnX");
        $ans=$_GET['answer'];$q_id=$_SESSION['q_id'];
        $sql="update  DiscussionForum set answer='$ans' where question_id=$q_id;";
        if(!mysqli_query($conn,$sql))
            echo "Valuse not inserted".mysqli_error($conn);
        mysqli_close($conn);
    }
    echo '<script>window.location.assign("discussion.php")</script>';
    ?>