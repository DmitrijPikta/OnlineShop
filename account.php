<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <?php require_once "block/header.php"; ?>

    <?php if($_SESSION['email'] == ''): ?>
    <div class="accountEnteringButtons">
        <div><a href="login.php">Log in</a></div>
        <div><a href="signin.php">Sign in</a></div>
    </div>

    <?php else: ?>
    <h2>Hello, <?= $_SESSION['name']?> <?= $_SESSION['last_name']?></h2>
    <h4><?= $_SESSION['email']?></h4>
    <form method="post">
        <button type="submit" name="sign-out">sign out</button>
    </form>
    <?php endif; ?>

    <?php 
        if(isset($_POST['sign-out'])){
            $_SESSION['name'] = $_SESSION['last_name'] = $_SESSION['email'] = '';
            header('Location: https://online-shop/account.php');
        }
    ?>

    <footer>

    </footer>

</body>

</html>