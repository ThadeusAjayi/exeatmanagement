<?php
session_start();
include ("../dbconnect.php");
error_reporting(0);

if(!isset($_SESSION['admin'])){
	header("location: login.php");
}

	if(isset($_POST['submit'])){
		header("Location: createstudent.php?status=error&msg=Student Profile Created Successfully");
		if($_POST['name'] != "" && $_POST['matric'] != "" && $_POST['password'] != "" && $_POST['course'] != "" && $_POST['level'] != "" && $_POST['hall'] != ""){
			$name = mysqli_real_escape_string($con,$_POST['name']);
			$matric = mysqli_real_escape_string($con,$_POST['matric']);
			$password = mysqli_real_escape_string($con,$_POST['password']);
			$course = mysqli_real_escape_string($con,$_POST['course']);
			$level = mysqli_real_escape_string($con,$_POST['level']);
			$hall = mysqli_real_escape_string($con,$_POST['hall']);
			
			$name = trim($name);
			$matric = trim($matric);
			$password = trim($password);
			$course = trim($course);
			$level = trim($level);
			$hall = trim($hall);
			
			$pwd = md5($password);
			
			$sql = "SELECT * FROM students_register WHERE stud_matric = '$matric'";
			$query = mysqli_query($con, $sql);
			$result = mysqli_num_rows($query);
			
				if(!$result > 0 ){
				$sql = "INSERT INTO students_register (stud_name,stud_matric,stud_password,stud_course,stud_level,stud_hall) VALUES ('$name','$matric','$pwd','$course','$level','$hall')";
				if(mysqli_query($con, $sql)){
					header("Location: createstudent.php?status=error&msg=Student Profile Created Successfully");
				}
			}else{
				header("Location: createstudent.php?status=error&msg=Matric number has been registered");
			}
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
		

		<title>Admin</title>
	
    </head>
	<body>
		<div class="container" style="margin-left: -15px; margin-right: 0;">
		
				<div class="col-md-12">
					
					<div class="row" style="padding-top: 10px">
                    
                    	<div class="col-md-1 col-md-offset-1">
							<img src="../img/CU_logo.png" width="100%" height="100%"/>
						</div>
						
						<div class="col-md-3 col-md-offset-7">
							<?php
								echo "Welcome ". $_SESSION['adminuser'] . "&nbsp; &nbsp; &nbsp;|" . " &nbsp; &nbsp;<a href='logout.php'>Logout</a>";
							?>
						</div>
                        
                      												
					</div>
				
					<div class="row">
						<h3 class="form-group col-md-offset-1"><b>Admin Page</b></h3>	
					</div>
					
					<div class="row">
					
										
					<div class="row">
						<div class="col-md-4 form-group">
							<ul>
								<a href="index.php" class="input-group active"><li class="menu-list">Student Leave Applications</li></a>
								<a href="pending.php" class="input-group"><li class="menu-list">Pending Applications</li></a>
								<a href="approved.php" class="input-group"><li class="menu-list">Approved Applications</li></a>
								<a href="declined.php" class="input-group"><li class="menu-list">Declined Applications</li></a>
								<a href="createstudent.php" class="input-group"><li class="menu-list">Create Student Profile</li></a>
								<a href="password.php" class="input-group"><li class="menu-list">Change Password</li></a>
							</ul>
						</div>
					
						<div class="col-md-8 form-group">
							<div class="row">
						
								<?php
									if(isset($_GET["status"])){
										$msg = $_GET["msg"];
										echo "<div class='col-md-10 col-md-offset-1 alert alert-success'>$msg</div>";
									}
								
								
								?>
							</div>
						
						
						<form method="post" action="">

							<div class="row form-control">
								<div class="form-group">
									<div class="col-md-2">
										<label for="leave-type" class="form-group">Name:</label>
									</div>
									<div  class="col-md-6 col-md-offset-2">
										<input type="text" class="form-control" name="name" />
									</div>
								</div>
							</div>
							
							<div class="row form-control">
								<div class="form-group">
									<div class="col-md-2">
										<label for="matric" class="form-group">Matric no:</label>
									</div>
									<div  class="col-md-6 col-md-offset-2">
										<input type="text" class="form-control" name="matric" />
									</div>
								</div>
							</div>
							
							<div class="row form-control">
								<div class="form-group">
									<div class="col-md-2">
										<label for="leave-type" class="form-group">Password:</label>
									</div>
									<div  class="col-md-6 col-md-offset-2">
										<input type="text" class="form-control" name="password" />
									</div>
								</div>
							</div>
							
							<div class="row form-control">
								<div class="form-group">
									<div class="col-md-2">
										<label for="leave-type" class="form-group">Course:</label>
									</div>
									<div  class="col-md-6 col-md-offset-2">
										<input type="text" class="form-control" name="course" />
									</div>
								</div>
							</div>
							
							<div class="row form-control">
								<div class="form-group">
									<div class="col-md-2">
										<label for="leave-type" class="form-group">Level:</label>
									</div>
									<div  class="col-md-6 col-md-offset-2">
										<input type="text" class="form-control" name="level" />
									</div>
								</div>
							</div>
							
							<div class="row form-control">
								<div class="form-group">
									<div class="col-md-3">
										<label for="leave-type" class="form-group">Hall / Room No:</label>
									</div>
									<div  class="col-md-6 col-md-offset-1">
										<input type="text" class="form-control" name="hall" />
									</div>
								</div>
							</div>
														
							<div class="row form-control">
								<div class="form-group">
									<div class="col-md-12">
										<input class="form-control btn-primary" type="submit" name="submit" value="Submit"/>
									</div>
								</div>
							</div>
						
						</form>
						</div>
					</div>
						</div>
					
					
					
				
			</div>
			
		</div>

		 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
	</body>
</html>