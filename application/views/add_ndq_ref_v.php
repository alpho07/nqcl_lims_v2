		<div>
			<form class = "methods">
				<ul>
					<?php //if($entries[0]['Quotation_entries'] == $completed[0]['completed'] ){ ?>
					<li>
						<fieldset>
							<legend>Quotation Summary</legend>
							<?php foreach($quotation_summary[0] as $key => $value) { ?>
								<li>
									<?php if(!empty($value) && ($key != 'id' )) { ?>
										<label><?php echo $value; ?></label>
									<?php }?>
								</li>
							<?php } ?>	
						</fieldset>
					</li>
					<li>
						<fieldset>
							<legend>NDQD Number</legend>	
							<small>Enter NDQD Number for this quotation.</small>	
							<input type="text" id="ndq_ref" name="ndq_ref">
						</fieldset>
					</li>
					<?php //}?>
					<li>
						<fieldset>
							<legend>Finish</legend>
								<li>
									<label>
										<span>
											<input type = "button" data-submitId = "print" class = "submit-button leftie print_invoice" value = "Print">
										</span>
									</label>
								</li>
						</fieldset>
					</li>
				</ul>
			</form>
		</div>

<script type="text/javascript">
	$(document).ready(function(){

	$('.print_invoice').live("click", function(){
	
	submit_id=  $(this).attr("data-submitId");
	ndq_ref = $('#ndq_ref').val();
	
	saveNDQHref = '<?php echo base_url()."quotation/save_reference/$reqid"; ?>/'+ndq_ref;
	
		$.ajax({
            type:'POST',
            url:saveNDQHref
        }).done(function(response) {
                parent.$.fancybox.close();
                $('#list_quotation_child<?php echo $quotation_no;?>').DataTable().ajax.reload();
            }) 
		})
	})

</script>