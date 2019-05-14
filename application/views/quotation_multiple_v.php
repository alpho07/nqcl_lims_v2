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
		<tr class = "plain_bold_inline gray centered" >
			<td>Sample Name</td>
			<td>Tests</td>
			<td>No. of Batches</td>
			<td>Unit Cost (<?php echo $currency; ?>)</td>	
			<td>Total Cost (<?php echo $currency; ?>)</td>
		</tr>
		<?php $key1 = 1; $key2 = 1; foreach($i_data as $v) { ?>
		<tr class = "<?php if($key2%2){ echo "zebra_striping";} ?> centered ">
			<td><?php echo $v["Sample_Name"]; ?></td>
			<td><?php foreach($v["Q_request_details"] as $t) {
				//echo json_encode($t);
					if($key1%2){
							if($key1 != count($v["Q_request_details"])){
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
			<td><?php echo $v["No_Of_Batches"]; ?></td>
			<td><?php echo number_format($v["Unit_Cost"], 2); ?></td>
			<td><?php echo number_format($v["Total_Cost"], 2); ?></td>
		</tr>
		<?php $key2++; } ?>
		<?php $g = 0; 
		foreach($xtra_columns as $k => $v) {?>
		<tr class = "centered">
			<td colspan = "3"></td>
			<td><?php echo ucwords(str_replace("_", " ",$k)); if($extra_columns[$g++]['comment'] == '%'){ echo '&nbsp;('.$percentage_a[$k].'%)'; } ?></td>
			<td><?php if($k == 'discount'){ echo '('. number_format($v,2) .')'; } else{ echo number_format($v,2); } ?></td>
		</tr>
		<?php }?>
		<tr>
			<td colspan = "2"></td>
			<td colspan = "3"><hr></td>
		</tr>
		
			<tr class = "plain_bold_inline centered" >
				<td colspan = "3" ></td>
				<td>Total Cost (<?php echo $currency; ?>)</td>
				<?php foreach($tr_array as $k => $v){ ?>
					<td ><?php echo number_format($v,2); ?></td>
				<?php }?>
			</tr>
			<tr>
				<td colspan = "5" class = "plain_bold_inline"><hr></td>
			</tr>
			<?php $this -> load -> view("document_footer_v"); ?>
	</table>
</html>