<?php
session_start();
$host = 'localhost'; // server MySQL
$db = 'login_system'; // nama database
$user = 'root'; // nama pengguna MySQL
$pass = ''; // password MySQL

// Membuat koneksi ke database
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Hash password menggunakan MD5

    // Query untuk memeriksa username dan password
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Jika login berhasil, redirect ke halaman utama
        $_SESSION['username'] = $username;
        header("Location: barcodde.html");
        exit();
    } else {
        echo "Username atau password salah.";
    }
}

$conn->close();
