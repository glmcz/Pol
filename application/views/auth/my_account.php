<?php

$user_id = array(
	'name'	=> 'id',
	'id'	=> 'user_id',
    'class' => 'form-control',
	'type'	=> 'hidden',
	'value' => $user_profile->id
);

$username = array(
	'name'	=> 'username',
	'id'	=> 'username',
    'class' => 'form-control',
	'size'	=> 30,
	'value' => $user_profile->username
);

$email = array(
	'name'	=> 'email',
	'id'	=> 'email',
    'class' => 'form-control',
	'maxlength'	=> 80,
	'size'	=> 30,
	'value'	=> $user_profile->email
);

$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
    'class' => 'form-control',
	'size'	=> 30
);

$confirm_password = array(
	'name'	=> 'confirm_password',
	'id'	=> 'confirm_password',
    'class' => 'form-control',
	'size'	=> 30
);

$submit = array(
	'name'	    => 'save_profile',
    'class'     => 'btn btn-default',
    'content'   => 'Сохранить',
	'type'	    => 'submit'
);

?>

<?php if(isset($message) && $message != ''):?>
    <div class="alert alert-success" role="alert"><?php echo $message;?></div>
<?php endif;?>

<div role="tabpanel">

  <!-- Nav tabs -->
  <ul id="my_account_tabs" class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Профиль</a></li>
    <li role="presentation"><a href="#articles" aria-controls="articles" role="tab" data-toggle="tab">Статьи</a></li>
    <li role="presentation"><a href="#comments" aria-controls="comments" role="tab" data-toggle="tab">Комментарии</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="profile">
        <fieldset id="my_account">

            <br />

            <?php
                $attributes = array('role' => 'form');

                echo form_open_multipart(base_url('auth/my_account'), $attributes);
            ?>

            <?php echo $this->dx_auth->get_auth_error(); ?>

            <?php echo form_input($user_id);?>

        	<div class="form-group">
                <?php echo form_label('Ваше имя:', $username['id']);?>
        		<?php echo form_input($username)?>
                <?php echo form_error('username'); ?>
        	</div>

            <div class="form-group">
                <?php echo form_label('Роль:');?>
                <p>
                    <?php switch ($user_profile->role_id) {

                        case 1:

                            echo 'Пользователь';

                        break;

                        case 2:

                            echo 'Администратор';

                        break;

                        case 3:

                            echo 'Модератор';

                        break;

                        case 4:

                            echo 'Автор';

                        break;

                    }?>
                </p>
            </div>

            <div class="form-group">
                <?php echo form_label('Дата создания аккаунта:');?>
                <p><?php echo $user_profile->created;?></p>
            </div>

            <div class="form-group">
                <?php echo form_label('Дата последнего изменения аккаунта:');?>
                <p><?php echo $user_profile->modified;?></p>
            </div>

            <div class="form-group">
                <?php echo form_label('Статус:');?>
                <p><?php if($user_profile->banned == 0): echo 'Активный'; else: echo 'Заблокированный'; endif; ?></p>
            </div>

            <div class="form-group">
                <?php echo form_label('Email:', $email['id']);?>
        		<?php echo form_input($email);?>
        		<?php echo form_error($email['name']); ?>
        	</div>

            <div class="form-group">
                <?php echo form_label('Пароль:', $password['id']);?></dt>
                <?php echo form_password($password)?>
                <?php echo form_error('password'); ?>
        	</div>

            <div class="form-group">
                <?php echo form_label('Подтверждение пароля:', $confirm_password['id']);?></dt>
                <?php echo form_password($confirm_password)?>
                <?php echo form_error('confirm_password'); ?>
        	</div>

            <div class="form-group">
                <?php echo form_label('Загрузить аватар:');?></dt>
                <?php echo form_upload('image');?>
				<?php if($user_profile->image != ''):?>

				<div style="text-align:center; padding:5px; border:1px solid #ddd;">
					<img src="<?php echo base_url('assets/uploads/avatars/'.$user_profile->image);?>" alt="current"/><br/>
				</div>

				<?php endif;?>
        	</div>

        	<?php echo form_button($submit);?>


            <?php echo form_close()?>
        </fieldset>
    </div>
    <div role="tabpanel" class="tab-pane" id="articles">

        <?php if(isset($user_created_articles) && count($user_created_articles)>0):?>

            <h2>Созданные статьи</h2>
            <br />
            <?php foreach($user_created_articles as $created_article):?>
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12"><?php echo $created_article['title'];?></div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"><?php echo $created_article['date'];?></div>
                <div class="actions col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <p>
                        <a href="<?php echo base_url($created_article['url']);?>" target="_blank">
                            <i class="fa fa-external-link-square"></i>
                        </a>
                        <a href="<?php echo base_url('adminpanel/materials/edit/'.$created_article['material_id']);?>">
                            <i class="fa fa-pencil"></i>
                        </a>
                    </p>
                </div>
            </div>
            <hr />
            <?php endforeach;?>

        <?php endif;?>

        <?php if(isset($user_updated_articles) && count($user_updated_articles)>0):?>

            <h2>Отредактированные статьи</h2>

            <?php foreach($user_updated_articles as $updated_article):?>
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12"><?php echo $updated_article['title'];?></div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"><?php echo $updated_article['date'];?></div>
                <div class="actions col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <p>
                        <a href="<?php echo base_url($updated_article['url']);?>" target="_blank">
                            <i class="fa fa-external-link-square"></i>
                        </a>
                        <a href="<?php echo base_url('adminpanel/materials/edit/'.$updated_article['material_id']);?>">
                            <i class="fa fa-pencil"></i>
                        </a>
                    </p>
                </div>
            </div>
            <hr />
            <?php endforeach;?>

        <?php endif;?>

    </div>
    <div role="tabpanel" class="tab-pane" id="comments">
        <?php if(isset($user_comments) && count($user_comments)>0):?>
        <h2>Мои комментарии</h2>
        <br />
        <?php foreach($user_comments as $user_comment):?>
        <div class="row" id="comment-<?php echo $user_comment['comment_id'];?>">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <strong><?php echo $user_comment['date'];?></strong>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                <div data-type="textarea" data-pk="1" id="<?php echo $user_comment['comment_id'];?>" class="comment_text">
                    <?php echo $user_comment['comment_text'];?>
                </div>
            </div>
            <div class="actions col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <p>
                    <a href="<?php echo base_url($user_comment['url']);?>" target="_blank"><i class="fa fa-external-link-square"></i></a>
                    <a class="remove_comment" data-id="<?php echo $user_comment['comment_id'];?>" href="#"><i class="fa fa-times"></i></a>
                </p>
            </div>
        </div>
        <hr />
        <?php endforeach;?>

        <?php endif;?>
    </div>
  </div>

</div>
<br />
<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
<style>
.actions{
    
}

.actions p{
    font-size: 20px; text-align: right;
}

.actions p a{
    margin: 0 5px;
}
.editable-pre-wrapped {
    white-space: normal !important;
}

.comment_text p, .comment_text{
    color: #0088cc;
    margin: 0;
}

</style>

<script>
$(document).ready(function(){

    var hash = window.location.hash;
    hash && $('ul.nav a[href="' + hash + '"]').tab('show');

    $('#my_account_tabs a').on("click", function (e) {
        $(this).tab('show');
        var scrollmem = $('body').scrollTop();
        window.location.hash = this.hash;
        $('html,body').scrollTop(scrollmem);
    });
    
    $(function(){
        $('.comment_text').editable({
            url: '/comments/edit_comment',
            title: 'Редактировать комментарий',
            rows: 10,
            showbuttons: 'bottom',
            ajaxOptions: {
                type: 'post',
                dataType: 'json'
            },
            success: function(response, newValue) {
                if(response.status == 'error') return response.msg; //msg will be shown in editable form
            }
        });
    });
    
    $('.remove_comment').on("click", function () {
        
        var r = confirm("Вы действительно хотите удалить этот комментарий?");
        
        if (r == true) {
            comment_id = $(this).attr('data-id');
            $.ajax({
                method: "POST",
                url: "/comments/delete_comment/" + comment_id,
                dataType: 'json',
                success: function(response, newValue) {
                    alert(response.msg);
                    if(response.status == 'success'){
                        $( "#comment-" + comment_id ).remove();
                    }
                }
            });
        }
        
        return false;
    });

});
</script>