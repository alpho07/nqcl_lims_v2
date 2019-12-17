<html>
<?php $this -> load -> view("document_header_v");?>


	<h2>Quotation</h2>
	<table>
		<tr><td colspan = "2" ><hr></td></tr>
		<tr>
			<td>Date</td>
			<td class  ="plain_bold_inline" ><?php echo date('j<\s\u\p>S</\s\u\p> F Y'); ?></td>
		</tr>
		<tr>
			<td>Quotation No.</td>
			<td class  ="plain_bold_inline" ><?php echo $i_data[0]["Q_No"]; ?></td>
		</tr>
		<tr>
			<td>Client Name</td>
			<td class = "plain_bold_inline" ><?php echo $i_data[0]["Client_Name"] ?></td>
		</tr>
		<tr>
			<td>Client Email</td>
			<td class = "plain_bold_inline" ><?php echo $i_data[0]["Client_Email"] ?></td>
		</tr>
	</table>

	<table id ="sample_info_table" class = "reducedtext" >
		<tr><td colspan = "6">&nbsp;</td></tr>
		<thead>
		<tr class = "plain_bold_inline gray centered" >
			<td>Product</td>
			<td>Tests</td>
			<td>Compendia</td>
			<td>Cost per Batch (<?php echo $currency; ?>)</td>	
			<td>No. of Batches</td>
			<td>Total Cost (<?php echo $currency; ?>)</td>
		</tr>
		</thead>
		<tbody>
		<?php $i=0; $key1 = 1; $key2 = 1; foreach($i_data as $v) { ?>
		<tr class = "<?php if($key2%2){ echo "zebra_striping";} ?> centered ">
			<td><?php echo strtoupper($v["Sample_Name"]); ?></td>
			<td><?php 

				//Check billing tables first and get relevant id
				if($main_table == "Quotations"){
					$qid = $v['Quotation_No'];
				}else{
					$qid=$reqid;
				}


				//var_dump($main_table);
				//Get tests 
				$tests = $billing_table::getAllTests($qid);
				//var_dump($tests);

				//Loop through tests
				foreach($tests as $t) {
				 //echo var_dump($t);
					if($key1%2){
							if($key1 != count($tests)){
								$append = ", ";
							}
							else{
								$append = "";
							}
						echo $t["Tests"][0]["Name"].$append;
					}
					else{
						echo $t["Tests"][0]["Name"]. "<br/>";
					}
					$key1++;
			} ?>
			</td>
			<td><?php 

				$compendia=$billing_table::getUniqueCompendia($v['Quotation_No']); 
				
				//initialize array to hold compendia
				$cmpnd = array();

				//loop through unique compendia
					foreach($compendia as $co){
						if(!empty($co['compendia'])){
							if($co['compendia'][0]['abbrev'] == 'MIHM'){
								array_push($cmpnd, $co['compendia'][0]['name']);
							}else{
								array_push($cmpnd, $co['compendia'][0]['abbrev']);
							}
						}
					}
				


				//list compendia separated by slash
				if(!empty($cmpnd)){
					echo implode("&nbsp;/&nbsp;", $cmpnd);
				}else{
					echo "USP";
				}
				


			 ?></td>
			<td><?php echo number_format($v["Unit_Cost"], 2); ?></td>
			<td><?php echo $v["No_Of_Batches"]; ?></td>
			<td><?php echo number_format($v["Total_Cost"], 2); ?></td>
		</tr>
		<?php $key2++; $i++; } ?>
		<?php $g = 0; 
		foreach($xtra_columns as $k => $v) {?>
		<tr class = "centered">
			<td colspan = "4"></td>
			<td><?php echo ucwords(str_replace("_", " ",$k)); if($extra_columns[$g++]['comment'] == '%'){ echo '&nbsp;('.$percentage_a[$k].'%)'; } ?></td>
			<td><?php if($k == 'discount'){ echo '('. number_format($v,2) .')'; } else{ echo number_format($v,2); } ?></td>
		</tr>
		<?php }?>
		<tr>
			<td colspan = "3"></td>
			<td colspan = "4"><hr></td>
		</tr>
		
			<tr class = "plain_bold_inline centered" >
				<td colspan = "4" ></td>
				<td>Total Cost (<?php echo $currency; ?>)</td>
				<?php foreach($tr_array as $k => $v){ ?>
					<td ><?php echo number_format($v,2); ?></td>
				<?php }?>
			</tr>
			<tr>
				<td colspan = "6" class = "plain_bold_inline"><hr></td>
			</tr>
			</tbody>
			</table>
	</table>
	&nbsp;
	<!--Prompt reader to see notes on second page-->
	<p><i> Please see notes on second page.</i></p>

	<!---->
	<div class ="pdfFooter">
		<?php $this -> load -> view("general_quotation_footer_v"); ?>
	</div>


	<!--Do a page break to send notes to page 2 of quotation-->
	<div class="notesPageBreak">
		<?php $this -> load -> view("document_footer_v"); ?>
		<div class ="pdfFooter">
			<?php $this -> load -> view("general_quotation_footer_v"); ?>
		</div>
	</div>

	<!--Page Break CSS-->
	<style type="text/css">
		.notesPageBreak{
			page-break-before: always;
		}
	</style>


</html>