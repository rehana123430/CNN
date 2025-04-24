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

// Fetch articles
$sql = "SELECT * FROM articles ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        /* General Page Styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        /* Navbar Styling */
        .navbar {
            background-color: #c00;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
        }

        /* Dashboard Container */
        .container {
            width: 80%;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Success Message */
        .success {
            color: green;
            font-weight: bold;
            text-align: center;
            padding: 10px;
            background: #e8f5e9;
            border: 1px solid #2e7d32;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        /* Add Article Button */
        .add-article {
            display: inline-block;
            background: #c00;
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
            font-weight: bold;
            transition: 0.3s;
        }

        .add-article:hover {
            background: #900;
        }

        /* Articles Styling */
        .article {
            background: white;
            padding: 15px;
            border-bottom: 1px solid #ddd;
            margin-bottom: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .article h2 {
            color: #c00;
            margin: 0;
        }

        .article p {
            font-size: 16px;
            line-height: 1.6;
            color: #333;
        }

        .article img {
            width: 100%;
            max-height: 300px;
            object-fit: cover;
            border-radius: 5px;
            margin-top: 10px;
        }

        .article small {
            display: block;
            margin-top: 5px;
            color: #777;
        }

        /* Footer */
        .footer {
            text-align: center;
            padding: 10px;
            background: #c00;
            color: white;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <div class="navbar">CNN-Style Dashboard</div>

    <div class="container">

        <!-- Success Message -->
        <?php if (isset($_SESSION['success'])): ?>
            <p class="success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></p>
        <?php endif; ?>

        <!-- Add Article Button -->
        <a href="add_article.php" class="add-article">➕ Add New Article</a>

        <h2>Latest Articles</h2>

        <!-- Display Articles -->
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="article">
                    <h2><?php echo htmlspecialchars($row['title']); ?></h2>
                    <p><?php echo nl2br(htmlspecialchars($row['content'])); ?></p>
                    <?php if (!empty($row['image'])): ?>
                        <img src="uploads/<?php echo $row['image']; ?>" alt="Article Image">
                    <?php endif; ?>
                    <small>Published on: <?php echo $row['created_at']; ?></small>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No articles found.</p>
        <?php endif; ?>

    </div>

    <div class="footer">
        &copy; <?php echo date("Y"); ?> CNN Dashboard Clone
    </div>

</body>
</html>

<?php $conn->close(); ?>
