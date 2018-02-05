<div class="row">
    <div class="col-md-9">
        <?php if($info['img_url'] != ''):?>
        <div class="margin-bottom-20">
            <img src="<?php echo base_url().'assets/uploads/images/sections/'.$info['img_url'];?>" />
            <div class="clear"></div>
            <br />
            <?php echo $content['text'];?>
        </div>
        <?php endif;?>
        <div class="headline">
            <?php foreach($materials as $material):?>


            <div class="blog margin-bottom-40">
                <h2><a href="<?php echo base_url().$lang.$material['url'];?>"><?php echo $material['title'];?></a></h2>
                <div class="blog-post-tags">
                    <ul class="list-unstyled list-inline blog-info">
                        <li><i class="fa fa-calendar fa-lg"></i> <?php echo date('d.m.Y', strtotime($material['date']));?></li>
                        <li><i class="fa fa-eye fa-lg"></i> <?php echo $material['count_views'];?></li>
                        <li>
                            <i class="fa fa-heart-o fa-lg"></i> <?php echo $material['likes'];?>
                        </li>
                        <li><i class="fa fa-comments fa-lg"></i> <a href="<?php echo base_url().$lang.$material['url'].'#media-comments';?>"> <?php echo $material['comments_num'];?></a></li>
                        <?php if($material['author_name'] != ''):?>
                        <li>
    						<i class="fa fa-user fa-lg"></i> <a href="<?php echo base_url('author/id_'.$material['author_id']);?>"><?php echo $material['author_name'];?></a>
    					</li>
                        <?php endif;?>
                    </ul>
                    <?php if($material['keywords'] != ''):?>
                    <ul class="list-unstyled list-inline blog-tags">
                        <li>
                            <i class="fa fa-tags fa-lg"></i>
                            <?php $tags = explode( ',', $material['keywords']);?>
                            <?php foreach($tags as $tag):?>
                            <a href="<?php echo base_url('tagsearch');?>?send_tagsearch=<?php echo trim($tag);?>"><?php echo trim($tag);?></a>
                            <?php endforeach;?>
                        </li>
                    </ul>
                    <?php endif;?>
                </div>
                <div class="blog-img">
                    <?php if($material['img_url'] != ''):?>
                    <div class="responsive-image">
                        <a href="<?php echo base_url().$lang.$material['url'];?>">
                            <img class="img-responsive" src="<?php echo base_url().'assets/uploads/images/materials/'.$material['img_url'];?>" alt="<?php echo $content['title'];?>" />
                        </a>
                    </div>
                    <?php elseif($material['video_url'] != ''):?>
                    <div class="responsive-video">
                        <?php echo $material['video_url'];?>
                    </div>
                    <?php endif;?>
                </div>
                <p><?php echo $material['anons'];?></p>
                <p><a class="btn-u btn-u-small" href="<?php echo base_url().$lang.$material['url'];?>"><i class="fa fa-location-arrow fa-lg"></i> <?php echo $this->lang->line('material_readmore');?></a></p>
            </div>


            <?php endforeach;?>

            <?php echo $page_nav;?>
        </div>

        <hr />
        <script type="text/javascript">(function() {
                if (window.pluso)if (typeof window.pluso.start == "function") return;
                if (window.ifpluso==undefined) { window.ifpluso = 1;
                    var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
                    s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
                    s.src = ('https:' == window.location.protocol ? 'https' : 'http')  + '://share.pluso.ru/pluso-like.js';
                    var h=d[g]('body')[0];
                    h.appendChild(s);
                }})();
        </script>
        <div class="pluso" data-background="none;" data-options="medium,square,line,horizontal,counter,sepcounter=1,theme=14" data-services="facebook,twitter,google,linkedin,livejournal,pinterest,print,email"></div>
        <div class="clearfix"></div>
        <hr />

    </div>
    <div class="col-md-3">
        <div class="farewell">
            <div class="farewell-tale">
                <span class="farewell_title"><?php echo $this->lang->line('farewell');?></span><br />
                <p><span class="farewell_quote">“</span><?php echo $this->farewell['text'];?></p>
            </div>
        </div>
        <div class="clearfix"></div>
        <br />
        
        <div class="title_right"><?php echo $this->lang->line('calendar');?></div>
        <div id="mini-calendar"></div>
        <div class="clearfix"></div>
        <br />
    
        <?php foreach($this->modules as $module):?>
            <!--<div class="headline">
                <p class="lead"><?php /*echo $module['title'];*/?></p>
            </div>-->
            <?php echo $module['text'];?>
            <!--<br />-->
        <?php endforeach;?>

        <?php

            foreach($this->banners as $banner):

                if($banner['position'] == '1'){

                    $image = '<img class="img-responsive" src="'.base_url().'assets/uploads/images/banners/'.$banner['img_url'].'" alt="'.$banner['title'].'" title="'.$banner['title'].'" >';
                    echo '<div class="right_banner"><a href="'.$banner['link'].'" target="_blank">'.$image.'</a></div>';
                    // do something

                }

            endforeach;?>
    </div>
</div>