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

    <?php
    $jobs = [
        [
            "title" => "Software Developer",
            "location" => "Makati City, Metro Manila",
            "salary" => "₱50,000 - ₱70,000",
            "description" => "Responsible for developing and maintaining software applications. Knowledge in PHP, JavaScript, and SQL is required. Great opportunity to work in a dynamic tech environment."
        ],
        [
            "title" => "Marketing Specialist",
            "location" => "Quezon City, Metro Manila",
            "salary" => "₱30,000 - ₱45,000",
            "description" => "Develops and implements marketing campaigns. Collaborates with cross-functional teams to drive brand awareness and engagement. Experience in digital marketing is a plus."
        ],
        [
            "title" => "Graphic Designer",
            "location" => "Cebu City, Cebu",
            "salary" => "₱20,000 - ₱35,000",
            "description" => "Creates visual concepts to communicate ideas that inspire, inform, or captivate consumers. Proficiency in Adobe Photoshop, Illustrator, and similar design tools is necessary."
        ],
        [
            "title" => "Human Resources Officer",
            "location" => "Davao City, Davao del Sur",
            "salary" => "₱25,000 - ₱40,000",
            "description" => "Manages recruitment, employee relations, and compliance with labor laws. Prior experience in HR roles is required, along with excellent communication skills."
        ],
        [
            "title" => "Customer Service Representative",
            "location" => "Manila, Metro Manila",
            "salary" => "₱18,000 - ₱25,000",
            "description" => "Provides excellent customer service via phone, email, and chat. Strong communication skills and ability to handle customer inquiries professionally are required."
        ]
    ];

    foreach ($jobs as $index => $job) {
        echo "<div class='job-listing'>";
        echo "<h2 class='job-title'>{$job['title']}</h2>";
        echo "<p class='job-location'>Location: {$job['location']}</p>";
        echo "<p class='job-salary'>Salary: {$job['salary']}</p>";
        echo "<p class='job-description'>{$job['description']}</p>";
        echo "<a href='apply.php?id={$index}' class='apply-button'>Apply Now</a>";
        echo "</div>";
    }
    ?>
</div>

</body>
</html>
