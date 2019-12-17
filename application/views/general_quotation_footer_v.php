<div>&nbsp;</div>
<div class ="quotation_notes">
	<?php //var_dump($current_user) ?> 
		<p><span><strong><?php if($current_user['title']) {echo $current_user['title']."&nbsp;";} echo $current_user['full_name'] ?></strong></span>  /  
		<span><?php $unit = Units::getUnitFromId($current_user['user_unit']); if($unit) {echo $unit[0]['name'];} ?></span> /  
		<span>&nbsp;<?php echo $current_user['user_tel']; ?></span> / 
		<span>&nbsp;<?php echo $current_user['user_email']; ?></span> / 
		<span><?php echo $current_user['session_id']; ?></span> / 
		<span><?php echo date('Y-m-d h:i:s')?></span>
	</p>
	<?php ?>
</div>