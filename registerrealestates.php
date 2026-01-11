<?php
include_once('config.php');

if (isset($_POST['submit'])) {

    $company = $_POST['company'];
    $broker = $_POST['broker'];
    $address = $_POST['address'];
    $price = $_POST['price'];
    $finnid = $_POST['finnid'];

    if (empty($company) || empty($broker) || empty($address) || empty($price) || empty($finnid)) {
        echo "Please fill in all fields.";
        header("refresh:1; url=createrealestates.php"); 
        exit;
    }

    $checkSql = "SELECT COUNT(*) FROM `real estates` WHERE finnid = :finnid";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bindParam(':finnid', $finnid);
    $checkStmt->execute();
    
    $count = $checkStmt->fetchColumn();

    if ($count > 0) {
        echo "Finn ID already exists.";
        header("refresh:1; url=createrealestates.php"); 
        exit;
    }

    $sql = "INSERT INTO `real estates` (company, broker, address, price, finnid) VALUES (:company, :broker, :address, :price, :finnid)";
    $insertSQL = $conn->prepare($sql);

    $insertSQL->bindParam(':company', $company);
    $insertSQL->bindParam(':broker', $broker);
    $insertSQL->bindParam(':address', $address);
    $insertSQL->bindParam(':price', $price);
    $insertSQL->bindParam(':finnid', $finnid);

    if ($insertSQL->execute()) {
        echo "Data saved successfully ...";
        header("refresh:1; url=realestates.php"); 
        exit;
    } else {
        echo "Error saving data.";
    }
}
?>