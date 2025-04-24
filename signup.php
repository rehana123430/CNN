<?php
$conn = new mysqli('localhost', 'ue7yf5g1ts2pg', 'eqgutnykw34r', 'dbygcgjyu2wegq');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $result = $conn->query("SELECT * FROM users WHERE email='$email'");
    if ($result->num_rows > 0) {
        $error = "Email already exists.";
    } else {
        $conn->query("INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')");
        header('Location: login.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }
        form {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        input {
            display: block;
            width: 100%;
            margin-bottom: 1rem;
            padding: 0.5rem;
        }
        button {
            background-color: #28a745;
            color: white;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <form method="POST">
        <h2>Signup</h2>
        <?php if (!empty($error)): ?>
            <p class="error"><?= $error ?></p>
        <?php endif; ?>
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Signup</button>
        <p><a href="login.php">Already have an account? Login</a></p>
    </form>
</body>
</html>
