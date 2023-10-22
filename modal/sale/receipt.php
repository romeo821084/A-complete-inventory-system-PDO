<?php
include('../../database/dbh.php');
session_start();
if(!isset($_SESSION['admin'])){
    header("location:../../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Account</title>
    <link rel="stylesheet" href="../../assets/bootstrap-dis/css/bootstrap.css">
    <script src="../../assets/bootstrap-dis/js/bootstrap.js"></script>
    <link rel="stylesheet" href="../../assets/fontawesome-icons/css/all.css">
    <script src="../../assets/jquery/jquery-3.6.3.js"></script>
    <link rel="stylesheet" href="../../assets/datatable/datatables.css">
    <script src="../../assets/datatable/datatables.js"></script>
</head>
<body class="bg-light">

<div class="container">
    <div class="row">
        <div class="col-md-6 bg-white mx-auto">
            <ul class="navbar-nav" style="padding: 10px;">
                <li class="nav-item fs-4"><img src="../../image/newRoseLogo PNG.png" style="width: 150px;"><span class="fs-6">Receipt</span> <span class="ms-5"><b>Rose Tech Multimedia</b></span></li>
            </ul>
            <hr>
            <center>
                <p>Rose Tech Multimedia, <br>
                    Post Office Box 8,<br>
                    Tamale,<br>
                    <h6><i class="fa fa-phone"></i>&nbsp; 0546 966 002</h6>
                </p>

            </center>
            <hr>

            <div class="container">
                <h5>Sold Product Details</h5>
                <table align="center">
                    <thead>
                        <tr>
                            <th class="pe-5">Customer Name</th>
                            <th class="pe-5">Quantity</th>
                            <th class="pe-5">Unit Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(isset($_GET['id'])) {
                            $id = $_GET['id'];

                            $sql = "SELECT * FROM sale WHERE id = :id";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute(['id' => $id]);
                            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            if($result) {
                                foreach($result as $row) {
                                    ?>
                                    <tr>
                                        <td class="pt-3"><?= $row['customerName'];?></td>
                                        <td class="pt-3"><?= $row['quantity'];?></td>
                                        <td class="pt-3"><?= $row['unitPrice'];?></td>
                                        <td class="pt-3"><?= $row['total'];?></td>
                                    </tr>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <hr>
                <center style="padding: 10px;">
                    <h6>Grand Total: <span class="ms-4"><?=$row['grand_total']?></span></h6>
                    <h6>Date: <span class="ms-4"><?=$row['date']?></span></h6>
                </center>
                <hr>
                <div class="container">
                    <center style="padding: 10px;">
                        <p style="font-size: 12px;">Thank you for patronizing us</p>
                    </center>
                </div>
            </div>
        </div>
    </div>
    <center style="padding: 10px;">
        <button onclick="print()" title="Print Invoice/Receipt" class="btn btn-info btn-sm text-white"><i class="fa fa-print"></i>&nbsp;Print</button>
        <a href="../adminDashboard/possystem.php" class="btn btn-success btn-sm ms-1"><i class="fa fa-repeat"></i>&nbsp;Close</a>
    </center>
</div>
</body>
</html>