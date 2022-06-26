<?php 

include 'config.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}

error_reporting(0);

if (isset($_POST['submit'])) 
{		
		$datearray = date("Y-m-d");
		$regno = $_POST['avehicle'];
		$trn = $_POST['adrivers'];
		$dayspaid = $_POST['daterange'];
		$daysout = $_POST['daysout'];
		$amountpaid = $_POST['amountpaid'];
		$total = $_POST['total'];
		$outbal = $_POST['outbal'];

		$_SESSION['vehreg'] = $regno;
		$_SESSION['recdate'] = $datearray;
		$_SESSION['total'] = $total;
		$_SESSION['paid'] = $amountpaid;
		$_SESSION['out'] = $outbal;

		//Store name from driver in a session variable
		$namequery = "SELECT `full name` FROM `driver details` WHERE `trn` = '$trn'";
		$nameresult = $conn->query($namequery); 

		if ($nameresult->num_rows > 0) 
		{        
			while ($row = $nameresult->fetch_assoc()) 
			{
				$fullname = $row['full name'];
			} 
		}
	 	$_SESSION['fname'] = $fullname;
		
		
		$sql = "INSERT INTO `receipts` (`Receipt Date`, `Vehicle Reg No`, `TRN`, `Payment Days`, `Days Outstanding`, `Total Amount`, `Amount Paid`, `Balance Remaining`) 
		VALUES ('$datearray', '$regno', '$trn', '$dayspaid', '$daysout', $total, $amountpaid, $outbal)";
		
		$run = mysqli_query($conn,$sql) or die(mysqli_error());
		
		if(isset($run)) 
		{	
			$recsql = "SELECT `Invoice No` FROM `receipts` WHERE `Receipt Date` = '$datearray' AND `Vehicle Reg No` = '$regno' AND `TRN` = '$trn' AND `Payment Days`= '$dayspaid' AND `Days Outstanding` = '$daysout'";
    		$recresult = $conn->query($recsql);

			if ($recresult->num_rows > 0) 
			{	        
				while ($row2 = $recresult->fetch_assoc()) 
				{
					$recno = $row2['Invoice No'];
				} 
			}
			$_SESSION['recno'] = $recno;
			header("Location: receipt.php");
		}
		else
		{
			echo "<script>alert('Woops! Something went wrong.')</script>";
		}

}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
	
	<title>Bucai Taxi - Receipt</title>
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
		.row 
		{
			display: flex;
		}

		.column 
		{
			flex: 50%;
			padding-left: 50px;
		}
	</style>
</head>
<body>
	<div class="container" style="width:50%">
		<form action="" method="POST" class="login-email" ><!--id="receiptform"-->
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Create Receipt</p>
			<br>
			<div class="row">
  				<div class="column">
					<div class="input-group">
						<div class="selectdiv">
							<select name="adrivers" class="form-control">
								<option value="">--Select Driver--</option>
								<?php 
									// use a while loop to fetch data 
									// from the $all_vehicles variable 
									// and individually display as an option
									$sqlDri = "SELECT * FROM `driver details`";
									$all_drivers = mysqli_query($conn, $sqlDri);
									while($driver = mysqli_fetch_assoc($all_drivers))
									{ 
								?>
									
									<option value="<?php echo $driver["trn"]; ?>">
										<?php echo $driver["trn"]. " - ". $driver["full name"];  // To show the vehicle name to the user?>
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
							<select id="cost" name="avehicle" onchange="costPerDay()" class="form-control">
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
									<option value="<?php echo $vehicle["Vehicle Reg No"]; ?>" data-max="<?php echo $vehicle["Cost Per Day"]; ?>" >
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
						<label for="daycount">Days Vehicle was Used: </label><br>
						<input type="number" onchange="totalAmount()" id="vehDays" placeholder="0" name="daycount" style="width:60%" required>
					</div>
					<br>
					<div class="input-group">
						<label for="total">Total Amount: </label><br>
						<input type="number" id="total" placeholder="$0.00" name="total" style="width:60%" required>
					</div>
		
					
				</div>
				<div class="column">
					<div class="input-group">
						<label for="amountpaid"> Amount Paid: </label><br>
						<input type="number" id="amountpaid" onchange="outBalance()" placeholder="$0.00" name="amountpaid" style="width:60%" required>
					</div>
					<br>
					<div class="input-group">
						<label for="daterange"> Payment Days: </label><br>
						<input type="text" style="width:60%" name="daterange" placeholder="eg. Aug 1, 2022 - Aug 5, 2022" required></textarea>
					</div>
					<br>
					<div class="input-group">
						<label for="daysout"> Days Outstanding </label><br>
						<input type="text" style="width:60%" name="daysout" placeholder="eg. Aug 6, 2022 - Aug 9, 2022" required></textarea>
					</div>
					<div class="input-group">
						<label hidden for="outbal"> Outstanding Balance: </label><br>
						<input type="number" hidden id="outbal" placeholder="$0.00" name="outbal" style="width:60%" required>
					</div>
				</div>
			</div>
			<br>
			<div class="input-group">
				<button type="button" name="generate" class="btn" data-toggle="modal" data-target="#myModal">Generate</button> <!---->
			</div>
			
			<p class="login-register-text"> <a href="welcome.php">Home Page</a>.</p>
			<div class="modal" tabindex="-1" role="dialog" id="myModal">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">CONFIRM</h4>
					</div>
					<div class="modal-body">
						<p>If you are sure the details are correct please click PRINT to generate receipt.</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<input type="submit" class="btn btn-primary" name="submit"></input>
					</div>
					</div> <!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
				</div><!-- /.modal -->
			</div>
		</form>
		
	
	<script>
		/*
		$(function() 
		{
			$('input[name="daterange"]').daterangepicker(
				{
					timePicker: true,
    				startDate: moment().startOf('hour'),
    				endDate: moment().startOf('hour').add(32, 'hour'),
   					 locale: 
						{
      						format: 'M/DD/YYYY'
						}
  				});
			// To calculate the time difference of two dates
			var Difference_In_Time = date2.getTime() - date1.getTime();
  
			// To calculate the no. of days between two dates
			var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);

  			document.getElementById('vehDays').value = Difference_In_Days;
		});
		*/
		$('input[name="daterange"]').daterangepicker();
		$('input[name="daysout"]').daterangepicker();
		/*
		$('#receiptform').on('submit', function(e)
		{
			$('#myModal').modal('show');
			e.preventDefault();
		});*/

		function costPerDay()
		{
			// set text box value here
			var txt =  document.getElementById('cost');
			var option = txt.options[txt.selectedIndex];
			document.getElementById('total').value = option.dataset.max;
			document.getElementById('vehDays').value = 1;
		}

		function totalAmount()
		{
			// set text box value here
			var days =  document.getElementById('vehDays').value;
			var txt = document.getElementById('cost');
			var cpd = txt.options[txt.selectedIndex];
			document.getElementById('total').value = days * cpd.dataset.max;
		}

		function outBalance()
		{
			// set text box value here
			var total =  document.getElementById('total').value;
			var ampaid = document.getElementById('amountpaid').value;
			document.getElementById('outbal').value = total - ampaid;
		}



	</script>
</body>
</html>

