<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>LearnX</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Acme' rel='stylesheet'>
	
	<style type="text/css">
html,body{
    height:1000px;
    background-image: url(images/sign.png);
    
}
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

ul.dropdown-menu {
    background-color: black;
}
.add{
    text-align: left;
}
a:hover{
color:red !important;
}
</style>
</head>
<body>

	<header>

<nav class="navbar navbar-inverse navbar-fixed-top opaque-navbar">
    <div class="container-fluid">

        <!-- Logo -->
        <div class="navbar-header">
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
      <li id="signi" style="visibility: visible;"><a href="signin.html">Sign up</a></li>
      <li id="logi" style="visibility: visible;"><a href="login.html">Log in</a></li>
      <li style="visibility:hidden" id="logo"><a href="logout.php" >Logout</a></li>
      </ul>
    </div>
    </div>
</nav>
</header>
<?php  session_start();
    $server="localhost";
    $user="root";
    $password="";$db="learnX";
    $conn=mysqli_connect($server,$user,$password,$db);
    $cid=$_SESSION['course_id'];

    $sql="select * from Feedback inner join Account using(acct_id)  where course_id=$cid";
    $row=mysqli_query($conn,$sql);
    $sql="select round(avg(feedback),2) from Feedback
    where course_id=$cid;";
    $r=mysqli_query($conn,$sql);
    $r=mysqli_fetch_assoc($r);

?>
<div class="container-fluid" style="padding:100px;" >
  <div class="row" style="padding: 50px;font-size:130%;">
      <p style="font-size:150%;padding: 20px;"><strong>Average rating given By learners is:   </strong>  <?php echo $r["round(avg(feedback),2)"];?> out of 5</p>
       </div>
           <hr style="color: black;margin:2px;width:85%;margin-left: 20px">
    
</div>
<div class="container-fluid">
  <h1> Comments</h1>
  <?php 
  while(($ele=mysqli_fetch_assoc($row))!=NULL){
  
  echo  '<div class="row" style="margin-left:100px;margin-top: 20px;margin-right: 100px">
  <div  style="font-family: Acne;font-size: 200%">
    <p style="font-family: Acne;font-size:120%">'.$ele["comments"].'<span style="float:right;font-size: 80%;">-By '.$ele["first_name"]." ".$ele["last_name"].' </span></p>
</div></div>';}
?>
</dvi>



<script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>  
  <script src="jquery-3.2.1.js"></script>
<script>
  $(window).scroll(function() {
    if($(this).scrollTop() > 50)  /*height in pixels when the navbar becomes non opaque*/ 
    {
        $('.opaque-navbar').addClass('opaque');
    } else {
        $('.opaque-navbar').removeClass('opaque');
    }
});
$(window).keydown(function(event){
    if( (event.keyCode == 13) && (validationFunction() == false) ) {

      event.preventDefault();
      return false;
    }
});

<?php
// session_start();
    if(isset($_SESSION["acct_id"])){
        echo '$("#signi").css("visibility","hidden");';
      echo '$("#logi").css("visibility","hidden");';
      echo '$("#logo").css("visibility","visible");';
    }
     else{
          echo '$("#signi").css("visibility","visible");';
      echo '$("#logi").css("visibility","visible");';
      echo '$("#logo").css("visibility","hidden");';
     }
   
    ?>



</script>
</body>
</html>