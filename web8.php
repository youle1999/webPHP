<?php
$resultDate = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputDate = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING);

    $date = $_POST['date'] ?? '';
    list($year,$month,$day) = explode('-',$date);
    $leap_year = ($year%4 == 0 && ($year%100 != 0 || $year%400 ==0)) ? true : false;
    if ($month==4 || $month==6 || $month==9 || $month==11) {
        $month_length = 30;
    } else if ($month==2) {
      if ($leap_year) {
        $month_length = 29;
      } else {
        $month_length = 28;
      }
    } else {
        $month_length = 31;
    }
    if ($day < $month_length) {
        $day+=1;
    }else {
      $day = 1;
      if ($month==12) {
        $month = 1;
        $year+=1;
      } else {
        $month+=1;
      }
    }
    $resultDate = '次の日は「'.$year.'年'.$month.'月'.$day.'日」';

//    $dateTime = new DateTime($inputDate);
    
    
//    $dateTime->modify('+1 day');
//    $resultDate = $dateTime->format('Y-m-d');
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Next Day Calculator</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="date">年月日:</label>
        <input type="date" id="date" name="date">
        <input type="submit" value="表示">
    </form>

    <?php if (!empty($resultDate)): ?>
        <p>次の日は: <?php echo $resultDate; ?></p>
    <?php endif; ?>
</body>
</html>
