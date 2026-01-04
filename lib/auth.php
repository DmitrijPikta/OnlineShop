<?php
session_start();
$email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
$password = trim($_POST['password']);

// DB
require "db.php";

$sql = 'SELECT * FROM account WHERE Email= ?';
$query = $pdo->prepare($sql);
$query->execute([$email]);

// Account with entered email exist
if($query->rowCount() == 1){
    $user = $query->fetch(PDO::FETCH_OBJ);

    // Hash password
    $salt = 'gfrdgfdggggggggggre543';
    $GLOBALS['password'] = md5($salt . $GLOBALS['password']);

    // Password is correct
    if($user->Password == $GLOBALS['password']){
        $_SESSION['name'] = $user->Name;
        $_SESSION['last_name'] = $user->Last_name;
        $_SESSION['email'] = $user->Email;

        header('Location: /');
    }
    // Password is incorrect
    else{
        header('Location: https://online-shop/signin.php?error=Password incorrect');
    }  
}
// Account with entered email do not exist
else{
    header('Location: https://online-shop/signin.php?error=Account with this email do not exist');
}
?>