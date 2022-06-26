<?php 

include "config.php";

    if (isset($_POST['update'])) 
    {
        $id = $_POST['id'];
        $vehreg = $_POST['vehreg'];
        $incidate = $_POST['incidate'];
        $details = $_POST['details'];

        $sql = "UPDATE `accident details` SET `Incident ID`='$id',`Vehicle Reg No`='$vehreg',`Incident Date`='$incidate',`Incident Details`='$details' WHERE `Incident ID`='$id'"; 
        $result = $conn->query($sql); 

        if ($result == TRUE) 
        {
            header("Location: viewAccident.php");
        }
        else
        {
            echo "Error:" . $sql . "<br>" . $conn->error;
        }
    } 

if (isset($_GET['id'])) 
{

    $id = $_GET['id']; 
    $sql = "SELECT * FROM `accident details` WHERE `Incident ID`='$id'";
    $result = $conn->query($sql); 

    if ($result->num_rows > 0) 
    {        
        while ($row = $result->fetch_assoc()) 
        {
            $id = $row['Incident ID'];
            $vehreg = $row['Vehicle Reg No'];
            $incidate = $row['Incident Date'];
            $details  = $row['Incident Details'];
        } 

    ?>
            <title>Update - Incident Details</title>
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
                overflow: hidden;
                font-family: poppins;
                }

                .container {
                position: relative;
                width: 500px;
                height: 680px;
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
            <div class="container">
                <div class="brand-logo"></div>
                <div class="brand-title">Update Incident Details</div>
                <form action="" method="post">
                    <div class="inputs">     
                        Vehicle Registration #:<br>
                        <input type="text" name="vehreg" value="<?php echo $vehreg; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <br>
                        Incident Date:<br>
                        <input type="date" name="incidate" value="<?php echo $incidate; ?>">
                        <br>
                        Incident Details:<br>
                        <input type="text" name="details" value="<?php echo $details; ?>">

                        <br>

                        <input type="submit" value="Update" name="update">
                    </div>
                </form>
                <p class="login-register-text"> <a href="viewAccident.php">Return</a>.</p>
            </div>
        
        </body>
        </html> 

    <?php

    } else{ 

        header('Location: viewAccident.php');

    } 

}

?> 