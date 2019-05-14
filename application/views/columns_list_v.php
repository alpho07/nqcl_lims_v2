<html>
<div class ="content">
		<legend><a href="<?php echo site_url()."inventory/"; ?>">Inventory Home</a>&nbsp;&larr;&nbsp;<span class ="link_highlight">Columns Inventory</span>&nbsp;&rarr;&nbsp;<a href="<?php echo site_url()."inventory/columnsadd"; ?>">Add Columns</a></legend>
	<div style="float:right;">
	<form action="<?php echo base_url();?>inventory/ExcelGeneratorColumns/" method="POST">
	<!--select name="column_types">
	<option value="">-Type-</option>
	<?php foreach ($types as $t):?>
	<option value="<?php echo $t->id;?>"><?php echo $t->column_type;?></option>
	<?php endforeach;?>
	</select><br>
	<select name="dimensions">
	<option value="">-Dimensions-</option>
	<?php foreach ($dimensions as $t):?>
	<option value="<?php echo $t->id;?>"><?php echo $t->column_dimensions;?></option>
	<?php endforeach;?>
	</select><br>
	<select name="issuedto">
	<option value="">-Issued To-</option>
		<?php foreach ($analystsd as $t):?>
	<option value="<?php echo $t['id'];?>"><?php echo $t['fname'] ." ".$t['lname'];?></option>
	<?php endforeach;?>
	</select><br>
	<select name="status">
	<option value="">-Status-</option>
	<option value="1">In Use</option>
	<option value="0">Decommissioned</option>
	</select><br-->
	<input type="submit" value="Export"/>
	</form>
	</div>
	

<table id = "cols">
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
		$(function(){

			var rtable;

			function getData(){
				if (typeof rtable == 'undefined') {
					rtable = $('#cols').dataTable({
				"bJQueryUI": true,
				"aoColumns": [
				{"sTitle":"Column Type","mData":null,
					"mRender":function(data, type, row){
						return row.column_types.column_type;
					}
				},
				{"sTitle":"Column Number","mData":"column_no"},
				{"sTitle":"Serial No.","mData":"serial_no"},
				{"sTitle":"Dimensions","mData": null,
					"mRender":function(data, type, row){
						return row.column_types.column_dimensions;
					}
				},
				{"sTitle":"Manufacturer","mData": null,
					"mRender":function(data, type, row){
						return row.column_types.manufacturer;
					}
				},
				{"sTitle":"Quantity Received","mData": null,
					"mRender":function(data, type, row){
						return row.column_types.quantity_received;
					}
				},
				{"sTitle":"Date Received","mData": null,
					"mRender":function(data, type, row){
						return row.column_types.date_received
					}
				},
				{"sTitle":"Status","mData": null,
					"mRender":function(data, type, row){
						if(row.column_status == '1'){
							return 'In Use';
						}
						else{
							return 'Decommissioned';
						}
					}
				},
				{"sTitle":"Issued To","mData":null,
						"mRender":function(data, type, row){
							if (row.column_issue.user != null){
								return row.column_issue.user.fname + " " + row.column_issue.user.lname;	
							}
							else{
								return 'Not Issued';
							}
						}},
				{"sTitle":"Issue Date","mData":"id",
						"mRender":function(data, type, row){
							if(row.column_issue != null){
								return row.column_issue.issue_date
							}
							else {
								return '-';
							}
						}
					},
				{"sTitle":"Edit","mData":"id",
						"mRender":function(data, type, full){
							return '<a class="edit" id = '+data+' >Edit</a>';
						}
					},	
				{"sTitle":"History","mData":"id",
						"mRender":function(data, type, row){
							if(row.edit_status == '1'){
								return '<a class="history" id = '+data+' >Show</a>';
							}
							else{
								return 'No Edits';
							}
						}
					}			
				],
				"bDeferRender":true,
				"bProcessing":true,
				"bDestroy":true,
				"bLengthChange":true,
				"iDisplayLength":16,
				"sAjaxDataProp": "",
				"sAjaxSource": '<?php echo site_url()."inventory/clmnlist"?>',	
			});
				}
			else {
				rtable.fnDraw();
				}
			}

			$('.edit').live("click",function(e){
				e.preventDefault();
				var href = '<?php echo base_url()."inventory/columns_fancybox/" ?>' + $(this).attr('id')
				console.log(href);
				$.fancybox.open({
					href : href,
					type: 'iframe',
					autoSize: false,
					autoDimensions : false,
					width:400,
					height: 500,
					'beforeClose' : function(){
						getData();
					}
				});
				return(false);
			})
			getData();

			$('.issue').live("click",function(e){
				e.preventDefault();
				var href = '<?php echo base_url()."inventory/columns_fancybox_issue/" ?>' + $(this).attr('id')
				console.log(href);
				$.fancybox.open({
					href : href,
					type: 'iframe',
					autoSize: false,
					autoDimensions : false,
					width:400,
					height: 500,
					'beforeClose' : function(){
						getData();
					}
				});
				return(false);
			})
			getData();

			$('.delete').live("click", function(){
				var column_id = $(this).attr('id');
				var name = $(this).attr('data-aname');
				$('<span>Are you sure?</span>').dialog({
					resizable: false,
					height:140,
					modal: true,
					buttons:{
						"Yes":function(){
							$.ajax({
								type: 'POST',
								url: '<?php echo base_url() . "inventory/column_delete/"?>' + column_id,
								dataType: "json",
								success:function(){
								},
								error:function(){
								}
							})
							$(this).dialog("close");
							getData();
						},

						"No":function(){
							$(this).dialog("close");
						}

					}
				})
			})
			getData();

			/*$('.history').live("click", function(e){
				e.preventDefault();
				var href = 
				console.log(href);
				$.fancybox.open({
					href : href,
					type: 'iframe',
					autoSize: false,
					autoDimensions : false,
					width:400,
					height: 500,
					'beforeClose' : function(){
						getData();
					}
				});
				return(false);
			})*/

	$('.history').live("click",function(e){
		e.preventDefault();
		var nTr = this.parentNode.parentNode;
			
			if($(this).text() == 'Show'){
				
			   $(this).text("Hide");
				
				//alert("Under Construction");
				
				var id = $(this).attr("id");
				//var type = $(this).attr("rel");
			
				$.post("<?php echo site_url('inventory/columns_showHistory'); ?>" + "/" + id , function(history){
					
					rtable.fnOpen(nTr, history, 'history');
				})
				
				
			}
			
			
			else{

				rtable.fnClose(nTr);
				
				$(this).text("Show");	
				
			}
			
			
		})
	})
</script>

</html>