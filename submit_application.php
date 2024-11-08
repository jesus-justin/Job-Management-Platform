<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $jobTitle = htmlspecialchars($_POST['jobTitle']);
    $reason = htmlspecialchars($_POST['reason']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Application Successful</title>
</head>
<body>
    <h1>Application Successful!</h1>
    <p>Thank you, <?php echo $name; ?>, for applying for the <strong><?php echo $jobTitle; ?></strong> position.</p>
    <p>We will contact you at <?php echo $email; ?> regarding your application status.</p>
    <p><a href="job_listings.php">Back to Job Listings</a></p>
</body>
</html>
