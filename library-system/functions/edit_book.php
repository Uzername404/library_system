<?php
session_start();
require_once('../config/database.php');

// Check if the book ID is passed
if (isset($_GET['id'])) {
    $book_id = $_GET['id'];

    // Fetch the book details
    $sql = "SELECT * FROM books WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $book_id);
    $stmt->execute();
    $book = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$book) {
        echo "Book not found!";
        exit();
    }
} else {
    echo "Invalid book ID!";
    exit();
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the updated form values
    $title = $_POST['title'];
    $author = $_POST['author'];
    $status = $_POST['status'];

    // Prepare the SQL query to update the book
    $sql = "UPDATE books SET title = :title, author = :author, status = :status WHERE id = :id";
    $stmt = $conn->prepare($sql);

    // Bind the parameters
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':author', $author);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':id', $book_id);

    // Execute the query
    if ($stmt->execute()) {
        echo "Book updated successfully!";
        header('Location: ../views/books.php'); // Redirect to the book list page
        exit();
    } else {
        echo "Error updating book.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
    <link rel="stylesheet" href="../assets/css/styles.css">

</head>
<body>
    <div class="container">
        <h2>Edit Book</h2>
        <form method="POST" action="edit_book.php?id=<?php echo $book['id']; ?>">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="<?php echo $book['title']; ?>" required>

            <label for="author">Author:</label>
            <input type="text" id="author" name="author" value="<?php echo $book['author']; ?>" required>

            <label for="status">Status:</label>
            <select id="status" name="status">
                <option value="Available" <?php echo $book['status'] == 'Available' ? 'selected' : ''; ?>>Available</option>
                <option value="Borrowed" <?php echo $book['status'] == 'Borrowed' ? 'selected' : ''; ?>>Borrowed</option>
            </select>

            <button type="submit">Update Book</button>
        </form>
        <br>
        <a href="../views/books.php" class="btn">Back to Book List</a>
    </div>
</body>
</html>
