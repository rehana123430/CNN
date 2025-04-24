<?php
$conn = new mysqli('localhost', 'ue7yf5g1ts2pg', 'eqgutnykw34r', 'dbygcgjyu2wegq');

// Admin actions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add'])) {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $image = $_POST['image'];
        $conn->query("INSERT INTO articles (title, content, image) VALUES ('$title', '$content', '$image')");
    } elseif (isset($_POST['delete'])) {
        $id = $_POST['id'];
        $conn->query("DELETE FROM articles WHERE id=$id");
    }
}

// Fetch articles
$articles = $conn->query("SELECT * FROM articles ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
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
        .container {
            padding: 1rem;
        }
        .form {
            margin-bottom: 2rem;
        }
        .form input, .form textarea {
            display: block;
            margin: 0.5rem 0;
            padding: 0.5rem;
            width: 100%;
        }
        .form button {
            background-color: #28a745;
            color: white;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .form button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <header>
        <h1>Admin Panel</h1>
    </header>
    <div class="container">
        <form method="POST" class="form">
            <h3>Add Article</h3>
            <input type="text" name="title" placeholder="Title" required>
            <textarea name="content" placeholder="Content" required></textarea>
            <input type="text" name="image" placeholder="Image URL" required>
            <button type="submit" name="add">Add Article</button>
        </form>
        <h3>Existing Articles</h3>
        <?php while ($article = $articles->fetch_assoc()): ?>
            <div>
                <p><strong><?= $article['title'] ?></strong></p>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $article['id'] ?>">
                    <button type="submit" name="delete">Delete</button>
                </form>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
