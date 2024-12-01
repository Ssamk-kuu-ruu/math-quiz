<?php
session_start();
$correct = $_SESSION['correct'] ?? 0;
$total = $_SESSION['settings']['num_questions'] ?? 0;

// Clear session for new quiz
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Results</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <h1>Quiz Results</h1>
            <p>You answered <?= $correct ?> out of <?= $total ?> questions correctly!</p>
            <a href="settings.php" class="btn">Try Again</a>
        </div>
    </div>
</body>
</html>
