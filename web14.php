<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Palindrome Checker</title>
</head>
<body>
    <form method="post">
        <label for="inputText">入力：</label>
        <input type="text" id="inputText" name="inputText" value="<?php if (isset($_POST['inputText'])) echo htmlspecialchars($_POST['inputText'], ENT_QUOTES, 'UTF-8'); ?>">
        <input type="submit" value="判定">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $inputText = $_POST['inputText'];

        // Function to check if a string is a palindrome
        function isPalindrome($str) {
            // Normalize the string by removing spaces and converting to lowercase
            $normalizedStr = mb_strtolower(preg_replace('/\s+/u', '', $str), 'UTF-8');

            // Reverse the string
            $reversedStr = mb_strrev($normalizedStr);

            // Check if the normalized string is equal to its reverse
            return $normalizedStr === $reversedStr;
        }

        // Function to reverse a multibyte string
        function mb_strrev($str) {
            $r = '';
            for ($i = mb_strlen($str, 'UTF-8') - 1; $i >= 0; $i--) {
                $r .= mb_substr($str, $i, 1, 'UTF-8');
            }
            return $r;
        }

        // HTML escape the input text
        $escapedInputText = htmlspecialchars($inputText, ENT_QUOTES, 'UTF-8');

        // Determine if the input text is a palindrome
        if (isPalindrome($inputText)) {
            echo "<p>結果表示</p>";
            echo "<p>「{$escapedInputText}」は回文です。</p>";
        } else {
            echo "<p>結果表示</p>";
            echo "<p>「{$escapedInputText}」は回文ではありません。</p>";
        }
    }
    ?>
</body>
</html>
