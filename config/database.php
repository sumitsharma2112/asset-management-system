<?php
$host = 'localhost';
$db = 'asset_management';
$user = 'root'; // Default username for XAMPP
$pass = ''; // Default password for XAMPP (usually empty)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
