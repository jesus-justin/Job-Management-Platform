<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Database connection
    $host = 'localhost'; // Replace with your host
    $username = 'root';  // Replace with your database username
    $password = '';      // Replace with your database password
    $dbname = 'ourdatabase'; // Ensure this matches the name of your imported database

    $conn = new mysqli($host, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
