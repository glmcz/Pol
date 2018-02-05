<?php
$username = array(
	'name'	=> 'username',
	'id'	=> 'username',
    'label' => 'Jméno',
    'class' => 'form-control',
	'size'	=> 30,
	'value' => set_value('username')
);

$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
    'class' => 'form-control',
    'label' => 'Heslo',
	'size'	=> 30
);

$remember = array(
	'name'	=> 'remember',
	'id'	=> 'remember',
	'value'	=> 1,
	'checked'	=> set_value('remember'),
	'style' => 'margin:0;padding:0'
);

$confirmation_code = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
    'class' => 'form-control',
    'label' => 'Potvrzovací kód',
	'maxlength'	=> 8
);

$submit = array(
	'name'	=> 'login',
    'class' => 'btn btn-default',
    'content' => 'Vstoupit',
	'type'	=> 'submit'
);

?>

<fieldset id="login">
    <legend>Vyplňte, prosím, v následujících oblastech:</legend>
    <?php 
        $attributes = array('role' => 'form'); 

        echo form_open(base_url('auth'), $attributes);
    ?>

    <?php echo $this->dx_auth->get_auth_error(); ?>

	
	<div class="form-group">
        <?php echo form_label('Jméno', $username['id']);?>
		<?php echo form_input($username)?>
        <?php echo form_error('username'); ?>
	</div>

    <div class="form-group">
        <?php echo form_label('Heslo', $password['id']);?></dt>
        <?php echo form_password($password)?>
        <?php echo form_error('password'); ?>
	</div>

    <?php if ($show_captcha): ?>
        
        <div class="form-group">
            <div class="captcha-img">
        	    Zadejte kód z obrázku. To má žádné nuly.
                <?php echo $this->dx_auth->get_captcha_image(); ?>
            </div>
            <?php echo form_label('Potvrzovací kód', $confirmation_code['id']);?>
    
    		<?php echo form_input($confirmation_code);?>
    		<?php echo form_error($confirmation_code['name']); ?>
        </div>
    	
    <?php endif; ?>

	<div class="checkbox">
        <label>
            <?php echo form_checkbox($remember);?>&nbsp;&nbsp;&nbsp;Zapamatovat
        </label>
    </div>
        
	<div class="forgot_pass_registration">
		
		<?php echo anchor($this->dx_auth->forgot_password_uri, 'Zapomenuté Heslo');?> 
		<?php
			if ($this->dx_auth->allow_registration) {
				echo anchor($this->dx_auth->register_uri, 'Registrace');
			};
		?>
	</div>

	<?php echo form_button($submit);?>


<?php echo form_close()?>
</fieldset>

<script>
$(function() {
    $('input#captcha').keyup(function() {
        this.value = this.value.toLocaleUpperCase();
    });
});
</script>