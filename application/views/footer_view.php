</div> <!-- container theme-showcase -->
<footer>
    <div class="container">
        <div class="col-md-9">
            <div class="row">
                <ul class="fmenu-with-child">
                <?php
    
            		function display_fmenu1($cats, $layer, $first='')
            		{
            			if($first)
            			{
            				echo '<ul'.$first.'>';
            			}
            			
                        //Выводим только категории, где есть дочерние
            			foreach ($cats as $cat)
            			{
            
            				
            				if (sizeof($cat['children']) > 0 || $layer > 1)
            				{
            				    echo '<li><a target="_blank" href="'.site_url($cat['section']->url).'">'.$cat['section']->title.'</a>'."\n";
                                
            					if($layer == 1)
            					{
            						$next = $layer+1;
            						display_fmenu1($cat['children'], $next, ' class="first"');
            					}
            					else
            					{
            						$next = $layer+1;
            						display_fmenu1($cat['children'], $next, ' class="first"');
            					}
                                
                                echo '</li>';
            				}
            				
            			}
                        
            			if($first)
            			{
            				echo '</ul>';
            			}
                        	
           		    }
            			
            		display_fmenu1($this->sections, 1);
            			
          		?>
                </ul>
            </div>
        </div>
        <div class="col-md-3">
            <ul class="fmenu-without-child">
            <?php

        		function display_fmenu2($cats, $layer, $first='')
        		{
        			if($first)
        			{
        				echo '<ul'.$first.'>';
        			}
        			
                    //Выводим только категории, где есть дочерние
        			foreach ($cats as $cat)
        			{
        
        				
        				if (sizeof($cat['children']) == 0)
        				{
        				    echo '<li><a target="_blank" href="'.site_url($cat['section']->url).'">'.$cat['section']->title.'</a>'."\n";
                            
        					if($layer == 1)
        					{
        						$next = $layer+1;
        						display_fmenu2($cat['children'], $next, ' class="first"');
        					}
        					else
        					{
        						$next = $layer+1;
        						display_fmenu2($cat['children'], $next, ' class="first"');
        					}
                            
                            echo '</li>';
        				}
        				
        			}
                    
        			if($first)
        			{
        				echo '</ul>';
        			}
                    	
       		    }
        			
        		display_fmenu2($this->sections, 1);
        			
      		?>
            </ul>
            <ul class="social-footer">
                <li><a target="_blank" class="vk" href="<?php echo VK;?>" title="VKontakte"></a></li>  
                <li><a target="_blank" class="facebook" href="<?php echo FACEBOOK;?>" title="Facebook"></a></li>  
                <li><a target="_blank" class="tw" href="<?php echo TW;?>" title="Twitter"></a></li> 
                <li><a target="_blank" class="youtube" href="<?php echo YOUTUBE;?>" title="YouTube"></a></li> 
                <li><a target="_blank" class="rss" href="<?php echo base_url().'rss';?>" title="RSS"></a></li> 
            </ul>
            <p class="copy">
                © 2014 - <?php echo date('Y').' '.$this->lang->line('copyrights');?> 
            </p>
            <!-- Yandex.Metrika informer -->
            <p style="text-align: left;">
				<a href="https://metrika.yandex.ua/stat/?id=37048390&amp;from=informer" target="_blank" rel="nofollow"><img src="https://metrika-informer.com/informer/37048390/3_0_FFFFFFFF_FFFFFFFF_0_pageviews" style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" class="ym-advanced-informer" data-cid="37048390" data-lang="ru" /></a>
            </p>
            <!-- /Yandex.Metrika informer -->
        </div>
    </div>
</footer>
<script type="text/javascript" src="//static-login.sendpulse.com/apps/fc3/build/default-handler.js?1511883451936"></script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-56971309-1', 'auto');
  ga('send', 'pageview');
</script>
</body></html>