<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<body>
 <?php 
    if($_SERVER["REQUEST_METHOD"]=="POST"){$score=0;
        if(isset($_POST["question1"]))
        {
            if($_POST["question1"]=="D")
                $score++;
        }
        if(isset($_POST["question2"]))
        {
            if($_POST["question2"]=="B")
                $score++;
        }if(isset($_POST["question3"]))
        {
            if($_POST["question3"]=="A")
                $score++;
        }if(isset($_POST["question4"]))
        {
            if($_POST["question4"]=="A")
                $score++;
        }
        
        echo '<script>window.alert(" Your score : '.$score.'");</script>';
       
       $conn=mysqli_connect("localhost","root","","learnX");
       $sql="insert into"
    }
?>
<div class="container">
<form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
	<div id="question1"><div class="row"><div class="col-sm-1">Q1.</div><div class="col-sm-11">A computer program is said to learn from experience E with

   respect to some task T and some performance measure P if its

performance on T, as measured by P, improves with experience E.

Suppose we feed a learning algorithm a lot of historical weather

data, and have it learn to predict weather. In this setting, what is T?</div></div>
		<ul class="list-unstyled" style="margin-top: 20px;">
			<li><input type="checkbox" name="question1" style="margin-left: 112px" value="A">The probability of it correctly predicting a future date's weather.</li>
			<li><input type="checkbox" name="question1" style="margin-left: 112px" value="B">The process of the algorithm examining a large amount of historical weather data.</li>
			<li><input type="checkbox" name="question1" style="margin-left: 112px" value="C">None of these.</li>
			<li><input type="checkbox" name="question1" style="margin-left: 112px;" value="D">The weather prediction task.</li>
		</ul>
	</div>
	<div  id="question2">
	<div class="row">
	<div class="col-sm-1">Q2.</div>
	<div class="col-sm-11">Suppose you are working on weather prediction, and your weather

station makes one of three predictions for each day's weather:

Sunny, Cloudy or Rainy. You'd like to use a learning algorithm

to predict tomorrow's weather.

Would you treat this as a classification or a regression problem?</div></div>
		<ul class="list-unstyled" style="margin-top: 20px;">
			<li><input type="checkbox" name="question2" style="margin-left: 112px;" value="A">Regression</li>
			<li><input type="checkbox" name="question2" style="margin-left: 112px;" value="B">Classification</li>
            <li><input type="checkbox" name="question2" style="margin-left:112px;" value="C">Both</li>
            <li><input type="checkbox" name="question2" style="margin-left:112px;" value="D">Difficult to predict.</li>
		</ul>
	</div>
	<div  id="question3" ><div class="row"><div class="col-sm-1">Q3.</div><div class="col-sm-11">Suppose you are working on stock market prediction, Typically

tens of millions of shares of Microsoft stock are traded

(i.e., bought/sold) each day. You would like to predict the

number of Microsoft shares that will be traded tomorrow.

Would you treat this as a classification or a regression problem?</div></div>
		<ul class="list-unstyled" style="margin-top: 20px;">
			<li><input type="checkbox" name="question3" style="margin-left: 112px" value="A">Regression</li>
			<li><input type="checkbox" name="question3" style="margin-left: 112px" value="B">Classification</li>
		</ul>
	</div>
	<div id="question4" ><div class="row"><div class="col-sm-1">Q4.</div><div class="col-sm-11">Which of these is a reasonable definition of machine learning?</div></div>
	<ul class="list-unstyled" style="margin-top: 20px;">
		<li><input type="checkbox" name="question4" style="margin-left: 112px;"value="A">Machine learning is the field of study that gives computers the ability to learn without being explicitly programmed.</li>
		<li><input type="checkbox" name="question4" style="margin-left: 112px;" value="B">Machine learning learns from labeled data.</li>
		<li><input type="checkbox" name="question4" style="margin-left: 112px;" value="C">Machine learning is the science of programming computers.</li>
		<li><input type="checkbox" name="question4" style="margin-left: 112px;" value="D">Machine learning is the field of allowing robots to act intelligently.</li>
	</ul>
	</div>
	<div id="question5" style="display: none;"><div class="row"><div class="col-sm-1">Q5.</div><div class="col-sm-11"></div></div></div>
		<br>
		<br>
		<div class="row">
				<!--<div class="col-sm-5">	
					<button class="btn" id="Previous">Previous Question</button>
				</div>-->
				<div class="col-sm-6">	
					<button class="btn" id="Submit">Submit</button>
				</div>
				<!--<div class="col-sm-1">	
					<button class="btn" style="float: right" id="Next">Next question</button>
				</div>-->
		</div>
    </form>
	
	</div>
<!--<script type="text/javascript">
	var Q=1;
	var next;
	$("#Next").click(function(){
		if(Q<5)
		{		Q=Q+1;
				next=Q;
				var temp="#question"+next;
				var temp2="#question"+(next-1);
				$(temp).show();
				$(temp2).hide();
	}
	});
	var previous;
	$("#Previous").click(function(){
		if (Q>1){
			Q=Q-1;
			previous=Q;
			var temp="#question"+previous;
			var temp2="#question"+(previous+1);
			$(temp).show();
			$(temp2).hide();
		}
	});
</script>-->
</body>
</html>