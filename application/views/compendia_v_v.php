<html style = "overflow-x: hidden">
    <title>Add Compendia</title>
    <head></head>
    <form class = "methods" id = "formname" >
        <ul>
            <li>
                <fieldset>
                    <legend>Enter Compendia</legend>
                    <li>
                        <label>
                            <span>Compendia</span>
                            <textarea name = "compendia[]" >B.P. 2012 Vol .V App XII C</textarea>
                        </label>
                    </li>
                </fieldset>
            </li>
            <li>
                <fieldset>
                    <legend>Enter Specification</legend>
                    <li>
                        <label>
                            <span>Specification</span>
                            <textarea name = "specification[]" >NMT 2 tablets deviate by more than x% from mean weight</textarea>
                        </label>
                    </li>		
                </fieldset>
            </li>
      

            <input name = "request_id" type = "hidden" value = "<?php echo $labref ?>" >
            <input name = "test_id" type = "hidden" value = "<?php echo $test_id ?>" >

            <li>
                <input id = "submit" type = "submit" class = " leftie" value = "Save" >
                 <input id = "cancel" type = "button" class = "" value = "Cancel" >
            </li>
        </ul>
    </form>

    <script type="text/javascript">

        //Validate with Validation Engine (JS)
        $('#formname').validationEngine({
            promptPosition: "topRight",
            'custom_error_messages': {
                'required': {
                    'message': "* Required."
                }
            },
            autoPositionUpdate: true,
            scroll: false
        });

        //Save
        $('#formname').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url() . "chroma_conditions/compendia_save/" ?>',
                data: $('#formname').serialize(),
                dataType: "json",
                success: function(response) {
                    if (response.status === "success") {
                        parent.$.fancybox.close();
                        $('#submit').remove();
                       $.fancybox.close();
                          //window.location.href="<?php echo base_url();?>analyst_controller/";
                    }
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
             parent.$.fancybox.close();
        window.location.href="<?php echo base_url();?>analyst_controller/";
        });

    </script>

</html>