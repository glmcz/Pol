<?php

$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
    'class' => 'form-control',
	'maxlength'	=> 80,
	'size'	=> 30,
	'value' => set_value('login')
);

$submit = array(
	'name'	    => 'reset',
    'class'     => 'btn btn-default',
    'content'   => 'Obnovit heslo',
	'type'	    => 'submit'
);

?>

<fieldset id="forgot_password">

<legend>Vyplňte, prosím, v následujících oblastech:</legend>

<?php echo form_open($this->uri->uri_string()); ?>

<strong style="color: red;">
<?php echo $this->dx_auth->get_auth_error(); ?>
</strong>

<div class="form-group">
    <?php echo form_label('Zadejte své uživatelské jméno nebo e-mail', $login['id']);?>
    <?php echo form_input($login); ?> 
    <?php echo form_error($login['name']); ?>
</div>

<div class="forgot_pass_registration">
	
	<?php echo anchor($this->dx_auth->login_uri, 'Povolení');?> 
	<?php
		if ($this->dx_auth->allow_registration) {
			echo anchor($this->dx_auth->register_uri, 'Registrace');
		};
	?>
</div>


<?php echo form_button($submit);?>

<?php echo form_close()?>
</fieldset>