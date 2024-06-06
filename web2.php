<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>占いアプリ</title>
<script>
function submitForm() {
    // Submit the form
    document.getElementById("fortuneForm").submit();
}

function refreshFortune() {
    // Get the value of the input field
    var name = document.getElementById("name").value;

    // Set the fortune text with the user's name
    document.getElementById("fortune").innerHTML = 'Your fortune for ' + (name.trim() ? htmlspecialchars(name) : 'today') + ' is: ' + getFortune(name);
}
</script>
</head>
<body>
<form id="fortuneForm" method="POST" onsubmit="event.preventDefault(); refreshFortune();">
    <label for="name">お名前：</label>
    <input type="text" id="name" name="name"><br><br>
    <input type="submit" value="占い" onclick="submitForm()">
</form>
<h1>結果表示</h1>
<p id="fortune"> <?php echo htmlspecialchars(isset($_POST['name']) ? $_POST['name'] : 'today', ENT_QUOTES, 'UTF-8'); ?> の運勢: <?php echo htmlspecialchars(getFortune(isset($_POST['name']) ? $_POST['name'] : null), ENT_QUOTES, 'UTF-8'); ?></p>

<?php
function getFortune($name) {
    $randomNumber = mt_rand(1, 100);
    if ($randomNumber <= 10) {
        return '今日は最高！';
    } elseif ($randomNumber <= 40) {
        return '今日はそこそです';
    } elseif ($randomNumber <= 80) {
        return '今日はまぁまぁ';
    } else {
        return '今日は最悪・・・';
    }
}
?>
</body>
</html>

