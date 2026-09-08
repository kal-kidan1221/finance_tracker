<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home - Finance Tracker</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header><h1>Personal Finance & Expense Tracker</h1></header>
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
        <h2>Welcome to the System</h2>
        <p>Easily manage your daily expenses and monitor your personal budget securely.</p>
        <?php if (!isset($_SESSION['user_id'])): ?>
            <p><a href="register.php">Register</a> or <a href="login.php">Login</a> to get started.</p>
        <?php else: ?>
            <p>Welcome back, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>! Open your <a href="dashboard.php">Dashboard</a>.</p>
        <?php endif; ?>
    </div>
    <footer>&copy; 2026 Web Programming Assignment</footer>
</body>
</html>
