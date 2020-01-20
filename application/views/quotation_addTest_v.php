<form class="methods" id="addTest">
		<nav class="panel container">
			<p class="panel-heading">Add test for <?php echo $quotations_id; ?></p>
			<div class="panel-block" id="test-panel-block">
				<div class="column control is-2">
					<div class="field">
						<label class="label" >Test</label>
						<input class="input" id="test_name" type="text" name="test" >
					</div>
				</div>
				<!--Hidden test id field-->
				<input type="hidden" name="test_id" id="addTest_h">
			</div>
			<?php foreach($components as $component){ ?>
				<div class="panel-block block-multic columns">
					<div class="column"><h6><?php echo $component['component'] ?></h6></div>
						<div class="column">
							<ul class="multic" data-component = "<?php echo $component['component'] ?>">

							</ul>
						</div>
				</div>
			<?php }?>
			<!--Autogenerated html goes here-->
			<div class="column control is-2">
				<div class="field">
					<input type="submit" class="button is-primary" value="Update">	
				</div>
			</div>
		</nav>
</form>

<script type="text/javascript">
	
	//On type, suggest
$(function(){

	//On clicking a radio button
	$('ul').on('click','input.radios',function(){

		component_name = $(this).parent().parent().attr('data-component');
		test_name_raw = $('#addTest_h').val();
		test_name_concat = test_name_raw.replace(/ /g,"_");
		radio_name = component_name + test_name_concat;
		currency = $(this).attr('data-cur');

		//Set this 
		$(this).attr('name', radio_name)
		$('#ckes').attr('name', radio_name+'_charge_kes');
		$('#cusd').attr('name', radio_name+'_charge_usd');
	})



	$('#test_name').autocomplete({
		source: function(request, response) {
			$.ajax({	
				url: '<?php echo base_url(); ?>quotation/testsSearch/',
				data: {term: $('#test_name').val()},
				dataType: "json",
				type:"POST",
				success: function(data){
					response(data);
				}
			});
		},
		minLength: 2,
		delay: 200,
		select: function(event, ui){

			//Set value of test hidden field
			$('#addTest_h').val(ui.item.value);

			//Get methods url
			methods_url = '<?php echo base_url().'quotation/getMethods' ?>/'+ui.item.value+'/<?php echo $currency ?>';
			currency = '<?php echo $currency ?>';

			//Get methods of test picked
			axios.get(methods_url).
			then(function(response){
				$.each(response.data, function(index, value){

					//Get value of multicomponent status
					var mc_status = value.Mc_status;
					var radios_html = ['<li><input class="radios" data-inp = "new" name="methods_" type="radio" value="42"> None<input class="charges" data-inp="new" name="" type="hidden" value=0> </li>'];

					$.each(value.Test_methods, function(i, v){
						radios_html.push('<li><input class="radios" data-inp = "new" name="methods_" type ="radio" value="'+v.id+'"> '+v.name+'<input class="charges" data-inp = "new"  id = "ckes" name ="" data-cur="kes" type="hidden" value="'+v.charge_kes+'"><input class="charges" data-inp = "new"  name =""  data-cur="usd" id="cusd" type="hidden" value="'+v.charge_usd+'"></li>')
					})

					//Console log
					console.log(radios_html)
					//console.log(mc_status)

					//Populate unordered list with generated radio inputs
					$('.multic').html(radios_html);

				})

			}).
			catch(function(error){
				console.log(error)
			});

			//Check whether test picked is multi-c
			
		}
	})


$('#addTest').submit(function(e){
	e.preventDefault();
	
	//Get form
	var form = $("#addTest");

	//Submit Url
	var url = "<?php echo base_url().'quotation/addTest/'.$quotations_id.'/'.$quotation_id ?>";

	//Get formdata
	var formData = new FormData(form[0]);
	//console.log(formdata)

	//Pass to server via Axios
	axios.post(url, formData).
	then(function(response){
		if(response.statusText == 'OK'){
			new Noty({ 
				theme: 'mint',
                type: 'success',
                text: 'Test added successfully.',
                callbacks:{
                	afterShow:function(){
                		parent.$.fancybox.close();
                	}
                }
            }).show();
		}
	}).
	catch(function(error){
			new Noty({ 
				theme: 'mint',
                type: 'error',
                text: 'An error occurred while adding test. Contact support.',
                callbacks:{
                	afterShow:function(){
                		parent.$.fancybox.close();
                	}
                }
        }).show();
	})

})




})

</script>