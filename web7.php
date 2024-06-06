<?php
$message = '';
$numbers = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputNumber = filter_input(INPUT_POST, 'number', FILTER_VALIDATE_INT);

    if ($inputNumber !== false && $inputNumber > 0) {
        
        $increment = $inputNumber % 2 === 0 ? 2 : 2;
        
        for ($i = 0; $i < $inputNumber; $i++) {
            $numbers[] = $inputNumber + ($i * $increment);
        }
    } elseif ($inputNumber <= 0) {
        $message = 'エラー: 正の整数を入力してください。'; 
    } else {
        $message = 'エラー: 有効な数字を入力してください。';
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Number Sequence Generator</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="type">入力:</label>
        <input type="type" id="number" name="number" placeholder="正の整数を入力">
        <input type="submit" value="表示">
    </form>

    <?php if (!empty($numbers)): ?>
        <p><?php echo implode(', ', $numbers); ?></p>
    <?php endif; ?>
    
    <?php if ($message): ?>
        <p style="color: red;"><?php echo $message; ?></p>
    <?php endif; ?>
</body>
</html>
