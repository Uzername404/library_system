<?php
// Include the database connection
require_once '../config/database.php';

// Check if 'id' is provided
if (isset($_GET['id'])) {
    $book_id = $_GET['id'];

    // Check if the book is currently borrowed
    $checkQuery = "SELECT status FROM books WHERE id = :id";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bindParam(':id', $book_id);
    $stmt->execute();
    $book = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($book) {
        // If book is borrowed, do not allow deletion
        if ($book['status'] != 'Available') {
            echo "<script>alert('You cannot delete a borrowed book.'); window.location.href = '../views/books.php';</script>";
            exit;
        }

        // Delete the book if available
        $deleteQuery = "DELETE FROM books WHERE id = :id";
        $stmt = $conn->prepare($deleteQuery);
        $stmt->bindParam(':id', $book_id);
        
        if ($stmt->execute()) {
            echo "<script>alert('Book deleted successfully.'); window.location.href = '../views/books.php';</script>";
        } else {
            echo "<script>alert('Failed to delete the book.'); window.location.href = '../views/books.php';</script>";
        }
    } else {
        echo "<script>alert('Book not found.'); window.location.href = '../views/books.php';</script>";
    }
} else {
    echo "<script>alert('Invalid book ID.'); window.location.href = '../views/books.php';</script>";
}
?>
