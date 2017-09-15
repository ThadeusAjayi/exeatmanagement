<?php
session_start();
include("dbconnect.php");

if(!isset($_SESSION['user'])){
	header("location: login.php");
}
		
	if(isset($_POST['update']) && $_POST['update'] == "Update"){
		header("Location: password.php?status=error&msg=Leave application submitted successfully");
		$pwd = mysqli_real_escape_string($con,$_POST['pwd']);
		$cpwd = mysqli_real_escape_string($con,$_POST['cpwd']);
		
		if($pwd != "" && $cpwd != "" && $pwd == $cpwd){
			$pwd = trim($pwd);
			$cpwd = trim($cpwd);
			
			$cpwd = md5($cpwd);
			
			$sql = "UPDATE students_register SET stud_password ='$cpwd' WHERE stud_name = '".$_SESSION['username']."' ";
			
			if(mysqli_query($con, $sql)){
				header("Location: password.php?status=success&msg=Password Changed Successfully");
			}
		}else{
			header("Location: password.php?status=error&msg=Passwords Do Not Match");
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
                            	<a href="index.php" class="input-group active"><li class="menu-list">Profile</li></a>
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

						<form method="post" action="">
														
							<div class="row form-control">
								<div class="form-group">
									<div class="col-md-3">
										<label for="leave-type" class="form-group">New Password :</label>
									</div>
									<div  class="col-md-5 col-md-offset-1">
										<input type="password" class="form-control" name="pwd" />
									</div>
								</div>
							</div>
							
							<div class="row form-control">
								<div class="form-group">
									<div class="col-md-3">
										<label for="leave-type" class="form-group">Confirm Password:</label>
									</div>
									<div  class="col-md-5 col-md-offset-1">
										<input type="password" class="form-control" name="cpwd" />
									</div>
								</div>
							</div>
														
							<div class="row form-control">
								<div class="form-group">
									<div class="col-md-12">
										<input class="form-control btn-primary" type="submit" name="update" value="Update"/>
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