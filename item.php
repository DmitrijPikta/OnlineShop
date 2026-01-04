<?php session_start();?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <?php require_once "block/header.php";
    $id = $_GET['id'];?>
    
    <div class="product">
        <?php 
            // DB
            require_once "lib/db.php"; 

            // SQL
            $sql = 'SELECT * FROM item WHERE ViewIndex=?';
            $query = $pdo->prepare($sql);
            $query->execute([$id]);
            $info = $query->fetch(PDO::FETCH_OBJ);

            // Work with sizes
            $Sizes = [];
            if($info->Sizes != '')
                $Sizes = explode(', ', $info->Sizes);
        ?>
            
            
        <div class="prod prod-image">
            <img src="img/<?= $info->Image ?>" alt="">
        </div>
        <div class="prod info">
            <h2><?= $info->Name ?></h2>
            <p><?= $info->Description ?></p>

            <form method="post">
                <?php if(!empty($Sizes)): ?>

                    <div class="sizes-block">
                        <h4>Select size:</h4>
                        <div class="sizes">
                            <select name="size" id="">
                                <?php foreach($Sizes as $size): ?>
                                    <option value="<?= $size ?>"><?= $size ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="quantity-block">
                    <h4>Quantity:</h4>
                    <div class="quantity">
                        <input name="quantity" type="number" min="1" value="1" required>
                    </div>
                </div>
                <button type="submit" name="Add_to_cart">Add to cart</button>
            </form>
        </div>
    </div>
    
    <?php 
    if(isset($_POST['Add_to_cart'])){
        // If user is sign in
        if($_SESSION['email'] != ''){
            // DB 
            require_once "lib/db.php";
            // If item have size
            if(isset($_POST['size'])){
                //SQL
                $sql = 'INSERT INTO itemInCart (ItemViewIndex, UserEmail, Quantity, Size) VALUES (?, ?, ?, ?)';
                $query = $pdo->prepare($sql);
                $query->execute([$id, $_SESSION['email'], $_POST['quantity'], $_POST['size']]);
            }
            // If item do not have size
            else{
                //SQL
                $sql = 'INSERT INTO itemInCart (ItemViewIndex, UserEmail, Quantity) VALUES (?, ?, ?)';
                $query = $pdo->prepare($sql);
                $query->execute([$id, $_SESSION['email'], $_POST['quantity']]);
            }
        }
        // If user is not sign in
        else{
            echo '<h3>Please sign in</h3>';
        }
    }
    ?>

    <footer>

    </footer>

</body>

</html>