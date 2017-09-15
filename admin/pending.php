<?php
session_start();
include ("../dbconnect.php");
error_reporting(0);

if(!isset($_SESSION['admin'])){
	header("location: login.php");
}

	if($_GET['approve']!=""){
		$sql = "UPDATE leave_application SET approval_status='Approved' WHERE leave_id='".$_GET['approve']."'";
		$result_approve=mysqli_query($con,$sql);
	}

	if($_GET['decline']!=""){
		$sql= "UPDATE leave_application SET approval_status='Declined' WHERE leave_id='".$_GET['decline']."'";
		$result_decline=mysqli_query($con,$sql);
	}

		$sql = "SELECT * FROM leave_application WHERE approval_status = 'pending'";
		$result = mysqli_query($con,$sql);
	
	$count = 1;
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
						<div class="col-md-12 col-xs-12">
							<table id='table' class='table table-hover table-bordered col-md-12 table-striped'>
								  <thead>
										<th>S/N</th>
									 <th class='col-md-2'>NAMES</th>
									  <th class='col-md-2'>LEAVE TYPE</th>
									  <th class='col-md-2'>START DATE</th>
										<th class='col-md-2'>END DATE</th>
										<th class='col-md-1'>STATUS</th>
										<th class='col-md-1'>MESSAGE</th>
										<th class='col-md-2'>ACTION</th>
									</thead>
								<tbody>
								<?php while($rows=mysqli_fetch_array($result)) {extract($rows); ?>
								
								<tr>
								  <td><?php echo $count; ?></td>
								 <td><?php echo $leave_name; ?></td>
								 <td><?php echo $leave_type; ?></td>
								  <td><?php echo $leave_sdate; ?></td>
								 <td><?php echo $leave_edate; ?></td>
								  <td><?php echo $approval_status; ?></td>
								  <td><?php echo $leave_purpose; ?></td>
								 <td>
									<form name="form" id="form">
									  <select name="jumpMenu" id="jumpMenu" onChange="MM_jumpMenu('parent',this,0)">
										<option value="index.php">Select</option>
										<option value="index.php?approve=<?php echo $leave_id; ?>">Approve</option>
										<option value="index.php?decline=<?php echo $leave_id; ?>">Decline</option>
									  </select>
									</form>
								  </td>
								 </tr><?php $count++ ;}?>	
								</tbody></table>
					
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