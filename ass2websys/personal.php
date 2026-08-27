<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['p'] = array_map('htmlspecialchars', $_POST);
    header('Location: experience.php');
    exit;
}
$p = $_SESSION['p'] ?? [];
?>
<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="style.css"></head>
<body>
    <h2>Personal Details</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Full Name" value="<?= $p['name'] ?? '' ?>" required>
        <div class="row">
            <input type="email" name="email" placeholder="Email" value="<?= $p['email'] ?? '' ?>" required>
            <input type="text" name="phone" placeholder="Phone" value="<?= $p['phone'] ?? '' ?>">
        </div>
        <textarea name="summary" placeholder="Summary"><?= $p['summary'] ?? '' ?></textarea>
        <button type="submit" class="btn">Next &rarr;</button>
    </form>
</body>
</html>