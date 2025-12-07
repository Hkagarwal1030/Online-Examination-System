<?php
// db.php - use in all pages
$host = 'localhost';
$db   = 'online_exam';
$user = 'root';
$pass = ''; // set your DB password
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (Exception $e) {
    exit('Database connection failed: ' . $e->getMessage());
}
session_start();
?>
