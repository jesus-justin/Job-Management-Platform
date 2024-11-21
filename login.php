<?php
require_once 'login.html'; // Replace with your login form file

// Usage
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Database connection
    $host = 'localhost'; // Replace with your host
    $username = 'root';  // Replace with your database username
    $password = '';      // Replace with your database password
    $dbname = 'ourdatabase'; // Ensure this matches the name of your database

    $conn = new mysqli($host, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    class User {
        private $conn;
        private $email;
        private $password;

        public function __construct($dbConnection) {
            $this->conn = $dbConnection;
        }

        public function setUserData($email, $password) {
            $this->email = $email;
            $this->password = $password;
        }

        public function login() {
            $stmt = $this->conn->prepare("SELECT password, user_type FROM users WHERE email = ?");
            $stmt->bind_param("s", $this->email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $stmt->bind_result($hashedPassword, $user_type);
                $stmt->fetch();

                if (password_verify($this->password, $hashedPassword)) {
                    echo "Login successful! Welcome, $user_type.";
                    // Optionally redirect user based on user_type
                    // header("Location: dashboard.php");
                    // exit();
                } else {
                    echo "Invalid password.";
                }
            } else {
                echo "No user found with this email.";
            }
            $stmt->close();
        }
    }

    // Create User object
    $user = new User($conn);

    // Set user data
    $user->setUserData($_POST['email'], $_POST['password']);

    // Attempt login
    $user->login();

    // Close connection
    $conn->close();
}
?>
