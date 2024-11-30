<?php
session_start();
require_once 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$jobId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

try {
    $stmt = $pdo->prepare("SELECT * FROM jobs WHERE id = ?");
    $stmt->execute([$jobId]);
    $job = $stmt->fetch();
} catch (PDOException $e) {
    die("Error fetching job: " . $e->getMessage());
}

if (!$job) {
    die("Job not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply for <?php echo htmlspecialchars($job['title']); ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #007acc;
        }
        form {
            margin-top: 20px;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input, textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color: #007acc;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover {
            background-color: #005fa3;
        }
        .back-link {
            display: inline-block;
            margin-top: 20px;
            color: #007acc;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Apply for <?php echo htmlspecialchars($job['title']); ?></h1>
        <p><strong>Location:</strong> <?php echo htmlspecialchars($job['location']); ?></p>
        <p><strong>Salary:</strong> <?php echo htmlspecialchars($job['salary']); ?></p>
        <p><strong>Description:</strong> <?php echo htmlspecialchars($job['description']); ?></p>

        <form method="POST" action="submit_application.php">
            <input type="hidden" name="job_id" value="<?php echo $job['id']; ?>">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required value="<?php echo htmlspecialchars($_SESSION['user_name']); ?>" readonly>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="reason">Why Choose This Job:</label>
            <textarea id="reason" name="reason" rows="4" required></textarea>

            <button type="submit">Submit Application</button>
        </form>

        <a href="job_listings.php" class="back-link">Back to Job Listings</a>
    </div>
</body>
</html>

