<?php
session_start();
include ("../dbconnect.php");

if(isset($_SESSION['admin'])!= ""){
	header("location: index.php");
}
	if(isset($_POST['submit']) && $_POST['submit'] == "Submit"){
		
			$email = mysqli_real_escape_string($con,$_POST['email']);
			$pwd = mysqli_real_escape_string($con,$_POST['password']);
			
			if($email != "" && $pwd != ""){
			$email = trim($email);
			$pwd = trim($pwd);
			
			$sql = "SELECT * FROM admin_data WHERE admin_email = '$email'" ;
			$query = mysqli_query($con,$sql);
			$row = mysqli_fetch_array($query);
			$count = mysqli_num_rows($query);
			
				if($count == 1 && $row['admin_pwd'] == md5($pwd)){
					$_SESSION['admin'] = $row['id'];
					$_SESSION['adminuser'] = $row['admin_name'];
					$_SESSION['type'] = $row['admin_type'];
				/*	$_SESSION['start'] = time();
					$_SESSION['expire'] = $_SESSION['start'] + 60;*/
					if($_SESSION['type'] == "admin"){
					header("location: index.php");
					}else{
						header("location: security.php");
					}
				}else{
					header("location: login.php?status=error&msg=Username or Password incorrect");
				}
			}else{
				header("location: login.php?status=error&msg=Username or Password missing");
			}
			
	}

?>
<!DOCTYPE html>
<html lang="en">
    <head> 
		<meta name="viewport" content="width=device-width, initial-scale=1">


		<!-- Website CSS style -->
		<link href="../css/bootstrap.min.css" rel="stylesheet">

		<!-- Website Font style -->
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
		<link rel="stylesheet" href="../style.css">
		<!-- Google Fonts -->
		<link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>

		<title>Leave | Login</title>
	</head>
	<body>
		<div class="container">
					<div class="col-md-4 col-md-offset-4 text-center" >
						<?php 
							if(isset($_GET["status"])){
								$msg = $_GET["msg"];
								echo "<div class='alert alert-warning msg'>$msg</div>";
							}
						
						?>
					</div>
			<div class="row main">
					
				<div class="main-login main-center">
				<h3 class="text-center" style="color: white;">Admin Login</h3>
					<form class="" method="post" action="">
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Email</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input required type="email" class="form-control" name="email" id="email"  placeholder="Enter your Email"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="department" class="cols-sm-2 control-label">Password</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
									<input type="password" class="form-control" name="password" id="password"  placeholder="Password"/>
								</div>
							</div>
						</div>
						

						<div class="form-group ">
							<input type="submit" name="submit" value="Submit" class="btn btn-primary btn-lg btn-block login-button"/>
						</div>
					</form>
				</div>
			</div>
		</div>

		 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
	</body>
</html>