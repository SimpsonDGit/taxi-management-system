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
    $sql = "SELECT * FROM `vehicle details`";
    $result = $conn->query($sql);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>View - Vehicles</title>

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
        width:100%;
        margin-top: 80px; border:1px solid;
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
    <a href="welcome.php"><img src="home.png" style="width:5%; display: block;margin-left: auto; margin-right: auto;" alt="Home"></a>    
    <h2>Vehicle Details</h2>
    </br>
    <table class="fl-table">
        <thead>
            <tr>
                <th>Registration#</th>
                <th>Year</th>
                <th>Make</th>
                <th>Model</th>
                <th>Colour</th>
                <th>Fitness Expiry</th>
                <th>Registration Expiry</th>
                <th>Insurance Company</th>
                <th>Insurance Start Date</th>
                <th>Insurance End Date</th>
                <th>Insurance Document</th>
                <th>Cost Per Day</th>
            </tr>
        </thead>

        <tbody> 
            <?php
                
                if ($result->num_rows > 0) 
                {
                    
                    while ($row = $result->fetch_assoc())
                    {
                        $regdate=date_create($row['Registration Expiry']);
                        $fitdate=date_create($row['Fitness Expiry']);
                        $insenddate=date_create($row['Insurance End Date']);
                        date_sub($regdate,date_interval_create_from_date_string("15 days"));
                        date_sub($fitdate,date_interval_create_from_date_string("15 days"));
                        date_sub($insenddate,date_interval_create_from_date_string("15 days"));

                        // set Alert for Fitness Expiration
                        if(date("Y-m-d") >= date_format($fitdate,"Y-m-d") )
                        {
                            $tdStyle='background-color:red;';
                            
                        } else if ($row['Fitness Expiry'] > date("Y-m-d"))
                        { 
                            $tdStyle='background-color:none;';
                        };

                        // set Alert for Registration Expiration
                        if(date("Y-m-d") >= date_format($regdate,"Y-m-d") )
                        {
                            $tdStyle2='background-color:red;';
                            
                        } else if ($row['Registration Expiry'] > date("Y-m-d"))
                        { 
                            $tdStyle2='background-color:none;';
                        };
                        
                        // set Alert for Insurance Expiration
                        if(date("Y-m-d") >= date_format($insenddate,"Y-m-d") )
                        {
                            $tdStyle3='background-color:red;';
                            
                        } else if ($row['Insurance End Date'] > date("Y-m-d"))
                        { 
                            $tdStyle3='background-color:none;';
                        };
            ?>
                        <tr>
                            <td><?php echo $row['Vehicle Reg No']; ?></td>
                            <td><?php echo $row['Year']; ?></td>
                            <td><?php echo $row['Make']; ?></td>
                            <td><?php echo $row['Model']; ?></td>
                            <td><?php echo $row['Colour']; ?></td>
                            <?php echo "</td><td style=\"$tdStyle\">"; echo $row['Fitness Expiry'] ?>
                            <?php echo "</td><td style=\"$tdStyle2\">"; echo $row['Registration Expiry'] ?>
                            <td><?php echo $row['Insurance Company']; ?></td>
                            <td><?php echo $row['Insurance Start Date']; ?></td>
                            <?php echo "</td><td style=\"$tdStyle3\">"; echo $row['Insurance End Date'] ?>
                            <td><?php echo $row['Insurance Document']; ?></td>
                            <td>$ <?php echo $row['Cost Per Day']; ?></td>
                            <td><a class="btn btn-info" href="updateVehicle.php?regno=<?php echo $row['Vehicle Reg No']; ?>">Edit</a>&nbsp;<!--<a class="btn btn-danger" href="delete.php?id=<?php echo $row['Vehicle Reg No']; ?>">Delete</a>--></td>
                        </tr>                       
              
            <?php    }

                }
            ?>                
        </tbody>
    </table>
    </div>
    <script>
            /*
if($row['Year']<2016)
                              {
                                echo "<td style='background-color: #FF0000;'></td>";
                                }*/
    </script>
</body>

</html>