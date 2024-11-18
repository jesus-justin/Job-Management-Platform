<?php

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

// Usage
if ($_POST) {
    // Database connection
    $dbConfig = parse_ini_file('config.ini'); // Database credentials in config.ini
    $conn = new mysqli($dbConfig['host'], $dbConfig['username'], $dbConfig['password'], $dbConfig['dbname']);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
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
