
	<table id = "list_componentmethods<?php echo $quotation_id.$test_id;?>">
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

		//Datatable Definition
		$(function(){
			
			
			//Attach DataTable
			var childTable= $('#list_componentmethods<?php echo $quotation_id.$test_id;?>').DataTable({
				dom:'lfrtip',
				"order":[[0,'desc']],
				"aoColumns": [
				{"sTitle":"+","mData":"Test_methods[].id",
					"mRender": function(data, type, full){
						return '<a title = "Show Method(s)" class= "editMethod"><i class="fas fa-plus-circle"></i></a>'
					},
				},
				{"sTitle":"Component","mData":"component"},
				{"sTitle":"Method","mData":"Test_methods[].name"},
				{"sTitle":"Cost","mData":"Test_methods[].charge_<?php echo strtolower($currency);?>",
					"mRender":function(data, type, full){
						return accounting.formatMoney(data, { format: "%v" });
						}
				},
				{"sTitle":"Actions","mData":"Test_methods[].id",
					"mRender": function(data, type, full){
						return '<a title = "Remove Component" class= "removeComponent is-danger is-small"><span style="color:red"><i class="fas fa-trash-alt red"></i></span>&nbsp;</a>'
					},
				}
				],
				"columnDefs":[
					{"className": "dt-center", "targets": "_all"}
				],
				"bJqueryUI":true,
				"filtering":false,
				"searching":false,
				"info":false,
				"paging":false,
				"destroy":true,
				"ordering":false,
				"sAjaxDataProp": "",
				"sAjaxSource": '<?php echo base_url()."finance_management/methodsBreakdown/".$quotation_id."/$table/".$test_id."/".$currency;?>'
			});
			
		
			//Table action scripts
			 $('#list_componentmethods<?php echo $quotation_id.$test_id;?> tbody').on("click", "a.editMethod", function (e) {
			 
			 	//Prevent Default href behaviour
			 	e.preventDefault();

				//Get row,tr
				var tr = $(this).closest('tr');
	        	var row = childTable.row( tr );

				//Get method id
				method_id = row.data().Test_methods[0].id;
				
			    //Open,close row
				if ( row.child.isShown() ) {
		            row.child.hide();
		            tr.removeClass('shown');
					$(this).html('<i class="fas fa-plus-circle"></i>');

					childTable.ajax.reload();
		        }
		        else {
					
					/*https://datatables.net/forums/discussion/31107/load-child-rows-from-external-data-source-in-html*/
					$.ajax({
		                type: 'GET',
		                url: "<?php echo base_url()?>quotation/editMethodView/"+method_id+"/<?php echo $test_id.'/'.$quotation_id ?>/"+row.data().id+"/"+row.data().component,
		                 
		                success: function (response) {
		                    row.child( response ).show();
		                },
		                error: function (xhr, ajaxOptions, thrownError) {
		                    row.child( 'Error loading content: ' + thrownError ).show();
		                }
		            });
		            tr.addClass('shown');
					$(this).html('<i class="fas fa-minus-circle"></i>');
		        }
	        })

		})
	</script>

