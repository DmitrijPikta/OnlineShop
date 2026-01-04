<?php 
if(!isset($current_page)){
    $current_page = basename($_SERVER['PHP_SELF']);
}
?>

<header>
    <span><a href="index.php" class="logo">Logo</a></span>
    <hr>
    <div class="upperButtons">
        <nav>
            <ul>
                <li class="<?= $current_page == 'index.php' ? 'active' : '' ?>"><a href="index.php">ALL</a></li>
                <li class="<?= $current_page == 'clothes.php' ? 'active' : '' ?>"><a href="clothes.php">Clothes</a></li>
                <li class="<?= $current_page == 'shoes.php' ? 'active' : '' ?>"><a href="shoes.php">Shoes</a></li>
                <li class="<?= $current_page == 'accessories.php' ? 'active' : '' ?>"><a href="accessories.php">Accessories</a></li>
            </ul>
        </nav>

        <div class="buttons">
            <a href="account.php" class="account"><img src="img/person.png" alt="account"></a>
            <div class="shop-bag">
                <a href="cart.php"><img src="img/shopingBag.png" alt=""></a>
                <a href="cart.php" class="price">12.99 $</a>
            </div>
        </div>

    </div>
</header>