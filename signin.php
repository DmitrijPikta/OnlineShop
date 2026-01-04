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

    <div class="signin">
        <h3>Sign in</h3>
        <form action="lib/auth.php" method="post">
            <div class="email">
                <label>Email:</label>
                <input type="text" name="email" required>
            </div>
            <div class="password">
                <label>Password:</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit">sign in</button>
        </form>

        <?php 
        if(isset($_GET['error'])){
            $errors = $_GET['error'];
            echo $errors;
        }
        ?>
    </div>

    <footer>

    </footer>

</body>

</html>