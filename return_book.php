<?php
session_start();
include('../config/database.php'); // Ensure correct path to your database connection file

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Get the book ID from the URL
$book_id = $_GET['id'];

// Update the status of the book to "Available" and remove the user who borrowed the book
$query = "UPDATE books SET status = 'Available', borrowed_by = NULL WHERE id = :book_id AND borrowed_by = :user_id";
$stmt = $conn->prepare($query);

// Bind parameters
$stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
$stmt->bindParam(':book_id', $book_id, PDO::PARAM_INT);

// Execute the query
if ($stmt->execute()) {
    header('Location: ../views/books.php'); // Redirect back to books list
    exit;
} else {
    echo "Error: Could not return the book.";
}
?>
