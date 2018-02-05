<div class="row">
    <div class="col-md-9">
		<?php if(!empty($search)):?>
		<p>Nalezené položky - <?php echo $total;?></p>
			<?php foreach($search as $sr):?>
				<?php if(isset($sr['url'])):?>
					<div class="headline">
						<h3><?php echo anchor(base_url($sr['url']), $sr['title']) ;?></h3>
					</div>
					<hr />
				<?php endif;?>
			<?php endforeach;?>
		<?php echo $page_nav;?>
        <?php else:?>
			<div class="headline">
				<h3>Pro toto vyhledávání nebyly nalezeny žádné výsledky.</h3>
			</div>
        <?php endif;?>
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