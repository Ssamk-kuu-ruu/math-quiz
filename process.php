<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userAnswer = intval($_POST['user_answer']);
    $correctAnswer = $_SESSION['current_answer'];

    if ($userAnswer === $correctAnswer) {
        $_SESSION['score']['correct']++;
    } else {
        $_SESSION['score']['wrong']++;
    }
}

header('Location: index.php');
exit;
?>
