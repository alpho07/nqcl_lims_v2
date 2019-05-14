<div class ="content">
<a href = "<?php echo base_url().'user_registration_admin/addUser' ?>"><span><b><h2>Add New User</h2></b></span></a>
<table id = "users">
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

var rtable;


function getData(){
	if (typeof rtable == 'undefined') {
		rtable = $('#users').dataTable({
	"bJQueryUI": true,
	"aoColumns": [
	{"sTitle":"First Name","mData":"fname"},
	{"sTitle":"Last Name","mData":"lname"},
	{"sTitle":"User Name","mData":"username"},
	{"sTitle":"Email", "mData":"email"},
	{"sTitle":"Telephone","mData":"telephone"},
	{"sTitle":"Department","mData":null,
		"mRender":function(data, type, row){
			if(row.Departments != null){
				return row.Departments.Name
			}
			else{
				return 'Dept not set'
			}
		}
	},
	{"sTitle":"User Type","mData":null,
		"mRender":function(data, type, row){
			if(row.User_type != null){
				return row.User_type.name	
			}
			else{
				return 'User type not set'
			}
			
		}
	},
	{"sTitle":"Status","mData":"acc_status",
		"mRender":function(data, type, full){
			if(data == '0'){
				return 'Deactivated'
			}
			else if(data == '1'){
				return 'Activated'
			}
		}
	},
	{"sTitle":"Edit", "mData":null,
	"mRender":function(data, type, row){
		return '<a class = "edit" id = "'+row.id+'" >Edit</a>';
		}},
		{"sTitle":"","mData":"id", 
	"mRender":function(data, type, full){
			return '<a class="reset_password" href="<?php echo site_url()."user_registration_admin/user_password_reset/"?>'+data+'" id = '+data+' >Reset Password</a>';
		} },	
	{"sTitle":"Edit History","mData":null,
		"mRender":function(data, type, row){
			if(row.edit_status == '1'){
				return '<a class="history" id = '+row.id+' >Show</a>';
			}
			else{
				return 'No Edits';
			}
		}
	}
	],
	"sScrollY": "300px",
    "sScrollX": "100%",
	"bDeferRender":true,
	"bProcessing":true,
	"bDestroy":true,
	"bLengthChange":true,
	"iDisplayLength":16,
	"sAjaxDataProp": "",
	"sAjaxSource": '<?php echo site_url()."user_registration_supervisor/requests_list"?>',	
});
	}
else {
	rtable.fnDraw();
	}
}

$(document).ready(function(){
	$('.edit').live("click",function(e){
		e.preventDefault();
		var href = '<?php echo base_url()."user_registration_admin/edit_view/" ?>' + $(this).attr('id')
		console.log(href);
		$.fancybox.open({
			href : href,
			type: 'iframe',
			autoSize: false,
			autoDimensions : false,
			enableEscapeButton: true,
			width:600,
			height: 700,
			'beforeClose' : function(){
				getData();
			},
			'afterClose':function () {
        		window.location.reload();
   			}
		});
		return(false);
	})
	getData();

		$('.history').live("click",function(e){
					e.preventDefault();
					var nTr = this.parentNode.parentNode;
						
						if($(this).text() == 'Show'){
							
						   $(this).text("Hide");
							
							//alert("Under Construction");
							
							var id = $(this).attr("id");
							//var type = $(this).attr("rel");
						
							$.post("<?php echo site_url('user_registration_supervisor/users_showHistory'); ?>" + "/" + id , function(history){
								
								rtable.fnOpen(nTr, history, 'history');
							})
							
							
						}
						
						
						else{

							rtable.fnClose(nTr);
							
							$(this).text("Show");	
							
						}
		})



})

$(".reset_password").live("click",function(event){
   event.stopPropagation();
   if(confirm("Reset User Password?")) {
    this.click;
	user_id=$(this).attr('id');
	
	$.ajax({
		type:"POST",
		url:"<?php echo base_url()."user_registration_admin/user_password_reset/"?>"+user_id,
		success:function(message){
			message='Password Reset Successfully';
			alert(message);
			window.location.href = '<?php echo base_url()."user_registration_admin/" ?>';
		},
		error:function(message){
			alert('An error occured');
		}
		
		
		})
      // window.location = $(this).attr('href');
	//  
   }       
   event.preventDefault();
})
</script>
</script>