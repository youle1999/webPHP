<?php
$patternOutput = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $length = filter_input(INPUT_POST, 'length', FILTER_VALIDATE_INT);
    $repeat = filter_input(INPUT_POST, 'repeat', FILTER_VALIDATE_INT);

    if ($length !== false && $repeat !== false && $length > 0 && $repeat > 0) {
        for ($i = 0; $i < $repeat; $i++) {
            for ($j = 0; $j < $length; $j++) {
                
                $patternOutput .= ($i % 2 === 0) ? 
                                  (($j % 2 === 0) ? '○' : '×') : 
                                  (($j % 2 === 0) ? '×' : '○'); 
            }
            $patternOutput .= '<br>'; 
        }
    } else {
        $patternOutput = '正の整数を入力してください。';
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Pattern Generator</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="length">横の数:</label>
        <input type="type" id="length" name="length" placeholder="長さ" required>
        
        <label for="repeat">縦の数:</label>
        <input type="type" id="repeat" name="repeat" placeholder="回数" required>
        
        <input type="submit" value="表示">
    </form>

    <?php if (!empty($patternOutput)): ?>
        <div>結果表示:</div>
        <div style="white-space: pre-line;"><?php echo $patternOutput; ?></div>
    <?php endif; ?>
</body>
</html>
