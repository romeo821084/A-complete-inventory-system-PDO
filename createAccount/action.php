<?php
include('../database/dbh.php');
session_start();

if(isset($_POST['registerBtn'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $type = $_POST['type'];

    $sql = "SELECT * FROM user WHERE email = :email && password = :password";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        'email' => $email,
        'password' => $password
    ]);

    if($stmt->rowCount() > 0) {
        $_SESSION['invalid'] = "Email taken or user already exits";
        header('location:registerAccount.php');
        exit();
    } else {
        if($password != $cpassword) {
            $_SESSION['invalid'] = "Password dont match, try again";
            header('location:registerAccount.php');
            exit();
        } else {
            $sql = "INSERT INTO user(name, email, password, type) VALUES(:name, :email, :password, :type)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'type' => $type
            ]);
            
            if($stmt) {
                $_SESSION['message'] = "User created Successfully";
                header('location:../index.php');
                exit();
            } else {
                $_SESSION['message'] = "User created Failed, Try Again!";
                header('location:../index.php');
                exit();
            }
        }
    }
}


if(isset($_POST['loginBtn'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $type = $_POST['type'];

    $sql = "SELECT * FROM user WHERE email = :email && password = :password";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        'email' => $email,
        'password' => $password
    ]);

    if($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row['type'] == 'admin'){
            $_SESSION['admin'] = $row['name'];
            header('location:../modal/adminDashboard/dashboard.php');
            exit(0);

        } elseif($row['type'] == "user"){
            $_SESSION['user'] = $row['name'];
            header('location:../modal/adminDashboard/dashboard.php');
            exit(0);
            
        } else {
            $_SESSION['message'] = "incorrect username or password";
            header('location:../modal/adminDashboard/dashboard.php');
            exit(0);
        }
    }
}
