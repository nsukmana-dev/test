<?php
require('dom.php');

// $html = 'https://m.bnizona.com/category/index/promo';
$html = file_get_html('https://www.youtube.com/feed/trending');

$videos = [];

$i = 1;
foreach ($html->find('li.expanded-shelf-content-item-wrapper') as $video) {
        if ($i > 10) {
                break;
        }

        $videoDetails = $video->find('a.yt-uix-tile-link', 0);

        $videoTitle = $videoDetails->title;

        $videoUrl = 'https://youtube.com' . $videoDetails->href;

        $videos[] = [
                'title' => $videoTitle,
                'url' => $videoUrl
        ];

        $i++;
}
print("<pre>".print_r($videos,true)."</pre>");

 ?>
