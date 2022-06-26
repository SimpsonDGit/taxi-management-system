<?php 

include "config.php";
session_start();
$uname = $_SESSION['username'];

if ($uname != 'Admin')
{
    header("Location: index.php");
    echo "<script>alert('You are not authorized to access this page.')</script>";
}
else
{
    $sql = "SELECT * FROM `receipts`";
    $result = $conn->query($sql);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>View - Receipts</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<style>
        body{
            font-family: Helvetica;
            -webkit-font-smoothing: antialiased;
            
        }
        h2{
            text-align: center;
            font-size: 22px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: white;
        }

        /* Table Styles */
        .table-wrapper{
            margin: auto;
            box-shadow: 0px 35px 50px rgba( 0, 0, 0, 0.2 );
            background: rgba( 71, 147, 227, 1);
        }

        .fl-table {
            border-radius: 5px;
            font-size: 16px;
            font-weight: normal;
            border: none;
            border-collapse: collapse;
            width: 100%;
            max-width: 100%;
            white-space: nowrap;
            background-color: white;
        }

        .fl-table td, .fl-table th {
            text-align: center;
            padding: 8px;
        }

        .fl-table td {
            border-right: 1px solid #f8f8f8;
            font-size: 16px;
        }

        .fl-table thead th {
            color: #ffffff;
            background: #4FC3A1;
        }


        .fl-table thead th:nth-child(odd) {
            color: #ffffff;
            background: #324960;
        }

        .fl-table tr:nth-child(even) {
            background: #F8F8F8;
        }

        /* Responsive */

        @media (max-width: 767px) 
        {
            .fl-table {
                display: block;
                width: 100%;
            }
            .table-wrapper:before{
                content: "Scroll horizontally >";
                display: block;
                text-align: right;
                font-size: 11px;
                color: white;
                padding: 0 0 10px;
            }
            .fl-table thead, .fl-table tbody, .fl-table thead th {
                display: block;
            }
            .fl-table thead th:last-child{
                border-bottom: none;
            }
            .fl-table thead {
                float: left;
            }
            .fl-table tbody {
                width: auto;
                position: relative;
                overflow-x: auto;
            }
            .fl-table td, .fl-table th {
                padding: 20px .625em .625em .625em;
                height: 60px;
                vertical-align: middle;
                box-sizing: border-box;
                overflow-x: hidden;
                overflow-y: auto;
                width: 180px;
                font-size: 13px;
                text-overflow: ellipsis;
            }
            .fl-table thead th {
                text-align: left;
                border-bottom: 1px solid #f7f7f9;
            }
            .fl-table tbody tr {
                display: table-cell;
            }
            .fl-table tbody tr:nth-child(odd) {
                background: none;
            }
            .fl-table tr:nth-child(even) {
                background: transparent;
            }
            .fl-table tr td:nth-child(odd) {
                background: #F8F8F8;
                border-right: 1px solid #E6E4E4;
            }
            .fl-table tr td:nth-child(even) {
                border-right: 1px solid #E6E4E4;
            }
            .fl-table tbody td {
                display: block;
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <div class="table-wrapper" style="margin-top: 80px; text-align:center; width: 90%; border:1px solid;">
	<a href="welcome.php"><img src="home.png" style="width:5%" positon="left;"  alt="Home"></a>
        <h2>Receipt Details</h2>
        </br>
        <table class="fl-table">
            <thead>
                <tr>
                    <th>Invoice #</th>
                    <th>Receipt Date</th>
                    <th>Veh Registration #</th>
                    <th>TRN</th>	
                     <th>Payment Days</th>
                    <th>Days Outstanding</th>
                    <th>Total Amount</th>
                    <th>Amount Paid</th>
                    <th>Balance Remaining</th>
                    
                </tr>
            </thead>

            <tbody> 
                <?php
                    if ($result->num_rows > 0) 
                    {
                        while ($row = $result->fetch_assoc())
                        {
                            // set Alert for Outstanding Balance
                            if($row['Balance Remaining'] > 10000 )
                            {
                                $tdStyle='background-color:red;';
                            } else
                            { 
                                $tdStyle='background-color:none;';
                            };
                ?>
                            <tr>
                                <td>REC#<?php echo $row['Invoice No']; ?></td>
                                <td><?php echo $row['Receipt Date']; ?></td>
                                <td><?php echo $row['Vehicle Reg No']; ?></td>
                                <td><?php echo $row['TRN']; ?></td>
				                <td><?php echo $row['Payment Days']; ?>
				                <td><?php echo $row['Days Outstanding']; ?>
				                <td>$<?php echo $row['Total Amount']; ?>
				                <td>$<?php echo $row['Amount Paid']; ?>
                                <?php echo "</td><td style=\"$tdStyle\">"; echo "$" . $row['Balance Remaining'] ?>
                            </tr>                       

                <?php    }

                    }
                ?>                
            </tbody>
        </table>
    </div> 
</body>
</html>