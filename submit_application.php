<?php
session_start();
require_once 'db_connect.php';


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}


$application = null;
$error = "";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user_id'];
    $jobId = $_POST['job_id'];
    $reason = trim($_POST['reason']); 

    
    if (empty($jobId) || !is_numeric($jobId)) {
        $error = "Invalid Job ID.";
    } elseif (empty($reason)) {
        $error = "Please provide a reason for your application.";
    } else {
        try {
            
            $jobCheck = $pdo->prepare("SELECT COUNT(*) FROM jobs WHERE id = ?");
            $jobCheck->execute([$jobId]);
            if ($jobCheck->fetchColumn() == 0) {
                $error = "The job you are trying to apply for does not exist.";
            }

            
            $duplicateCheck = $pdo->prepare("SELECT COUNT(*) FROM applications WHERE user_id = ? AND job_id = ?");
            $duplicateCheck->execute([$userId, $jobId]);
            if ($duplicateCheck->fetchColumn() > 0) {
                $error = "You have already applied for this job.";
            }

            
            if (empty($error)) {
                $stmt = $pdo->prepare("INSERT INTO applications (user_id, job_id, reason) VALUES (?, ?, ?)");
                $stmt->execute([$userId, $jobId, $reason]);
                $applicationId = $pdo->lastInsertId();

            
                $stmt = $pdo->prepare("
                    SELECT j.title, u.name, u.email 
                    FROM applications a 
                    JOIN jobs j ON a.job_id = j.id 
                    JOIN users u ON a.user_id = u.id 
                    WHERE a.id = ?
                ");
                $stmt->execute([$applicationId]);
                $application = $stmt->fetch();

                if (!$application) {
                    $error = "Error fetching application details.";
                }
            }
        } catch (PDOException $e) {
            error_log($e->getMessage(), 3, "errors.log"); 
            $error = "An error occurred while processing your application. Please try again later.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Submission</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
            width: 100%;
            max-width: 400px;
        }
        h1 {
            color: #007acc;
        }
        p {
            margin: 10px 0;
        }
        .error {
            color: red;
        }
        .button {
            display: inline-block;
            background-color: #007acc;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .button:hover {
            background-color: #005fa3;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if (!empty($error)): ?>
            <!-- Display error message -->
            <h1>Error</h1>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
            <a href="job_listings.php" class="button">Back to Job Listings</a>
        <?php elseif ($application): ?>
            <!-- Display success message -->
            <h1>Application Successful!</h1>
            <p>Thank you, <?php echo htmlspecialchars($application['name']); ?>, for applying for the <strong><?php echo htmlspecialchars($application['title']); ?></strong> position.</p>
            <p>We will contact you at <?php echo htmlspecialchars($application['email']); ?> regarding your application status.</p>
            <a href="job_listings.php" class="button">Back to Job Listings</a>
            <a href="my_applications.php" class="button">View My Applications</a>
            <a href="logout.php" class="button">Logout</a>
        <?php else: ?>
            <!-- Default message when the form is accessed directly -->
            <h1>No Application Submitted</h1>
            <p>Please select a job and submit your application.</p>
            <a href="job_listings.php" class="button">Back to Job Listings</a>
        <?php endif; ?>
    </div>
</body>
</html>
