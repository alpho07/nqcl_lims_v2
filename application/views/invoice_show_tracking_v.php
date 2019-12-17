<div class="container">
	<div><legend><span class = "link_highlight" >Invoice Tracking &nbsp;|&nbsp;<?php echo $qt_no; ?></span></legend></div>
		<table id ="invoice_tracking_tbl" style="width: 1216px" >
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
</div>

<script type="text/javascript">
	//Init and define inventory tracking table
	var inv_table = $('#invoice_tracking_tbl').DataTable({
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

		],
		"rowCallback":function(row,data){	
			$('td:eq(4)', row).css('background-color', 'lightgray');
		},
		"responsive":true,
		"bJQueryUI":false,
		"sAjaxDataProp":"",
		"sAjaxSource":'<?php echo base_url()."quotation/getInvoiceTrackingAll/$qt_no"?>'
	});
	</script>



