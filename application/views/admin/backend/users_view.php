<div id="wrap"><div id="main">

<h1>Управление пользователями</h1>

<?php  				
		// Show reset password message if exist
		if (isset($reset_message))
			echo $reset_message;
		
		// Show error
		echo validation_errors();
        
        $tmpl = array ( 'table_open'  => '<table cellpadding="2" cellspacing="1" class="users">' );
        
        $this->table->set_template($tmpl);
		
		$this->table->set_heading('', 'Имя пользователя', 'Email', 'Роль', 'Бан', 'Последний IP', 'Последний заход', 'Дата создания');
		
		foreach ($users as $user) 
		{
			$banned = ($user->banned == 1) ? 'Да' : 'Нет';
			
			$this->table->add_row(
				form_checkbox('checkbox_'.$user->id, $user->id),
				$user->username, 
				$user->email, 
				$user->role_name, 			
				$banned, 
				$user->last_ip,
				date('d-m-Y', strtotime($user->last_login)), 
				date('d-m-Y', strtotime($user->created)));
		}
		
		echo form_open($this->uri->uri_string());
				
		echo form_submit('ban', 'Бан пользователя');
		echo form_submit('unban', 'Разбанить пользователя');
		echo form_submit('reset_pass', 'Сброс пароля');
		
		echo '<hr/>';
		
		echo $this->table->generate(); 
		
		echo form_close();
		
		echo '<div class="pagination">'.$pagination.'</div>';
			
	?>


</div></div>