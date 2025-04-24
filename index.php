<?php
// Database connection
$conn = new mysqli('localhost', 'ue7yf5g1ts2pg', 'eqgutnykw34r', 'dbygcgjyu2wegq');

// Fetch articles
$articles = $conn->query("SELECT * FROM articles ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My News</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #333;
            color: white;
            padding: 1rem;
            text-align: center;
        }
        nav {
            background-color: #444;
            padding: 0.5rem;
        }
        nav a {
            color: white;
            margin: 0 10px;
            text-decoration: none;
        }
        .container {
            padding: 1rem;
        }
        .article {
            border: 1px solid #ddd;
            border-radius: 8px;
            margin: 1rem 0;
            padding: 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
        .article:hover {
            transform: scale(1.02);
        }
        .article img {
            max-width: 100%;
            border-radius: 8px;
        }
        .read-more {
            color: blue;
            text-decoration: underline;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <header>
        <h1>My News</h1>
    </header>
    <nav>
        <a href="#">Politics</a>
        <a href="#">Sports</a>
        <a href="#">Tech</a>
    </nav>
    <div class="container">
        <?php while ($article = $articles->fetch_assoc()): ?>
            <div class="article">
                <h2><?= $article['title'] ?></h2>
                <img src="<?= $article['image'] ?>" alt="News Image">
                <p><?= substr($article['content'], 0, 150) ?>...</p>
                <a href="article.php?id=<?= $article['id'] ?>" class="read-more">Read More</a>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
