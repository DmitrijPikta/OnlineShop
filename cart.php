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

    <?php if($_SESSION['email'] != ''):?>
        <div class="cart-page">
            <div class="cart-page-block items-in-cart">
                <div class="title-items-in-cart">
                    <h2>Items in cart</h2>
                </div>
                
                <?php 
                // DB
                require_once "lib/db.php";

                // SQL
                $sql = "SELECT * FROM itemInCart WHERE UserEmail= ?";
                $query = $pdo->prepare($sql);
                $query->execute([$_SESSION['email']]);

                $total_price = 0;
                if($query->rowCount() != 0):
                    $cart = $query->fetchAll(PDO::FETCH_OBJ);
                    foreach($cart as $item_in_cart):
                        $sql = "SELECT * FROM item WHERE ViewIndex= ?";
                        $query = $pdo->prepare($sql);
                        $query->execute([$item_in_cart->ItemViewIndex]);

                        $info = $query->fetch(PDO::FETCH_OBJ);

                        // Counting total price 
                        $total_price = $total_price + $item_in_cart->Quantity * $info->Price;
                        ?>
                        <div class="item-in-cart">
                            <div class="item-in-cart-div image">
                                <img src="img/<?= $info->Image ?>" alt="">
                            </div>

                            <div class="item-in-cart-div info">
                                <h3><?= $info->Name ?></h3>
                                <?php if(!empty($info->Sizes)): ?>
                                    <div class="size">
                                        <div>
                                            <h4>Size:</h4>
                                        </div>
                                        <div>
                                            <select name="Size" id="">
                                                <option value="s">S</option>
                                                <option value="m">M</option>
                                                <option value="xl">XL</option>
                                                <option value="l">L</option>
                                            </select>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="quantity">
                                    <div>
                                        <h4>Quantity:</h4>
                                    </div>
                                    <div>
                                        <input type="number" min="1" value="<?= $item_in_cart->Quantity ?>">
                                    </div>
                                </div>
                                <h4><?= $info->Price ?> $</h4>
                                <form method="post">
                                    <input type="hidden" name="id" value="<?= $item_in_cart->Id ?>">
                                    <button type="submit" name="delete">Delete</button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="cart-page-block order">
                <div class="price">
                    <h2>Price:</h2>
                </div>
                <div class="price">
                    <h2><?= $total_price ?> $</h2>
                </div>
                <button>Buy</button>
            </div>
        </div>
    <?php endif; ?>

    <?php 
    if(isset($_POST['delete'])){
        $sql = "DELETE FROM itemInCart WHERE Id= ?";
        $query = $pdo->prepare($sql);
        $query->execute([$_POST['id']]);

        echo "<meta http-equiv='refresh' content='0'>";
    }
    ?>

    <footer>

    </footer>

</body>

</html>