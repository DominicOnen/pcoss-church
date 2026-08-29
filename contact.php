<?php
$db_host = 'localhost';
$db_name = 'pcss_church_db';
$db_user = 'root'; // Change this to your database username on your live server
$db_pass = '';     // Change this to your database password on your live server

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = htmlspecialchars(strip_tags(trim($_POST['name'])));
    $email   = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $reason  = htmlspecialchars(strip_tags(trim($_POST['reason'])));
    $message = htmlspecialchars(strip_tags(trim($_POST['message'])));

    if (!empty($name) && !empty($email) && !empty($message)) {
        $sql = "INSERT INTO contact_submissions (name, email, reason, message) VALUES (:name, :email, :reason, :message)";
        $stmt = $pdo->prepare($sql);

        try {
            $stmt->execute([
                ':name'    => $name,
                ':email'   => $email,
                ':reason'  => $reason,
                ':message' => $message
            ]);
            echo "<script>alert('Thank you! Your message has been saved.'); window.location.href='contact.html';</script>";
        } catch (PDOException $e) {
            echo "Error storing submission: " . $e->getMessage();
        }
    } else {
        echo "Please completely fill out all required fields.";
    }
}
?>