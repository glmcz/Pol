<?php header("Content-type: text/xml");
echo '<?xml version = "1.0" encoding = "UTF-8"?>'?>
<rss version = "2.0">

    <channel>
        <title><?php echo SITE_NAME;?></title>
        <link><?=base_url()?></link>
        <description><?php echo $this->lang->line('no_title');?></description>
        <language><?php echo LANGUAGE.'-'.LANGUAGE;?></language>
        <image>
            <url><?php echo base_url('assets/template/img/logoru.png')?></url>
            <title><?php echo SITE_NAME;?></title>
            <link><?php echo base_url()?></link>
        </image>
        <lastBuildDate><?php echo date('D, d M Y h:m:i O');?></lastBuildDate>
        <?php foreach($feeds as $item):?>
        <item>
            <title><?= str_replace("&", "и", $item['title']); ?></title>
            <link><?=base_url($item['url']);?></link>
            <?php if($item['img_url'] != ''):?>
                <description><![CDATA[<img align="left" hspace="5" src="<?php echo base_url('assets/uploads/images/materials/'.$item['img_url'])?>"/><?php echo str_replace("&", "и", $item['anons']); ?>]]></description>
            <?php else:?>
                <description><![CDATA[<?php echo str_replace("&", "и", $item['anons']); ?>]]></description>
            <?php endif;?>
            <pubDate><?php echo date('D, d M Y h:m:i O', strtotime($item['date']));?></pubDate>
            <guid isPermaLink="true"><?php echo base_url($item['url']);?></guid>
        </item>
        <?php endforeach;?>
    </channel>
</rss>