<div id="wrap"><div id="main">

<h1>Управление ролями</h1>


	<?php  				
		// Show error
		echo validation_errors();
		
		// Build drop down menu
		$options[0] = 'Ни один';
		foreach ($roles as $role)
		{
			$options[$role->id] = $role->name;
		}
	
		// Build table
		$this->table->set_heading('', 'ID', 'Название', 'Родитель ID');
		
		foreach ($roles as $role)
		{			
			$this->table->add_row(form_checkbox('checkbox_'.$role->id, $role->id), $role->id, $role->name, $role->parent_id);
		}
		
		// Build form
		echo form_open($this->uri->uri_string());
		
		echo form_label('Родительская роль', 'role_parent_label');
		echo form_dropdown('role_parent', $options); 
				
		echo form_label('Название роли', 'role_name_label');
		echo form_input('role_name', ''); 
		
		echo form_submit('add', 'Добавить роль'); 
		echo form_submit('delete', 'Удалить выбранную роль');
				
		echo '<hr/>';
		
		// Show table
		echo $this->table->generate(); 
		
		echo form_close();
			
	?>

</div></div>