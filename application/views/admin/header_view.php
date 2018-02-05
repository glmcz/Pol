<ul id="toolbar">
	<li class="menu_home">
        <?php echo anchor('', 'Перейти на сайт'); ?>
	</li>
	<li class="menu_logout icon">
        <?php echo anchor('auth/logout', 'Выход '.$this->session->userdata('username')); ?>
	</li>
</ul>


<div id="header">


	<h1><?php echo anchor('adminpanel/', 'Allatravesti.com - управление сайтом'); ?></h1>


    <div id="tabs">
    	<ul> 
            <?php if ($this->dx_auth->is_role('admin')):?>
            <li>
                <a href="#">Настройки</a>
                <ul>
                    <li><a href="<?php echo base_url()."adminpanel/set";?>">Настройки сайта</a></li>
                    
                    <li><a href="<?php echo base_url()."backend/users";?>">Пользователи</a></li>
                    <li><a href="<?php echo base_url()."backend/roles";?>">Роли</a></li>
                    <li><a href="<?php echo base_url()."backend/uri_permissions";?>">URI доступы</a></li>
                    <li><a href="<?php echo base_url()."backend/custom_permissions";?>">Права пользователей</a></li>
                    <li><a href="<?php echo base_url()."backend/unactivated_users";?>">Активация пользователей</a></li>
                    

                </ul>
            </li>
            <?php endif;?>
            
            <?php if ($this->dx_auth->is_role('admin')):?>
            <li>
                <a href="<?php echo base_url()."adminpanel/modules";?>">Модули</a>
            </li>
            <?php endif;?>
            
            <li>
                <a href="<?php echo base_url()."adminpanel/banners";?>">Баннеры</a>
            </li> 
            <li>
                <a href="<?php echo base_url()."adminpanel/slides";?>">Слайды</a>
            </li>
            <li>
                <a href="<?php echo base_url()."adminpanel/friends_edit";?>">Наши друзья</a>
            </li> 
            <li>
                <a href="<?php echo base_url()."adminpanel/farewells";?>">Напутствия</a>
            </li>
            <li>
                <a href="<?php echo base_url()."adminpanel/pages";?>">Страницы</a>
            </li>
            <li>
                <a href="<?php echo base_url()."adminpanel/events";?>">События</a>
            </li>
            <li>
                <a href="<?php echo base_url()."adminpanel/authors";?>">Авторы</a>
            </li>
            <?php if ($this->dx_auth->is_role('admin')):?>
            <li>
                <a href="<?php echo base_url()."adminpanel/sections_types";?>">Типы разделов</a>
            </li>
            <?php endif;?>
            
            <li>
                <a href="<?php echo base_url()."adminpanel/sections";?>">Разделы</a>
            </li>
            <li>
                <a href="<?php echo base_url()."adminpanel/materials";?>">Материалы</a>
            </li>    
            <li>
                <a href="<?php echo base_url()."adminpanel/comments";?>">Комментарии</a>
            </li>   
            <li>
                <a href="<?php echo base_url()."adminpanel/newspapers";?>">Газеты</a>
            </li>  
    	</ul>
    </div>

</div>