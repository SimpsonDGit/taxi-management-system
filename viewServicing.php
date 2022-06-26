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
    $sql = "SELECT * FROM `servicing`";
    $result = $conn->query($sql);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>View - Service Details</title>
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
    <div class="table-wrapper" style="margin-top: 80px;  width: 50%; border:1px solid;">
        <a href="welcome.php"><img src="home.png" style="width:5%; display: block;margin-left: auto; margin-right: auto;"  alt="Home"></a>
        <h2>Service & Repair Details</h2>
        </br>
        <div class="table-responsive">
        <table class="fl-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Registration #</th>
                    <th>Service Date</th>
                    <th>Description</th>
                    <th>Cost</th>
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
                                <td><?php echo $row['ID']; ?></td>
                                <td><?php echo $row['Vehicle Reg No']; ?></td>
                                <td><?php echo $row['Service Date']; ?></td>
                                <td><?php echo $row['Description']; ?></td>
                                <td>$<?php echo $row['Cost']; ?>
                                <td><a class="btn btn-info" href="updateService.php?id=<?php echo $row['ID']; ?>">Edit</a>&nbsp;<!--<a class="btn btn-danger" href="delete.php?id=<?php echo $row['ID']; ?>">Delete</a>--></td>
                            </tr>                       

                <?php    }

                    }
                ?>                
            </tbody>
        </table>
       </div>
    </div> 
</body>
</html>