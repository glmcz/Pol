<div class="row">
    <div class="col-md-9">
        <div class="headline">
            <?php echo $content['text'];?>
            <?php $attributes = array('class' => 'form-horizontal request-news');
             echo form_open_multipart(LANGUAGE.'/request-news',$attributes);?>
              <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label"><?php echo $this->lang->line('requestnews_name');?></label>
                <div class="col-sm-10">
                  <input type="text" name="name" class="form-control" id="inputName" placeholder="<?php echo $this->lang->line('requestnews_enter_your_name');?>" value="<?=set_value('name');?>">
                  <strong><?=form_error('name');?></strong>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail" class="col-sm-2 control-label"><?php echo $this->lang->line('requestnews_email');?></label>
                <div class="col-sm-10">
                  <input type="email" name="email" class="form-control" id="inputEmail" placeholder="<?php echo $this->lang->line('requestnews_enter_your_email');?>" value="<?=set_value('email');?>">
                  <strong><?=form_error('email');?></strong>
                </div>
              </div>
              <div class="form-group">
                <label for="inputText" class="col-sm-2 control-label"><?php echo $this->lang->line('requestnews_message');?></label>
                <div class="col-sm-10">
                  <textarea name="message" class="form-control"  id="inputText" rows="3"><?=set_value('message');?></textarea>  
                  <strong><?=form_error('message');?></strong>
                </div>
              </div>
              <div class="form-group">
                <label for="InputFile" class="col-sm-2 control-label"><?php echo $this->lang->line('requestnews_attach_file');?></label>
                <div class="col-sm-10">
                    <input type="file" name="userfile" class="col-sm-2 form-control" id="InputFile" value="<?php echo set_value('userfile');?>">
                    <strong class="error"><?php echo form_error('userfile');?></strong>
                </div>
              </div>
              <div class="form-group">
                <label for="inputCaptcha" class="col-sm-2 control-label"><?php echo $this->lang->line('requestnews_captcha');?></label>
                <div class="col-sm-2">
                    <?php echo $imgcode;?>
                </div>
                <div class="col-sm-8">
                  <input type="text" name="captcha" class="form-control" id="inputCaptcha" placeholder="" size="10">
                  <strong><?=form_error('captcha'),$alert;?></strong>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" name = "send_message" class="btn btn-default"><?php echo $this->lang->line('requestnews_send');?></button>
                </div>
              </div>
            </form>
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
    
        <?php foreach($this->modules as $module):?>
            <div class="headline">
                <p class="lead"><?php echo $module['title'];?></p>
            </div>
            <?php echo $module['text'];?>
            <br />
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