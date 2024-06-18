<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>アスペクト比計算</title>
</head>
<body>
    <h1>アスペクト比計算</h1>
    <form method="post">
        
        横: <input type="text" name="width" required> <br>
        縦: <input type="text" name="height" required> <br>
        <input type="submit" value="計算">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Function to calculate the greatest common divisor (GCD) using Euclidean algorithm
        function gcd($a, $b) {
            return ($b == 0) ? $a : gcd($b, $a % $b);
        }

        // Get the input values from the form
        $width = intval($_POST['width']);
        $height = intval($_POST['height']);
        
        // Check if the inputs are valid numbers
        if ($width > 0 && $height > 0) {
            // Calculate the GCD of width and height
            $gcd_value = gcd($width, $height);
            
            // Calculate the aspect ratio
            $aspect_ratio_width = $width / $gcd_value;
            $aspect_ratio_height = $height / $gcd_value;
            
            // Display the aspect ratio
            echo "<h2>アスペクト比計算結果</h2>";
            echo "アスペクト比: $aspect_ratio_width : $aspect_ratio_height";
        } else {
            echo "<h2 style='color: #e74c3c;'>入力された値が正しくありません。</h2>";
        }
    }
    ?>
</body>
</html>
