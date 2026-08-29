<?php
$db_host = 'localhost';
$db_name = 'pcss_church_db';
$db_user = 'root'; // Update with your live server database username
$db_pass = '';     // Update with your live server database password

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title       = trim($_POST['title']);
    $preacher    = trim($_POST['preacher']);
    $scripture   = trim($_POST['scripture']);
    $youtube_url = trim($_POST['youtube_url']);
    $sermon_date = $_POST['sermon_date'];

    if (!empty($title) && !empty($preacher) && !empty($youtube_url) && !empty($sermon_date)) {
        $sql = "INSERT INTO sermons (title, preacher, scripture, youtube_url, sermon_date) VALUES (:title, :preacher, :scripture, :youtube_url, :sermon_date)";
        $stmt = $pdo->prepare($sql);
        
        try {
            $stmt->execute([
                ':title'       => $title,
                ':preacher'    => $preacher,
                ':scripture'   => $scripture,
                ':youtube_url' => $youtube_url,
                ':sermon_date' => $sermon_date
            ]);
            
            // Success alert and redirect back to the entry panel
            echo "<script>alert('Sermon successfully published to the archive!'); window.location.href='admin-sermons.html';</script>";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Please completely fill out all required fields.";
    }
}
?>