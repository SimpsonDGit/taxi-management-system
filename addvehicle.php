<?php 

include 'config.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}
error_reporting(0);

if (isset($_POST['submit'])) 
{
	$regnum = $_POST['regnum'];
	$vehyear = $_POST['vehyear'];
	$vehmake = $_POST['vehmake'];
	$vehmodel = $_POST['vehmodel'];
	$vehcolour = $_POST['vehcolour'];
	$costpd = $_POST['costpd'];
	$fitexp = $_POST['fitexp'];
	$regexp = $_POST['regexp'];
	$insComp = $_POST['inscomp'];
	$insStartDate = $_POST['insStartDate'];
	$insEndDate = $_POST['insEndDate'];
	$doctype = $_POST['doctype'];
	$enginenum = $_POST['enginenum'];
	$chassisnum = $_POST['chassisnum'];

	if (!empty($regnum))
	{
		$sql = "INSERT INTO `vehicle details`(`Vehicle Reg No`, `Year`, `Make`, `Model`, `Colour`, `Cost Per Day`, `Fitness Expiry`, `Registration Expiry`, `Insurance Company`, `Insurance Start Date`, `Insurance End Date`, `Insurance Document`, `Engine No`, `Chassis No`) 
		VALUES ('$regnum','$vehyear','$vehmake','$vehmodel', '$vehcolour', '$costpd','$fitexp','$regexp', '$insComp', '$insStartDate','$insEndDate', '$doctype','$enginenum','$chassisnum')";
		
		$result = mysqli_query($conn, $sql);
			if ($result) 
			{
				$regnum = '';
				$vehyear ='';
				$vehmake = '';
				$vehmodel = '';
				$vehcolour = '';
				$costpd = '';
				$fitexp = '';
				$regexp = '';
				$insStartDate = '';
				$insEndDate = '';
				$enginenum = '';
				$chassisnum = '';
				
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

	<title>Bucai Taxi - Add Vehicle</title>
	<style>
		.row {
		display: flex;
		}

		.column {
		flex: 50%;
		padding-left: 50px;
		}
		.selectdiv 
		{
			max-width: 350px;
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
	<div class="container" style="width:60%">
		<form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Add Vehicle</p>
			<div class="row">
  				<div class="column">
					<div class="input-group">
						<input type="text" placeholder="Reg. #" name="regnum" value="<?php echo $regnum; ?>" required>
					</div>
					<div class="input-group">
						<input type="number" placeholder="Year" name="vehyear" value="<?php echo $vehyear; ?>" required>
					</div>
					<div class="input-group">
						<input type="text" placeholder="Make" name="vehmake" value="<?php echo $vehmake; ?>" required>
					</div>
					<div class="input-group">
						<input type="text" placeholder="Model" name="vehmodel" value="<?php echo $vehmodel; ?>" required>
					</div>
					<div class="input-group">
						<input type="text" placeholder="Colour" name="vehcolour" value="<?php echo $vehcolour; ?>" required>
					</div>
					<div class="input-group">
						<input type="text" placeholder="Engine #." name="enginenum" value="<?php echo $enginenum; ?>" required>
					</div>
					<div class="input-group">
						<input type="text" placeholder="Chassis #" name="chassisnum" value="<?php echo $chassisnum; ?>" required>
					</div>
					<div class="input-group">
						<label for="costpd"> Cost Per Day</label><br>
						<input type="number" placeholder="$0.00" name="costpd" value="<?php echo $costpd; ?>" required>
					</div>
					<br>
					<p class="login-register-text"> <a href="welcome.php">Home Page</a>.</p>
				</div>
  				<div class="column">
					<div class="input-group">
						<label for="fitexp">Fitness Exp. Date</label><br>
						<input type="date" placeholder="Fitness Expiry" name="fitexp" style="width:60%" value="<?php echo $fitexp; ?>" required>
					</div>
					</br>
					<div class="input-group">
						<label for="regexp">Registration Exp. Date</label><br>
						<input type="date" placeholder="Reg. Expiry" name="regexp" style="width:60%" value="<?php echo $regexp; ?>" required>
					</div>
					</br>
					<div class="input-group">
						<div class="selectdiv">
							<select name="inscomp" class="form-control" required>
								<option value="">--Select Insurance Company--</option>
								<?php 
									// use a while loop to fetch data 
									// from the $all_vehicles variable 
									// and individually display as an option
									$sqlComp = "SELECT * FROM `insurance companies`";
									$all_companies = mysqli_query($conn, $sqlComp);
									while($inscomp = mysqli_fetch_assoc($all_companies))
									{ 
								?>
									<option value="<?php echo $inscomp["Company Name"]; ?>">
										<?php echo $inscomp["Company Name"]?>
									</option>
								<?php 
									} 
									// While loop must be terminated
								?>
							</select>
						</div>
					</div>
					<div class="input-group">
						<label for="regexp">Insurance Start Date</label><br>
						<input type="date" placeholder="00/00/0000" name="insStartDate" style="width:60%" value="<?php echo $insStartDate; ?>" required>
					</div>
					</br>
					<div class="input-group">
						<label for="regexp">Insurance End Date</label><br>
						<input type="date" placeholder="00/00/0000" name="insEndDate" style="width:60%" value="<?php echo $insEndDate; ?>" required>
					</div>
					</br>
					<div class="input-group">
						<div class="selectdiv">
							<select name="doctype" class="form-control" required>
								<option value="">--Select Insurance Document--</option>
								<option value="Cover Note">Cover Note</option>
								<option value="Certificate">Certificate</option>
							</select>
						</div>
					</div>
					<div class="input-group">
						<button name="submit" class="btn">Add</button>
					</div>
				</div>
			</div>
				</div>
			</div>
		</div>
			
		</form>
	</div>
</body>
</html>