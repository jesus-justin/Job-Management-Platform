<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['position'] !== 'employer') {
    header('Location: login.php');
    exit;
}

// Fetch application details
if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("SELECT * FROM job_applications WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $application = $stmt->fetch();
    if (!$application) {
        die("Application not found!");
    }
}

// Update application
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_id'])) {
    $id = $_POST['update_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $qualifications = $_POST['qualifications'];

    $stmt = $pdo->prepare("UPDATE job_applications SET applicant_name = ?, applicant_email = ?, qualifications = ? WHERE id = ?");
    $stmt->execute([$name, $email, $qualifications, $id]);

    header('Location: employer.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Application</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #007acc;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 8px;
            font-weight: bold;
        }
        input, textarea {
            padding: 10px;
            margin: 10px 0 20px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            background-color: #007acc;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #005fa3;
        }
        .btn-container {
            display: flex;
            justify-content: space-evenly;
            margin-top: 30px;
        }
        .btn-container a, .btn-container button {
            background-color: #007acc;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 16px;
        }
        .btn-container a:hover, .btn-container button:hover {
            background-color: #005fa3;
        }
        .btn-container button {
            margin: 0 10px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Update Application</h1>
        <form method="POST" action="update_application.php?id=<?php echo $application['id']; ?>">
            <label for="name">Applicant Name:</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($application['applicant_name']); ?>" required>

            <label for="email">Applicant Email:</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($application['applicant_email']); ?>" required>

            <label for="qualifications">Qualifications:</label>
            <textarea name="qualifications" required><?php echo htmlspecialchars($application['qualifications']); ?></textarea>

            <input type="hidden" name="update_id" value="<?php echo $application['id']; ?>">
            <button type="submit">Update Application</button>
        </form>

        <div class="btn-container">
            <a href="employer.php">Back</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

</body>
</html>
