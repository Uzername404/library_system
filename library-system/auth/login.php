<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include('../config/database.php');

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: ../views/index.php");
        exit();
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>

    <div class="login-container">
        <h2>Login to Your Account</h2>
        
        <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>

        <form method="POST" action="login.php">
            <label for="username">Username</label>
            <input type="text" name="username" required>

            <label for="password">Password</label>
            <input type="password" name="password" required>

            <button type="submit" class="button">Login</button>
        </form>

        <p><a href="../views/index.php">Back to Home</a></p>
    </div>

</body>
</html>
