<?php
function fizzBuzz($number) {
    if ($number % 15 === 0) { // 15 is the least common multiple of 3 and 5
        return 'FizzBuzz';
    } elseif ($number % 3 === 0) {
        return 'Fizz';
    } elseif ($number % 5 === 0) {
        return 'Buzz';
    } else {
        return (string)$number;
    }
}

$error = '';
$results = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input = filter_input(INPUT_POST, 'number', FILTER_VALIDATE_INT, [
        'options' => [
            'min_range' => 1
        ]
    ]);

    if ($input) {
        for ($i = 1; $i <= $input; $i++) {
            $results .= fizzBuzz($i) . ' ';
        }
        $results = trim($results); // Trim the trailing space
    } else {
        $error = 'エラー: 正の整数を入力してください。'; // Error: Please enter a positive integer.
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>FizzBuzz Sequence Generator</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="number">入力:</label>
        <input type="text" id="number" name="number" placeholder="Enter a positive integer">
        <input type="submit" value="解析">
    </form>

    <?php if ($error): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <?php if ($results): ?>
        <h3>解析結果:</h3>
        <p><?php echo $results; ?></p>
    <?php endif; ?>
</body>
</html>
