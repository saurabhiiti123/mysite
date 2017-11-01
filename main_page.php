
<!DOCTYPE html>
<html lang="en">
<head>
    <title>LearnX</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Acme' rel='stylesheet'>
<style type="text/css">
html,body{
    margin: 0px;
    
    background-repeat: no-repeat;
    
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

ul.dropdown-menu {
    background-color: black;
}
/*.about{
    background-image:url("b1.jpg");
    z-index: 3;
    width:auto;
    
    background-repeat: no-repeat;
}*/
.add{
    text-align: left;
}
li:hover{
	color: gray;
}
</style>
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top opaque-navbar">
    <div class="container-fluid">

        <!-- Logo -->
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
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
          </ul>

     <ul class="nav navbar-nav pull-right">
      <li><a href="signin.html">Sign up</a></li>
      <li><a href="#">Log in</a></li>
      </ul>
    </div>
    </div>
</nav>
<div class="container-fluid">
    <p class="about" style="margin-top:55px;margin-left:20px;text-indent: 50px;padding-left: 5px;">
         <img src="b1.jpg" style="padding: 5px;float: left;" /><b style="font-size: 400%;color:LIGHTSTEELBLUE;text-indent:50px;margin-bottom: 0px"> Machine Learning</b>
    <br></p>
    <p style="font-size: 220%;padding:10px;font-family: 'Acme'" id="description"> Machine learning is a field of computer science that gives computers the ability to learn without being explicitly programmed.</p>
    <input type="checkbox" name="enroll" onclick="myfunction()"  /><b style="font-size: 120%;color: red">I agree to all terms and conditions</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <button type="button" class="btn btn-primary" style="visibility: hidden;">ENROLL ME</button>
</div>
<br>
<div class="row">
<div  class="col-sm-6 topics">
    <ul  style="font-family: 'Acme';font-size: 150%">TOPICS
        <ul >SUPERVISED LEARNING
        <li style="color: green">Gradient Descent Algorithm</li>
        <li style="font-size: 120%">Normal Equations</li></ul>
       
        <ul >UNSUPERVISED LEARNING
             <li style="font-size: 120%">K-means</li>
    </ul>
    </ul>
</div>
<div class="col-sm-3"><p style="margin-left: 20px;font-size: 150%">Instructors</p>
<div style="padding-left:5px;"><p style="color: steelblue;margin-left: 20px"><b style="font-size: 150%" >Professor<span id="ins_name"></span></b><br><b style="font-size: 120%;color:#FF00FF" id="subject">Department of Computer Science</b><br>IIT INDORE</p></div></div>
    <div class="col-sm-3"><div style="border:1px solid black;margin:10px;">
        <p style="padding: 2px;margin-bottom: 0px;margin-left: 30px;font-size: 120%"><img src="clock.png" style="margin-right: 15px" >Length:&nbsp;&nbsp;&nbsp;<span id="duration"></span>
        <hr style="color: black;margin:2px;width:85%;margin-left: 20px"><!-- <p style="margin-top: 0px;margin-left: 30px;"><span class="glyphicon glyphicon-certificate"></span>Level:&nbsp;&nbsp;&nbsp;&nbsp;Advanced</p> -->
        <p style="padding: 2px;margin-bottom: 0px;margin-left: 30px;font-size: 120%"><img src="graduation-cap.png">Subject:Computer Science</p><hr style="color: black;margin:2px;width:85%;margin-left: 20px">
        <p style="padding: 2px;margin-bottom: 0px;margin-left: 30px;font-size: 120%"><img src="comment-o.png">Languages:English</p><hr style="color: black;margin:2px;width:85%;margin-left: 20px">
        <p style="padding: 2px;margin-bottom: 0px;margin-left: 30px;font-size: 120%"><img src="bank.png">Institution:IIT INDORE</p><hr style="color: black;margin:2px;width:85%;margin-left: 20px">
        <p style="padding: 2px;margin-bottom: 0px;margin-left: 30px;font-size: 120%"><img src="tag-fill.png">Price:FREE<br>Add a Verified Certificate at a cost of 2,000 Rupees </p>
    </div>></div>
</div>
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
  function myfunction(){
if(!($("input[type='checkbox']").is(':checked')))
{
$("button").css("visibility","hidden");
// $(this).css("font-size","200%");
}
else{
    $("button").css("visibility","visible");
}}
    $("button").click(function(){
        <?php session_start();
        if(!isset($_SESSION['ac_id']))
        echo '<script>window.location.assign("login.html");</script>'
        else {
            $conn=mysqli_connect("localhost","root","","learnX");
            $sql="select course_id from Courses where course_name='$
        }    
        ?>
    }
    )
</script>
</body>
</html>
