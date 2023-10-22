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
</head>
<body class="bg-light">

<!-- Navigation Start -->
<nav class="navbar navbar-expand-md navbar-dark bg-dark px-4">
    <a href="" class="navbar-brand mb-2">Rose Tech Multimedia</a>
    <!-- Collapse Navigation -->
    <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Navigation List -->
    <div class="collapse navbar-collapse ms-4 py-1" id="navbarCollapse">
        <ul class="navbar-nav mb-2">
            <li class="nav-item"><a href="#" class="nav-link me-3"><i class="fa fa-globe"></i>&nbsp;Dashboard</a></li>
            <li class="nav-item"><a href="possystem.php" class="nav-link"><i class="fa fa-th-large"></i>&nbsp;Pos System</a></li>
        </ul>
        <div class="text-white ms-auto me-5">
            <label class="text-info" style="letter-spacing: 2px;">Welcome, <span class="text-white" style="font-weight: 600;"><?=$_SESSION['admin']?></span></label>
        </div>
    </div>
</nav>
<!-- Navigation End -->

<div class="container mt-4">
    <div class="image" style="display: flex; align-items:center; justify-content:center;">
        <img src="../../image/newRoseLogo PNG.png" alt="" style="width: 200px;">
        <a href="" class="navbar-brand fs-4" style="font-weight: 500;">Rose Tech Multimedia</a>
    </div>
    <div class="card outline-secondary">
        <div class="card-header">
            <h6 class="text-info"><i class="fa fa-user"></i> Administrator Page</h6>
        </div>
        <div class="card-body" style="box-shadow: 0 1px 5px rgba(104, 104, 104, 0.8);">
            <div class="row row-cols-4">
                <a href="" class="btn btn-dark py-3 m-2"><i class="fa fa-th fs-3"></i><br>
                Total Products
                <div>
                    <?php

                    $sql = "SELECT sum(quantity) as total FROM product";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <h4 class="mb-0 text-info pt-1"><?=$row['total']?></h4>
                        <?php
                    }
                    ?>
                </div>
                </a>
                <a href="" class="btn btn-dark py-3 m-2"><i class="fa fa-dollar fs-3"></i><br>
                Total Income
                <div>
                    <?php
                    $sql = "SELECT sum(grand_total) as grandTotal FROM sale";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <h5 class="m-0 text-info pt-1"><?= $row['grandTotal']?></h5>
                        <?php
                    }
                    ?>
                </div>
                </a>


                <a href="" class="btn btn-dark py-3 m-2"><i class="fa fa-users fs-3"></i><br>
                Total users
                <div>
                    <?php
                    $sql = "SELECT count(*) as count_user FROM user";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <h5 class="mb-0 text-info pt-1"><?= $row['count_user']?></h5>
                        <?php
                    }
                    ?>
                </div>
                </a>
                <a href="../../createAccount/logout.php" class="btn btn-warning py-3 m-2 text-white"><i class="fa fa-sign-out fs-3"></i><br>
                Logout</a>
            </div>
        </div>
    </div>
</div>

</script>
</body>
</html>