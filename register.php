<html>
	<head>
		<title>Discuzz</title>
		<link rel="stylesheet" href="style.css">
		<link rel="stylesheet" href="bootstrap-3.3.5-dist\css\bootstrap.min.css">
		<link rel="stylesheet" href="bootstrap-3.3.5-dist\css\bootstrap-theme.min.css">
		<link rel="stylesheet" href="bootstrap-3.3.5-dist\js\bootstrap.min.js">
	</head>
	<body class="back">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-3"></div>
				<div class="col-xs-6 logo-reg">
					<img src="res\logo.png"><br/>
					<span class="desc">A Student Discussion Forum</span>
				</div>
				<div class="col-xs-3 reg-btn"><button class="btn-login btn btn-md"><a href="index.php" class="btn-reg">Login</a></button></div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-xs-4"></div>
				<div class="col-xs-4">
					<div class="register-form">
						<?php
							session_start();
							$db=mysqli_connect("localhost","root","") or die('Cannot connect to DB');
							mysqli_query($db,"CREATE DATABASE IF NOT EXISTS osp") or die('Cannot create DB');
							mysqli_select_db($db,"osp");
							mysqli_query($db,"CREATE TABLE IF NOT EXISTS login_1(un varchar(10) NOT NULL, pd varchar(10) NOT NULL, name varchar(20), gender varchar(1))") or die('Cannot create Table');
							if(isset($_POST['btn1'])) {
								$un=$_POST['un'];
								$pd=$_POST['pd'];
								$name=$_POST['name'];
								$gender=$_POST['gender'];
								if($_SESSION['captcha']==$_POST['captcha']) {
									mysqli_query($db,"INSERT INTO login_1 VALUES ('$un','$pd','$name','$gender')") or die('Cannot Insert into Database');
									echo "<div class=\"alert alert-reg alert-success\">Thank you for registering.</div>";
								} else {
									echo "<div class=\"alert alert-reg alert-danger\">Captcha is wrong.</div>";
								}
							}
						?>
						<form action="register.php" method="POST">
							<input type="text" class="form-control input-lg" placeholder="Username" name="un" required><br/>
							<input type="password" class="form-control input-lg" placeholder="Password" name="pd" required><br/>
							<input type="text" class="form-control input-lg" placeholder="Name" name="name"required><br/>
							<div class="gender-div"><input type="radio" class="radio-inline" value="m" name="gender" checked>&nbsp;Male&nbsp;<input type="radio" class="radio-inline" value="f" name="gender">&nbsp;Female</div><br/>
							<div class="gender-div">
								<img src="captcha.php" alt="Image created by a PHP script" width="360" height="75"><br/><br/>
								<input type="text" class="form-control input-lg" placeholder="Enter Captcha" name="captcha" required><br/>
							</div>
							<input type="submit" class="btn-lg btn-login btn-block" value="Register" name="btn1"><br/>
						</form>
					</div>
				</div>
				<div class="col-xs-4"></div>
			</div>
		</div>
	</body>
</html>