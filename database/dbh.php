<?php
$serverName = "localhost";
$userName = "root";
$password = "";
$database = "mysystem";

try {
    $conn = new PDO("mysql:host=$serverName;dbname=$database", $userName, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo 'Connected';
} catch (PDOException $e){
    echo 'ERROR MESSAGE' . $e->getMessage() . "<br>";
}