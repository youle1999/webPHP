<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>色の組み合わせ</title>
</head>
<body>
    
    <form method="post">
        <label><input type="checkbox" name="colors[]" value="赤" <?php if (isset($_POST['colors']) && in_array('赤', $_POST['colors'])) echo 'checked'; ?>>赤</label>
        <label><input type="checkbox" name="colors[]" value="緑" <?php if (isset($_POST['colors']) && in_array('緑', $_POST['colors'])) echo 'checked'; ?>>緑</label>
        <label><input type="checkbox" name="colors[]" value="青" <?php if (isset($_POST['colors']) && in_array('青', $_POST['colors'])) echo 'checked'; ?>>青</label>
        <br>
        <button type="submit">作れる色</button>
    </form>

    <?php
    function getResultColor($selectedColors) {
        $count = count($selectedColors);
        
        if ($count == 0) {
            return '黒';
        } elseif ($count == 1) {
            return $selectedColors[0];
        } elseif ($count == 2) {
            if (in_array('赤', $selectedColors) && in_array('緑', $selectedColors)) {
                return '黄';
            } elseif (in_array('赤', $selectedColors) && in_array('青', $selectedColors)) {
                return 'マゼンタ';
            } elseif (in_array('緑', $selectedColors) && in_array('青', $selectedColors)) {
                return 'シアン';
            }
        } elseif ($count == 3) {
            return '白';
        }
        
        return '黒';
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $selectedColors = isset($_POST['colors']) ? $_POST['colors'] : [];
        $resultColor = getResultColor($selectedColors);

        echo '<h2>結果表示</h2>';
        echo '<p>作れる色は: ' . htmlspecialchars($resultColor, ENT_QUOTES, 'UTF-8') . '</p>';
    }
    ?>
</body>
</html>
