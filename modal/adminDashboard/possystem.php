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
            <li class="nav-item"><a href="dashboard.php" class="nav-link me-3"><i class="fa fa-globe"></i>&nbsp;Dashboard</a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i class="fa fa-th-large"></i>&nbsp;Pos System</a></li>
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
                
                <li class="nav-item"><a href="#products" class="nav-link active" data-bs-toggle="tab"><i class="fa fa-th"></i>&nbsp;Products</a></li>
                <li class="nav-item"><a href="#sales" class="nav-link" data-bs-toggle="tab"><i class="fa fa-shopping-cart"></i>&nbsp;Sales</a></li>
                <li class="nav-item"><a href="#search" class="nav-link" data-bs-toggle="tab"><i class="fa fa-search"></i>&nbsp;Search</a></li>
                <li class="nav-item"><a href="#report" class="nav-link" data-bs-toggle="tab"><i class="fa fa-book"></i>&nbsp;Report</a></li>
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
                            <!-- formStart product -->
                            <form action="../product/insertProductForm.php" method="post" enctype="multipart/form-data">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group mb-3">
                                                <label class="mb-1">Item Number<span class="text-danger">*</span></label>
                                                <input type="text" name="itemNumber" class="form-control form-control-sm" placeholder="Enter No.">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group mb-3">
                                                <label class="mb-1">Item Name<span class="text-danger">*</span></label>
                                                <input type="text" name="itemName" class="form-control form-control-sm" placeholder="Enter Name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group mb-3">
                                                <label class="mb-1">Description<span class="text-danger">*</span></label>
                                                <textarea name="description" rows="3" class="form-control form-control-sm" placeholder="Descript"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group mb-3">
                                                <label class="mb-1">Quantity<span class="text-danger">*</span></label>
                                                <input type="text" name="quantity" class="form-control form-control-sm" placeholder="Enter Qty">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group mb-3">
                                                <label class="mb-1">Unit Price<span class="text-danger">*</span></label>
                                                <input type="text" name="unitPrice" class="form-control form-control-sm" placeholder="Enter px">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group mb-4">
                                                <label class="mb-1">Total Stock<span class="text-danger">*</span></label>
                                                <input type="text" name="totalStock" class="form-control form-control-sm" placeholder="Enter stck">
                                            </div>
                                        </div>
                                    </div>
                                    <input type="submit" name="productBtn" class="btn btn-outline-primary btn-sm" value="Add Product">
                                </div>
                            </form>
                            <!-- formEnd product -->
                        </div>
                    </div>
                </div>
                <!-- PRODUCT FORM END -->



                <!-- SALES FORM START -->
                <div class="tab-pane fade" id="sales">
                    <div class="card">
                        <div class="card-header">
                            <h5><span class="text-danger">&nsc;</span>Sales</h5>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-10 mx-auto">
                                        <form action="../sale/insertSale.php" method="post">
                                            <div class="form-group row mb-2">
                                                <label class="col-md-3" align="right">Date<span class="text-danger">*</span></label>
                                                <div class="col-sm-5">
                                                    <input type="date" name="date" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                            <div class="form-group row mb-3">
                                                <label class="col-md-3" align="right">Customer Name<span class="text-danger">*</span></label>
                                                <div class="col-sm-5">
                                                    <input type="text" name="customerName" class="form-control form-control-sm" placeholder="Enter customer name">
                                                </div>
                                            </div>
                                            <div class="card" style="box-shadow: 0 1px 5px rgba(104, 104, 104, 0.8);">
                                                <div class="card-body">
                                                    <table align="center" style="width: 800px;" class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Item Number</th>
                                                            <th>Item Name</th>
                                                            <th>Quantity</th>
                                                            <th>Unit Price</th>
                                                            <th>Total</th>
                                                            <th>Total Stock</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><input type="text" name="itemNumber[]" class="form-control form-control-sm itemNumber" id="itemNumber" onkeyup="autofill(this)"></td>
                                                            <td><input type="text" name="itemName[]" class="form-control form-control-sm itemName bg-light" readonly title="item number is automatically generated"></td>
                                                            <td><input type="text" name="quantity[]" class="form-control form-control-sm quantity"></td>
                                                            <td><input type="text" name="unitPrice[]" readonly class="form-control form-control-sm unitPrice bg-light" title="unit price is automatically generated"></td>
                                                            <td><input type="text" name="total[]" readonly class="form-control form-control-sm total bg-light" title="total is automatically generated"></td>
                                                            <td><input type="text" name="totalStock[]" title="total is automatically generated" class="form-control form-control-sm totalStock bg-light"></td>
                                                            <td><button type="button" title="Add row for sales" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-lg" id="addRow"></i></button></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                </div>
                                            </div>
                                                <center style="padding: 10px;">
                                                    <div class="form-group row">
                                                        <label class="col-md-3" align="right"><b>Grand Total</b></label>
                                                        <div class="col-sm-6">
                                                            <input type="text" name="grand_total" class="form-control form-control-sm" id="grand_total" placeholder="Enter grand total">
                                                        </div>
                                                    </div>
                                                </center> 
                                                <input type="submit" value="Add sale" name="saleBtn" class="btn btn-primary btn-sm">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- SALES FORM END -->





                <!-- SEARCH TABLES START -->
                <div class="tab-pane fade" id="search">
                    <div class="card">
                        <div class="card-header">
                            <h5><span class="text-danger">&nsc;</span>Search</h5>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item"><a href="#productSearch" class="nav-link active" data-bs-toggle="tab">Product</a></li>

                                    <li class="nav-item"><a href="#saleSearch" class="nav-link" data-bs-toggle="tab">Sale</a></li>
                                </ul>
                                <div class="tab-content">



                                    <!-- PRODUCT TABLE DETAILS START -->
                                    <div class="tab-pane fade show active" id="productSearch">
                                        <div class="container">
                                            <h6 class="py-2 text-success">Use the grid below to search product details</h6>
                                            <table class="table table-borderd table-sm table-striped" id="myTable2">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Item No</th>
                                                        <th>Item Name</th>
                                                        <th>Descript</th>
                                                        <th>Qty</th>
                                                        <th>Unit Price</th>
                                                        <th>Total Stock</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sql = "SELECT * FROM product";
                                                    $stmt = $conn->prepare($sql);
                                                    $stmt->execute();
                                                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                    if($result) {
                                                        foreach($result as $row) {
                                                            ?>
                                                            <tr>
                                                                <td><?= $row['id'];?></td>
                                                                <td><?= $row['itemNumber'];?></td>
                                                                <td><?= $row['itemName'];?></td>
                                                                <td><?= $row['description'];?></td>
                                                                <td><?= $row['quantity'];?></td>
                                                                <td><?= $row['unitPrice'];?></td>
                                                                <td><?= $row['totalStock'];?></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    } else {
                                                        echo '<td colspan="8" class="text-center">No data in product table</td>';
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- PRODUCT TABLE DETAILS END -->



                                    <!-- SALE TABLE DETAILS START -->
                                    <div class="tab-pane fade" id="saleSearch">
                                        <div class="container">
                                        <h6 class="py-2 text-success">Use the grid below to search Sale details</h6>
                                            <table class="table table-borderd table-sm table-striped" id="myTable">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Date</th>
                                                        <th>Cust Name</th>
                                                        <th>Item No.</th>
                                                        <th>Item Name</th>
                                                        <th>Qty</th>
                                                        <th>Price</th>
                                                        <th>Total</th>
                                                        <th>Total Stk</th>
                                                        <th>Grd Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sql = "SELECT * FROM sale";
                                                    $stmt = $conn->prepare($sql);
                                                    $stmt->execute();
                                                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                    if($result) {
                                                        foreach($result as $row) {
                                                            ?>
                                                            <tr>
                                                                <td><?= $row['id'];?></td>
                                                                <td><?= $row['date'];?></td>
                                                                <td><?= $row['customerName'];?></td>
                                                                <td><?= $row['itemNumber'];?></td>
                                                                <td><?= $row['itemName'];?></td>
                                                                <td><?= $row['quantity'];?></td>
                                                                <td><?= $row['unitPrice'];?></td>
                                                                <td><?= $row['total'];?></td>
                                                                <td><?= $row['totalStock'];?></td>
                                                                <td><?= $row['grand_total'];?></td>
                                                                
                                                            </tr>
                                                            <?php
                                                        }
                                                    } else {
                                                        echo '<td colspan="8" class="text-center">No data in Sale table</td>';
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- SALE TABLE DETAILS END -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- SEARCH TABLES END -->


                
                    
                <!-- REPORT START -->
                <div class="tab-pane fade" id="report">
                    <div class="card">
                        <div class="card-header">
                            <h5><span class="text-danger">&nsc;</span>Report</h5>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item"><a href="#productReport" class="nav-link active" data-bs-toggle="tab">Product</a></li>

                                    <li class="nav-item"><a href="#saleReport" class="nav-link" data-bs-toggle="tab">Sale</a></li>

                                    <li class="nav-item"><a href="#dailySaleReport" class="nav-link" data-bs-toggle="tab">Daily Sales</a></li>

                                    <li class="nav-item"><a href="#yearlySaleReport" class="nav-link" data-bs-toggle="tab">Yearly Sales</a></li>
                                </ul>
                                <div class="tab-content">

                                    <!-- PRODUCT REPORT START -->
                                     <div class="tab-pane fade show active" id="productReport">
                                        <div class="container">
                                        <h6 class="py-2 text-success">Use the grid below to search Sale details</h6>
                                            <table class="table table-borderd table-sm table-striped" id="myTable4">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Item No</th>
                                                            <th>Item Name</th>
                                                            <th>Descript</th>
                                                            <th>Qty</th>
                                                            <th>Unit Price</th>
                                                            <th>Total Stock</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sql = "SELECT * FROM product";
                                                        $stmt = $conn->prepare($sql);
                                                        $stmt->execute();
                                                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                        if($result) {
                                                            foreach($result as $row) {
                                                                ?>
                                                                <tr>
                                                                    <td><?= $row['id'];?></td>
                                                                    <td><?= $row['itemNumber'];?></td>
                                                                    <td><?= $row['itemName'];?></td>
                                                                    <td><?= $row['description'];?></td>
                                                                    <td><?= $row['quantity'];?></td>
                                                                    <td><?= $row['unitPrice'];?></td>
                                                                    <td><?= $row['totalStock'];?></td>
                                                                    <td>
                                                                    <!-- <a href="" title="View details" class="text-success"><i class="fa fa-circle-info fa-lg"></i></a>&nbsp;&nbsp; -->

                                                                    <a href="../product/editProduct.php?id=<?= $row['id'];?>" title="Edit" class="text-primary"><i class="fa fa-edit fa-lg"></i></a>&nbsp;&nbsp;

                                                                    <a href="../product/deleteProduct.php?id=<?= $row['id'];?>" title="Delete" class="text-danger" onclick="return confirm('are you sure? Deleted cant be reverted')"><i class="fa fa-trash-alt fa-lg"></i></a>
                                                                </td>
                                                                </tr>
                                                                <?php
                                                            }
                                                        } else {
                                                            echo '<td colspan="8" class="text-center">No data in product table</td>';
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                        </div>

                                     </div>
                                     <!-- PRODUCT REPORT END -->

                                     

                                    <!-- SALE REPORT START -->
                                    <div class="tab-pane fade" id="saleReport">
                                        <div class="container">
                                        <h6 class="py-2 text-success">Use the grid below to search Sale details</h6>
                                            <!-- report table start -->
                                            <table class="table table-borderd table-sm table-striped" id="myTable3">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Date</th>
                                                        <th>C Name</th>
                                                        <th>Item No.</th>
                                                        <th>Item Name</th>
                                                        <th>Qty</th>
                                                        <th>Price</th>
                                                        <th>Total</th>
                                                        <th>Total Stk</th>
                                                        <th>Grd Total</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sql = "SELECT sum(unitPrice) as unitPrice FROM sale";
                                                    $stmt = $conn->prepare($sql);
                                                    $stmt->execute([]);
                                                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                                        $output = $row['unitPrice'];
                                                    
                                                    }

                                                    $sql = "SELECT sum(total) as total FROM sale";
                                                    $stmt = $conn->prepare($sql);
                                                    $stmt->execute([]);
                                                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                                        $output1 = $row['total'];
                                                    }

                                                    $sql = "SELECT sum(grand_total) as total FROM sale";
                                                    $stmt = $conn->prepare($sql);
                                                    $stmt->execute([]);
                                                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                                        $output2 = $row['total'];
                                                    }
                                                    

                                                    $sql = "SELECT * FROM sale";
                                                    $stmt = $conn->prepare($sql);
                                                    $stmt->execute();
                                                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                    if($result) {
                                                        foreach($result as $row) {
                                                            ?>
                                                            <tr>
                                                                <td><?= $row['id'];?></td>
                                                                <td><?= $row['date'];?></td>
                                                                <td><?= $row['customerName'];?></td>
                                                                <td><?= $row['itemNumber'];?></td>
                                                                <td><?= $row['itemName'];?></td>
                                                                <td><?= $row['quantity'];?></td>
                                                                <td><?= $row['unitPrice'];?></td>
                                                                <td><?= $row['total'];?></td>
                                                                <td><?= $row['totalStock'];?></td>
                                                                <td><?= $row['grand_total'];?></td>
                                                                <td>
                                                                    <a href="../sale/receipt.php?id=<?= $row['id'];?>" title="View details" class="text-success"><i class="fa fa-circle-info fa-lg"></i></a>&nbsp;&nbsp;

                                                                    <a href="../sale/editSales.php?id=<?= $row['id']?>" title="Edit" class="text-primary"><i class="fa fa-edit fa-lg"></i></a>&nbsp;&nbsp;

                                                                    <a href="../sale/deleteSale.php?id=<?= $row['id'];?>" title="Delete" class="text-danger" onclick="return confirm('are you sure? Deleted cant be reverted')"><i class="fa fa-trash-alt fa-lg"></i></a>
                                                                </td>
                                                                
                                                            </tr>
                                                            <?php
                                                        }
                                                    } else {
                                                        echo '<td colspan="8" class="text-center">No data in Sale table</td>';
                                                    }
                                                    ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td><b>Total</b></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td><b><?= $output;?> (<?=$output;?> total)</b></td>
                                                        <td><b><?= $output1;?> (<?=$output1;?> total)</b></td>
                                                        <td></td>
                                                        <td><b><?= $output2;?> (<?=$output2;?> total)</b></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                            <!-- report table end -->
                                        </div>
                                    </div>
                                    <!-- SALE REPORT END -->


                                    <!-- DAILY SALES REPORT START -->
                                    <div class="tab-pane fade" id="dailySaleReport">
                                    <h6 class="py-2 text-success">Use the grid below to search Sale details</h6>
                                        <div class="container">
                                            <table class="table table-borderd table-striped table-sm" id="myTable5">
                                                <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Daily Sales</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sql = "SELECT date(date) as date, SUM(grand_total) as grand_total FROM sale GROUP by date(date)";
                                                    $stmt = $conn->prepare($sql);
                                                    $stmt->execute();
                                                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                    if($result) {
                                                        foreach($result as $row) {
                                                            ?>
                                                            <tr>
                                                                <td><?= $row['date']?></td>
                                                                <td><?= $row['grand_total'] ?></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    } 
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- DAILY SALEREPORT END -->







                                <!-- YEARLY SALES REPORT START -->
                                <div class="tab-pane fade" id="yearlySaleReport">
                                        <div class="container">
                                        <h6 class="py-2 text-success">Use the grid below to search Sale details</h6>
                                            <table class="table table-borderd table-striped table-sm" id="myTable6">
                                                <thead>
                                                    <tr>
                                                        <th>Year</th>
                                                        <th>Daily Sales</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sql = "SELECT date_format(date, '%Y') as date, SUM(grand_total) as grand_total FROM sale GROUP by YEAR(date)";
                                                    $stmt = $conn->prepare($sql);
                                                    $stmt->execute();
                                                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                    if($result) {
                                                        foreach($result as $row) {
                                                            ?>
                                                            <tr>
                                                                <td><?= $row['date']?></td>
                                                                <td><?= $row['grand_total'] ?></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    } 
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                <!-- YEARLY SALES END -->


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- REPORT END -->
            </div>
        </div>
       
    </div>
</div>


    
<script>
    $(document).ready(function(){

        $("#myTable").DataTable();
        $("#myTable2").DataTable();
        $("#myTable3").DataTable();
        $("#myTable4").DataTable();
        $("#myTable5").DataTable();
        $("#myTable6").DataTable();

        $('#addRow').click(function(e){
            e.preventDefault()
            var row = '<tr><td><input type="text" name="itemNumber[]" class="form-control form-control-sm itemNumber" id="itemNumber" onkeyup="autofill(this)"></td><td><input type="text" name="itemName[]" class="form-control form-control-sm itemName bg-light" readonly title="item number is automatically generated"></td><td><input type="text" name="quantity[]" class="form-control form-control-sm quantity"></td><td><input type="text" name="unitPrice[]" readonly class="form-control form-control-sm unitPrice bg-light" title="unit price is automatically generated"></td><td><input type="text" name="total[]" readonly class="form-control form-control-sm total bg-light" title="total is automatically generated"></td><td><input type="text" name="totalStock[]" title="total is automatically generated" class="form-control form-control-sm totalStock bg-light"></td><td><button type="button" title="Remove row for sales" class="btn btn-danger btn-sm"><i class="fa fa-trash-alt fa-lg" id="removeRow"></i></button></td></tr>';
            $('tbody').append(row);
        })

        $('tbody').on('click', '#removeRow', function(e){
            e.preventDefault();
            if(confirm('are u sure?')){
                $(this).closest('tr').remove();
            }
            grand_total()
        })

        $('tbody').on('keyup', '.quantity', function(e){
            e.preventDefault();
            var quantity = Number($(this).val());
            var unitPrice = Number($(this).closest('tr').find('.unitPrice').val());
            $(this).closest('tr').find('.total').val(quantity*unitPrice);
            grand_total()
        })

        $('tbody').on('keyup', '.unitPrice', function(e){
            e.preventDefault();
            var unitPrice = Number($(this).val());
            var quantity = Number($(this).closest('tr').find('.quantity').val());
            $(this).closest('tr').find('.total').val(unitPrice*quantity);
            grand_total()
        })

        function grand_total() {
            var tot=0;
            $('.total').each(function(){
                tot+=Number($(this).val());
            })
            $('#grand_total').val(tot);
        }
    })

    function autofill(id){
        var itemNumber = $(id).val();
        $.ajax({
            url: 'autofill.php',
            data: 'itemNumber='+itemNumber,
            success: function(response){
                data = JSON.parse(response);
                $(id).parent().parent().children().children('.itemName').val(data.itemName);
                $(id).parent().parent().children().children('.unitPrice').val(data.unitPrice);
                $(id).parent().parent().children().children('.totalStock').val(data.totalStock);
            }
        })
    }

</script>
</body>
</html>