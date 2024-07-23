<?php
$imagesDir = 'images';
$images = glob($imagesDir . '/*.{jpg,jpeg,png,gif}', GLOB_BRACE);
$imagesPerPage = 2;
$totalImages = count($images);
$totalPages = ceil($totalImages / $imagesPerPage);

// Get the current page or set default to 1
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Calculate the offset for the current page
$offset = ($currentPage - 1) * $imagesPerPage;

// Slice the array of images to get the images for the current page
$currentImages = array_slice($images, $offset, $imagesPerPage);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ギャラリー</title>
    <style>
        .gallery {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .gallery img {
            max-width: 100%;
            height: auto;
        }
        .pagination {
            margin-top: 20px;
        }
        .pagination a {
            margin: 0 5px;
            text-decoration: none;
            padding: 5px 10px;
            border: 1px solid #ccc;
        }
        .pagination a.active {
            background-color: #000;
            color: #fff;
        }
    </style>
</head>
<body>
    <h1>ギャラリー</h1>

    <?php if ($totalImages > 0): ?>
        <div class="gallery">
            <?php foreach ($currentImages as $image): ?>
                <div>
                    <img src="<?php echo $image; ?>" alt="Gallery Image">
                </div>
            <?php endforeach; ?>
        </div>

        <?php if ($totalPages > 1): ?>
            <div class="pagination">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?page=<?php echo $i; ?>" class="<?php echo ($i == $currentPage) ? 'active' : ''; ?>">
                        <?php echo $i; ?>
                    </a>
                <?php endfor; ?>
            </div>
        <?php endif; ?>
    <?php else: ?>
        <p>画像はまだありません。</p>
    <?php endif; ?>
</body>
</html>
