<?php
$message = '';
$purpleBalls = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve input values and validate them as integers
    $redBalls = filter_input(INPUT_POST, 'red', FILTER_VALIDATE_INT);
    $blueBalls = filter_input(INPUT_POST, 'blue', FILTER_VALIDATE_INT);
    $whiteBalls = filter_input(INPUT_POST, 'white', FILTER_VALIDATE_INT);

    if ($redBalls !== false && $blueBalls !== false && $whiteBalls !== false &&
        $redBalls >= 0 && $blueBalls >= 0 && $whiteBalls >= 0) {
        
        $totalBalls = $redBalls + $blueBalls + $whiteBalls;
        $purpleFromSum = floor($totalBalls / 2);
        
        
        $purpleFromRedWhite = $redBalls + $whiteBalls;
        $purpleFromBlueWhite = $blueBalls + $whiteBalls;
        
        
        $purpleBalls = min($purpleFromSum, $purpleFromRedWhite, $purpleFromBlueWhite);
    } else {
        $message = 'エラー: 正の整数を入力してください。'; 
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>紫色のボール計算</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="red">赤色:</label>
        <input type="text" id="red" name="red" placeholder="赤色のボール数">
        
        <label for="blue">青色:</label>
        <input type="text" id="blue" name="blue" placeholder="青色のボール数">
        
        <label for="white">白色:</label>
        <input type="text" id="white" name="white" placeholder="白色のボール数">
        
        <input type="submit" value="計算">
    </form>

    <?php if (!empty($message)): ?>
        <p style="color: red;"><?php echo $message; ?></p>
    <?php else: ?>
        <p>紫色のボール個数: <?php echo htmlspecialchars($purpleBalls); ?></p>
    <?php endif; ?>
</body>
</html>
