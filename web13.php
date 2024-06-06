<?php
$message = '';
$patterns = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and validate the input value
    $inputValue = filter_input(INPUT_POST, 'number', FILTER_VALIDATE_INT, [
        'options' => [
            'min_range' => 1,
            'max_range' => 99
        ]
    ]);

    if ($inputValue !== false) {
        // Create unique patterns with numbers from 1 to 9
        for ($i = 1; $i <= 9; $i++) {
            if ($inputValue % $i == 0) {
                $j = $inputValue / $i;
                // Maintain unique pairs, only showing i ≤ j
                if ($j >= 1 && $j <= 99 && $i <= $j) {
                    $patterns[] = "{$i}×{$j}={$inputValue}";
                }
            }
        }

        // If no patterns were found, set an appropriate message
        if (empty($patterns)) {
            $message = '該当する掛け算パターンが見つかりませんでした。';
        }
    } else {
        $message = 'エラー: 1～99の整数を入力してください。';
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>掛け算パターン生成</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="number">答え:</label>
        <input type="text" id="number" name="number" placeholder="1～99の整数を入力">
        <input type="submit" value="表示">
    </form>

    <?php if (!empty($patterns)): ?>
        <h3>結果表示:</h3>
        <p><?php echo implode(' ', $patterns); ?></p>
    <?php elseif (!empty($message)): ?>
        <p style="color: red;"><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>
</body>
</html>
