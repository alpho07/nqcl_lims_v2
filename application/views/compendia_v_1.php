<script>
$(document).ready(function(){
    i=2;
      $('#addRow').click(function(){
          
        table= $('#comp_table > tbody');
        newRow =  "<tr>\n\
                     <td><strong>Component No. "+i+"</strong> (<a id='remRow' href='#remove'>-Remove</a>)</td>\n\
                    <td> <textarea name = 'compendia[]' placeholder='Enter Commpendia'required ></textarea></td>\n\
                   <td><textarea name = 'specification[]' placeholder='Enter Specification' required ></textarea></td>\n\
                   </tr>";
                               
           
                   i++;
        $('#comp_table > tbody tr:last').after( $(newRow) );


         
           return false;

        });
        
        $(document).on('click','#remRow', function(){
          $(this).closest('tr').remove();
          
          i-1;
            return false;
        });
});
</script>

<style>
    #comp_table td{
        display: block;
    }
    </style>

 
    <form id="compendia_specification" >

        <table id='comp_table'>
            <label><a id="addRow" href="#add">+Add</a></label>
            <tbody>
              
            <tr>
                <td><strong>Component No. 1</strong></td>
                <td>                   
                    <textarea id="com_" name = "compendia[]" placeholder="Enter Commpendia" required ></textarea>
                </td> <br>
                 <td>
                     <textarea id="spec_"  name = "specification[]" placeholder="Enter Specification" required ></textarea>
                </td>
            </tr>
                    <input name = "request_id" type = "hidden" value = "<?php echo $labref ?>" >
        <input name = "test_id" type = "hidden" value = "<?php echo $test_id ?>" >
        </tbody>
        </table>
     
        <input id = "submit1" type = "button" class = "submit-button leftie" value = "Save" >
        <input id = "cancel" type = "button" class = "submit-button leftie" value = "Cancel" >
    </form>

    <script type="text/javascript">
        $(document).ready(function(){   
 

        //Save
        $('#submit1').on('click',function() {
    
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()  . "chroma_conditions/compendia_save/". $labref . "/" . $test_id ?>',
                data: $('#compendia_specification').serialize(),
                dataType: "json",
                success: function(response) {
                    if (response.status === "success") {
                
                      
                      //  console.log(wksht_url)
                      $.fancybox.close();
                    }//
                    else if (response.status === "error") {
                        alert(response.message);
                    }
                },
                error: function() {
                }
            })
        });
        
        
        $('#cancel').click(function(){
        alert('Compendia and Specification Must be added, Taking you home....');
        window.location.href="<?php echo base_url();?>analyst_controller/";
        });
        });

    </script>

