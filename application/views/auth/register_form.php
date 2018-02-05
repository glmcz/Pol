<?php
$username = array(
	'name'	=> 'username',
	'id'	=> 'username',
    'class' => 'form-control',
	'size'	=> 30,
	'value' =>  set_value('username')
);

$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
    'class' => 'form-control',
	'size'	=> 30,
	'value' => set_value('password')
);

$confirm_password = array(
	'name'	=> 'confirm_password',
	'id'	=> 'confirm_password',
    'class' => 'form-control',
	'size'	=> 30,
	'value' => set_value('confirm_password')
);

$email = array(
	'name'	=> 'email',
	'id'	=> 'email',
    'class' => 'form-control',
	'maxlength'	=> 80,
	'size'	=> 30,
	'value'	=> set_value('email')
);

$captcha = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
    'class' => 'form-control'
);

$submit = array(
	'name'	=> 'register',
    'class' => 'btn btn-default',
    'content' => 'Registrace',
	'type'	=> 'submit'
);


?>

<fieldset id="register">
    <legend>Vyplňte, prosím, v následujících oblastech:</legend>
    <i>Pole označená hvězdičkou <strong style="color: red;">*</strong> jsou povinná!</i>
    <div class="clearfix"></div>
    <br />
    <?php $attributes = array('role' => 'form'); echo form_open($this->uri->uri_string(), $attributes);?>

	<div class="form-group">
        <?php echo form_label('Jméno<strong style="color: red;">*</strong>', $username['id']);?>
		<?php echo form_input($username)?>
        <?php echo form_error($username['name']); ?>
	</div>

	<div class="form-group">
        <?php echo form_label('Heslo<strong style="color: red;">*</strong>', $password['id']);?>
		<?php echo form_password($password)?>
        <?php echo form_error($password['name']); ?>
	</div>

	<div class="form-group">
        <?php echo form_label('Potvrzení hesla<strong style="color: red;">*</strong>', $confirm_password['id']);?>
		<?php echo form_password($confirm_password);?>
		<?php echo form_error($confirm_password['name']); ?>
	</div>

	<div class="form-group">
        <?php echo form_label('Email<strong style="color: red;">*</strong>', $email['id']);?>
		<?php echo form_input($email);?>
		<?php echo form_error($email['name']); ?>
	</div>
    
    <?php if ($this->dx_auth->captcha_registration): ?>
        
        <div class="form-group">
            <div class="captcha-img">
        	    Zadejte kód z obrázku. To má žádné nuly.
                <?php echo $this->dx_auth->get_captcha_image(); ?>
            </div>
            <?php echo form_label('Potvrzovací kód<strong style="color: red;">*</strong>', $captcha['id']);?>
    
    		<?php echo form_input($captcha);?>
    		<?php echo form_error($captcha['name']); ?>
        </div>
    	
    <?php endif; ?>
    
    <div class="forgot_pass_registration">
    	
    	<?php echo anchor($this->dx_auth->login_uri, 'Povolení');?> 

    </div>


	<?php echo form_button($submit);?>


<?php echo form_close()?>
</fieldset>