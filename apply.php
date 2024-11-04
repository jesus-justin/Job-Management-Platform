<?php
// Sample job data array (same structure as before)
$jobs = [
    1 => [
        'title' => 'Web Developer',
        'description' => 'Develop and maintain websites.',
        'company' => 'Tech Corp',
        'location' => 'New York',
        'salary' => '50000',
        'contact' => '123-456-7890'
    ],
    2 => [
        'title' => 'Graphic Designer',
        'description' => 'Create graphics for clients.',
        'company' => 'Creative Inc',
        'location' => 'San Francisco',
        'salary' => '45000',
        'contact' => '987-654-3210'
    ]
];

// Get job ID from URL
$jobId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$job = $jobs[$jobId] ?? null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Apply for <?php echo htmlspecialchars($job['title'] ?? 'Job'); ?></title>
    <style>
        body { font-family: Arial, sans-serif; }
        form { max-width: 400px; margin: auto; }
    </style>
</head>
<body>
    <?php if ($job): ?>
        <h1>Apply for <?php echo htmlspecialchars($job['title']); ?></h1>
        <p><strong>Company:</strong> <?php echo htmlspecialchars($job['company']); ?></p>
        <p><strong>Location:</strong> <?php echo htmlspecialchars($job['location']); ?></p>
        <p><strong>Salary:</strong> $<?php echo htmlspecialchars($job['salary']); ?></p>
        <p><strong>Contact:</strong> <?php echo htmlspecialchars($job['contact']); ?></p>
        <p><?php echo htmlspecialchars($job['description']); ?></p>

        <form method="POST" action="submit_application.php">
            <input type="hidden" name="jobTitle" value="<?php echo htmlspecialchars($job['title']); ?>">
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" required><br><br>

            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required><br><br>

            <label for="reason">Why Choose This Job:</label><br>
            <textarea id="reason" name="reason" rows="4" required></textarea><br><br>

            <button type="submit">Done</button>
        </form>
    <?php else: ?>
        <p>Job not found.</p>
    <?php endif; ?>
    
    <a href="index.php">Back to Job Listings</a>
</body>
</html>
