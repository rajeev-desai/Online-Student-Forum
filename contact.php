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
		<div class="footer">
			<a href="feedback.php" class="footer-color">Feedback</a>&nbsp;&nbsp;
		</div>
	</body>
</html>