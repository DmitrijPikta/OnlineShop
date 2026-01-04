<?php 
session_start();
$name = trim(filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS));
$last_name = trim(filter_var($_POST['last_name'], FILTER_SANITIZE_SPECIAL_CHARS));
$email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
$password = trim($_POST['password']);

$emailErr = $passwordErr = '';
$errors = array();
// validation of email
if(!str_contains($email, '@')){
    $emailErr = "Wrong email";
    $errors[] = $emailErr;
}
elseif(strlen($email) < 5){
    $emailErr = "Wrong email";
    $errors[] = $emailErr;
}
// validation of password
if(strlen($password) < 5){
    $passwordErr = "Password should have at least 5 symbols";
    $errors[] = $passwordErr;
}

if(!empty($errors)){
    header('Location: https://online-shop/login.php?error='.implode("<br>", $errors).'');
}
else{
    // DB
    require "db.php";

    // Check if email is unical
    $sql = 'SELECT Name FROM account WHERE Email= ?';
    $query = $pdo->prepare($sql);
    $query->execute([$email]);
 
    if($query->rowCount() == 0){
        // Hash password
        $salt = 'gfrdgfdggggggggggre543';
        $GLOBALS['password'] = md5($salt . $GLOBALS['password']);

        // Create new account
        $sql = 'INSERT INTO account (Name, Last_name, Email, Password) VALUES (?, ?, ?, ?)';
        $query = $pdo->prepare($sql);
        $query->execute([$name, $last_name, $email, $password]);

        $_SESSION['email'] = $email;
        $_SESSION['name'] = $name;
        $_SESSION['last_name'] = $last_name;

        header('Location: /');
    }
    else{
        header('Location: https://online-shop/login.php?error=Account with this email already exist');
    }
    
}


?>