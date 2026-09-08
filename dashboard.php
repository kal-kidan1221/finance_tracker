<?php
include 'config.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$success = '';

// Handle Add Expense (Create)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_expense'])) {
    $title = trim($_POST['title']);
    $amount = trim($_POST['amount']);
    $category = trim($_POST['category']);
    $date = trim($_POST['date']);

    if (!empty($title) && !empty($amount) && !empty($category) && !empty($date)) {
        $stmt = $conn->prepare("INSERT INTO expenses (user_id, title, amount, category, date) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("isdss", $user_id, $title, $amount, $category, $date);
        $stmt->execute();
        $stmt->close();
        $success = "Expense added successfully!";
    }
}

// Handle Delete Expense (Delete)
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = $conn->prepare("DELETE FROM expenses WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $id, $user_id);
    $stmt->execute();
    $stmt->close();
    header("Location: dashboard.php");
    exit();
}

// Fetch Expenses (Read)
$stmt = $conn->prepare("SELECT id, title, amount, category, date FROM expenses WHERE user_id = ? ORDER BY date DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Finance Tracker</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header><h1>Dashboard</h1></header>
    <nav>
        <a href="index.php">Home</a>
        <a href="about.php">About</a>
        <a href="dashboard.php">Dashboard</a>
        <a href="logout.php">Logout</a>
        <a href="contact.php">Contact</a>
    </nav>
    <div class="container">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
        
        <h3>Add New Expense</h3>
        <?php if($success) echo "<p class='success'>$success</p>"; ?>
        <form action="dashboard.php" method="POST">
            <label>Title/Description:</label>
            <input type="text" name="title" required>
            <label>Amount ($):</label>
            <input type="number" step="0.01" name="amount" required>
            <label>Category:</label>
            <select name="category" required>
                <option value="Food">Food</option>
                <option value="Transport">Transport</option>
                <option value="Bills">Bills</option>
                <option value="Entertainment">Entertainment</option>
                <option value="Other">Other</option>
            </select>
            <label>Date:</label>
            <input type="date" name="date" required>
            <button type="submit" name="add_expense">Add Expense</button>
        </form>

        <h3 style="margin-top:40px;">Your Expense Records</h3>
        <table>
            <tr>
                <th>Title</th>
                <th>Amount</th>
                <th>Category</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['title']); ?></td>
                <td>$<?php echo number_format($row['amount'], 2); ?></td>
                <td><?php echo htmlspecialchars($row['category']); ?></td>
                <td><?php echo htmlspecialchars($row['date']); ?></td>
                <td><a href="dashboard.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this expense?');" style="color:red;">Delete</a></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
    <footer>&copy; 2026 Web Programming Assignment</footer>
</body>
</html>
