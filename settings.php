<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Math Quiz Settings</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="card">
            <h1>Math Quiz Settings</h1>
            <form action="" method="post" id="settingsForm">
                <h3>Select Level</h3>
                <div class="options">
                    <label>
                        <input type="radio" name="level" value="1" checked>
                        <span>Level 1 (1-10)</span>
                    </label>
                    <label>
                        <input type="radio" name="level" value="2">
                        <span>Level 2 (11-100)</span>
                    </label>
                    <label>
                        <input type="radio" name="level" value="3">
                        <span>Custom Level</span>
                    </label>
                    <div class="custom-level">
                        <input type="number" name="custom_min" placeholder="Min" required>
                        <input type="number" name="custom_max" placeholder="Max" required>
                    </div>
                </div>

                <h3>Select Operator</h3>
                <div class="options">
                    <label>
                        <input type="radio" name="operator" value="+" checked>
                        <span>Addition</span>
                    </label>
                    <label>
                        <input type="radio" name="operator" value="-">
                        <span>Subtraction</span>
                    </label>
                    <label>
                        <input type="radio" name="operator" value="*">
                        <span>Multiplication</span>
                    </label>
                </div>

                <h3>Quiz Options</h3>
                <div class="input-group">
                    <label>Number of Questions</label>
                    <input type="number" name="num_questions" value="10" required>
                </div>
                <div class="input-group">
                    <label>Max Answer Difference</label>
                    <input type="number" name="answer_diff" value="10" required>
                </div>

                <button type="submit" class="btn">Start Quiz</button>
            </form>
        </div>
    </div>
</body>
</html>

