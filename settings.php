<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['settings'] = [
        'level' => $_POST['level'] ?? 1, // Default to 1 if not set
        'operator' => $_POST['operator'] ?? '+',
        'num_questions' => intval($_POST['num_questions'] ?? 10),
        'answer_diff' => intval($_POST['answer_diff'] ?? 10),
        'custom_min' => intval($_POST['custom_min'] ?? 1),
        'custom_max' => intval($_POST['custom_max'] ?? 10),
    ];
    header('Location: mquiz.php');
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Math Quiz Settings</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="quiz-container">
        <h1>Quiz Settings</h1>
        <form action="" method="post">
            <h3>Level</h3>
            <div>
                <input type="radio" id="level1" name="level" value="1" checked>
                <label for="level1">Level 1 (1-10)</label>
            </div>
            <div>
                <input type="radio" id="level2" name="level" value="2">
                <label for="level2">Level 2 (11-100)</label>
            </div>
            <div>
                <input type="radio" id="custom" name="level" value="3">
                <label for="custom">Custom Level</label>
                <input type="number" name="custom_min" value="1" placeholder="Min">
                <input type="number" name="custom_max" value="10" placeholder="Max">
            </div>
            
            <h3>Operator</h3>
            <div>
                <input type="radio" id="addition" name="operator" value="+" checked>
                <label for="addition">Addition</label>
            </div>
            <div>
                <input type="radio" id="subtraction" name="operator" value="-">
                <label for="subtraction">Subtraction</label>
            </div>
            <div>
                <input type="radio" id="multiplication" name="operator" value="*">
                <label for="multiplication">Multiplication</label>
            </div>

            <h3>Quiz Options</h3>
            <label for="num_questions">Number of Questions:</label>
            <input type="number" id="num_questions" name="num_questions" value="10" required>
            <label for="answer_diff">Max Answer Difference:</label>
            <input type="number" id="answer_diff" name="answer_diff" value="10" required>

            <button type="submit">Start Quiz</button>
        </form>
    </div>
</body>
</html>
