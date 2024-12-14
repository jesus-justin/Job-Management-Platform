<?php  
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['position'] !== 'employer') {
    header('Location: login.php');
    exit;
}

if (isset($_GET['delete_id'])) {
    $stmt = $pdo->prepare("DELETE FROM job_applications WHERE id = ?");
    $stmt->execute([$_GET['delete_id']]);
    header('Location: employer.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM job_applications");
$stmt->execute();
$applications = $stmt->fetchAll();

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
    <title>Employer Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f9; margin: 0; padding: 0; position: relative; }
        .container { padding: 20px; }
        h1 { text-align: center; color: #007acc; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: center; }
        th { background-color: #007acc; color: white; }
        td { background-color: #f9f9f9; }
        .actions a { color: #007acc; text-decoration: none; }
        .actions a:hover { color: #005fa3; }
        .logout-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            background-color: #007acc;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 16px;
        }
        .logout-btn:hover {
            background-color: #005fa3;
        }
    </style>
</head>
<body>
    <a href="logout.php" class="logout-btn">Logout</a>
    <div class="container">
        <h1>Employer Dashboard</h1>
        <h2>Applicant Submissions</h2>
        
        <?php if (empty($applications)): ?>
            <p>No applications found.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Qualifications (Please input the Job:)</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($applications as $app): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($app['applicant_name']); ?></td>
                            <td><?php echo htmlspecialchars($app['applicant_email']); ?></td>
                            <td><?php echo htmlspecialchars($app['qualifications']); ?></td>
                            <td class="actions">
                                <a href="update_application.php?id=<?php echo $app['id']; ?>">View</a> |
                                <a href="employer.php?delete_id=<?php echo $app['id']; ?>" onclick="return confirm('Are you sure?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>
