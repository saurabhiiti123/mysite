<?php
session_start();
    if(isset($_GET['c_id'])){
        $_SESSION['course_id']=$_GET['c_id'];
        
        echo '<script>window.location.assign("course_page.php");</script>';
    }
    if(isset($_GET['q_id'])){
        $_SESSION['q_id']=$_GET['q_id'];
        echo '<script>window.location.assign("discussion.php");</script>';
    }
?>