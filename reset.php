<?php
session_start();

// Clear quiz data
$_SESSION['score'] = ['correct' => 0, 'wrong' => 0];
$_SESSION['question_count'] = 0;
unset($_SESSION['current_answer']);

// Redirect to settings
header('Location: settings.php');
exit;
?>
