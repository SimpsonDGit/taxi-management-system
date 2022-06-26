<?php 

include "config.php";

    if (isset($_POST['update'])) 
    {
        $regno = $_POST['regno'];
        $make = $_POST['make'];
        $model = $_POST['model'];
        $year = $_POST['year'];
        $colour = $_POST['colour'];
        $engineno = $_POST['engineno'];
        $chassno = $_POST['chassno'];
        $costpday = $_POST['costpday'];
        $fexpiry = $_POST['fexpiry'];
        $rexpiry = $_POST['rexpiry'];
        $inscompany = $_POST['inscomp'];
        $doctype = $_POST['doctype'];
        $insstrt = $_POST['insstrt'];
        $insend = $_POST['insend'];
        
        

        $sql = "UPDATE `vehicle details` 
        SET `Vehicle Reg No`='$regno', `Make`='$make',`Model`='$model',`Year`='$year', `Colour`='$colour', `Engine No`='$engineno',`Chassis No`='$chassno',
        `Fitness Expiry`='$fexpiry',`Registration Expiry`='$rexpiry',`Cost Per Day`='$costpday',
        `Insurance Company`='$inscompany', `Insurance Document`='$doctype',`Insurance Start Date`='$insstrt',`Insurance End Date`='$insend' WHERE `Vehicle Reg No`='$regno'"; 
        $result = $conn->query($sql); 
        
        if ($result == TRUE) 
        {
            header("Location: viewVehicle.php");
        }
        else
        {
            echo "Error:" . $sql . "<br>" . $conn->error;
        }
    } 

if (isset($_GET['regno'])) 
{

    $regno = $_GET['regno']; 
    $sql = "SELECT * FROM `vehicle details` WHERE `Vehicle Reg No`='$regno'";
    $result = $conn->query($sql); 

    if ($result->num_rows > 0) 
    {        
        while ($row = $result->fetch_assoc()) 
        {
            $regno = $row['Vehicle Reg No'];
            $make = $row['Make'];
            $model  = $row['Model'];
            $year = $row['Year'];
            $colour  = $row['Colour'];
            $engineno = $row['Engine No'];
            $chassno = $row['Chassis No'];

            $fexpiry = $row['Fitness Expiry'];
            $rexpiry = $row['Registration Expiry'];
            $costpday = $row['Cost Per Day'];
            $inscompany = $row['Insurance Company'];
            $insstrt = $row['Insurance Start Date'];
            $insend = $row['Insurance End Date'];
            $doctype = $row['Insurance Document'];
        } 

    ?>
    <html>
    <head>
        <title>Update - Vehicle Details</title>
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
            width: 900px;
            height: 920px;
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

            label, input, select{
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
        <div class="container" >
        <div class="brand-logo"></div>
        <div class="brand-title">Update Vehicle Details</div>
        <form action="" method="post">
            <div class="inputs">
            <div class="row">
                <div class="column">
                    Registration #:<br>
                    <input type="text" name="regno" value="<?php echo $regno; ?>">
                    <br>
                    Make:<br>
                    <input type="text" name="make" value="<?php echo $make; ?>">
                    <br>
                    Model:<br>
                    <input type="text" name="model" value="<?php echo $model; ?>">
                    <br>
                    Year:<br>
                    <input type="number" name="year" value="<?php echo $year; ?>">
                    <br>
                    Colour:<br>
                    <input type="text" name="colour" value="<?php echo $colour; ?>">
                    <br>
                    Engine #:<br>
                    <input type="text" name="engineno" value="<?php echo $engineno; ?>">
                    <br>
                    Chassis#:<br>
                    <input type="text" name="chassno" value="<?php echo $chassno; ?>">
                    <br>
                    
                </div>
                
                <div class="column">
                    Fitness Expiry:<br>
                    <input type="date" name="fexpiry" value="<?php echo $fexpiry; ?>">
                    <br>
                    Registration Expiry:<br>
                    <input type="date" name="rexpiry" value="<?php echo $rexpiry; ?>">
                    <br>
                    Cost Per Day:<br>
                    <input type="number" name="costpday" value="<?php echo $costpday; ?>">
                    
                </div>

                <div class="column">
                    <label for="inscomp">Insurance Company</label>
                    <select name="inscomp">
                            <option value="<?php echo $inscompany?>"></option>
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
                    <br>
                    <label for="doctype">Document Type</label>
                    <select name="doctype">
                        <option value="<?php echo $doctype?>"></option>
                            <option value="Cover Note">Cover Note</option>
                            <option value="Certificate">Certificate</option>
                    </select>
                    <br>
                    Insurance Start Date:<br>
                    <input type="date" name="insstrt" value="<?php echo $insstrt; ?>">
                    <br>
                    Insurance End Date:<br>
                    <input type="date" name="insend" value="<?php echo $insend; ?>">
                    <br>
                    <input type="submit" value="Update" name="update">
                </div>
            </div>
            </div>
        </form> 
        <p class="login-register-text"> <a href="viewVehicle.php">Return</a>.</p>
    </body>
    </html> 

    <?php

    } else{ 

        header('Location: viewVehicle.php');

    } 

}

?> 
