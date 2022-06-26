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
    $sql = "SELECT * FROM `driver details`";
    $result = $conn->query($sql);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>View - Drivers</title>
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
            margin-top: 80px; width: 95%; border:1px solid;
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
    <div class="table-wrapper">
    <a href="welcome.php"><img src="home.png" style="width:5%; display: block;margin-left: auto; margin-right: auto;"  alt="Home"></a>       
    <h2>Driver Details</h2>
        </br>
        <table class="fl-table">
            <thead>
                <tr>
                    <th>TRN</th>
                    <th>Full Name</th>
                    <th>Address</th>
                    <th>Contact No</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Taxi Company</th>
                    <th>Assigned Vehicle</th>
		            <th>Next of Kin (NOK)</th>
                    <th>NOK Address</th>
                    <th>NOK Contact No</th>
                </tr>
            </thead>

            <tbody> 
                <?php
                    if ($result->num_rows > 0) 
                    {
                        
                        while ($row = $result->fetch_assoc())
                        {
                ?>
                            <tr>
                                <td><?php echo $row['trn']; ?></td>
                                <td><?php echo $row['full name']; ?></td>
                                <td><?php echo $row['address']; ?></td>
                                <td><?php echo $row['contact no']; ?></td>
                                <td><?php echo $row['start date']; ?></td>
                                <td><?php echo $row['end date']; ?></td>
                                <td><?php echo $row['taxi company']; ?>
                                <td><?php echo $row['assigned vehicle']; ?>
                                <td><?php echo $row['next of kin (NOK)']; ?></td>
                                <td><?php echo $row['NOK address']; ?></td>
                                <td><?php echo $row['NOK contact']; ?></td> 
                                <td><a class="btn btn-info" href="updateDriver.php?trn=<?php echo $row['trn']; ?>">Edit</a>&nbsp;<!--<a class="btn btn-danger" href="delete.php?trn=<?php echo $row['trn']; ?>">Delete</a>--></td>
                            </tr>                       

                <?php    }

                    }
                ?>                
            </tbody>
        </table>
    </div> 
</body>
</html>