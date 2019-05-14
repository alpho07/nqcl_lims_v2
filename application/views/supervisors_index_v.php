<legend>
    <a href="<?php echo base_url(); ?>supervisors" >Home</a> 
    || <a href="<?php echo base_url();?>supervisors/notifications/">Notifications (<?php echo $noty;?>)</a>  
    || <a href="<?php echo base_url(); ?>supervisors" >Pending</a> 
    || <a href="<?php echo base_url(); ?>supervisors/approved_samples" >Approved</a> 
    || <a href="<?php echo base_url(); ?>report_engine/Analyst_report_hod" >Analyst Report</a> 
    || <a href="<?php echo base_url(); ?>report_engine/dreport" >Departmant Report</a> 
    || <a href="<?php echo base_url(); ?>analyst_supervisor" >Assign Supervisor</a>
</legend>

<hr />
<style type="text/css">
    #analystable tr:hover {
        background-color: #ECFFB3;
    }




</style>

<table id = "analystable">

    <thead><tr><th>Lab Reference Number</th><th>Labref</th><th>View Details (Old Way)</th><th>Approve Receipt (Current Way)</th></tr></thead>

    <tbody>
        <?php 

        
        foreach ($done_tests as $test) { ?>
            <tr class="sample_issue">
                  
                <td class="common_data" ><span class="green_bold" id="labref" ><?php echo $test->labref ?></span></td>
                <td></td>
                <?php if($test->micro=="yes"){ ?>
                <td><?php echo anchor('supervisors/home/'.$test->labref,'View Details') ?> </td>
                <?php }else{ ;?>
                    <td><?php echo anchor('supervisors/home/'.$test->labref,'View Details') ?></td>  
               <?php };?>
              
               <td>
                   <a id="<?php echo $test->labref;?>" href="#approval-confirmaton" class="APPROVE_SAMPLE">Approve Sample</a>
               </td>
            </tr>
         <?php } ?>
 </tbody>

</table>

<script type="text/javascript">
    $(function() {

        $('#analystable').dataTable({
            "bJQueryUI": true
        }).rowGrouping({
            //iGroupingColumnIndex: 0,
            //sGroupingColumnSortDirection: "asc",
            iGroupingOrderByColumnIndex: 0
            //bExpandableGrouping:true,
          //  bExpandSingleGroup: false,
          //  iExpandGroupOffset: -1

        });


        $(document).on('click','.APPROVE_SAMPLE',function () {
            $labref = $(this).attr('id');
            if (confirm('You are about to confirm receipt of this sample and that it is fully done with no rejections or repeats and ready for review. Do you want to continue?')) {
              window.location.href="<?php echo base_url();?>supervisors/approveSample/"+$labref
            } else {
                // Do nothing!
            }
        })
    });

</script>

