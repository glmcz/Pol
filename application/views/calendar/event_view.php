<link href="<?php echo base_url().'assets/rating/css/barrating.css';?>" rel="stylesheet">
<script src="<?php echo base_url().'assets/rating/js/jquery.barrating.min.js';?>"></script>
<script type="text/javascript">
    $(function () {
        $('#material-stars-rating').barrating({
            initialRating:'4',
            showSelectedRating:false
        });
    });
</script>   

<div class="row">
    <div class="col-md-9">
        <div class="blog margin-bottom-40">
            <div class="blog-post-tags">
              <ul class="list-unstyled list-inline blog-info">
                <li>
                  <i class="fa fa-calendar fa-lg"></i>
                   <?php echo date('d.m.Y', strtotime($info['date']));?>
                </li>
                <li>
                    <i class="fa fa-eye fa-lg"></i>
                    <?php echo $this->lang->line('event_views');?>: <?php echo $info['count_views'];?>
                </li>
                <li>
                    <i class="fa fa-print fa-lg"></i>
                    <a href="#" onclick="printDiv('printableArea')"><?php echo $this->lang->line('event_print');?></a> 
                </li>
                <script>
                    function printDiv(divName) {
                         var printContents = document.getElementById(divName).innerHTML;
                         var originalContents = document.body.innerHTML;
                    
                         document.body.innerHTML = printContents;
                    
                         window.print();
                    
                         document.body.innerHTML = originalContents;
                    }
                </script>
              </ul>
            </div>

            <div class="blog-img">
                <?php if(isset($info['video_url']) && $info['video_url'] != ''):?>
                    <div class="responsive-video">
                        <?php echo $info['video_url'];?>
                        <img src="<?php echo base_url().'assets/uploads/images/events/'.$info['img_url'];?>" alt="<?php echo $content['title'];?>" title="<?php echo $content['title'];?>" class="img-responsive" style="display: none;">
                    </div>
                <?php else:?>
                    <?php if($content['text'] != ''):?>
                    <img src="<?php echo base_url().'assets/uploads/images/events/'.$info['img_url'];?>" alt="<?php echo $content['title'];?>" title="<?php echo $content['title'];?>" class="img-responsive">
                    <?php endif;?>
                <?php endif;?>

            </div>

            <?php if($content['text'] != ''):?>
                
                <div id="printableArea" class="blog-txt">
                    <?php echo $content['text'];?>
                </div>
                <hr />
                
            <?php endif;?>

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
        
        <div class="title_right"><?php echo $this->lang->line('calendar');?></div>
        <div id="mini-calendar"></div>
        <div class="clearfix"></div>
        <br />

    </div>
</div>
