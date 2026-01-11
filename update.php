<?php
include_once('config.php');

if (isset($_GET['finnid'])) {
    $finnid = $_GET['finnid'];

    // Debugging output
    echo "Finn ID: " . htmlspecialchars($finnid) . "<br>";

    // Fetch existing data from the database
    $sql = "SELECT * FROM `real estates` WHERE finnid = :finnid";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':finnid', $finnid);
    
    // Execute the statement
    if ($stmt->execute()) {
        // Fetch the record
        $record = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if record exists
        if ($record) {
            echo "Record found: ";
            print_r($record); // Display the fetched record
        } else {
            echo "No record found for Finn ID: " . htmlspecialchars($finnid);
            exit;
        }
    } else {
        echo "Error executing query.";
        exit;
    }
} else {
    echo "Finn ID not provided.";
    exit;
}
?>