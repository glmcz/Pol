<div id="wrap"><div id="main">

<h1>Редактирование авторизации</h1>

<form action = "<?=base_url();?>adminpanel/preferences" method="post">

<p>Задать логин:<br/>
<input type="text" name="admin_login" value="<?=set_value('admin_login', $this->config->item('admin_login'));?>" size="20"/><br/>
<strong><?=form_error('admin_login');?></strong>
</p>

<p>Задать пароль:<br/>
<input type="password" name="admin_pass" value="<?=set_value('admin_pass', $this->config->item('admin_pass'));?>" size="20"/><br/>
<strong><?=form_error('admin_pass');?></strong>
</p>

<div class="submit">
    <p><input type = "submit" name = "save_button" value = "Сохранить настройки"/></p>
</div>
</form>

</div></div>