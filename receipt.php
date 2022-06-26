<?php 
    include 'config.php';
    session_start();
    
    if (!isset($_SESSION['username'])) 
    {
        header("Location: index.php");
    }
    $recno = $_SESSION['recno'];
    $fullname = $_SESSION['fname'];
    $vehreg = $_SESSION['vehreg'];
	$receiptdate =	$_SESSION['recdate'];
	$totalamount =	$_SESSION['total'];
	$paid =	$_SESSION['paid'];
	$outstanding =	$_SESSION['out'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Bucai Taxi - Receipt</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <style>
        html, body {
            font-family: 'Helvetica Neue', Helvetica, "Segoe UI", Arial, sans-serif;
            font-size: 13px;
        }
        div.area
        {
            width: 440px;
            height: 300px;
            margin: auto;
        }
    </style>
</head>

<body>
    <!--
    <div class="container" style="margin-top: 40px;">
        <div class="row">
            <div class="col-md-6 col-xs-6">Bucai Taxi LTD 2016</div>
            <div class="col-md-6 col-xs-6" style="text-align: right;">Date : Hours</div>
        </div>
    </div>
    -->
<div class="area">
        <div class="row">
            <div class="col-md-7 col-xs-7" style="text-align: right;"> 
                <a href="http://localhost/bucai/createReceipt.php" ><img style="width: 100px;height: 120px;"src="Bucai Taxi Logo.jpg" alt="bucailogo"></a>
            </div><!--
            <div class="col-md-5 col-xs-5" style="text-align: right; padding-top: 20px;">
                <div style="font-size: 18px; font-weight: bold; padding-bottom: 6px;"> Name Surname </div>
                <div style="padding-bottom: 6px;"> Addres : 9 Portland Gardens</div>
                <div> Post code : N4 1HU </div>
            </div>-->
        </div>
    
        <div class="row">
            <div style="text-align: center; font-size: 22px; font-weight: 600; letter-spacing: 3;"> TRANSACTION RECEIPT </div>
            <br>
            <!--<div style="text-align: center; font-size: 16px; font-weight: 500; letter-spacing: 1;"> Transaction Type </div>-->
        </div>
   

        <div class="row">
            <div class="title-section" style="font-size: 16px; font-weight: 400; letter-spacing: 1; border-bottom: 2px #666666 solid; padding-bottom: 10px;"> RECIPIENT DETAILS </div>
            <table style="width: 100%; margin-top: 10px;">
                <thead style="letter-spacing: 1; font-weight: 700;">
                    <tr>
                        <td style="padding: 5px 0;"> NAME </td> 
                        <td style="text-align: left;"> VEHICLE REG. # </td> 
                        <td style="text-align: right;"> RECEIPT# </td>
                    </tr>
                </thead>
                <tbody style="font-size: 16px;">
                    <tr>
                        <td>  <?php echo $fullname ?> </td> 
                        <td style="text-align: left;"> <?php echo $vehreg ?> </td>
                        <td style="text-align: right;"> <?php echo $recno ?> </td> 
                    </tr>
                </tbody>
            </table>
        </div>
        <br>
        <div class="row">
            <div class="title-section" style="font-size: 16px; letter-spacing: 1; border-bottom: 2px #666666 solid; padding-bottom: 10px;"> TRANSACTION DETAILS </div>
                <table style="width: 100%; margin-top: 10px;">
                    <thead style="letter-spacing: 1; font-weight: 700;">
                        <tr>
                            <td style="padding: 10px 0;"> RECEIPT DATE </td> 
                            <td style="text-align: center;"> TOTAL AMOUNT </td> 
                            <td style="text-align: right;"> OUTSTANDING BALANCE </td>
                        </tr>
                    </thead>
                    <tbody style="font-size: 16px;">
                        <tr>
                            <td> <?php echo $receiptdate ?> </td> 
                            <td style="text-align: center;"> &#36;<?php echo $totalamount ?></td>
                            <td style="text-align: right;"> &#36;<?php echo $outstanding ?> </td>
                        </tr>
                    </tbody>
                </table>
                
                <hr style="border-top: 1px solid #666666;">
                <div class="row" style="margin-top: 20px;">
                    <div class="col-md-6 col-xs-6">
                        <div style="letter-spacing: 1; font-weight: 600; padding: 10px 0;"> PAYMENT AMOUNT </div>
                        <div style="font-size: 16px;"> &#36;<?php echo $paid ?> </div>
                    </div>
                    <!--<div class="col-md-6 col-xs-6" style="text-align: right;">
                        <div style="letter-spacing: 1; font-weight: 300; padding: 10px 0;"> FEES </div>
                        <div style="font-size: 16px;"> &#36;0.00 </div>
                    </div>
                    <hr>-->
                </div>
                <hr style="border-top: 1px solid #666666;">
        </div>

        <!--
        <div class="col-md-12" style="text-align: center;">
            <div> The transaction shown on your receipt is correct at the time of downloading. </div>
            <div> If you think something is incorrect, please contact us on 000 00 000 </div>
        </div>-->

</div>
</body>
</html>
