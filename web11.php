<?php
$results = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the input string
    $inputString = filter_input(INPUT_POST, 'text', FILTER_SANITIZE_STRING);

    if ($inputString !== false) {
        // Split the string into an array of characters (considering multibyte characters)
        $characters = mb_str_split($inputString, 1, 'UTF-8');

        // Count the occurrences of each character
        $results = array_count_values($characters);
    } else {
        $results = ['エラー' => '無効な文字列が入力されました。'];
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>文字のカウント</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="text">入力:</label>
        <input type="text" id="text" name="text" placeholder="文字列を入力" required>
        <input type="submit" value="表示">
    </form>

    <?php if (!empty($results)): ?>
        <h3>結果表示:</h3>
        <ul>
            <?php foreach ($results as $char => $count): ?>
                <li><?php echo htmlspecialchars($char); ?>: <?php echo $count; ?>回</li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>
</html>
