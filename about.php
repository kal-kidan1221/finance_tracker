<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About Us - Finance Tracker</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header><h1>About the Developer & System</h1></header>
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
        <h2>Student Information</h2>
        <ul>
            <li>Full Name: [ Kalkidan- Assefa ]</li>
            <li>ID Number: [ 028/16 ]</li>
            <li>Department: Department of Computer Science</li>
        </ul>
        <h2>System Overview</h2>
        <p>This web application is designed to help users track individual financial records,
            categorize expenditures, and manage daily spending habits safely through 
            a secure relational database backend.</p>
    </div>
    <footer>&copy; 2026 Web Programming Assignment</footer>
    <script src="script.js"></script>
</body>
</html>
