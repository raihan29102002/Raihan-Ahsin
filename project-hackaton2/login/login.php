<?php
session_start();
if (isset($_POST['username']) && isset($_POST['password'])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sociallogin";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM accounts WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
    } else {
        echo "Invalid username or password";
    }

    $conn->close();
} else {
    header("Location: index.php");
}
?>