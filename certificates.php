<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['c'] = [
        'title'  => htmlspecialchars($_POST['title'] ?? ''),
        'issuer' => htmlspecialchars($_POST['issuer'] ?? ''),
        'year'   => htmlspecialchars($_POST['year'] ?? '')
    ];
    header('Location: resume.php');
    exit;
}

$c = $_SESSION['c'] ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Certificates</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Certificates</h2>
    <form method="POST" class="grid-form">
        <div class="form-field full-width">
            <label>Certificate Name</label>
            <input type="text" name="title" value="<?= $c['title'] ?? '' ?>">
        </div>
        <div class="form-field">
            <label>Issuer / Organization</label>
            <input type="text" name="issuer" value="<?= $c['issuer'] ?? '' ?>">
        </div>
        <div class="form-field">
            <label>Year Issued</label>
            <input type="text" name="year" value="<?= $c['year'] ?? '' ?>">
        </div>
        <div class="buttons full-width">
            <a href="experience.php" class="btn">&larr; Back</a>
            <button type="submit">Generate Resume &rarr;</button>
        </div>
    </form>
</body>
</html>