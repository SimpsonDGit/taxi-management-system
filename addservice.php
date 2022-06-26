<?php 

include 'config.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}
error_reporting(0);

if (isset($_POST['submit'])) 
{
	$avehicle = $_POST['avehicle'];
	$servdate = $_POST['servdate'];
	$servcost = $_POST['servcost'];
	$description = $_POST['atasks']. " - $". $_POST['itemcost'];

	//Check if more than one task was selected for servicing
	if(isset($_POST['atasks2']))
	{
		$description = $_POST['atasks']. " - $". $_POST['itemcost']. " | " . $_POST['atasks2']. " - $". $_POST['itemcost2'];
	}
	if(isset($_POST['atasks3']))
	{
		$description = $_POST['atasks']. " - $". $_POST['itemcost']. " | " . $_POST['atasks2']. " - $". $_POST['itemcost2']. " | " .
		$_POST['atasks3']. " - $". $_POST['itemcost3'];
	}
	if(isset($_POST['atasks4']))
	{
		$description = $_POST['atasks']. " - $". $_POST['itemcost']. " | " . $_POST['atasks2']. " - $". $_POST['itemcost2']. " | " .
		$_POST['atasks3']. " - $". $_POST['itemcost3']. " | " .$_POST['atasks4']. " - $". $_POST['itemcost4'];
	}
	if(isset($_POST['atasks5']))
	{
		$description = $_POST['atasks']. " - $". $_POST['itemcost']. " | " . $_POST['atasks2']. " - $". $_POST['itemcost2']. " | " .
		$_POST['atasks3']. " - $". $_POST['itemcost3']. " | " .$_POST['atasks4']. " - $". $_POST['itemcost4']. " | " .
		$_POST['atasks5']. " - $". $_POST['itemcost5'];
	}
	if(isset($_POST['atasks6']))
	{
		$description = $_POST['atasks']. " - $". $_POST['itemcost']. " | " . $_POST['atasks2']. " - $". $_POST['itemcost2']. " | " .
		$_POST['atasks3']. " - $". $_POST['itemcost3']. " | " .$_POST['atasks4']. " - $". $_POST['itemcost4']. " | " .
		$_POST['atasks5']. " - $". $_POST['itemcost5']. " | " .$_POST['atasks6']. " - $". $_POST['itemcost6'];
	}
	if(isset($_POST['atasks7']))
	{
		$description = $_POST['atasks']. " - $". $_POST['itemcost']. " | " . $_POST['atasks2']. " - $". $_POST['itemcost2']. " | " .
		$_POST['atasks3']. " - $". $_POST['itemcost3']. " | " .$_POST['atasks4']. " - $". $_POST['itemcost4']. " | " .
		$_POST['atasks5']. " - $". $_POST['itemcost5']. " | " .$_POST['atasks6']. " - $". $_POST['itemcost6']. " | " .
		$_POST['atasks7']. " - $". $_POST['itemcost7'];
	}
	
	
	//Check if Optional Repair checkbox is clicked and assign respective value
	if (isset($_POST['optrepair']))
	{
		$optrepair = $_POST['optrepair'];
		$sql = "INSERT INTO `servicing`(`Vehicle Reg No`, `Service Date`, `Description`, `Cost`, `Optional Repair`) 
		VALUES ('$avehicle','$servdate','$description','$servcost','$optrepair')";
	}
	else
	{
		$optrepair = 0;
		$sql = "INSERT INTO `servicing`(`Vehicle Reg No`, `Service Date`, `Description`, `Cost`, `Optional Repair`) 
		VALUES ('$avehicle','$servdate','$description','$servcost', '$optrepair')";
	}	
	
	$result = mysqli_query($conn, $sql);
	echo $result;
	if ($result) 
	{
		header("Location: addservice.php");
		
	} else 
	{
		echo "<script>alert('There was an issue submitting this form. Please try again')</script>";
	}
	echo "<script>alert('Service Appointment Successfully Added!.')</script>";

}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">

	<title>Bucai Taxi - Service & Repairs</title>
	<style>
		.row {
			display: flex;
			width: 100%;
		}

		.column {
			flex: 50%;
			padding-left: 20px;
		}

		.column2 {
			flex: 18%;
			border-right-style:dashed;
			border-width:1px;
			padding-left: 20px;
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
	<div class="container" style="width:65%">
		<form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Service & Repairs
			<div class="row">
				<div class="column2">
					<div class="input-group">
						<label for="servdate">Service Date: </label><br>
						<input type="date" placeholder="Service Date" name="servdate" style="width:70%" value="<?php echo $servdate; ?>" required>
					</div>
					<br>
					<div class="input-group">
						<div class="selectdiv">
							<select name="avehicle" >
								<option value="">--Select Vehicle--</option>
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

					<div class="input-group" hidden>
						<label for="servcost" hidden>Total Cost: </label><br>
						<input type="number" hidden placeholder="$0.00" id="total" name="servcost" style="width:60%" required>
					</div>
					<br>
			
						<label for="optrepair" style="color:red;">Optional Repair? </label>
						<input type="checkbox" name="optrepair" value="1" >
			
					<br><br>			
					<div class="input-group">
						<button name="submit" class="btn" style="width:90%">Add</button>
					</div>
				</div>
				
				<div class="column">
					<div class="input-group">
						<div class="selectdiv">
							<select name="atasks" >
								<option value="">--Select Service Item--</option>
								<?php 
									// use a while loop to fetch data 
									// from the $all_items variable 
									// and individually display as an option
									$sqlItems = "SELECT * FROM `service items`";
									$all_items = mysqli_query($conn, $sqlItems);
									while($items = mysqli_fetch_assoc($all_items))
									{ 
								?>
									
									<option value="<?php echo $items["Line Item"]; ?>">
										<?php echo $items["Line Item"]; // To show the item name to the user?>
									</option>
								<?php 
									} 
									// While loop must be terminated
								?>
							</select>
						</div>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;			
						<input type="number" placeholder="$0.00" id="i1" name="itemcost" onchange="totalCost()" style="width:30%" required>
					</div>
					<div class="input-group">
						<div class="selectdiv">
							<select name="atasks2" >
								<option value="">--Select Service Item--</option>
								<?php 
									// use a while loop to fetch data 
									// from the $all_items variable 
									// and individually display as an option
									$sqlItems2 = "SELECT * FROM `service items`";
									$all_items2 = mysqli_query($conn, $sqlItems2);
									while($items2 = mysqli_fetch_assoc($all_items2))
									{ 
								?>
									
									<option value="<?php echo $items2["Line Item"]; ?>">
										<?php echo $items2["Line Item"]; // To show the item name to the user?>
									</option>
								<?php 
									} 
									// While loop must be terminated
								?>
							</select>
						</div>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;			
						<input type="number" placeholder="$0.00" id="i2" name="itemcost2" onchange="totalCost()" style="width:30%">
					</div>		
					<div class="input-group">
						<div class="selectdiv">
							<select name="atasks3" >
								<option value="">--Select Service Item--</option>
								<?php 
									// use a while loop to fetch data 
									// from the $all_items variable 
									// and individually display as an option
									$sqlItems3 = "SELECT * FROM `service items`";
									$all_items3 = mysqli_query($conn, $sqlItems3);
									while($items3 = mysqli_fetch_assoc($all_items3))
									{ 
								?>
									
									<option value="<?php echo $items3["Line Item"]; ?>">
										<?php echo $items3["Line Item"]; // To show the item name to the user?>
									</option>
								<?php 
									} 
									// While loop must be terminated
								?>
							</select>
						</div>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;			
						<input type="number" placeholder="$0.00" id="i3" name="itemcost3" onchange="totalCost()" style="width:30%">
					</div>	
					<div class="input-group">
						<div class="selectdiv">
							<select name="atasks4" >
								<option value="">--Select Service Item--</option>
								<?php 
									// use a while loop to fetch data 
									// from the $all_items variable 
									// and individually display as an option
									$sqlItems4 = "SELECT * FROM `service items`";
									$all_items4 = mysqli_query($conn, $sqlItems4);
									while($items4 = mysqli_fetch_assoc($all_items4))
									{ 
								?>
									
									<option value="<?php echo $items4["Line Item"]; ?>">
										<?php echo $items4["Line Item"]; // To show the item name to the user?>
									</option>
								<?php 
									} 
									// While loop must be terminated
								?>
							</select>
						</div>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;			
						<input type="number" placeholder="$0.00" id="i4" onchange="totalCost()" name="itemcost4" style="width:30%">
					</div>
					<div class="input-group">
						<div class="selectdiv">
							<select name="atasks5" >
								<option value="">--Select Service Item--</option>
								<?php 
									// use a while loop to fetch data 
									// from the $all_items variable 
									// and individually display as an option
									$sqlItems5 = "SELECT * FROM `service items`";
									$all_items5 = mysqli_query($conn, $sqlItems5);
									while($items5 = mysqli_fetch_assoc($all_items5))
									{ 
								?>
									
									<option value="<?php echo $items5["Line Item"]; ?>">
										<?php echo $items5["Line Item"]; // To show the item name to the user?>
									</option>
								<?php 
									} 
									// While loop must be terminated
								?>
							</select>
						</div>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;			
						<input type="number" placeholder="$0.00"  id="i5" name="itemcost5"  onchange="totalCost()" style="width:30%" >
					</div>
					<div class="input-group">
						<div class="selectdiv">
							<select name="atasks6" >
								<option value="">--Select Service Item--</option>
								<?php 
									// use a while loop to fetch data 
									// from the $all_items variable 
									// and individually display as an option
									$sqlItems6 = "SELECT * FROM `service items`";
									$all_items6 = mysqli_query($conn, $sqlItems6);
									while($items6 = mysqli_fetch_assoc($all_items6))
									{ 
								?>
									
									<option value="<?php echo $items6["Line Item"]; ?>">
										<?php echo $items6["Line Item"]; // To show the item name to the user?>
									</option>
								<?php 
									} 
									// While loop must be terminated
								?>
							</select>
						</div>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;			
						<input type="number" placeholder="$0.00" id="i6" name="itemcost6"  onchange="totalCost()" style="width:30%">
					</div>
					<div class="input-group">
						<div class="selectdiv">
							<select name="atasks7" >
								<option value="">--Select Service Item--</option>
								<?php 
									// use a while loop to fetch data 
									// from the $all_items variable 
									// and individually display as an option
									$sqlItems7 = "SELECT * FROM `service items`";
									$all_items7 = mysqli_query($conn, $sqlItems7);
									while($items7 = mysqli_fetch_assoc($all_items7))
									{ 
								?>
									
									<option value="<?php echo $items7["Line Item"]; ?>">
										<?php echo $items7["Line Item"]; // To show the item name to the user?>
									</option>
								<?php 
									} 
									// While loop must be terminated
								?>
							</select>
						</div>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;			
						<input type="number" placeholder="$0.00" id="i7" name="itemcost7"  onchange="totalCost()" style="width:30%">
					</div>												
				</div>
			</div>
			<br>
			<p class="login-register-text"> <a href="welcome.php">Home Page</a>.</p>
		</form>
	</div>
	
</body>
<script>
	function totalCost()
	{
		// set text box value here
		var txt =  document.getElementById('i1').value;
		document.getElementById('total').value = txt;

		var txt2 =  document.getElementById('i2').value;
		if (txt2 != 0)
		{
			document.getElementById('total').value =  parseInt(txt) + parseInt(txt2);
		}

		var txt3 =  document.getElementById('i3').value;
		if (txt2 != 0 && txt3 != 0 )
		{
			document.getElementById('total').value = parseInt(txt) + parseInt(txt2) + parseInt(txt3);
		}

		var txt4 =  document.getElementById('i4').value;
		if (txt2 != 0 && txt3 != 0 && txt4 != 0 )
		{
			document.getElementById('total').value = parseInt(txt) + parseInt(txt2) + parseInt(txt3) + parseInt(txt4);
		}

		var txt5 =  document.getElementById('i5').value;
		if (txt2 != 0 && txt3 != 0 && txt4 != 0 && txt5 != 0)
		{
			document.getElementById('total').value = parseInt(txt) + parseInt(txt2) + parseInt(txt3) + parseInt(txt4) + parseInt(txt5);
		}

		var txt6 =  document.getElementById('i6').value;
		if (txt2 != 0 && txt3 != 0 && txt4 != 0 && txt5 != 0 && txt6 != 0)
		{
			document.getElementById('total').value = parseInt(txt) + parseInt(txt2) + parseInt(txt3) + parseInt(txt4) + parseInt(txt5) + parseInt(txt6);
		}

		var txt7 =  document.getElementById('i7').value;
		if (txt2 != 0 && txt3 != 0 && txt4 != 0 && txt5 != 0 && txt6 != 0 && txt7 != 0 )
		{
			document.getElementById('total').value = parseInt(txt) + parseInt(txt2) + parseInt(txt3) + parseInt(txt4) + parseInt(txt5) + parseInt(txt6) + parseInt(txt7);
		}
		
	}

	/*<input type="button" onclick="addInput()" style="width:10%" value="+"/>
	<span id="responce"></span> <span id="responce2"></span>
	var countBox =1;
	var boxName = 0;
	var countBox2 =1;
	var boxName2 = 0;
	function addInput()
	{
		var boxName="textBox"+countBox; 
		document.getElementById('responce').innerHTML+='<br/><input type="text" id="'+boxName+'" value="'+boxName+'" " /><br/>';
		countBox += 1;
		
		var boxName2="textBox"+countBox2; 
		document.getElementById('responce2').innerHTML+='<br/><input type="text" id="'+boxName2+'" value="'+boxName2+'" " /><br/>';
		countBox2 += 1;
	}*/
</script>
</html>