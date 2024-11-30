<?php
// Start the session at the top of the header to ensure access to session variables
//session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library System - Dashboard</title>
    <link rel="stylesheet" href="../assets/css/styles.css"> <!-- Your custom CSS -->
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container">
            <ul>
                <li><a href="../dashboard/index.php">Dashboard</a></li>
                <li><a href="books.php">Book Management</a></li>
                <li><a href="../auth/logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>
    
    <!-- Display a welcome message or session alert -->
    <?php
    if (isset($_SESSION['message'])) {
        echo '<div class="alert">' . $_SESSION['message'] . '</div>';
        unset($_SESSION['message']);
    }
    ?>
