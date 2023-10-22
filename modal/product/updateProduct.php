<?php
include('../../database/dbh.php');
session_start();

if(isset($_POST['updateProductBtn'])) {
    $itemNumber = $_POST['itemNumber'];
    $itemName = $_POST['itemName'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];
    $unitPrice = $_POST['unitPrice'];
    $totalStock = $_POST['totalStock'];
    $id = $_POST['id'];

    $sql = "UPDATE product SET itemNumber = :itemNumber, itemName = :itemName, description = :description, quantity = :quantity, unitPrice = :unitPrice, totalStock = :totalStock WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        'itemNumber' => $itemNumber,
        'itemName' => $itemName,
        'description' => $description,
        'quantity' => $quantity,
        'unitPrice' => $unitPrice,
        'totalStock' => $totalStock,
        'id' => $id
    ]);

    if($stmt) {
        $_SESSION['message'] = "Product Updated Successfully";
        header("location:../adminDashboard/possystem.php");
        exit();
    } else {
        $_SESSION['message'] = "Product Updated Failed";
        header("location:../adminDashboard/possystem.php");
        exit();
    }
}