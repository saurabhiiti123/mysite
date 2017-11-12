<?php session_start();
 if($_SERVER["REQUEST_METHOD"]=="POST"){$score=0;
  $eid=$_SESSION["exam_id"];
  $conn=mysqli_connect("localhost","root","","learnX");
    $query="select * from Exam where exam_id=$eid";
    $ele=mysqli_query($conn,$query);
    $row=mysqli_fetch_assoc($ele);
    	
        if(isset($_POST["ans_1"]))
        {
            if($_POST["ans_1"]==$row["ans_1"])
                $score=$score+10;
        }
        if(isset($_POST["ans_2"]))
        {
            if($_POST["ans_2"]==$row["ans_2"])
                $score=$score+20;
        }
        
        echo '<script>window.alert(" Your score : '.$score.'");</script>';

       $status="";
       if($score>=$row["min_qualify_marks"])
       	$status="passed"; $aid=$_SESSION["acct_id"];
    $conn=mysqli_connect("localhost","root","","learnX");
       $sql="insert into Gives values ($aid,$eid,$score,current_timestamp())";
       if(!mysqli_query($conn,$sql)){
           echo mysqli_error($conn);
           echo '<script>window.alert(" You have passed the deadline for this exam.\n Now You cannot pass it.\nThanks for your presence");
           				//window.location.assign("feedback.html");
           </script>';

       }
       else if($status=='passed'){
       	echo '<script>window.alert(" You have passed this quiz \n Congratulations!!!!!!!");
           				window.location.assign("feedback.html");</script>';
       }
       else
       {
       echo '<script>
       var r=confirm("Sorry You did not pass this quiz! Would you like to retake it");
       if(r==true){
        window.location.assign("quiz.php");}
        else {
          window.location.assign("course_page.php");
        }</script>;';
       }

}
                                           
                                           
                                       
    
?>