<?php
$host = 'localhost'; // Database host
$db = 'job_portal'; // Database name
$user = 'root'; // Database username
$pass = ''; // Database password (adjust as needed)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database $db :" . $e->getMessage());
}
?>
