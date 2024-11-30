<?php
session_start();
require_once 'db_connect.php';


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

try {
    
    $query = "SELECT title, location, salary, description, id, job_type FROM jobs LIMIT 5";

   
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $jobs = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Error fetching jobs: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Listings - Philippines</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            color: #333;
            display: flex;
            justify-content: center;
            padding-top: 50px;
        }
        .container {
            width: 80%;
            max-width: 800px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #007acc;
        }
        .job-listing {
            border-bottom: 1px solid #eee;
            padding: 15px 0;
        }
        .job-title {
            font-size: 1.5em;
            color: #007acc;
        }
        .job-location {
            font-size: 0.9em;
            color: #666;
        }
        .job-salary {
            font-weight: bold;
            color: #2a9d8f;
        }
        .job-description {
            margin-top: 10px;
            font-size: 0.95em;
            line-height: 1.6;
        }
        .job-listing:last-child {
            border: none;
        }
        .apply-button {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #007acc;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .apply-button:hover {
            background-color: #005fa3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Job Listings in the Philippines</h1>

        <!-- Job Listings -->
        <?php if (count($jobs) > 0): ?>
            <?php foreach ($jobs as $job): ?>
                <div class="job-listing">
                    <h2 class="job-title"><?php echo htmlspecialchars($job['title']); ?></h2>
                    <p class="job-location">Location: <?php echo htmlspecialchars($job['location']); ?></p>
                    <p class="job-salary">Salary: ₱<?php echo number_format(htmlspecialchars($job['salary']), 2); ?></p>
                    <p class="job-description"><?php echo htmlspecialchars($job['description']); ?></p>
                    <a href="apply.php?id=<?php echo $job['id']; ?>" class="apply-button">Apply Now</a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No job listings available at the moment. Please check back later!</p>
        <?php endif; ?>
    </div>
</body>
</html>
