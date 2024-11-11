<?php
include 'db.php'; // Database connection
if ($_POST) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $user_type = $_POST['user_type'];

    // Insert data
    $sql = "INSERT INTO users (name, email, password, user_type) VALUES ('$name', '$email', '$password', '$user_type')";
    if ($conn->query($sql)) {
        echo "Registration successful! <a href='login.php'>Login here</a>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<form method="POST">
    <input type="text" name="name" placeholder="Name" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <select name="user_type">
        <option value="student">Student</option>
        <option value="employer">Employer</option>
    </select><br>
    <button type="submit">Register</button>
</form>
