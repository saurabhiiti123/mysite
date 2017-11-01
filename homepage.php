<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<style type="text/css">
		html,body{
    margin: 0px;
    background-image: url("background.jpg");
    background-attachment: "fixed";
   
    
}
.opaque-navbar {
    background-color: rgba(0,0,0,0.5);
  /* Transparent = rgba(0,0,0,0) / Translucent = (0,0,0,0.5)  */
    height: 60px;
    border-bottom: 0px;
    transition: background-color .5s ease 0s;
}

.opaque-navbar.opaque {
    background-color: black;
    height: 60px;
    transition: background-color .5s ease 0s;
}
li:hover{
	color: red!important;
}
.Courses:hover{
	opacity: 0.8;
	cursor: pointer;	
}
</style>
</head>
<body>
		<nav class="navbar navbar-inverse navbar-fixed-top opaque-navbar">
    <div class="container-fluid">

        
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mainNavBar">
                <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
            </button>
            <a href="#" class="navbar-brand" class="active">LearnX</a>
        </div>

        <!-- Menu Items -->
        <div class="collapse navbar-collapse" id="mainNavBar">
            <ul class="nav navbar-nav">
                <li><a href="homepage.php">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
          </ul>

     <ul class="nav navbar-nav pull-right">
      <li><a href="signin.html">Sign up</a></li>
      <li><a href="login.html">Log in</a></li>
      </ul>
    </div>
    </div>
</nav>
<br>
<br>
<div class="container-fluid">
	<div><h1>Courses Available</h1>
		<br><div style="margin-left: 200px;">
		<?php
		
		$conn=mysqli_connect("localhost","root","","learnX");
		$sql="select * from Courses;";
        $row=mysqli_query($conn,$sql);
        while(($ele=mysqli_fetch_assoc($row))!=null){
            $course_name=$ele["course_name"];
           echo '  <div style="border:2px solid black;height: 300px;padding:15px;width:24%;float: left;margin-right: 40px;background-color:transparent" class="Courses">
			<img src="b1.jpg" alt="Machine Learning">
			<br><p style="font-size: 150%;"><a href="session_write.php?c_id='.$ele["course_id"].'" style="text-decoration: none;color: black;"><br>'.$course_name.'</a></p>
		</div>';
            
        }
        mysqli_close($conn);
		
		?>
		
		
	</div>
	</div>
</div>
</body>
</html>