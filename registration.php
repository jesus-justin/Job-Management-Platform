<?php
session_start();
include 'db_connect.php';

$error = '';
$registrationSuccess = false; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
        $error = "Email already taken.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$name, $email, $password]);
        $registrationSuccess = true; // Set success flag
        
        if (strpos($email, 'admin') !== false) {
            echo "<script>
                    setTimeout(() => window.location.href = 'employer.php', 2000);
                  </script>";
        } else {
            echo "<script>
                    setTimeout(() => window.location.href = 'job_listings.php', 2000);
                  </script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #5c6bc0;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover {
            background-color: #3949ab;
        }
        .error {
            color: red;
            font-size: 14px;
            text-align: center;
            margin-bottom: 10px;
        }
        .link {
            text-align: center;
            margin-top: 10px;
        }
        .link a {
            color: #5c6bc0;
            text-decoration: none;
        }
        .link a:hover {
            text-decoration: underline;
        }
        .home-button {
            text-align: center;
            margin-top: 20px;
        }
        .home-button a {
            background-color: #2196f3;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: bold;
        }
        .home-button a:hover {
            background-color: #1976d2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Register</h1>
        <?php if ($error): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
            </div>
            <button type="submit">Register</button>
        </form>
        <div class="link">
            <p>Already have an account? <a href="login.php">Login</a></p>
        </div>
        <!-- Return to Home Page Button -->
        <div class="home-button">
            <a href="front_page.php">Return to Home Page</a>
        </div>
    </div>

    <!-- SweetAlert Trigger -->
    <?php if ($registrationSuccess): ?>
        <script>
            Swal.fire({
                title: 'Registration Successful!',
                icon: 'success',
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    <?php endif; ?>
</body>
</html>
