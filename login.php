<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        
        $stored_username = "user";
        $stored_password = "pass";

        if ($username === $stored_username && $password === $stored_password) {
            echo "Login successful! Welcome to Decent Work and Economic Growth Platform!";
        } else {
            echo "Invalid username or password!";
        }
    }
    ?>
