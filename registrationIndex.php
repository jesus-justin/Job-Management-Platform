<?php

// Usage
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Database connection
    $host = 'localhost'; // Replace with your host
    $username = 'root';  // Replace with your database username
    $password = '';      // Replace with your database password
    $dbname = 'ourdatabase'; // Ensure this matches the name of your imported database

    $conn = new mysqli($host, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
class User {
    private $conn;
    private $name;
    private $email;
    private $password;
    private $user_type;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function setUserData($name, $email, $password, $user_type) {
        $this->name = $name;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->user_type = $user_type;
    }

    public function register() {
        $stmt = $this->conn->prepare("INSERT INTO users (name, email, password, user_type) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $this->name, $this->email, $this->password, $this->user_type);

        if ($stmt->execute()) {
            echo "Registration successful! <a href='login.php'>Login here</a>";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}

    // Create User object
    $user = new User($conn);

    // Set user data
    $user->setUserData($_POST['name'], $_POST['email'], $_POST['password'], $_POST['user_type']);

    // Register user
    $user->register();

    // Close connection
    $conn->close();
}
?>
