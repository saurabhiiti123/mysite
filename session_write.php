<?php
session_start();
    if(isset($_GET['c_id'])){
        $_SESSION['course_id']=$_GET['c_id'];
        
        echo '<script>window.location.assign("course_page.php");</script>';
    }
?>