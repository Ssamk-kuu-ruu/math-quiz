<?php
session_start();

// Ensure settings are initialized
$settings = $_SESSION['settings'] ?? [
    'level' => 1, // Default level
    'operator' => '+', // Default operator
    'num_questions' => 10, // Default number of questions
    'answer_diff' => 10, // Default max difference
    'custom_min' => 1, // Default custom level min
    'custom_max' => 10 // Default custom level max
];

// Set range based on level
if ($settings['level'] == 1) {
    $min = 1;
    $max = 10;
} elseif ($settings['level'] == 2) {
    $min = 11;
    $max = 100;
} else {
    $min = $settings['custom_min'] ?? 1; // Use default if not set
    $max = $settings['custom_max'] ?? 10; // Use default if not set
}

// Generate question
if ($_SESSION['question_count'] < $settings['num_questions']) {
    $num1 = rand($min, $max);
    $num2 = rand($min, $max);
    $operator = $settings['operator'];
    $correctAnswer = eval("return $num1 $operator $num2;");
    $choices = [$correctAnswer];

    // Generate choices
    while (count($choices) < 4) {
        $randomDiff = rand(-$settings['answer_diff'], $settings['answer_diff']);
        $choice = $correctAnswer + $randomDiff;
        if (!in_array($choice, $choices) && $choice >= 0) {
            $choices[] = $choice;
        }
    }

    shuffle($choices);
    $_SESSION['current_answer'] = $correctAnswer;
    $_SESSION['question_count']++;
} else {
    header('Location: results.php');
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Math Quiz</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="quiz-container">
        <h1>Math Quiz</h1>
        <p>Question <?= $_SESSION['question_count'] ?>:</p>
        <p><strong><?= "$num1 $operator $num2 = ?" ?></strong></p>
        <form action="process.php" method="post">
            <?php foreach ($choices as $index => $choice): ?>
                <div>
                    <input type="radio" id="choice<?= $index ?>" name="user_answer" value="<?= $choice ?>" required>
                    <label for="choice<?= $index ?>"><?= chr(65 + $index) ?>. <?= $choice ?></label>
                </div>
            <?php endforeach; ?>
            <button type="submit">Submit</button>
        </form>
        <p>Score: Correct <?= $_SESSION['score']['correct'] ?> | Wrong <?= $_SESSION['score']['wrong'] ?></p>
    </div>
    <div class="progress-bar">
        <div class="progress" style="width: <?= ($_SESSION['question_count'] / $settings['num_questions']) * 100 ?>%;"></div>
    </div>

</body>
</html>
