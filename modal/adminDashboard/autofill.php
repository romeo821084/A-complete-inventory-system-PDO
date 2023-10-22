<?php
include('../../database/dbh.php');

$itemNumber = $_GET['itemNumber'];
$sql = "SELECT * FROM product WHERE itemNumber = :itemNumber";
$stmt = $conn->prepare($sql);
$stmt->execute(['itemNumber' => $itemNumber]);
if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    $data = array(
        'itemName' => $row['itemName'],
        'unitPrice' => $row['unitPrice'],
        'totalStock' => $row['totalStock'],
    );
    echo json_encode($data);
}