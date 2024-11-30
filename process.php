<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $useranswer = intval($_POST['user_answer']);
    $correctanswer = $_SESSION['current_answer'];

    if ($useranswer === $correctanswer) {
        $_SESSION['score']['correct']++;
    } else {
      $_SESSION['score']['wrong']++;  
    }
}

header('Location: mquiz.php');
exit;

?>