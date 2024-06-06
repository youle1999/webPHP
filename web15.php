<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>面積計算</title>
</head>
<body>
    <h1>面積計算</h1>
    <form method="post">
        <input type="radio" name="shape" value="rectangle" <?php if(isset($_POST['shape']) && $_POST['shape'] == 'rectangle') echo 'checked'; ?>> 四角形
        <input type="radio" name="shape" value="triangle" <?php if(isset($_POST['shape']) && $_POST['shape'] == 'triangle') echo 'checked'; ?>> 三角形
        <input type="radio" name="shape" value="trapezoid" <?php if(isset($_POST['shape']) && $_POST['shape'] == 'trapezoid') echo 'checked'; ?>> 台形
        <input type="radio" name="shape" value="circle" <?php if(isset($_POST['shape']) && $_POST['shape'] == 'circle') echo 'checked'; ?>> 円
        <br><br>

        <label for="base">底辺: </label>
        <input type="text" name="base" id="base" value="<?php echo isset($_POST['base']) ? $_POST['base'] : ''; ?>"> cm
        <br><br>

        <label for="height">高さ: </label>
        <input type="text" name="height" id="height" value="<?php echo isset($_POST['height']) ? $_POST['height'] : ''; ?>"> cm
        <br><br>

        <label for="top">上底: </label>
        <input type="text" name="top" id="top" value="<?php echo isset($_POST['top']) ? $_POST['top'] : ''; ?>"> cm
        <br><br>

        <label for="radius">半径: </label>
        <input type="text" name="radius" id="radius" value="<?php echo isset($_POST['radius']) ? $_POST['radius'] : ''; ?>"> cm
        <br><br>

        <input type="submit" value="計算">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $shape = $_POST['shape'];
        $base = isset($_POST['base']) ? $_POST['base'] : 0;
        $height = isset($_POST['height']) ? $_POST['height'] : 0;
        $top = isset($_POST['top']) ? $_POST['top'] : 0;
        $radius = isset($_POST['radius']) ? $_POST['radius'] : 0;

        // Validate inputs
        if (!is_numeric($base) && $base != '') {
            echo "底辺は数値で入力してください。";
            exit;
        }
        if (!is_numeric($height) && $height != '') {
            echo "高さは数値で入力してください。";
            exit;
        }
        if (!is_numeric($top) && $top != '') {
            echo "上底は数値で入力してください。";
            exit;
        }
        if (!is_numeric($radius) && $radius != '') {
            echo "半径は数値で入力してください。";
            exit;
        }

        $area = 0;
        switch ($shape) {
            case 'rectangle':
                if ($base > 0 && $height > 0) {
                    $area = $base * $height;
                } else {
                    echo "四角形: 底辺と高さを正しく入力してください。";
                    exit;
                }
                break;
            case 'triangle':
                if ($base > 0 && $height > 0) {
                    $area = ($base * $height) / 2;
                } else {
                    echo "三角形: 底辺と高さを正しく入力してください。";
                    exit;
                }
                break;
            case 'trapezoid':
                if ($base > 0 && $top > 0 && $height > 0) {
                    $area = (($base + $top) * $height) / 2;
                } else {
                    echo "台形: 底辺、上底と高さを正しく入力してください。";
                    exit;
                }
                break;
            case 'circle':
                if ($radius > 0) {
                    $area = 3.14 * ($radius * $radius);
                } else {
                    echo "円: 半径を正しく入力してください。";
                    exit;
                }
                break;
            default:
                echo "図形を選択してください。";
                exit;
        }

        echo "<h2>面積: $area cm<sup>2</sup></h2>";
    }
    ?>
</body>
</html>
