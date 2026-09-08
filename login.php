<?php
include 'config.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $db_username, $db_password);
        $stmt->fetch();
        if (password_verify($password, $db_password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $db_username;
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "User not found.";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Finance Tracker</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header><h1>User Login</h1></header>
    <nav>
        <a href="index.php">Home</a>
        <a href="about.php">About</a>
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
        <a href="contact.php">Contact</a>
    </nav>
    <div class="container">
        <h2>Sign In</h2>
        <?php if($error) echo "<p class='error'>$error</p>"; ?>
        <form action="login.php" method="POST">
            <label>Username:</label>
            <input type="text" name="username" required>
            <label>Password:</label>
            <input type="password" name="password" required>
            <button type="submit">Login</button>
        </form>
    </div>
    <footer>&copy; 2026 Web Programming Assignment</footer>
</body>
</html>
