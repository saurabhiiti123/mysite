<?php session_start();
        
        if(empty($_SESSION["acct_id"]))
        {
             echo '<script>window.location.assign("login.html");</script>';
        }
        else {
            $cid=$_SESSION["course_id"];
            $a_id=$_SESSION["acct_id"];
            $conn=mysqli_connect("localhost","root","","learnX");
            $row=mysqli_fetch_assoc(mysqli_query($conn,"select * from Learner where acct_id=$a_id"));
            if($row==null){
                echo '<script>alert("Logged in as Instructor or not logged in.\n  Login or signup as a Learner")
                window.location.assign("course_page.php");
               </script>';
            }
            else{
                
                $enroll="insert into Enrolls 
                values($a_id,$cid,current_timestamp());";
                
                if(mysqli_query($conn,$enroll)){
                    echo '<script>alert("Successfully enrolled for the course")
                    window.location.assign("course_page.php");</script>';
                }
                else{
                     echo '<script>alert("Cannot enroll!! You do not have the prerequisite mentioned.")
                    window.location.assign("course_page.php");</script>';
                }
                
            
            }
        mysqli_close($conn);}

        
        ?>