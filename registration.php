<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
</head>
<body>
    
    <h1>Registration</h1>
    <form method="POST">
        <input type="text" name="name" placeholder="Name" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <select name="user_type" required>
            <option value="student">Student</option>
            <option value="employer">Employer</option>
        </select><br>
        <button type="submit">Register</button>
    </form>
</body>
</html>
