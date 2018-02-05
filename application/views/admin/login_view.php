<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Панель администрирования</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf8"/> 		
<link rel="stylesheet" href="<?php echo base_url();?>assets/admin/css/admin.css" type="text/css" />
</head>
<body id="login">
<div id="header">
	<h1>Вход в панель администратора</h1>
</div>
<div id="wrap"><div id="content">

<h2>Авторизация</h2>

<form style="text-align: center;" action = "<?=base_url();?>adminpanel/login" method="post">

<p>Логин<br/>
<input type="text" name="login" value="<?=set_value('login');?>"/><br/>

</p>

<p>Пароль<br/>
<input type="password" name="pass"/><br/>
</p><br />

<p><input type = "submit" name = "enter_button" value = "Войти"/></p>

</div>


<p><strong><?php if(form_error('login') == true){ echo '<div class="error">'.form_error('login').'</div>';}?></strong></p>
<p><strong><?php if(form_error('pass') == true){ echo '<div class="error">'.form_error('pass').'</div>';}?></strong></p>
</div>

</form>

</div>