<?php


$jobs = [];

function addJob($title, $company, $location, $description) {
    global $jobs;
    $job = [
        'title' => $title,
        'company' => $company,
        'location' => $location,
        'description' => $description
    ];
    $jobs[] = $job;
}

function displayJobs() {
    global $jobs;
    if (empty($jobs)) {
        echo "<p>No jobs available at the moment.</p>";
    } else {
        foreach ($jobs as $job) {
            echo "<div style='border: 1px solid #ddd; padding: 10px; margin: 5px;'>";
            echo "<h3>" . htmlspecialchars($job['title']) . "</h3>";
            echo "<p><strong>Company:</strong> " . htmlspecialchars($job['company']) . "</p>";
            echo "<p><strong>Location:</strong> " . htmlspecialchars($job['location']) . "</p>";
            echo "<p><strong>Description:</strong> " . htmlspecialchars($job['description']) . "</p>";
            echo "</div>";
        }
    }
}

addJob("Software Engineer", "Tech Corp", "New York", "Responsible for developing software solutions.");
addJob("Marketing Manager", "Biz Solutions", "Los Angeles", "Plan and oversee marketing campaigns.");

displayJobs();

?>


?>