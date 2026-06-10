<?php
// db-deployment.php - Use this for production/hosting environments
// Replace the credentials below with your hosting provider's database credentials

// InfinityFree / 000webhost - Your credentials will look like:
// $host = 'sql###.infinityfree.com';
// $dbname = 'xxxxxxxxxx_dbname';
// $user = 'xxxxxxxxxx_user';
// $pass = 'your_password_here';

$host = 'sql123.infinityfree.com';  // Replace with your hosting db server
$dbname = 'pollution_db';             // Replace with your database name
$user = 'pollution_user';             // Replace with your database username
$pass = 'your_password_here';         // Replace with your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Set default fetch mode to associative array
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
