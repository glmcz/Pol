<div id="wrap"><div id="main">

<h1>Управление неактивированными пользователями</h1>

	<?php  				
		// Show error
		echo validation_errors();
        
        $tmpl = array ( 'table_open'  => '<table cellpadding="2" cellspacing="1" class="users">' );
        
        $this->table->set_template($tmpl);
		
		$this->table->set_heading('', 'Имя пользователя', 'Email', 'Регистрационное IP', 'Ключ активации', 'Дата создания');
		
		foreach ($users as $user) 
		{
			$this->table->add_row(
				form_checkbox('checkbox_'.$user->id, $user->username).form_hidden('key_'.$user->id, $user->activation_key),
				$user->username, 
				$user->email, 
				$user->last_ip, 				
				$user->activation_key, 
				date('Y-m-d', strtotime($user->created)));
		}
		
		echo form_open($this->uri->uri_string());
				
		echo form_submit('activate', 'Активировать');
		
		echo '<hr/>';
		
		echo $this->table->generate(); 
		
		echo form_close();
		
		echo '<div class="pagination">'.$pagination.'</div>';
			
	?>

</div></div>