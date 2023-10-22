<?php
session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Account</title>
    <link rel="stylesheet" href="assets/bootstrap-dis/css/bootstrap.css">
    <script src="assets/bootstrap-dis/js/bootstrap.js"></script>
    <link rel="stylesheet" href="assets/fontawesome-icons/css/all.css">
</head>
<body class="bg-light">

<style>
    /* STYLING REGISTER/LOGIN FORM */
.formStart {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 90vh;
}

.formStart form {
    width: 400px;
    padding: 10px;
    background-color: #fff;
    box-shadow: 0 1px 5px rgba(104, 104, 104, 0.8);
}

.formStart form .image {
    display: flex;
    align-items: center;
    justify-content: center;
}

.formStart form .image img {
    width: 140px;
}

.formStart form .form-group {
    width: 90%;
    border-bottom: 1px solid;
    margin: 15px auto;
}

.formStart form .form-group input, .formStart form .form-group select{
    background: transparent;
    border: none;
    width: 90%;
    outline: none;
}

.eye {
    position: absolute;
    cursor: pointer;
}

.fa {
    margin-right: 5px;
}

#hide1, #hide3 {
    display: none;
}

.registerBtn {
    margin-left: 20px;
    width: 90%;
    background-color: rgb(238, 146, 164);
    border: none;
    color: #fff;
    transition: 0.5s;
}

.register .registerBtn:hover {
    background-color: rgb(211, 55, 87);
}

.register p a{
    font-size: 18px;
    text-decoration: none;
    font-weight: 600;
    color: rgb(62, 180, 125);
    transition: 0.5s;
}

.register p a:hover{
    border-bottom: 4px solid;
    letter-spacing: 1px;
}

</style>

<!-- Navigation Start -->
<nav class="navbar navbar-expand-md navbar-dark bg-dark px-5">
    <a href="" class="navbar-brand">Rose Tech Multimedia</a>
    <!-- Collapse Navigation -->
    <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Navigation List -->
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav">
            <li class="nav-item"><a href="" class="nav-link"><i class="fa fa-globe"></i>&nbsp;Dashboard</a></li>
            <li class="nav-item"><a href="" class="nav-link"><i class="fa fa-th-large"></i>&nbsp;Pos System</a></li>
        </ul>
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

<?php if(isset($_SESSION['invalid'])):?>
    <h5 class="alert alert-danger"><?= $_SESSION['message']?>
    <button type="button" class="close float-end" data-bs-dismiss="alert">&times;</button>
    </h5>
<?php endif; 
unset($_SESSION['message']);
?>

<!-- LOGIN FORM START -->
<div class="container formStart">
    <form action="./createAccount/action.php" method="post">
        <h4 class="text-center">Login Account</h4>
        <div class="image">
            <img src="./image/newRoseLogo PNG.png" alt="">
        </div>
        <div class="form-group">
            <i class="fa fa-envelope"></i>
            <input type="email" name="email" placeholder="Enter Email">
        </div>
        <div class="form-group">
            <i class="fa fa-key"></i>
            <input type="password" name="password" placeholder="Enter Password" required id="myInput" minlength="6">
            <span class="eye" onclick="myFunction1()">
                <i class="fa fa-eye" id="hide1"></i>
                <i class="fa fa-eye-slash" id="hide2"></i>
            </span>
        </div>
        <div class="register">
            <input type="submit" name="loginBtn" class="registerBtn" value="Login">
            <p class="text-center mt-2">Dont have an account? <a href="createAccount/registerAccount.php" class="ms-2">Register</a></p>
        </div>
</form>
</div>
<!-- LOGIN FORM END -->

<script>
    // PASSWORD
var x = document.getElementById('myInput');
var y = document.getElementById('hide1');
var z = document.getElementById('hide2');

function myFunction1() {
    if(x.type == 'password'){
        x.type = 'text';
        y.style.display = 'block';
        z.style.display = 'none';
    } else {
        x.type = 'password';
        y.style.display = 'none';
        z.style.display = 'block';
    }
}

// CONFIRM PASSWORD
var a = document.getElementById('myInput1');
var b = document.getElementById('hide3');
var c = document.getElementById('hide4');

function myFunction2() {
    if(a.type == 'password'){
        a.type = 'text';
        b.style.display = 'block';
        c.style.display = 'none';
    } else {
        a.type = 'password';
        b.style.display = 'none';
        c.style.display = 'block';
    }
}
</script>
</body>
</html>