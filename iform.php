<!doctype html>
   <html>
   <head>
	<title>learnX</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Sofia' rel='stylesheet'>
</head>
  <style type="text/css">
	.opaque-navbar {
    background-color: rgba(0,0,0,0.8);
  /* Transparent = rgba(0,0,0,0) / Translucent = (0,0,0,0.5)  */
    height: 60px;
    border-bottom: 0px;
    transition: background-color .5s ease 0s;
}

.opaque-navbar.opaque {
    background-color: rgba(0,0,0,0.4);
    height: 60px;
    transition: background-color .5s ease 0s;
}
a:hover{
color:red !important;
}
</style>
  
   <body>  
   
    <?php
       session_start();
    $acct_id=0;
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $email=$_POST["email"];
        $password=$_POST["password"];
        $db="learnX";
        $servername="localhost";
        $user="root";
        $pass="";
        $conn=mysqli_connect($servername,$user,$pass,$db);
        $sql="select * from Instructor inner join Account on Account.acct_id=Instructor.acct_id
        where email_id='$email' and password='$password';";
        $row=mysqli_query($conn,$sql);
        $ele=mysqli_fetch_assoc($row);
        if(!empty($ele["acct_id"])){
            echo '<script>alert("Logged in")</script>';
            $_SESSION["acct_id"]=$ele["acct_id"];
        }
        else {
            echo '<script>alert("wrong entries");
                window.location.assign("login.html");</script>';
        }
        mysqli_close($conn);
    
    }
       
           
?>
     
     
     <header>

<nav class="navbar navbar-inverse navbar-fixed-top opaque-navbar">
    <div class="container-fluid">

        <!-- Logo -->
       <!-- <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mainNavBar">
                <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
            </button>
            <a href="#" class="navbar-brand" style="color: steelblue">LearnX</a>
        </div>

        <!-- Menu Items -->
        <div class="collapse navbar-collapse" id="mainNavBar">
            <ul class="nav navbar-nav">
                <li><a href="homepage.php" style="color: steelblue">Home</a></li>
                <li><a href="#" style="color:steelblue">About</a></li>
                <li><a href="#" style="color:steelblue">Contact</a></li>
          </ul>

     <ul class="nav navbar-nav pull-right">
      <li><a href="signin.html"  id="k">Sign up</a></li>
      <li><a href="login.html">Log in</a></li>
      </ul>
    </div>
    </div>
</nav> 
    
		<!-- <div>
			<br>
			<br>
			<div class="container">
				<h1 style="font-size: 800%">Sign Up</h1>
			</div> <!- end container -->
		</div> <!-- end jumbotron --> 
	</header>
	<div class="container-fluid" style="margin-top:100px;margin-left: 10px;">
		<button class="btn-info btn-large"  style="font-size: 150%" id="create">CREATE COURSE</button>
	</div>
	<br>
	<br>
	<div>
		<div class="container-fluid">
			<form method="post" action="course_create.php" role="form" style="display: none" id="form">
				<div class="form-group">
						<label for="form-elem1" class="control-label">Course Name</label>
						<input type="text" class="form-control" style="width:50%" autofocus="autofocus" required="required" name="name">
				</div>
				<div class="form-group">
						<label for="form-elem2" class="control-label">Description</label>
						<input type="text" class="form-control" style="width:50%" autofocus="autofocus" required="required" name="description">
				</div>
				<div class="form-group">
						<label for="form-elem3" class="control-label">Contents</label>
						<input type="text" class="form-control" style="width:50%" autofocus="autofocus" required="required" name="contents">
				</div>
				<div class="form-group">
						<label for="form-elem4" class="control-label">Prerequisite</label>
						<input type="text" class="form-control" style="width:50%" autofocus="autofocus" required="required" name="prereq">
				</div>
				<div class="form-group">
						<label for="form-elem5" class="control-label">Duration</label>
						<input type="text" class="form-control" style="width:50%" autofocus="autofocus" required="required" name="duration">
				</div>
				<div class="form-group">
						<label for="form-elem6" class="control-label">Reputation Required</label>
						<input type="text" class="form-control" style="width:50%" autofocus="autofocus" required="required" name="reputation">
				</div>
				<p style="color:red;font-size: 110%">All the Fields are mandatory</p>
				<button type="submit" class="btn btn-default">Create</button>
			</form>
		</div>
	</div>
	<div class="container-fluid" style="margin-top:50px;margin-left: 10px;">
	    <h1>Created Courses</h1>
	    
	    
		<?php 
        
        $servername="localhost";
        $user="root";
        $pass="";
        $db="learnX";
        $conn=mysqli_connect($servername,$user,$pass,$db);
        if(isset($_SESSION["acct_id"])){
            $aid=$_SESSION["acct_id"];
        
        $sql="select course_name,Courses.course_id from Courses inner join Creates on Creates.course_id=Courses.course_id 
            where Creates.acct_id=$aid;";
        if(!mysqli_query($conn,$sql)){ echo mysqli_error($conn);} 
        $row=mysqli_query($conn,$sql);
        $ele=mysqli_fetch_assoc($row);
        while($ele!= null){
            $cid=$ele["course_id"];
            $cname=$ele["course_name"];
        echo '<div class="container-fluid" style="margin-top:50px;margin-left: 10px;">
		<button   style="font-size: 150%;background-color:rgb(200,200,200)" onclick=myfunc('.$cid.')>'.$cname.'</button>
	</div>';
            $ele=mysqli_fetch_assoc($row);
            
            
        }}
                 mysqli_close($conn);
        ?>
	</div>
	<script type="text/javascript">
        var c=0;
		 $(window).scroll(function() {
    if($(this).scrollTop() > 50)  /*height in pixels when the navbar becomes non opaque*/ 
    {
        $('.opaque-navbar').addClass('opaque');
    } else {
        $('.opaque-navbar').removeClass('opaque');
    }
});
		 $("#create").click(function(){
             
		 	$("form").show();
            
		 });
    function myfunc(s){
               window.location.assign("session_write.php?c_id="+s);
               
        }
        
	</script>
      
      
      
       </body>
</html>