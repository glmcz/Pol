<div id="footer">
        <p class="copy">&copy; POLAHODA.CZ - pozitivní noviny do každé rodiny!</p>		
       	<p class="benchmark">Загружено за {elapsed_time}секунд, использовано {memory_usage}</p>																												
</div>
<?php if ($this->session->flashdata('result') != ''): ?>
	<script type="text/javascript">
	<!--
	$(document).ready(function() {	
		$.jGrowl("<?php echo $this->session->flashdata('result') ?>");	
	});
	//-->				
	</script>
<?php endif; ?>
</body>
</html>