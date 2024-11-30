<?php
session_start();
require_once('../config/database.php');

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form input values
    $title = $_POST['title'];
    $author = $_POST['author'];
    $status = $_POST['status']; // use 'status' instead of 'availability'

    // Prepare SQL query to insert the book
    $sql = "INSERT INTO books (title, author, status) VALUES (:title, :author, :status)";
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':author', $author);
    $stmt->bindParam(':status', $status); // bind 'status' instead of 'availability'

    // Execute query
    if ($stmt->execute()) {
        echo "New book added successfully!";
        header('Location: ../views/books.php'); // Redirect to the book list page
        exit();
    } else {
        echo "Error adding book.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Book</title>
    <link rel="stylesheet" href="../assets/css/styles.css">

</head>
<body>
    <div class="container">
        <h2>Add New Book</h2>
        <form method="POST" action="add_book.php">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>

            <label for="author">Author:</label>
            <input type="text" id="author" name="author" required>

            <label for="status">Status:</label>
            <select id="status" name="status">
                <option value="Available">Available</option>
                <option value="Borrowed">Borrowed</option>
            </select>

            <button type="submit">Add Book</button>
        </form>
        <br>
        <a href="../views/books.php" class="btn">Back to Book List</a>
    </div>
</body>
</html>
