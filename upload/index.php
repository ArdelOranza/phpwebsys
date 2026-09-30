<?php
$maxSize = 50 * 1024 * 1024;
$folder = __DIR__ . '/uploads/';
$types = ['xls', 'xlsx', 'csv', 'jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp', 'ppt', 'pptx', 'doc', 'docx'];
$message = '';
$status = 'error';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$file = $_FILES['file'] ?? null;

	if (!$file || $file['error'] !== UPLOAD_ERR_OK) {
		$message = 'Upload failed. Check the file is 50 MB or smaller.';
	} elseif ($file['size'] > $maxSize) {
		$message = 'File must be 50 MB or smaller.';
	} else {
		$extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

		if (!in_array($extension, $types, true)) {
			$message = 'Choose an Excel, image, PowerPoint, or Word file.';
		} else {
			if (!is_dir($folder)) {
				mkdir($folder, 0755, true);
			}

			$name = bin2hex(random_bytes(16)) . '.' . $extension;
			if (is_writable($folder) && move_uploaded_file($file['tmp_name'], $folder . $name)) {
				$message = 'Upload complete.';
				$status = 'success';
			} else {
				$message = 'Could not save the file.';
			}
		}
	}
}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>File upload</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<main class="upload">
		<h1>Upload a file</h1>
		<p>Excel, image, PowerPoint, or Word. Maximum 50 MB.</p>

		<?php if ($message !== ''): ?>
			<p class="message <?php echo $status; ?>" role="status">
				<?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?>
			</p>
		<?php endif; ?>

		<form method="post" enctype="multipart/form-data">
			<input type="hidden" name="MAX_FILE_SIZE" value="52428800">
			<input type="file" name="file" required
				accept=".xls,.xlsx,.csv,.jpg,.jpeg,.png,.gif,.webp,.bmp,.ppt,.pptx,.doc,.docx">
			<button type="submit">Upload</button>
		</form>
	</main>
</body>
</html>
