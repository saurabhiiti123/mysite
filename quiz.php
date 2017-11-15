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
 <?php session_start();
 $aid=$_SESSION["acct_id"];$cid=$_SESSION["course_id"];

 		
 		
 		$conn=mysqli_connect("localhost","root","","learnX");
 		$query="select * from Exam where course_id=$cid order by rand() limit 1;";
 		$ele=mysqli_query($conn,$query);
 		$row=mysqli_fetch_assoc($ele);
 		$_SESSION['exam_id']=$row['exam_id'];

       
        mysqli_close($conn);
        if($row==NULL){
            echo '<script>alert("This facility is not yet made by the Instructor.");
            window.location.assign("course_page.php");</script>';
        }
   

?>
<div class="container" style="padding-top: 50px">
<form method="post" action="quiz_validate.php">

	<div id="question1"><div class="row"><div class="col-sm-1">Q1.</div><div class="col-sm-11"><?php echo $row["question_1"];?></div>
</div>
		<div class="form-group">
						<label for="form-elem2" class="control-label">Your answer</label>
						<input type="text" class="form-control" style="width:50%" autofocus="autofocus" required="required" name="ans_1">
		</div>
	</div>
	<div id="question2"><div class="row"><div class="col-sm-1">Q2.</div><div class="col-sm-11"><?php echo $row["question_2"];?></div>
</div>
		<div class="form-group">
						<label for="form-elem2" class="control-label">Your answer</label>
						<input type="text" class="form-control" style="width:50%" autofocus="autofocus" required="required" name="ans_2">
		</div>
	</div>
	
		
		<div class="row" style="padding: 50px">
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