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
						
						<div class="row form-control">
						
							<div class="form-group">
								<div class="col-md-3">
									<label for="leave-type" class="form-group">Change Exeat Type:</label>
								</div>
								
								<div class="col-md-5 col-md-offset-1">
									<form name="form" id="form">
									  <select name="jumpMenu" id="jumpMenu" onChange="MM_jumpMenu('parent',this,0)" class="form-control">
										<option value="exeatapplication.php">Exeat Type</option>
										<option value="homeexeat.php">Home Exeat</option>
										<option value="dayexeat.php">Day Exeat</option>
										<option value="bankexeat.php">Bank Exeat</option>
									  </select>
									</form>
								</div>
							</div>
						</div>
						
						
						</div>
					</div>
					<?php
						if(isset($_GET["status"])){
							$msg = $_GET["msg"];
							echo "<div class='alert alert-success msg col-md-offset-4'>$msg</div>";
						}
					
					
					?>					
					
			</div>
			
		</div>

		 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
	</body>
</html>