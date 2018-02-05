<?php header("Content-type: text/xml");
echo '<?xml version = "1.0" encoding = "UTF-8"?>'?>
<rss version = "2.0">
<channel>
<title>Polahoda</title>
<link><?=base_url()?></link>
<description>Pozitivní noviny do každé rodiny</description>
<language>cz</language>

<?php foreach($feeds as $item):?>

<item>
    <title><?= str_replace("&", "и", $item['title']); ?></title>
    <link><?=base_url($item['url']);?></link>
    <description><?= str_replace("&", "и", $item['anons']); ?></description>
</item>

<?php endforeach;?>

</channel>
</rss>