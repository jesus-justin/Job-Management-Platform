<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Management System</title>
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #fff;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            position: relative;
        }

        /* Animated Background */
        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, #6dd5ed, #2193b0, #ff6f61);
            background-size: 300% 300%;
            animation: gradientAnimation 8s ease infinite;
            z-index: -1;
        }

        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Sparkle Animation */
        .sparkle {
            position: absolute;
            width: 10px;
            height: 10px;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 50%;
            box-shadow: 0 0 8px rgba(255, 255, 255, 0.6);
            animation: sparkle 4s linear infinite;
        }

        @keyframes sparkle {
            0% { transform: translate(-50%, -50%) scale(0); }
            50% { transform: translate(-50%, -50%) scale(1); }
            100% { transform: translate(-50%, -50%) scale(0); }
        }

        .sparkle:nth-child(1) { top: 20%; left: 30%; animation-delay: 0s; }
        .sparkle:nth-child(2) { top: 50%; left: 70%; animation-delay: 1s; }
        .sparkle:nth-child(3) { top: 80%; left: 40%; animation-delay: 2s; }
        .sparkle:nth-child(4) { top: 30%; left: 80%; animation-delay: 3s; }

        /* Content Container */
        .container {
            background: rgba(255, 255, 255, 0.1);
            padding: 30px 50px;
            border-radius: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
            z-index: 1;
        }

        h1 {
            font-size: 3rem;
            margin-bottom: 20px;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);
        }

        p {
            font-size: 1.2rem;
            margin-bottom: 30px;
        }

        .button {
            display: inline-block;
            background-color: #ff6f61;
            color: white;
            padding: 12px 25px;
            text-decoration: none;
            font-size: 20px;
            border-radius: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
            margin: 10px;
        }

        .button:hover {
            background-color: #ff4a3c;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
            transform: translateY(-3px);
        }
    </style>
</head>
<body>
    <!-- Sparkle Animation -->
    <div class="sparkle"></div>
    <div class="sparkle"></div>
    <div class="sparkle"></div>
    <div class="sparkle"></div>

    <!-- Content -->
    <div class="container">
        <h1>Welcome to TrabaWHO</h1>
        <p>Choose an option to get started:</p>
        <!-- Button for Register -->
        <a href="registration.php" class="button">Register</a>
        <!-- Button for Login -->
        <a href="login.php" class="button">Login</a>
    </div>
</body>
</html>
