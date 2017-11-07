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
    background-image: url("images/sign.png");
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
textarea {
    min-width:400px;
    width:400px;
    max-width:500px;
    resize:none;
    font-size:18px;
    overflow-x:hidden;
    overflow-y:auto;
    min-height: 50px;
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
        <div class="collapse navbar-collapse" id="mainNavBar">
      <ul class="nav navbar-nav">
                <li><a href="homepage.php">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
          </ul>       
     <ul class="nav navbar-nav pull-right">
      <li id="signi" style="visibility: visible;"><a href="signin.html">Sign up</a></li>
      <li id="logi" style="visibility: visible;"><a href="login.html">Log in</a></li>
      <li style="visibility:hidden" id="logo"><a href="logout.php" >Logout</a></li>
      </ul>
    </div>
    </div>
</nav>
<br>
<br>
<div class="container-fluid">
    <div class="col-sm-12 text-capitalize text-center" style="font-size: 400%;padding:10px;">Discussion Forum</div>
	
	<div class="row">
			<div class="col-sm-5" id="ask" style="visibility:hidden">
			<form action="discusswrite.php" method="POST">
			    
				<textarea class="autofit" placeholder="Post Your Question Here" name="question"></textarea>
				<br>
				<button class="btn btn-primary">Post</button>
                </form>
                </div>
			<div class="col-sm-7">
				<h2 class="">Previously asked Questions</h2>
				<div class="panel-group" id="accordion">
				<?php session_start();
    $conn=mysqli_connect("localhost","root","","learnX");$cid=$_SESSION["course_id"];
                    $sql="select * from DiscussionForum where course_id=$cid";
                  $row=mysqli_query($conn,$sql);$c=0;
                  while(($ele=mysqli_fetch_assoc($row))!=null){
                      $c++;
                   echo' <div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a href="#content-'.$c.'" data-toggle="collapse" data-parent="#accordion">'.$ele["question"].'</a>
						</h4>
					</div>
					<div class="panel-collapse collapse in" id="content-'.$c.'">
                    <button class="btn btn-default" onclick=myfunc('.$ele["question_id"].') id="answerbutton">Answer</button>
						<div class="panel-body">
							<p>'.$ele["answer"].'</p>
						</div>
					</div>
				</div>';
                  }
                    ?>
				
			</div>
			</div>
			<div class="col-sm-5" style="visibility:hidden" id="ansform">
			<form action="discusswrite.php" method="get" >
			    
				<textarea class="autofit" placeholder="Post Your answer" name="answer"></textarea>
				<br>
				<button class="btn btn-primary">Post</button>
                </form>
                </div>
	</div>




    <?php 
    if(isset($_SESSION['q_id']))
       { echo '<script>$("#ansform").css("visibility","visible");
       
       </script>';
       }
    
    
    
    ?>
    
 
<script type="text/javascript">
       function myfunc(s){
           //  $("#ansform").css("visibility","visible");
           var x="hasajsl";
           
           <?php
        if(isset($_SESSION["acct_id"])){$aid=$_SESSION['acct_id'];
            $sql="select * from Instructor where acct_id=$aid";
            $row=mysqli_query($conn,$sql);
            $row=mysqli_fetch_assoc($row);
            if($row!=null){
                echo 'window.location.assign("session_write.php?q_id="+s);';
            }
         else{
             echo 'alert("Only Instructors are given privilege to answer the questions");';
         }
        }
        ?>
        
    }
    
	 $(window).scroll(function() {
    if($(this).scrollTop() > 50)  /*height in pixels when the navbar becomes non opaque*/ 
    {
        $('.opaque-navbar').addClass('opaque');
    } else {
        $('.opaque-navbar').removeClass('opaque');
    }
});
     
    
	 (function(){
var measurer = $('<span>', {
   							style: "display:inline-block;word-break:break-word;visibility:hidden;white-space:pre-wrap;"})
   .appendTo('body');
function initMeasurerFor(textarea){
  if(!textarea[0].originalOverflowY){
  	textarea[0].originalOverflowY = textarea.css("overflow-y");    
  }  
  var maxWidth = textarea.css("max-width");
  measurer.text(textarea.text())
      .css("max-width", maxWidth == "none" ? textarea.width() + "px" : maxWidth)
      .css('font',textarea.css('font'))
      .css('overflow-y', textarea.css('overflow-y'))
      .css("max-height", textarea.css("max-height"))
      .css("min-height", textarea.css("min-height"))
      .css("min-width", textarea.css("min-width"))
      .css("padding", textarea.css("padding"))
      .css("border", textarea.css("border"))
      .css("box-sizing", textarea.css("box-sizing"))
}
         
         // onclick function
         
function updateTextAreaSize(textarea){
	textarea.height(measurer.height());
  var w = measurer.width();
  if(textarea[0].originalOverflowY == "auto"){
     	var mw = textarea.css("max-width");
      if(mw != "none"){
     		if(w == parseInt(mw)){
      		textarea.css("overflow-y", "auto");
     		} else {
         	textarea.css("overflow-y", "hidden");
     		}
      }
   }
   textarea.width(w + 2);
}
$('textarea.autofit').on({
    input: function(){      
      	var text = $(this).val();  
        if($(this).attr("preventEnter") == undefined){
      	   text = text.replace(/[\n]/g, "<br>&#8203;");
        }
      	measurer.html(text);                       
        updateTextAreaSize($(this));       
    },
    focus: function(){
     initMeasurerFor($(this));
    },
    keypress: function(e){
    	if(e.which == 13 && $(this).attr("preventEnter") != undefined){
      	e.preventDefault();
      }
    }
})});
    
      <?php
// session_start();
    if(isset($_SESSION["acct_id"])){
        $aid=$_SESSION["acct_id"];
            $cid=$_SESSION["course_id"]; 
              
            $query1="select *from Creates where acct_id=$aid and course_id=$cid";
                
            $row1=mysqli_query($conn,$query1);
          
        $row1=mysqli_fetch_assoc($row1);
        
          if($row1==NULL){
              echo '$("#ask").css("visibility","visible");' ;
          }
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