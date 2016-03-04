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
				<div class="col-xs-6 logo">
					<img src="res\logo.png"><br/>
					<span class="desc">A Student Discussion Forum</span>
				</div>
				<div class="col-xs-3 reg-btn"><button class="btn-login btn btn-md"><a href="register.php" class="btn-reg">Register</a></button></div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-xs-4"></div>
				<div class="col-xs-4">
					<div class="login-form">
						<?php
							session_start();
							if(isset($_SESSION['un'])) {
								header('location:home.php');
							} else {
								$db=mysqli_connect("localhost","root","") or die('Cannot connect to DB');
								mysqli_query($db,"CREATE DATABASE IF NOT EXISTS osp") or die('Cannot create DB');
								mysqli_select_db($db,"osp");
								mysqli_query($db,"CREATE TABLE IF NOT EXISTS login_1(un varchar(10) NOT NULL, pd varchar(10) NOT NULL, name varchar(20), gender varchar(1))") or die('Cannot create Table');
								if(isset($_POST['btn1'])) {
									$result=mysqli_query($db,"SELECT * FROM login_1");
									if(mysqli_num_rows($result)==0) {
									mysqli_query($db,"INSERT INTO login_1 VALUES('root','password','root','m')");
									}
									$un=$_POST['un'];
									$pdu=$_POST['pd'];
									if(!empty($un) && !empty($pdu)) {
									$pd=mysqli_query($db,"SELECT pd FROM login_1 WHERE un='$un'");
										if(mysqli_num_rows($pd)>0) {
											$row=mysqli_fetch_array($pd);
											if($row['pd']==$pdu) {
											$_SESSION['un']=$un;
												header("Location:home.php");
											} else {
												echo "<div class=\"alert alert-reg alert-danger\">Incorrect <strong>Password!</strong></div>";
											}
										} else {
											echo "<div class=\"alert alert-reg alert-info\">No such <strong>User</strong>!</div>";
										}
									}
								}
							}
						?>
						<form action="index.php" method="POST">
							<input type="text" class="form-control input-lg" placeholder="Username" name="un" required><br/>
							<input type="password" class="form-control input-lg" placeholder="Password" name="pd" required></br>
							<input type="submit" class="btn-lg btn-block btn-login" value="Login" name="btn1"><br/>
						</form>
					</div>
				</div>
				<div class="col-xs-4"></div>
			</div>
		</div>
	</body>
</html>