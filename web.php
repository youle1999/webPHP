<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>占いアプリ</title>
<script>
function refreshFortune() {
    // Reload the page to generate a new fortune
    location.reload();
}
</script>
</head>
<body>
<button onclick="refreshFortune()">占い</button>
<h1>結果表示</h1>
<p><?php echo getFortune(); ?></p>

<?php
function getFortune() {
    $randomNumber = mt_rand(1, 100);

    if ($randomNumber <= 10) {
        return '今日最高';
    } elseif ($randomNumber <= 40) {
        return 'そこそこ';
    } elseif ($randomNumber <= 80) {
        return 'まあまあ';
    } else {
        return 'Bad';
    }
}
?>
</body>
</html>
