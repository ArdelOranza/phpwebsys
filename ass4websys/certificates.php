<?php
session_start();

if (empty($_SESSION['p']) || empty($_SESSION['e'])) {
    header('Location: personal.php');
    exit;
}

$errors = [];
$c = $_SESSION['c'] ?? [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $issuer = trim($_POST['issuer'] ?? '');
    $year = trim($_POST['year'] ?? '');

    if ($title === '') {
        $errors['title'] = 'Certificate Name is required';
    } elseif (strlen($title) < 2) {
        $errors['title'] = 'Certificate Name must be at least 2 characters';
    }

    if ($issuer === '') {
        $errors['issuer'] = 'Issuer/Organization is required';
    } elseif (strlen($issuer) < 2) {
        $errors['issuer'] = 'Issuer/Organization must be at least 2 characters';
    }

    if ($year === '') {
        $errors['year'] = 'Year Issued is required';
    }  elseif ((int)$year < 1900 || (int)$year > date('Y') + 1) {
        $errors['year'] = 'Year must be between 1900 and ' . (date('Y') + 1);
    }

    if (empty($errors)) {
        $_SESSION['c'] = [
            'title' => htmlspecialchars($title),
            'issuer' => htmlspecialchars($issuer),
            'year' => htmlspecialchars($year)
        ];
        header('Location: resume.php');
        exit;
    }

    $c = ['title' => $title, 'issuer' => $issuer, 'year' => $year];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificates - Resume Builder</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Step 3: Certificates</h2>
        
        <form method="POST" novalidate>
            <div class="form-group">
                <label for="title">Certificate Name <span style="color:#e74c3c;">*</span></label>
                <input type="text" id="title" name="title" value="<?= htmlspecialchars($c['title'] ?? '') ?>" 
                       placeholder="e.g., AWS Certified Solutions Architect" <?= isset($errors['title']) ? 'class="error"' : '' ?>>
                <?php if (isset($errors['title'])): ?>
                    <span class="error-message"><?= $errors['title'] ?></span>
                <?php endif; ?>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="issuer">Issuer / Organization <span style="color:#e74c3c;">*</span></label>
                    <input type="text" id="issuer" name="issuer" value="<?= htmlspecialchars($c['issuer'] ?? '') ?>" 
                           placeholder="e.g., Amazon Web Services" <?= isset($errors['issuer']) ? 'class="error"' : '' ?>>
                    <?php if (isset($errors['issuer'])): ?>
                        <span class="error-message"><?= $errors['issuer'] ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="year">Year Issued <span style="color:#e74c3c;">*</span></label>
                    <input type="text" id="year" name="year" value="<?= htmlspecialchars($c['year'] ?? '') ?>" 
                           placeholder="2024" maxlength="4" <?= isset($errors['year']) ? 'class="error"' : '' ?>>
                    <?php if (isset($errors['year'])): ?>
                        <span class="error-message"><?= $errors['year'] ?></span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="buttons">
                <a href="experience.php" class="btn btn-back">&larr; Back</a>
                <button type="submit" class="btn-primary">Generate Resume &rarr;</button>
            </div>
        </form>
    </div>
</body>
</html>