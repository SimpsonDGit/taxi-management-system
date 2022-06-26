<?php 

include 'config.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}
error_reporting(0);

if (isset($_POST['submit'])) 
{
	$incidentID = $_POST['incidentID'];
	$vehicle = $_POST['vehicle'];
	$incidentdate = $_POST['incidentdate'];
	$incDetails = $_POST['incDetails'];

	if (!empty($incidentID))
	{
		$sql = "INSERT INTO `accident details`(`Incident ID`, `Vehicle Reg No`, `Incident Date`, `Incident Details`)
		VALUES ('$incidentID','$vehicle','$incidentdate','$incDetails')";
		
		$result = mysqli_query($conn, $sql);
		echo $result;
			if ($result) 
			{
				echo "<script>alert('Accident Successfully Logged!.')</script>";
				$incidentID = "";
				$regnum = "";
				$incidentdate = "";
				$incDetails = "";
				header("Location: accidentform.php");
				
			} else 
			{
				echo "<script>alert('There was an issue submitting this form. Please try again')</script>";
			}
	}
	else 
	{
		echo "<script>alert('The registration number field is empty. Please enter a value.')</script>";
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">

	<title>Bucai Taxi - Accident Details</title>
	<style>
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
	<div class="container">
		<form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Accident Form</p>
			<div class="input-group">
				<input type="text" placeholder="Incident ID" name="incidentID" value="<?php echo $incidentID; ?>" required>
			</div>
			
			<div class="input-group">
				<label for="incidentdate">Incident Date: </label>
				<input type="date" placeholder="00/00/00" name="incidentdate" style="width:60%" value="<?php echo $incidentdate; ?>" required>
            </div>
            <div class="input-group">
				<input type="text" placeholder="Details" name="incDetails" value="<?php echo $incDetails; ?>" required>
			</div>
			<div class="input-group">
			<div class="selectdiv">
				<select name="vehicle" required>
					<option value="">Select Vehicle</option>
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
			
			<div class="input-group">
				<button name="submit" class="btn">Add</button>
			</div>
			<p class="login-register-text"> <a href="welcome.php">Home Page</a>.</p>
		</form>
	</div>
</body>
</html>