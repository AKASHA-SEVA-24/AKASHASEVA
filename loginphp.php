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

    // Melakukan query untuk mencari pengguna dengan username yang sesuai
    $query = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($query);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row["password"];

        // Memverifikasi password yang dimasukkan dengan password yang di-hash
        if (password_verify($password, $hashedPassword)) {
            header("Location: login.html?login_message=Login berhasil.");
            exit();
        } else {
            header("Location: login.html?login_message=Username atau password salah.");
            exit();
        }
    } else {
        header("Location: login.html?login_message=Username atau password salah.");
        exit();
    }

    $conn->close();
}
?>
