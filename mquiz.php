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