<?php
session_start();
include("dbconnect.php");

if(!isset($_SESSION['user'])){
	header("location: login.php");
}

	//$sql = "SELECT * FROM leave_application WHERE leave_stud_name ='{$_SESSION['username']}'";
	$sql = "SELECT * FROM leave_application WHERE leave_name ='$_SESSION[username]'";
	$result = mysqli_query($con,$sql);

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

		<title>Admin</title>
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
							<?php
	$count = 1;
	if(mysqli_num_rows($result) == 0 ){ ?>
		<div class='col-md-8'><tr>No Record Found</tr></div>
	<?php  }elseif(mysqli_num_rows($result) > 0){ ?>
		  <table id="table" class="table table-hover table-bordered col-md-8 table-striped" style="margin-left: -15px; margin-right: 0;">
            <thead>
                <th class="col-md-1 text-center">S/N</th>
                <th class='col-md-2'>LEAVE TYPE</th>
                <th class='col-md-2'>START DATE</th>
				<th class='col-md-2'>END DATE</th>
				<th class='col-md-1'>STATUS</th>
				<th class='col-md-4'>MESSAGE</th>
            </thead>
		<?php while($rows=mysqli_fetch_array($result)) {extract($rows); ?>
		  <tbody><tr>
		  <td><?php echo $count ;?></td>
		  <td><?php echo $leave_type; ?></td>
		  <td><?php echo $leave_sdate; ?></td>
		  <td><?php echo $leave_edate; ?></td>
		  <td><?php echo $approval_status; ?></td>
		  <td><?php echo $leave_purpose; ?></td>
		  </tr>
		<?php  $count ++; 
		} ?>
		</tbody></table>
	<?php  }
?>
						</div>
					</div>
					
					
					
					<div class="row">
					<div class="col-md-12 col-xs-12">

					
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