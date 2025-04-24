<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$servername = "localhost";
$username = "ue7yf5g1ts2pg";
$password = "eqgutnykw34r";
$dbname = "dbygcgjyu2wegq";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Database Connection failed: " . $conn->connect_error);
}

// Fetch articles
$sql = "SELECT id, title, content, created_at FROM articles ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles</title>
</head>
<body>
    <h1>Latest Articles</h1>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div>";
            echo "<h2>" . htmlspecialchars($row['title']) . "</h2>";
            echo "<p>" . nl2br(htmlspecialchars($row['content'])) . "</p>";
            echo "<small>Published on: " . $row['created_at'] . "</small>";
            echo "<hr>";
            echo "</div>";
        }
    } else {
        echo "<p>No articles found.</p>";
    }
    ?>
</body>
</html>

<?php
$conn->close();
?>
