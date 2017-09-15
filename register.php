<?php
session_start();
include ("dbconnect.php");
	
	if(isset($_POST['submit']) && $_POST['submit'] == "Submit"){
		$name = mysqli_real_escape_string($con,$_POST['name']);
		$dept = mysqli_real_escape_string($con,$_POST['dept']);
		$phone = mysqli_real_escape_string($con,$_POST['phone']);
		$email = mysqli_real_escape_string($con,$_POST['email']);
		$password = md5(mysqli_real_escape_string($con,$_POST['password']));
		$confirmpass = md5(mysqli_real_escape_string($con,$_POST['confirmpass']));
		
		$name = trim($name);
		$dept = trim($dept);
		$phone = trim($phone);
		$email = trim($email);
		$password = trim($password);
		$confirmpass = trim($confirmpass);
		
		if($password != $confirmpass){
			?>
			<script>alert("Passwords do not match");</script>
			<?php
		}else{
		
		$sql = "SELECT stud_email, stud_phone FROM students_register WHERE stud_email = '$email' || stud_phone ='$phone'";
		$result = mysqli_query($con,$sql);
		$count = mysqli_num_rows($result);
		
		
		if($count == 0){
			false;
				if(mysqli_query($con,"INSERT INTO students_register (stud_name, stud_dept, stud_phone, stud_email, stud_password) VALUES ('$name','$dept','$phone','$email','$password')")){
				?>
				<script>alert("registration successful");</script>
				<?php
			}else{
				header("location: register.php?status=error&msg=Registration Failed");
				
		}
		
	}else{
		header("location: register.php?status=error&msg=Email or Phone number already used");
		}
	}
		
		
	}

?>
<!DOCTYPE html>
<html lang="en">
    <head> 
		<meta name="viewport" content="width=device-width, initial-scale=1">


		<!-- Website CSS style -->
		<link href="css/bootstrap.min.css" rel="stylesheet">

		<!-- Website Font style -->
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
		<link rel="stylesheet" href="style.css">
		<!-- Google Fonts -->
		<link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>

		<title>Leave | Register</title>
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
				<h5 class="text-center"><a href="login.php" style="color: white;"><u>Click Here Login</u></a></h5>
					<form class="" method="post" action="">
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Your Name</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input required="required" type="text" class="form-control" name="name" id="name"  placeholder="Enter your Name"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="department" class="cols-sm-2 control-label">Department</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="dept" id="dept"  placeholder="Department"/>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="phone" class="cols-sm-2 control-label">Phone</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-phone fa" aria-hidden="true"></i></span>
									<input required="required" type="text" class="form-control" name="phone" id="phone"  placeholder="Mobile"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="email" class="cols-sm-2 control-label">Email</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
									<input required="required" type="text" class="form-control" name="email" id="email"  placeholder="Enter your Email"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="password" class="cols-sm-2 control-label">Password</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
									<input type="password" class="form-control" name="password" id="password"  placeholder="Enter your Password"/>
								</div>
							</div>
						</div>
						

						<div class="form-group">
							<label for="confirm" class="cols-sm-2 control-label">Confirm Password</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
									<input type="password" class="form-control" name="confirmpass" id="confirmpass"  placeholder="Confirm your Password"/>
								</div>
							</div>
							<!-- echo password not match here -->
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
    <script src="js/bootstrap.min.js"></script>
	</body>
</html>