<?php
include("config.php");

$resultPublic_Orders = mysqli_query($koneksi, "SELECT * FROM Public_Orders");
$Public_Orders = mysqli_fetch_all($resultPublic_Orders, MYSQLI_ASSOC);

if (!$resultPublic_Orders) {
    die("Kesalahan query OrderItem: " . mysqli_error($koneksi));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/pop-detail.css">
    <title>DETAIL PESANAN</title>
</head>
<body>
    <div class="p75">
        <h1>DETAIL PESANAN</h1>
        <table border="1px">
        <tr>
            <th>Orders ID</th>
            <th>Nama</th>
            <th>Nama Produk</th>
            <th>Harga per Item</th>
            <th>Jumlah</th>
            <th>Total Harga</th>
        </tr>
        <?php
        foreach ($Public_Orders as $Public_Order) {
            $totalPrice = $Public_Order['Product_Price'] * $Public_Order['Quantity'];
            echo "<tr>";
            echo "<td>" . $Public_Order['orders_ID'] . "</td>";
            echo "<td>" . $Public_Order['Full_Name'] . "</td>";
            echo "<td>" . $Public_Order['Product_Name'] . "</td>";
            echo "<td>Rp. " . number_format($Public_Order['Product_Price'], 0, ',', '.') . "</td>";
            echo "<td>" . $Public_Order['Quantity'] . "</td>";
            echo "<td>Rp. " . number_format($totalPrice, 0, ',', '.') . "</td>";
            echo "</tr>";
        }
        ?>
        </table>
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
