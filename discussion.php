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
      <li><a href="signin.html">Sign up</a></li>
      <li><a href="login.html">Log in</a></li>
      </ul>
    </div>
    </div>
</nav>
<br>
<br>
<div class="container-fluid">
	<div class="col-sm-12 text-capitalize text-center" style="font-size: 400%;">discussion form</div>
	
	<div class="row">
			<div class="col-sm-5">
			<form action="discusswrite.php" method="POST">
			    
				<textarea class="autofit" placeholder="Post Your Question Here" name="question"></textarea>
				<br>
				<button class="btn btn-primary">Post</button>
                </form>
                </div>
			<div class="col-sm-7">
				<h2 class="">Previously asked Questions</h2>
				<div class="panel-group" id="accordion">
				<?php
    $conn=mysqli_connect("localhost","root","","learnX");
                    $sql="select *from DiscussionForum;";
                  $row=mysqli_query($conn,$sql);
                  while(($ele=mysqli_fetch_assoc($row))!=null){
                      
                   echo' <div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a href="#content-1" data-toggle="collapse" data-parent="#accordion">'.$ele["question"].'</a>
						</h4>
					</div>
					<div class="panel-collapse collapse in" id="content-1">
                    <button class="btn btn-default" onclick=myfunc('.$ele["question_id"].')>Answer</button>
						<div class="panel-body">
							<p>'.$ele["answer"].'</p>
						</div>
					</div>
				</div>';
                  }mysqli_close($conn);
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



<script type="text/javascript">
    <?php session_start();
    if(isset($_SESSION['q_id']))
       { echo '$("#ansform").css("visibility","visible");';}
    ?>
    function myfunc(s){
           //  $("#ansform").css("visibility","visible");
        window.location.assign("session_write.php?q_id="+s);
    }
    
    </script>
<script type="text/javascript">
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
   
             
         
         
</script>
</body>
</html>