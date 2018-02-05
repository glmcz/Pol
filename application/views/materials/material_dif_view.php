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
                  <i class="fa fa-comments fa-lg"></i>
                  <a href="#media-comments"><?php echo $this->lang->line('material_comments');?>: <?php echo $info['comments_num_and_rating']['num'];?></a>
                </li>
                <li>
                    <i class="fa fa-eye fa-lg"></i>
                    <?php echo $this->lang->line('material_views');?>: <?php echo $info['count_views'];?>
                </li>
                <li>
                    <a href="#" data-material-url="<?php echo $info['url'];?>" id="add_like">
                        <?php echo $this->lang->line('material_likes');?> <i class="fa fa-heart-o fa-lg"></i> <?php echo $info['like'];?>
                    </a>
                </li>


                <li>
                    <i class="fa fa-print fa-lg"></i>
                    <a href="#" onclick="printDiv('printableArea')"><?php echo $this->lang->line('material_print');?></a>
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
              <?php if($content['keywords'] != ''):?>
                <ul class="list-unstyled list-inline blog-tags">
                    <li>
                        <i class="fa fa-tags fa-lg"></i>
                        <?php $tags = explode( ',', $content['keywords']);?>
                        <?php foreach($tags as $tag):?>
                        <a href="<?php echo base_url('tagsearch');?>?send_tagsearch=<?php echo trim($tag);?>"><?php echo trim($tag);?></a>
                        <?php endforeach;?>
                    </li>
                </ul>
              <?php endif;?>
            </div>
            
            <?php if(isset($photos) && count($photos)> 0):?>
                
                <?php echo $content['text'];?>
                <hr />
                <div class="blog-img">
                <?php foreach($photos as $photo):?>
                    <div class="photo-in-blog">
                        <img src="<?php echo base_url().'assets/uploads/images/photos/'.$photo['img_url'];?>" class="img-responsive"><br />
                        <div class="print_text"><?php echo $photo['title'];?></div>
                    </div>
                    <br />
                <?php endforeach;?>
                </div>
                
            <?php else:?>
            
                <?php if(isset($info['video_url']) && $info['video_url'] != ''):?>
                
                <div class="blog-img">
                    <div class="responsive-video">
                    <?php echo $info['video_url'];?>
                    </div>
                </div>
                
                <?php elseif(isset($info['img_url']) && $info['img_url'] != ''):?>
                
                <div class="blog-img">
                    <img src="<?php echo base_url().'assets/uploads/images/materials/'.$info['img_url'];?>" class="img-responsive">
                </div>
                
                <?php endif;?>
                
                <?php echo $content['text'];?>
                <hr />
            
            <?php endif;?>
            
            <p class="add_like_wrapper"><a id="add_like_content" data-material-url="<?php echo $info['url'];?>"><?php echo $this->lang->line('material_likes');?> <i class="fa fa-heart-o fa-lg"></i> <?php echo $info['like'];?></a></p>
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
            <div class="pluso" data-background="none;" data-options="small,square,line,horizontal,counter,sepcounter=1,theme=14" data-services="facebook,twitter,google,linkedin,livejournal,pinterest,print,email"></div>
            <div class="clearfix"></div>
            <hr />
            
            <?php if($info['like'] > 0):?>
            <table cellpadding="0" cellspacing="0" border="0" width="100%" align="center" style="margin-top: 10px; font-style: italic; text-align: left; font-size: 11px;">
            <tr>
            <td class="hreview-aggregate">
               <span class="item">
                  <span class="stars-rating">
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>  
                  </span>  
                  <span class="fn"><?php echo $content['title'];?></span>
               </span>
               <span class="rating">- <?php echo $this->lang->line('articles_rating');?>:
                  <span class="average">5.00</span> <?php echo $this->lang->line('from');?>
                  <span class="best">5.00</span>
               </span>
               <?php echo $this->lang->line('voters');?>:
               <span class="votes"><?php echo $info['like'];?></span>
               </td>
            </tr>
            </table>
            <?php endif;?>
            
            <?php if(isset($prev_and_next) && count($prev_and_next) > 0): ?>

                <div class="prev_and_next">

                        <?php if(!empty($prev_and_next['next'])):?>
                        <div class="pprev col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <a class="next" href="<?php echo base_url().$lang.$prev_and_next['next']['url'];?>">
                                <?php echo $this->lang->line('material_next');?>: <br /> <?php echo $prev_and_next['next']['title'];?>
                            </a>
                        </div>
                        <?php else:?>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"></div>
                        <?php endif;?>

                        <?php if(!empty($prev_and_next['prev'])):?>
                        <div class="pnext col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <a class="prev" href="<?php echo base_url().$lang.$prev_and_next['prev']['url'];?>">
                                <?php echo $this->lang->line('material_prev');?>: <br /> <?php echo $prev_and_next['prev']['title'];?>
                            </a>
                        </div>
                        <?php else:?>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"></div>
                        <?php endif;?>

                </div>
                <div class="clearfix"></div>

            <?php endif;?>

            <?php
            if(isset($similars) && count($similars) > 0):

            echo '<div class="title">'.$this->lang->line('material_related').':</div><br /><div class="row">';

            foreach($similars as $similar):?>

            <div class="similar-post col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <a href="<?php echo base_url($lang.$similar['url']);?>">
                    <img class="img-responsive" src="<?php echo base_url('assets/uploads/images/materials/thumbs/'.$similar['img_url']);?>" />
                    <span><?php echo $similar['title'];?></span>
                </a>
            </div>

            <?php

            endforeach;

            echo '</div><div class="clearfix"></div><br />';

            endif;?>

            <hr />
            
            <!-- Comments -->
            <?php if(count($info['comments'])>0):?>
            <h3><?php echo $this->lang->line('comments');?></h3>

            <div id="media-comments" class="media">

                <?php if($info['comments']):?>

                    <?php
                    function comment_loop($comments, $dash = '', $userdata = FALSE)
            		{
            		    if(LANGUAGE == 'ru'):

                            $comment_answer = 'Ответить';
                            $comment_rating = 'Рейтинг';

                        elseif(LANGUAGE == 'en'):

                            $comment_answer = 'Reply';
                            $comment_rating = 'Rating';

                        else:

                            $comment_answer = 'Відповісти';
                            $comment_rating = 'Рейтинг';

                        endif;

                		foreach($comments as $comment)
                		{?>

						<a class="pull-left" href="#">
							<img class="media-object" src="<?php echo !empty($comment->image) ? base_url().'assets/uploads/avatars/'.$comment->image : base_url().'assets/img/commentator.jpg';?>" alt="">
						</a>

                        <div id="<?php echo $comment->comment_id;?>" class="media-body">
                            <h4 class="media-heading">
                                <span class="comment-author"><?php echo $dash.' '.$comment->author;?></span>
                                <span class="comment-date">
                                    <?php echo date('d.m.Y H:i', strtotime($comment->date));?>
                                    <!--
                                    /
                                    <div class="material_rating big">
                                        <span class="rating_stars">
                                            <span class="rating_stars_current" style="width: <?php echo (($comment->rating/5)*100);?>%;"></span>
                                        </span>
                                    </div>
                                    /
                                    -->
                                    <a id="<?php echo $comment->comment_id;?>" title="<?php echo $comment->author;?>" class="reply" href="#">
                                        <?php echo $comment_answer;?>
                                    </a>
                                </span>
                            </h4>
                            <p><?php echo $comment->comment_text; ?></p><hr>
                            <?php if(isset($comment->children) && count($comment->children) > 0):?>
                                <div class="media">
                                    <?php comment_loop($comment->children, $dash.'&rarr;&nbsp;');?>
                                </div>
                            </div>
                            <?php else:?>

                            </div>
                            <?php endif;?>

                		<?php

                        }
                    }
            		comment_loop($info['comments'], '');

                    ?>

                <?php endif;?>
            </div>
            <div class="clearfix"></div>
            <hr />

            <?php endif;?>

            <!-- End. Comments -->



            <!-- Comments Form -->
            <div class="post-comment">
            	<h3><?php echo $this->lang->line('comment_leave');?></h3>

                <form id="comment_form" action = "<?php echo base_url().$lang."comments/add_comment/$info[material_id]";?>" method="post">

                    <div class="notice alert alert-danger"></div>

                    <div class="parent_id">
                        <input name="parent_id" type="hidden" value="0" />
                    </div>

                    <label><?php echo $this->lang->line('commentator_name');?> <span class="color-red">*</span></label>
					<?php if($this->session->userdata('DX_user_id') && $this->session->userdata('DX_user_id') > 0):?>
						<div class="row margin-bottom-20">
							<div class="col-md-7 col-md-offset-0">
								<?php echo $this->session->userdata('DX_username') ;?>
								<input name="author" type="hidden" value="<?php echo $this->session->userdata('DX_username') ;?>" />
							</div>
						</div>
					<?php else : ?>
						<div class="row margin-bottom-20">
							<div class="col-md-7 col-md-offset-0">
								<input name="author" type="text" class="form-control" required>
							</div>
						</div>
					<?php endif ; ?>

                    <label><?php echo $this->lang->line('commentator_email');?> <span class="color-red">*</span></label>
					<?php if($this->session->userdata('DX_user_id') && $this->session->userdata('DX_user_id') > 0):?>
						<div class="row margin-bottom-20">
							<div class="col-md-7 col-md-offset-0">
								<?php echo $this->session->userdata('DX_email') ;?>
								<input name="email" type="hidden" value="<?php echo $this->session->userdata('DX_email') ;?>" />
							</div>
						</div>
					<?php else : ?>
						<div class="row margin-bottom-20">
							<div class="col-md-7 col-md-offset-0">
								<input name="email" type="email" class="form-control" required>
							</div>
						</div>
					<?php endif ; ?>

                    <!--
                    <label><?php echo $this->lang->line('commentator_rating');?></label>
                    <div class="margin-bottom-20 input select rating-f">
                        <select id="material-stars-rating" name="rating">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    -->
                    <label><?php echo $this->lang->line('commentator_message');?> <span class="color-red">*</span></label>
                    <div class="row margin-bottom-20">
                        <div class="col-md-11 col-md-offset-0">
                            <textarea name="comment_text" class="form-control" rows="8" required></textarea>
                        </div>
                    </div>

                    <label><?php echo $this->lang->line('comment_capcha');?> <span class="color-red">*</span></label>
                    <div class="row margin-bottom-20">
                        <div class="col-md-11 col-md-offset-0">
                            <span id="image_key_capcha"><?php echo $imgcode;?></span>
                            <input name="captcha" type="text" class="form-control captcha" size="8" required>
                        </div>
                    </div>

                    <p><button name="post_comment" id="add_comment" class="btn-u" type="submit"><?php echo $this->lang->line('comment_add');?></button></p>

                    <div class="loading"></div>
                </form>
            </div>
            <!-- End. Comments Form -->
            
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

<link rel="stylesheet" href="<?php echo base_url().'assets/colorbox/colorbox.css';?>">
<script type="text/javascript" src="<?php echo base_url().'assets/colorbox/colorbox.js';?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/colorbox/colorbox.init.js';?>"></script>

<script type="text/javascript" src="<?php echo base_url().'assets/template/js/jquery.validate.js';?>"></script>
<script>
$(document).on('click', '#add_comment', function(){

    $("#comment_form").validate({

        success: "valid",
        submitHandler: function() {
            var input   = $("<input>").attr("type", "hidden").attr("name", "post_comment").val("");
            $('#comment_form').append($(input));
            var elem    = $(this);
            var data    = $('#comment_form').serialize();//getting form data to send it.
            var link    = "<?php echo base_url().'comments/add_comment/'.$info['material_id'];?>";
            var pid     = $('input[name=parent_id]').val();
            $.ajax({
                beforeSend: function() {
                    //disable the button click and show the loading image
                    elem.attr('disabled', 'disabled').addClass('disabled');
                    $('#comment_form .loading').html('<br /><p><img src="<?php echo base_url().'assets/img/loading.gif';?>" /></p><br />');
                },
                url: link,
                type: 'post',
                dataType: 'json',
                data: data,
                success: function(data) {
                    //reactive button click
                    elem.removeAttr('disabled').removeClass('disabled');
                    if(data.err == 1)
                    {
                        $('#comment_form .loading').html('<br />');
                        $('.notice').html(data.content);//display notice
                        $('span#image_key_capcha').html(data.captcha);
                    }
                    else
                    {
                        $('#comment_form .loading').html('<br />');
                        $('#comment_form input[type="text"], #comment_form input[type="email"], #comment_form textarea').val('');//reset input value of comment form
                        $('.notice').attr('class', 'notice alert alert-success').html(data.content);
                        $('span#image_key_capcha').html(data.captcha);

                        if(pid == 0){
                            $('.media').append(data.new_comment); //Insert new comment to the top of comments list
                            //scroll the document to the new comment.
                            $('html, body').animate({
                                scrollTop: $(".media").offset().top
                            }, 800);
                        }else{
                            $('.media-body#'+pid).append(data.new_comment);
                            //scroll the document to the new comment.
                            $('html, body').animate({
                                scrollTop: $('.media-body#'+pid).offset().top
                            }, 800);
                        }

                    }
                }
            });
            return false;

        }

    });

});
$(document).on('click', '.reply', function(){
    var pid         = $(this).attr("id");
    var name        = $(this).attr("title");
    var answerer    = "<?php echo $this->lang->line('comment_answerer');?>";
    $('input[name=parent_id]').val(pid);
    $('.parent_id').html('<label>'+answerer+': '+name+' <span id="close-respondent">X</span></label><div class="row margin-bottom-20"><div class="col-md-7 col-md-offset-0"><input name="parent_id" type="hidden" class="form-control" value="'+pid+'" placeholder="'+name+'" readonly  required></div></div>');
    $('html, body').animate({
        scrollTop: $(".post-comment").offset().top
    }, 800);

    return false;
});

$(document).on('click', '#close-respondent', function(){
    $( ".parent_id label" ).html('');
    $('input[name=parent_id]').val(0);
});

$(document).on('click', '#add_like', function(){

    materials_url  = $(this).attr('data-material-url');
    link           = "<?php echo base_url().'materials/add_like';?>";

    $.ajax({

        beforeSend: function() {
            //disable the button click and show the loading image
        },
        url: link,
        type: 'post',
        dataType: 'json',
        data: { url: materials_url },
        success: function(data) {

            $("#add_like").html(data.content);

        }

    });

    return false;

});

$(document).on('click', '#add_like_content', function(){

    materials_url  = $(this).attr('data-material-url');
    link           = "<?php echo base_url().'materials/add_like';?>";

    $.ajax({

        beforeSend: function() {
            //disable the button click and show the loading image
        },
        url: link,
        type: 'post',
        dataType: 'json',
        data: { url: materials_url },
        success: function(data) {

            $("#add_like_content").html(data.content);

        }

    });

    return false;

});

</script>