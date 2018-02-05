<div id="wrap"><div id="main">
<div id="info">
<?=$back;?>
<h1>Сортировать рубрики</h1>

<script type="text/javascript" src="<?php echo base_url().'assets/admin/js/reorder/jquery-1.4.2.js';?>"></script>
<script src="<?php echo base_url().'assets/admin/js/reorder/jquery-ui-1.8.1.custom.min.js';?>" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/admin/js/reorder/ajax.js';?>"></script>
<ul id="reorder">

		<?php foreach ($cats_list as $row): ?>
			<li id="item-<?php echo $row['section_id'];?>" class="draggable">
					<p>
						<?php echo $row['title'];?>
					</p>
			</li>
		<?php endforeach; ?>
</ul>

<div id="feedback">
</div>
</div>
</div></div>