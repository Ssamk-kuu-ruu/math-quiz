<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['settings'] = [
        'level_min' => intval($_POST['level_min']),
        'level_max' => intval($_POST['level_max']),
        'operator' => $_POST['operator'],
        'num_questions' => intval($_POST['num_questions']),
        'answer_diff' => intval($_POST['answer_diff']),
    ];
    $_SESSION['score'] = ['correct' => 0, 'wrong' => 0];
    $_SESSION['question_count'] = 0;
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Settings</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="quiz-container">
        <h1>Quiz Settings</h1>
        <form action="" method="post">
            <label for="level_min">Level Min:</label>
            <input type="number" id="level_min" name="level_min" value="1" required>
            
            <label for="level_max">Level Max:</label>
            <input type="number" id="level_max" name="level_max" value="10" required>

            <label for="operator">Operator:</label>
            <select id="operator" name="operator" required>
                <option value="+">Addition</option>
                <option value="-">Subtraction</option>
                <option value="*">Multiplication</option>
            </select>

            <label for="num_questions">Number of Questions:</label>
            <input type="number" id="num_questions" name="num_questions" value="10" required>

            <label for="answer_diff">Max Answer Difference:</label>
            <input type="number" id="answer_diff" name="answer_diff" value="10" required>

            <button type="submit">Save Settings</button>
        </form>
    </div>
</body>
</html>
