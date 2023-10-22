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
                
                <!-- <li class="nav-item"><a href="#products" class="nav-link active" data-bs-toggle="tab"><i class="fa fa-th"></i>&nbsp;Products</a></li> -->
                <li class="nav-item"><a href="#sales" class="nav-link" data-bs-toggle="tab"><i class="fa fa-shopping-cart"></i>&nbsp;Sales</a></li>
                <!-- <li class="nav-item"><a href="#search" class="nav-link" data-bs-toggle="tab"><i class="fa fa-search"></i>&nbsp;Search</a></li>
                <li class="nav-item"><a href="#report" class="nav-link" data-bs-toggle="tab"><i class="fa fa-book"></i>&nbsp;Report</a></li> -->
            </ul>
        </div>
        <div class="col-md-10">
            <h2 class="mb-4"></h2>

            <div class="tab-content">

                <!-- SALES FORM START -->
                <div class="tab-pane fade show active" id="sales">
                    <div class="card">
                        <div class="card-header">
                            <h5><span class="text-danger">&nsc;</span>Sales</h5>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-10 mx-auto">

                                    <?php
                                        if(isset($_GET['id'])) {
                                            $id = $_GET['id'];

                                            $sql = "SELECT * FROM sale WHERE id = :id";
                                            $stmt = $conn->prepare($sql);
                                            $stmt->execute(['id' => $id]);

                                            $result = $stmt->fetch(PDO::FETCH_ASSOC);
                                        } 
                                    ?>


                                        <form action="updateSale.php" method="post">
                                            <input type="hidden" name="id" value="<?= $result['id']?>">
                                            <div class="form-group row mb-2">
                                                <label class="col-md-3" align="right">Date<span class="text-danger">*</span></label>
                                                <div class="col-sm-5">
                                                    <input id="date" value="<?= $result['date']?>" type="date" name="date" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                            <div class="form-group row mb-3">
                                                <label class="col-md-3" align="right">Customer Name<span class="text-danger">*</span></label>
                                                <div class="col-sm-5">
                                                    <input type="text" name="customerName" id="customerName" value="<?= $result['customerName']?>" class="form-control form-control-sm" placeholder="Enter customer name">
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
                                                            <!-- <th>Action</th> -->
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><input type="text" name="itemNumber" class="form-control form-control-sm itemNumber" id="itemNumber" value="<?= $result['itemNumber']?>" onkeyup="autofill(this)"></td>
                                                            <td><input type="text" name="itemName" class="form-control form-control-sm itemName bg-light" id="itemName" value="<?= $result['itemName']?>" title="item number is automatically generated"></td>
                                                            <td><input type="text" name="quantity" id="quantity" value="<?= $result['quantity']?>"class="form-control form-control-sm quantity" id="quantity" value="<?= $result['quantity']?>"></td>
                                                            <td><input type="text" id="unitPrice" value="<?= $result['unitPrice']?>"name="unitPrice" class="form-control form-control-sm unitPrice bg-light"></td>
                                                            <td><input type="text" name="total" id="total" value="<?= $result['total']?>" class="form-control form-control-sm total bg-light" title="total is automatically generated"></td>
                                                            <td><input type="text" name="totalStock" title="total is automatically generated" id="totalStock" readonly class="form-control form-control-sm totalStock bg-light" id="totalStock" value="<?= $result['totalStock']?>"></td>
                                                            <!-- <td><button type="button" title="Add row for sales" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-lg" id="addRow"></i></button></td> -->
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                </div>
                                            </div>
                                                <center style="padding: 10px;">
                                                    <div class="form-group row">
                                                        <label class="col-md-3" align="right"><b>Grand Total</b></label>
                                                        <div class="col-sm-6">
                                                            <input type="text" name="grand_total" class="form-control form-control-sm" id="grand_total" value="<?= $result['grand_total']?>" placeholder="Enter grand total">
                                                        </div>
                                                    </div>
                                                </center> 
                                                <input type="submit" value="Update sale" name="updateSaleBtn" class="btn btn-success btn-sm">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- SALES FORM END -->
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
            url: '../adminDashboard/autofill.php',
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