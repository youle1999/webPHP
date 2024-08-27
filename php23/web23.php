<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>大阪府 - 郵便番号検索</title>
</head>
<body>

<h2>大阪府 - 郵便番号検索</h2>

<form method="POST" action="">
    <label for="postal_code_1">郵便番号:</label>
    <input type="text" name="postal_code_1" id="postal_code_1" maxlength="3" size="3" value="<?= isset($postal_code_1) ? htmlspecialchars($postal_code_1, ENT_QUOTES, 'UTF-8') : (isset($_POST['postal_code_1']) ? htmlspecialchars($_POST['postal_code_1'], ENT_QUOTES, 'UTF-8') : ''); ?>"> -
    <input type="text" name="postal_code_2" id="postal_code_2" maxlength="4" size="4" value="<?= isset($postal_code_2) ? htmlspecialchars($postal_code_2, ENT_QUOTES, 'UTF-8') : (isset($_POST['postal_code_2']) ? htmlspecialchars($_POST['postal_code_2'], ENT_QUOTES, 'UTF-8') : ''); ?>">
    <input type="submit" name="search_by_zip" value="検索">
    <br><br>
    <label for="city_name">市区町村名:</label>
    <input type="text" name="city_name" id="city_name" value="<?= isset($city_name_result) ? htmlspecialchars($city_name_result, ENT_QUOTES, 'UTF-8') : (isset($_POST['city_name']) ? htmlspecialchars($_POST['city_name'], ENT_QUOTES, 'UTF-8') : ''); ?>">
    <br><br>
    <label for="area_name">地名:</label>
    <input type="text" name="area_name" id="area_name" value="<?= isset($area_name_result) ? htmlspecialchars($area_name_result, ENT_QUOTES, 'UTF-8') : (isset($_POST['area_name']) ? htmlspecialchars($_POST['area_name'], ENT_QUOTES, 'UTF-8') : ''); ?>">
    <input type="submit" name="search_by_name" value="検索">
</form>

<?php
$zip_code_result = '';
$city_name_result = '';
$area_name_result = '';
$postal_code_1 = '';
$postal_code_2 = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $zipFile = "27osaka.zip";
    $csvFile = "27osaka.csv";
    $utf8CsvFile = "osaka_utf8.csv";

    // Download the ZIP file if it doesn't exist
    if (!file_exists($zipFile)) {
        $url = "https://www.post.japanpost.jp/zipcode/dl/oogaki/zip/27osaka.zip";
        file_put_contents($zipFile, fopen($url, 'r'));
    }

    // Extract the CSV file if it doesn't exist
    if (!file_exists($csvFile)) {
        $zip = new ZipArchive;
        if ($zip->open($zipFile) === TRUE) {
            $zip->extractTo('.');
            $zip->close();
            echo 'CSV extracted successfully!<br>';
        } else {
            echo 'Failed to extract CSV!<br>';
        }
    }

    // Convert the CSV file encoding from Shift-JIS to UTF-8
    if (!file_exists($utf8CsvFile)) {
        $csvContent = mb_convert_encoding(file_get_contents($csvFile), "UTF-8", "SJIS");
        file_put_contents($utf8CsvFile, $csvContent);
    }

    // Open the CSV file and search
    if (($handle = fopen($utf8CsvFile, "r")) !== FALSE) {
        if (isset($_POST['search_by_zip'])) {
            // Search by ZIP code
            $postal_code_1 = $_POST['postal_code_1'];
            $postal_code_2 = $_POST['postal_code_2'];
            $postal_code = $postal_code_1 . $postal_code_2;

            $found = false;
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if (strpos($data[2], $postal_code) === 0) {
                    $city_name_result = $data[7];
                    $area_name_result = $data[8];
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                echo "郵便番号が見つかりませんでした。<br>";
            }
        } elseif (isset($_POST['search_by_name'])) {
            // Search by city/area name
            $city_name = $_POST['city_name'];
            $area_name = $_POST['area_name'];

            $found = false;
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if (strpos($data[7], $city_name) !== false && strpos($data[8], $area_name) !== false) {
                    $zip_code_result = $data[2];
                    $postal_code_1 = substr($zip_code_result, 0, 3);
                    $postal_code_2 = substr($zip_code_result, 3, 4);
                    $city_name_result = $city_name;
                    $area_name_result = $area_name;
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                echo "市区町村名または地名が見つかりませんでした。<br>";
            }
        }
        fclose($handle);
    } else {
        echo "Failed to open the CSV file.<br>";
    }
}
?>

<script>
    // Populate the fields with search results
    document.getElementById('postal_code_1').value = "<?= htmlspecialchars($postal_code_1, ENT_QUOTES, 'UTF-8'); ?>";
    document.getElementById('postal_code_2').value = "<?= htmlspecialchars($postal_code_2, ENT_QUOTES, 'UTF-8'); ?>";
    document.getElementById('city_name').value = "<?= htmlspecialchars($city_name_result, ENT_QUOTES, 'UTF-8'); ?>";
    document.getElementById('area_name').value = "<?= htmlspecialchars($area_name_result, ENT_QUOTES, 'UTF-8'); ?>";
</script>

</body>
</html>
