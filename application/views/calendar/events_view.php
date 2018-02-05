<div class="row">
    <div class="col-md-9">
            
            <?php foreach($events as $event):?>
            <div class="row blog blog-medium margin-bottom-40">
                <div class="col-md-4">
                    <a href="<?php echo base_url($lang.$event['url']);?>">
                        <img class="img-responsive" src="<?php echo base_url().'assets/uploads/images/materials/thumbs/'.$event['img_url'];?>" alt="<?php echo $event['title'];?>" />
                    </a>
                </div>
                <div class="col-md-8">
                  <h2 class="blog-title"><a href="<?php echo base_url($lang.$event['url']);?>"><?php echo $event['title'];?></a></h2>
                  <ul class="list-unstyled list-inline blog-info">
                    <li>
                      <i class="fa fa-calendar fa-lg"></i>
                      <?php echo date('d.m.Y', strtotime($event['date']));?>
                    </li>
                    <li>
                        <i class="fa fa-eye fa-lg"></i>
                        <?php echo $this->lang->line('event_views');?>: <?php echo $event['count_views'];?>
                    </li>
                  </ul>
                  <p><?php echo $event['anons'];?></p>
                  <p>
                    <a class="btn-u btn-u-small" href="<?php echo base_url($lang.$event['url']);?>">
                      <i class="fa fa-location-arrow fa-lg"></i>
                      <?php echo $this->lang->line('event_readmore');?>
                    </a>
                  </p>
                </div>
            </div>
            <hr />
            <?php endforeach;?>

    </div>
    <div class="col-md-3">
        
        <div id="just-calendar">
            <div id="calendar"><?php echo $calendar;?></div>
        </div>
        
        <br />
       
        <div class="clearfix"></div>
        <br />

    </div>
</div>