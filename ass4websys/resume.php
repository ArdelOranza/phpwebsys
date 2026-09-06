<?php
session_start();

$p = $_SESSION['p'] ?? [];
$e = $_SESSION['e'] ?? [];
$c = $_SESSION['c'] ?? [];

if (empty($p) || empty($e)) {
    header('Location: personal.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($p['name']) ?> - Resume</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="resume-header">
            <h1><?= htmlspecialchars($p['name']) ?></h1>
            <p><?= htmlspecialchars($p['email']) ?> | <?= htmlspecialchars($p['phone']) ?></p>
        </div>

        <?php if (!empty($p['summary'])): ?>
        <div class="section">
            <h3>Professional Summary</h3>
            <p><?= nl2br(htmlspecialchars($p['summary'])) ?></p>
        </div>
        <?php endif; ?>

        <?php if (!empty($e['title'])): ?>
        <div class="section">
            <h3>Work Experience</h3>
            <p><strong><?= htmlspecialchars($e['title']) ?></strong> &mdash; <?= htmlspecialchars($e['company']) ?> (<?= htmlspecialchars($e['years']) ?> years)</p>
            <p><?= nl2br(htmlspecialchars($e['desc'])) ?></p>
        </div>
        <?php endif; ?>

        <?php if (!empty($c['title'])): ?>
        <div class="section">
            <h3>Certifications</h3>
            <p><strong><?= htmlspecialchars($c['title']) ?></strong> &mdash; <?= htmlspecialchars($c['issuer']) ?> (<?= htmlspecialchars($c['year']) ?>)</p>
        </div>
        <?php endif; ?>

        <div class="print-buttons">
            <button onclick="window.print()" class="btn-primary">Print / Save PDF</button>
            <a href="personal.php" class="btn btn-secondary">Edit</a>
            <a href="reset.php" class="btn btn-back">Start Over</a>
        </div>
    </div>
</body>
</html>