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
        header("Location: pagelog.html?register_message=Registrasi berhasil. Silakan login.");
        exit();
    } else {
        header("Location: pagelog.html?register_message=Registrasi gagal. Silakan coba lagi.");
        exit();
    }

    $conn->close();
}
?>
