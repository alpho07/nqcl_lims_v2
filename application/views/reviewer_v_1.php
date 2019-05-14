<?php error_reporting(0); ?>
<style>
    #rej{
        display:none;
    }
</style>
<script>
<?php
if ($uri == 'approved_samples') {
    $url = 'worksheets2';
} else {
    $url = 'worksheets1';
}
?>
    $(document).ready(function () {
        base_url = "<?php echo base_url(); ?>";
        base_url2 = "<?php echo base_url(); ?>upload/coa_reviewer_uploads/";
        getData();
        $(document).on('click', '.reject_1', function () {
            id = $(this).attr('id');
            $('#labref').val(id);
            $.fancybox.open({
                href: '#rej',
                width: 600,
                height: 500
            });
        });

        $(document).on('click', '.redirect_1', function () {
            id = $(this).attr('id');
            window.location.href=base_url2+id;
        });

        $('#rejecting').click(function () {
            value = $('#reason').val();
            if (value == '') {
                alert('Please give a reason for rejecting this sample');
            } else {
                $(this).prop('value', 'Please wait...')
                $.ajax({
                    type: 'post',
                    url: "<?php echo base_url(); ?>reviewer/reject/" + $('#labref').val() + "/" + $('#level').val(),
                    data: $('#reasons').serialize(),
                    success: function () {
                        window.location.href = '<?php echo base_url(); ?>reviewer/';
                    },
                    error: function () {
                        alert('Notice: You have already posted a rejection reason for this sample!');
                        window.location.href = '<?php echo base_url(); ?>reviewer/';
                    }

                });
            }
        });
        $('#canceling').click(function () {
            $.fancybox.close();
        });

        $('.reason').on('mouseover', function () {
            id = $(this).prop('id');

            $.ajax({
                type: 'get',
                url: "<?php echo base_url(); ?>reviewer/reject_reason/" + id + "/Reviewer/",
                dataType: 'json',
                success: function (data) {
                    alert(data[0].reject_reason);
                },
                error: function () {
                    alert('An error occured when attempting to retrieve Rejection reason!');

                }
            });


        });


        $(document).on('click', '.edited_workbook', function () {
            link = $(this).attr('data-link');
            // alert("<?php echo base_url() ?>"+link)
            window.location.href = "<?php echo base_url() . 'upload/reviewer_uploads/' ?>" + link;
        });

        $(document).on('click', '.update_coa', function () {
            link = $(this).attr('data-link');
            // alert("<?php echo base_url() ?>"+link)
            window.location.href = "<?php echo base_url() . 'upload/worksheet/' ?>" + link
        })
        $(document).on('click', '.download_workbook', function () {
            id = $(this).attr('id');
            // alert("<?php echo base_url() ?>"+link)
            window.location.href = "<?php echo base_url() ?>analyst_uploads/" + id + ".xlsx"
        })

        $(document).on('click', '.update_draft', function () {
              id = $(this).attr('id');
            window.location.href=base_url + "coa/generateCoa_final_review/" + id + "/reviewer";

            $.prompt("We are now redirecting you the raw Draft COA for further updates you will commit, please make sure that you have uploaded the workbook to do the first COA update before you proceed!", {
                title: "REDIRECT CONFIRMATION",
                buttons: {"DONE, Please Redirect": 1, "No, Let me Update": false},
                focus: 1,
                submit: function (e, v, m, f) {


                    if (v === 1) {

                       


                   
                    } else {
                        console.log("Value clicked was: " + v);
                        console.log("Value clicked was NO/CANCEL:");

                    }

                    console.log("Value clicked was: " + v);
                }
            });


        })

        $(document).on('click', '.selectAll', function () {
            if ($(this).is(':checked')) {
                $('.make_complete').prop('checked', true)
            } else {
                $('.make_complete').prop('checked', false)

            }

        });

        $('#completed').click(function () {
            var selected = [];
            $('.make_complete:checked').each(function () {
                selected.push($(this).attr('value'));

            });

            $.prompt("Marked Sample(s) is/are about to be marked as Reviewed and will not appear in this list anymore!, Do you want to continue with this action?", {
                title: "SAMPLE REVIEW UPDATE",
                buttons: {"Yes, Mark as Reviewed": 1, "No, Cancel Action": false},
                focus: 1,
                submit: function (e, v, m, f) {
                    // use e.preventDefault() to prevent closing when needed or return false. 
                    // e.preventDefault(); 

                    if (v === 1) {

                        $.post(base_url + 'reviewer/setStatus', {ids: selected}, function (response) {
                            $('#requests').dataTable().fnDestroy();
                            getData();
                            alert('Operation completed Successfully!')
                        });


                    } else {
                        console.log("Value clicked was: " + v);
                        console.log("Value clicked was NO/CANCEL:");

                    }

                    console.log("Value clicked was: " + v);
                }
            });



        });


        function getData() {
            db_data = '';
            if (typeof rtable == 'undefined') {
                var rtable = $('#requests').DataTable({
                    "bJQueryUI": true,
                    "scrollX": true,
                    "order": [[0, "desc"]],
                    "aoColumns": [
                        {"sTitle": "<input type='checkbox' class='selectAll'>All", "mData": "id",
                            "mRender": function (data, type, row) {
                                return '<input type="checkbox" class="make_complete" name="ids[]" value=' + row.id + ' />';
                            }
                        },
                        {"sTitle": "Labreference", "mData": "folder"},
                        {"sTitle": "Product Name", "mData": "product_name"},
                        {"sTitle": "Download Workbook", "mData": null,
                            "mRender": function (data, type, row) {

                                return '<a class="download_workbook" href = "#Downloading-Workbook" id=' + row.folder + ' >Download Workbook</a>';

                            }
                        },
                        {"sTitle": "Upload Workbook", "mData": null,
                            "mRender": function (data, type, row) {

                                return '<a class="edited_workbook" href = "#upload_workbook" id=' + row.folder + ' data-link="' + row.folder + "/" + row.microbiology + "/" + row.test_id + '" >Upload Edited Workbook</a>';

                            }
                        },
                        {"sTitle": "Update Results", "mData": null,
                            "mRender": function (data, type, row) {

                                return '<a class="update_coa" href = "#Update_COA" id=' + row.folder + ' data-link="' + row.folder + "/" + row.microbiology + "/" + row.test_id + '" >Update COA</a>';

                            }
                        },
                        {"sTitle": "OOS Action", "mData": null,
                            "mRender": function (data, type, row) {

                                return '<a class="make_oos" href = "#OOS_Action" id=' + row.folder + ' >Mark As OOS</a>';

                            }
                        },
                        {"sTitle": "Draft COA", "mData": null,
                            "mRender": function (data, type, row) {

                                return '<a class="update_draft" href = "#draftCOA" id=' + row.folder + ' >Draft</a>';

                            }
                        },
                        {"sTitle": "Reject", "mData": null,
                            "mRender": function (data, type, row) {

                                return '<a class="reject_1" href = "#Reject" id=' + row.folder + ' >Reject</a>';

                            }
                        },
                        {"sTitle": "Draft Upload", "mData": null,
                            "mRender": function (data, type, row) {
                                if(row.invoice_status < 2){
                                    return '<label style="font-weight:light; font-size:10px; color:orange">Approve Invoice First</label>';
                                }else {
                                    return '<a class="redirect_1" href = "#Redirect" id=' + row.folder + ' >Upload</a>';
                                }
                                
                            }
                        },
						  {"sTitle": "Rreturn Reason", "mData": "reason" },
						{"sTitle": "Invoice", "mData": null,
                            "mRender": function (data, type, row) {
								if (row.invoice_status == '0') {
									return '<button class="set_components submit-button" id = ' + row.folder + '  data-client = '+row.client_id+' >Draft</button>';
								} else {
									return '<button class="show_invoice submit-button" id = ' + row.folder + ' data-client = '+row.client_id+' >Show</button>';
								}
							},
						}
                    ],
                    "bDeferRender": true,
                    "bProcessing": true,
                    "bDestroy": true,
                    "bLengthChange": true,
                    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                    "bStateSave": true,
                    "sAjaxDataProp": "",
                    "sAjaxSource": '<?php echo site_url() . "reviewer/" . $uri ?>',
                });
            }
            $("#requests").css('width', '100%');
        }

        $(document).on('click', '.make_oos', function () {
            id = $(this).attr('id');
            $.prompt("This sample is about to be marked as an OOS!, Do you want to continue with this action?", {
                title: "OOS Status",
                buttons: {"Yes, Mark as OOS": 1, "No, Cancel Action": false},
                focus: 1,
                submit: function (e, v, m, f) {
                    // use e.preventDefault() to prevent closing when needed or return false. 
                    // e.preventDefault(); 

                    if (v === 1) {

                        $.post("<?php echo base_url() . 'reviewer/make_oos/' ?>" + id, function () {
                            $("#requests").empty();

                            $('#requests').dataTable().fnDestroy();
                            getData();

                        });


                    } else {
                        console.log("Value clicked was: " + v);
                        console.log("Value clicked was NO/CANCEL:");

                    }

                    console.log("Value clicked was: " + v);
                }
            });

        });
		
		
		//On clicking create invoice, do tests-method wizard	
		 $('.set_components').live("click", function (e) {
			 
			//Get unique id
            id = $(this).attr('id');
			
			//Get Client Id
            client_id = $(this).attr('data-client');


            //Generate Quotation from Invoice
            $.ajax({
                type: 'post',
                url: "<?php echo base_url(); ?>quotation/generateQuotation/" + id + "/" + client_id,
                success: function (response) {
                console.log('sfsfsdf');

                //Pull up window to show tests
                var href = '<?php echo base_url() . "client_billing_management/showBillPerTest/" ?>INV-'+id+'-1/quotations/tests/q_request_details/q_entry/invoice/'+id;

                        //Show url at console
                        console.log(href);

                        //Open fancybox with charges breakdown                        
                        $.fancybox.open({
                            href: href,
                            type: 'iframe',
                            autoSize: false,
                            autoDimensions: false,
                            width: 1200,
                            height: 600,
                            'afterClose':function(){
                                rtable.ajax.reload();
                            }
                        })
                    },
                    error: function (error) {
                        alert('Notice: You have already posted a rejection reason for this sample!');
                        window.location.href = '<?php echo base_url(); ?>reviewer/';
                    }

                });

            return(false);
        })

		//On clicking show invoice, pull up invoice generated
		$('.show_invoice').live("click", function (e) {
            e.preventDefault();
			
            //Get unique id
            id = $(this).attr('id');

            //Get Client Id
            client_id = $(this).attr('data-client');
            console.log(client_id);

            //Show client info status, if 1 show, if 0 dont
            var showClientInfo;

            //Get href
            var href = '<?php echo base_url() . "client_billing_management/showBillPerTest/" ?>INV-'+id+'-1/quotations/tests/q_request_details/q_entry/invoice/'+id+'/'+client_id+'/'+showClientInfo;

            //Show url at console
            console.log(href);

            //Open fancybox with charges breakdown
            $.fancybox.open({
                href: href,
                type: 'iframe',
                autoSize: false,
                autoDimensions: false,
                width: 1200,
                height: 600,
                'afterClose':function(){
                    $('#requests').DataTable().ajax.reload();
                }
            });
            return(false);
        })
       



    });
</script>

<body> 
<legend><a href="<?php echo base_url(); ?>" ></a> 
    <a href="<?php echo base_url(); ?>reviewer" >Pending Samples</a>
    || <a href="<?php echo base_url(); ?>reviewer/approved_samples/" >Approved Samples</a> 
	|| <a href="<?php echo base_url(); ?>reviewer/revewerSubmissionReport/<?php  echo date('m').'/'.date('Y');?>" >Reviewed List</a>
    || <a href="<?php echo base_url(); ?>report_engine/rev_reps/<?php  echo date('m').'/'.date('Y');?>" >My Report</a>

</legend>
<hr />
<!-- Menu Start --> 

</div> 

<!-- End Menu --> 
<div>
    <input type="hidden" id="level" value="Reviewer"/>
    <input type="hidden" id="labref" />
    <input type="button" id="completed" value="Mark Selected As Reviewed" />
	
	<p style="font-weight:bold; font-size:18px; color:red;">NOTICE: ALL REVIEWERS, KINDLY ROUND OFF FINAL RESULTS TO ONE DECIMAL PLACE BEFORE SUBMITTING</p>
    <table id = "requests">
        <thead>
            <tr>
            </tr>
        </thead>
        <tbody>
            <tr> 
            </tr>
        </tbody>
        <div id="rej">
<?php $this->load->view('rejections_v'); ?>
        </div>
    </table>





</div>


</body> 
</html> 
