<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Koneksi ke database
    $host = "localhost"; // Ganti sesuai dengan host database Anda
    $dbUsername = "root"; // Ganti sesuai dengan username database Anda
    $dbPassword = ""; // Ganti sesuai dengan password database Anda
    $dbName = "mydb"; // Ganti sesuai dengan nama database Anda

    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Hash password sebelum disimpan ke database
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Melakukan query untuk memasukkan data pengguna baru ke dalam tabel users
    $query = "INSERT INTO users (username, password) VALUES ('$username', '$hashedPassword')";
    
    if ($conn->query($query) === TRUE) {
        echo '<p style="color: green;">Registrasi berhasil. Silakan <a href="login.html">login</a>.</p>';
    } else {
        echo '<p style="color: red;">Registrasi gagal. Silakan coba lagi.</p>';
    }

    $conn->close();
}
?>
