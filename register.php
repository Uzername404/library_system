<?php
include('../config/database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Check if the username already exists
    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        $error = "Username already taken!";
    } else {
        // Insert new user into database
        $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        if ($stmt->execute()) {
            header("Location: login.php");
            exit();
        } else {
            $error = "Registration failed!";
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
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>

    <div class="login-container">
        <h2>Create a New Account</h2>

        <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>

        <form method="POST" action="register.php">
            <label for="username">Username</label>
            <input type="text" name="username" required>

            <label for="password">Password</label>
            <input type="password" name="password" required>

            <button type="submit" class="button">Register</button>
        </form>

        <p><a href="../views/index.php">Back to Home</a></p>
    </div>

</body>
</html>
