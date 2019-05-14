<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Sample_request_details extends MY_Controller {

    function __construct() {        
        parent::__construct();
        $this->load->library('excel');    
        }
        
        function generate($year) {

        $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load("sample_report/sample_template.xlsx");
        $objPHPExcel->getActiveSheet(0);        
        $signatories = $this->getSignatories($year);
      
        $worksheet = $objPHPExcel->getActiveSheet();
    $styleArray = array(
            'borders' => array(
                'outline' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THICK,
                    'color' => array('argb' => 'FFFF0000'),
                ),
            ),
        );
        $row2 = 3;

        foreach ($signatories as $signatures):
            $col = 0;
            $worksheet
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->request_id)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->name)                    
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->product_name)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->batch_no)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->designation_date);
                  
                   
            $row2++;
        endforeach;


        $objPHPExcel->getActiveSheet()->setTitle('Request Samples- '.date('Y'));
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save("sample_report/Report.xlsx");


        echo 'Data exported';
    }
    
    function getSignatories($year) {
    return $this->db->query("SELECT r.request_id, r.product_name,r.active_ing,r.designation_date,r.manufacturer_name,r.exp_date,r.batch_no, c.name FROM request r, clients c WHERE r.client_id = c.id AND YEAR(designation_date)='$year' ORDER BY r.id DESC")->result(); 
     
        }
    

}

