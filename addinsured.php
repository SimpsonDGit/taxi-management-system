<?php 

include 'config.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}
error_reporting(0);

if (isset($_POST['submit'])) 
{
	$insComp = $_POST['insCompany'];
	$contactno = $_POST['contactno'];

	if (!empty($insComp))
	{
		$sql = "INSERT INTO `insurance companies` (`Company Name`, `Contact No`) VALUES ('$insComp', $contactno)";
		
		$result = mysqli_query($conn, $sql);
			if ($result) 
			{
				echo "<script>alert('Insurance Company Successfully Added!.')</script>";
				$insID = "";
				$insComp = "";
				$contactno = "";
			} else 
			{
				echo "<script>alert('There was an issue submitting this form. Please try again')</script>";
			}

			header("Location: addinsured.php");
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

	<title>Bucai Taxi - Add Insurance Company</title>
</head>
<body>
	<div class="container">
		<form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Add Insurance Company</p>
			<div class="input-group">
				<input type="text" placeholder="Name of Company" name="insCompany" value="<?php echo $insComp; ?>" required>
			</div>
			<div class="input-group">
				<input type="number" placeholder="Contact No." name="contactno" value="<?php echo $contactno; ?>" required>
			</div>
			<div class="input-group">
				<button name="submit" class="btn">Add</button>
			</div>
			<p class="login-register-text"> <a href="welcome.php">Home</a>.</p>
		</form>
	</div>
</body>
</html>