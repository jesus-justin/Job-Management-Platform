<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $jobTitle = htmlspecialchars($_POST['jobTitle']);
    $reason = htmlspecialchars($_POST['reason']);
    
    include 'submit_application.html';
} else {
    header('Location: job_listings.php');
    exit();
}
?>
