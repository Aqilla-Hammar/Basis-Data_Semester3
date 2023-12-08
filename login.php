<?php

include("config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = mysqli_real_escape_string($koneksi, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($koneksi, $_POST['lastname']);

    $query = "SELECT * FROM user WHERE firstname='$firstname' AND lastname='$lastname'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            header('Location: index.php'); 
            exit(); 
        } else {
            echo "Username atau password salah.";
        }
    } else {
        echo "Kesalahan query: " . mysqli_error($koneksi);
    }
}

mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Login Form</title>
</head>
<body>
    <h2>LOGIN ADMIN</h2>
    <form action="login.php" method="post">
        <div class="login">
            <div class="username">
                <label for="username">Nama : </label>
                <input class="input" type="text" id="firstname" name="firstname" placeholder="     Nama (Required)" required>
            </div>
            <div class="pass">
                <label for="password">NIM : </label>
                <input class="inp" type="password" id="lastname" name="lastname" placeholder="      NIM (Required)" required>
            </div>
            <button type="submit">Login</button>
        </div>
    </form>
</body>
</html>
