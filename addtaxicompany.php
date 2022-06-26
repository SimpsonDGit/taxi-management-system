<?php 

include 'config.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}
error_reporting(0);

if (isset($_POST['submit'])) 
{
	$taxicomp = $_POST['taxicomp'];
	$taxicontact = $_POST['contactno'];

	if (!empty($taxicomp))
	{
		$sql = "INSERT INTO `taxi companies` (`Taxi Company`, `Contact No`) VALUES ('$taxicomp', $taxicontact)";
		
		$result = mysqli_query($conn, $sql);
			if ($result) 
			{
				echo "<script>alert('Taxi Company Successfully Added!.')</script>";
				$taxiID = "";
				$taxicomp = "";
				$taxicontact = "";
			} else 
			{
				echo "<script>alert('There was an issue submitting this form. Please try again')</script>";
			}

			header("Location: addtaxicompany.php");
	}
	else 
	{
		echo "<script>alert('The Company Name is empty. Please enter a value')</script>";
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

	<title>Bucai Taxi - Add Taxi Company</title>
</head>
<body>
	<div class="container">
		<form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Add Taxi Company</p>
			<div class="input-group">
				<input type="text" placeholder="Name of Company" name="taxicomp" value="<?php echo $taxicomp; ?>" required>
			</div>
			<div class="input-group">
				<input type="number" placeholder="Contact No." name="contactno" value="<?php echo $taxicontact; ?>" required>
			</div>
			<div class="input-group">
				<button name="submit" class="btn">Add</button>
			</div>
			<p class="login-register-text"> <a href="welcome.php">Home</a>.</p>
		</form>
	</div>
</body>
</html>