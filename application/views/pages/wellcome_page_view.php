<div class="row">
    <div class="col-md-9">
        <?php $this->load->view('slider_view');?>
        <div class="clearfix"></div>
        <br />
        <!-- Latest news -->
        <div class="title">
            <a href="<?php echo base_url($lang.'all');?>"><?php echo $this->lang->line('latest_news');?></a>
            <a href="<?php echo base_url($lang.'all');?>" class="btn btn-info btn-xs pull-right"><?php echo $this->lang->line('all_materials');?></a>
        </div>
        <div class="latest_news">
            <div class="row">
            <?php $ln = 1; foreach($latest_news as $new):?>
            
            <?php if($ln%2 != 0):?>

            <?php endif;?>
            
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <p>
                    <span class="latest_news_img">
                        <a href="<?php echo base_url($lang.$new['material']['url']);?>">
                            <img class="img-responsive" src="<?php echo base_url('assets/uploads/images/materials/thumbs/'.$new['material']['img_url']);?>" />
                        </a>
                    </span>
                    <div>
                    <a href="<?php echo base_url($lang.$new['material']['url']);?>"><?php echo $new['material']['title'];?></a>  
                    <span class="latest_news_date"><?php echo date('d.m.Y H:i', strtotime($new['material']['date']));?></span> 
                    <span class="latest_news_section"><a href="<?php echo base_url($lang.$new['section']['url']);?>"><?php echo $new['section']['title'];?></a></span>
                    </div>
                </p>
                </div>
            <?php if($ln%2 == 0):?>
            <div class="clearfix"></div>
            <br />
            <?php endif;?>

            <?php $ln++; endforeach;?>
            </div>
        </div>
        <!-- End. Latest news -->
        
        <?php if(count($top_weeks) != 0 && count($top_months) != 0 && count($top_years) != 0):?>
        
        <!-- Top materials -->
        <div class="title"><?php echo $this->lang->line('top_materials');?></div>
        
        <div class="top_materials" role="tabpanel">

          <!-- Nav tabs -->
          <ul class="nav nav-tabs" role="tablist">
            <?php if(count($top_weeks)>0):?>
            <li role="presentation" class="active"><a href="#top_materials_week" aria-controls="top_materials_week" role="tab" data-toggle="tab"><?php echo $this->lang->line('top_materials_week');?></a></li>
            <?php endif;?>
            <?php if(count($top_months)>0):?>
            <li role="presentation <?php if(count($top_weeks) == 0):?>active<?php endif;?>"><a href="#top_materials_month" aria-controls="top_materials_month" role="tab" data-toggle="tab"><?php echo $this->lang->line('top_materials_month');?></a></li>
            <?php endif;?>
            <?php if(count($top_years)>0):?>
            <li role="presentation <?php if(count($top_months) == 0):?>active<?php endif;?>"><a href="#top_materials_year" aria-controls="top_materials_year" role="tab" data-toggle="tab"><?php echo $this->lang->line('top_materials_year');?></a></li>
            <?php endif;?>
          </ul>
        
          <!-- Tab panes -->
          <div class="tab-content">
            <?php if(count($top_weeks)>0): ?>
            <div role="tabpanel" class="tab-pane active" id="top_materials_week">
                
                <div class="top_weeks">
                    <div class="row">
                    <?php foreach($top_weeks as $top_week):?>
                    
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <p>
                            <a href="<?php echo base_url($lang.$top_week['material']['url']);?>"><?php echo $top_week['material']['title'];?></a> 
                            <span class="latest_news_counts"><?php echo '('.$top_week['material']['count_views'].')';?></span>  
                            <span class="latest_news_date"><em><small><?php echo date('d.m.Y H:i', strtotime($top_week['material']['date']));?></small></em></span> 
                        </p>
                        </div>
        
        
                    <?php endforeach;?>
                    </div>
                </div>
                
            </div>
            <?php endif;?>
            
            <?php if(count($top_months)>0): ?>
            <div role="tabpanel" class="tab-pane <?php if(count($top_weeks) == 0):?>active<?php endif;?>" id="top_materials_month">
                <div class="top_months">
                    <div class="row">
                    <?php foreach($top_months as $top_month):?>
                    
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <p>
                            <a href="<?php echo base_url($lang.$top_month['material']['url']);?>"><?php echo $top_month['material']['title'];?></a> 
                            <span class="latest_news_counts"><?php echo '('.$top_month['material']['count_views'].')';?></span>  
                            <span class="latest_news_date"><em><?php echo date('d.m.Y H:i', strtotime($top_month['material']['date']));?></em></span> 
                        </p>
                        </div>
        
        
                    <?php endforeach;?>
                    </div>
                </div>
            </div>
            <?php endif;?>
            
            <?php if(count($top_years)>0): ?>
            <div role="tabpanel" class="tab-pane <?php if(count($top_months) == 0):?>active<?php endif;?>" id="top_materials_year">
                <div class="top_years">
                    <div class="row">
                    <?php foreach($top_years as $top_year):?>
                    
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <p>
                            <a href="<?php echo base_url($lang.$top_year['material']['url']);?>"><?php echo $top_year['material']['title'];?></a> 
                            <span class="latest_news_counts"><?php echo '('.$top_year['material']['count_views'].')';?></span>  
                            <span class="latest_news_date"><em><?php echo date('d.m.Y H:i', strtotime($top_year['material']['date']));?></em></span> 
                        </p>
                        </div>
        
        
                    <?php endforeach;?>
                    </div>
                </div>
            </div>
          </div>
          <?php endif;?>
        
        </div>
        
        <?php endif;?>
        
        <!-- EOF Top materials -->
        
        <!-- Latest comments -->
        <?php if(!empty($this->main_comments)):?>
        
        <br />
        <div class="title"><?php echo $this->lang->line('latest_comments');?></div>
        
		<div id="comments_mp">
			<div id="media-comments" class="media media-mp">
					
                <?php foreach($this->main_comments as $comment): ?>
                <div class="row">
                    <div class="col-xs-1">
                        <div class="row">
                            <a class="materials_comment_img_wrapper" href="<?php echo base_url($comment->url.'#comment-'.$comment->comment_id);?>">
                                <img class="img-responsive" src="<?php echo base_url('assets/uploads/images/materials/thumbs/'.$comment->img_url);?>" />
                            </a>
                        </div>
                    </div>
                    <div class="col-xs-11">
						<div class="comment">
							<div id="comment-<?php echo $comment->comment_id;?>" class="media-body">
								<a href="<?php echo base_url($comment->url.'#comment-'.$comment->comment_id);?>">
                                    <div class="media-heading">
                                        <span class="materials_comment_title">
                                            <?php echo $comment->title;?>
                                        </span>
    									<span class="comment-author"><i class="fa fa-user"></i> <?php echo $comment->author;?></span>&nbsp;
    									<span class="comment-date"><i class="fa fa-calendar-o"></i> <?php echo date('d.m.Y H:i', strtotime($comment->date));?></span>
    								</div>
    								<div>
    									<p><?php echo strip_tags($comment->comment_text);?></p>
    								</div>
                                </a>
							</div>
						</div>
                    </div>
                </div>
				<?php endforeach ;?>

			</div>
		</div>
        
        <?php endif;?>
        <!-- EOF Latest comments -->
        
        <!-- Latest news by Sections -->
        
        
        <script src="<?php echo base_url().'assets/tinyscrollbar/jquery.tinyscrollbar.min.js'?>"></script>
        <script>
        $(document).ready(function()
        {

            var $scrollbar1 = $("#scrollbar1");
            var $scrollbar2 = $("#scrollbar2");
            var $scrollbar3 = $("#scrollbar3");
            var $scrollbar4 = $("#scrollbar4");
            var $scrollbar5 = $("#scrollbar5");
            var $scrollbar6 = $("#scrollbar6");
            var $scrollbar7 = $("#scrollbar7");
            var $scrollbar8 = $("#scrollbar8");
            var $scrollbar9 = $("#scrollbar9");
            var $scrollbar10 = $("#scrollbar10");
            
            $scrollbar1.tinyscrollbar();
            $scrollbar2.tinyscrollbar();
            $scrollbar3.tinyscrollbar();
            $scrollbar4.tinyscrollbar();
            $scrollbar5.tinyscrollbar();
            $scrollbar6.tinyscrollbar();
            $scrollbar7.tinyscrollbar();
            $scrollbar8.tinyscrollbar();
            $scrollbar9.tinyscrollbar();
            $scrollbar10.tinyscrollbar();

        });
        </script>
        
        <br />
        
        <?php $n = 1; foreach($latest_news_by_sec as $news):?>
        
        <br />
        <?php if(count($news['hot']) > 0 || count($news['latest']) > 0):?>
        <div class="title"><a href="<?php echo base_url($lang.$news['section']['url']);?>"><?php echo $news['section']['title'];?></a></div>
        <?php endif;?>
        <div class="row">
                    <?php if(count($news['hot']) > 0):?>
                    <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                        <div class="hot-news">
                        <?php foreach($news['hot'] as $hot):?>
                            <div class="row">
                                <div class="col-md-3">
                                    <a href="<?php echo base_url($lang.$hot['url']);?>">
                                        <img class="img-responsive" src="<?php echo base_url('assets/uploads/images/materials/thumbs/'.$hot['img_url']);?>" title="<?php echo $hot['title'];?>" alt="<?php echo $hot['title'];?>" />
                                    </a>
                                </div>
                                <div class="col-md-9">
                                    <a href="<?php echo base_url($lang.$hot['url']);?>">
                                        <span class="hot-news-item-date"><?php echo date('d.m.Y H:i', strtotime($hot['date']));?></span><br />
                                        <span class="hot-news-item-title"><?php echo $hot['title'];?></span><br />
                                        <span class="hot-news-item-anons"><?php echo textFunc($hot['anons'],100);?></span>
                                    </a>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <hr />
                        <?php endforeach;?>  
                        </div>  
                    </div>
                    <?php endif;?>
                    
                    <?php if(count($news['latest']) > 0):?>
                    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                        <div class="latest-news">
                            <div class="latest-news-title"><?php echo $this->lang->line('daily_news');?></div>
                            <div id="scrollbar<?php echo $n;?>" class="latest-news-scrollbar">
                                <div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
                                <div class="viewport">
                                    <div class="overview">
                                    <?php foreach($news['latest'] as $latest):?>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <a href="<?php echo base_url($lang.$latest['url']);?>">
                                                    <span class="latest-news-item-title"><?php echo $latest['title'];?></span><br />
                                                    <span class="latest-news-item-anons"><?php echo textFunc($latest['anons'], 80);?></span><br />
                                                </a>
                                            </div>
                                        </div>
                                        <hr />
                                    <?php endforeach;?>
                                    </div>
                                </div>
                            </div>
                            <a class="btn btn-default" href="<?php echo base_url($lang.$news['section']['url']);?>"><?php echo $this->lang->line('daily_news_more');?></a>
                        </div>
                    </div>
                    <?php endif;?>

        </div>
        
        <div class="clearfix"></div>
        <br />
        
        <?php $n++; endforeach;?>
        
        <?php 
        
        function textFunc( $str, $maxLen )
    	{
   	        if ( mb_strlen( $str ) > $maxLen )
    		{
                preg_match( '/^.{0,'.$maxLen.'} .*?/ui', $str, $match );
    		    return $match[0].'...';
    		
            }else {
    		
                return $str;
    		
            }
    	}

        ?>

        
        <!-- End. Latest news by Sections -->
        
        <!-- Photo of the Day -->

        <script src="<?php echo base_url().'assets/masonry/masonry.pkgd.min.js'?>"></script>
        <script src="<?php echo base_url().'assets/masonry/masonry.init.js'?>"></script>

        <br />
        <div class="title"><?php echo $this->lang->line('photos_of_the_day');?></div>
        <div class="postContainer postContent masonry-container masonry masonry-js" data-isotope-options='{ "itemSelector": ".work-masonry-thumb", "masonry": { "columnWidth": 100, "gutter": 10 } }'>
            
            <?php foreach($photos_of_the_day as $section):?>
            
            
            
            <?php $i = 0; foreach($section['children'] as $photo):?>
            
            <?php if(count($section['children'])> 1):?>
            
            <a class="work-archive-thumb-link" href="<?php echo base_url($lang.$section['section']['url']);?>">
                <img src="<?php echo base_url('assets/uploads/images/photos/thumb__'.$photo['img_url']);?>" <?php if($i%2): echo 'width="20%"'; elseif($i%3): echo 'width="10%"'; elseif($i%5): echo 'width="40%"'; elseif($i%7): echo 'width="25%"'; else: echo 'width="20%"'; endif;?> class="work-masonry-thumb masonry-brick">
            </a>
            
            <?php else:?>
            
            <a class="work-archive-thumb-link" href="<?php echo base_url($lang.$section['section']['url']);?>">
                <img src="<?php echo base_url('assets/uploads/images/photos/'.$photo['img_url']);?>" width="auto" class="work-masonry-thumb masonry-brick">
            </a>
            
            <?php endif;?>
            
            <?php $i++; endforeach;?>
            
            <?php endforeach;?>

        </div>
        <div class="clearfix"></div>
        <br />
        <!-- End. Photo of the Day -->

        <h1 class="title"><?php echo $content['title'];?></h1>

        <?php echo $content['text'];?>
        
        <div class="clearfix"></div>
        <br />

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
        <br />
        
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
        
        <div class="title_right"><?php echo $this->lang->line('weather');?></div>
        <div id="weather"></div>
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
        
        <script>
        $.MyWeather({
            position: "right",
            showpopup: true,
            temperature: "c",
            elementid: "#weather",
        },function(City,Country, IP, Latitude, Longitude, Temperature, Picture){
            // Add any custom Javascript functions with those variables
        });
        </script>
        
        <?php 

            foreach($this->banners as $banner):
                
                if($banner['position'] == '1'){

                    $image = '<img class="img-responsive" src="'.base_url().'assets/uploads/images/banners/'.$banner['img_url'].'" alt="'.$banner['title'].'" title="'.$banner['title'].'" >';
                    echo '<div class="right_banner"><a href="'.$banner['link'].'" target="_blank">'.$image.'</a></div>';
                    // do something

                }

            endforeach;?>
        
        
        <div class="headline">
            <p class="lead"><?php echo $this->lang->line('follow_us');?></p>
        </div>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs social_nav" role="tablist">
          <li class="fb_nav active"><a href="#tab-fb" role="tab" data-toggle="tab"></a></li>
        </ul>
        
        <!-- Tab panes -->
        <div class="tab-content">
          <div class="tab-pane active" id="tab-fb">
            <div class="fb-like-box" data-href="https://www.facebook.com/allatra" data-width="263" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="true" data-show-border="true"></div>
            <div id="fb-root"></div>
            <script>(function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.src = "//connect.facebook.net/uk_UA/sdk.js#xfbml=1&appId=770340233026349&version=v2.0";
              fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>
          </div>
        </div>
        <div class="clearfix"></div>
        <br />
        
        
    </div>
</div>