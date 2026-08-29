<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

// Connect to the database
$conn = new mysqli("localhost", "root", "", "pcss_church_db");

if ($conn->connect_error) {
    echo json_encode(["error" => "Database connection failed"]);
    exit();
}

// Fetch all verses ordered by newest first
$result = $conn->query("SELECT verse_text, reference FROM daily_verses ORDER BY created_at DESC");

$verses = [];
if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $verses[] = [
            "verse" => $row['verse_text'],
            "reference" => $row['reference']
        ];
    }
}

echo json_encode($verses);
$conn->close();
?>