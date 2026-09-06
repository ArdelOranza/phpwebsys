<?php
session_start();

if (empty($_SESSION['p'])) {
    header('Location: personal.php');
    exit;
}

$errors = [];
$e = $_SESSION['e'] ?? [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $company = trim($_POST['company'] ?? '');
    $years = trim($_POST['years'] ?? '');
    $desc = trim($_POST['desc'] ?? '');

    if ($title === '') {
        $errors['title'] = 'Job Title is required';
    } elseif (strlen($title) < 2) {
        $errors['title'] = 'Job Title must be at least 2 characters';
    }

    if ($company === '') {
        $errors['company'] = 'Company name is required';
    } elseif (strlen($company) < 2) {
        $errors['company'] = 'Company name must be at least 2 characters';
    }

    if ($years === '') {
        $errors['years'] = 'Years of experience is required';
    }

    if ($desc === '') {
        $errors['desc'] = 'Job Description is required';
    } elseif (strlen($desc) < 20) {
        $errors['desc'] = 'Job Description must be at least 20 characters';
    }

    if (empty($errors)) {
        $_SESSION['e'] = [
            'title' => htmlspecialchars($title),
            'company' => htmlspecialchars($company),
            'years' => htmlspecialchars($years),
            'desc' => htmlspecialchars($desc)
        ];
        header('Location: certificates.php');
        exit;
    }

    $e = ['title' => $title, 'company' => $company, 'years' => $years, 'desc' => $desc];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Work Experience - Resume Builder</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Step 2: Work Experience</h2>
        
        <form method="POST" novalidate>
            <div class="form-group">
                <label for="title">Job Title <span style="color:#e74c3c;">*</span></label>
                <input type="text" id="title" name="title" value="<?= htmlspecialchars($e['title'] ?? '') ?>" 
                       placeholder="e.g., Senior Software Engineer" <?= isset($errors['title']) ? 'class="error"' : '' ?>>
                <?php if (isset($errors['title'])): ?>
                    <span class="error-message"><?= $errors['title'] ?></span>
                <?php endif; ?>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="company">Company <span style="color:#e74c3c;">*</span></label>
                    <input type="text" id="company" name="company" value="<?= htmlspecialchars($e['company'] ?? '') ?>" 
                           placeholder="Company name" <?= isset($errors['company']) ? 'class="error"' : '' ?>>
                    <?php if (isset($errors['company'])): ?>
                        <span class="error-message"><?= $errors['company'] ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="years">Years <span style="color:#e74c3c;">*</span></label>
                    <input type="text" id="years" name="years" value="<?= htmlspecialchars($e['years'] ?? '') ?>" 
                           placeholder="e.g., 3 or 2.5" <?= isset($errors['years']) ? 'class="error"' : '' ?>>
                    <?php if (isset($errors['years'])): ?>
                        <span class="error-message"><?= $errors['years'] ?></span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-group">
                <label for="desc">Job Description <span style="color:#e74c3c;">*</span></label>
                <textarea id="desc" name="desc" placeholder="Describe your responsibilities and achievements..." 
                          <?= isset($errors['desc']) ? 'class="error"' : '' ?>><?= htmlspecialchars($e['desc'] ?? '') ?></textarea>
                <?php if (isset($errors['desc'])): ?>
                    <span class="error-message"><?= $errors['desc'] ?></span>
                <?php endif; ?>
            </div>

            <div class="buttons">
                <a href="personal.php" class="btn btn-back">&larr; Back</a>
                <button type="submit" class="btn-primary">Next &rarr;</button>
            </div>
        </form>
    </div>
</body>
</html>