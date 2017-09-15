<?php
session_start();
include ("../dbconnect.php");

if(!isset($_SESSION['admin'])){
	header("location: login.php");
}
		$sql = "SELECT * FROM leave_application WHERE approval_status = 'approved'";
		$result = mysqli_query($con,$sql);
		if($result){
			$msg = "successs";
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

		<title>Security</title>
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
						<h3 class="form-group col-md-offset-1"><b>Security Page</b></h3>	
					</div>
					
					<div class="row">
					
										
					<div class="row">
						<div class="col-md-4 form-group">
							<ul>
								<a href="security.php" class="input-group active"><li class="menu-list">Approved Exeat Applications</li></a>
							</ul>
						</div>
					
						<div class="col-md-8 form-group">
							<div class="row">
								<div class="col-md-12 col-xs-12">
										<?php
											$count = 1;
											
											if( mysqli_num_rows($result) ==0 ){
												echo "<div class='col-md-12'><tr></tr></div>";
											  }elseif(mysqli_num_rows($result) > 0){
												  echo "<table class='table table-hover table-bordered col-md-12'>";
													echo "<thead>";
														echo "<th>S/N</th>";
														echo "<th>STUDENT NAME</th>";
														echo "<th>LEAVE TYPE</th>";
														echo "<th>START DATE</th>";
														echo "<th>END DATE</th>";
														echo "<th>STATUS</th>";
													echo "</thead>";
												while( $row = mysqli_fetch_assoc($result) ){
												  echo "<tbody><tr class='success'>";
												  echo "<td>$count</td>";
												  echo "<td>{$row['leave_name']}</td>";
												  echo "<td>{$row['leave_type']}</td>";
												  echo "<td>{$row['leave_sdate']}</td>";
												  echo "<td>{$row['leave_edate']}</td>";
												  echo "<td>{$row['approval_status']}</td>";
												  echo "</tr>";
												  
												  $count++;
												}
												echo "</tbody></table>";
											  }
										?>
							
								</div>
							</div>
				
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