<?php
session_start();
include 'db_connect.php';

$success = false; // Track if login is successful

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query the user by email
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        // Check if the entered name matches the registered name
        if ($user['name'] !== $name) {
            $error = "Invalid User Name!";
        } else if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $name;
            $success = true; // Mark login as successful
            
            // Check if the email contains "admin"
            if (strpos($email, 'admin') !== false) {
                $_SESSION['position'] = 'employer'; // Mark as employer
            } else {
                $_SESSION['position'] = 'applicant'; // Mark as applicant
            }
        } else {
            $error = "Invalid email or password!";
        }
    } else {
        $error = "Invalid email or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to bottom, #6dd5ed, #2193b0);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #fff;
        }

        .container {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
            font-size: 2.5rem;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin: 10px 0 5px;
            font-weight: bold;
            text-align: left;
            color: #fff;
        }

        input {
            padding: 10px;
            font-size: 1rem;
            border: none;
            border-radius: 5px;
            margin-bottom: 15px;
            outline: none;
            background: rgba(255, 255, 255, 0.8);
            width: 100%;
        }

        button {
            padding: 12px;
            font-size: 1rem;
            color: #fff;
            background-color: #ff6f61;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #ff4a3c;
        }

        .error {
            color: #ff4a3c;
            margin-bottom: 15px;
            font-weight: bold;
        }

        a {
            display: inline-block;
            margin-top: 15px;
            color: #ff6f61;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #ff4a3c;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form action="login.php" method="POST">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>

            <button type="submit">Login</button>
        </form>
        <a href="front_page.php">Back to Home Page</a>
    </div>

    <?php if ($success): ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'You have been logged in!',
                text: 'Welcome to the portal!',
                showConfirmButton: true,
            }).then(() => {
                <?php if ($_SESSION['position'] === 'employer'): ?>
                    window.location.href = 'employer.php';
                <?php else: ?>
                    window.location.href = 'job_listings.php';
                <?php endif; ?>
            });
        </script>
    <?php endif; ?>
</body>
</html>

