<?php
// Database connection setup
$host = "localhost";
$username = "root";
$password = "";
$dbname = "pcss_church_db"; // Change to your actual database name

// Change the 4th parameter from "church_db" to "pcss_church_db"
$conn = new mysqli("localhost", "root", "", "pcss_church_db");
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    
    // Handle File Upload
    $target_dir = "uploads/";
    
    // Create folder automatically if it doesn't exist
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    
    $file_name = basename($_FILES["media_file"]["name"]);
    $target_file = $target_dir . time() . "_" . $file_name; // unique name string to avoid conflicts
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    // Determine if it's an image or video
    $media_type = "image";
    if (in_array($file_type, ['mp4', 'webm', 'ogg', 'mov'])) {
        $media_type = "video";
    }

    if (move_uploaded_file($_FILES["media_file"]["tmp_name"], $target_file)) {
        // Insert details into database table
        $sql = "INSERT INTO activities (title, description, file_path, media_type) VALUES ('$title', '$description', '$target_file', '$media_type')";
        
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Activity published successfully!'); window.location.href='admin-sermons.html';</script>";
        } else {
            echo "Database Error: " . $conn->error;
        }
    } else {
        echo "Sorry, there was an error uploading your media file.";
    }
}
$conn->close();
?>