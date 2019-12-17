<div class="quotation_notes">
	<p><strong>Please Note</strong></p>
	<?php foreach($default_notes as $dn){ ?>
		<?php if($dn['note_id'] == 0) { echo "<p>".$dn['id'].".".$dn['system_note'] ."</p>"; } else{ echo "<p style='padding-left: 30px;'>&nbsp;".$dn['system_note'] ."</p>"; } ?>
	<?php }?>	
</div>
<div class="spacer">&nbsp;</div>



	


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
			background-color: #d4d4d4;
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