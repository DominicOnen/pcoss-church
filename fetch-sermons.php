<?php
header('Content-Type: application/json');

$db_host = 'localhost';
$db_name = 'pcss_church_db';
$db_user = 'root'; // Update with your live server database username
$db_pass = '';     // Update with your live server database password

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Fetch sermons from newest to oldest
    $stmt = $pdo->query("SELECT title, preacher, scripture, youtube_url, sermon_date FROM sermons ORDER BY sermon_date DESC");
    $sermons = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Format the date nicely for JavaScript to read
    foreach ($sermons as &$sermon) {
        $sermon['formatted_date'] = date("F j, Y", strtotime($sermon['sermon_date']));
    }

    echo json_encode($sermons);
} catch (PDOException $e) {
    echo json_encode(["error" => "Database connection failed"]);
}
?>