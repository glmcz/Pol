<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Панель администрирования</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf8"/>
<link rel="stylesheet" href="<?php echo base_url();?>assets/admin/css/admin.css" type="text/css" />
<?php if(isset($css_files)):?>
    <?php foreach($css_files as $file): ?>
    	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
    <?php endforeach; ?>
<?php endif;?>
<?php if(isset($js_files)):?>		
    <?php foreach($js_files as $file): ?>
    	<script src="<?php echo $file; ?>"></script>
    <?php endforeach; ?>
<?php endif;?>
<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url()."assets/admin/img/favicon.png";?>"/>
<link rel="shortcut icon" type="image/png" href="<?php echo base_url()."assets/admin/img/favicon.png";?>"/>
</head>
<body>