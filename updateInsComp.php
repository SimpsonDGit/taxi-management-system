<?php 

include "config.php";

    if (isset($_POST['update'])) 
    {
        $id = $_GET['id'];
        $comp = $_POST['comp'];
        $contactno = $_POST['contactno'];

        $sql = "UPDATE `insurance companies` SET `Company Name`='$comp', `Contact No`= $contactno WHERE `ID`='$id'"; 
        $result = $conn->query($sql); 

        if ($result == TRUE) 
        {
            header('Location: viewInsCompanies.php');

        }
        else
        {
            echo "Error:" . $sql . "<br>" . $conn->error;
        }
    } 

if (isset($_GET['id'])) 
{

    $id = $_GET['id']; 
    $sql = "SELECT * FROM `insurance companies` WHERE `ID`='$id'";
    $result = $conn->query($sql); 

    if ($result->num_rows > 0) 
    {        
        while ($row = $result->fetch_assoc()) 
        {
            $id = $row['ID'];
            $comp = $row['Company Name'];
            $contactno = $row['Contact No'];
        } 

    ?>
<html>
    <head>
	<title>Update - Insurance Company</title>
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
            width: 500px;
            height: 525px;
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

            label, input {
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

            input {
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
        </style>
    </head>
    <body>
	<form action="" method="post">   
        <div class="container">
            <div class="brand-logo"></div>
            <div class="brand-title">Update Company Details</div>
            <div class="inputs">            
            	Insurance Company Name:<br>
            	<input type="text" name="comp" value="<?php echo $comp; ?>">
            	<input type="hidden" name="id" value="<?php echo $id; ?>">
                <br>
                Contact No.:<br>
                <input type="number" name="contactno" value="<?php echo $contactno; ?>">
            	<br>

            <input type="submit" value="Update" name="update">
	  </div>
        </form> 
        <p class="login-register-text"> <a href="viewInsCompanies.php">Return</a>.</p>
        </body>
        </html> 

    <?php

    } else{ 

        header('Location: viewInsCompanies.php');

    } 

}

?>
