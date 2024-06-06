<?php
$possibleValues = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $oneYenCount = filter_input(INPUT_POST, 'one_yen', FILTER_VALIDATE_INT);
    $fiveYenCount = filter_input(INPUT_POST, 'five_yen', FILTER_VALIDATE_INT);

    if ($oneYenCount !== false && $fiveYenCount !== false && $oneYenCount>0 && $fiveYenCount>0) {
        for ($i = 0; $i <= $oneYenCount; $i++) {
            for ($j = 0; $j <= $fiveYenCount; $j++) {
                // Calculate the sum for this combination of coins
                $sum = $i + $j * 5;
                // Only add the sum to the results if it is greater than zero
                if ($sum > 0) {
                    $possibleValues[$sum] = true;
                }
            }
        }
        // Sort the results and get the list of possible values
        ksort($possibleValues);
        $possibleValues = array_keys($possibleValues);
    } else {
        echo '無効な入力です。正の整数を入力してください。'; 
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Japanese Coin System</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="one_yen">1円の枚数:</label>
        <input type="text" id="one_yen" name="one_yen" placeholder="Enter number of 1 yen coins"><br>
        <label for="five_yen">5円の枚数:</label>
        <input type="text" id="five_yen" name="five_yen" placeholder="Enter number of 5 yen coins"><br>
        <input type="submit" value="計算">
    </form>

    <?php if (!empty($possibleValues)): ?>
        <h3>結果表示:</h3>
        <p><?php echo implode(', ', $possibleValues); ?></p>
    <?php endif; ?>
</body>
</html>

