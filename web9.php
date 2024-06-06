<?php
$result = '';
$userChoice = '';
$computerChoice = '';
$choices = ['グー', 'チョキ', 'パー'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['choice'])) {
    $userChoice = $_POST['choice'];
    $computerChoice = $choices[array_rand($choices)];

    if ($userChoice === $computerChoice) {
        $result = 'あいこです。';
    } else if (($userChoice === 'グー' && $computerChoice === 'チョキ') ||
               ($userChoice === 'チョキ' && $computerChoice === 'パー') ||
               ($userChoice === 'パー' && $computerChoice === 'グー')) {
        $result = 'あなたの勝ちです！';
    } else {
        $result = 'あなたの負けです。';
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>じゃんけんゲーム</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label><input type="radio" name="choice" value="グー" required> グー</label>
        <label><input type="radio" name="choice" value="チョキ"> チョキ</label>
        <label><input type="radio" name="choice" value="パー"> パー</label>
        <input type="submit" value="ぽん！">
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <p>あなたの手: <?php echo htmlspecialchars($userChoice); ?></p>
        <p>コンピューターの選択: <?php echo htmlspecialchars($computerChoice); ?></p>
        <p>結果: <?php echo htmlspecialchars($result); ?></p>
    <?php endif; ?>
</body>
</html>
