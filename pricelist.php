<?php

include("config.php");

$result = mysqli_query($db, "SELECT * FROM products");
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete_id'])) {
        $deleteId = mysqli_real_escape_string($db, $_POST['delete_id']);
        $deleteStmt = mysqli_prepare($db, "DELETE FROM products WHERE id = ?");
        mysqli_stmt_bind_param($deleteStmt, 'i', $deleteId);

        if (mysqli_stmt_execute($deleteStmt)) {
            header('Location: pricelist.php');
            exit();
        } else {
            echo "Error deleting product: " . mysqli_stmt_error($deleteStmt);
        }
        mysqli_stmt_close($deleteStmt);
    }
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $price = mysqli_real_escape_string($db, $_POST['price']);

    $stmt = mysqli_prepare($db, "INSERT INTO products (name, price) VALUES (?, ?)");
    mysqli_stmt_bind_param($stmt, 'sd', $name, $price);

    if (mysqli_stmt_execute($stmt)) {
        header('Location: pricelist.php');
        exit();
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
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
    <link rel="stylesheet" href="css/pop-pricelist2.css">
    <title>Product Input</title>
</head>

<body>
    <div class="foreach-form">
        <div class="foreach">
            <h1>Added Product List</h1>
            <ul>
                <?php foreach ($products as $product): ?>
                    <li>
                        <?= $product['name'] ?> - Rp.
                        <?= number_format($product['price'], 2) ?>
                        <form class="delete-form" action="pricelist.php" method="post">
                            <input type="hidden" name="delete_id" value="<?= $product['id'] ?>">
                            <button type="submit" class="delete-button">Delete</button>
                        </form>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="form">
            <h2>Add Product</h2>
            <form class="formm" action="pricelist.php" method="post">
                <label for="productName">Product Name:</label>
                <input type="text" id="productName" name="name" required>

                <label for="productPrice">Product Price:</label>
                <input type="number" id="productPrice" name="price" step="100" required>

                <button type="submit">Add Product</button>
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
