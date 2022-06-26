<?php 

include 'config.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}
error_reporting(0);


if (isset($_POST['submit'])) 
{
		$trn = $_POST['trn'];
		$fullname = $_POST['fullname'];
		$address = $_POST['address'];
		$cnumber = $_POST['cnumber'];
		$startdate = $_POST['start'];
		$taxicomp = $_POST['taxicomps'];
		$avehicle = $_POST['avehicle'];
		$nextofk = $_POST['nextofk'];
		$nokadd = $_POST['nokadd'];
		$nokcont = $_POST['nokcont'];
		
		$sql = "INSERT INTO `driver details` (`trn`, `full name`, `address`, `contact no`, `start date`, `assigned vehicle`, `next of kin (NOK)`, `NOK contact`, `NOK address`, `taxi company`) 
		VALUES ($trn, '$fullname', '$address', $cnumber, '$startdate','$avehicle', '$nextofk', '$nokcont', '$nokadd', '$taxicomp')";
		
		$run = mysqli_query($conn,$sql) or die(mysqli_error());
		
		if($run) 
		{
			echo "<script>alert('New Driver Added Successfully!')</script>";
			
		}
		else
		{
			echo "<script>alert('Woops! Something went wrong.')</script>";
		}
		
		header("Location: addDriver.php");
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
	<link rel="stylesheet" type="text/css" href="style.css">

	<title>Bucai Taxi - Add Driver</title>
	<style>
		.row {
		display: flex;
		}

		.column {
		flex: 50%;
		padding-left: 10px;
		}
		.selectdiv 
		{
			max-width: 280px;
		}

		/* IE11 hide native button (thanks Matt!) */
		select::-ms-expand {
		display: none;
		}

		.selectdiv:after {
		content: '<>';
		font: 17px "Consolas", monospace;
		color: #333;
		-webkit-transform: rotate(90deg);
		-moz-transform: rotate(90deg);
		-ms-transform: rotate(90deg);
		transform: rotate(90deg);
		right: 11px;
		/*Adjust for position however you want*/
		
		top: 18px;
		padding: 0 0 2px;
		border-bottom: 1px solid #999;
		/*left line */
		
		position: absolute;
		pointer-events: none;
		}

		.selectdiv select {
		-webkit-appearance: none;
		-moz-appearance: none;
		appearance: none;
		/* Add some styling */
		
		display: ;
		width: 100%;
		max-width: 320px;
		height: 50px;
		float: left;
		margin: 5px 0px;
		padding: 0px 24px;
		font-size: 16px;
		line-height: 1.75;
		color: #333;
		background-color: #ffffff;
		background-image: none;
		border: 1px solid #cccccc;
		-ms-word-break: normal;
		word-break: normal;
		}
	</style>
</head>
<body>
	<div class="container" style="width:50%">
		<form action="" method="POST" class="login-email">
			<p class="login-text" style="font-size: 2rem; font-weight: 800;">New Driver</p>
			<div class="row">
				<div class="column">
					<div class="input-group">
						<input type="number" placeholder="TRN" name="trn" value="<?php echo $trn; ?>" required>
					</div>
					
					<div class="input-group">
						<input type="text" placeholder="Full Name" name="fullname" value="<?php echo $fullname; ?>" required>
					</div>

					<div class="input-group">
						<label for="start">Start Date: </label>
						<input type="date" name="start"  style="width:70%" value="<?php echo $start; ?>" required>
					</div>
					<br>
					<div class="input-group">
						<div class="selectdiv">
							<select name="taxicomps" class="form-control">
								<option value="">--Taxi Company--</option>
								<?php 
									// use a while loop to fetch data 
									// from the $all_vehicles variable 
									// and individually display as an option
									$sqltcomps = "SELECT * FROM `taxi companies`";
									$all_tcomps = mysqli_query($conn, $sqltcomps);
									while($taxicomps = mysqli_fetch_assoc($all_tcomps))
									{ 
								?>
									
									<option value="<?php echo $taxicomps["Taxi Company"]; ?>">
										<?php echo $taxicomps["Taxi Company"]?>
									</option>
								<?php 
									} 
									// While loop must be terminated
								?>
							</select>
						</div>
					</div>
					
					<div class="input-group">
						<div class="selectdiv">
							<select name="avehicle" class="form-control">
								<option value="">--Assign Vehicle--</option>
								<?php 
									// use a while loop to fetch data 
									// from the $all_vehicles variable 
									// and individually display as an option
									$sqlVeh = "SELECT * FROM `vehicle details`";
									$all_vehicles = mysqli_query($conn, $sqlVeh);
									while($vehicle = mysqli_fetch_assoc($all_vehicles))
									{ 
								?>
									
									<option value="<?php echo $vehicle["Vehicle Reg No"]; ?>">
										<?php echo $vehicle["Vehicle Reg No"]. " - ". $vehicle["Make"]." ". $vehicle["Model"]." ". $vehicle["Year"]; // To show the vehicle name to the user?>
									</option>
								<?php 
									} 
									// While loop must be terminated
								?>
							</select>
						</div>
					</div>
				</div>
				
				<div class="column">
					<div class="input-group">
						<input type="text" placeholder="Address" name="address" value="<?php echo $address; ?>" required>
					</div>
					
					<div class="input-group">
						<input type="number" placeholder="Driver Contact#" name="cnumber"  style="width:80%" value="<?php echo $cnumber; ?>" required>
					</div>

					<div class="input-group">
						<input type="text" placeholder="Next of Kin (NOK)" name="nextofk" value="<?php echo $nextofk; ?>" required>
					</div>

					<div class="input-group">
						<input type="text" placeholder="NOK Address" name="nokadd" value="<?php echo $nokadd; ?>" required>
					</div>

					<div class="input-group">
						<input type="number" placeholder="NOK Contact #" name="nokcont" value="<?php echo $nokcont; ?>" required>
					</div>

					<div class="input-group">
						<button name="submit" class="btn">Register</button>
					</div>
				</div>
			</div>
			<br>
			<p class="login-register-text"> <a href="welcome.php">Home Page</a>.</p>
		</form>
	</div>
</body>
</html>