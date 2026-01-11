<?php
$user = "root";
$pass = "";
$server = "localhost";
$dbname = "db";

try {
    $conn = new PDO("mysql:host=$server;dbname=$dbname;charset=utf8", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    error_log("Connection failed: " . $e->getMessage());
}
?>