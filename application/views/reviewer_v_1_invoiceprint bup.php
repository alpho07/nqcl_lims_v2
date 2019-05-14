            //Get Invoice href
            //var invoice_href = '<?php echo base_url() . "quotation/PrintInvoice/" ?>' + id + "/invoice/tests/request_details/" + client_id + "/view";
			var invoice_editable_href = '<?php echo base_url() . "coa/generateCoa_invoice2/"?>' + id + "/INVOICE";
            e.preventDefault();
            var href = '<?php echo base_url() . "tests_management/testsMethodsWizard/" ?>' + $(this).attr('id') + "/" + "request" + "/" + "tests" + "/" + "request_details" + "/" + "invoice_components" +"/"+client_id;
            console.log(href);
            $.fancybox.open({
                href: href,
                type: 'iframe',
                autoSize: false,
                autoDimensions: false,
                width: 700,
                height: 490,
				'afterClose' : function(){
					
					//Reload Datatable
					getData();
					
					//Redirect to invoice location
					window.location.href = invoice_editable_href
                }
            });