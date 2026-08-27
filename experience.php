<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['e'] = array_map('htmlspecialchars', $_POST);
    header('Location: certificates.php');
    exit;
}
$e = $_SESSION['e'] ?? [];
?>
<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="style.css"></head>
<body>
    <h2>Work Experience</h2>
    <form method="POST">
        <input type="text" name="title" placeholder="Job Title" value="<?= $e['title'] ?? '' ?>">
        <div class="row">
            <input type="text" name="company" placeholder="Company" value="<?= $e['company'] ?? '' ?>">
            <input type="text" name="years" placeholder="Years" value="<?= $e['years'] ?? '' ?>">
        </div>
        <textarea name="desc" placeholder="Job Description"><?= $e['desc'] ?? '' ?></textarea>
        <div class="row">
            <a href="personal.php" class="btn">&larr; Back</a>
            <button type="submit" class="btn">Next &rarr;</button>
        </div>
    </form>
</body>
</html>