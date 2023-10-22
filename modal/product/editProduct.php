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
    <title>UPDATE PRODUCT/REPORT</title>
    <link rel="stylesheet" href="../../assets/bootstrap-dis/css/bootstrap.css">
    <script src="../../assets/bootstrap-dis/js/bootstrap.js"></script>
    <link rel="stylesheet" href="../../assets/fontawesome-icons/css/all.css">
    <script src="../../assets/jquery/jquery-3.6.3.js"></script>
    <link rel="stylesheet" href="../../assets/datatable/datatables.css">
    <script src="../../assets/datatable/datatables.js"></script>
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
    <div class="collapse navbar-collapse ms-4" id="navbarCollapse">
        <ul class="navbar-nav mb-2">
            <li class="nav-item"><a href="../adminDashboard/dashboard.php" class="nav-link me-3"><i class="fa fa-globe"></i>&nbsp;Dashboard</a></li>
            <li class="nav-item"><a href="../adminDashboard/possystem.php" class="nav-link"><i class="fa fa-th-large"></i>&nbsp;Pos System</a></li>
        </ul>
        <div class="text-white ms-auto me-5">
            <label class="text-white" style="letter-spacing: 2px;">Welcome, <span class="text-white" style="font-weight: 600;"><?=$_SESSION['admin']?></span></label>
        </div>
    </div>
</nav>
<!-- Navigation End -->

<?php if(isset($_SESSION['message'])):?>
    <h5 class="alert alert-success"><?= $_SESSION['message']?>
    <button type="button" class="close float-end" data-bs-dismiss="alert">&times;</button>
    </h5>
<?php endif; 
unset($_SESSION['message']);
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <h2 class="mb-4"></h2>

            <ul class="nav nav-tabs flex-column">
                
                <li class="nav-item"><a href="#products" class="nav-link active" data-bs-toggle="tab"><i class="fa fa-edit"></i>&nbsp;Products</a></li>
                <!-- <li class="nav-item"><a href="#sales" class="nav-link" data-bs-toggle="tab"><i class="fa fa-shopping-cart"></i>&nbsp;Sales</a></li>
                <li class="nav-item"><a href="#search" class="nav-link" data-bs-toggle="tab"><i class="fa fa-search"></i>&nbsp;Search</a></li>
                <li class="nav-item"><a href="#report" class="nav-link" data-bs-toggle="tab"><i class="fa fa-book"></i>&nbsp;Report</a></li> -->
            </ul>
        </div>
        <div class="col-md-10">
            <h2 class="mb-4"></h2>

            <div class="tab-content">

                <!-- PRODUCT FORM START -->
                <div class="tab-pane fade show active" id="products">
                    
                    <div class="card">
                        <div class="card-header">
                            <h5><span class="text-danger">&nsc;</span>Products</h5>
                        </div>
                        <div class="card-body">
                            <?php
                            if(isset($_GET['id'])) {
                                $id = $_GET['id'];

                                $sql = "SELECT * FROM product WHERE id = :id";
                                $stmt = $conn->prepare($sql);
                                $stmt->execute(['id' => $id]);

                                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                            } 
                            ?>
                            <!-- formStart product -->
                            <form action="updateProduct.php" method="post">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <input type="hidden" name="id" value="<?= $result['id'];?>">
                                            <div class="form-group mb-3">
                                                <label class="mb-1">Item Number<span class="text-danger">*</span></label>
                                                <input type="text" name="itemNumber" id="itemNumber" value="<?= $result['itemNumber']?>" class="form-control form-control-sm" placeholder="Enter No.">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group mb-3">
                                                <label class="mb-1">Item Name<span class="text-danger">*</span></label>
                                                <input type="text" id="itemName" value="<?= $result['itemName']?>" name="itemName" class="form-control form-control-sm" placeholder="Enter Name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group mb-3">
                                                <label class="mb-1">Description<span class="text-danger">*</span></label>
                                                <textarea id="description" value="<?= $result['description']?>" name="description" rows="3" class="form-control form-control-sm" placeholder="Descript"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group mb-3">
                                                <label class="mb-1">Quantity<span class="text-danger">*</span></label>
                                                <input id="quantity" value="<?= $result['quantity']?>" type="text" name="quantity" class="form-control form-control-sm" placeholder="Enter Qty">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group mb-3">
                                                <label class="mb-1">Unit Price<span class="text-danger">*</span></label>
                                                <input type="text" id="unitPrice" value="<?= $result['unitPrice']?>" name="unitPrice" class="form-control form-control-sm" placeholder="Enter px">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group mb-4">
                                                <label class="mb-1">Total Stock<span class="text-danger">*</span></label>
                                                <input type="text" id="totalStock" value="<?= $result['totalStock']?>" name="totalStock" class="form-control form-control-sm" placeholder="Enter stck">
                                            </div>
                                        </div>
                                    </div>
                                    <input type="submit" name="updateProductBtn" class="btn btn-outline-success btn-sm" value="Update Product">
                                </div>
                            </form>
                            <!-- formEnd product -->
                        </div>
                    </div>
                </div>
                <!-- PRODUCT FORM END -->
            </div>
        </div>
       
    </div>
</div>
</body>
</html>