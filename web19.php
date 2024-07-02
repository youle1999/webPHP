<?php
// Redirect to page 1 if no page parameter is provided
if (!isset($_GET['page'])) {
    header("Location: ?page=1");
    exit();
}

// Get the current page from the URL, defaulting to 1 if not set
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Function to generate page links
function generatePageLinks($currentPage, $totalPages) {
    $links = "";
    for ($i = 1; $i <= $totalPages; $i++) {
        if ($i == $currentPage) {
            $links .= " $i ";
        } else {
            $links .= " <a href='?page=$i'>$i</a> ";
        }
    }
    return $links;
}

// Display the appropriate content based on the page parameter
if ($page >= 1 && $page <= 5) {
    echo "ページ{$page}の画面";
    echo "<br>";
    echo generatePageLinks($page, 5);
} else {
    echo "ページはありません";
}
?>
