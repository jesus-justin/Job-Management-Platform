<?php

if ($_POST) {
    public $name = $_POST['name'];
    public $email = $_POST['email'];
    private $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    public $user_type = $_POST['user_type'];

    // Insert data
    $sql = "INSERT INTO users (name, email, password, user_type) VALUES ('$name', '$email', '$password', '$user_type')";
    if ($conn->query($sql)) {
        echo "Registration successful! <a href='login.php'>Login here</a>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
