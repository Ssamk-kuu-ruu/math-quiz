<?php
session_start();

if (!isset($_SESSION['settings'])) {
    $_SESSION['settings'] = [
        'level_min' => 1,
        'level_max' => 10,
        'operator' => '+',
        'num_questions' => 10,
        'answer_diff' => 10
    ];
    $_SESSION['score'] = ['correct' => 0, 'wrong' => 0];
    $_SESSION['question_count'] = 0;
}

function generatequestions($settings) {
    $num1 = rand($settings['level_min'], $settings['level_max']);
    $num2 = rand($settings['level_min'], $settings['level_max']);
    $operator = $settings['operator'];
    $correctanswer = eval('return $num1 $operator $num2');
    $choices = [$correctanswer];

    while (count($choices) < 4) {
        $randomDiff = rand(-$settings['answer_diff'], $settings['answer_diff']);
        $choice = $correctanswer + $randomDiff;
        if (!in_array($choice, $choices) && $choice >= 0) {
            $choices[] = $choice;
        }
    }

    shuffle($choices);
    return [$num1, $num2, $operator, $correctanswer, $choices];
}

if ($_SESSION['question_count'] < $_SESSION['settings']['num_questions']) {
    list($num1, $num2, $operator, $correctanswer, $choices) = generatequestions($_SESSION['settings']);
    $_SESSION['current_answer'] = $correctanswer;
    $_SESSION['question_count']++;
}
else {
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
                    <input type="radio" name="user_answer" id="choice<?= $index ?>" value="<?= $choice ?>" required>
                    <label for="choice<?= $index ?>"><?= chr(65 + $index) ?>. <?= $choice ?></label>
                </div>

            <?php endforeach; ?>
            <button type="submit">Submit</button>
        </form>
        <p>Score: Correct <?= $_SESSION['score']['correct'] ?> | Wrong <?= $_SESSION['score']['wrong'] ?></p>
    </div>
</body>
</html>