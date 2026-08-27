<?php
session_start();

$p = $_SESSION['p'] ?? [];
$e = $_SESSION['e'] ?? [];
$c = $_SESSION['c'] ?? [];

if (empty($p)) {
    header('Location: personal.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $p['name'] ?> - Resume</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
   

    <div class="resume-header">
        <h1><?= $p['name'] ?></h1>
        <p><?= $p['email'] ?> | <?= $p['phone'] ?></p>
    </div>

    <?php if (!empty($p['summary'])): ?>
    <div class="section">
        <h3>Professional Summary</h3>
        <p><?= nl2br($p['summary']) ?></p>
    </div>
    <?php endif; ?>

    <?php if (!empty($e['title'])): ?>
    <div class="section">
        <h3>Experience</h3>
        <p><strong><?= $e['title'] ?></strong> &mdash; <?= $e['company'] ?> (<?= $e['years'] ?>)</p>
        <p><?= nl2br($e['desc']) ?></p>
    </div>
    <?php endif; ?>

    <?php if (!empty($c['title'])): ?>
    <div class="section">
        <h3>Certifications</h3>
        <p><strong><?= $c['title'] ?></strong> &mdash; <?= $c['issuer'] ?> (<?= $c['year'] ?>)</p>
    </div>
    <?php endif; ?>


     <div class="print buttons" style="margin-bottom: 20px;">
        <button onclick="window.print()">Print / Save PDF</button>
        <a href="personal.php" class="btn">Edit</a>
        <a href="reset.php" class="btn">Start Over</a>
    </div>
</body>
</html>