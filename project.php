<?php
$host = 'localhost';
$db = 'job_management';
$user = 'root'; 
$pass = ''; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    
    $stmt = $pdo->prepare("INSERT INTO jobs (title, description) VALUES (?, ?)");
    $stmt->execute([$title, $description]);
    
    echo "Job added successfully!<br>";
}

echo "Job Management Platform<br>";
echo "1. Add Job:<br>";
echo "<form action='' method='POST'>";
echo "    Job Title: <input type='text' name='title' required><br>";
echo "    Job Description: <textarea name='description' required></textarea><br>";
echo "    <button type='submit'>Add Job</button><br>";
echo "</form><br>";

$stmt = $pdo->query("SELECT * FROM jobs");
$jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "Job Listings:<br>";
foreach ($jobs as $job) {
    echo "ID: " . $job['id'] . "<br>";
    echo "Title: " . $job['title'] . "<br>";
    echo "Description: " . $job['description'] . "<br>";
    echo "-----------------------<br>";
}
?>
<?php
$host = 'localhost';
$db = 'job_management';
$user = 'root'; 
$pass = ''; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    
    $stmt = $pdo->prepare("INSERT INTO jobs (title, description) VALUES (?, ?)");
    $stmt->execute([$title, $description]);
    
    echo "Job added successfully!<br>";
}

echo "Job Management Platform<br>";
echo "1. Add Job:<br>";
echo "<form action='' method='POST'>";
echo "    Job Title: <input type='text' name='title' required><br>";
echo "    Job Description: <textarea name='descriptions' required></textarea><br>";
echo "    <button type='submit'>Add Job</button><br>";
echo "</form><br>";

$stmt = $pdo->query("SELECT * FROM jobs");
$jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "Job Listings:<br>";
foreach ($jobs as $job) {
    echo "ID: " . $job['id'] . "<br>";
    echo "Title: " . $job['title'] . "<br>";
    echo "Description: " . $job['description'] . "<br>";
    echo "-----------------------<br>";
    echo "-----------------------<br>";
}
?>
