<?php
	session_start();
	if(!isset($_SESSION['un'])) {
		header('location:index.php');
	}
?>
<html>
	<head>
		<title><?php echo "Discuzz ".strtoupper($_SESSION['un']);?></title>
		<link rel="stylesheet" href="style.css">
		<link rel="stylesheet" href="bootstrap-3.3.5-dist\css\bootstrap.min.css">
		<link rel="stylesheet" href="bootstrap-3.3.5-dist\css\bootstrap-theme.min.css">
		<link rel="stylesheet" href="bootstrap-3.3.5-dist\js\bootstrap.min.js">
	</head>
	<body>
		<div class="container-fluid nav-bar">
			<div class="row">
				<div class="col-xs-4 nav-bar-left"><a href="home.php"><button class="btn">Home</button></a></div>
				<div class="col-xs-4 nav-bar-center"><a href="home.php"><img src="res/logo-small.png"></a></div>
				<div class="col-xs-4 nav-bar-right">
					<span class="wel-msg"><?php echo "Welcome ".strtoupper($_SESSION['un'])."!"; ?></span>&nbsp;
		    		<a href="logout.php"><button class="btn">Logout</button></a>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-xs-3"></div>
				<div class="col-xs-6">
					<div class="feedback-form">
						<div>
							<?php
								if(isset($_POST['feed-btn'])) {
									$msg = "Feedback is \"".$_POST['comment']."\" and rating is \"".$_POST['rate']."\"";
									$msg = wordwrap($msg,70);
									$from = $_POST['email'];
									$headers = "From: ".$from;
									if(mail("rajeevdesai94@gmail.com","Feedback",$msg,$headers)) {
										echo "<div class=\"alert alert-success\">Feedback <strong>Submitted!</strong></div>";
									} else {
										echo "<div class=\"alert alert-danger\">Feedback <strong> not Submitted!</strong></div>";
									}
								}
							?>
						</div>
						<form action="feedback.php" method="POST">
							<input type="text" class="form-control input-lg" placeholder="Email" name="email" required><br/>
							<textarea class="form-control" rows="5" id="comment" placeholder="Comments" name="comment"></textarea><br/>
							<div class="rate-div">
								Please rate us! (1 is lowest)&nbsp;
								<input type="radio" class="radio-inline" value="1" name="rate">&nbsp;1&nbsp;
								<input type="radio" class="radio-inline" value="2" name="rate">&nbsp;2&nbsp;
								<input type="radio" class="radio-inline" value="3" name="rate" checked>&nbsp;3&nbsp;
								<input type="radio" class="radio-inline" value="4" name="rate">&nbsp;4&nbsp;
								<input type="radio" class="radio-inline" value="5" name="rate">&nbsp;5&nbsp;
							</div><br/>
							<input type="submit" class="btn" value="Submit Feedback" name="feed-btn">
						</form>
					</div>
				</div>
				<div class="col-xs-3"></div>
			</div>
		</div>
	</body>
</html>