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
				<div class="col-xs-4"></div>
				<div class="col-xs-4 nav-bar-center"><img src="res/logo-small.png"></div>
				<div class="col-xs-4 nav-bar-right">
					<span class="wel-msg"><?php echo "Welcome ".strtoupper($_SESSION['un'])."!"; ?></span>&nbsp;
		    		<a href="logout.php"><button class="btn">Logout</button></a>
				</div>
			</div>
		</div>
		<div class="back_1">
			<div class="container alert-post">
				<?php
					$db=mysqli_connect("localhost","root","") or die('Cannot connect to DB');
					mysqli_query($db,"CREATE DATABASE IF NOT EXISTS osp");
					mysqli_select_db($db,"osp");
					mysqli_query($db,"CREATE TABLE IF NOT EXISTS post(id INT PRIMARY KEY AUTO_INCREMENT,un varchar(10) NOT NULL, query varchar(140), file varchar(25), time timestamp)");
					$result=mysqli_query($db,"SELECT * FROM post");
					if(mysqli_num_rows($result)==0) {
						mysqli_query($db,"INSERT INTO post(un,query) VALUES('root','Welcome to Student Discussion Forum!')");
					}
					if(isset($_POST['btn'])) {
						$post="";
						if(isset($_POST['q'])) {
							if(strlen($_POST['q'])<140) {
								$post=$_POST['q'];
								$un=$_SESSION['un'];
								$file="";
								$query="INSERT INTO post(un,query,file) VALUES ('$un','$post','$file')";
								mysqli_query($db,$query) or die('Cannot Insert into Database');
								echo "<div class=\"alert alert-success\">Posted Successfully!</div>";
							} else {
								echo "<div class=\"alert alert-danger\">Query must less than 140 characters!</div>";
							}
						}
					}
				?>
			</div>
			<div class="container">
				<div class="row post">
					<div class="col-xs-10">
						<form action="home.php" method="POST" enctype="multipart/form-data">
							<input type="text" class="form-control input-lg" placeholder="Post your query" name="q" required>
					</div>
					<div class="col-xs-2">
							<input type="submit" class="btn btn-login btn-block btn-lg" onclick="myFunction()" value="Post" name="btn"><br/>
						</form>
					</div>
				</div>
			</div>
			<div class="container" id="mainDiv">
				<?php
					$db=mysqli_connect("localhost","root","") or die('Cannot connect to DB');
					mysqli_query($db,"CREATE DATABASE IF NOT EXISTS osp");
					mysqli_select_db($db,"osp");
					mysqli_query($db,"CREATE TABLE IF NOT EXISTS post(un varchar(10) NOT NULL, query varchar(140), file varchar(25), time timestamp)");
					$result=mysqli_query($db,"SELECT * FROM post ORDER BY id DESC");
					$rows=mysqli_num_rows($result);
					for($i=0;$i<$rows;$i++) {
						$row=mysqli_fetch_array($result);
						if($i%2==0) {
							echo "<div class=\"container\" id=\"entryDiv-white\"><div class=\"row\"><div class=\"col-xs-9\"><h4>".strtoupper($row['un'])."</h4><h5>".$row['query']."</h5></div><div class=\"col-xs-3\" id=\"time\"><h6>".$row['time']."</h6></div></div></div>";
						} else {
							echo "<div class=\"container\" id=\"entryDiv-black\"><div class=\"row\"><div class=\"col-xs-9\"><h4>".strtoupper($row['un'])."</h4><h5>".$row['query']."</h5></div><div class=\"col-xs-3\" id=\"time\"><h6>".$row['time']."</h6></div></div></div>";
						}
					}
				?>
			</div>
		</div>
		<div class="footer">
			<a href="feedback.php" class="footer-color">Feedback</a>&nbsp;&nbsp;
		</div>
	</body>
</html>