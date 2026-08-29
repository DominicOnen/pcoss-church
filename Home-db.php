<?php
// db.php
$host    = 'localhost';
$db      = 'pcss_church_db';
$user    = 'root'; // Default XAMPP username
$pass    = '';     // No password as requested
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
     echo json_encode(["error" => "Database connection failed"]);
     exit;
}
?>