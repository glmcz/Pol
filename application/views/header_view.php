<div class="top">
    <div class="container">
        <div class="row">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".top-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <nav class="collapse navbar-collapse top-navbar-collapse">
                <ul class="top-menu pull-left">
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->lang->line('about_menu');?> <b class="caret"></b></a>
                      <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url().$lang.'about';?>"><?php echo $this->lang->line('about');?></a></li>
                        <li class="devider"></li>
                        <li><a href="<?php echo base_url().$lang.'friends';?>"><?php echo $this->lang->line('friends');?></a></li>
                        <li class="devider"></li>
                        <li><a href="<?php echo base_url().$lang.'feedback';?>"><?php echo $this->lang->line('feedback');?></a></li>
                      </ul>
                    </li>
                    <li class="devider"></li>
                    <li><a href="<?php echo base_url().$lang.'request-news';?>"><?php echo $this->lang->line('request_news');?></a></li>
                    <li class="devider"></li>
                    <li><a href="<?php echo base_url().$lang.'books';?>"><?php echo $this->lang->line('books');?></a></li>
                    <li class="devider"></li>
                    <li><a href="<?php echo base_url().$lang.'kontakty';?>"><?php echo $this->lang->line('contacts');?></a></li>
                </ul>
                <ul class="loginbar pull-right">
                    <?php if($this->dx_auth->is_logged_in()):?>
                        <li><a href="<?php echo base_url().'auth/my_account';?>"><?php echo $this->dx_auth->get_username();?></a></li>
                        <li><a href="<?php echo base_url().'auth/logout';?>"><?php echo $this->lang->line('logout');?></a></li>
                    <?php else:?>
                        <li><a href="<?php echo base_url().'auth';?>"><?php echo $this->lang->line('login');?></a></li>
                        <li><a href="<?php echo base_url().'auth/register';?>"><?php echo $this->lang->line('registration');?></a></li>
                    <?php endif;?>
                </ul>
                <ul class="social pull-right">
                    <li><a target="_blank" class="vk" href="<?php echo VK;?>" title="VKontakte"></a></li>
                    <li><a target="_blank" class="facebook" href="<?php echo FACEBOOK;?>" title="Facebook"></a></li>
                    <li><a target="_blank" class="tw" href="<?php echo TW;?>" title="Twitter"></a></li>
                    <li><a target="_blank" class="youtube" href="<?php echo YOUTUBE;?>" title="YouTube"></a></li>
                    <li><a target="_blank" class="rss" href="<?php echo base_url().'rss';?>" title="RSS"></a></li>
                </ul>
                <div class="language dropdown">
                  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
                    <?php echo $this->lang->line('language');?>: <img src="<?php echo base_url().'assets/template/img/'.LANGUAGE.'.png';?>" />
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu language-menu" role="menu" aria-labelledby="dropdownMenu1">
                    <li class="lang-ru" role="presentation"><a role="menuitem" target="_blank" tabindex="-1" href="https://allatravesti.com">Русский</a></li>
                    <li class="lang-ua" role="presentation"><a role="menuitem" target="_blank" tabindex="-1" href="https://allatravesti.com/ua">Українська</a></li>
                    <li class="lang-en" role="presentation"><a role="menuitem" target="_blank" tabindex="-1" href="https://allatravesti.com/en">English</a></li>
                  </ul>
                </div>
                <div class="make_default">
                    <ul>
                        <li ><a href="#" onclick="return add_favorite(this);"><?php echo $this->lang->line('make_homepage');?></a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</div>
<header>
    <div class="container">
        <div class="col-md-4">
            <div class="logo row">
                <a class="navbar-brand" href="<?php echo base_url().$lang;?>">
                    <div class="row">
                        <img class="img-responsive" src="<?php echo base_url().'assets/template/img/logo'.LANGUAGE.'.png';?>" />
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-5">
            <div class="row">
                <div class="top_banner">
                <?php

                $first = true;

                foreach($this->banners as $banner):

                    if($banner['position'] == '2'){
                        if ( $first )
                        {
                            $image = '<img class="img-responsive" src="'.base_url().'assets/uploads/images/banners/'.$banner['img_url'].'" alt="'.$banner['title'].'" title="'.$banner['title'].'" >';
                            echo '<a onclick="yaCounter27133796.reachGoal(\'allatra_download\'); return true;" href="'.$banner['link'].'">'.$image.'</a>';
                            // do something
                            $first = false;
                        }
                    }

                endforeach;?>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="row">
				<form id="search_articles" action="<?php echo base_url('search');?>" method="post">
					<div class="allatra_search input-group pull-right">
						<input type="text" class="form-control" placeholder="<?php echo $this->lang->line('search_placeholder');?>" name="search">
						<span class="input-group-btn">
							<input class="btn btn-default" type="submit" name="send_search" value="<?php echo $this->lang->line('do_search');?>">
						</span>
					</div><!-- /input-group -->
				</form>
                <div class="allatra_search_tip">
                    <?php echo $this->lang->line('search_example');?>: <a href="#"><?php echo $this->lang->line('good_news');?></a>
                </div>
            </div><!-- /.row -->
        </div><!-- /.col-md-3 -->
    </div>
</header>

<div class="to_top">
    <span class="to_top_arrow"></span>
</div>
<div id="mainmenu">
    <div class="container">
        <div class="row">
            <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
            <nav class="allatra_bar navbar yamm" role="navigation">
                <div class="navbar-header">
                  <button type="button" data-toggle="collapse" data-target="#navbar-collapse-2" class="navbar-toggle">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                </div>
                <div id="navbar-collapse-2" class="navbar-collapse collapse mainmenu">
        
                    <ul class="nav navbar-nav">
        
                        <li><a href="<?php echo base_url().$lang;?>"><?php echo $this->lang->line('home');?></a></li>
        
        
                        <?php
                        
                		function display_categories($cats, $layer, $first='', $parent_url = '')
                		{
                		    if(LANGUAGE == 'cz'): 
                                
                            $lang = ''; 
                            $all_materials = 'Všechny materiály';
                            
                            elseif(LANGUAGE == 'en'):
                            
                            $lang = LANGUAGE.'/'; 
                            $all_materials = 'All materials';
                            
                            elseif(LANGUAGE == 'ru'):
                            
                            $lang = LANGUAGE.'/'; 
                            $all_materials = 'Все материалы';
                            
                            else:
                            
                            $lang = LANGUAGE.'/';  
                            $all_materials = 'Всі матеріали'; 
                                
                            endif;
                            
        
                			if($first)
                			{
                                echo '<ul class="'.$first.'" role="menu"><div class="yamm-content"><div class="row">';
                			}
                            
                			foreach ($cats as $cat)
                			{
                			     
        
                                if (sizeof($cat['children']) > 0)
                				{
                                    
                                    if($layer == 1)
                					{
                						echo '<li class="dropdown"><a class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown" href="'.base_url().$cat['section']->url.'">'.$cat['section']->title.'<span class="caret"></span></a>'."\n";
                                        
                                        $next = $layer+1;
                                        echo '<span class="hasmore"></span>';
                						display_categories($cat['children'], $next, 'dropdown-menu children', $cat['section']->url);
                					}
                                    else
                                    {
                                        echo '<li><a href="'.base_url().$lang.$cat['section']->url.'">'.$cat['section']->title.'</a></li>'."\n";
                                        $next = $layer+1;
                                        display_categories($cat['children'], $next, 'list-unstyled children');
                                    }
        
        
                				}else{
        
                                    echo '<li><a href="'.base_url().$lang.$cat['section']->url.'">'.$cat['section']->title.'</a>'."\n";
        
                                }
                				echo '</li>';
                			}
        
        
                            if($first)
                			{
                                $parent = current($cats);
                                echo '<li class="all_materials"><a href="'.base_url().$lang.$parent_url.'">'.$all_materials.' &#x2192;</a>'."\n";
                                echo '</div></div></ul>';
                			}
        
                		}
        
                		display_categories($this->sections, 1);?>
                        
                        <li><a href="<?php echo base_url($lang.'vydani');?>"><?php echo $this->lang->line('publications');?></a></li>
        
                    </ul>
        
                </div>
            </nav>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<?php if(!isset($info['wp']) || $info['wp'] != 1):?>
<div class="breadcrumbs margin-bottom-40">
    <div class="container">
		<?php if(isset($content)):?>
        <h1 class="pull-left"><?php echo $content['title'];?></h1>
		<?php endif;?>
        <?php if(isset($breadcrumb)):?>
        <ul class="pull-right breadcrumb">

            <?php

                if(!isset($info['wp']) || $info['wp'] != '1'){
                	$url_path	= '';
                	$count	 	= 1;
                    echo '<li itemscope itemtype="https://data-vocabulary.org/Breadcrumb"><a itemprop="url" href="'.base_url($lang).'"><span itemprop="title">'.$this->lang->line('home_breadcrumbs').'</span></a></li>';
                	foreach($breadcrumb as $bc):

                            $url_path .= '/'.$bc['url'];
                            if($count == count($breadcrumb)):?>
                				<?php echo '<li itemscope itemprop="child" class="active" itemtype="https://data-vocabulary.org/Breadcrumb"><span itemprop="title">'.$bc['title'].'</span></li>';?>
                			<?php else:?>

                		             <li itemscope itemprop="child" itemtype="https://data-vocabulary.org/Breadcrumb"><a itemprop="url" href="<?php echo base_url($lang.$url_path);?>"><span itemprop="title"><?php echo $bc['title'];?></span></a></li>

                            <?php endif;
                			$count++;

                	endforeach;
                }
             ?>

        </ul>
        <?php endif;?>
    </div>
</div>
<?php endif;?>
<div class="container theme-showcase">