<?php
$dayOfWeek = '';
$japaneseDays = ['日曜日', '月曜日', '火曜日', '水曜日', '木曜日', '金曜日', '土曜日'];


$startDayIndex = 6;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dayInput = filter_input(INPUT_POST, 'day', FILTER_VALIDATE_INT, [
        'options' => [
            'min_range' => 1,
            'max_range' => 31
        ]
    ]);

    if ($dayInput !== false) {
        // Calculate day of the week index
        $dayOfWeekIndex = ($startDayIndex + $dayInput - 1) % 7;
        $dayOfWeek = $japaneseDays[$dayOfWeekIndex];
    } else {
        $dayOfWeek = '無効な入力です。1から31までの数字を入力してください。';
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Find Day of Week</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="day">2023年7月何日？</label>
        <input type="text" id="day" name="day" placeholder="1から31の数字を入力">
        <input type="submit" value="曜日を確認">
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && $dayInput !== false): ?>
        <p><?php echo "2023年7月{$dayInput}日は{$dayOfWeek}です。"; ?></p>
    <?php elseif ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <p style="color: red;"><?php echo $dayOfWeek; ?></p>
    <?php endif; ?>
</body>
</html>
