    <script src="<?php echo base_url() . 'bower_components/jquery/dist/jquery.js' ?>" type="text/javascript"></script>

  <script src="<?php echo base_url() . 'Scripts/jquery-ui.js' ?>" type="text/javascript"></script>
  
  
    <script>
        $(document).ready(function () {
            
            $('#address').val($('#edaddress').text());
            $('#edaddress').keyup(function(){
                $('#address').val($(this).text());
            })
          
             findaverage();
               findDis();
             
          
             
            $('.cost').on('keyup', function () {

                findaverage();
                findDis();
            });
          
               $('.remover').on('click', function () {
                $(this).closest('tr').remove();
            });

            $('#discount').on('keyup', function () {

                findDis();

            });


            $('#disc_toggle').click(function () {
                $('#dmode,#disc_row').toggle();
            });
          
            $('.clean_m').click(function () {
                $('#dmode,#discount,.help,.clean_m,#save_button,#symbols,#sup,#sub').toggle();
            });
          
             $('.help').click(function () {
                help="QUICK HELP MENU\n\
                      1. Put costs in cost column without formatting\n\
                      2. Once you have entered the cost click on the words 'PAYABLE AMOUNT' to save\n\
                      3. To show and hide 'DISCOUNT' row click the word 'COST' in cost column both to show and hide\n\
                      4. Click the the furthest right borderline of 'COST' column to delete the row\n\
                      5. For discount percentage, along the discount row at the bottom of the table, there is a symbol '%',\n\
\n\                      Type your percentage value (5, 7.5, 10 e.t.c) before the '%' symbol, if none, leave blank\n\
                      6. Rows can only be swaped for only printing purposes, will not be saved. Take the cursor and point the far left of the test\n\
                         column, click and drag the row ro position. (This should be done only once you are ready for printing, saving is disabled at this point) \n\
NOTE: To Add a new test, go to COA ENGINE add a test then refresh invoice page to load the addition.\n\
";
                       print="QUICK HELP PRINTING MENU\n\
                              \n\When Ready to print the invoice, click 'Clean for Printing' at the top right of the page\n\
\n\To remove uneccessary data from the page\n\
                           1. Press Alt or F10 to see the menu bar.\n\
                           2. Click on File, then Page Setup.\n\
                           3. Select the tab Margins & Header/Footers.\n\
                           4. Change selections to blank or your desired action.\n\
                           5. On the Format & Options tab, you can Check print background and image to print the colors."
                alert(help);
                alert(print);
            });



            $('#invoice_body tbody tr').on('focusout', function () {
                data = $(this).closest('tr').find('.cost').val();
                //alert(data)
                //new_value = data.toFixed(2);
                $(this).closest('tr').find('.cost').val(addCommas(data + '.00'));
            });

            function findDis() {
                p = parseFloat($('#discount').val() + '.00');
                tc = parseFloat($('#total_cost').val().replace(',', ''));
                amount = p / 100 * tc;
                $('input#discount_amount').val(addCommas(amount + '.00'));
                totc = tc - amount;
                $('input#amount_payable').val(addCommas(totc + '.00'));
            }
            ;



            function findaverage() {
                discount = $('#discount').val();
                var sum = 0;
                var sum1 = 0;
                var answer = 0;
                var answer1 = 0;
                var boxes = $('.cost[value!=""]').length;
                $('.cost').each(function () {
                    sum += Number($(this).val().replace(',', ''));
                    sum1 = addCommas(sum.toFixed(2));

                });
                discount_val = discount / 100 * sum;

                console.log(sum1);


                $('input#total_cost').val(sum1);
                $('input#amount_payable').val(sum1);
            }
          
          
                                    var fixHelperModified = function(e, tr) {
    var $originals = tr.children();
    var $helper = tr.clone();
    $helper.children().each(function(index) {
        $(this).width($originals.eq(index).width())
    });
    return $helper;
},
    updateIndex = function(e, ui) {
        $('#saver').prop('id','null')
    };

$("#invoice_body tbody").sortable({
    helper: fixHelperModified,
    stop: updateIndex
})



            function addCommas(nStr)
            {
                nStr += '';
                x = nStr.split('.');
                x1 = x[0];
                x2 = x.length > 1 ? '.' + x[1] : '';
                var rgx = /(\d+)(\d{3})/;
                while (rgx.test(x1)) {
                    x1 = x1.replace(rgx, '$1' + ',' + '$2');
                }
                return x1 + x2;
            }

            $('#saver,#save_button').click(function () {
                postData = $('#INVOICE').serialize();

                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('coa/saveInvoice/'.$labref); ?>" ,
                    data: postData,
                    success: function () {
                        alert('Save Successfull!')
                     // window.location.href="<?php echo site_url('coa/generatecoa_invoice2/'.$labref); ?>"
;                    },
                    error: function () {
                        alert('Error')
                        return false;
                    }

                });
            });
        });
        
        
        function setSuper() {
    try {
        if (window.ActiveXObject) {
            var c = document.selection.createRange();
            return c.htmlText;
        }
    
        var nNd = document.createElement("super");
        var w = getSelection().getRangeAt(0);
        w.surroundContents(nNd);
        return nNd.innerHTML;
    } catch (e) {
        if (window.ActiveXObject) {
            return document.selection.createRange();
        } else {
            return getSelection();
        }
    }
}

      function setSub() {
    try {
        if (window.ActiveXObject) {
            var c = document.selection.createRange();
            return c.htmlText;
        }
    
        var nNd = document.createElement("sub");
        var w = getSelection().getRangeAt(0);
        w.surroundContents(nNd);
        return nNd.innerHTML;
    } catch (e) {
        if (window.ActiveXObject) {
            return document.selection.createRange();
        } else {
            return getSelection();
        }
    }
}


$(function() {
    $('#sup').click( function() {
        var mytext = setSuper();
        $('super').css({"vertical-align":"super", "font-size":".63em" });
    });
    
    $('#sub').click( function() {
        var mytext = setSub();
        $('sub').css({"vertical-align":"sub", "font-size":".63em" });
    });
});
    </script>