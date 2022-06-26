<?php 

include "config.php";

    if (isset($_POST['update'])) 
    {
        $trn = $_POST['trn'];
        $fullname = $_POST['fullname'];
        $address = $_POST['address'];
        $contactno = $_POST['contactno'];
	    $nextofk = $_POST['nextofk'];
        $nokadd = $_POST['nokadd'];
        $nokcont = $_POST['nokcont'];
        $avehicle = $_POST['avehicle'];
	    $enddate = $_POST['enddate'];
        $taxicomp = $_POST['taxicomps'];

        $sql = "UPDATE `driver details` SET `trn`='$trn',`full name`='$fullname',`address`='$address',`contact no`='$contactno',
	    `next of kin (NOK)`='$nextofk',`NOK address`='$nokadd',`NOK contact`='$nokcont',
	    `assigned vehicle`='$avehicle', `end date`='$enddate', `taxi company`='$taxicomp' WHERE `trn`='$trn'";

        $result = $conn->query($sql); 

        if ($result == TRUE) 
        {
            header("Location: viewDriver.php");
        }
        else
        {
            echo "<script>alert('Error:' . $sql . '<br>' . $conn->error )</script>";
        }
    } 

if (isset($_GET['trn'])) 
{
    $trn = $_GET['trn']; 
    $sql = "SELECT * FROM `driver details` WHERE `trn`='$trn'";
    $result = $conn->query($sql); 

    if ($result->num_rows > 0) 
    {        
        while ($row = $result->fetch_assoc()) 
        {
            $trn = $row['trn'];
            $fullname = $row['full name'];
            $address = $row['address'];
            $contactno  = $row['contact no'];
            $avehicle = $row['assigned vehicle'];
            $taxicomp = $row['taxi company'];
	        $nextofk = $row['next of kin (NOK)'];
            $nokadd = $row['NOK address'];
            $nokcont  = $row['NOK contact'];
        } 

    ?>
    <html>
    <head>
        <title>Update - Driver Details</title>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;900&display=swap');

            body {
            margin: 0;
            width: 100vw;
            height: 100vh;
            background: #ecf0f3;
            display: flex;
            align-items: center;
            text-align: center;
            justify-content: center;
            place-items: center;
            overflow: auto;
            font-family: poppins;
            }

            .container {
            position: relative;
            width: 700px;
            height: 725px;
            border-radius: 20px;
            padding: 40px;
            box-sizing: border-box;
            background: #ecf0f3;
            box-shadow: 14px 14px 20px #cbced1, -14px -14px 20px white;
            }

            .brand-logo {
            height: 100px;
            width: 100px;
            background: url("https://icons.iconarchive.com/icons/icons-land/transporter/128/Taxi-Front-Yellow-icon.png");
            margin: auto;
            border-radius: 50%;
            box-sizing: border-box;
            box-shadow: 7px 7px 10px #cbced1, -7px -7px 10px white;
            }

            .brand-title {
            margin-top: 10px;
            font-weight: 900;
            font-size: 1.8rem;
            color: black;
            letter-spacing: 1px;
            }

            .inputs {
            text-align: left;
            margin-top: 30px;
            }

            label, input, select {
            display: block;
            width: 100%;
            padding: 0;
            border: none;
            outline: none;
            box-sizing: border-box;
            }

            label {
            margin-bottom: 4px;
            }

            label:nth-of-type(2) {
            margin-top: 12px;
            }

            input::placeholder {
            color: gray;
            }

            input, select {
            background: #ecf0f3;
            padding: 10px;
            padding-left: 20px;
            height: 50px;
            font-size: 14px;
            border-radius: 50px;
            box-shadow: inset 6px 6px 6px #cbced1, inset -6px -6px 6px white;
            }

            input[type=submit] {
            color: white;
            margin-top: 20px;
            background: black;
            height: 40px;
            border-radius: 20px;
            cursor: pointer;
            font-weight: 900;
            box-shadow: 6px 6px 6px #cbced1, -6px -6px 6px white;
            transition: 0.5s;
            }

            input[type=submit]:hover {
            box-shadow: none;
            }

            a {
            position: absolute;
            font-size: 12px;
            bottom: 4px;
            right: 4px;
            text-decoration: none;
            color: black;
            background: yellow;
            border-radius: 10px;
            padding: 2px;
            }

            h1 {
            position: absolute;
            top: 0;
            left: 0;
            }
	    
	        .row {
            display: flex;
            }

            .column {
            flex: 50%;
            padding-left: 20px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="brand-logo"></div>
            <div class="brand-title">Update Driver Details</div>
            <form action="" method="post">
                <div class="inputs">       
		<div class="row">
            <div class="column"> 
                Full Name:<br>
                <input type="text" name="fullname" value="<?php echo $fullname; ?>">
                <input type="hidden" name="trn" value="<?php echo $trn; ?>">

                <br>

                Address:<br>
                <input type="text" name="address" value="<?php echo $address; ?>">

                <br>

                Contact No:<br>

                <input type="number" name="contactno" value="<?php echo $contactno; ?>">

                <br>

                End Date:<br>

                <input type="date" name="enddate" value="<?php echo $enddate; ?>">
                <br>
                Select Vehicle:<br>
                <select name="avehicle">
                        <option value="<?php echo $avehicle?>"></option>
                        <option value=" "></option>
                        <?php 
                            // use a while loop to fetch data 
                            // from the $all_vehicles variable 
                            // and individually display as an option
                            $sqlVeh = "SELECT * FROM `vehicle details`";
                            $all_vehicles = mysqli_query($conn, $sqlVeh);
                            while($vehicles = mysqli_fetch_assoc($all_vehicles))
                            { 
                        ?>
                            <option value="<?php echo $vehicles["Vehicle Reg No"]; ?>">
                                <?php echo $vehicles["Vehicle Reg No"]. " - ". $vehicles["Make"]." ". $vehicles["Model"]." ". $vehicles["Year"];?>
                            </option>
                        <?php 
                            } 
                            // While loop must be terminated
                        ?>
                </select>
                
            </div>
		
            <div class="column">
                Next of Kin(NOK):<br>
                <input type="text" name="nextofk" value="<?php echo $nextofk; ?>">
                <br>
                NOK Address:<br>
                <input type="text" name="nokadd" value="<?php echo $nokadd; ?>">
                <br>
                NOK Contact:<br>
                <input type="number" name="nokcont" value="<?php echo $nokcont; ?>">
                <br>
                Taxi Company:<br>
                <select name="taxicomps">
                    <option value="<?php echo $taxicomp?>"></option>
                    <option value=" "></option>
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

                <input type="submit" value="Update" name="update">
                    
		    </div>
            </form> 
            <p class="login-register-text"> <a href="viewDriver.php">Return</a>.</p>
        </div>
        
    </body>
    </html> 

    <?php

    } else{ 

        header('Location: viewDriver.php');

    } 

}

?> 
