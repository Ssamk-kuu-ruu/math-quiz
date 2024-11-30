<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="quiz-container">
        <h1>Quiz Results</h1>
        <p>Total Questions: <?= $_SESSION['settings']['num_questions'] ?></p>
        <p>Correct Answers: <?= $_SESSION['score']['correct'] ?></p>
        <p>Wrong Answers: <?= $_SESSION['score']['wrong'] ?></p>
        <form action="reset.php" method="post">
            <button type="submit">Start New Quiz</button>
        </form>
    </div>
</body>
</html>
