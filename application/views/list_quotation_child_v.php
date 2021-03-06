<table id = "list_quotation_child<?php echo $quotation_no;?>">
	<thead>
		<tr>
		</tr>
	</thead>
	<tbody>
		<tr>
		</tr>
	</tbody>
</table>

<script type="text/javascript">

	//get currency
	currency = "<?php echo $currency ?>";

	//Datatable Definition
	$(function(){
		
		
		//Attach DataTable
		var childTable= $('#list_quotation_child<?php echo $quotation_no;?>').DataTable({
			"order":[[3,'asc']],
			"aoColumns": [
			{"sTitle":"Quotation Id.","mData":"Quotation_id",
				"mRender":function(data, type, row){
					return '<a>'+row.Quotation_id+'</a>';
				},
				"className":"viewQuotationEntry"
			},
			{"sTitle":"Product","mData":"Sample_name"},
			{"sTitle":"Amount per Batch (<?php echo $currency; ?>)","mData":null,
				"mRender": function (data, type, row) {
					if(row.Currency == 'KES'){
						return accounting.formatMoney(row.Amount_kes, { format: "%v" }); 
					}else{
						return accounting.formatMoney(row.Amount_usd, { format: "%v" }); 
					}
                },
                "fnCreatedCell":function(nTd, sData, oData, iRow, iCol){
				 	$(nTd).css({"background-color":"#FFFFF0", "color":"black"});
				}
			},
			{"sTitle":"Batches","mData":"No_of_batches"},
			{"sTitle":"Amount per Product (<?php echo $currency; ?>)","mData":null,
				"mRender": function (data, type, row) {
                    if(row.Currency == 'KES'){
						return accounting.formatMoney(row.product_total_kes, { format: "%v" }); 
					}else{
						return accounting.formatMoney(row.product_total_usd, { format: "%v" }); 
					}
                },
                "fnCreatedCell":function(nTd, sData, oData, iRow, iCol){
				 	$(nTd).css({"background-color":"#FFFFF0", "color":"black"});
				}
			},
			{"sTitle":"Actions","mData":"Quotations_id",
				"mRender": function (data, type, row) {
                    return '<a class = "edit_quotation"  data-id= '+data+'>Edit</a>&nbsp;|&nbsp;<a class = "print_quotation"  data-id= '+data+'>Print</a>';
                },
                visible:false
			},
			{"sTitle":"Currency","mData":"Currency", "visible":false},
			],
			"columnDefs":[
				{"className": "dt-center", "targets": "_all"}
			],
			"sDom": 'lfrtip',
			"bJqueryUI":false,
			"filtering":false,
			"searching":false,
			"info":false,
			"paging":false,
			"ordering":false,
			"sAjaxDataProp": "",
			"sAjaxSource": '<?php echo base_url()."quotation/getChildEntries/".$quotation_no;?>'
		});
		
		//Add Reference to Quotation
		 $('#list_quotation_child<?php echo $quotation_no;?> tbody').on("click", "a.add_reference", function (e) {
			 
				//Get quotation no
				quotation_no = $(this).attr("data-id");
				
				e.preventDefault();
	            var href = '<?php echo base_url() . "quotation/add_reference/" ?>'+quotation_no;
				
				console.log(href);
				
	            $.fancybox.open({
	                href: href,
	                type: 'iframe',
	                autoSize: false,
	                autoDimensions: false,
	                width: 360,
	                'afterClose':function(){
	                	$('#list_quotation').DataTable().ajax.reload();
	                }
	            })
	        })

		 	//Add New Entry to Quotation
		 $('#list_quotation_child<?php echo $quotation_no;?> tbody').on("click", "a.edit_quotation", function (e) {
			 
				//Get quotation no
				quotation_no = $(this).attr("data-id");
				
				e.preventDefault();
	            var href = '<?php echo base_url() . "quotation/edit/" ?>'+quotation_no;
				
				console.log(href);
				
	            $.fancybox.open({
	                href: href,
	                type: 'iframe',
	                autoSize: false,
	                autoDimensions: false,
	                width: 360,
	                'afterClose':function(){
	                	childTable.ajax.reload();	
	                }
	            })
	        })


		 //Print Quotation Breakdown to Pdf
		 $('#list_quotation_child<?php echo $quotation_no;?> tbody').on("click", "td.viewQuotationEntry", function (e) {
		
	 		//Get row,tr
			var tr = $(this).closest('tr');
        	var row = childTable.row( tr );

        	console.log(tr);

			//Get quotation id
			quotation_no = row.data().Quotations_id;
			
			e.preventDefault();
            var href = '<?php echo base_url() . "client_billing_management/showBillPerTest/" ?>'+quotation_no+'/quotations/tests/q_request_details/q_entry/quotation/'+'<?php echo $quotation_no; ?>';


			console.log(href);
			
            $.fancybox.open({
                href: href,
                type: 'iframe',
                autoSize: false,
                autoDimensions: false,
                width: 1200,
                height: 1200,
                'afterClose':function(){
                	childTable.ajax.reload();
                	tables = $.fn.dataTable.tables(true);
                	console.log(tables)
                }
            })

            
            childTable.on( 'draw', function ( e, settings, json ) {
    			//document.location.href = "http://localhost/NQCL/quotation/listall";
			});
			
        })


		 //Print Quotation
		 $('#list_quotation_child<?php echo $quotation_no;?> tbody').on("click", "a.print_quotation", function (e) {
			 
				//Get quotation no
				quotation_no = $(this).attr("data-id");
				
				e.preventDefault();
	            var href = '<?php echo base_url() . "quotation/printSingleQuotation/" ?>'+quotation_no;
				
				console.log(href);
				
	            $.fancybox.open({
	                href: href,
	                type: 'iframe',
	                autoSize: false,
	                autoDimensions: false,
	                width: 360,
	                //'beforeClose':function(){
	                //getData();
	                //}
	            })
	        })

	})
</script>

