
<?php
session_start();
session_destroy();
setcookie(session_name(), '', time() - 3600, '/'); // Clear session cookies
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <!-- SweetAlert CSS and JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #ff7e5f, #feb47b);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            text-align: center;
            background-color: rgba(0, 0, 0, 0.7);
            padding: 30px 50px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        h1 {
            font-size: 3rem;
            margin-bottom: 20px;
            color: #fff;
        }

        p {
            font-size: 1.2rem;
            margin-bottom: 20px;
            color: #ccc;
        }

        a {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #ff6f61;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #ff4a3c;
        }
    </style>
</head>
<body>
    <div class="container">
    </div>

    <script>
        // SweetAlert for logout success message
        Swal.fire({
            icon: 'success',
            title: 'Logged Out!',
            text: 'You have successfully been logged out.',
            showConfirmButton: false,
            timer: 2000 // Time in milliseconds (2 seconds before redirect)
        }).then(() => {
            // Redirect to the front page after the SweetAlert message
            window.location.href = 'front_page.php';
        });
    </script>
</body>
</html>
