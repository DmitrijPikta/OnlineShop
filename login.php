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

    <div class="login">
        <h3>Create account</h3>
        <form action="lib/reg.php" method="post">
            <div class="email">
                <label>Email:</label>
                <input type="text" name="email" required>
            </div>
            <div class="password">
                <label>Password:</label>
                <input type="password" name="password" required>
            </div>
            <div class="name">
                <label>Name:</label>
                <input type="text" name="name" required>
            </div>
            <div class="last_name">
                <label>Last name:</label>
                <input type="text" name="last_name" required>
            </div>
            <button type="submit">log in</button>
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