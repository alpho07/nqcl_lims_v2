
<div class="container">	
<div><legend><span class = "link_highlight" >Charges Breakdown&nbsp;|&nbsp;<?php echo $rid; ?>&nbsp;|&nbsp;Total</span><span id = "total" ></span><?php if($source == 'invoice' && !empty($tracking_info)){?> &nbsp;|&nbsp;Discount&nbsp;<span id="title_discount"><?php echo $tracking_info[0]['discount']." %" ?></span>&nbsp;|&nbsp;Payable&nbsp;<span id="title_payable_amount"></span> <?php } ?></legend></div>
<div><input type="hidden" name="totalSansKes" id="total_sansKES"></div>
<?php
//Set currency
$c = $currency[0]['Currency']; 

//Set quotation status
$quotation_status = $approvalStatus;

?>
<hr>
<!--Check if invoice review stage, if yes show client details-->
<?php if($clientInfoStatus) {  ?>
					
			<ul class="menu-list">
				<li>
					<fieldset class="box">
						<legend>Client Info</legend>
							<?php foreach($client_info[0] as $key => $value) { ?>
								<li>
									<?php if(!empty($value) && ($key != 'id' ) && ($key != 'Contact_phone') && ($key != 'Contact_person')) { ?>
										<?php if($key == 'Name'){ ?>	
											<label><?php echo $value ?></label>
										<?php } else {?>
												<label><?php echo $value ?></label>
										<?php } }?>
								</li>
							<?php } ?>
							<li>&nbsp;</li>	
							<li><a target="_blank" href="<?php echo base_url() .'request_management/edit/'.$product_summary[0]['LABORATORY_REF_NO'] ?>">Edit</a></li>
					</fieldset>
				</li>
			</ul>
		<ul class="menu-list">
			<li>
				<fieldset class="box">
					<legend>Product Info</legend>
						<?php foreach ($product_summary[0] as $key => $value) { if(($key != 'id')&&($key != 'Clients_Name')&&($key != 'Clients_Address')&&($key != 'Clients_Email') &&($key != 'Clients')&&($key != 'Coa_number')&&($key !='Request_details')) {?>
							<li>
								<label><b><?php echo $key ?>:</b></label>
								<label><?php echo $value ?></label>
							</li>
						<?php }} ?>
							<li>&nbsp;</li>
							<li><a target="_blank" href="<?php echo base_url() .'request_management/edit/'.$product_summary[0]['LABORATORY_REF_NO'] ?>">Edit</a></li>
				</fieldset>
			</li>			
		</ul>

<?php }?>
<!--div class ="notification is-info">NB: Default methods assumed. <p>Click <strong>Edit</strong> to confirm correct test/method combinations.</p></div-->
					<table id ="breakdown">
						<caption>Cost per test breakdown table</caption>
						<thead>
							<tr>
							</tr>
						</thead>
						<tbody>
							<tr>
							</tr>
						</tbody>
					</table>

					<div>
						&nbsp;
					</div>
	<?php if($source == 'oldview'){?>
<div class = "container">
	<form class = "methods">
		<ul style="margin-left: 5px" >
			<li>
				<fieldset>
					<legend>Finish</legend>
						<li>
							<label>
								<span>
									<input type = "button" data-submitId = "print_later" class = "submit-button leftie print_invoice" value = "Next Quotation Entry" data-table = "<?php echo $table; ?>"
									<hr>
									<input type = "button" data-submitId = "print_now" class = "submit-button-alt print_invoice" value = "Print Quotation So far" data-table = "<?php echo $table; ?>" />
									<hr>
									<input type = "button" data-submitId = "view_all" class = "submit-button-alt print_invoice" value = "View All Quotations" data-table = "<?php echo $table; ?>" />
								</span>
							</label>
						</li>
				</fieldset>
			</li>
		</ul>
	</form>
	<?php } else if($source == 'invoice' || $source == 'quotation' ) {?>

		<form class = "methods">
			<ul style="margin-left: 5px" >
				<li>
					<fieldset>
						<legend></legend>
						<li>
							<table id="invoice_tracking_table">
								<caption>Quotation/Invoice Tracking Table</caption>
								<thead>
									<tr>
									</tr>
								</thead>
								<tbody>
									<tr>
									</tr>
								</tbody>		
							</table>
						</li>
					</fieldset>
				</li>


				<!--li>
					<fieldset>
						<legend>Discount as a Percentage</legend>
							<li>
								<label>
									<span>
										Discount(%)
									</span>
									<span>
										<input id="invoice_discount" type ="text" name="invoice_discount" placeholder="e.g 5%" class="validate[required]">
									</span>

								</label>
							</li>
					</fieldset>
				</li-->
			

			</ul>
			<div>&nbsp;</div>
			<div class="field is-grouped">
			<?php if($approvalStatus <2) { ?>
				<p class="control">
					
							<input id="<?php echo $info_doc ?>_approve" type = "button" data-submitId = "<?php echo $info_doc."_".$info_doc_suffix ?>" class = "button is-primary  is-success print_invoice" value = "<?php echo ucfirst($info_doc_suffix)." ".ucfirst($info_doc); ?>" data-table = "<?php echo $table; ?>">
					
				</p>
				<p class="control">
					
							<input id="invoice" type = "button" data-submitId = "view_all_invoice" class = "button is-primary is-info print_invoice" value = "Show <?php echo ucfirst($info_doc) ?>(s)" data-table = "<?php echo $table; ?>">
					
				</p>
			<?php } else if($approvalStatus >= 2 && $finalStage == true){?>
				<p class="control">
					
							<input id="print_final" type = "button" data-submitId = "print_final" class = "button is-primary is-primary print_invoice" value = "Print to PDF" data-table = "<?php echo $table; ?>">
					
				</p>
			<?php } ?>
			</div>
	</form>
</div>
</div>
	<?php } else if($source == ''){?>

	<?php }?>
<script type="text/javascript">

$(document).ready(function(){

	var status = '<?php echo $approvalStatus; ?>';
	console.log(status);
	if(status>=2){
		console.log($('.rowDetails a').css("pointer-events", "none"));
	}


	//Get quotation status
	var quotation_status = '<?php echo $quotation_status; ?>'
	console.log(quotation_status);

	//Convert PHP array of multicomponent tests to Javascript Array
	var multiTestsArray = [<?php echo json_encode($multi_tests); ?>]
	mt_array = multiTestsArray.toString();
	
	//Datatable
	 var ttable = $('#breakdown').DataTable({
	 	dom:'Bfrtip',
	 	/*"initComplete": function(settings, json){
	 		console.log(json)
	 		if(quotation_status == 1){
	 			$.fancybox.open(
	 				''
	 			);
	 		}
	 	},*/
	 	buttons:[
	 		{
	 			text: 'Add Test',
	 			action: function(e, dt, node, config){
	 				var href = '<?php echo base_url() . "quotation/addTestView/".$rid."/".$c."/".$qt_id ?>';
				        $.fancybox.open({
				            href: href,
				            type: 'iframe',
				            autoSize: false,
				            autoDimensions: false,
				            width: 960,
				            'afterClose':function(){
				                $('#breakdown').DataTable().ajax.reload();
				                $('#invoice_tracking_table').DataTable().ajax.reload();
				        }
				    }) 
	 			}
	 		},
	 		{
	 			text: 'Add Component',
	 			action: function(e, dt, node, config){
	 				var chref = '<?php echo base_url()."quotation/addComponentView/".$rid."/".$c ?>';
	 				$.fancybox.open({
	 					href: chref,
	 					type: 'iframe',
	 					autoSize: false,
	 					autoDimensions: false,
	 					width: 960,
	 					'afterClose':function(){
	 						$('#breakdown').DataTable().ajax.reload();
	 						$('#invoice_tracking_table').DataTable().ajax.reload();
	 					}
	 				})

	 			}
	 		},
	 		{
	 			text:'Print',
	 			extends:'print'
	 		}
	 	],
		"aoColumns": [
			{"sTitle":"+","mData":"tests[].id",
				"mRender":function(data, type, row){
					return '<a><i title = "Show Method(s)" class="fas fa-plus-circle fa-lg"></i></a>';
				},
				"className":"rowDetails"
			},
			{"sTitle":"Test","mData":"tests[].Name",
				"className":"testName"
			},
			{"sTitle":"Method","mData":"test_methods[].name",
				"mRender":function(data, type, full){
					if(data == ''){
						return 'N/A';
					}
					else{
						return data;
					}
				},
				visible: false
			},
			{"sTitle":"Test Total Charge (<?php echo $c; ?>)","mData":"method_charge",
				"mRender":function(data, type, full){
					if(data == 0){
						return 'N/A';
					}
					else{
						return accounting.formatMoney(data, { format: "%v" });
					}
				},
				visible:false
			},
			{"sTitle":"Test Total (<?php echo $c; ?>)","mData":null,
				"mRender":function(data, type, row){
					return accounting.formatMoney(parseInt(row.method_charge), { format: "%v"}); 
				},
				"fnCreatedCell":function(nTd, sData, oData, iRow, iCol){
					$(nTd).css({"font-weight":"bold"});
				}
			},
			{"sTitle":"Compendia","mData":"compendia[].name",
				"mRender":function(data, type, row){
					if(row.compendia_id != null && row.compendia_id != '0'){
						return '<a data-id = '+row.tests[0].id+' data-compendia = '+row.compendia_id+' data-compendiaName ='+row.compendia[0].abbrev+' data-name = '+row.tests[0].Name+' class = "editCompendia">'+data+'</a>';
					}
					else{
						return '<a  title="Click to change compendia"  data-id = '+row.tests[0].id+' data-compendia = '+row.compendia_id+' data-name = '+row.tests[0].Name+' class = "editCompendia"><span><i class="fas fa-plus-square"></i></span>&nbsp;Add</a>';
					}
				}
			},
			{"sTitle":"Remove","mData":"tests[].id",
				"mRender":function(data, type, row){
					return '<a data-id = '+data+' data-name = '+row.tests[0].Name+' class = "removeTest"><span style="color:red"><i class="fas fa-trash-alt red"></i></span></a>'; 
				},
				"className":"actions",
				"orderAble": null
			}],
			"columnDefs":[
				{"className": "dt-center", "targets": "_all"}
			],
		"initComplete":function(settings, json){
			var status = '<?php echo $approvalStatus; ?>';
			if(status>=2){
				$('a').on("click", function(){
					$.fancybox.open(
						'<div class="notification is-warning"><h2>Editing Disabled</h2><p><?php echo ucfirst($info_doc)." "; ?> Approved, cannot be edited.</p></div>'
	 				);
					return false;
				});

				//Disable Buttons
				console.log(ttable.buttons().disable());
			}		
		},
		"bJQueryUI":true,
		"bScrollCollapse":true,
		"bDeferRender":true,
		"bProcessing":true,
		"bDestroy":true,
		"paging":false,
		"bFilter":false,
		"bLengthChange":true,
		"sAjaxDataProp": "",
		"sAjaxSource": '<?php echo base_url()."finance_management/breakdown/$rid/$table/$table2/$table3/$client_id"?>',
		"fnFooterCallback":function(nRow, aaData, iStart, iEnd, aiDisplay){
			//Initialize variable to hold total
			var total = 0;
			var table = "<?php echo $table ?>";

			//Loop through data in table while doing addition of method and tests charges
			for(var i =0; i<aaData.length; i++){
				total += parseFloat(aaData[i].method_charge);
			}


			//format payable amount to include currency
			p_amount = accounting.formatMoney(<?php if($tracking_info){echo $tracking_info[0]['payable_amount'];}else {echo '0';}  ?>, {symbol:"<?php echo $c; ?>", format: "%s %v"});
			$('#title_payable_amount').html(p_amount);
			
			//Format total as money,currency
			f_total = accounting.formatMoney(total, {symbol : "<?php echo $c; ?>", format: "%v %s" });
			
			if(table == "request"){
				//Set total to specified selector
				$('#total').html(f_total);

				discount =10;

				$('#discount_tag').html('10%');

				discounted_f = total*90/100;

				discounted = accounting.formatMoney(discounted_f, {symbol : "<?php echo $c; ?>", format: "%s %v" });

				console.log($('#total_sansKES').val(total));

				$('#discounted').html('<b>'+discounted+'</b>');
			}
			else{
				$('#total').html('<b>'+f_total+'</b>');
				$('#discount_tag').html('0%');
				$('#discounted').html('<b>'+f_total+'</b>');
				console.log($('#total_sansKES').val(total));
			}
		},
		"footerCallback":function(row, data, start, end, display){
			var api = this.api(), data;
			console.log(api)
		}
	});


	//Init and define inventory tracking table
	var inv_table = $('#invoice_tracking_table').DataTable({
		"order": [[ 0, "desc" ]],
		"columnDefs":[{"targets":[0], "visible":false}],
		"aoColumns":[
			{"sTitle":"Id","mData":"id",
				"className":"id",
			},
			{"sTitle":"Date","mData":"date",
				"className":"date"
			},
			{"sTitle":"Notes","mData":"notes",
				"className":"notes"
			},
			{"sTitle":"By","mData":null,
				"mRender":function(data,type,row){
					if(row.User){
						return row.User.fname+" "+row.User.lname;
					}
					else{
						return 'Client';
					}
				},
				"className":"by"
			},
			{"sTitle":"Role","mData":"Role",
				"mRender":function(data,type,row){
					return row.User_type.name;
				},
				"className":"role"
			},
			{"sTitle":"Amount (<?php echo $c; ?>)","mData":"batch_total",
				"mRender":function(data,type,row){
					return accounting.formatMoney(data, {symbol : " ", format: "%s %v" });
				},
				"className":"amount"
			},
			/*{"sTitle":"Discount (%)","mData":"discount",
				"mRender":function(data,type,row){
					return data+"%";
				},
				"className":"discount"
			},
			{"sTitle":"Payable Amount (<?php //echo $c; ?>)","mData":"payable_amount",
				"mRender":function(data,type,row){
					return accounting.formatMoney(data, {symbol : " ", format: "%s %v" });
				}
			},
			{"sTitle":"History","mData":"id",
				"mRender":function(data,type,row){
					return '<a>+</a>';
				},
				"className":"edit_history"
			}*/

		],
		"rowCallback":function(row,data){	
			$('td:eq(4)', row).css('background-color', 'lightgray');
		},
		"bJQueryUI":false,
		"sAjaxDataProp":"",
		"sAjaxSource":'<?php echo base_url()."quotation/getInvoiceTracking/$qt_no/$rid"?>'
	});


	//Child Row , Methods Display
	$('#breakdown tbody').on("click", "td.rowDetails", function(e){
		e.preventDefault();
		
		//Get row,tr
		var tr = $(this).closest('tr');
        var row = ttable.row( tr );

        //Get Test Id
        test_id = row.data().test_id
		
		//Open, close row
		if (row.child.isShown() ) {
            row.child.hide();
            tr.removeClass('shown');
			$(this).html('<i class="fas fa-plus-circle fa-lg"></i>');

			ttable.ajax.reload()
        }
        else {
			
			/*https://datatables.net/forums/discussion/31107/load-child-rows-from-external-data-source-in-html*/
			$.ajax({
                type: 'GET',
                url: '<?php echo base_url()."quotation/listallComponentMethods/".$rid."/"?>'+test_id+'<?php echo "/$table/$c"; ?>',
                 
                success: function (response) {
                    row.child( response ).show();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    row.child( 'Error loading content: ' + thrownError ).show();
                }
            });
            tr.addClass('shown');
			$(this).html('<i class="fas fa-minus-circle fa-lg"></i>');
        }
		
	})

	//Disable

	$('#breakdown tbody').on("click", "a.editTest", function(e){
		e.preventDefault();

        test_id = $(this).attr('data-id') 
        test_name = $(this).attr('data-name');

        console.log(test_name);

        //Edit Ref
        var editRef = '<?php echo base_url()."quotation/editTestView/$rid" ?>/'+test_id+'/'+test_name+'/<?php echo $c; ?>'
        console.log(editRef)

        //Open Fancybox with edit view
    	$.fancybox.open({
			href: editRef,
			type: 'iframe',
			autoSize: false,
			autoDimensions: false,
			width: 960,
			'afterClose':function(){
				$('#breakdown').DataTable().ajax.reload();
			}
		})

	})



	$('#breakdown tbody').on("click", "a.editCompendia", function(e){
		e.preventDefault();

        test_id = $(this).attr('data-id') 
        test_name = $(this).attr('data-name');
        compendia = $(this).attr('data-compendia');
        c_name = $(this).attr('data-compendiaName');
  
        //Edit Ref
        var cEditRef = '<?php echo base_url()."quotation/editCompendiaView/$rid" ?>/'+test_id+'/'+test_name+'/<?php echo $c; ?>/' + compendia + "/" + c_name

        console.log(cEditRef)

        //Open Fancybox with edit view
    	$.fancybox.open({
			href: cEditRef,
			type: 'iframe',
			autoSize: false,
			autoDimensions: false,
			width: 960,
			'afterClose':function(){
				$('#breakdown').DataTable().ajax.reload();
				$('#invoice_tracking_table').DataTable().ajax.reload();
			}
		})

	})




	$('#breakdown tbody').on("click", "a.removeTest", function(e){
		e.preventDefault();

		//Get row,tr
		var tr = $(this).closest('tr');
        var row = ttable.row( tr );

        //Get test id
        test_id = row.data().test_id
        test_name = row.data().tests[0].Name
        test_cost = row.data().method_charge

       //Confirm removal of test


	})




$('.print_invoice').on("click", function(){
	
	submit_id=  $(this).attr("data-submitId");
	console.log(submit_id);
	
	table = $(this).attr("data-table");
	console.log(table)

	
	if(table == 'request'){
	    	href = '<?php echo base_url()."quotation/invoiceExtras/$rid/$table/$table2/$table3/"; ?>'
			save_url = '<?php echo base_url()."quotation/saveProforma/$rid/$table/$table2/$table3/"; ?>'
	}
	else if(table == 'quotations'){
		if(submit_id == 'print_now') {
			href = '<?php echo base_url()."quotation/quotationExtras/$qt_no/$table/$table2/$table3/"; ?>'
			save_url = '<?php echo base_url()."quotation/saveQuotation/$rid/$table/$table2/$table3/"; ?>'
		}
		else if(submit_id == 'view_all_invoice'){
			href = '<?php echo base_url()."quotation/invoices/"; ?>' 
			save_url = '<?php echo base_url()."quotation/saveQuotation/$rid/$table/$table2/$table3/"; ?>'
		}
		else if(submit_id == 'print_later'){
			href = '<?php echo base_url()."quotation/generate/$rid/$table/$table2/$table3/"; ?>' + "/<?php echo $qt_no;?>" 
			save_url = '<?php echo base_url()."quotation/saveQuotation/$rid/$table/$table2/$table3/"; ?>'
		}
		else if(submit_id == 'invoice_approve'){
			save_url = '<?php echo base_url()."quotation/approveQuotation/$request_id/$rid/$info_doc"; ?>',
			href = '#'
		}
		else if(submit_id == 'invoice_print'){
			save_url = '<?php echo base_url()."quotation/approveQuotation/$request_id/$rid/$info_doc"; ?>',
			href = '#'
		}
		else if(submit_id == 'quotation_print'){
			href = '<?php echo base_url()."quotation/quotationExtras/$qt_no/$table/$table2/$table3/"; ?>'
			save_url = '<?php echo base_url()."quotation/saveQuotation/$rid/$table/$table2/$table3/"; ?>'	
		}
		else if(submit_id == 'quotation_approve'){
			save_url = '<?php echo base_url()."quotation/approveQuotation/$request_id/$rid/$info_doc"; ?>',
			href = '#'
		}
		else if (submit_id == 'print_final'){
			save_url = '<?php echo base_url()."coa/generatecoa_invoice2/$request_id/$rid/$info_doc"; ?>',
			href = '<?php echo base_url()."invoices/" ?>'+"Invoice_"+'<?php echo $request_id; ?>'+".pdf";
		}
	}
	else if(table == "invoice"){
		href = '<?php echo base_url()."quotation/invoiceExtras/$rid/$table/$table2/$table3/"; ?>'
		save_url = '<?php echo base_url()."quotation/saveInvoice/$rid/$table/$table2/$table3/"; ?>'
	}




	if(submit_id != 'invoice_approve' && submit_id != 'quotation_approve'){
		$.ajax({
			type:'POST',
			url: save_url
		}).done(function(response){

			//Depending on button clicked redirect appropriately
			if(submit_id =='print_final'){
				console.log(href);
				parent.$.fancybox.open({
			        href: href,
			        type: 'iframe',
			        autoSize: false,
			        height: 842,
			        width: 595,
			        'afterClose':function(){
					    $('#list_quotation').DataTable().ajax.reload();
					}
	            })
			}
			else{
				parent.$.fancybox.close();
				if(submit_id != 'invoice_approve' || submit_id != 'quotation_approve'){
					parent.location.href = href
				}
			}	
		})
	}
	else{

		//Get total 
		var tests_total = $('#total_sansKES').val();
		var tests_total_int  = parseInt(tests_total);
		console.log(tests_total)

		//Get discount
		var discount = $('#invoice_discount').val();

		//Get discounted total
		var discounted_total = (100-discount)/100*tests_total_int;

		//Set currency and formatting
		var plain_total = accounting.formatMoney(tests_total_int, {symbol : "<?php echo $c; ?>", format: "%s %v" });
		console.log(plain_total);

		$('<div id = "dialog-confirm" title = "Approve <?php echo $info_doc ?>"><span>Approve <b><?php echo $rid ?></b> of Total <b>'+plain_total+'</b></span></div>').dialog({
			resizable:false,
			height:"auto",
			width: 400,
			modal:true,
			close:function(){
				console.log(parent.$.fancybox.close());
			},
			buttons:{
				"Approve": function(){
					$.ajax({
						type:'POST',
						data: $('.methods').serialize(),
						dataType: "json",
						url:save_url
					}).done(function(){
						
					})
				
					//Close Dialog
					$(this).dialog("close");
				},
				"Cancel":function(){
					$(this).dialog("close");
				}
			}
		})
	}	


})

})


</script>
