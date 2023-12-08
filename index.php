<?php
include("config.php");

$query = "SELECT * FROM User";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/popins.css">
    <title>PENGGUNA</title>
</head>
<body>
    <div class="user">
        <h1>PENGGUNA</h1>
        <table border="1">
            <tr>
                <th>ID Pengguna</th>
                <th>Nama Depan</th>
                <th>Nama Belakang</th>
                <th>Email</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['userID'] . "</td>";
                echo "<td>" . $row['firstname'] . "</td>";
                echo "<td>" . $row['lastname'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
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

    <?php
    mysqli_close($koneksi);
    ?>

</body>
</html>
