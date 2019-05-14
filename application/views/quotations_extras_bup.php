	
	<!--Get Currency-->	
	<?php $c = $currency[0]['currency'];?>

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
							<legend>Extras</legend>	
							<small>Reporting fee and discount are percentages of total test charges &nbsp;<b><?php echo $c; ?>&nbsp;</b><b id="total"><?php echo $quotation_total[0]['sum']; ?>&nbsp;</b>.Admin fee is an amount in <b><?php echo $c; ?></b>. <e>Enter 0 if does not apply.</e></small>	
							<?php foreach($extra_columns as $xc) { ?>
								<li>
									<label>
										<span><?php echo ucwords(str_replace("_", " ",$xc['column'])); ?></span>
										<input name = "<?php echo $xc['column']; ?>" id = "<?php echo $xc['column']; ?>" placeholder = "<?php echo $xc['comment'] ?>" value ="0" />
										<?php echo $xc['comment']; ?>
									</label>
								</li>
							<?php }?>
						</fieldset>
					</li>
					<li>
						<fieldset>
							<legend>Signatory Selection</legend>
							<li>
								<label>
									<span>Signatory</span>
									<select id = "signatory_name" name = "signatory_name">
										<?php foreach($signatories as $s) { ?>
											<option value = "<?php echo $s["fname"].' '.$s["lname"]; ?>" data-title = "<?php echo $s["Users_types"][0]["User_type"][0]["name"]; ?>" ><?php echo $s["fname"].' '.$s["lname"]; ?></option>
										<?php } ?>	
									</select>
								</label>
							</li>
						</fieldset>
					</li>
					<?php //}?>
					<li>
						<fieldset>
							<legend>Finish</legend>
								<li>
									<label>
										<span>
											<input type = "button" data-submitId = "print" class = "submit-button leftie print_invoice" value = "Print" data-table = "<?php echo $table; ?>"
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
	console.log(submit_id);
	
	table = 'quotations';
	console.log(table)
	
	//Get Signatories
	signatory = $('#signatory_name').val();
	signatory_title = $('#signatory_name option:selected').attr("data-title");
	
	
	//Get Extras
	var extras = [];
	<?php foreach($extra_columns as $xc) { ?>
	val = $('#<?php echo $xc['column'] ?>').val()
	extras.push(val);
	<?php }?>
	
	//Replace commas with slashes
	xt = extras.toString();
    xt = xt.replace(/,/g , '/');
	
	if(table == 'request'){
		//Url to generate pdf function
		gen_invoice_href = '<?php echo base_url()."quotation/printProforma/$rid/$table/$table2/$table3/$client_id/"; ?>' + signatory_title + "/" + signatory
		console.log(gen_invoice_href);
		
		//Url to show pdf function
		show_invoice_href = '<?php echo base_url()."proformas/" ?>' + "Proforma_" + '<?php echo $rid; ?>' + ".pdf"; 
	    
	}
	else if(table == 'quotations'){
		gen_invoice_href = '<?php echo base_url()."quotation/printQuotation/$rid/$table/$table2/$table3/"; ?>' + signatory_title + "/" + signatory + "/" + xt
		show_invoice_href = '<?php echo base_url()."quotations/" ?>' + "Quotation_" + '<?php echo $rid; ?>' + ".pdf";
	}
	else if(table == "invoice"){
		gen_invoice_href = '<?php echo base_url()."quotation/printInvoice/$rid/$table/$table2/$table3"; ?>' + signatory_title + "/" + signatory 
		show_invoice_href = '<?php echo base_url()."invoices/" ?>' + "Invoice_" + '<?php echo $rid; ?>' + ".pdf";
	}
	
		$.ajax({
            type:'POST',
            url:gen_invoice_href
        }).done(function(response) {
                console.log(show_invoice_href);
                parent.$.fancybox.open({
                    href: show_invoice_href,
                    type: 'iframe',
                    autoSize: false,
                    height: 842,
                    width: 595 
                });
            }) 
		})
	})

</script>