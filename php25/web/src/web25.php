
<form method="post">
    <label for="rss_feed">ニュースリーダー:</label><br>
    <input type="radio" name="rss_feed" id="rss_feed1" value="Yahoo Japan"> <label for="rss_feed1"> Yahoo! Japan</label>
    <input type="radio" name="rss_feed" value="NHKニュース"> NHKニュース
    <input type="radio" name="rss_feed" value="ITメディア"> ITメディア
    <br><br>
    <input type="submit" value="送信">
</form>
<?php
$feeds = [
    'Yahoo Japan' => 'https://news.yahoo.co.jp/rss/topics/top-picks.xml',
    'NHKニュース' => 'https://www.nhk.or.jp/rss/news/cat0.xml',
    'ITメディア' => 'https://rss.itmedia.co.jp/rss/2.0/itmedia_all.xml'
];

// Function to fetch and display RSS feed
function displayRSS($feed_url) {
    // Load the RSS feed
    $xml = simplexml_load_file($feed_url);
    
    // Check if the feed loaded successfully
    if ($xml) {
        echo '<table border="1">';
        echo '<tr><th>タイトル</th><th>説明</th><th>リンク</th></tr>';

        foreach ($xml->channel->item as $item) {
            
            if (!empty($item->description)) {
                echo '<tr>';
                echo '<td>' . $item->title . '</td>';
                echo '<td>' . $item->description . '</td>';
                echo '<td><a href="' . $item->link . '" target="_blank">続きを読む</a></td>';
                echo '</tr>';
            } else {
                
                echo '<tr>';
                echo '<td>' . $item->title . '</td>';
                echo '<td>説明なし</td>';
                echo '<td><a href="' . $item->link . '" target="_blank">続きを読む</a></td>';
                echo '</tr>';
            }
        }
        echo '</table>';
    } else {
        echo 'RSSフィードの読み込みに失敗しました。';
    }
}

// Handle user input
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selected_feed = $_POST['rss_feed'];
    if (isset($feeds[$selected_feed])) {
        echo "<h2>ニュース一覧 - $selected_feed</h2>";
        displayRSS($feeds[$selected_feed]);
    } else {
        echo 'フィードが選択されていません。';
    }
}
?>


