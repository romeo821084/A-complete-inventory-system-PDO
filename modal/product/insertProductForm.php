<?php
include('../../database/dbh.php');
session_start();

if(isset($_POST['productBtn'])) {
    $itemNumber = $_POST['itemNumber'];
    $itemName = $_POST['itemName'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];
    $unitPrice = $_POST['unitPrice'];
    $totalStock = $_POST['totalStock'];

    // Validate to check if fields are not empty
    if(!empty($itemNumber) && isset($itemName) && isset($quantity ) && isset($unitPrice) && isset($totalStock)) {
        $itemNumber = filter_var($itemNumber, FILTER_SANITIZE_STRING);

        if(filter_var($quantity, FILTER_VALIDATE_INT) === 0 || filter_var($quantity, FILTER_VALIDATE_INT)) {
            // Validate quantity
        } else {
            echo '<div class="alert alert-danger"><button class="close float-end" data-bs-dismiss="alert">&times;</button>Validate quantity, should be integer</div>';
            exit();
        }

        if(filter_var($unitPrice, FILTER_VALIDATE_FLOAT) === 0.0 || filter_var($unitPrice, FILTER_VALIDATE_FLOAT)) {
            // Validate price
        } else {
            echo '<div class="alert alert-danger"><button class="close float-end" data-bs-dismiss="alert">&times;</button>Validate price, should be decimal</div>';
            exit();
        }

        if(filter_var($totalStock, FILTER_VALIDATE_INT) === 0 || filter_var($totalStock, FILTER_VALIDATE_INT)) {
            // Validate quantity
        } else {
            echo '<div class="alert alert-danger"><button class="close float-end" data-bs-dismiss="alert">&times;</button>Validate quantity, should be integer</div>';
            exit();
        }

        if($itemNumber == '') {
            echo '<div class="alert alert-danger"><button class="close float-end" data-bs-dismiss="alert">&times;</button>Enter item number in fields</div>';
            exit();
        }
        if($itemName == '') {
            echo '<div class="alert alert-danger"><button class="close float-end" data-bs-dismiss="alert">&times;</button>Enter item name in fields</div>';
            exit();
        }
        
        if($quantity == '') {
            echo '<div class="alert alert-danger"><button class="close float-end" data-bs-dismiss="alert">&times;</button>Enter item quantity in fields</div>';
            exit();
        }
        if($unitPrice == '') {
            echo '<div class="alert alert-danger"><button class="close float-end" data-bs-dismiss="alert">&times;</button>Enter unit price in fields</div>';
            exit();
        }
        if($totalStock == '') {
            echo '<div class="alert alert-danger"><button class="close float-end" data-bs-dismiss="alert">&times;</button>Enter totalstock in fields</div>';
            exit();
        }

        $sql = "SELECT * FROM product WHERE itemNumber = :itemNumber || itemName = :itemName";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['itemNumber' => $itemNumber, 'itemName' => $itemName]);

        if($stmt->rowCount() > 0) {
            echo '<div class="alert alert-danger"><button class="close float-end" data-bs-dismiss="alert">&times;</button>Item number or item name exits already, try different item details</div>';
            exit();
        } else {
            $insert = "INSERT INTO product (itemNumber, itemName, description, quantity, unitPrice, totalStock) VALUES(:itemNumber, :itemName, :description, :quantity, :unitPrice, :totalStock)";
            $stmt = $conn->prepare($insert);
            $stmt->execute([
            'itemNumber' => $itemNumber,
            'itemName' => $itemName,
            'description' => $description,
            'quantity' => $quantity,
            'unitPrice' => $unitPrice,
            'totalStock' => $totalStock
            ]);
            if($stmt) {
                $_SESSION['message'] = "Product Added Failed";
                header("location:../adminDashboard/possystem.php");
                exit();
            } else {
                $_SESSION['message'] = "Product Added Failed";
                header("location:../adminDashboard/possystem.php");
                exit();
            }
        }
    } else {
        echo '<div class="alert alert-danger"><button class="close float-end" data-bs-dismiss="alert">&times;</button>Enter all fields</div>';
        exit();
    }
}

