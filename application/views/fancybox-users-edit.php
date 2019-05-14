<html>
	<title>User Details</title>
	<head></head>
	<!--body-->
		<form class = "methods" id = "<?php echo $formname ?>" >
		<!--fieldset-->
			<h3>Edit User</h3>
			<ul>
				<li>
			<fieldset>
				<legend>Personal Info</legend>		
				<li>
					<label>
						<span>Title</span>
						<select class = "validate[required]" name = "title" id = "title<?php echo $user_data[0]['id'] ?>" >
							<option value = "Mr." >Mr.</option>
							<option value = "Mrs." >Mrs.</option>
							<option value = "Dr." >Dr.</option>
							<option value = "Ms" >Ms</option>
							<option value = "Prof" >Prof.</option>
						</select>
					</label>
				</li>		
				<li>
					<label>
						<span>First Name</span>
						<input name="fName" value= "<?php echo $user_data[0]['fname'] ?>" class ="validate[required]" placeholder ="e.g Daniel" type="text" />
					</label>
				</li>
				<li>
					<label>
						<span>Surname</span>
						<input name="lName" value= "<?php echo $user_data[0]['lname'] ?>" class ="validate[required]" placeholder ="e.g Mburu" type="text" />
					</label>
				</li>
				<li>
					<label>
						<span>Other Names</span>
						<input name="oNames" value= "<?php echo $user_data[0]['other_names'] ?>" class ="optional" placeholder ="e.g Mburu" type="text" />
					</label>
				</li>

				<li>
					<label>	
						<span>Telephone</span>
						<input name="tPhone" value= "<?php echo $user_data[0]['telephone'] ?>" class ="validate[required]" placeholder ="e.g BD" type="text" />
					</label>	
				</li>
				<li>
					<label>
						<span>Email Address</span>
						<input name="email" value= "<?php echo $user_data[0]['email'] ?>" class ="validate[required, custom[email]]" placeholder ="e.g dmburu@nqcl.go.ke" type="email" id = "email_address" />			
					</label>
				</li>	
			</fieldset>
		</li>
				<li>
					<fieldset>
						<legend>Unit Details</legend>
						<li>
							<label>
								<p class = "smalltext"><?php echo $user_data[0]['Departments']['Name'] ?>&nbsp;&raquo;&nbsp;<?php if($user_data[0]['Units'] != null) { echo $user_data[0]['Units']['name']; } else { echo "No Unit"; } ?>
									&nbsp;&raquo;&nbsp;<?php for($i=0; $i < count($user_data[0]['Users_types']); $i++) { echo $user_data[0]['Users_types'][$i]['User_type'][0]['name'] . "   "; }?>
								</p>
							</label>
						</li>
						<li>
							<label>
								<span>Division</span>
									<select name="deptID" id = "dept<?php echo $user_data[0]['id'] ?>" data-deptid = "depts" >
										<option>--Select Division--</option>
										<?php foreach($depts as $dept) {?>
											<option value = "<?php echo $dept -> id ?>" ><?php echo $dept -> Name ?></option>
										<?php }?>
				 					</select>
		 					</label>
						</li>
						<li><hr></li>
						<li>
							<label id = "units_label" >
								<span id = "units_span" ></span>
									<select id = "units" class = "hidden2" name="unit" class = "validate[required]" ></select>
							</label>
						</li>
						<li>
								<label id = "roles" ></label>
						</li>
					</fieldset>

				</li>
				<li>
					<fieldset>
						<legend>Other</legend>
							<li>
								<label>
									<span>Status</span>
									<select class = "validate[required]" name="acc_status" id ="status<?php echo $user_data[0]['id'] ?>" >
										<option value = "1" >Active</option>
										<option value = "0" >Inactive</option>
									</select>
								</label>
							</li>
							<li>
								<label>
									<span>Comment</span>
									<textarea class = "validate[required]" name = "comment" ></textarea>
								</label>
							</li>
							
					</fieldset>	
				</li>
				
				<input type = "hidden" name ="dbid" value ="<?php echo $user_data[0]['id'] ?>"  />
				<input type = "hidden" id ="db_department_id<?php echo $user_data[0]['id'] ?>" value ="<?php echo $user_data[0]['department_id'] ?>" />
				<input type = "hidden" id ="db_dept<?php echo $user_data[0]['id'] ?>" value ="<?php echo $user_data[0]['department_id'] ?>" />
				<input type = "hidden" id ="db_status<?php echo $user_data[0]['id'] ?>" value ="<?php echo $user_data[0]['acc_status'] ?>" />
				<input type = "hidden" name ="db_email" id ="db_email<?php echo $user_data[0]['id'] ?>" value ="<?php echo $user_data[0]['email'] ?>" />
				<input type = "hidden" id ="db_title<?php echo $user_data[0]['id'] ?>" value ="<?php echo $user_data[0]['title'] ?>" />
				<input type = "hidden" id ="db_unit<?php echo $user_data[0]['id'] ?>" value ="<?php echo $user_data[0]['Units']['id']; ?>" />
				<?php for($i=0; $i < count($user_data[0]['Users_types']); $i++) { ?>
					 <input type = "hidden" id="db_usertype<?php echo $user_data[0]['id'] ?>" value="<?php echo $user_data[0]['Users_types'][$i]['User_type'][0]['id'] ?>" />
				<?php } ?>

			<li>
					<input value="Save" type="submit" class = "submit-button leftie" />
				</li

			</ul>
		<!--/fieldset-->
	</form>
	<!--/body-->

	<script type = "text/javascript">
	<?php 
		$userarray = $this->session->userdata;
		$user_type = $userarray['usertype_id'];
	?>

	$("#status<?php echo $user_data[0]['id'] ?> option").each(function(){
		if($(this).val() == $("#db_status<?php echo $user_data[0]['id'] ?>").val()){				
			$(this).attr("selected", "selected");
		}
	})

	$("#title<?php echo $user_data[0]['id'] ?> option").each(function(){
		if($(this).val() == $("#db_title<?php echo $user_data[0]['id'] ?>").val()){				
			$(this).attr("selected", "selected");
		}
	})

	$("#dept<?php echo $user_data[0]['id'] ?> option").each(function(){
		if($(this).val() == $("#db_dept<?php echo $user_data[0]['id'] ?>").val()){				
			$(this).attr("selected", "selected");
		}
	})

	var utype = "<?php echo (int)$user_type ?>"

	//If logged in User is a supervisor, not Admin
	if(utype == '2'){
		$('.Tier3, .Tier4, .Tier5').toggle(false);
	}
	else{
		$('.Tier3, .Tier4, .Tier5').toggle(true);
	}
	

	$('[data-deptid="depts"]').on('change', function(){
		var dept = $(this).val();
		var units_url = '<?php echo base_url()."user_registration/getUnits/" ?>' + dept;
		var user_type_url = '<?php echo base_url()."user_registration/getRoles/" ?>' + dept;					
			$.ajax({
					type: 'POST',
					url: units_url,
					dataType: "json"
					}).done(function(response){
						if(response.length){
										var opts = [];
										opts.push("<option value = '' ></option>");
										for(i=0;i<response.length;i++){
											opts.push("<option class = 'unit' value = '"+response[i].id+"' >"+response[i].name+"</option>");
									}
									$("#units").toggle(true).html(opts);
									$('#units_span').text('Unit');
								}
								else {
									$("#units").toggle(false).html('');
									$('#units_span').text('');
								}

								$.ajax({
									type:'POST',
									url:user_type_url,
									dataType: "json"
								}).done(function(response2){
									console.log(response2)
									var checkbox_array = [];
									for(i=0;i<response2.length;i++){
										checkbox_array.push("<li data-unit = '"+response2[i].unit+"' class='Tier"+response2[i].tier+"'><input type = 'checkbox' data-unit = '"+response2[i].unit+"' class='Tier"+response2[i].tier+"' name='userType[]' value='"+response2[i].id+"' /><span class = 'unit_name'>"+response2[i].name+"</span></li>");
									}
									$('#roles').toggle(true).html(checkbox_array);
								})

					}).fail({
				})
			})	

$("#units").on('click', 'option', function(){
	var unit_id = $(this).val();
	var $this = $(this);
	if($this.is(":selected")){
		$('#roles li[class = "Tier2"][data-unit = '+unit_id+']').toggle(true);
		$('#roles li[class = "Tier2"]').not('[data-unit = '+unit_id+']').not('[data-unit = 0]').toggle(false);
	}
	else{
		$('#roles li[class = "Tier2"][data-unit = '+unit_id+']').toggle(false);
		$('#roles li[class = "Tier2"]').not('[data-unit = '+unit_id+']').not('[data-unit = 0]').toggle(true);
	}
})



$('#roles').on('click', 'input', function(){
    var $this = $(this);
    console.log($this);
    if ($this.is(".Tier1")) {
        if ($(".Tier1:checked").length > 0) {
            $(".Tier3,.Tier4,.Tier5").prop({ disabled: true, checked: false });
        } else {
            $(".Tier3, .Tier4, .Tier5").prop({ disabled: false, checked: false });
        }
    } else if ($this.is(".Tier2")) {
        if ($this.is(":checked")) {
            $(".Tier2").not($this).prop({ disabled: true, checked: false });
            $(".Tier3, .Tier4, .Tier5").prop({ disabled: true, checked: false });
            $(".Tier1").prop("checked", true);
        }
        else {
            $(".Tier2").not($this).prop({ disabled: false, checked: false });
            $(".Tier3, .Tier4, .Tier5").prop({ disabled: false, checked: false });
            $(".Tier1").prop("checked", false);
        } 
    }
      else if($this.is(".Tier3")) {
      	if($this.is(":checked")){
            $(".Tier2").prop({ disabled: true, checked: false });
            $(".Tier1").prop({ disabled: true, checked: false });  
    	}
    	else {
            $(".Tier2").prop({ disabled: false, checked: false });
            $(".Tier1").prop({ disabled: false, checked: false});
        }
    }
       else if($this.is(".Tier4")) {
      	if($this.is(":checked")){
            $(".Tier2").prop({ disabled: true, checked: false });
            $(".Tier1").prop({ disabled: true, checked: false });
            $(".Tier4").not($this).prop({ disabled: true, checked: false });
 
    	}
    	else {
    		$(".Tier4").not($this).prop({ disabled: false, checked: false });
            $(".Tier2").prop({ disabled: false, checked: false });
            $(".Tier1").prop({ disabled: false, checked: false});
        }
    }
     /*else if($this.is(".Tier5")) {
      	if($this.is(":checked")){
            $('input[class^="Tier"]').not($this).prop({disabled: true, checked: true });
    	}
    	else {
            $('input[class^="Tier"]').prop({disabled: false, checked: false });
    	}
    }*/
});
	


		$('#<?php echo $formname ?>').validationEngine();
		

			$('#<?php echo $formname ?>').submit(function(e){

				e.preventDefault();

				var empty_inputs = false;
				console.log(empty_inputs)
				$("form input").not('select').not(':hidden').not('.optional').each(function(){
					if($(this).val() == ''){
						empty_inputs = true;
						console.log(empty_inputs);
					}
				});

				if(empty_inputs){

					alert("Please fill empty fields to continue.")
				}

				else {
		
						$.ajax({
							type: 'POST',
							url: '<?php echo site_url() . $save_url."/edit" ?>',
							data: $('#<?php echo $formname ?>').serialize(),
							dataType: "json",
							success:function(response){
								if(response.status === "success"){

									//$('#add_success').slideUp(300).delay(200).fadeIn(400).fadeOut('fast');
									parent.$.fancybox.close();
									console.log(response);
									document.location.reload();	
								}
								else if(response.status === "error"){
										alert(response.message);
								}
							},
							error:function(){
							}
						})

				 	}

				})

	</script>

</html>