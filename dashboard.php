<?php
// Start session and check for librarian role
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'librarian') {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom styling for dashboard */
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40;
            padding-top: 20px;
        }

        .sidebar a {
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            display: block;
        }

        .sidebar a:hover {
            background-color: #575757;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
    </style>
</head>
<body>

<!-- Sidebar Navigation -->
<div class="sidebar">
    <h3 class="text-white text-center">Librarian Dashboard</h3>
    <a href="dashboard.php">Dashboard</a>
    <a href="books.php">Book Management</a>
    <a href="borrow_books.php">Borrow Books</a>
    <a href="return_books.php">Return Books</a>
    <a href="logout.php" class="text-danger">Log Out</a>
</div>

<!-- Main Content -->
<div class="main-content">
    <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
    <p>Here is a summary of your library system:</p>

    <div class="row">
        <!-- Total Books -->
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Total Books</h5>
                    <p class="card-text">You have X books in the library.</p>
                </div>
            </div>
        </div>

        <!-- Borrowed Books -->
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Borrowed Books</h5>
                    <p class="card-text">X books are currently borrowed.</p>
                </div>
            </div>
        </div>

        <!-- Overdue Books -->
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <h5 class="card-title">Overdue Books</h5>
                    <p class="card-text">X books are overdue.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional info or actions here -->
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
