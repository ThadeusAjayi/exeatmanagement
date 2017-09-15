<?php
session_start();
include("dbconnect.php");

if(!isset($_SESSION['user'])){
	header("location: login.php");
}
       /* $now = time(); // Checking the time now when home page starts.

        if ($now > $_SESSION['expire']) {
			session_unset();
            session_destroy();
            echo "Your session has expired! <a href='http://localhost/leavemanagement/login.php'>Login here</a>";
        }*/
		
		
	if(isset($_POST['submit'])){
		header("Location: dayexeat.php?status=error&msg=Leave application submitted successfully");
			if($_POST['hall'] != "" && $_POST['purpose'] != "" && $_POST['destination'] != "" && $_POST['parent'] != "" && $_POST['pcontact'] != "" && $_POST['sDate'] != "" && $_POST['eDate'] != ""){
			$type = "Day Exeat";
			$name = mysqli_real_escape_string($con,$_POST['name']);
			$matric = mysqli_real_escape_string($con,$_POST['matric']);
			$course = mysqli_real_escape_string($con,$_POST['course']);
			$level = mysqli_real_escape_string($con,$_POST['level']);
			$hall = mysqli_real_escape_string($con,$_POST['hall']);
			$purpose = mysqli_real_escape_string($con,$_POST['purpose']);
			$destination = mysqli_real_escape_string($con,$_POST['destination']);
			$parent = mysqli_real_escape_string($con,$_POST['parent']);
			$pcontact = mysqli_real_escape_string($con,$_POST['pcontact']);
			$startDate = $_POST['sDate'];
			$endDate = $_POST['eDate'];
			
			$sql = "SELECT leave_type FROM leave_application WHERE (leave_matric = '$matric') AND (leave_type = '$type')";
			$query = mysqli_query($con, $sql);
			$result = mysqli_num_rows($query);
			
			if($result < 3){
				$sql = "INSERT INTO leave_application (leave_type,leave_name,leave_matric,leave_course,leave_level,leave_hall,leave_purpose,leave_destination,leave_parent,leave_pcontact,leave_sdate,leave_edate) VALUES ('$type','$name','$matric','$course','$level','$hall','$purpose','$destination','$parent','$pcontact','$startDate','$endDate')";
					if(mysqli_query($con, $sql)){
						header("Location: dayexeat.php?status=success&msg=Leave application submitted successfully") or die(mysqli_error($con, $sql));
					}
			}else{
				header("Location: dayexeat.php?status=error&msg=Maximum Number of Day Exeats Reached For This Semester");
			}	
		}else{
			header("Location: dayexeat.php?status=error&msg=Fill All Fields");
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

		<title>Leave Application</title>
		<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
        </script>
    </head>
	<body>
		<div class="container" style="margin-left: -15px; margin-right: 0;">
		
				<div class="col-md-12">
					
					<div class="row" style="padding-top: 10px">
                    
                    	<div class="col-md-1 col-md-offset-1">
							<img src="img/CU_logo.png" width="100%" height="100%"/>
						</div>
						
						<div class="col-md-3 col-md-offset-7">
							<?php
								echo "Welcome ". $_SESSION['username'] . "&nbsp; &nbsp; &nbsp;|" . " &nbsp; &nbsp;<a href='logout.php'>Logout</a>";
							?>
						</div>
                        
                      												
					</div>
				
										
					<div class="row">
						<h3 class="form-group col-md-offset-1"><b>Student Page</b></h3>	
					</div>
					
					<div class="row">
											
						<div class="col-md-4 form-group">
							<ul>                            
                            	<a href="index.php" class="input-group"><li class="menu-list">Profile</li></a>
								<a href="exeatapplication.php" class="input-group active"><li class="menu-list">Exeat Application</li></a>
								<a href="exeathistory.php" class="input-group"><li class="menu-list">Exeat History</li></a>
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
					
						<div class="row form-control">
						
							<div class="form-group">
								<div class="col-md-3">
									<label for="leave-type" class="form-group">Change Exeat Type:</label>
								</div>
								
								<div class="col-md-5 col-md-offset-1">
									<form name="form" id="form">
									  <select name="jumpMenu" id="jumpMenu" onChange="MM_jumpMenu('parent',this,0)" class="form-control">
										<option value="homeexeat.php">Home Exeat</option>
										<option value="dayexeat.php" selected>Day Exeat</option>
										<option value="bankexeat.php">Bank Exeat</option>
									  </select>
									</form>
								</div>
							</div>
						</div>
						
						<form method="post" action="">

							<div class="row form-control">
								<div class="form-group">
									<div class="col-md-2">
										<label for="leave-type" class="form-group">Exeat Type:</label>
									</div>
									<div  class="col-md-6 col-md-offset-2">
										<input type="text" disabled value="Day Exeat" class="form-control" name="leave-type" />
									</div>
								</div>
							</div>
							
							<div class="row form-control">
								<div class="form-group">
									<div class="col-md-2">
										<label for="leave-type" class="form-group">Name:</label>
									</div>
									<div  class="col-md-6 col-md-offset-2">
										<input type="text" value="<?php echo $_SESSION['username']; ?>" class="form-control" name="name" />
									</div>
								</div>
							</div>
							
							<div class="row form-control">
								<div class="form-group">
									<div class="col-md-2">
										<label for="leave-type" class="form-group">Matric no:</label>
									</div>
									<div  class="col-md-6 col-md-offset-2">
										<input type="text" value="<?php echo $_SESSION['matric']; ?>" class="form-control" name="matric" />
									</div>
								</div>
							</div>
							
							<div class="row form-control">
								<div class="form-group">
									<div class="col-md-2">
										<label for="leave-type" class="form-group">Course:</label>
									</div>
									<div  class="col-md-6 col-md-offset-2">
										<input type="text" value="<?php echo $_SESSION['course']; ?>" class="form-control" name="course" />
									</div>
								</div>
							</div>
							
							<div class="row form-control">
								<div class="form-group">
									<div class="col-md-2">
										<label for="leave-type" class="form-group">Level:</label>
									</div>
									<div  class="col-md-6 col-md-offset-2">
										<input type="text" value="<?php echo $_SESSION['level']; ?>" class="form-control" name="level" />
									</div>
								</div>
							</div>
							
							<div class="row form-control">
								<div class="form-group">
									<div class="col-md-3">
										<label for="leave-type" class="form-group">Hall / Room No:</label>
									</div>
									<div  class="col-md-5 col-md-offset-1">
										<input type="text" value="<?php  ?>" class="form-control" name="hall" />
									</div>
								</div>
							</div>
							
							<div class="row form-control">
								<div class="form-group">
									<div class="col-md-3">
										<label for="leave-type" class="form-group">Purpose:</label>
									</div>
									<div class="col-md-6 col-md-offset-1">
										<input type="text" class="form-control" name="purpose" />
									</div>
								</div>
							</div>
							
							<div class="row form-control">
								<div class="form-group">
									<div class="col-md-3">
										<label for="leave-type" class="form-group">Destination:</label>
									</div>
									<div class="col-md-6 col-md-offset-1">
										<input type="text" class="form-control" name="destination" />
									</div>
								</div>
							</div>
														
							<div class="row form-control">
								<div class="form-group">
									<div class="col-md-2">
										<label for="leave-type" class="form-group">Parent Name:</label>
									</div>
									<div  class="col-md-6 col-md-offset-2">
										<input type="text" class="form-control" name="parent" />
									</div>
								</div>
							</div>
							
							<div class="row form-control">
								<div class="form-group">
									<div class="col-md-3">
										<label for="leave-type" class="form-group">Parent Contact:</label>
									</div>
									<div  class="col-md-5 col-md-offset-1">
										<input type="text" class="form-control" name="pcontact" />
									</div>
								</div>
							</div>
							
							<div class="row form-control">
								<div class="form-group">
									<div class="col-md-3">
										<label for="leave-type" class="form-group">Date of Leave:</label>
									</div>
									<div class="col-md-5 col-md-offset-1">
										<input  class="form-control" type="date" name="sDate"/>
									</div>
								</div>
							</div>
							
							<div class="row form-control">
								<div class="form-group">
									<div class="col-md-3">
										<label for="leave-type" class="form-group">Date of Return:</label>
									</div>
									<div class="col-md-5 col-md-offset-1">
										<input class="form-control" type="date" name="eDate"/>
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

		 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
	</body>
</html>