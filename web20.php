<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>画像ファイルのアップロード</title>
</head>
<body>
    <?php
    // Enable error reporting for debugging
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Directory to save uploaded images
        $target_dir = "images/";

        // Ensure the images directory exists
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        // Check if file is uploaded
        if (isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] != UPLOAD_ERR_NO_FILE) {
            $file = $_FILES['fileToUpload'];
            $fileName = basename($file['name']);
            $fileTmpName = $file['tmp_name'];
            $fileType = mime_content_type($fileTmpName);

            // Check if the file is an image
            if ($fileType && strpos($fileType, 'image') !== false) {
                // Add date and time to the file name
                $date = new DateTime();
                $timestamp = $date->format('YmdHis');
                $target_file = $target_dir . 'img_' . $timestamp . '.' . pathinfo($fileName, PATHINFO_EXTENSION);

                // Move the uploaded file to the target directory
                if (move_uploaded_file($fileTmpName, $target_file)) {
                    echo "<p style='color: green;'>アップロードしました。</p>";
                    echo "<p>保存先: $target_file</p>";
                } else {
                    echo "<p style='color: red;'>ファイルのアップロードに失敗しました。</p>";
                }
            } else {
                echo "<p style='color: red;'>画像ファイルではありません。</p>";
            }
        } else {
            echo "<p style='color: red;'>画像ファイルではありません。</p>";
        }
    }
    ?>

    <form action="" method="post" enctype="multipart/form-data">
        <label for="fileToUpload">ファイルを選択:</label>
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="アップロード" name="submit">
    </form>
</body>
</html>
