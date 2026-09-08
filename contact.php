<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us - Finance Tracker</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header><h1>Contact Us</h1></header>
    <nav>
        <a href="index.php">Home</a>
        <a href="about.php">About</a>
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="dashboard.php">Dashboard</a>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        <?php endif; ?>
        <a href="contact.php">Contact</a>
    </nav>
    <div class="container">
        <h2>Send Us a Message</h2>
        <form action="contact.php" method="POST" onsubmit="alert('Message sent successfully!');">
            <label>Name:</label>
            <input type="text" name="name" required>
            <label>Email:</label>
            <input type="email" name="email" required>
            <label>Message:</label>
            <textarea name="message" rows="5" required></textarea>
            <button type="submit">Submit</button>
        </form>
    </div>
    <footer>&copy; 2026 Web Programming Assignment</footer>
</body>
</html>

