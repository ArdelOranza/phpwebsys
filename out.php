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
<html>
<head><link rel="stylesheet" href="style.css"></head>
<body>
    <div class="row">
        <a href="personal.php" class="btn">Edit</a>
        <a href="reset.php" class="btn">Reset</a>
    </div>

    <h1><?= $p['name'] ?></h1>
    <p><?= $p['email'] ?> | <?= $p['phone'] ?></p>

    <?php if (!empty($p['summary'])): ?>
    <div class="resume-sec">
        <h3>Summary</h3>
        <p><?= nl2br($p['summary']) ?></p>
    </div>
    <?php endif; ?>

    <?php if (!empty($e['title'])): ?>
    <div class="resume-sec">
        <h3>Experience</h3>
        <p><strong><?= $e['title'] ?></strong> - <?= $e['company'] ?> (<?= $e['years'] ?>)</p>
        <p><?= nl2br($e['desc']) ?></p>
    </div>
    <?php endif; ?>

    <?php if (!empty($c['title'])): ?>
    <div class="resume-sec">
        <h3>Certificates</h3>
        <p><strong><?= $c['title'] ?></strong> - <?= $c['issuer'] ?> (<?= $c['year'] ?>)</p>
    </div>
    <?php endif; ?>
</body>
</html>