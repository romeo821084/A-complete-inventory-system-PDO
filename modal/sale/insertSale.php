<?php
include('../../database/dbh.php');
session_start();

if(isset($_POST['saleBtn'])) {

    for($i=0;$i<count($_POST['itemNumber']);$i++) {
        $date = date($_POST['date']);
        $customerName = $_POST['customerName'];
        $itemNumber = $_POST['itemNumber'][$i];
        $itemName = $_POST['itemName'][$i];
        $quantity = $_POST['quantity'][$i];
        $unitPrice = $_POST['unitPrice'][$i];
        $total = $_POST['total'][$i];
        $totalStock = $_POST['totalStock'][$i];
        $grand_total = $_POST['grand_total'];

        if(!empty($date) && isset($customerName) && isset($grand_total) && isset($itemNumber)&& isset($itemName)&& isset($quantity) && isset($unitPrice) && isset($total)&& isset($totalStock)){
            $itemNumber = filter_var($itemNumber, FILTER_SANITIZE_STRING);

            if(filter_var($quantity, FILTER_VALIDATE_INT) === 0 || filter_var($quantity, FILTER_VALIDATE_INT)) {
                // validate quantity
            } else {
                echo '<div class="alert alert-danger"><button class="close float-end" data-bs-dismiss="alert">&times;</button>Enter valid quantity</div>';
                exit();
            }

            if(filter_var($total, FILTER_VALIDATE_FLOAT) === 0.0 || filter_var($unitPrice, FILTER_VALIDATE_FLOAT)) {
                // validate price
            } else {
                echo '<div class="alert alert-danger"><button class="close float-end" data-bs-dismiss="alert">&times;</button>Enter valid price</div>';
                exit();
            }

            if($itemNumber == '') {
                echo '<div class="alert alert-danger"><button class="close float-end" data-bs-dismiss="alert">&times;</button>Enter item number Filed</div>';
                exit();
            }
            if($date == '') {
                echo '<div class="alert alert-danger"><button class="close float-end" data-bs-dismiss="alert">&times;</button>Enter Date Filed</div>';
                exit();
            }
            if($customerName == '') {
                echo '<div class="alert alert-danger"><button class="close float-end" data-bs-dismiss="alert">&times;</button>Enter customer field Filed</div>';
                exit();
            }

            $stockSql = "SELECT quantity FROM product WHERE itemNumber = :itemNumber";
            $stockStatement = $conn->prepare($stockSql);
            $stockStatement->execute(['itemNumber' => $itemNumber]);

            if($stockStatement->rowCount() > 0) {
                $row = $stockStatement->fetch(PDO::FETCH_ASSOC);
                $currentStockInTable = $row['quantity'];

                if($currentStockInTable <= 0) {
                    echo '<div class="alert alert-danger"><button class="close float-end" data-bs-dismiss="alert">&times;</button>Stock is empty, therefore cant make sales, try a different product</div>';
                    exit();
                } elseif($currentStockInTable < $quantity) {
                    echo '<div class="alert alert-danger"><button class="close float-end" data-bs-dismiss="alert">&times;</button>Not enough stock, therefore cant make sale, try different product</div>';
                    exit();
                } else {
                    $newStock = $currentStockInTable - $quantity;
                    $updateSql = "UPDATE product SET quantity = :quantity WHERE itemNumber = :itemNumber";
                    $updateStatement = $conn->prepare($updateSql);
                    $updateStatement->execute(['quantity' => $newStock, 'itemNumber' => $itemNumber]);

                    $sql = "INSERT INTO sale(date, customerName, itemNumber, itemName, quantity, unitPrice, total, totalStock, grand_total) VALUES(:date, :customerName, :itemNumber, :itemName, :quantity, :unitPrice, :total, :totalStock, :grand_total)";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute([
                        'date' => $date,
                        'customerName' => $customerName,
                        'itemNumber' => $itemNumber,
                        'itemName' => $itemName,
                        'quantity' => $quantity,
                        'unitPrice' => $unitPrice,
                        'total' => $total,
                        'totalStock' => $totalStock,
                        'grand_total' => $grand_total
                    ]);

                    
                        header("location:../adminDashboard/possystem.php");
                        
                }
            }
        
        } else {
            echo '<div class="alert alert-danger"><button class="close float-end" data-bs-dismiss="alert">&times;</button>Enter all fields</div>';
            exit();
        }
    }
}