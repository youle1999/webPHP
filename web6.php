<?php
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $moneyOwned = filter_input(INPUT_POST, 'money_owned', FILTER_VALIDATE_INT);
    $moneyCanBorrow = filter_input(INPUT_POST, 'money_can_borrow', FILTER_VALIDATE_INT);
    $bookPrice = filter_input(INPUT_POST, 'book_price', FILTER_VALIDATE_INT);

    if ($moneyOwned !== false && $moneyCanBorrow !== false && $bookPrice !== false) {
        if ($moneyOwned >= $bookPrice) {
            $message = '借りずに購入できます。'; 
        } elseif ($moneyOwned + $moneyCanBorrow >= $bookPrice) {
            $borrowAmount = $bookPrice - $moneyOwned;
            $message = "借りる金額 は{$borrowAmount}円です。"; 
        } else {
            $message = '購入できません。'; 
        }
    } else {
        $message = '無効な入力です。'; 
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Book Purchase Calculation</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="money_owned">所持金:</label>
        <input type="number" id="money_owned" name="money_owned" placeholder="所持金を入力"><br>

        <label for="money_can_borrow">借りられる金額:</label>
        <input type="number" id="money_can_borrow" name="money_can_borrow" placeholder="借りられる金額を入力"><br>

        <label for="book_price">本の価格:</label>
        <input type="number" id="book_price" name="book_price" placeholder="本の価格を入力"><br>

        <input type="submit" value="表示">
    </form>

    <?php if (!empty($message)): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>
</body>
</html>
