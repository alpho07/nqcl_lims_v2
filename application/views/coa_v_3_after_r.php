<head> 
    

    <title><?php echo $title;?></title>
    <script src="<?php echo base_url() . 'Scripts/jquery-1.10.2.js' ?>"></script>
    <script src="<?php echo base_url() . 'Scripts/migrate.js' ?>"></script>
            <link href="<?php echo base_url() . 'Scripts/fancybox/source/jquery.fancybox.css?v=2.1.3' ?>" type="text/css" media="screen" rel="stylesheet"/>
        <script src="<?php echo base_url() . 'Scripts/fancybox/source/jquery.fancybox.js' ?>" type="text/javascript"></script>
        <link type='text/css' href='<?php echo base_url(); ?>Scripts/jquery-impromptu.css' rel='stylesheet' media='screen' /></script>
<!--<script src="<?php echo base_url(); ?>javascripts/nqcl_1.js?1500" type="text/javascript"></script>-->
<script type='text/javascript' src='<?php echo base_url(); ?>Scripts/jquery-impromptu.js'></script>
   <link href="<?php echo base_url(); ?>CSS/jquery-ui.css" type="text/css" rel="stylesheet"/>

    <script src="<?php echo base_url() . 'Scripts/jquery-ui.js' ?>" type="text/javascript"></script> 

    <link href="<?php echo base_url(); ?>stylesheets/jquery_notification.css" type="text/css" rel="stylesheet"/>
    <script type="text/javascript" src="<?php echo base_url(); ?>javascripts/jquery_notification_v.1.js"></script>
<script src="<?php echo base_url().'Scripts/jquery-ui.js'?>" type="text/javascript"></script> 
    <script type="text/javascript">
        $(document).ready(function() {
            
            //Audit trailing functions
            
            $('#product_name').focusout(function(){
               data = $(this).val();
               alert(data);
            });
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            user_type = "<?php echo $this->session->userdata('usertype_id'); ?>";
               /*   determnined_class = $('select.det');
            complies ='The sample complies with the specifications of the tests perfomed.';
            does_not_comply ='The sample does not comply with the specifications of the tests perfomed.';

            $('select.det').change( function() {
                var selectedVals = $(determnined_class).map(function() {
                    return this.value;
                }).get().join(',');
                var data = selectedVals;
                if ($.inArray('DOES NOT COMPLY', data.replace(/,\s+/g, ',').split(',')) >= 0) {
                   
                      $('#conc').val(does_not_comply);
                      $('#conc').css('background','red');
                      $('#conc').css('color','white');
                       $('#conc').css('font-weight','bolder');
                    }else{
                         $('#conc').val(complies); 
                         $('#conc').css('background','greenyellow');
                         $('#conc').css('color','black');
                         $('#conc').css('font-weight','bolder');
                    }
                  


            }).trigger('change');*/
          
            
              coa_status = "<?php echo $coa_stat;?>";
           if(coa_status =='1'){
               //$('#genCOA').prop('disabled', true);
           }

            var i = 1;
            var temp_array = new Array();
            temp_array[1] = "method";
            temp_array[2] = "compedia";
            temp_array[3] = "specification";
            temp_array[4] = "determined";
            temp_array[5] = "complies";

            // $.each(temp_array,function(k,v){

            // });

            $('.addNew').live('click', function() {
                var count_val = 1;
                $(this).closest('tr').find('td').each(function(i, v) {
                    var count = parseFloat($(this).closest('td').parent()[0].sectionRowIndex) - 1;
                    if (i > 2) {
                        $('<textarea class="clone"  id="p_new' + i + '" rows="1" cols="10" name=' + temp_array[count_val] + '_' + count + '[]" value="" placeholder="I am New" ></textarea><a href="#" class="remNew">-</a>').appendTo(v);
                        count_val++;
                    }
                });

                // $('<tr class="clone"><td><textarea  id="p_new' + i + '" rows="1" cols="10" name="determined_'+count+'[]" value="" placeholder="I am New" ></textarea><a href="#" class="remNew">-</a><td> </tr>').appendTo($(this).parent('td'));


                return false;
            });

            $('.remNew').live('click', function() {
                $(this).closest('tr').find('.clone').each(function(i, v) {
                    //if(i>0){
                    v.remove();
                    // $("._rows").current().find(".clone").remove();
                    //}
                });
                //return false;
            });
            //  tinymce.init({ selector: "textarea"});
            
            $('#mOOS').click(function(){
                
                    $.prompt("This sample is about to be marked as an OOS!, Do you want to continue with this action?", {
                                                        title: "OOS Status",
                                                        buttons: {"Yes, Mark as OOS": 1, "No, Cancel Action": false},
                                                        focus: 1,
                                                        submit: function(e, v, m, f) {
                                                            // use e.preventDefault() to prevent closing when needed or return false. 
                                                            // e.preventDefault(); 
                                                       
                                                            if (v === 1) {

                                                              $.post("<?php echo base_url().'reviewer/make_oos_coa/'.$labref;?>",function(){
																window.location.href = "<?php echo base_url() ; ?>coa_review/draft_coa_review/";

															  }); 


                                                            } else {
                                                             
                                                                window.location.href = "<?php echo base_url() . 'coa/generateCoa_cr/'.$labref ?>";
                                                            }

                                                            console.log("Value clicked was: " + v);
                                                        }
                                                    });
                
            });


       
                 $('#genCOAp').click(function() {
                $(this).prop('value', 'Processing....');
                  $.post("<?php echo base_url(); ?>directors/approve_coa_draft/<?php echo $labref; ?>",function(){
                                           showNotification({
                                            message: "COA Approval & Forwarding Success ! ",
                                            type: "success",
                                            autoClose: true,
                                            duration: 5

                                        });
                                              window.location.href="<?php echo base_url(); ?>coa_review/draft_coa_review";
                                        });
                                      
                 })


            $('#genCOA').click(function() {
                $(this).prop('value', 'Processing....');
               //$(this).prop('disabled', 'disabled');
                postData = $('#COAF').serialize();

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>coa/saveCOA/<?php echo $labref; ?>/coa_draft",
                                    data: postData,
                                    success: function() {

                                        showNotification({
                                            message: "COA Successfully Saved ",
                                            type: "success",
                                            autoClose: true,
                                            duration: 5

                                        });
                                        $('#genCOA').prop('value', 'Save');
                                        $('#genCOA').prop('disabled', false);
                                        
                                      
                                      
                                    },
                                    error: function() {
                                        showNotification({
                                            message: "Oops! an error occurred - Please try again Later.",
                                            type: "error",
                                            autoClose: true,
                                            duration: 5
                                        });
                                        return false;
                                    }

                                });

                            });
                            $('#CSubmitReason').click(function(){
                            $.fancybox.close();
                            });
							
							
							$('#edit_client_now').click(function() {
                $(this).prop('value', 'Processing....');
                $(this).prop('disabled', 'disabled');
                postData = $('#e_cli').serialize();

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>coa/saveClient/<?php echo $information[0]->client_id ; ?>",
                                    data: postData,
                                    success: function() {

                                        showNotification({
                                            message: "Client Successfully Saved ",
                                            type: "success",
                                            autoClose: true,
                                            duration: 5

                                        });
                                  
                                    $.fancybox.close();

                                      window.location.href = "<?php echo base_url() . 'coa/generateCoa_cr/'.$labref; ?>";

                                    },
                                    error: function() {
                                        showNotification({
                                            message: "Oops! an error occurred.",
                                            type: "error",
                                            autoClose: true,
                                            duration: 5
                                        });
                                        return false;
                                    }

                                });

                            });
							
							
							
									$('#edit_chalient_now').click(function() {
                $(this).prop('value', 'Processing....');
                $(this).prop('disabled', 'disabled');
                postData = $('#e_chali').serialize();

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>coa/switchclient/<?php echo $labref ; ?>",
                                    data: postData,
                                    success: function() {

                                        showNotification({
                                            message: "Client Successfully Switched ",
                                            type: "success",
                                            autoClose: true,
                                            duration: 5

                                        });
                                  
                                    $.fancybox.close();

                                      window.location.href = "<?php echo base_url() . 'coa/generateCoa_cr/'.$labref; ?>";

                                    },
                                    error: function() {
                                        showNotification({
                                            message: "Oops! an error occurred.",
                                            type: "error",
                                            autoClose: true,
                                            duration: 5
                                        });
                                        return false;
                                    }

                                });

                            });
                            
                            $('#cancel_client_now').click(function(){
                            $.fancybox.close();
                            });
							
								$('#CEdit').click(function(){
            $.fancybox({
                href:'#edit_client'
            })
        });
							
							
                            
                            
                            $('#reCOA').click(function(){
                            
                            $.fancybox({
                                href:"#reject_reasons"
                            });
                            
                            });
                            
                             $('#SubmitReason').click(function() {
                                 value1 = $('#reasonsCOA').val();
                                 if(value1 ===''){
                                     alert('Kindly State the reasons for rejection first');
                                 }else{
                $(this).prop('value', 'Processing....');
               //$(this).prop('disabled', 'disabled');
                postData = $('#COAF').serialize();

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>coa/saveCOA/<?php echo $labref; ?>",
                                    data: postData,
                                    success: function() {

                                        showNotification({
                                            message: "COA Values and Reject Reasons Saved and sent ",
                                            type: "success",
                                            autoClose: true,
                                            duration: 5

                                        });
                                        
                                        $.post("<?php echo base_url();?>assign/rejectReason/<?php echo $labref; ?>",$('#reject_reason_COA').serialize(),function(){
                                                                                       window.location.href="<?php echo base_url();?>coa_review/draft_coa_review";
 
                                        });
                                        
                                        $('#genCOA').prop('value', 'Save');
                                        $('#genCOA').prop('disabled', false);
                                      
                                    },
                                    error: function() {
                                        showNotification({
                                            message: "Oops! an error occurred - Please try again Later.",
                                            type: "error",
                                            autoClose: true,
                                            duration: 5
                                        });
                                        return false;
                                    }

                                });
                                }
                            });
                                  $('#Back').click(function() {

                                
                           
                                    window.location.href = "<?php echo base_url() . 'coa_review/draft_coa_review'; ?>";
                               
                            });
                            
          $(document).on('click','#view_log',function(){
	
    id= $(this).attr('class');
    $('#labr,#labr1').text(id + " " );
    $.ajax({
        type:"post",
        url:"<?php echo base_url(); ?>request_management/get_sample_personnel/"+id,
        dataType: "json",
        success:function(data_response){
            
             $tbody= $('.tj > tbody tr:last');
     
             $(".tj tbody tr.ai").remove();
    
            $.each(data_response,function(the, data){
              
  row = '<tr class="ai">\n\
    <td class="tg-ugh9">'+data.activity+'</td>\n\
    <td class="tg-ugh9">'+data.by+'</td>\n\
    <td class="tg-ugh9">'+data.date_issued+'</td>\n\
    <td class="tg-ugh9">'+data.date_returned+'</td>\n\
</tr>'; 
    
    $('.tj > tbody tr:last').before(row);
    
  
            });       
                    
            
            $.fancybox({
                href:"#data_response"
            });
        },error:function(){
            alert('An error occured while loading the information, Try again later');
        }
    });
});
                            
                            
                                                $(function() {
    $( "#date_received" ).datepicker({
        dateFormat: 'dd.mm.yy'
        
    });
    
    $(function() {
	$('.monthYearPicker').datepicker({
		changeMonth: true,
		changeYear: true,
		showButtonPanel: true,
		dateFormat: 'M.yy'
	}).focus(function() {
		var thisCalendar = $(this);
		$('.ui-datepicker-calendar').detach();
		$('.ui-datepicker-close').click(function() {
var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
thisCalendar.datepicker('setDate', new Date(year, month, 1));
		});
	});
});
  });
  function h(e) {
    $(e).css({'height':'auto','overflow-y':'hidden'}).height(e.scrollHeight);
}
$('.det,#addre').each(function () {
  h(this);
}).on('input', function () {
  h(this);
});            
                         

                        });
          
                        

        
    
       
    
  
    </script>
    <style type="text/css">
        #conc{
            width:700px;
            height:40px;
        }
        #COA_BODY{
            margin-top: 120px;
        }
        #COA{
            padding-right:25px;
            padding-left:25px;

        }
        #temp_table td{
            border: 1px solid black;
        }

        .side{
            background-color:#CCCCCC;
            font-size:12px;

        }
        #top_row{
            background-color:#CCCCCC;
        }
        table { 
            border-collapse:collapse;

        }
        p{
            margin-bottom: 0px;
            font-weight: bolder;
        }
        #label_name{
            font-size:11px;
        }
        .wording{
            font-size: 14px;
        }
        textarea {
            vertical-align:middle;
            font-size: 12px;

        }
         .det{
            font-weight: bold;
            width: 175px;
            white-space: normal;
    text-align: justify;
    -moz-text-align-last: center; /* Firefox 12+ */
    text-align-last: center;
        }


        #hes{
            font-type: Book Antiqua;
            font-weight: bolder;
            font-size: 12px;
        }
        #signatories{
            font-size: 10px;
        }
        textarea { 
            font-type:Book Antiqua;
            font-size: 12px;
            width: 130px;
            height: 60px;
        } 

        #COA_AREA{
            width:99.5%;
            height: auto;
            background: -moz-linear-gradient(top,  rgba(255,255,255,1) 0%, rgba(255,255,255,0) 100%); /* FF3.6+ */
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(255,255,255,1)), color-stop(100%,rgba(255,255,255,0))); /* Chrome,Safari4+ */
            background: -webkit-linear-gradient(top,  rgba(255,255,255,1) 0%,rgba(255,255,255,0) 100%); /* Chrome10+,Safari5.1+ */
            background: -o-linear-gradient(top,  rgba(255,255,255,1) 0%,rgba(255,255,255,0) 100%); /* Opera 11.10+ */
            background: -ms-linear-gradient(top,  rgba(255,255,255,1) 0%,rgba(255,255,255,0) 100%); /* IE10+ */
            background: linear-gradient(to bottom,  rgba(255,255,255,1) 0%,rgba(255,255,255,0) 100%); /* W3C */
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#00ffffff',GradientType=0 ); /* IE6-9 */

            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            border: 1px solid black;
            box-shadow: 3px;
            font-size: 12px;
            font-type:Book Antiqua;

        }
        #content{
            margin: 10px;
        }

        form input,select,textarea,button {
            //width: 70%;
            padding: 5px;
            border: 1px solid #d4d4d4;
            border-bottom-right-radius: 5px;
            border-top-right-radius: 4px;

            line-height: 1.5em;
            //float: right;

            /* some box shadow sauce :D */
            box-shadow: inset 0px 2px 2px #ececec;
        }
        form input:focus {
            /* No outline on focus */
            outline: 0;
            /* a darker border ? */
            border: 1px solid #bbb;
        }
        #coa_top{
            // background-color: blue;
            width:867.5px;
            height:300px;
        }
        #coa_top_table{
            width:784px;
            height: 300px;
        }
        #top_head{
            width:100px;
        }
        #middle_head{
            width:100px;

        }
        #top_row{
            height: 50px;
        }
        #p_name{
            float: right;
            margin-right: 50px;
        }
        .left_c{
            width:100px;
            margin-left: 5px;
           
        }
        #LogInfo{
            width: 100;
            min-height: 50px;
            border-radius: 5px;
            margin-top: 100px;
            float: right;
            position: absolute;
            margin-left: 80%;
            
        }
        .tg  {border-collapse:collapse;border-spacing:0;border-color:#bbb;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#E0FFEB;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#9DE0AD;}
.tg.tg-ugh9{background-color:#C2FFD6}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#E0FFEB;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#9DE0AD;}
.tg-ugh9{background-color:#C2FFD6}
.other{
    display: none;
}
  input[type=text]{
            text-align: center;
        }

    </style>
</head>

<div id="edit_client" style="display:none; width:400px;" >
    <form name="" id="e_cli">
	<input id="client_id" value="<?php echo $information[0]->client_id ; ?>" style="display:none;"/>
        <table>
            <thead>
                <tr>
                  
            <center><strong>CLIENT EDIT</strong></center>
             
                </tr>
            </thead>
            <tr>
                <td>CLIENT NAME</td><br>
                <td>
                    <input name="c_name" id="c_name" value="<?php echo $information[0]->name ; ?>" style="width:300px;"/>
                        
                   
                </td>
            </tr><br>
             <tr>
                  <td>CLIENT ADDRESS</td><br>
                <td>
                    <input name="c_address" id="c_address" value="<?php echo  $information[0]->address; ?>" style="width:300px;"/>
                        
                   <br>
                </td>
            </tr>
             
               <tr>
                   <td><input type="button" value="Save" id='edit_client_now'/></td>
            </tr>
        </table>
    </form>
	
	 <form name="" id="e_chali">
	 
	
        <table>
            <thead>
                <tr>
            <center><strong>CLIENT EDIT - (CHANGE CLIENT)</strong></center>
                </tr>
            </thead>
            <tr>
                <td>CLIENT NAME</td><br>
                <td>
                  <select name="client_id_change" selected="selected" style="width:300px;">
				  <option value="<?php echo $information[0]->client_id ; ?>"><?php echo $information[0]->name ; ?></option>
				  <?php foreach($clients as $client):?>
				  <option value="<?php echo $client->id;?>"><?php echo $client->name;?></option>
				  <?php endforeach;?>
				  </select>
                        
                   
                </td>
            </tr><br>
          
             
               <tr>
                   <td><input type="button" value="Change.." id='edit_chalient_now'/></td>
                    <td><input type="button" value="Cancel" id='cancel_client_now'/></td>
            </tr>
        </table>
    </form>
</div>

<div id="LogInfo">
    <button id="view_log" class="<?php echo $information[0]->request_id; ?>">View Sample Log</button>
	<a href="<?php echo base_url().'coa/audit_trail/'.$information[0]->request_id;?>" target="_blank">View changes</a>
</div>
<div id="reject_reasons" style="display: none;">
    <form id="reject_reason_COA">
    <p style="color:red; font-weight: bolder;">NB: Please Highlight the reasons for rejecting</p>
    <textarea id="reasonsCOA" style="width:400px; height: 450px;" placeholder="Please State reasons in here" required name="rejectedRe"></textarea>
    <input type="button" value="Submit" id="SubmitReason"/> <input type="button" value="Cancel" id="CSubmitReason"/>
    </form>
</div>

<div id="data_response" style="display: none;">
    <table class="tg tj" >
        <tr><td colspan="5"><center><strong><em><br><span id="labr"></span>ACTIVITY LOG</em></strong></center></td></tr>
      <tr><td colspan="5" style="font-weight: bold; color: red;"></td></tr>

    <tr>
      <tr>
        <th class="tg-031e">Activity</th>
        <th class="tg-031e">By</th>
        <th class="tg-031e">Date Issued </th>
        <th class="tg-031e">Date Returned<br> / COA Drafted & Approved </th>
    </tr>
  
  <tbody>
              <tr><td colspan="4"></td></tr>

  </tbody>
</table>
    

</div>

<div id="COA_AREA">
    <form action="" id="COAF" method="post">   
        <center><div id="content">
                <center><p><?php echo 'CERTIFICATE OF ANALYSIS'; ?></p><br></center>
                <center><?php echo 'CERTIFICATE No: CAN/' . date('Y') .'-'.date('y', strtotime('+1 year')) .'/'; ?><input type="text" name="co_num" value="<?php echo @$coa_number[0]->number;?>" style="width:40px"/></center>
                <p></p>
                <p>
                <div id="coa_top">

                  <table id="coa_top_table">
                        <tr id="top_row">
                            <td id="top_head" height="25" align="center" valign="middle"><span >PRODUCT</span></td>
                            <td id="middle_head" align="left" colspan="2"><textarea  style="width:380px; height:40px;" id="product_name" name="product_name"><?php echo $information[0]->product_name; ?></textarea><span id="p_name">REF. NO: &nbsp;<?php echo $information[0]->request_id; ?></span></td>

                        </tr>
                        <tr>
                            <td align="center" valign="middle" id="side"><span>DATE RECEIVED</span></td>
                            <td rowspan="2" align="left" valign="top" id="label_name" class="left_c"><span>LABEL CLAIM</span></td>
                            <td rowspan="2" align="left" valign="top" id="wording"><textarea style="width:100%" name="labelclaim"><?php echo $information[0]->label_claim; ?></textarea></td>
                        </tr>
                        <tr align="center" valign="middle">
                            <td id="side"><input type="text" value="<?php echo $information[0]->designation_date; ?>" name="date_received" id="date_received"></td>
                        </tr>
                        <tr>
                            <td align="center" valign="middle" id="side"><span>BATCH NO.</span></td>
                            <td rowspan="2" align="left" valign="top" id="label_name" class="left_c"><span>PRESENTATION</span></td>
                            <td rowspan="2" align="left" valign="top" id="wording"><textarea style="width:100%" name="presentation"><?php echo $information[0]->presentation; ?></textarea></td>
                        </tr>
                        <tr align="center" valign="middle">
                            <td id="side"><input type="text" value="<?php echo $information[0]->batch_no; ?>" name="batch_no"></td>
                        </tr>
                        <tr>
                            <td align="center" valign="middle" id="side"> <span>MGF. DATE</span></td>
                            <td rowspan="2" align="left" valign="top" id="label_name" class="left_c"><span>MANUFACTURER</span></td>
                            <td rowspan="2" align="left" valign="top" id="wording"><textarea style="width:100%" name="manufacturer"><?php echo $information[0]->manufacturer_name; ?></textarea></td>
                        </tr>
                        <tr align="center" valign="middle">
                            <td id="side"><input type="text" value="<?php echo $information[0]->manufacture_date; ?>" name="mnfg_date" id="mnfg_date" class="monthYearPicker"/></td>
                        </tr>
                        <tr>
                            <td align="center" valign="middle" id="side"><span>EXP. DATE</span></td>
                            <td rowspan="2" align="left" valign="top" id="label_name" class="left_c"><span>ADDRESS</span></td>
                            <td rowspan="2" align="left" valign="top" id="wording"><textarea style="width:100%" name="address" id="addre"><?php echo $information[0]->manufacturer_add; ?></textarea></td>
                        </tr>
                        <tr align="center" valign="middle">
                            <td id="side"><input type="text" value="<?php echo $information[0]->exp_date; ?>" name="exp_date" id="exp_date" class="monthYearPicker"></td>
                        </tr>
                        <tr>
                            <td align="center" valign="middle" id="side">&nbsp;</td>
                            <td rowspan="2" align="left" valign="top" id="label_name" class="left_c"><span>CLIENT</span></td>
                            <td rowspan="2" align="left" valign="top" id="wording"><textarea  readonly style="width:100%" name="client"><?php echo $information[0]->name . " " . $information[0]->address; ?></textarea><a id="CEdit" href="#client-Edit">Edit Client Address</a></td>
                        </tr>
                        <tr align="center" valign="middle">
                            <td id="side"><span>CLIENT REF NO</span></td>
                        </tr>
                        <tr>
                            <td height="40" align="center" valign="middle" id="side"><input type="text" value="<?php echo $information[0]->clientsampleref; ?>" name="client_ref"/></td>
                            <td align="left" valign="bottom" id="label_name"><span>TEST(S) REQUESTED</span></td>
                            <td align="left" valign="bottom" id="wording" style="font-size: 16px;"><?php echo $tests_requested; ?></td>
                        </tr>
                    </table>
                </div>

                <p></p>
                <p></p><br>
                
                <p></p>
                <div id="COA_BODY">
                    <center> <p>
                        <strong>RESULTS</strong>
                    </p></center>
                    <table width="490" height="278" border="1" id="temp_table">
                        <tr align="center" valign="middle">
                            <td height="34" align="center" valign="middle" class="side"><span>TEST</span></td>
                            <td align="center" valign="middle"><span id="hes">METHOD</span></td>
                            <td align="center" valign="middle"><span id="hes">COMPEDIA</span></td>
                            <td align="center" valign="middle"><span id="hes">SPECIFICATION</span></td>
                            <td align="center" valign="middle"><span id="hes">DETERMINED</span></td>
                            <td align="center" valign="middle" class="side"><span>REMARKS</span></td>
                        </tr>

                        <?php
                        for ($i = 0; $i < count($trd); $i++) {

                            foreach ($coa_details as $coa) {

                                if ($coa->test_id == $trd[$i]->test_id) {
                                    $determined = $coa->determined;
                                    $remarks = $coa->verdict;
                                }
                            }
                            ?>

                            <tr class="_rows">
                                <?php if($trd[$i]->test_id==2){?>
                                <td height="56"  rowspan="<?php count($determined);?>" align="center" valign="middle" class="side"><?php echo $trd[$i]->name ?>
                                    <input type="hidden" name="tests[]" value="<?php echo $trd[$i]->test_id ?>"/>
                                </td>
                                <?php }else{?>                                
                                  <td height="56"  align="center" valign="middle" class="side"><?php echo $trd[$i]->name ?>
                                    <input type="hidden" name="tests[]" value="<?php echo $trd[$i]->test_id ?>"/>
                                </td>
                                <?php } ?>

                                <td align="center" valign="middle">
                                    <?php
                                    $j = 1;
                                    $myvals = explode(':', $trd[$i]->methods);

                                    foreach ($myvals as $option) {
                                        $newoption = str_ireplace("(", "&#13;&#10(", $option);
                                        echo ' <textarea  id=' . $j . ' rows="1" cols="10" name="method_' . $i . '[]" value="" class="det methods" placeholder="Input Value" >' . trim($option)
                                        . '</textarea>';
                                        $j++;
                                    }
                                    ?>
                                </td>
                                <td align="center" valign="middle">
                                    <?php
                                    $j = 1;
                                    $myvals = explode(':', $trd[$i]->compedia);

                                    foreach ($myvals as $option) {
                                        //$newoption = str_ireplace("(", "&#13;&#10(", $option);
                                        echo ' <textarea  id=' . $j . ' rows="1" cols="10" name="compedia_' . $i . '[]" value="" class="det" placeholder="Input Value" >' . trim($option)
                                        . '</textarea>';
                                        $j++;
                                    }
                                    ?>
                                </td>

                                <td align="center" valign="middle">
                                    <?php
                                    $j = 1;
                                    $myvals = explode(':', $trd[$i]->specification);

                                    foreach ($myvals as $option) {
                                        $newoption = str_ireplace("(", "&#13;&#10(", $option);
                                        echo ' <textarea  id=' . $j . ' rows="1" cols="10" name="specification_' . $i . '[]" value="" class="det" placeholder="Input Value" >' . $option
                                        . '</textarea>';
                                        $j++;
                                    }
                                    ?>
                                </td>
                                <td align="center" valign="middle" id="addinput">

                                    <?php
                                    $j = 1;
                                    $myvals = explode(':', $trd[$i]->determined);

                                    foreach ($myvals as $option) {
                                        $newoption = str_ireplace("(", "&#13;&#10(", $option);
                                        echo ' <textarea  id=' . $j . ' rows="1" cols="10" name="determined_' . $i . '[]" value="" class="det" placeholder="Input Value" >' . $option
                                        . '</textarea>';
                                        $j++;
                                    }
                                    ?>



                                </td>
                                <td align="center" valign="middle" class="side">
                                    <?php
                                    $j = 1;
                                    $myvals = explode(':', $trd[$i]->complies);

                                    foreach ($myvals as $option) {
                                        ?>

                                        <select  id="<?php echo $j; ?>" name="complies_<?php echo $i; ?>[]"  class="det" selected="selected" >
                                            <option value="<?php echo str_replace("_", " ", $option); ?>"><?php echo str_replace("_", " ", $option); ?></option>
                                            <option value="COMPLIES">COMPLIES</option>
                                            <option value="DOES NOT COMPLY">DOES NOT COMPLY</option>
                                        </select>
                                        <?php
                                        $j++;
                                    }
                                    ?>
                                </td>
                            </tr>
                            </tr>
<?php }; ?>

                    </table>
                </div>

                <p>
                    <label>Conclusion: &nbsp;</label><label class="side"><input type="text" id="conc" name="conclusion" value="<?php echo $conclusion[0]->conclusion; ?>"/></label>
                </p>
                <p>
                <table id="signatories" >
<?php foreach ($signatories as $signatures): ?>            
                        <tr>            
                            <td><?php echo $signatures->designation; ?>:</td>
                            <td><?php echo $signatures->signature_name; ?></td>
                            <td><?php echo $signatures->sign; ?></td>
                            <td>DATE: <?php echo $signatures->date_signed; ?></td>
                        </tr>
<?php endforeach; ?>
                </table>
                   <input type="button" value="Save Changes" id="genCOA" name="genCOA"/>  
                 <input type="button" value="Approve " id="genCOAp"/>              
                <input type="button" value="Return For Correction" id="reCOA" name="reCOA"/>
                <input type="button" value="Mark As OOS" id="mOOS" name="mOOS" style="background: red; color: white;"/>
                <input type="button" value="Back" id="Back" name="genBack"/>
                
        </center>        
    </form>
    <br>

</div>



