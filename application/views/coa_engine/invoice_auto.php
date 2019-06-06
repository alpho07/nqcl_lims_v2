<!doctype>
<html>
    <head>
    <link href="<?php echo base_url(); ?>CSS/jquery-ui.css" type="text/css" rel="stylesheet"/>
    <title>INVOICE</title>
    </head>


    <style>
        body{
            margin: 0px;
            padding: 0px;         
            font-family: "Book Antiqua";
        }
        #content{
            margin: 0px;
            padding: 0px;

            width: 100%;
            height: 100%;
        }
        #title{
            width:100%;
                       
            font-size: 24px;
            font-weight: bolder;
        }
        #inv_date,#invoice_top,#invoice_body,#invoice_footer{
            width: 680px;
            background: white;
        }


        .topic{
            font-weight: bolder;
            text-decoration: underline;
            font-size: 16px;
        }
        .topic_t{
            font-weight: bold;
            font-size: 14px;
            line-height: 25px;
            width: 190px;
        }
        .topic_w{
            font-size: 14px;
            line-height: 25px;
        }
        #invoice_body  td{
            padding: 2px;
        }
        input, textarea,select{
            border:none;
        }

        #invoice_body tr td{
            border: 1px solid #000;
        }
        #invoice_body th{
            border: 1px solid #000;
        }
        .tests{
            width:100%;
            font-family: "Book Antiqua";
            font-weight: bolder;
          
            text-align: center;
            background: #CCCCCC;
        }
        .method, .compendia{
            width: 100%;
            text-align: center;
            font-family:"Book Antiqua";

        }

        .cost{
            font-weight: bolder;
            font-size: 15px;
            text-align: center;
            width:100%;
             font-family:"Book Antiqua";

        }
          #product_name{
              font-family:"Book Antiqua" !important;
          }
       
      

    </style>
    <body>
        <div id="content">
            <form id="INVOICE">
            <center>
                <?php $this -> load -> view("document_header_v", TRUE);?>
                <table id="inv_date" >
                <tr><td><div id="title">INVOICE</div></td></tr>
                <tr><td colspan="3"><hr></tr>
                    <tr>
                        <td><span style="font-size:18px; font-weight: bold;">INVOICE No:</span><?php echo @$inv[0]->invno. $year2; ?></td>
                        <td style="font-weight: bolder; white-space: nowrap;"><span><?php echo date('j') . '<sup>' . date('S') . '</sup>' . date(' F Y'); ?></span></td>

                    </tr>
                    <tr><td colspan="3"></td></tr>
                    <tr>
                        <td>
                            <div id="edaddress" name="client" cols="50" rows="10" style=" overflow: hidden; font-weight: bold; font-size:14px; font-family:'Book Antiqua'; text-align: left">
                                <?php
                                $def ="<p>".$information[0]->name . "</p><p>" . $information[0]->address."</p>";
                                $norm = @$inv[0]->client;
                                 if(empty($norm)){
                                    echo $def;
                                 }else{
                                   echo trim($norm);
                                 }
                                 ?>
                            </div>
                        </td>
                        <td></td>
                    </tr>
                    <tr><td colspan="2"></td></tr>
                </table>
                <h3><span class="topic">Re: ANALYSIS OF LISTED PRODUCT.</span></h3>
                <table id="invoice_top" style="margin-top: 10px;">
                    <tbody>
                        <tr style="background: #d9d9d9;" >
                            <td class="topic_t" style="border:none;">PRODUCT:</td>
                            <td class="topic_w" style="border:none;"><div id="product" style="width:100%; background:#d9d9d9; overflow:none;"><?php echo $information[0]->product_name; ?></div> </td>
                        </tr>
                        <tr>
                            <td class="topic_t" style=" vertical-align: text-top !important;">BATCH NO:</td>
                            <td class="topic_w"><?php
                                $def1 =$information[0]->batch_no;
                                $norm1 = @$inv[0]->batch;
                                 if(empty($norm1)){
                                    echo $def1;
                                 }else{
                                   echo trim($norm1);
                                 }
                                 ?></td>
                        </tr>
                        <tr>
                            <td class="topic_t">CERTIFICATE NO:</td>
                            <td class="topic_w"><?php echo $year ?><?php echo @$inv[0]->can; ?></td>
                        </tr>
                        <tr>
                            <td class="topic_t">LABORATORY REF NO:</td>
                            <td class="topic_w"><?php echo $labref; ?></td>
                        </tr>
                        <tr>
                            <td class="topic_t">CLIENT REF NO:</td>
                            <td class="topic_w"><?php echo!empty($information[0]->clientsampleref) ? $information[0]->clientsampleref : "-"; ?></td>
                        </tr>
                        <tr>
                            <td class="topic_t" style=" vertical-align: text-top !important;">TEST(S) REQUESTED:</td>
                            <td class="topic_w"><?php echo $tests_requested;?></td>
                        </tr>
                        <tr>&nbsp;</tr>

                    </tbody>            

                </table>
                <table id="invoice_body" cellpadding="0" cellspacing="0">
                    <thead>
                        <tr style="">
                            <th style="height: 40px; vertical-align: middle; border-top: none; border-right: none; border-left:none;" colspan="4">
                                <span class="topic">COST OF ANALYSIS: </span>
                            </th>
                        </tr>
                        <tr>
                            <th style="background: #cccccc;">
                                TEST
                            </th>
                            <th>
                                METHOD
                            </th>
                            <th>
                                COMPENDIA
                            </th>
                            <th>
                                COST(<?php echo  $currency; ?>)
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($test_data as $test) { ?>
                            <tr style="vertical-align: middle; text-align: center; width:100%;">
                                <td style="font-weight: bolder; font-size: 14px; background: #cccccc;"><?php echo $test["Tests"][0]["Name"]; ?></td>
                                <td style=""><?php echo $test["Tests"][0]["Test_methods"][0]["name"]; ?></td>
                                <td style=""><?php echo $test["compendia"][0]["name"];?></td>
                                <td style="font-weight: bolder; font-size: 16px; width:120px;"><?php echo number_format($test["method_charge"] + $test["test_charge"]);?></td>
							</tr>
                        <?php } ?>

						<?php foreach ($tr_array as $k => $v) {?>
                        <tr style="vertical-align: middle; text-align: center;">
                            <td colspan="2" style="border-left: none; border-top:none; border-bottom:none;"></td>
                            <td style="font-size: 14px; font-weight: bold;"><?php echo $k; ?></td>
                            <td style="font-weight: bolder; font-size: 16px; width:100px;"><?php if($k == 'discount'){ echo '('. number_format($v, 2).')'; } else{ echo number_format($v, 2); }  ?></td>

                        </tr>
						<?php }?>
                        <tr><td colspan="4" style="border-left: none;  border-bottom:none;"></td></tr>
                    </tbody>
                </table>
                <span>&nbsp;</span>
                <table id="invoice_footer">
                    <tr>
                        <td style="font-weight: bolder; width: 100px;">DIRECTOR:</td>
                        <td><span><?php echo $director[0]['title'].$director[0]['fname']." ".$director[0]['lname'] ?></span></td>
                        <td style="border-bottom:dotted black;  width: 170px; padding-right: 20px;"></td>
                        <td colspan="3">&nbsp;&nbsp;</td>                     
                        <td style="text-align: right" ><span style="font-weight: bolder;" >DATE:&nbsp;</span><?php echo date('d/m/Y'); ?></td>
                    </tr>
                    <tr style="height: 20px;">
                        <td colspan="4" style="text-align: center">
                        <span >
                            <br>
                            
                        </span>
                    </td>
                    </tr>
                </table>
                <p id="footer" style="font-size: 10px; color: gray;">All cheques should be made payable to: NATIONAL QUALITY CONTROL LABORATORY</p>
            </center>
            </form>
        </div>
    </body>
</html>