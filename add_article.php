<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$servername = "localhost";
$username = "ue7yf5g1ts2pg";
$password = "eqgutnykw34r";
$dbname = "dbygcgjyu2wegq";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Database Connection failed: " . $conn->connect_error);
}

// Initialize message
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    // Image Upload Handling
    if (!empty($_FILES['image']['name'])) {
        $image = basename($_FILES['image']['name']);
        $target = "uploads/" . $image;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $sql = "INSERT INTO articles (title, content, image) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $title, $content, $image);
            if ($stmt->execute()) {
                $_SESSION['success'] = "Article added successfully!";
                header("Location: dashboard.php");
                exit();
            } else {
                $message = "Database Error: " . $stmt->error;
            }
        } else {
            $message = "Failed to upload image.";
        }
    } else {
        $message = "Please select an image.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Article</title>
</head>
<body>
    <h2>Add New Article</h2>
    <?php if (!empty($message)) echo "<p style='color:red;'>$message</p>"; ?>
    <form method="POST" action="" enctype="multipart/form-data">
        <label>Title:</label>
        <input type="text" name="title" required><br><br>
        
        <label>Content:</label>
        <textarea name="content" required></textarea><br><br>
        
        <label>Upload Image:</label>
        <input type="file" name="image" required><br><br>

        <button type="submit">Submit</button>
    </form>
</body>
</html>
