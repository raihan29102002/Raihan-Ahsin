<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sociallogin";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $check_username_sql = "SELECT * FROM accounts WHERE username='$username'";
    $result = $conn->query($check_username_sql);

    if ($result->num_rows > 0) {
        echo "Username already exists. Please choose a different username.";
    } else {
        $registered = date("Y-m-d H:i:s");
        $insert_sql = "INSERT INTO accounts (name, email, username, password, registered, method) VALUES ('$name', '$email', '$username', '$password', '$registered', 'username')";
        
        if ($conn->query($insert_sql) === TRUE) {
            $_SESSION['username'] = $username;
            header("Location: index.php");
        } else {
            echo "Error: " . $insert_sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
} else {
    header("Location: index.php");
}
?>