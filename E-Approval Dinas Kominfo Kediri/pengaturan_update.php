<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Koneksi ke database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sociallogin";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Periksa koneksi
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Ambil data dari form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash password sebelum disimpan ke database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Query untuk memeriksa apakah username sudah ada di database
    $check_username_sql = "SELECT * FROM accounts WHERE username='$username'";
    $result = $conn->query($check_username_sql);

    if ($result->num_rows > 0) {
        // Username sudah ada
        echo "Username already exists. Please choose a different username.";
    } else {
        // Username tersedia, simpan data ke database
        $registered = date("Y-m-d H:i:s"); // Waktu pendaftaran

        // Query untuk menyimpan data ke database
        $insert_sql = "INSERT INTO accounts (name, email, username, password, registered, method) VALUES ('$name', '$email', '$username', '$hashed_password', '$registered', 'username')";
        
        if ($conn->query($insert_sql) === TRUE) {
            // Registrasi berhasil, redirect ke halaman login
            $_SESSION['username'] = $username;
            header("Location: index.php");
        } else {
            // Jika gagal menyimpan data ke database
            echo "Error: " . $insert_sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
} else {
    // Jika halaman diakses langsung tanpa melalui form
    header("Location: index.php");
}