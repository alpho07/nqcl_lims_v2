<div class="quotation_notes">
	<p><strong>Please Note</strong></p>
	<?php foreach($default_notes as $dn){ ?>
		<?php if($dn['note_id'] == 0) { echo "<p>".$dn['id'].".".$dn['system_note'] ."</p>"; } else{ echo "<p style='padding-left: 30px;'>&nbsp;".$dn['system_note'] ."</p>"; } ?>
	<?php }?>	
</div>
<div class="spacer">&nbsp;</div>
<div class ="quotation_notes">
	<?php //var_dump($current_user) ?> 
		<p><strong><?php if($current_user['title']) {echo $current_user['title']."&nbsp;";} echo $current_user['full_name'] ?></strong></p>
		<p><?php $unit = Units::getUnitFromId($current_user['user_unit']); if($unit) {echo $unit[0]['name'];} ?></p>
		<p>National Quality Control Laboratory</p>
		<p>Tel:&nbsp;<?php echo $current_user['user_tel']; ?></p>
		<p>Email:&nbsp;<?php echo $current_user['user_email']; ?></p>
	<?php ?>
</div>



	


	<style type="text/css">
		.plain_bold_inline{
			font-weight:bold;
		}
		.centered{
			text-align: center;
		}
		.gray{
			background-color: #E5E4E2;
		}
		.smalltext{
			font-size: 0.8em;
		}

		.quotation_notes{
			font-size:0.8em;
			line-height: 90%
		}

		.zebra_striping{
			background-color: #fafafa;
		}
		.reducedtext{
			font-size: 0.9em;
		}

		.pdfFooter{
			position:absolute;
			bottom:0;
			width:100%;
		}

	</style>