
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script type="text/javascript" src="<?php echo base_url(); ?>javascripts/dissolution.min_1.js"></script>
        <link type='text/css' href='<?php echo base_url(); ?>stylesheets/css/zebra_dialog.css' rel='stylesheet' media='screen' />
        <link rel="stylesheet" href="<?php echo base_url(); ?>stylesheets/styleassay.css" type="text/css" media="screen"/>
        <link href="<?php echo base_url(); ?>stylesheets/jquery_notification.css" type="text/css" rel="stylesheet"/>
        <script type="text/javascript" src="<?php echo base_url(); ?>javascripts/jquery_notification_v.1.js"></script>


        <style type="text/css">
            .tg-table-light { border-collapse: collapse; border-spacing: 0; }
            .tg-table-light td, .tg-table-light th { background-color: #fff; border: 1px #bbb solid; color: #333; font-family: sans-serif; font-size: 100%; padding: 0px; vertical-align: top; }
            .tg-table-light .tg-even td  { background-color: #eee; }
            .tg-table-light th  { background-color: #ddd; color: #333; font-size: 110%; font-weight: bold; }
            .tg-table-light tr:hover td, .tg-table-light tr.even:hover td  { color: #222; background-color: #FCFBE3; }
            .tg-bf { font-weight: bold; } .tg-it { font-style: italic; }
            .tg-left { text-align: left; } .tg-right { text-align: right; } .tg-center { text-align: center; }

            input[type=text]{
                text-align:center;
                margin:auto;              

            }
            input.time1{
                width: 30px;
            }

            .stage{
                width:50px;
            }
            span.workingweight12{

                margin-right: 100px;
                width: 25px

            }
            input#DM,#DM2,#workingmgml1,
            #conc,#conc_2,#dmgml1,#dmgml{
                width: 200px;
            }

            td{

                text-align:center;

            }
            td#b{
                border:thin #000;
            }


            td#x{
                text-align:right;
            }
            p{
                margin:0 auto;
            }

            table#we td, th{
                border:#000000 1px solid;
                margin:0px;	
            }
            input.areas{
                width: 150px;
            }

            p#show,#hide{
                float: left;

            }
            p#show:hover{
                text-decoration: underline;
                font-weight: bold;
                color: blue;

            }
            p#hide:hover{
                text-decoration: underline;
                font-weight: bold;
                color: blue;

            }
            .active_ingredient[type=text]{
                width: 250px;
            }
            #saveicon{
                display: none;
            }
            #multi[type=text]{
                width: 250px;
            }

            .waiting-circles{ padding: 0; display: inline-block; 
                              position: relative; width: 60px; height: 60px;}
            .waiting-circles-element{ margin: 0 2px 0 0; background-color: #e4e4e4; 
                                      border: solid 1px #f4f4f4;
                                      width: 10px; height: 10px; display: inline-block; 
                                      -moz-border-radius: 4px; -webkit-border-radius: 4px; border-radius: 4px;}
            .waiting-circles-play-0{ background-color: #9EC45F; }
            .waiting-circles-play-1{ background-color: #aEd46F; }
            .waiting-circles-play-2{ background-color: #bEe47F; }
            #Notice{
                color: red;
                font-weight: bolder;
                font-size: 12px;

            }

            form input,select,textarea {
                padding: 5px;
                border: 1px solid #d4d4d4;
                border-bottom-right-radius: 5px;
                border-top-right-radius: 4px;

                line-height: 1.5em;

                /* some box shadow sauce :D */
                box-shadow: inset 0px 2px 2px #ececec;
            }
            form input:focus {
                /* No outline on focus */
                outline: 0;
                /* a darker border ? */
                border: 1px solid #bbb;
            }

            #dissolution{
                float: left;
                margin-left: 0px;
            }
            #diss-top{
                width: 98%;   
                height: 350px;
                padding:10px;
                margin-top: 10px;




            }
            #level1{
                width: 98%;
                height:200px;

                padding: 10px;
                margin-top: 5px;;
            }
            #level2{
                width: 98%;
                height:350px;

                padding: 10px;
                margin-top: 5px;;
            }
            #diss-top,#level1,#level2,#comments{
                background: rgb(246,248,249); /* Old browsers */
                /* IE9 SVG, needs conditional override of 'filter' to 'none' */
                background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iI2Y2ZjhmOSIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjIwJSIgc3RvcC1jb2xvcj0iI2U1ZWJlZSIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiNmNWY3ZjkiIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
                background: -moz-linear-gradient(top,  rgba(246,248,249,1) 0%, rgba(229,235,238,1) 20%, rgba(245,247,249,1) 100%); /* FF3.6+ */
                background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(246,248,249,1)), color-stop(20%,rgba(229,235,238,1)), color-stop(100%,rgba(245,247,249,1))); /* Chrome,Safari4+ */
                background: -webkit-linear-gradient(top,  rgba(246,248,249,1) 0%,rgba(229,235,238,1) 20%,rgba(245,247,249,1) 100%); /* Chrome10+,Safari5.1+ */
                background: -o-linear-gradient(top,  rgba(246,248,249,1) 0%,rgba(229,235,238,1) 20%,rgba(245,247,249,1) 100%); /* Opera 11.10+ */
                background: -ms-linear-gradient(top,  rgba(246,248,249,1) 0%,rgba(229,235,238,1) 20%,rgba(245,247,249,1) 100%); /* IE10+ */
                background: linear-gradient(to bottom,  rgba(246,248,249,1) 0%,rgba(229,235,238,1) 20%,rgba(245,247,249,1) 100%); /* W3C */
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f6f8f9', endColorstr='#f5f7f9',GradientType=0 ); /* IE6-8 */
                -webkit-border-radius: 5px;
                -moz-border-radius: 5px;
                border-radius: 5px;
                border: 1px solid black;
                box-shadow: 3px;
            }
            #tablets tr td{
                border: 1px solid black;
            }
            .dissolution-class[type=text],#tcmean,#tcreading{
                width:100px;
            }
            .dissolution-class1, .dissolution-class2[type=text]{
                width:105px;
            }
            #dissolutio{
                width: 200px;
                height:280px;
                margin-left: 700px;
                position:absolute;
                padding: 10px;
                border: 1px solid black;
            }
            #dissolutio1{
                width: 200px;
                height:280px;
                margin-left: 400px;
                position:absolute;
                padding: 10px;
                border: 1px solid black;
            }
            #di{
                margin-left: 700px;  
            }
            label{
                display: block;
                margin: 5px;
            }
            #comments{
                width: 99.5%;
                height:200px;
                margin-top: 5px;
            }

            .refsub{
                width:150px;
                height: 250px;
                background: rgb(180,221,180); /* Old browsers */
                background: -moz-linear-gradient(top,  rgba(180,221,180,1) 0%, rgba(131,199,131,1) 10%, rgba(82,177,82,1) 24%, rgba(0,138,0,1) 100%, rgba(0,87,0,1) 100%, rgba(0,36,0,1) 100%); /* FF3.6+ */
                background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(180,221,180,1)), color-stop(10%,rgba(131,199,131,1)), color-stop(24%,rgba(82,177,82,1)), color-stop(100%,rgba(0,138,0,1)), color-stop(100%,rgba(0,87,0,1)), color-stop(100%,rgba(0,36,0,1))); /* Chrome,Safari4+ */
                background: -webkit-linear-gradient(top,  rgba(180,221,180,1) 0%,rgba(131,199,131,1) 10%,rgba(82,177,82,1) 24%,rgba(0,138,0,1) 100%,rgba(0,87,0,1) 100%,rgba(0,36,0,1) 100%); /* Chrome10+,Safari5.1+ */
                background: -o-linear-gradient(top,  rgba(180,221,180,1) 0%,rgba(131,199,131,1) 10%,rgba(82,177,82,1) 24%,rgba(0,138,0,1) 100%,rgba(0,87,0,1) 100%,rgba(0,36,0,1) 100%); /* Opera 11.10+ */
                background: -ms-linear-gradient(top,  rgba(180,221,180,1) 0%,rgba(131,199,131,1) 10%,rgba(82,177,82,1) 24%,rgba(0,138,0,1) 100%,rgba(0,87,0,1) 100%,rgba(0,36,0,1) 100%); /* IE10+ */
                background: linear-gradient(to bottom,  rgba(180,221,180,1) 0%,rgba(131,199,131,1) 10%,rgba(82,177,82,1) 24%,rgba(0,138,0,1) 100%,rgba(0,87,0,1) 100%,rgba(0,36,0,1) 100%); /* W3C */
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#b4ddb4', endColorstr='#002400',GradientType=0 ); /* IE6-9 */


                position: absolute;
                -moz-border-radius: 5px;
                -webkit-border-radius: 5px;
                border-radius: 5px;
                box-shadow: 5px;
                padding: 5px;
                z-index: 10px;
                color:white;
                margin: 3px;
                font-weight: bolder;

            }
            .refsub input{
                width:100px;
            }
            .rf{
                display:block;
            }

            input.dissdata{
                width:60px;
            }

            table.toptable
            {
                border-width: 0 0 1px 1px;
                border-spacing: 0;
                border-collapse: collapse;
                border-style: solid;
                margin-left: 10px;
                -moz-border-radius: 5px;
                -webkit-border-radius: 5px;
                border-radius: 5px;
            }
            /*            #top-table-right{
                            margin-left: 700px;
                            position: absolute;
                            top:115px;
                        }*/

            table.toptable td
            {
                margin: 0;
                padding: 4px;
                border-width: 1px 1px 0 0;
                border-style: solid;
            }
            .toptable tr:hover {
                background-color: lightyellow;
            }

            .tg  {border-collapse:collapse;border-spacing:0;border-color:#aaa;}
            .tg td{font-family:Arial, sans-serif;font-size:14px;padding:4px 2px;border-style:solid;border-width:1px;border-color:#aaa;color:#333;background-color:#fff;}
            .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;border-color:#aaa;color:black;}
            .tg .tg-z2zr{background-color:#FCFBE3}

            #assay{
                margin-left: 10px;
            }

            #overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: #000;
                filter:alpha(opacity=50);
                -moz-opacity:0.5;
                -khtml-opacity: 0.5;
                opacity: 0.5;
                z-index: 10000;
            }

        </style>
        <script type="text/javascript">
           var URL= "<?php echo base_url(); ?>dissolution/save_dissolution_data/<?php echo $labref . '/' . $test_id; ?>"; 
            $(document).ready(function () {
    
     
     $('#addLAB').hide();

     
     $('#processor').change(function(){
         action = $(this).val();
         if(action ==='2'){
             $('#addLAB').show(); 
           URL= "<?php echo base_url(); ?>dissolution/save_dissolution_data_batch/<?php echo $labref . '/' . $test_id; ?>"; 
        }else{
         $('#addLAB').hide(); 
           URL= "<?php echo base_url(); ?>dissolution/save_dissolution_data/<?php echo $labref . '/' . $test_id; ?>"; 
             
         }
     });
     })


            $('input').live("keypress", function (e) {
                /* ENTER PRESSED*/
                if (e.keyCode === 13 || e.keyCode === 40) {
                    /* FOCUS ELEMENT */
                    var inputs = $(this).parents("form").eq(0).find(":input:visible:not(disabled):not([readonly])");
                    var idx = inputs.index(this);

                    if (idx === inputs.length - 1) {
                        inputs[0].select();
                    } else {
                        inputs[idx + 1].focus(); //  handles submit buttons
                        inputs[idx + 1].select();
                    }
                    return false;
                }
            });

            showNotification({
                type: "information",
                message: "Hi! Dissolution Area!.",
                autoClose: true,
                duration: 2
            });

            function prompt_dialog() {
                $("#dialog").lightbox_me({
                    closeClick: false,
                    centered: true
                });
            }

            $(document).ready(function () {
                $("#mwconv").click(function () {
                    if ($(this).is(":checked", true)) {
                        window.location.href = "<?php echo base_url() . 'dissolution/worksheet_c/' . $labref . '/' . $test_id . '/'; ?>";



                    }
                });

                $('#o-container').hide();
                var overlay = jQuery('<div id="overlay"> </div>');
                // overlay.appendTo('#o-container');

                $('form').dumbFormState('remove');
                $('.area1,.area2,.area3,.area4,.area5,.area6,.tar1,.tar2,.tar3,.tar4,.tar5,.area6,.tar6').hide();
                /* $('#R2').change(function(){
                 
                 i=$(this).val();                    
                 var labelclaim=parseFloat($('#labelclaim').val());       
                 
                 var lv =((labelclaim/i));
                 
                 alert(lv)
                 
                 $('#conc').val(lv.toFixed(6)); 
                 $('#workingmgml1').val(lv.toFixed(6)); 
                 // alert(1);
                 //calculate1();
                 });*/
//               $('form').dumbFormState({
//                    persistPasswords: false, // default is false, recommended to NOT do this
//                    persistLocal: true, // default is false, persists in sessionStorage or to localStorage
//                    skipSelector: null, // takes jQuery selector of items you DO NOT want to persist 
//                    autoPersist: true // true by default, false will only persist on form submit
//                });
                $('#waiting4').waiting({
                    className: 'waiting-circles',
                    elements: 8,
                    radius: 20,
                    auto: true
                });
            });

            function generate(type) {

                var today = new Date();
                var cHour = today.getHours();
                var cMin = today.getMinutes();
                var cSec = today.getSeconds();
                var time = cHour + ":" + cMin + ":" + cSec;

                var d = new Date();

                var month = d.getMonth() + 1;
                var day = d.getDate();

                var output = (('' + day).length < 2 ? '0' : '') + day + '/' +
                        (('' + month).length < 2 ? '0' : '') + month + '/' +
                        d.getFullYear();
                var n = noty({
                    text: type,
                    type: type,
                    dismissQueue: true,
                    layout: 'topCenter',
                    theme: 'defaultTheme',
                    timeout: 5000,
                    text:'Work Autosaved Temporarily: ' + output + '\t' + time
                });
                console.log('html: ' + n.options.id);
            }

            function generateAll() {

                generate('information');

            }

            $(document).ready(function () {



                $('#second,#third,#fourth,#fifth').prop('disabled', true);
                first = $('#first').val();
                second = $('#second').val();
                third = $('#third').val();
                fourth = $('#fourth').val();
                fifth = $('#fifth').val();

                $('#first').keyup(function () {
                    if ($(this).val() > 0) {
                        $('#second').prop('disabled', false);
                    } else {
                        //$(this).prop('disabled',true);
                        $('#second').prop('disabled', true);
                    }

                });

                $('#second').keyup(function () {
                    if ($(this).val() > 0) {
                        $('#third').prop('disabled', false);
                    } else {
                        $(this).prop('disabled', true);
                        $('#third').prop('disabled', true);
                    }

                });

                $('#third').keyup(function () {
                    if ($(this).val() > 0) {
                        $('#fourth').prop('disabled', false);
                    } else {
                        $(this).prop('disabled', true);
                        $('#fourth').prop('disabled', true);
                    }

                    $('#fourth').keyup(function () {
                        if ($(this).val() > 0) {
                            $('#fifth').prop('disabled', false);
                        } else {
                            $('#fifth').prop('disabled', true);
                            $(this).prop('disabled', true);
                        }

                    });

                });

                //  setInterval(generateAll, 20000);

                $('#activeIngredient').change(function () {
                    substance = $(this).val();
                    $.ajax({
                        type: "GET",
                        url: "<?php echo base_url(); ?>assay/refsubs/" + substance,
                        dataType: "json",
                        success: function (data) {
                            $('#code').empty();
                            $('#aqty').val('');
                            $('#potency').val('');
                            $('#codein').val();

                            $.each(data, function (id, substance) {
                                $('#code').text(substance.rs_code);
                                $('#unit').val(substance.init_mass_unit);
                                $('#codein').val(substance.rs_code);
                                $('#aqty').val(substance.init_mass + substance.init_mass_unit);
                                pot = parseFloat(substance.potency);
                                $('#potency').val(pot + substance.potency_unit);
                            });
                            $('.dissolution-class1,.time1,.time1-2').val('');
                            $('.area1,.area2,.area3,.area4,.area5,.tar1,.tar2,.tar3,.tar4,.tar5').hide();
                        },
                        error: function (data) {
                        }
                    });

                });

                $('#activeIngredient').change(function () {
                    var select = $(this).val();
                    $('#Export').prop('value', 'Save ' + select);
                    if (select == "") {
                        $('#o-container').hide();
                    } else {
                        $('#o-container').show();
                    }
                    $.ajax({
                        type: "GET",
                        url: "<?php echo base_url(); ?>assay/loadComponents_lc/<?php echo $labref; ?>/" + select,
                        dataType: "json",
                        success: function (data) {
                            $('#labelclaim').val(data[0].volume2);
                            $('#labelclaim1').val(data[0].volume2);
                            // calculate();
                        },
                        error: function () {

                        }
                    });
                });
                $('#labreference').change(function () {
                    var select = $(this).val();
                    component_holder = $('#component');

                    $.ajax({
                        type: "GET",
                        url: "<?php echo base_url(); ?>assay/loadAssayComponents/" + select,
                        dataType: "json",
                        success: function (data) {
                            component_holder.empty();
                            component_holder.append('<option value="">Select Component</option>');
                            $.each(data, function (i, component) {
                                component_holder.append('<option value="' + component.component + '">' + component.component + '</option>');
                            });
                        },
                        error: function () {

                        }
                    });
                });

                $('#component').change(function () {
                    var labref = $('#labreference').val();
                    var component = $(this).val();
                    run_holder = $('#run');

                    $.ajax({
                        type: "GET",
                        url: "<?php echo base_url(); ?>assay/loadAssayComponentRuns/" + labref + '/' + component,
                        dataType: "json",
                        success: function (data) {
                            run_holder.empty();
                            run_holder.append('<option value="">Select run</option>');
                            $.each(data, function (i, run) {
                                run_holder.append('<option value="' + run.repeat_status + '">' + run.repeat_status + '</option>');
                            });
                        },
                        error: function () {

                        }
                    });
                });

                $('#cleardata').click(function () {
                    $('.dissclear').val("");

                });


                $('#component,#labreference,#run').change(function () {
                    var labref = $('#labreference').val();
                    var component = $('#component').val();
                    var run = $('#run').val();

                    $.ajax({
                        type: "GET",
                        url: "<?php echo base_url(); ?>assay/loadAssayComponentData/" + labref + '/' + component + '/' + run,
                        dataType: "json",
                        success: function (data) {
                            /*$('#workingnumber').val(data[0].desired_weight);
                             $('#workingvf1').val(data[0].vf1);
                             $('#workingp1').val(data[0].pippette1);
                             $('#workingvf2').val(data[0].vf2);
                             $('#workingp2').val(data[0].pipette2);
                             $('#workingvf3').val(data[0].vf3);
                             $('#workingp3').val(data[0].pipette3);
                             $('#workingvf4').val(data[0].vf4);
                             $('#workingmgml').val(data[0].concetration);
                             $('#smgml').val(data[0].concetration);*/

                            $.getJSON("<?php echo base_url(); ?>assay/loadAssayComponentStdAB/" + labref + '/' + component + '/' + run, function (data) {
                                $('#number').val(data[0].weight);
                                /* $('#vf1').val(data[0].vf1);
                                 $('#p1').val(data[0].pippette1);
                                 $('#vf2').val(data[0].vf2);
                                 $('#p2').val(data[0].pipette2);
                                 $('#vf31').val(data[0].vf3);
                                 $('#p321').val(data[0].pipette3);
                                 $('#vf32').val(data[0].vf4);
                                 $('#mgml').val(data[0].concetration);*/


                                $('#number1').val(data[1].weight);
                                /* $('#vf11').val(data[1].vf1);
                                 $('#p11').val(data[1].pippette1);
                                 $('#vf22').val(data[1].vf2);
                                 $('#ppt1').val(data[1].pipette2);
                                 $('#vf33').val(data[1].vf3);
                                 $('#ppt2').val(data[1].pipette3);
                                 $('#vf34').val(data[1].vf4);
                                 $('#mgml1').val(data[1].concetration);*/


                            });
                        },
                        error: function () {

                        }
                    });
                });




            });


            $(document).ready(function () {
                $('.Wrksh').click(function () {
                    labref = $(this).attr('id');
                    $('#the_labref').val(labref);
                    $.fancybox({
                        href: "#tests"
                    })
                })

                loadComponents();
                $('#Export,#Export_r').hide();
//                $(function() {
//                    $("#dialog-confirm").dialog({
//                        resizable: false,
//                        height: 200,
//                        width: 300,
//                        modal: true,
//                        buttons: {
//                            "Yes": function() {
//                                $(this).dialog("close");
//                            },
//                            "No": function() {
//                                $('#repeat,#rep').hide();
//                                $(':input,#dissForm').not(':button,:submit,:reset,:hidden').val("");
//                                loadFreshComponents();
//                                $(this).dialog("close");
//                            }
//                        }
//                    });
//                });


                $("#workingvf1,#workingp11,#workingvf2,#workingp12,#workingvf3,#workingp13,#workingvf4").change('live', function ()
                {

                    var a1 = ($('#workingvf1').val());
                    var b1 = ($('#workingp11').val());
                    var c1 = ($('#workingvf2').val());
                    var d1 = ($('#workingp12').val());
                    var e1 = ($('#workingvf3').val());
                    var f1 = ($('#workingp13').val());
                    var g1 = ($('#workingvf4').val());



                    $('#v11').val(a1);
                    $('#v2').val(a1);


                    $('#standardp1').val(b1);
                    $('#standardp2').val(b1);

                    $('#standardvf').val(c1);
                    $('#standardvf1').val(c1);

                    $('#p20').val(d1);
                    $('#p21').val(d1);

                    $('#vf3').val(e1);
                    $('#vf23').val(e1);

                    $('#p211').val(f1);
                    $('#p22').val(f1);

                    $('#vf4').val(g1);
                    $('#vf24').val(g1);
                });




$('#sendit').click(function () {
var data = $('#reason').serialize();
$.ajax({
type: 'post',
url: '<?php echo base_url() . 'dissolution/postRepeatReason/' . $labref; ?>',
data: data,
success: function (data) {
// alert('Reason Successfully Saved, Saving Data.....');
$('#saveicon').show();
dataString2 = $('#dissForm').serialize();

$.ajax({
type: "POST",
url:URL,
                        data: dataString2,
                        success: function () {
                            showNotification({
                                message: "The data has been successfully saved! ",
                                type: "success",
                                autoClose: true,
                                duration: 5
                            });
                            $('#Export').show();
                            //  $('#Export').prop('disabled', true);
                            $('#Export_r').show();
                            $('#Export_r').prop('disabled', true);
                            $('#finish').hide();
                            $('#saveicon').hide();
                            // $('#addassay').show();
                           window.location.href = "<?php echo base_url(); ?>analyst_controller";
                        },
                        error: function () {
                            showNotification({
                                message: "Oops! an error occurred.",
                                type: "error",
                                autoClose: true,
                                duration: 5
                            });
                        }
                    });
                },
                error: function () {

                }


            })

            $('#dialog').trigger('close');
        });

        $('#cancelit').click(function () {
            window.location.href = "<?php echo base_url() . 'analyst_controller'; ?>";
        });

        $('#closeit').click(function () {
            $('#Export').prop('value', 'Save ' + $('#activeIngredient').val());
            $('#Export').prop('disabled', false);
            $('#dialog').trigger('close');
        });


        $('#addassay').hide();
        $('#finish').hide()
        $('#Export').click(function () {


            var bad = 0;
            $('.dissolution-class1:visible').each(function ()
            {
                if ($.trim(this.value) === "" || $.trim(this.value) === "NaN")
                    bad++;
            });
            $('.areas').each(function ()
            {
                if ($.trim(this.value) === "" || $.trim(this.value) === "NaN")
                    bad++;
            });
            $('.dissdata:visible').each(function ()
            {
                if ($.trim(this.value) === "" || $.trim(this.value) === "NaN")
                    bad++;
            });
            $('.dissclear:enabled').each(function ()
            {
                if ($.trim(this.value) === "" || $.trim(this.value) === "NaN")
                    bad++;
            });
            if (bad > 0) {
                $.prompt(bad + ' value(s) are missing, ensure all fields are filled and that deviations have been calculated if they\n\
have not been calculated');
            } else {
                // $(this).prop('disabled',true);
                $('#Export_r').hide();
                $('#finish').hide();
                $(this).hide();

                substance = $('#activeIngredient').val();
                $.ajax({
                    type: "GET",
                    url: "<?php echo base_url(); ?>dissolution/check_done/<?php echo $labref; ?>/" + substance,
                    dataType: "json",
                    success: function (data) {
                        if (data.done_state === 1) {
                            prompt_dialog();

                        } else {
                            $('#saveicon').show();
                            dataString2 = $('#dissForm').serialize();

                            $.ajax({
                                type: "POST",
                                url: URL,
                                                                data: dataString2,
                                                                success: function () {
                                                                    showNotification({
                                                                        message: "The data has been successfully saved! ",
                                                                        type: "success",
                                                                        autoClose: true,
                                                                        duration: 5
                                                                    });
                                                                    $('#Export').show();
                                                                    $('#Export').prop('disabled', true);
                                                                    $('#Export_r').show();
                                                                    $('#Export_r').prop('disabled', true);
                                                                    $('#finish').hide();
                                                                    $('#saveicon').hide();
                                                                    // $('#addassay').show();
                                                                },
                                                                error: function () {
                                                                    showNotification({
                                                                        message: "Oops! an error occurred.",
                                                                        type: "error",
                                                                        autoClose: true,
                                                                        duration: 5
                                                                    });
                                                                }
                                                            });


                                                        }
                                                    }, error: function (data) {
                                                        console.log(data);
                                                    }

                                                });
                                            }

                                        });

                                        function loadFreshComponents() {
                                            var select = $('#activeIngredient').empty();
                                            $.ajax({
                                                type: "GET",
                                                url: "<?php echo base_url(); ?>dissolution/loadFreshComponents/<?php echo $labref; ?>",
                                                                dataType: "json",
                                                                success: function (data) {
                                                                    select.append("<option value=" + ">Select A.Ingr</option>");
                                                                    $.each(data, function (i, r) {
                                                                        var opt = (r.name);
                                                                        select.append("<option value=" + opt + ">" + opt + "</option>");
                                                                    });
                                                                },
                                                                error: function () {

                                                                }
                                                            });

                                                        }


                                                        function loadComponents() {
                                                            var select = $('#activeIngredient').empty();
                                                            $.ajax({
                                                                type: "GET",
                                                                url: "<?php echo base_url(); ?>dissolution/loadComponents/<?php echo $labref; ?>",
                                                                                dataType: "json",
                                                                                success: function (data) {
                                                                                    select.append("<option value=" + ">Select A.Ingr</option>");
                                                                                    $.each(data, function (i, r) {
                                                                                        var opt = (r.name);
                                                                                        select.append("<option value=" + opt + ">" + opt + "</option>");
                                                                                    });
                                                                                },
                                                                                error: function () {

                                                                                }
                                                                            });

                                                                        }
                                                                        $('#activeIngredient').change(function () {
                                                                            component = $('#activeIngredient').val();
                                                                            var select = $('#repeat').empty();

                                                                            $.ajax({
                                                                                type: "GET",
                                                                                url: "<?php echo base_url(); ?>dissolution/getdata/<?php echo $labref; ?>/" + component,
                                                                                dataType: "json",
                                                                                success: function (data) {
                                                                                    // select.append("<option value=" + ">Select No.</option>");
                                                                                    $.each(data, function (i, r) {
                                                                                        var opt = (r.repeat_status);
                                                                                        select.append("<option value=" + opt + ">" + opt + "</option>");
                                                                                    });
                                                                                    $('#Notice').css('display', 'none');
                                                                                    $('#Export,#Export_r').show();
                                                                                    $('#Export,#Export_r').prop('disabled', false);
                                                                                    $('#Export').prop('value', 'Save ' + $('#activeIngredient option:selected').text());
                                                                                    $('#Export_r').prop('value', 'Save ' + $('#activeIngredient option:selected').text() + ' & Repeat');
                                                                                },
                                                                                error: function () {

                                                                                }
                                                                            });
                                                                        });

                                                                        $('#activeIngredient,#repeat').change(function () {
                                                                            component = $('#activeIngredient').val();

                                                                            $.ajax({
                                                                                type: "GET",
                                                                                url: "<?php echo base_url(); ?>dissolution/getAB/<?php echo $labref; ?>/" + component + "/" + repeat,
                                                                                dataType: "json",
                                                                                success: function (data) {

                                                                                    repeat = '1';
                                                                                    $.ajax({
                                                                                        type: "GET",
                                                                                        url: "<?php echo base_url(); ?>dissolution/getAB/<?php echo $labref; ?>/" + component + "/" + repeat,
                                                                                        dataType: "json",
                                                                                        success: function (data) {
                                                                                            $('#number').val(data[0].weight);
                                                                                            $('#number1').val(data[1].weight);

                                                                                            $('#v11').val(data[0].vf1);
                                                                                            $('#v2').val(data[1].vf1);

                                                                                            $('#standardp1').val(data[0].pippette1);
                                                                                            $('#standardp2').val(data[1].pippette1);

                                                                                            $('#standardvf').val(data[0].vf2);
                                                                                            $('#standardvf1').val(data[1].vf2);

                                                                                            $('#p20').val(data[0].pipette2);
                                                                                            $('#p21').val(data[1].pipette2);

                                                                                            $('#vf3').val(data[0].vf3);
                                                                                            $('#vf23').val(data[1].vf3);

                                                                                            $('#p211').val(data[0].pipette3);
                                                                                            $('#p22').val(data[1].pipette3);

                                                                                            $('#vf4').val(data[0].vf4);
                                                                                            $('#vf24').val(data[1].vf4);

                                                                                            $('#dmgml').val(data[0].concetration);
                                                                                            $('#dmgml1').val(data[1].concetration);


                                                                                            $.ajax({
                                                                                                type: "GET",
                                                                                                url: "<?php echo base_url(); ?>dissolution/get_SAB/<?php echo $labref; ?>/" + component + "/" + repeat,
                                                                                                dataType: "json",
                                                                                                success: function (area) {
                                                                                                    $('#speaka1').val(area[0].peak_area);
                                                                                                    $('#speaka2').val(area[1].peak_area);
                                                                                                    $('#speaka3').val(area[2].peak_area);
                                                                                                    $('#speakb1').val(area[3].peak_area);
                                                                                                    $('#speakb2').val(area[4].peak_area);
                                                                                                    $('#speakb3').val(area[5].peak_area);

                                                                                                }, error: function (e) {
                                                                                                    console.log(e);
                                                                                                }
                                                                                            });


                                                                                            $.ajax({
                                                                                                type: "GET",
                                                                                                url: "<?php echo base_url(); ?>assay/loadComponents_lc/<?php echo $labref; ?>/" + component,
                                                                                                dataType: "json",
                                                                                                success: function (data) {
                                                                                                    $('#labelclaim').val(data[0].volume2);
                                                                                                    // calculate();
                                                                                                },
                                                                                                error: function () {

                                                                                                }
                                                                                            });


                                                                                        },
                                                                                        error: function () {

                                                                                        }
                                                                                    });
//                    
//                });
                                                                                },
                                                                                error: function () {

                                                                                }
                                                                            });



                                                                        });



                                                                    });

                                                                    $(document).ready(function ()
                                                                    {

                                                                        $('#first').keyup(function () {
                                                                            first = $(this).val();
                                                                            if (first > 0) {
                                                                                $('#area-111').val(first);
                                                                                $('.area1,.tar1').show();
                                                                            } else {
                                                                                $('#area-111').val(first);
                                                                                $('.area1,.tar1').hide();
                                                                            }
                                                                        });

                                                                        $('#second').keyup(function () {
                                                                            first = $(this).val();

                                                                            if (first > 0) {
                                                                                $('#area-121').val(first);

                                                                                $('.area1,.area2,.tar1,.tar2').show();
                                                                                $('.area1,.area2,.tar1,.tar2').show();
                                                                            } else {
                                                                                $('#area-111').val(first);
                                                                                $('.area1,.area2,.tar1,.tar2').hide();
                                                                                $('.area1,.area2,.tar1,.tar2').hide();
                                                                                $('.area1,.tar1').show();
                                                                                $('#area-111').val($('#first').val());
                                                                            }

                                                                        });

                                                                        $('#third').keyup(function () {
                                                                            first = $(this).val();

                                                                            if (first > 0) {
                                                                                $('#area-131').val(first);
                                                                                $('.area1,.area2,.area3,.tar1,.tar2,.tar3').show();

                                                                            } else {
                                                                                $('#area-111').val(first);
                                                                                $('.area1,.area2,.area3,.tar1,.tar2,.tar3').hide();
                                                                                $('.area1,.area2,.tar1,.tar2').show();
                                                                                $('#area-111').val($('#first').val());
                                                                                $('#area-121').val($('#second').val());
                                                                            }


                                                                        });

                                                                        $('#fourth').keyup(function () {
                                                                            first = $(this).val();

                                                                            if (first > 0) {
                                                                                $('#area-141').val(first);
                                                                                $('.area1,.area2,.area3,.area4,.tar1,.tar2,.tar3,.tar4').show();

                                                                            } else {
                                                                                $('#area-111').val(first);
                                                                                $('.area1,.area2,.area3,.area4,.tar1,.tar2,.tar3,.tar4').hide();
                                                                                $('.area1,.area2,.area3,.tar1,.tar2,.tar3').show();
                                                                                $('#area-111').val($('#first').val());
                                                                                $('#area-121').val($('#third').val());
                                                                                $('#area-131').val($('#third').val());
                                                                            }


                                                                        });

                                                                        $('#fifth').keyup(function () {
                                                                            first = $(this).val();

                                                                            if (first > 0) {
                                                                                $('#area-151').val(first);
                                                                                $('.area1,.area2,.area3,.area4,.area5,.tar1,.tar2,.tar3,.tar4,.tar5').show();

                                                                            } else {
                                                                                $('#area-111').val(first);
                                                                                $('.area1,.area2,.area3,.area4,.area5,.tar1,.tar2,.tar3,.tar4,.tar5').hide();
                                                                                $('.area1,.area2,.area3,.area4,.tar1,.tar2,.tar3,.tar4').show();
                                                                                $('#area-111').val($('#first').val());
                                                                                $('#area-121').val($('#second').val());
                                                                                $('#area-131').val($('#third').val());
                                                                                $('#area-141').val($('#fourth').val());
                                                                            }

                                                                        });




                                                                        $("#workingvf1,#workingp11,#workingvf2,#number,#number1,#workingp12,#workingvf3").live('change', function () {
                                                                            var answer = 0;
                                                                            var answer2 = 0;
                                                                            var weighta = parseFloat($('#number').val());
                                                                            var weightb = parseFloat($('#number1').val());


                                                                            var a = parseFloat($('#v11').val());
                                                                            var b = parseFloat($('#standardp1').val());
                                                                            var c = parseFloat($('#standardvf').val());
                                                                            var d = parseFloat($('#p20').val());
                                                                            var e = parseFloat($('#vf3').val());
                                                                            var f = parseFloat($('#p211').val());
                                                                            var g = parseFloat($('#vf4').val());

                                                                            answer = ((weighta / a) * (b / c) * (d / e) * (f / g));

                                                                            var v2 = parseFloat($('#v2').val());
                                                                            var p2 = parseFloat($('#standardp2').val());
                                                                            var vf2 = parseFloat($('#standardvf1').val());
                                                                            var p21 = parseFloat($('#p21').val());
                                                                            var vf23 = parseFloat($('#vf23').val());
                                                                            var p22 = parseFloat($('#p22').val());
                                                                            var vf24 = parseFloat($('#vf24').val());

                                                                            answer2 = ((weightb / v2) * (p2 / vf2) * (p21 / vf23) * (p22 / vf24));



                                                                            $('#dmgml').val(answer.toFixed(6));
                                                                            $('#dmgml1').val(answer2.toFixed(6));
                                                                            // $('#mgml').val(answer.toFixed(2));


                                                                        });




                                                                    });
                                                                    $(document).ready(function () {
                                                                        $('#addassay').click(function () {
                                                                            $('input[type=number],input[type=text],#workingvf1,#workingp11,#workingvf2,#number,#number1,#workingp12,#workingvf3').each(function () {
                                                                                $(this).val('');
                                                                            });
                                                                            $(this).hide();
                                                                            $('#Export').show();
                                                                            $('#finish').show();
                                                                            // $('form').dumbFormState('remove');
                                                                        });

                                                                        $('#finish').click(function () {
                                                                            window.location.href = '<?php echo base_url() ?>analyst_controller';
                                                                        });


                                                                    });

                                                                    $(document).ready(function () {
                                                                        $("#disstage").attr("disabled", "disabled");
                                                                        $("#disstage").hide();
                                                                        $("#l1").hide();
                                                                        $("#multi").click(function () {
                                                                            if ($("#multi").is(":checked", true)) {
                                                                                $("#disstage").attr("disabled", false);
                                                                                $("#disstage").show();
                                                                                $("#l1").show();

                                                                            } else {
                                                                                $("#disstage").attr("disabled", "disabled");
                                                                                $("#disstage").hide();
                                                                                $("#l1").hide();

                                                                            }
                                                                        });
                                                                        var counter = 1;
                                                                        var stage1 = 'ACID';
                                                                        var stage2 = 'BUFFER';

                                                                        $('#disstage').val(stage1);

                                                                        $(' #addassay').click(function () {
                                                                            $('input.stage,input.dissolution-class').each(function () {
                                                                                $(this).val('');
                                                                            });
                                                                            counter++;
                                                                            if (counter == 2) {
                                                                                $('#disstage').val(stage2);
                                                                            } else {
                                                                                counter = 1;
                                                                                $('#disstage').val(stage1);
                                                                            }
                                                                        });
                                                                        $('.activeIngredient').hide();
                                                                    });



                                                                    $(document).ready(function () {
                                                                        //SAVE AND REPEAT==================================================================================== 
                                                                        $('#Export_r').click(function () {
                                                                            $(this).hide();
                                                                            $('#Export').hide();
                                                                            $('#finish').hide();
                                                                            $('#saveicon').show();
                                                                            dataString2 = $('#dissForm').serialize();
                                                                            $.ajax({
                                                                                type: "POST",
                                                                                url:URL,
                                                                                                data: dataString2,
                                                                                                success: function () {
                                                                                                    showNotification({
                                                                                                        message: "The data has been successfully saved! ",
                                                                                                        type: "success",
                                                                                                        autoClose: true,
                                                                                                        duration: 5
                                                                                                    });
                                                                                                    loadRepeatComponents();
                                                                                                    $('#Export').hide();
                                                                                                    $('#finish').show();
                                                                                                    $('#saveicon').hide();
                                                                                                    $('#rep,#repeat').hide();
                                                                                                    $('#Export_r').show();
                                                                                                    //$('#addassay').show();
                                                                                                },
                                                                                                error: function () {
                                                                                                    showNotification({
                                                                                                        message: "Oops! an error occurred.",
                                                                                                        type: "error",
                                                                                                        autoClose: true,
                                                                                                        duration: 5
                                                                                                    });
                                                                                                }
                                                                                            });

                                                                                        });

                                                                                        function loadRepeatComponents() {
                                                                                            var select = $('#activeIngredient').empty();
                                                                                            $.ajax({
                                                                                                type: "GET",
                                                                                                url: "<?php echo base_url(); ?>dissolution/loadRepeatComponents/<?php echo $labref; ?>",
                                                                                                                dataType: "json",
                                                                                                                success: function (data) {

                                                                                                                    $.each(data, function (i, r) {
                                                                                                                        var opt = (r.name);
                                                                                                                        select.append("<option value=" + opt + ">" + opt + "</option>")
                                                                                                                    });
                                                                                                                },
                                                                                                                error: function () {

                                                                                                                }
                                                                                                            });

                                                                                                        }

                                                                                                        //========================================================================================================  








                                                                                                    });
//            $('#vu,#R2,#labelclaim').keyup('change',function(){
//            calculate();
//            });




        </script>
        <?php
        $ci = & get_instance();
        $labrefs = $ci->loadLabrefBatch();
        ?>
    </head>

    <body>
        <p></p>
        <p></p>
        <p></p>

        <p></p>
        <?php
        foreach ($assayweight as $weight)
            ;
        ?>     


        <!--DISSOLUTION CONDITIONS -->
        <?php $attributes = array('id' => 'dissForm'); ?>
        <?php echo form_open('dissolution/save_dissolution_data/' . $labref, $attributes); ?>       
        <p><strong><?php echo anchor('analyst_controller', '<< Home'); ?></strong></p>



        <center> 
<!--            M.W Conversion Required<input type="checkbox" name="mwconv" id="mwconv">-->

            <table>
                <tr>
                    <td>
                        <label>Component Name:</label> 
                        <select name="heading" id="activeIngredient" > 
                            <option value="">-Select A.Ingr-</option>
                        </select>
                    </td>
                    <td>
                        <label>Run No:</label>
                        <select name="repeat" id="repeat" value="1" >               
                        </select>
                    </td>
                    <td>
                        <span class='activeIngredient'><a href="<?php echo base_url() . 'assay/worksheet/' . $labref . '/2' ?>">No, I don't want a Repeat!</a></span> 
                    </td>
                </tr>
            </table>
        </center>
        <p>

            <table style="position: absolute; margin-left: 800px; margin-top: 30px;" id="batch_table">
                <thead>
                    <tr>
                        <th colspan="2">
                            <select name="processor" id="processor">
                                <option value="1">Single Processing</option>
                                <option value="2">Batch Processing</option>
                            </select>
                        </th>
                        <tr>
                            <th>Request ID#</th>
                            <th><a href="#addLAB" id="addLAB">+Add</a></th>
                        </tr>                    
                </thead>
                <tbody>

                    <tr>
                        <td>
                            <select name="labref[]" id="processor" class="select2">
                                <option value="<?php echo $labref; ?>"><?php echo $labref; ?></option>                              
                            </select>
                        </td>
                        <td>(Default)</td>
                    </tr>
                </tbody>
            </table>     

        </p>

        <div id="o-container">
            <div id="diss-top"> 
                <center>
                    <table width="553" class="toptable" align="center">
                        <tr>

                            <td width="62"></td>
                            <td width="178">&nbsp;</td>
                            <td width="130">Run</td>
        <!--                    <td width="126"><input type="checkbox" id="stage2"/>Stage 2</td>-->
                        </tr>
                        <tr>
                            <td></td>
                            <td>Dissolution Medium</td>
                            <td>
                                <input type="text" name="DM" placeholder="e.g. HCL" value="" id="DM" required="required"  class="dissclear"/>
                            </td>
        <!--                    <td>   <input type="text" name="DM2" placeholder="e.g. HCL" value="" id="DM2" required="required" class="stage2 dissclear" />-->
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Volume Used (mL)</td>
                            <td><input type="text" name="R2" placeholder="900" value="" id="R2" required="required" class="dissclear"/></td>
        <!--                    <td><input type="text" name="Rv21" placeholder="900" value="" id="Rv21" required="required" class="stage2 dissclear"/></td>-->
                        </tr>
                        <tr>
                            <td></td>
                            <td>Apparatus</td>
                            <td>
                                <select name="apparatus" id="apparatus">
                                    <option value=""></option>
                                    <option value=1>1</option>
                                    <option value=2>2</option>
                                </select></td>

                        <tr>
                            <td></td>
                            <td>RPM </td>
                            <td><input type="text" name="Rm" placeholder="" value="" id="Rm" required="required" class="dissclear"/>
                            </td>
        <!--                    <td><input type="text" name="Rm2" placeholder="" value="" id="Rm2" class="stage2 dissclear" required="required" /></td>-->
                        </tr>
                        <tr>
                            <td></td>
                            <td>Time (mins)</td>
                            <td>
                                <input type="text" name="R3" id="first" class="time1"/>
                                <input type="text" name="R31" id="second" class="time1"/>
                                <input type="text" name="R32" id="third" class="time1"/>
                                <input type="text" name="R33" id="fourth" class="time1"/>
                                <input type="text" name="R34" id="fifth" class="time1"/>
                            </td>
        <!--                    <td>-->
        <!--                        <input type="text" name="R4" id="" class="stage2 time1-2"/>-->


                        </tr>


                    </table>
                </center>

   <p>

                </p>
                <center>
                    <p>
                        <div id="saveicon"><div id="waiting4"></div>Saving...Please Wait!.. </div>
                        <input type="button" value="Save"  id="Export"/>
        <!--                <input type="button" value="Save & Repeat"  id="Export_r"/>-->
                        <input type="button" type="submit" value="+Add New Active Ingredient" id="addassay">
                            <input type="button" id="finish" value="FINISHED" class=""/>
                            <span id="Notice">Kindly Select A component From the dropdown at the top of the page first to enable save button down here!</span>
                    </p>
                </center>

                <center>
                    <div class="other_details">
                        <legend> Assay/Dissolution Data Details</legend>
                        <p><em><strong>Please Click the download link Below Select Assay-Dissolution Worksheet</strong></em> </p>
    <!--                    <select name="heading" id="activeIngredient" >               
                        </select>-->
                        <br>
                            <p>
                                <a href="#downloadWrksheets?<?php echo date('d-m-y H:i:s'); ?>" class="Wrksh" id="<?php echo $labref; ?>">Download</a> 
                            </p>
                            <!--<p style="width:20px;"></p>
                            <p><em><strong>Please Click the  link Below Select Worksheet to be uploaded!</strong></em> </p>
                            <p>
                                <a href="<?php echo site_url('analyst_uploads/worksheet/' . $labref . '/' . $id); ?>">Upload Worksheet</a> 
                            </p>-->
                    </div></center>

                </form>
            </div>

            <div id="dialog" title="Basic dialog" style="display: none; background-color: #E5E5FF; margin:10px;">
                <p><form name="" id="reason">
                        <h4>State the reason for repeating this test below</h4>
                        <p>
                            <input type="hidden" name="heading"/>
                            <textarea cols="45" rows="5" name="why" id="why_repeat" required></textarea>
                            <br/>
                            <input type="button" value="submit" id="sendit" /><input type="button" value="Close Dialog" id="closeit"/><input type="button" value="cancel" id="cancelit"/>
                    </form></p>
            </div>

            <!--        <div id="dialog-confirm"  title="Dissolution Standard Values">
                        <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 10px 30px 0;"></span>Do you want to use previous Standard A & B Assay values for sample <?php echo $labref; ?> in dissolution standards?</p>
                    </div>-->

            <div id="tests" class="hidden2">
                <style type="text/css">
                    .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#9DE0AD;}
                    #the_worksheettable{
                        width:100%; 
                        border-collapse:collapse; 
                    }
                    #the_worksheettable td{ 
                        padding:7px; border:#4e95f4 1px solid;
                    }
                    /* Define the default color for all the table rows */
                    #the_worksheettable tr{
                        background: #b8d1f3;
                    }
                    /* Define the hover highlight color for the table row */
                    #the_worksheettable tr:hover {
                        background-color: #ffff99;
                    }
                </style>
                <form id="sheet_gen">
                    <table class="tg" id="the_worksheettable">
                        <tr>
                            <th class="tg-031e">ID</th>
                            <th class="tg-031e">TEST NAME</th>
                            <th class="tg-031e">TEST NAME / MOLECULE</th>
                            <th class="tg-031e">SELECTOR</th>
                        </tr>
                        <tbody>
                            <?php
                            $i = 1;

                            foreach ($T as $t):
                                foreach ($mole as $cule):
                                    ?>
                                    <tr>
                                        <td class="tg-031e"><?php echo $i; ?></td>
                                        <td class="tg-ugh9"><?php echo $t->name; ?><input type="hidden" name="test_id[]" value="<?php echo $t->test_id; ?>"/></td>
                                        <td><select name="molecule[]" id="" class="selectbox_1"> 
                                                <option value="">-Select-</option>
                                                <!--                                   <option value="Uniformity">Uniformity</option>
                                                                                    <option value="Relative Density">Relative Density</option>-->
                                                <option value="<?php echo $cule->name; ?>"><?php echo $cule->name; ?></option>

                                            </select></td>
                                        <td class="tg-031e"><input type="checkbox" value="<?php echo $t->alias; ?>"name="test_names[]" class="checkbox_1"/></td>

                                    </tr>
                                    <?php
                                endforeach;
                                $i++;
                            endforeach;
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <input type="hidden" id="the_labref"/>
                                <td colspan="3">
                                    <input type="button" id="generator" value="Generate & Download Worksheets"/>
                                    <input type="button" id="resetgenerator" value="Reset"/>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </form>
            </div>

    </body>


<!--                        <script type="text/javascript" src="<?php echo base_url(); ?>javascripts/assay.min.js"></script>-->
    <script type='text/javascript' src='<?php echo base_url(); ?>javascripts/zebra_dialog.js'></script>

    <script type="text/javascript">
$(document).ready(function () {
    


                 
                    
                    $('#addLAB').click(function(){
                  
                        $row =   '<tr><td><select name="labref[]" id="processor" class="select2"><?php foreach($labrefs as $l):?><option value="<?php echo $l->lab_ref_no;?>"><?php echo $l->lab_ref_no;?></option><?php  endforeach;?></select></td><td><a href="#remLAB" class="remLAB"> -remove</a></td></td></tr>';
                        $('#batch_table tbody').append($row);
                        return false;
                     
                    });
                    
                     $(document).on('click',' .remLAB',function(){   
                    $(this).closest('tr').remove();
                   
                    });

    

$('#the_worksheettable  .selectbox_1').change(function () {
    value = $(this).val();

    if (value !== '') {
        $(this).closest('tr').find('.checkbox_1').prop('checked', $(this).val() !== "" ? true : false);
    } else {
        $(this).closest('tr').find('.checkbox_1').prop('checked', $(this).val() == "" ? false : true);
    }
});

$('#generator').click(function () {
    $(this).prop('value', 'Generating, please wait...');
    $("#the_worksheettable input[type=checkbox]:not(:checked)").closest("tr").remove();

    labref = $('#the_labref').val();
    data1 = $('#sheet_gen').serialize();
    $.ajax({
        type: 'post',
        url: "<?php echo base_url(); ?>assay/creatWorkbookSheets/" + labref,
        data: data1,
        dataType: 'json',
        success: function () {
            $('#generator').hide();
            $('#resetgenerator').show();
            //window.location.href="<?php echo base_url(); ?>assay/worksheet/"+labref+"/5";
            window.location.href = "<?php echo base_url(); ?>Workbooks/" + labref + "/" + labref + ".xlsx";
        }, error: function (e) {
            window.location.href = "<?php echo base_url(); ?>Workbooks/" + labref + "/" + labref + ".xlsx";

        }
    });


});
$('#resetgenerator').click(function () {
    labref = $('#the_labref').val();
    window.location.href = "<?php echo base_url(); ?>assay/worksheet/" + labref + "/5";
});


$("#stage-2").hide();
$('.stage2').prop('disabled', true);

$("#stage2").click(function () {
    if ($("#stage2").is(":checked", true)) {
        $("#stage-2").show();
        $(".stage2").attr("disabled", false);
        $('.dissolution-class2').show();
    } else {
        // $(".dillution1").hide();
        $("#stage-2").hide();
        $(".stage2").attr("disabled", "disabled");
        $('.dissolution-class2').hide();

        // $('#workingp1').val($('#workingp1').find("option").first().val());                            

    }
});

$('.time1-2').keyup(function () {
    value = $(this).val();
    $('#area-152').val(value + 'Mins Stage-2');
});




/* $("#workingp11").attr("disabled", "disabled");
 $("#workingvf2").attr("disabled", "disabled");
 $("#workingp12").attr("disabled", "disabled");
 $("#workingvf3").attr("disabled", "disabled");
 $("#workingp13").attr("disabled", "disabled");
 $("#workingvf4").attr("disabled", "disabled");
 $("#workingv").attr("disabled", "disabled");
 $("#workingp1").attr("disabled", "disabled");

 $("#workingv2").attr("disabled", "disabled");
 $("#workingp2").attr("disabled", "disabled");

 $("#workingv3").attr("disabled", "disabled");
 $("#workingp3").attr("disabled", "disabled");

 $("#workingv4").attr("disabled", "disabled");
 $("#workingp4").attr("disabled", "disabled");

 //Sample assay preparation
 $("#sp1").attr("disabled", "disabled");
 $("#svf2").attr("disabled", "disabled");
 $("#pipette2").attr("disabled", "disabled");
 // $("#vf3").attr("disabled","disabled");
 $("#pipette3").attr("disabled", "disabled");
 $("#vf41").attr("disabled", "disabled");*/

//********************************************************
//standard preparation
//*******************************************************

//$(".dillution1").css("display","none");
$("#dill1").click(function () {
    if ($("#dill1").is(":checked", true)) {
        // $(".dillution1").show();
        $("#workingp11").attr("disabled", false);
        $("#workingvf2").attr("disabled", false);



    } else {
        // $(".dillution1").hide();
        $("#workingp11").attr("disabled", "disabled");
        $("#workingvf2").attr("disabled", "disabled");
        // $('#workingp1').val($('#workingp1').find("option").first().val());                            

    }
});
$("#dill2").click(function () {
    if ($("#dill2").is(":checked", true)) {
        // $(".dillution1").show();
        $("#workingp12").attr("disabled", false);
        $("#workingvf3").attr("disabled", false);



    } else {
        // $(".dillution1").hide();
        $("#workingp12").attr("disabled", "disabled");
        $("#workingvf3").attr("disabled", "disabled");
        // $('#workingp1').val($('#workingp1').find("option").first().val());                            

    }
});
$("#dill3").click(function () {
    if ($("#dill3").is(":checked", true)) {
        // $(".dillution1").show();
        $("#workingp13").attr("disabled", false);
        $("#workingvf4").attr("disabled", false);



    } else {
        // $(".dillution1").hide();
        $("#workingp13").attr("disabled", "disabled");
        $("#workingvf4").attr("disabled", "disabled");
        // $('#workingp1').val($('#workingp1').find("option").first().val());                            

    }

});


$("#ena").click(function () {
    if ($("#ena").is(":checked", true)) {
        // $(".dillution1").show();
        $("#workingp1").attr("disabled", false);
        $("#workingv").attr("disabled", false);



    } else {
        // $(".dillution1").hide();
        $("#workingp1").attr("disabled", "disabled");
        $("#workingv").attr("disabled", "disabled");
        // $('#workingp1').val($('#workingp1').find("option").first().val());                            

    }
});

$("#ena2").click(function () {
    if ($("#ena2").is(":checked", true)) {
        // $(".dillution1").show();
        $("#workingp2").attr("disabled", false);
        $("#workingv2").attr("disabled", false);



    } else {
        // $(".dillution1").hide();
        $("#workingp2").attr("disabled", "disabled");
        $("#workingv2").attr("disabled", "disabled");
        // $('#workingp1').val($('#workingp1').find("option").first().val());                            

    }
});

$("#ena3").click(function () {
    if ($("#ena3").is(":checked", true)) {
        // $(".dillution1").show();
        $("#workingp3").attr("disabled", false);
        $("#workingv3").attr("disabled", false);



    } else {
        // $(".dillution1").hide();
        $("#workingp3").attr("disabled", "disabled");
        $("#workingv3").attr("disabled", "disabled");
        // $('#workingp1').val($('#workingp1').find("option").first().val());                            

    }
});

$("#ena4").click(function () {
    if ($("#ena4").is(":checked", true)) {
        // $(".dillution1").show();
        $("#workingp4").attr("disabled", false);
        $("#workingv4").attr("disabled", false);



    } else {
        // $(".dillution1").hide();
        $("#workingp4").attr("disabled", "disabled");
        $("#workingv4").attr("disabled", "disabled");
        // $('#workingp1').val($('#workingp1').find("option").first().val());                            

    }
});

});



$("#savedissolution1").click(function () {
jQuery(function () {

    $.Zebra_Dialog('<strong>Dissolution</strong>, would you like to save and move to the next stage or just save?', {
        'type': 'question',
        'title': 'Dissolution Stage Request',
        'buttons': [
            {caption: 'Move', callback: function () {
                    window.location.href = "<?php echo base_url(); ?>dissolution/multidissolution/";
                }},
            {caption: 'Save', callback: function () {
                    window.location.href = "<?php echo base_url(); ?>dissolution/save_weights";
                }},
            {caption: 'Save & Move', callback: function () {
                    window.location.href = "<?php echo base_url(); ?>dissolution/multidissolution/";
                }},
            {caption: 'Cancel', callback: function () {
                }}
        ]
    })

})
})
$(document).ready(function () {
$('p#show').hide();
$('p#hide').click(function () {
    $('div#a').slideUp();
    $('p#show').show();
    $(this).hide();
});
$('p#show').click(function () {
    $('div#a').slideDown();
    $(this).hide();
    $('p#hide').show();
});
});

$(document).ready(function () {
$('#dialog').hide();
$('#distest').click(function () {
    $.fx.speeds._default = 1000;

    $("#dialog").dialog({
        autoOpen: true,
        show: "blind",
        hide: "explode",
        modal: true
    });

});

$('#d').click(function () {
    $("#dialog").dialog("close");
})
$('#d1').click('change', function () {
    window.location.href = "<?php echo base_url(); ?>dissolution/multidissolution/";
    $(this).dialog("close");
})
$('#d2').click('change', function () {
    window.location.href = "<?php echo base_url(); ?>dissolution/multistaged";
    $(this).dialog("close");
})
$("#distest").click(function () {
    $("#dialog").dialog("open");
    return false;
});


});
</script>
</html>

</html>
