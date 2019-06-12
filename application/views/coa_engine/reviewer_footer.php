</div>
<!-- end widget div -->

</div>
<!-- end widget -->

</article>


<!-- WIDGET END -->
</div>
</div>

<div class="tests_table">

    <table class="table table-condensed table-bordered table-striped" >
        <thead>
        <th>Tests (Drag Rows To Reorder)</th>
        </thead>
        <tbody id="sortable_row">

        </tbody>
        <tfoot style="background: #d7ebf9">
        <th>Drag rows to tests</th>
        </tfoot>

    </table>
</div>



<div id="addTest" style="top:1000px; position: absolute;">
    <table>
        <tr><td>
                <button class="btn  btn-info addtest"><span class="fa fa-plus-circle"> Add Test</span></button>&nbsp;</td>
            <td>            <button class="btn btn-primary addsignatory"><span class="fa fa-plus-circle"> Add Signatory</span></button>
            </td>
        </tr>
    </table>
</div>

<div class="panel panel-success col-md-4 col-md-offset-4" style="height: 400px; display: none; margin-top: 100px;" id="signatoriesPanel">
    <div class="panel panel-heading">
        <p><span class="fa fa-plus-circle"> Add Signatory</span></p>
    </div>
    <div class="panel panel-body">
        <form id="signatoriesForm">
            <table class="table table-stripped table-condensed">
                <tr>
                    <td>DESIGNATION: </td><td><select name="designation" class="form-control select">
                            <option value="ANALYST">ANALYST</option>
                            <option value="REVIEWER">REVIEWER</option>
                            <option value="DIRECTOR">DIRECTOR</option>
                        </select></td>
                </tr>
                <tr>
                    <td>NAME:</td>
                    <td><input type="text" class="form-control input-medium" name="designator"/></td>
                </tr>
                <tr>
                    <td>DATE:</td>
                    <td><input type="text" class="form-control input-medium" name="date"/></td>
                </tr>
            </table>
        </form>
    </div>
    <div class="panel panel-footer ">
        <input type="button" class="btn btn-primary btn-lg " id="add_desig_now" value="Save"/>

    </div>
</div>

<div class="panel panel-success col-md-4 col-md-offset-4" style="height: 400px; display: none; margin-top: 100px;" id="testsPanel">
    <div class="panel panel-heading">
        <p><span class="fa fa-plus-circle"> Add Test</span></p>
    </div>
    <div class="panel panel-body">
        <form id="ntf">
            <table class="table table-stripped table-condensed">

                <tr>
                    <td>TEST:</td>
                    <td><select name="test_1" id="test_1" class="form-control select select2" style="width:300px;">

                        </select></td>
                </tr>
                <tr>
                    <td>METHOD:</td>
                    <td><select name="method_1" id="method_1" class="form-control select select2" style="width:320px;">

                        </select> <br><br>                   <input type='text' class="form-control input-medium" id='method_2' style="display:none;"/>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <div class="panel panel-footer ">
        <input type="button" class="btn btn-primary btn-lg " id="add_test_now" value="Save"/>

    </div>

</div>

<div class="panel panel-success col-md-8 col-md-offset-2" style=" display: none; height:400px; margin-top: 100px;" id="clientsPanel">
    <div class="panel panel-heading">
        <p><span class="fa fa-edit"> Edit Client</span></p>
    </div>
    <div class="panel panel-body">
        <form id="e_cli">
            <input id="client_id"  />

            <table class="table table-stripped table-condensed">

                <tr>
                    <td>NAME:</td>
                    <td><input  class="form-control input-lg client_data"   name="c_name" id="c_name"/></td>
                </tr>
                <tr>
                    <td>ADDRESS:</td>
                    <td><input class="form-control input-lg client_data"  name="c_address" id="c_address"/></td>
                </tr>
            </table>
        </form>
    </div>
    <div class="panel panel-footer ">
        <input type="button" class="btn btn-primary btn-lg " id="edit_client_now" value="Save"/>
    </div>
</div>

<div class="panel panel-success col-md-8 col-md-offset-2" style=" display: none; height:400px; margin-top: 100px;" id="reject_reasons">
    <div class="panel panel-heading">
        <p><span class="fa fa-edit"> Sample Reject Area</span></p>
    </div>
    <div class="panel panel-body">
        <form id="reject_reason_COA" class="form-horizontal">
    <p style="color:red; font-weight: bolder;">NB: Please Highlight the reasons for rejecting</p>
    <textarea id="reasonsCOA" class="form-control" style="width:400px; height: 450px;" placeholder="Please State reasons in here" required name="rejectedRe"></textarea>
    
    </form>
    </div>
    <div class="panel panel-footer ">
        <input type="button" class="btn btn-sm btn-primary" value="Submit" id="SubmitReason"/> 
        <input type="button" class="btn btn-sm btn-warning" value="Cancel" id="CSubmitReason"/>
    </div>
</div>

<div id="change_log_overlay" class="col-md-12" style="">
 
<div class="panel panel-success col-md-4 col-md-offset-4" style=" display: none; height:300px; margin-top: 100px;" id="data">
    <div class="panel panel-heading">
        <p><span class="fa fa-edit"> Assign Draft COA</span></p>
    </div>
    <div class="panel panel-body">
        <form id="popup" class="form-horizontal" >


            <select name="director" required id="reviewer" class=" form-control select select2" style="width:300px;">
                                <option value="" selected="selected" >--Select Reviewer--</option>

                            </select>

            </form>
    </div>
    <div class="panel panel-footer ">
        <input type="button" class="btn btn-primary btn-lg " id="assign_button1" value="Assign Draft COA"/>
    </div>
</div>

</div>
</body>
<div id="overlay" class="overlay">
</div>

<div id="invoice">
   
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:100% !important;">
  <div class="modal-dialog" role="document">
      <div class="modal-content" style="width:900px !important; margin: 0 auto;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">INVOICE ENGINE</h4>
      </div>
          <div class="modal-body printable_invoice" style="">
         <?php $this->load->view('coa_engine/invoice');?>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-primary save_invoice"><i class="fa fa-save"></i> Save changes</button>
          <button type="button" class="btn btn-warning print_invoice"><i class="fa fa-print"></i> Print</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>



<script type="text/javascript" src="<?php echo base_url(); ?>coa_engine/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>coa_engine/js/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>coa_engine/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>coa_engine/js/app.config.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>coa_engine/js/app.min.js"></script>
<script src="<?php echo base_url(); ?>coa_engine/js/jarvis.widget.min.js"></script>
<script src="<?php echo base_url(); ?>coa_engine/js/jquery.storageapi.min.js"></script>
<script src="<?php echo base_url(); ?>coa_engine/js/jquery-confirm.js"></script>
<script src="<?php echo base_url(); ?>coa_engine/js/jquery.modal.min.js"></script>
<script src="<?php echo base_url(); ?>coa_engine/js/select2.full.min.js"></script>
<script src="<?php echo base_url(); ?>coa_engine/js/log.js"></script>
<link href="<?php echo base_url() . 'Scripts/fancybox/source/jquery.fancybox.css?v=2.1.3' ?>" type="text/css" media="screen" rel="stylesheet"/>
<script src="<?php echo base_url() . 'Scripts/fancybox/source/jquery.fancybox.js' ?>" type="text/javascript"></script>
<link type='text/css' href='<?php echo base_url(); ?>Scripts/jquery-impromptu.css' rel='stylesheet' media='screen' /></script>
<!--<script src="<?php echo base_url(); ?>javascripts/nqcl_1.js?1500" type="text/javascript"></script>-->
<script type='text/javascript' src='<?php echo base_url(); ?>Scripts/jquery-impromptu.js'></script>
<link href="<?php echo base_url(); ?>stylesheets/jquery_notification.css" type="text/css" rel="stylesheet"/>
<script type="text/javascript" src="<?php echo base_url(); ?>javascripts/jquery_notification_v.1.js"></script>
<script src = "<?php echo base_url(); ?>coa_engine/js/webodf.js" type="text/javascript" charset="utf-8"></script>
<script src = "<?php echo base_url(); ?>coa_engine/js/noty/packaged/jquery.noty.packaged.js" type="text/javascript" charset="utf-8"></script>
<script>
    $(document).ready(function () {
        pageSetUp();
        s4= "<?php echo $s4; ?>";
        base_url = "<?php echo base_url(); ?>";
        labref = "<?php echo $labref; ?>";
        loadTopInfo(labref);
       loadTests(labref);
        loadTestsRe(labref);
        loadSampleTests(labref);
        loadSignatories(labref);
        loadLabrefs();
        load_reviewers();
        removed = '';
         storage = $.localStorage;
        settings = $.localStorage;
		
		
		 $('#MSWORD').click(function () {
            generate('information', 'COA Save process started..');


            postData = $('#COAF').serialize();

            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>coa/saveCOA/" + labref + "/coa_printing",
                data: postData,
                success: function () {

                    generate('success', 'COA Has been succesfully Saved');

                    $("#coaSettings").modal({
                        fadeDuration: 1000,
                        fadeDelay: 0.50
                    });
                     fetchSetSettings();

                    return true;


                },
                error: function () {
                    generate('error', 'An error occured while attempting to export the draft, please contact system Administrator for help!');

                    return false;
                }

            });

        });
        if(s4==='reviewer'){
            $('#BackButton').hide();
            $('#genCOAp').hide();
            $('#reCOA').hide();
            $('#mOOS').hide();
        }else{
            $('#BackButton').show()
            $('#genCOAp').show()
            $('#reCOA').show()
            $('#reCOA').show()

        }
        //generate('success');
 $('#GenCOAFinal').click(function () {
            setSettings();
            data = $('#coa_settings').serialize();
            generate('information', 'Exporting final COA to Ms.Word and preparing download..');

            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>wordexe/generate/" + labref,
                data: data,
                success: function () {
                    generate('success', 'COA successfully Generated and exported, Please click "Save File" for ' + labref + '.docx..')
                   
                    $('#genCOAWordDATA').prop('disabled', false);
                     
                    window.location.href = "<?php echo base_url() . 'printed_coa/'; ?>" + labref + '.docx';
                    $.modal.close();
                    return true;


                }, error: function () {
                    generate('error', 'An error occured while attempting to export the draft, please contact system Administrator for help!');
                    return false;
                }

            });
        });
		
		
		        function copyStorageItems() {
            //TOP TEXT AREA
            storage.set('product_name', $('#product_name').val());
            storage.set('labelclaim', $('#labelclaim').val());
            storage.set('presentation', $('#presentation').val());
            storage.set('manufacturer', $('#manufacturer').val());
            storage.set('address', $('#addre').val());
            storage.set('client', $('#client').val());

            //TOP SIDE TEXTAREA

            storage.set('date_received', $('#date_received').val());
            storage.set('batch_no', $('#batch_noo').val());
            storage.set('exp_date', $('#exp_date').val());
            storage.set('mnfg_date', $('#mnfg_date').val());
            storage.set('client_ref', $('#client_ref').val());

            storage.set('client_id', $('#client_id').val());
            storage.set('c_name', $('#c_name').val());
            storage.set('c_address', $('#c_address').val());
        }

        function pasteStorageItems() {
            //TOP TEXT AREA
            $('#product_name').val(storage.get('product_name'));
            $('#labelclaim').val(storage.get('labelclaim'));
            $('#presentation').val(storage.get('presentation'));
            $('#manufacturer').val(storage.get('manufacturer'));
            $('#addre').val(storage.get('address'));
            $('#client').val(storage.get('client'));

            //TOP SIDE TEXTAREA

            $('#date_received').val(storage.get('date_received'));
            $('#batch_noo').val(storage.get('batch_no'));
            $('#exp_date').val(storage.get('exp_date'));
            $('#mnfg_date').val(storage.get('mnfg_date'));
            $('#client_ref').val(storage.get('client_ref'));

            $('#client_id').val(storage.get('client_id'));
            $('#c_name').val(storage.get('c_name'));
            $('#c_address').val(storage.get('c_address'));
        }

        function clearStorageItems() {
            storage.removeAll(true);
        }
        
        function setSettings() {
            //TOP TEXT AREA
            settings.set('coa_size', $('#coa_size').val());
            settings.set('coa_size_rsize', $('#coa_size_rsize').val());
            settings.set('coa_line_spacing', $('#coa_line_spacing').val());
            settings.set('label_size', $('#label_size').val());
            settings.set('sublabel_size', $('#sublabel_size').val());
            settings.set('tfont', $('#tfont').val());

            //TOP SIDE TEXTAREA

            settings.set('theight', $('#theight').val());
            settings.set('fcfont', $('#fcfont').val());
            settings.set('fmfont', $('#fmfont').val());
            settings.set('flfont', $('#flfont').val());
            settings.set('rtrheight', $('#rtrheight').val());

            settings.set('rtconclusion', $('#rtconclusion').val());
            settings.set('sdes', $('#sdes').val());
            settings.set('sname', $('#sname').val());
            settings.set('sdate', $('#sdate').val());
        }

        function fetchSetSettings() {
            //TOP TEXT AREA
            $('#coa_size').val(storage.get('coa_size'));
            $('#coa_size_rsize').val(storage.get('coa_size_rsize'));
            $('#coa_line_spacing').val(storage.get('coa_line_spacing'));
            $('#label_size').val(storage.get('label_size'));
            $('#sublabel_size').val(storage.get('sublabel_size'));
            $('#tfont').val(storage.get('tfont'));

            //TOP SIDE TEXTAREA

            $('#theight').val(storage.get('theight'));
            $('#fcfont').val(storage.get('fcfont'));
            $('#fmfont').val(storage.get('fmfont'));
            $('#flfont').val(storage.get('flfont'));
            $('#rtrheight').val(storage.get('rtrheight'));

            $('#rtconclusion').val(storage.get('rtconclusion'));
            $('#sdes').val(storage.get('sdes'));
            $('#sname').val(storage.get('sname'));
            $('#sdate').val(storage.get('sdate'));
        }

        function clearSetting() {
            settings.removeAll(true);
        }

        //   var odfelement = document.getElementById("odf"),
        // odfcanvas = new odf.OdfCanvas(odfelement);
//odfcanvas.load("<?php echo base_url(); ?>MANAGEMENT_FUNCTION.odt");

        $('.select2').select2();
		
	


        storage = $.localStorage;

        $('#hrefClear').click(function () {

            $('.textarea_top_side').text('');
            $('.textarea_top').text('');
        });

        $('#hrefCopy').click(function () {
            copyStorageItems();
        });

        $('#hrefPaste').click(function () {
            pasteStorageItems();
        });
		
		$('#invoice').click(function () {
            window.open(base_url+"coa/generatecoa_invoice/"+labref+"/INVOICE","_blank");
        });
        $('#hrefEmpty').click(function () {

            $.confirm({
                title: 'Clear Clipboard?',
                content: "You are about to clear the clipboard, you will not be able to paste the COA data you previously copied",
                autoClose: 'cancel|10000',
                confirm: function () {
                    clearStorageItems();
                },
                cancel: function () {
                    console.log('Cancelled');
                }
            });

        });

        $('#client').click(function () {
            saveCOA();
            $("#clientsPanel").modal({
                fadeDuration: 1000,
                fadeDelay: 0.50
            });
        });

        $('#makeCOPY').click(function () {
            value = $('#labrefs_area').val();
            if (value === '') {
                $.alert('Kindly Select a Labref Number First');
            } else {



                $.confirm({
                    title: "MAKE A COPY of " + labref + '.docx TEMPLATE',
                    keyboardEnabled: true,
                    content: 'Please note that you are about to replicate one draft COA for another, the file structure will remain the same but the data will vary, please update the softcopy in LIMS and the generated Ms.Word doc appropriately to ensure data integrity.\nThis Feature is experimental and should be used with much care\n \nDo you want to continue?\n Press ESC to cancel or ENTER to continue ',
                    cancel: function () {

                    },
                    confirm: function () {
                        generate('information', 'Commencing Replication Operation.. Please Wait..');
                        $.getJSON(base_url + 'coa/makeCopy/' + $('#labref_coa').val() + '/' + value, function (resp) {
                            generate('success', 'Operation completed Successfully, Availing BAT file for download..');


                        }).fail(function (e)
                        {
                            generate('success', 'Operation completed Successfully, Availing Word document for download..');
                            window.location.href = "<?php echo base_url() . 'printed_coa/'; ?>" + value + '.docx';

                        });

                    }
                });



            }
        });



        function copyStorageItems() {
            //TOP TEXT AREA
            storage.set('product_name', $('#product_name').val());
            storage.set('labelclaim', $('#labelclaim').val());
            storage.set('presentation', $('#presentation').val());
            storage.set('manufacturer', $('#manufacturer').val());
            storage.set('address', $('#addre').val());
            storage.set('client', $('#client').val());

            //TOP SIDE TEXTAREA

            storage.set('date_received', $('#date_received').val());
            storage.set('batch_no', $('#batch_noo').val());
            storage.set('exp_date', $('#exp_date').val());
            storage.set('mnfg_date', $('#mnfg_date').val());
            storage.set('client_ref', $('#client_ref').val());

            storage.set('client_id', $('#client_id').val());
            storage.set('c_name', $('#c_name').val());
            storage.set('c_address', $('#c_address').val());
        }

        function pasteStorageItems() {
            //TOP TEXT AREA
            $('#product_name').val(storage.get('product_name'));
            $('#labelclaim').val(storage.get('labelclaim'));
            $('#presentation').val(storage.get('presentation'));
            $('#manufacturer').val(storage.get('manufacturer'));
            $('#addre').val(storage.get('address'));
            $('#client').val(storage.get('client'));

            //TOP SIDE TEXTAREA

            $('#date_received').val(storage.get('date_received'));
           // $('#batch_noo').val(storage.get('batch_no'));
            $('#exp_date').val(storage.get('exp_date'));
            $('#mnfg_date').val(storage.get('mnfg_date'));
            $('#client_ref').val(storage.get('client_ref'));

            $('#client_id').val(storage.get('client_id'));
            $('#c_name').val(storage.get('c_name'));
            $('#c_address').val(storage.get('c_address'));
        }

        function clearStorageItems() {
            storage.removeAll(true);
        }

        function loadTopInfo(labref) {
            $(document).ajaxStart(function () {
                console.log('sss');
            });
            $.getJSON(base_url + 'coa/getRequestInformationAJAX/' + labref, function (resp) {

                $('#labref_coa').val(labref);
                $('#p_name').text('REF. NO: ' + labref);
                $('#product_name').val(resp[0].product_name);
                $('#labelclaim').val(resp[0].label_claim);
                $('#presentation').val(resp[0].presentation);
                $('#manufacturer').val(resp[0].manufacturer_name);
                $('#addre').val(resp[0].manufacturer_add);
                $('#client').val(resp[0].name + ' ' + resp[0].address);

                //TOP SIDE TEXTAREA

                $('#date_received').val(resp[0].designation_date);
                $('#batch_noo').val(resp[0].batch_no);
                $('#exp_date').val(resp[0].exp_date);
                $('#mnfg_date').val(resp[0].manufacture_date);
                $('#client_ref').val(resp[0].clientsampleref);
                $('#client_id').val(resp[0].client_id);
                $('#c_name').val(resp[0].name);
                $('#c_address').val(resp[0].address);
            })
                    .fail(function (e)
                    {
                        console.log(e);
                    });
            $(document).ajaxStop(function () {
                $('.fadeMe').hide();
            });


        }




        function loadLabrefs() {

            labrefs = $('#labrefs_area');
            $.getJSON(base_url + 'coa/coaLabrefAJAX/', function (resp) {
                labrefs.empty();
                $.each(resp, function (i, data) {
                    $option = '<option value=' + data.labref + '>' + data.labref + '</option>';
                    labrefs.append($option);
                });

            })
                    .fail(function (e)
                    {
                        console.log(e);
                    });

        }





        function loadTests(labref) {


            $.getJSON(base_url + 'coa/getRequestedTestsAJAX/' + labref, function (resp) {
                // console.log(resp)
                $('#requested_tests').text('');
                $('#requested_tests').text(resp);

            })
                    .fail(function (e)
                    {
                        console.log(e);
                    });

        }


        function loadTestMethods() {

            methods = $('#method_1');
            $.getJSON(base_url + 'coa/test_methods_AJAX/', function (resp) {
                methods.empty();
                $.each(resp, function (i, data) {
                    $option = '<option value=' + data.name + '>' + data.name + '</option>';
                    methods.append($option);
                });
                methods.append('<option value="1">Other</option>');

            })


                    .fail(function (e)
                    {
                        console.log(e);
                    });

        }


        function loadPureTests() {

            tests = $('#test_1');
            $.getJSON(base_url + 'coa/test_AJAX/', function (resp) {
                tests.empty();
                $.each(resp, function (i, data) {
                    $option = '<option value=' + data.id + '>' + data.name + '</option>'
                    tests.append($option);
                });

            })


                    .fail(function (e)
                    {
                        console.log(e);
                    });

        }

        function loadTestsRe(labref) {

            $(document).ajaxStart(function () {
                $('.fadeMe').show();
            });
            $.getJSON(base_url + 'coa/getRequestedTestsAJAXRe/' + labref, function (resp) {
                $('.tests_table tbody').empty();
                $.each(resp, function (i, data) {
                    //  console.log(data)
                    $row = "<tr id=\"testReorder_" + data.id + "\"><td>" + data.name + "</td> <td id='test_data_id' data-id=" + data.id + "><a href='#removeTest' class='removeTest' id=" + data.id + " data-name=" + data.name + " data-test_id=" + data.test_id + "><span class='fa fa-remove' title='Remove Test'></span></a></td></tr>";
                    $('.tests_table tbody').append($row);
                });



            })
                    .fail(function (e)
                    {
                        console.log(e);
                    });
            $(document).ajaxStop(function () {
                $('.fadeMe').hide();
            });
        }

        $(document).on('click', '.removeTest', function () {

            id = $(this).attr('id');
            $name = $(this).attr('data-name');
            tid = $(this).attr('data-test_id');
            console.log(id + tid);


            $.confirm({
                title: "DELETE " + $name,
                keyboardEnabled: true,
                content: 'You are about to PERMANENTLY Remove this test\nDo you want to continue?\n Press ESC to cancel or ENTER to continue ',
                cancel: function () {

                },
                confirm: function () {
                    $.ajax({
                        type: 'post',
                        url: "<?php echo base_url() . 'coa/deletetest/'; ?>" + labref + '/' + tid,
                        success: function () {
                            generate('success', $name + 'has been deleted Successfully!');
                            loadSampleTests(labref);
                            loadTestsRe(labref);
                        }, fail: function () {
                            generate('error', 'An error occured, Contact System Administrator');
                        }
                    })

                }
            });

        });


        $(document).on('click', '#removeSignature', function () {


            tid = $(this).attr('data-sid');



            $.confirm({
                title: "REMOVE SIGNATORY",
                keyboardEnabled: true,
                content: 'You are about to PERMANENTLY Remove this Signatory\nDo you want to continue?\n Press ESC to cancel or ENTER to continue ',
                cancel: function () {

                },
                confirm: function () {
                    $.ajax({
                        type: 'post',
                        url: "<?php echo base_url() . 'coa/remove_signatory/'; ?>" + tid,
                        success: function () {
                            generate('success', 'Signatory has been removed Successfully!');
                            loadSignatories(labref);
                        }, fail: function () {
                            generate('error', 'An error occured, Contact System Administrator');
                        }
                    })

                }
            });

        });


        $('#method_1').change(function () {
            value = $(this).val();
            if (value === '1') {
                $('#method_1').prop('name', '');
                $('#method_2').prop('name', 'method_1');
                $('#method_2').show();
                $('#method_2').prop('placeholder', 'Please specify Method here');
            } else {
                $('#method_2').prop('name', '');
                $('#method_1').prop('name', 'method_1');
                $('#method_2').hide();
            }
        });
        $('#method_2').hide();

        function loadSampleTests(labref) {


            $.getJSON(base_url + 'coa/getRequestedTestsDisplayAJAX/' + labref, function (resp) {

                $('.result_table tbody').empty();
                $.each(resp, function (di, data) {
                    alert(data.determined)
                    $determined = data.determined;
                    $det = $determined.split(":");
                    $method = data.method;
                    $meth = $method.split(":");
                    $compedia = data.compedia;
                    $comp = $compedia.split(":");
                    $specification = data.specification;
                    $spec = $specification.split(":");
                    $complies = data.complies;
                    $com = $complies.split(":");

                   

                        $rows = '<tr align="middle" valign="middle"><td class="tbody_data side" style="font-size:13px; " >' + data.name + '</td>\n\
                         <td align="center" valign="middle" class="tbody_data" style="padding: 0px;"><input type="hidden" class="test_id" name="tests[]" value=' + data.test_id + '>\n';
                        for (i = 0; i < $meth.length; i++) {
                            $rows += '<textarea class="det_st methods form-control" name="method_' + di + '[]" style="border:none; vertical-align: middle;" >' + $meth[i] + '</textarea>';

                        }
                        $rows += '</td><td class="tbody_data" style="padding: 0px;">';

                        for (i = 0; i < $comp.length; i++) {
                            $rows += '<textarea class="det_st compendia form-control" name="compedia_' + di + '[]" style="border:none;" >' + $comp[i] + '</textarea>';

                        }


                        $rows += '  </td><td class="tbody_data" style="padding: 0px;">';

                        for (i = 0; i < $spec.length; i++) {
                            $rows += '<textarea class="det_st specification form-control" name="specification_' + di + '[]" style="border:none;" >' + $spec[i] + '</textarea>';

                        }

                        $rows += ' </td><td class="tbody_data" style="padding: 0px;" >';
                        for (i = 0; i < $det.length; i++) {
                            $rows += '<textarea class="det_st determined form-control" name="determined_' + di + '[]" style="border:none;" >' + $det[i] + '</textarea>';

                        }

                        $rows += '</td><td class="tbody_data side" width="50px">';

                        for (i = 0; i < $com.length; i++) {
                            $rows += '<select selected=selected class="select select2 complies_split" name="complies_' + di + '[]" style="border:none; margin-top:10px; width:120px; ">\n\
                            <option value="' + $com[i] + '">' + $com[i] + '</option>\n\
                            <option value="COMPLIES">COMPLIES</option>\n\
                            <option value="DOES NOT COMPLY">DOES NOT COMPLY</option>\n\
                            <option value=":">SPLIT</option>\n\
                            <option value="Remove">REMOVE</option>\n\
                            </select>';

                        }
                        $rows += ' </td></tr>';
                    

                    $('.result_table tbody').append($rows);

                    $('#Conclusion').val(resp[0].conclusion);
                });


                $("textarea").each(function () {
                    this.style.height = (this.scrollHeight + 0) + 'px';
                });
                 $("textarea.ADDRESS").each(function () {
                    this.style.height = (this.scrollHeight + 150) + 'px';
                });
                
                
                $('#reasonsCOA').css('height','200px');
                 $('#reasonsCOA').css('width','100%');





            })
                    .fail(function (e)
                    {
                        console.log(e);
                    });
        }

        $(document).on('change', '.complies_split', function () {
            $value = $(this).val();
            if ($value === ':') {
                saveCOA();
            } else if ($value === 'Remove') {
                $(this).remove();
            }
        });
		
		$(document).on('mouseover','.datepick',function(){
			$(this).datepicker({
				changeMonth:true,
				dateFormat:'dd-mm-yy'
			});
		});

        function loadSignatories(labref) {


            $.getJSON(base_url + 'coa/getSignatoriesAJAX/' + labref, function (resp) {
                $('#signatoriesData').empty();
                $.each(resp, function (i, data) {
                    //  console.log(data)
                    $row = ' <div class="form-group" > <div class="col-sm-2"> <input type="text" style="border :none;" name="designation[]" class="designator form-control" value=' + data.designation + ' style="text-align:left;"/></div> <div class="col-sm-3"> <input type="text" style="border :none; text-transform: uppercase;" name="designator[]" class="designator_name form-control" value="' + data.signature_name + '" style="text-align:left;"/></div>  <div class="col-sm-3"> <input type="text" style="border :none;" name="signature[]" class="signature form-control" value="________________________________________" readonly/> </div> <div class="col-sm-3"> <input type="text" style="border :none;" name="date[]" class="date datepick form-control" value=' + data.date_signed + ' placeholder="Enter Date"/></div><a  href="#remove-signatory"> <span class="fa fa-remove" data-sid=' + data.id + ' id="removeSignature"></span></a> </div>';
                    $('#signatoriesData').append($row);
                });



            })
                    .fail(function (e)
                    {
                        console.log(e);
                    });

        }
		
		
		$(document).on("focusout", ".result_table tr td", function () {

            // How many textareas within this cell?
            var text = $("textarea", this).val();
                character= text.slice(-1);
           if(character===':'){
			   //generate('information',"Splitting cells & Saving, please wait....");
			  saveCOA();
		   }else{
		  
			    saveCOA();
			 //  generate('information',"Splitting cells & Saving, please wait....");
		   }
        });



// Initialize an array to store all the removed textareas.
        var removedTextAreas = [];

        $(document).on("mouseover", ".result_table tr td", function () {

            // How many textareas within this cell?
            var numberOfTextAreas = $("textarea", this).length;

            // Handle the double click event.
            handleDblClick(numberOfTextAreas, this);
        });

        $("#hrefUndo").on("click", function () {
            // Is there anything removed and not undone?
            if (removedTextAreas.length > 0) {
                // The undo goes from the last to the first in the list.
                // We always re-attach the last one that has been removed.
                var itemPos = removedTextAreas.length - 1;
                var reAttach = removedTextAreas[itemPos];
                var previous = reAttach.previous;
                var next = reAttach.next;

                if (previous.length > 0) {
                    // The removed element had a sibling before it,
                    // so let's append it back after this sibling.
                    reAttach.textarea.appendTo(reAttach.cell);
                } else {
                    // The removed element had a sibling after it,
                    // so let's append it back before this sibling.
                    reAttach.textarea.prependTo(reAttach.cell);
                }

                // We now can remove this item from the list of
                // removed textareas.
                removedTextAreas.splice(itemPos);
            }
        });

// Let's separate concerns by creating a function.
// This way you can also reduce the code within the caller.
        function handleDblClick(numberOfTextAreas, el) {
            // The target for the double click.
            var target = $("textarea", el);

            // Let's unbind the double click to start with.
            target.off("dblclick");

            // Two or more textareas?
            if (numberOfTextAreas >= 2) {
                target.on("dblclick", function () {
                    // Let's store the removed textarea and some details
                    // to identify its current parent and siblings.
                    removedTextAreas.push({
                        cell: $(this).closest("td"),
                        previous: $(this).prev("textarea"),
                        next: $(this).next("textarea"),
                        textarea: $(this).detach()
                    });
                });
            }
        }





        $('#sortable_row').sortable({
            update: function (event, ui) {
                var data = $('#sortable_row').sortable('serialize');

                $.ajax({
                    data: {list: data},
                    type: 'POST',
                    url: base_url + 'coa/updateQuestionOrder/',
                    success: function (response) {
                        loadTests(labref);
                        loadSampleTests(labref)
                    }, error: function () {

                    }
                });
            }
        });


        function generate(type, text) {
            var n = noty({
                text: text,
                type: type,
                dismissQueue: true,
                timeout: 10000,
                closeWith: ['click'],
                layout: 'topCenter',
                theme: 'defaultTheme',
                maxVisible: 10,
            });
            console.log('html: ' + n.options.id);
        }

        $('.addsignatory').click(function () {
            $("#signatoriesPanel").modal({
                fadeDuration: 1000,
                fadeDelay: 0.50
            });
        });

        $('.addtest').click(function () {
            loadPureTests();
            loadTestMethods();
            $("#testsPanel").modal({
                fadeDuration: 1000,
                fadeDelay: 0.50
            });

        });
        $('#add_desig_now').click(function () {
            $.ajax({
                type: 'post',
                data: $('#signatoriesForm').serialize(),
                url: "<?php echo base_url() . 'coa/send_to_signatureAJAX/'; ?>" + labref,
                success: function () {
                    generate('success', 'Signatory has been Added Successfully!');
                    loadSignatories(labref);
                    $.modal.close();
                }, fail: function () {
                    generate('error', 'An error occured, Contact System Administrator');
                }
            });
        });


        $('#SaveGenCOAS').click(function () {
            saveCOA();

        });

        function saveCOA() {
            $(this).prop('disabled', 'disabled');
            postData = $('#COAF').serialize();

            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>coa/saveCOA/" + labref,
                data: postData,
                success: function () {

                    loadTopInfo(labref);
                    loadSampleTests(labref);
                    generate('success', 'COA Successfully Saved');
                    $("#SaveGenCOAS").prop('disabled', false);
                },
                error: function () {
                    generate('error', 'COA Engine Encountered an error while saving, Please contact System Administrator');

                    return false;
                }

            });

        }



        $('#BackButton').click(function () {

            window.location.href = "<?php echo base_url() . 'coa_review/draft_coa_review'; ?>";
            return false;
        });


        $('#edit_client_now').click(function () {

            $(this).prop('disabled', 'disabled');
            postData = $('#e_cli').serialize();

            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>coa/saveClient/" + $('#client_id').val(),
                data: postData,
                success: function () {

                    generate('success', 'Save Successfull');
                    $.modal.close();
                    loadTopInfo(labref);

                },
                error: function () {
                    generate('error', 'An Error Was Encountered!');
                    return false;
                }

            });

        });


        $('#add_test_now').click(function () {

            $(this).prop('disabled', 'disabled');
            postData = $('#ntf').serialize();

            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>coa/saveCOANT/" + labref,
                data: postData,
                success: function () {

                    generate('success', 'Save Successfull');
                    $.modal.close();
                    loadSampleTests(labref);
                    loadTestsRe(labref);
                    $('#add_test_now').prop('disabled', false);


                },
                error: function () {
                    generate('error', 'An Error Was Encountered!');
                    return false;
                }

            });

        });




        $('#genCOAWordDATA').click(function () {
            generate('information', 'DRAFT COA Save process started');


            postData = $('#COAF').serialize();

            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>coa/saveCOA/" + labref + "/coa_printing",
                data: postData,
                success: function () {

                    generate('success', 'DRAFT COA Has been succesfully Saved');
                   

                    return true;


                },
                error: function () {
                    generate('error', 'An error occured while attempting to save the draft, please contact system Administrator for help!');

                    return false;
                }

            });

        });



        $('#mOOS').click(function () {

            $.prompt("This sample is about to be marked as an OOS!, Do you want to continue with this action?", {
                title: "OOS Status",
                buttons: {"Yes, Mark as OOS": 1, "No, Cancel Action": false},
                focus: 1,
                submit: function (e, v, m, f) {
// use e.preventDefault() to prevent closing when needed or return false. 
// e.preventDefault(); 

                    if (v === 1) {
                        generate('information', 'Sample Successfully Marked As OOS');

                        $.post("<?php echo base_url() . 'reviewer/make_oos_coa/'; ?>" + labref, function () {
                            window.location.href = "<?php echo base_url(); ?>coa_review/draft_coa_review/";

                        });


                    } else {

                      
                    }

                    console.log("Value clicked was: " + v);
                }
            });

        });



        $('#genCOAp').click(function () {
           $(this).prop('disabled', 'disabled');
            $.post("<?php echo base_url(); ?>directors/approve_coa_draft/" + labref, function () {
                generate('information', "Draft Save was Successful, forwarding to the Director\'s office.");
                window.location.href = "<?php echo base_url(); ?>coa_review/draft_coa_review";
            });

        });


        $('#CSubmitReason').click(function () {
            $.modal.close();
        });


        $('#edit_client_now').click(function () {

            $(this).prop('disabled', 'disabled');
            postData = $('#e_cli').serialize();

            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>coa/saveClient/" + $('#client_id').val(),
                data: postData,
                success: function () {

                    generate('information', 'Client Successfully Saved!');

                    $.modal.close();
					 loadSampleTests(labref);
                    loadTestsRe(labref);

                    //window.location.href = "<?php echo base_url() . 'coa/generateCoa_cr/' ?>" + labref;

                },
                error: function () {
                    generate('error', 'An Error occured While saving');
                    return false;
                }

            });

        });



        $('#edit_chalient_now').click(function () {
            $(this).prop('value', 'Processing....');
            $(this).prop('disabled', 'disabled');
            postData = $('#e_chali').serialize();

            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>coa/switchclient/<?php echo $labref; ?>",
                                data: postData,
                                success: function () {

                                    generate('success', 'Client Successfully switched');

                                    $.modal.close();

                                    window.location.href = "<?php echo base_url() . 'coa/generateCoa_cr/'; ?>" + labref;

                                },
                                error: function () {
                                    generate('error', 'An Error occured While saving');
                                    return false;
                                }

                            });

                        });

                        $('#cancel_client_now').click(function () {
                            $.modal.close();
                        });

                        $('#CEdit').click(function () {
                            $.fancybox({
                                href: '#edit_client'
                            })
                        });


                        $('#BackList').click(function () {
           window.location.href=base_url+'coa_review/draft_coa_review';
        });



                        $('#reCOA').click(function () {
                                $("#reject_reasons").modal({
                fadeDuration: 1000,
                fadeDelay: 0.50
            });
        });

                         
             

$('#SubmitReason').click(function () {
    value1 = $('#reasonsCOA').val();
    if (value1 === '') {
    $.alert('Kindly State the reasons for rejection first');
        } else {

            //$(this).prop('disabled', 'disabled');
            postData = $('#COAF').serialize();

            $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>coa/saveCOA/<?php echo $labref; ?>",
            data: postData,
            success: function () {

                generate('success', 'Operation completed successfully');

                $.post("<?php echo base_url(); ?>assign/rejectReason/<?php echo $labref; ?>", $('#reject_reason_COA').serialize(), function () {
                                            window.location.href = "<?php echo base_url(); ?>coa_review/draft_coa_review";

                                        });


                            $('#genCOA').prop('disabled', false);

                        },
                        error: function () {
                            generate('error', 'An Error occured While saving');
                            return false;
                        }

                    });
                }
            });
            
            
               function load_reviewers(){


               $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>assign_director/getAJAXDirectors/",
                    dataType: "JSON",
                    success: function(reviewers)
                    {

                        $.each(reviewers, function(id, city)
                        {
                            var opt = $('<option />'); // here we're creating a new select option for each group
                            opt.val(city.id);
                            opt.text(city.lname + " " + city.fname);
                            $('#reviewer').append(opt);
                        });
                    }

                });
                }

                $('#assign_button1').click(function() {
                    var rev = $('#reviewer').val();
                    if (rev == '') {
                      generate('error',"Assign Error: No Reviewer Selected!");

                        return true;
                    } else {


                    
                        var data1 = $('#popup').serialize();
                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url(); ?>assign_director/sendSamplesFolderToDirectorRev/" + labref,
                            data: data1,
                            success: function(data)
                            {

                                generate('success',"Draft COA Successfully Assigned");


                                   window.location.href = '<?php echo base_url(); ?>reviewer';

                                return true;
                            },
                            error: function(data) {
                                   generate('error',"An error occured, Please contact System Administrator");



                                return false;
                            }
                        });
                        return false;
                    }
                });
                
                 $('#sendToDocumentation').click(function() {
               
                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url(); ?>assign_director/sendToDocumentation/" + labref,
                             success: function(data)
                            {

                                generate('success',"Draft COA Successfully Sent To Documentation..");


                                    window.location.href = '<?php echo base_url(); ?>reviewer';

                                return true;
                            },
                            error: function(data) {
                                   generate('error',"An error occured, Please contact System Administrator");



                                return false;
                            }
                        });
                        return false;
                    });
             


  $('#sendDirect').click(function () {
              saveCOA();
         $("#data").modal({
                fadeDuration: 1000,
                fadeDelay: 0.50
            });
        });
        
        $('#genCOAS,#printDraftCOA').click(function () {
        $('#coa_top_table').css('border','1px black solid');
        $('#coa_top_table').css('width','98%');
        $('#coa_top_table').css('font-family','Book Antiqua');
        $('#coa_top_table').css('margin-left','15px');
        $('#side').css('backgroud-color','#CCCCCC');
        $('.side').css('backgroud-color','#CCCCCC');
        $('#heading').css('font-size','14px');
        $('#heading').css('font-family','Book Antiqua');
        $('#heading').css('font-weight','bolder');
        $('#heading').css('text-aligh','center');
        $('#coa_top_table tr').css('border','1px black solid');
        $('#coa_top_table tr td').css('border','1px black solid');
        $('.tests_table,#addTest,.not_pintable').hide();


   window.print();
   $('.tests_table,#addTest,.not_pintable').show();
        });
		
$(document).on('keyup','.designator_name',function(){
        $(".designator_name").autocomplete({
            source: function(request, response) {
                $.ajax({url: "<?php echo site_url('coa/suggest'); ?>",
                    data: {term: $(".designator_name",this).val()},
                    dataType: "json",
                    type: "POST",
                    success: function(data) {
                        response(data);
                    }
                });
            },
            minLength: 1,
            Delay: 200
        });
        });


});
</script>
</body>

</html>
