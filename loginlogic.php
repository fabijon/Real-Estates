<?php
session_start();
include_once('config.php');

if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        echo "Please fill in all fields.";
        header("refresh:2; url=login.php");
        exit; 
    }

    $sql = "SELECT username, password FROM users WHERE username=:username";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $username);

    if ($stmt->execute()) {
        if ($stmt->rowCount() > 0) {
            $data = $stmt->fetch(PDO::FETCH_ASSOC); 
            if ($password === $data['password']) {
                $_SESSION['username'] = $data['username'];
                header("Location: realestates.php");
                exit; 
            } else {
                echo "Incorrect password.";
                header("refresh:2; url=login.php");
                exit; 
            } 
        } else {
            echo "User not found.";
            header("refresh:2; url=login.php");
            exit;
        }
    } 
}
?>