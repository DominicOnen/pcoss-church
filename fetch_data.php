<?php
// fetch_data.php
header('Content-Type: application/json');
require_once 'Home-db.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action == 'home_updates') {
    // Fetch only the 3 latest announcements for the index page
    $stmt = $pdo->query("SELECT title, date_display, description FROM events WHERE type='announcement' ORDER BY created_at DESC LIMIT 3");
    echo json_encode($stmt->fetchAll());
} 

elseif ($action == 'all_events') {
    // Fetch all events for the events page
    $events_stmt = $pdo->query("SELECT title, date_display, description FROM events WHERE type='event' ORDER BY event_date ASC");
    
    // Fetch all announcements for the events page
    $news_stmt = $pdo->query("SELECT title, date_display, description FROM events WHERE type='announcement' ORDER BY created_at DESC");

    echo json_encode([
        "events" => $events_stmt->fetchAll(),
        "announcements" => $news_stmt->fetchAll()
    ]);
}
?>