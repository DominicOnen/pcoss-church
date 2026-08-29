<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Capture and sanitize incoming form payloads
    $verse_text = trim($_POST['verse_text']);
    $reference = trim($_POST['reference']);

    if (empty($verse_text) || empty($reference)) {
        die("Error: Both fields are required.");
    }

    // 2. Establish connection to your central MySQL instance
    $conn = new mysqli("localhost", "root", "", "pcss_church_db");

    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    // 3. Bind properties into a prepared statement for security
    $stmt = $conn->prepare("INSERT INTO daily_verses (verse_text, reference) VALUES (?, ?)");
    $stmt->bind_param("ss", $verse_text, $reference);

    if ($stmt->execute()) {
        // Automatically send users back to the control panel upon success
        header("Location: " . $_SERVER['HTTP_REFERER'] . "?status=success");
        exit();
    } else {
        echo "Error saving data: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: index.html");
    exit();
}
?>