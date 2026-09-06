<?php
session_start();

$errors = [];
$p = $_SESSION['p'] ?? [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $summary = trim($_POST['summary'] ?? '');

    if ($name === '') {
        $errors['name'] = 'Full Name is required';
    } elseif (strlen($name) < 2) {
        $errors['name'] = 'Full Name must be at least 2 characters';
    }

    if ($email === '') {
        $errors['email'] = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please enter a valid email address';
    }

    if ($phone === '') {
        $errors['phone'] = 'Phone number is required';
    } elseif (!preg_match('/^[\d\s\-\+\(\)]{7,}$/', $phone)) {
        $errors['phone'] = 'Please enter a valid phone number';
    }

    if ($summary === '') {
        $errors['summary'] = 'Summary is required';
    } elseif (strlen($summary) < 10) {
        $errors['summary'] = 'Summary must be at least 10 characters';
    }

    if (empty($errors)) {
        $_SESSION['p'] = [
            'name' => htmlspecialchars($name),
            'email' => htmlspecialchars($email),
            'phone' => htmlspecialchars($phone),
            'summary' => htmlspecialchars($summary)
        ];
        header('Location: experience.php');
        exit;
    }

    $p = ['name' => $name, 'email' => $email, 'phone' => $phone, 'summary' => $summary];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Details - Resume Builder</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Step 1: Personal Details</h2>
        
        <form method="POST" novalidate>
            <div class="form-group">
                <label for="name">Full Name <span style="color:#e74c3c;">*</span></label>
                <input type="text" id="name" name="name" value="<?= htmlspecialchars($p['name'] ?? '') ?>" 
                       placeholder="Enter your full name" <?= isset($errors['name']) ? 'class="error"' : '' ?>>
                <?php if (isset($errors['name'])): ?>
                    <span class="error-message"><?= $errors['name'] ?></span>
                <?php endif; ?>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="email">Email <span style="color:#e74c3c;">*</span></label>
                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($p['email'] ?? '') ?>" 
                           placeholder="you@example.com" <?= isset($errors['email']) ? 'class="error"' : '' ?>>
                    <?php if (isset($errors['email'])): ?>
                        <span class="error-message"><?= $errors['email'] ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="phone">Phone <span style="color:#e74c3c;">*</span></label>
                    <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($p['phone'] ?? '') ?>" 
                           placeholder="+1 (555) 123-4567" <?= isset($errors['phone']) ? 'class="error"' : '' ?>>
                    <?php if (isset($errors['phone'])): ?>
                        <span class="error-message"><?= $errors['phone'] ?></span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-group">
                <label for="summary">Professional Summary <span style="color:#e74c3c;">*</span></label>
                <textarea id="summary" name="summary" placeholder="Write a brief professional summary..." 
                          <?= isset($errors['summary']) ? 'class="error"' : '' ?>><?= htmlspecialchars($p['summary'] ?? '') ?></textarea>
                <?php if (isset($errors['summary'])): ?>
                    <span class="error-message"><?= $errors['summary'] ?></span>
                <?php endif; ?>
            </div>

            <div class="buttons">
                <button type="submit" class="btn-primary">Next &rarr;</button>
            </div>
        </form>
    </div>
</body>
</html>