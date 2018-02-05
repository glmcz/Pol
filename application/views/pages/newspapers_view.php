<div class="row">
    <div class="col-md-9">
        <div class="headline">

            <a class="btn btn-primary pull-left" href="<?php echo base_url('kontakty');?>">
              <?php echo $this->lang->line('where_can_buy');?>? <span class="glyphicon glyphicon glyphicon-map-marker" aria-hidden="true"></span>
            </a>
            <div class="clearfix"></div>
            <br />

            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                <?php echo $this->lang->line('readmore');?> <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                            <div class="entry-content">
                                <?php echo $content['text'];?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingTwo">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Dobré zprávy tvoříme a šíříme spolu! <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                        <div class="panel-body">
                            <div class="entry-content">
                                <h2 style="text-align: center;">Dobré zprávy tvoříme a šíříme spolu!</h2>
                                <p>Na email polahoda@centrum.cz nám můžete posílat své články, úvahy čí vlastní zkušenosti. Vždyť každý z nás prožívá spoustu událostí naplněných laskavostí, krásou a upřímností.</p>
                                <p>Počet míst, kde si lidé dobré zprávy čtou, neustále roste. Zkontrolujte na http://polahoda.cz/kontakty nová odběrná místa, zda se nachází ve vašem okolí. Pokud ne, můžete například pomáhat s jejich šířením ve vašem městě a jeho okolí.</p>
                                <p>Dalším druhem pomoci může být finanční příspěvek. I malá částka pomůže, aby se Polahody rozdalo více a dostala se k těm, kteří prahnou po Dobrém slovu.</p>
                                <p>Číslo účtu je: Fio banka: 2800931857/2010, VS 20160001</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <br />

            <div class="row">
                <?php $i = 1; foreach($newspapers as $new):?>
                    
                    <div class="col-md-3">
                        <?php 
                        
                        $fimage = '<img class="img-responsive" src="'.base_url().'assets/uploads/images/newspapers/'.$new['img_url'].'" alt="'.$new['title'].'" title="'.$new['title'].'" >';
                        echo '<div class="newspaper"><a target="_blank" href="'.base_url('assets/uploads/files/newspapers/'.$new['pdf_file']).'">'.$fimage.$new['title'].'</a></div>';
                        
                        ?>
                    </div>
                    <?php if($i%4==0):?>
                    <div class="clearfix"></div>
                    
                    <?php endif;?>
                <?php $i++; endforeach;?>
            </div>
            <div class="clearfix"></div>
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