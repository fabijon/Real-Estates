<?php 
include_once("config.php");

if (isset($_GET['finnid'])) {
    $finnid = $_GET['finnid'];

    $sql = "DELETE FROM `real estates` WHERE finnid = :finnid";

    $getUsers = $conn->prepare($sql);

    $getUsers->bindParam(':finnid', $finnid);

    if ($getUsers->execute()) {
        header('Location: realestates.php'); 
        exit; 
    } else {
        echo "Error deleting record.";
    }
} else {
    echo "Finn ID not provided.";
}
?>