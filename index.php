<?php

$jobs = [
    [
        'id' => 1,
        'title' => 'Web Developer',
        'description' => 'Develop and maintain websites.',
        'company' => 'Tech Corp',
        'location' => 'New York',
        'salary' => '50000',
        'contact' => '123-456-7890'
    ],
    [
        'id' => 2,
        'title' => 'Graphic Designer',
        'description' => 'Create graphics for clients.',
        'company' => 'Creative Inc',
        'location' => 'San Francisco',
        'salary' => '45000',
        'contact' => '987-654-3210'
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Job Listings</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .job { border: 1px solid #ddd; padding: 15px; margin-bottom: 15px; }
    </style>
</head>
<body>
    <h1>Job Listings</h1>
    <?php foreach ($jobs as $job): ?>
        <div class="job">
            <h2><?php echo $job['title']; ?></h2>
            <p><strong>Company:</strong> <?php echo $job['company']; ?></p>
            <p><strong>Location:</strong> <?php echo $job['location']; ?></p>
            <p><strong>Salary:</strong> $<?php echo $job['salary']; ?></p>
            <p><?php echo $job['description']; ?></p>
            <a href="apply.php?id=<?php echo $job['id']; ?>">Apply</a>
        </div>
    <?php endforeach; ?>
</body>
</html>
