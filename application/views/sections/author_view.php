<div class="row">
    <div class="col-md-9">

        <div class="headline">

            <?php foreach($materials as $material):?>
            <div class="row blog blog-medium margin-bottom-40">
                <div class="col-md-4">
                    <a href="<?php echo base_url().$lang.$material['url'];?>">
                        <img class="img-responsive" src="<?php echo base_url().'assets/uploads/images/materials/thumbs/'.$material['img_url'];?>" alt="<?php echo $content['title'];?>" />
                    </a>
                </div>
                <div class="col-md-8">
                  <h2 class="blog-title"><a href="<?php echo base_url().$lang.$material['url'];?>"><?php echo $material['title'];?></a></h2>
                  <ul class="list-unstyled list-inline blog-info">
                    <li>
                      <i class="fa fa-calendar fa-lg"></i>
                      <?php echo date('d.m.Y', strtotime($material['date']));?>
                    </li>
                    <li>
                      <i class="fa fa-comments fa-lg"></i>
                      <?php echo $this->lang->line('material_comments');?>: <a href="<?php echo base_url().$lang.$material['url'].'#media-comments';?>"><?php echo $material['comments_num'];?></a>
                    </li>
                    <li>
                        <?php echo $this->lang->line('material_likes');?> <i class="fa fa-heart-o fa-lg"></i> <?php echo $material['likes'];?>
                    </li>
                    <li>
                        <i class="fa fa-eye fa-lg"></i>
                        <?php echo $this->lang->line('material_views');?>: <?php echo $material['count_views'];?>
                    </li>
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
                  <p><?php echo $material['anons'];?></p>
                  <p>
                    <a class="btn-u btn-u-small" href="<?php echo base_url().$lang.$material['url'];?>">
                      <i class="fa fa-location-arrow fa-lg"></i>
                      <?php echo $this->lang->line('material_readmore');?>
                    </a>
                  </p>
                </div>
            </div>
            <hr />
            <?php endforeach;?>

            <?php echo $page_nav;?>

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