<div id="wrap"><div id="main">

<h1>Управление пользовательскими правами</h1>

	<?php
		
		// Build drop down menu
		foreach ($roles as $role)
		{
			$options[$role->id] = $role->name;
		}

		// Change allowed uri to string to be inserted in text area
		if ( ! empty($allowed_uri))
		{
			$allowed_uri = implode("\n", $allowed_uri);
		}
		
		if (empty($edit))
		{
			$edit = FALSE;
		}
			
		if (empty($delete))
		{
			$delete = FALSE;
		}
		
		// Build form
		echo form_open($this->uri->uri_string());
		
		echo form_label('Роль', 'role_name_label');
		echo form_dropdown('role', $options); 
		echo form_submit('show', 'Показать права'); 
		
		echo form_label('', 'uri_label');
				
		echo '<hr/>';
		
		echo form_checkbox('edit', '1', $edit);
		echo form_label('Разрешить редактирование', 'edit_label');
		echo '<br/>';
		
		echo form_checkbox('delete', '1', $delete);
		echo form_label('Разрешить удаление', 'delete_label');
		echo '<br/>';
					
		echo '<br/>';
		echo form_submit('save', 'Сохранить права');
		
		echo '<br/>';
		
		echo 'Откройте '.anchor('auth/custom_permissions/').' чтоб увидеть результат, попробуйте авторизироваться под пользовательской ролью, которую вы изменили.<br/>';
		echo 'Если вы изменили собственную роль, вам нужно войти снова чтоб изменения вступили в силу.';
		
		echo form_close();
			
	?>

</div></div>