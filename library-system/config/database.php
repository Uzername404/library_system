<?php
$host = 'localhost';  // Database host (usually localhost)
$dbname = 'library_system';  // Database name
$username = 'root';  // Database username
$password = '';  // Database password (default is empty for XAMPP)

try {
    // Create a PDO instance (connection)
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set error mode to exceptions
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
