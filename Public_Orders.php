<?php

include("config.php");

$result = mysqli_query($db, "SELECT * FROM products");
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Full_Name = mysqli_real_escape_string($db, htmlspecialchars($_POST['Full_Name']));
    $Product_Name = mysqli_real_escape_string($db, htmlspecialchars($_POST['Product_Name']));
    $Product_Price = mysqli_real_escape_string($db, $_POST['Product_Price']);
    $Quantity = mysqli_real_escape_string($db, $_POST['Quantity']);

    $stmt = mysqli_prepare($db, "INSERT INTO Public_Orders (Full_Name, Product_Name, Product_Price, Quantity) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, 'ssdi', $Full_Name, $Product_Name, $Product_Price, $Quantity);

    if (mysqli_stmt_execute($stmt)) {
        header('Location: index.php');
        exit();
    } else {
        echo "Error adding product: " . mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($db);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/pop-public.css">
    <title>Product Input</title>
</head>
<body>
    <div class="krk-krl">
        <div class="krk">
            <h1>Produk Kami</h1>
            <div class="prod-list">
                <?php foreach ($products as $product): ?>
                <h5><?= $product['name'] ?> ( Rp.<?= number_format($product['price'], 0, ',', '.') ?> )</h5>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="krl">
            <h2>Mohon Isi Produk!</h2>
                <form class="formm" action="Public_Orders.php" method="post">
                    <label for="productName">Nama :</label>
                    <input type="text" id="productName" name="Full_Name" required>

                    <label for="productPrice">Nama Produk :</label>
                    <input type="text" id="productPrice" name="Product_Name" step="100" required>

                    <label for="productPrice">Harga Produk :</label>
                    <input type="number" id="productPrice" name="Product_Price" required>

                    <label for="productQuantity">Qty / Jumlah :</label>
                    <input type="number" id="productQuantity" name="Quantity" step="1" required>
                    <div class="button5">
                        <button class="buttonp" type="submit">Buy!</button>
                    </div>
                </form> 
        </div>
    </div>
    <div class="but">
        <div class="b0">
            <button>
                <a href="index.php">PENGGUNA</a>
            </button>
        </div>
        <div class="b2">
            <button>
                <a href="detailpesanan.php">DETAIL PESANAN</a>
            </button>
        </div>
        <div class="b4">
            <button>
                <a href="pricelist.php">PRICE LIST</a>
            </button>
        </div>
        <div class="b5">
            <button>
                <a href="Public_Orders.php">PUBLIC ORDERS</a>
            </button>
        </div>
        <div class="logout">
            <button>
                <a href="login.php">Logout</a>
            </button>
        </div>
    </div>
</body>
</html>
