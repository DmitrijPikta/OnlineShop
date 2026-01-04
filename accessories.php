<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Shop</title>
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <?php 
    require_once "block/header.php"; 
    $current_page = basename($_SERVER['PHP_SELF']);
    ?>

    <div class="items">
        <?php 
            // DB
            require_once "lib/db.php"; 

            // SQL
            $sql = "SELECT * FROM item WHERE Category = 'Accessories' ORDER BY ViewIndex";
            $query = $pdo->prepare($sql);
            $query->execute();
            $items = $query->fetchAll(PDO::FETCH_OBJ);
            foreach($items as $item)
                echo '
            <a href="item.php?id='.$item->ViewIndex.'" class="item">
                <div class="block">
                    <img src="img/'.$item->Image.'" alt="">
                    <div class="price">
                        <h3>'.$item->Price.' $</h3>
                    </div>
                </div>
                <div class="text">
                    <h3>'.$item->Name.'</h3>
                </div>
            </a>
            ';
        ?>
    </div>
    <footer>

    </footer>

</body>

</html>