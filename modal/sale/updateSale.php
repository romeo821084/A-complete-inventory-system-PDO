<?php
include('../../database/dbh.php');
session_start();

if(isset($_POST['updateSaleBtn'])) {
    $date = date($_POST['date']);
    $customerName = $_POST['customerName'];
    $itemNumber = $_POST['itemNumber'];
    $itemName = $_POST['itemName'];
    $quantity = $_POST['quantity'];
    $unitPrice = $_POST['unitPrice'];
    $total = $_POST['total'];
    $totalStock = $_POST['totalStock'];
    $grand_total = $_POST['grand_total'];
    $id = $_POST['id'];

    $sql = "UPDATE sale SET date=:date, customerName=:customerName, itemNumber=:itemNumber, itemName=:itemName, quantity=:quantity, unitPrice=:unitPrice, total=:total, totalStock=:totalStock, grand_total=:grand_total WHERE id=:id";
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
        'grand_total' => $grand_total,
        'id' => $id
    ]);

    if($stmt) {
        $_SESSION['message'] = "Sale Updated Successfully";
        header("location:../adminDashboard/possystem.php");
        exit();
    } else {
        $_SESSION['message'] = "Sale Updated Successfully";
        header("location:../adminDashboard/possystem.php");
        exit();
    }
}