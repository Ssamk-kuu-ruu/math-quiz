<?php
session_start();

if (!isset($_SESSION['settings'])) {
    header('Location: settings.php'); // Redirect if settings are missing
    exit;
}

// Load settings
$settings = $_SESSION['settings'];
$min = $settings['level'] == 3 ? $settings['custom_min'] : ($settings['level'] == 2 ? 11 : 1);
$max = $settings['level'] == 3 ? $settings['custom_max'] : ($settings['level'] == 2 ? 100 : 10);
$num_questions = $settings['num_questions'];
$operator = $settings['operator'];

// Initialize session variables for the quiz
if (!isset($_SESSION['question_count'])) {
    $_SESSION['question_count'] = 0;
    $_SESSION['correct'] = 0;
}

// Handle the submitted answer
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selected = intval($_POST['answer'] ?? -1); // Ensure the submitted answer is an integer
    if ($selected === $_SESSION['current_answer']) {
        $_SESSION['correct']++; // Increment the correct answers count
    }
    $_SESSION['question_count']++;

    // Check if the quiz is complete
    if ($_SESSION['question_count'] >= $num_questions) {
        header('Location: results.php'); // Redirect to results page
        exit; // Stop further execution
    }
}

// Generate a new question
$num1 = rand($min, $max);
$num2 = rand($min, $max);
switch ($operator) {
    case '+':
        $correct_answer = $num1 + $num2;
        break;
    case '-':
        $correct_answer = $num1 - $num2;
        break;
    case '*':
        $correct_answer = $num1 * $num2;
        break;
    default:
        $correct_answer = 0;
        break;
}
$_SESSION['current_answer'] = $correct_answer;

// Generate multiple-choice answers
$choices = [$correct_answer];
while (count($choices) < 4) {
    $random_choice = $correct_answer + rand(-$settings['answer_diff'], $settings['answer_diff']);
    if (!in_array($random_choice, $choices) && $random_choice >= 0) {
        $choices[] = $random_choice;
    }
}
shuffle($choices); // Randomize the answer order
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Math Quiz</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <h1>Math Quiz</h1>
            <p>Question <?= $_SESSION['question_count'] + 1 ?> of <?= $num_questions ?></p>
            <div class="progress-bar">
                <div class="progress" style="width: <?= ($_SESSION['question_count'] / $num_questions) * 100 ?>%;"></div>
            </div>
            <form action="" method="post">
                <h3><?= $num1 . " " . $operator . " " . $num2 ?> = ?</h3>
                <?php foreach ($choices as $choice): ?>
                    <label>
                        <input type="radio" name="answer" value="<?= $choice ?>" required>
                        <span><?= $choice ?></span>
                    </label>
                <?php endforeach; ?>
                <button type="submit" class="btn">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>
