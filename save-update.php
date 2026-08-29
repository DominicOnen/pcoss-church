<?php
// save-update.php
header('Content-Type: text/html; charset=utf-8');

// Connects directly to your established database configuration
require_once 'Home-db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $type         = isset($_POST['type']) ? trim($_POST['type']) : '';
    $title        = isset($_POST['title']) ? trim($_POST['title']) : '';
    $description  = isset($_POST['description']) ? trim($_POST['description']) : '';
    $date_display = isset($_POST['date_display']) ? trim($_POST['date_display']) : '';
    $event_date   = !empty($_POST['event_date']) ? $_POST['event_date'] : null;

    if (!empty($type) && !empty($title) && !empty($description) && !empty($date_display)) {
        try {
            // Using $pdo to match Home-db.php architecture
            $sql = "INSERT INTO events (type, title, description, date_display, event_date) 
                    VALUES (:type, :title, :description, :date_display, :event_date)";
            
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':type'         => $type,
                ':title'        => $title,
                ':description'  => $description,
                ':date_display' => $date_display,
                ':event_date'   => $event_date
            ]);

            echo "<script>alert('Church update successfully published!'); window.location.href='admin-sermons.html';</script>";
            exit;

        } catch (\PDOException $e) {
            die("Database Error: Could not save update. " . $e->getMessage());
        }
    } else {
        die("Error: Please fill out all required fields.");
    }
} else {
    header("Location: admin-sermons.html");
    exit;
}
?>