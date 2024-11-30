<?php
session_start();
include('../config/database.php'); // Ensure correct path to your database connection file

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Fetch books from the database
$query = "SELECT * FROM books";
$stmt = $conn->prepare($query);
$stmt->execute();
$books = $stmt->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books Management</title>
    <link rel="stylesheet" href="../assets/css/styles.css"> <!-- Link to external CSS -->
</head>
<body>

    <!-- Header Section -->
    <?php include('../views/includes/header.php'); ?>

    <div class="container">
        <h1>Books List</h1>
        <a href="add_book.php" class="btn btn-primary">Add New Book</a>
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($books as $book): ?>
                    <tr>
                        <td><?php echo $book['title']; ?></td>
                        <td><?php echo $book['author']; ?></td>
                        <td><?php echo $book['status']; ?></td>
                        <td>
                            <!-- Edit button -->
                            <a href="../functions/edit_book.php?id=<?php echo $book['id']; ?>" class="btn btn-info">Edit</a>

                            <?php if ($book['status'] == 'Available'): ?>
                                <!-- Display Borrow button if book is available -->
                                <a href="../functions/borrow_book.php?id=<?php echo $book['id']; ?>" class="btn btn-primary">Borrow</a>
                            <?php elseif ($book['status'] == 'Borrowed' && $book['borrowed_by'] == $_SESSION['user_id']): ?>
                                <!-- Display Return button if book is borrowed by the logged-in user -->
                                <a href="../functions/return_book.php?id=<?php echo $book['id']; ?>" class="btn btn-success">Return</a>
                            <?php else: ?>
                                <!-- Empty cell for books that are borrowed by other users -->
                                <span>Not Available</span>
                            <?php endif; ?>

                            <!-- Delete button -->
                            <a href="../functions/delete_book.php?id=<?php echo $book['id']; ?>" class="btn" onclick="return confirm('Are you sure you want to delete this book?');">Delete</a>
                            
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Footer Section -->
    <?php include('../views/includes/footer.php'); ?>
</body>
</html>
