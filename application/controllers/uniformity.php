<?php

include APPPATH . 'third_party/FPDF/fpdf17/fpdf.php';
include APPPATH . 'third_party/FPDF/FPDI/fpdi.php';
require APPPATH . 'core/MY_Labwork.php';

class Uniformity extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('testing');
    }

    function test() {
        error_reporting(0);
        $data['settings_view'] = 'uniformity_v';
        $this->base_params($data);
    }

    function worksheet($labref, $test_id, $dosageForm = '') {
        if ($dosageForm == "2") {
            $this->capsules($labref);
        } else if ($dosageForm == "1") {
            $this->tabs($labref);
        } else {
            $this->tabs($labref);
        }
        /* $rawform=  $this->justBringDosageForm($labref);
          $dosageForm=$rawform[0]->dosage_form;
          if($dosageForm=="2" || $dosageForm=="13" || $dosageForm=="9"){
          $this->capsules($labref);
          }else if($dosageForm=="1"){
          $this->tabs($labref);
          }else if($dosageForm=="3"){
          $this->less_than_40($labref);
          }else if($dosageForm=="5" || $dosageForm=="6"){
          $this->sup_pes($labref);
          } */
    }

    function loadUniformity($labref, $r) {
        $analyst_id = $this->session->userdata('user_id');
        $dosageForm = $this->uri->segment(5);
        if ($dosageForm == '2') {
            echo json_encode($this->db
                            ->where('labref', $labref)
                            ->where('r_status', $r)
                            ->where('analyst_id', $analyst_id)
                            ->get('weight_uniformity')
                            ->result()
            );
        } else if ($dosageForm == '1') {
            echo json_encode($this->db
                            ->where('labref', $labref)
                            ->where('repeat_status', $r)
                            ->where('analyst_id', $analyst_id)
                            ->get('weight_tablets')
                            ->result()
            );
        } else {
            
        }
    }

    public function capsules() {
        $data = array();


        $id = $this->uri->segment(4);
        $uri = $this->uri->segment(3);
        $fulluri = $uri . '/' . $id;
        $data['labrefuri'] = $fulluri;
        $data['labref'] = $uri;
        $data['df'] = $this->uri->segment(5);
        $data['repeat_no'] = $this->getDoStatus();
        $data['test_id'] = $this->uri->segment(4);
        $data['settings_view'] = "uniformity_v_custom";
        $data['lastworksheet'] = $this->getWorksheet() + 1;




        $this->base_params($data);

        //echo $GLOBALS['labref'];
    }

    function less_than_40() {

        $id = $this->uri->segment(4);
        $uri = $this->uri->segment(3);
        $fulluri = $uri . '/' . $id;
        $data['labrefuri'] = $fulluri;
        $data['labref'] = $uri;
        $data['repeat_no'] = $this->getDoStatus();
        $data['test_id'] = $this->uri->segment(4);
        $data['settings_view'] = "uniformity_v_40";
        $data['lastworksheet'] = $this->getWorksheet() + 1;




        $this->base_params($data);
    }

    function sup_pes() {

        $id = $this->uri->segment(4);
        $uri = $this->uri->segment(3);
        $fulluri = $uri . '/' . $id;
        $data['labrefuri'] = $fulluri;
        $data['labref'] = $uri;
        $data['repeat_no'] = $this->getDoStatus();
        $data['test_id'] = $this->uri->segment(4);
        $data['settings_view'] = "uniformity_v_sup_pes";
        $data['lastworksheet'] = $this->getWorksheet() + 1;




        $this->base_params($data);
    }

    public function getWorksheet() {
        $res = mysql_query("SELECT MAX(id) AS lastId FROM worksheets");
        while ($row = mysql_fetch_assoc($res)) {
            $lastId = $row['lastId'];
        }
        return $lastId;
    }

    function getDoStatus() {
        $labref = $this->uri->segment(3);
        $test_id = $this->uri->segment(4);
        $analyst_id = $this->session->userdata('user_id');
        $this->db->where('lab_ref_no', $labref);
        $this->db->where('test_id', $test_id);
        $this->db->where('analyst_id', $analyst_id);
        $query = $this->db->get('sample_issuance')->result();
        return $result = $query[0]->done_status;
    }

    function updateSampleIssuance() {
        $do_status = $this->getDoStatus() + '1';
        $labref = $this->uri->segment(3);
        $test_id = $this->uri->segment(4);
        $analyst_id = $this->session->userdata('user_id');
        $this->db->where('lab_ref_no', $labref);
        $this->db->where('test_id', $test_id);
        $this->db->where('analyst_id', $analyst_id);
        $this->db->update('sample_issuance', array('do_count' => $do_status));
    }

    public function save_capsule_weights() {

        $this->updateSampleIssuance();
        $labref = $this->uri->segment(3);
        $max_row_id = $this->getUniRepeatStatus($labref);
        (int) $new_status = (int) $max_row_id[0]->r_status + 1;
        $analyst_id = $this->session->userdata('user_id');

        $cw1 = $this->input->post('capsdata1');
        $cw2 = $this->input->post('capsdata2');
        $cw3 = $this->input->post('capsdata3');

        for ($i = 0; $i < count($cw1); $i++) {
            $tab_array = array(
                'labref' => $labref,
                'tcsv' => $cw1[$i],
                'ecsv' => $cw2[$i],
                'csvc' => $cw3[$i],
                'percent_deviation' => '',
                'r_status' => $new_status,
                'analyst_id' => $analyst_id
            );
            $this->db->insert('weight_uniformity', $tab_array);
        }
        //$this->Returning_to_Supervisor($labref);
        $this->save_totalaverage_weights();
        $this->senttoExcel($labref);
        $this->readExcelUpdate($labref, $new_status);
        $this->RegisterUniformityValues($labref, $new_status);
        $test_id = $this->uri->segment(4);
        $this->deletePDFgen($labref, $test_id, $analyst_id);
        $pdf_name = $labref . '_uniformity';
        //$this->insertPDFgen($labref, $pdf_name, $test_id, $analyst_id);

        $this->save_totalaverage_weights();
        $this->updateTestIssuanceStatus();
        $this->updateSampleSummary();
        $this->post_posting();
        $this->updateTabsCapsCOADetails($labref);

        $this->updateUploadStatus($labref, $test_id);
        //$sql1 = "UPDATE worksheets SET comment='$comment' WHERE labref='$labref'";
        //$j = mysql_query($sql1);
        //redirect('analyst_controller/');
    }

    function readExcelUpdate($labref, $r) {
        $last_id = $this->db->query("SELECT `id` FROM `weight_uniformity` WHERE `labref`='$labref' AND `r_status`='$r' ORDER BY id ASC limit 1 ")->result();

        $file2 = "Workbooks/" . $labref . "/" . $labref . ".xlsx";
        $objPHPExcel = PHPExcel_IOFactory::load($file2);
        $worksheet = $objPHPExcel->setActiveSheetIndexByName('Uniformity');
        $start_id = $last_id[0]->id;
        for ($i = 21; $i < 41; $i++) {
            $cell = array(
                // 'csvc'=>round($worksheet->getCell('D'.$i)->getCalculatedValue()),
                'percent_deviation' => round($worksheet->getCell('E' . $i)->getCalculatedValue() * 100, 2)
            );
            $this->db->where('id', $start_id)->update('weight_uniformity', $cell);
            $start_id++;
        }

        $tarray = array(
            'overall_total' => round($worksheet->getCell('B42')->getCalculatedValue(), 8),
            'overall_average' => round($worksheet->getCell('B43')->getCalculatedValue(), 8),
            //'average'=>round($worksheet->getCell('C46')->getCalculatedValue(),4),
            'actual_total' => round($worksheet->getCell('D42')->getCalculatedValue(), 8),
            'actual_average' => round($worksheet->getCell('D43')->getCalculatedValue(), 8),
            'cstatus' => round($worksheet->getCell('C47')->getCalculatedValue() * 100, 8));

        $this->db->where('labref', $labref)->where('repeat_status', $r)->update('weight_caps_ta', $tarray);
    }

    function senttoExcel($labref) {
        $sampleinfo = $this->loadSampleInfo($labref);
        $cw1 = $this->input->post('capsdata1');
        $cw2 = $this->input->post('capsdata2');


        $file1 = "original_workbook/uniformity_multi.xlsx";
        $file2 = "Workbooks/" . $labref . "/" . $labref . ".xlsx";


        $objPHPExcel = PHPExcel_IOFactory::load($file2);
        $objPHPExcel2 = PHPExcel_IOFactory::load($file1);


        $name = $objPHPExcel2->getSheetByName('Uniformity');
        $original = $objPHPExcel->getSheetByName('Uniformity');
        if ($original == true) {
            $objPHPExcel->getActiveSheet()->setTitle('Uniformity 1');
        } else {
            
        }
        $objPHPExcel->addExternalSheet($name);
        $end = $objPHPExcel->getSheetCount();
        $show_number = array();
        foreach (range(0, $end - 1) as $number) {
            $show_number[] = $number;
        }
        $sheet = max($show_number);


        $objPHPExcel->setActiveSheetIndex($sheet);
        $worksheet = $objPHPExcel->getActiveSheet();
        $row2 = 21;
        for ($i = 0; $i < count($cw1); $i++) {
            $col = 1;
            $worksheet
                    ->setCellValueByColumnAndRow($col++, $row2, $cw1[$i])
                    ->setCellValueByColumnAndRow($col++, $row2, $cw2[$i]);
            $row2++;
        }
        //$worksheet->setCellValue('A1', $labref);

        $worksheet->setCellValue('C11', $sampleinfo[0]->product_name)
                ->setCellValue('C12', $sampleinfo[0]->request_id)
                ->setCellValue('C13', $sampleinfo[0]->active_ing)
                ->setCellValue('C14', $sampleinfo[0]->label_claim)
                ->setCellValue('C15', $sampleinfo[0]->updated_at)
                ->setCellValue('C16', date('Y-m-d H:i:s'));

        $objPHPExcel->getActiveSheet()->setTitle("Uniformity");


        $dir = "workbooks";

        if (is_dir($dir)) {
	 $objPHPExcel->setActiveSheetIndex($sheet);
        $worksheet=$objWorksheet = $objPHPExcel->getActiveSheet();
		$worksheet->getProtection()->setSheet(true);
        $worksheet->getProtection()->setSort(true);
        $worksheet->getProtection()->setInsertRows(true);
        $worksheet->getProtection()->setFormatCells(true);
        $worksheet->getProtection()->setPassword('NQCLworksheets@2016');

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");
            //$this->updateWorksheetNo();
            //$this->upDatePosting($labref);
            echo 'Data exported';
        } else {
            echo 'Dir does not exist';
        }
    }

    function RegisterUniformityValues($labref, $repeat_status) {
        if (file_exists('samplepdfs/' . $labref . '_uniformity.pdf')) {
            unlink('samplepdfs/' . $labref . '_uniformity.pdf');
        } else {
            // echo 'Not found';
        }
        $uniformity = $this->getTabs_uv($labref, $repeat_status);
        $uniformity_d = $this->taverage($labref, $repeat_status);


        $full_name = 'samplepdfs/uniformity.pdf';
        $pdf = new FPDI('P', 'mm', 'A4');
        $pdf->AliasNbPages();

        $pagecount = $pdf->setSourceFile($full_name);

        $i = 1;
        do {
            // add a page
            $pdf->AddPage();
            // import page
            $tplidx = $pdf->ImportPage($i);

            $pdf->useTemplate($tplidx, 10, 10, 200);

            $pdf->SetFont('Arial');
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetFontSize(8);

            $xa = 1;
            $ya1 = (int) 56;

            for ($u = 0; $u < count($uniformity); $u++) {

                $pdf->SetXY(45, $ya1+=5);
                // $pdf->Write(1, $uniformity[$u]->tcsv);
                $pdf->MultiCell(20, 1, $uniformity[$u]->tcsv, 0, 'R');

                $pdf->SetXY(82, $ya1);
                // $pdf->Write(1, $uniformity[$u]->ecsv);
                $pdf->MultiCell(20, 1, $uniformity[$u]->ecsv, 0, 'R');

                $pdf->SetXY(130, $ya1);
                //  $pdf->Write(1, $uniformity[$u]->csvc);
                $pdf->MultiCell(20, 1, $uniformity[$u]->csvc, 0, 'R');

                $pdf->SetXY(163, $ya1);
                // $pdf->Write(1, $uniformity[$u]->percent_deviation);
                $pdf->MultiCell(20, 1, $uniformity[$u]->percent_deviation, 0, 'R');
            }

            $pdf->SetXY(51, 167);
            $pdf->Write(1, $uniformity_d[0]->overall_total);


            $pdf->SetXY(51, 176);
            $pdf->Write(1, $uniformity_d[0]->overall_average);
            //$pdf->MultiCell(10, 1,  $uniformity_d[0]->overall_average, 0, 'R');


            $pdf->SetXY(138, 167);
            $pdf->Write(1, $uniformity_d[0]->actual_total);


            $pdf->SetXY(138, 176);
            $pdf->Write(1, $uniformity_d[0]->actual_average);


            $pdf->SetXY(63, 185);
            $pdf->Write(1, $uniformity_d[0]->cstatus);





            $i++;
        } while ($i <= $pagecount);
        $pdf->Output('samplepdfs/' . $labref . '_uniformity.pdf', 'F');

        echo 'Done';
    }

    function taverage($labref, $r) {
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $query = $this->db->get('weight_caps_ta');
        return $result = $query->result();
        //print_r($result);
    }

    function updateTestIssuanceStatus() {
        $labref = $this->uri->segment(3);

        $analyst_id = $this->session->userdata('user_id');
        $done_status = '1';
        $data = array(
            'done_status' => $done_status
        );
        $this->db->where('lab_ref_no', $labref);
        $this->db->where('test_id', 6);
        $this->db->where('analyst_id', $analyst_id);
        $this->db->update('sample_issuance', $data);
        
        $this->comparetToDecide($labref);
    }

    public function save_totalaverage_weights() {
        $this->load->database();
        if ($_POST):


            $labref = $this->uri->segment(3);
            $max_row_id = $this->getUniformityTestRepeatStatus($labref);
            (int) $new_status = (int) $max_row_id[0]->repeat_status + 1;

            $labref = $this->uri->segment(3);
            $analyst_id = $this->session->userdata('user_id');

            $average_weights = array(
                'labref' => $labref,
                'overall_total' => $overall_total = $this->input->post('utotals'),
                'overall_average' => $this->input->post('average'),
                'actual_total' => $this->input->post('totalss2'),
                'actual_average' => $actual_average = $this->input->post('uav3'),
                'cstatus' => $this->input->post('comment'),
                'analyst_id' => $analyst_id,
                'repeat_status' => $new_status
            );
            $this->db->insert('weight_caps_ta', $average_weights);
            $this->save_test();

            $average_weights1 = array(
                'labref' => $labref,
                'average' => $actual_average = $this->input->post('uav3'),
                'analyst_id' => $analyst_id
            );
            $this->db->insert('caps_tabs_data', $average_weights1);

            $uniformity_status = array(
                'labref' => $labref,
                'uniformity_status' => 1,
                'test_type' => 'TC',
                'analyst_id' => $analyst_id
            );
            $this->db->insert('uniformity_status', $uniformity_status);

            return false;
        else :
            return true;
        endif;
    }

    function post_posting() {
        $labref = $this->uri->segment(3);
        $posts = array(
            'labref' => $labref,
            'component' => 'uniformity',
            'component_no' => '0',
            'test_name' => 'Uniformity of Weight',
            'date_time' => date('d-m-Y H:i:s')
        );
        $this->db->insert('posting_status', $posts);
    }

    function check_repeat_status() {
        $this->db->select_max('repeat_status');
        $this->db->where('labref', $this->uri->segment(3));
        $this->db->where('test_name', 'uniformity');
        $query = $this->db->get('tests_done');
        return $result = $query->result();
    }

    function save_test() {
        $labref = $this->uri->segment(3);
        $priority = $this->findPriority($labref);
        $urgency = $priority[0]->urgency;
        $data1 = $this->getAnalystId();
        $supervisor_id = $data1[0]->supervisor_id;

        $data = $this->check_repeat_status();
        $r_status = $data[0]->repeat_status;
        $new_r_status = $r_status + 1;
        $analyst_id = $this->session->userdata('user_id');

        $final_test_done = array(
            'labref' => $labref,
            'test_name' => 'uniformity',
            'repeat_status' => $new_r_status,
            'supervisor_id' => $supervisor_id,
            'test_subject' => 'uniformity_r',
            'analyst_id' => $analyst_id,
            'priority' => $urgency
        );
        // $this->db->insert('tests_done',$final_test_done);
    }

    function updateSampleSummary() {
        $labref = $this->uri->segment(3);
        $data = array(
            'determined' => $this->input->post('comment'),
            'complies' => $this->input->post('comment')
        );
        $this->db->where('test_id', 6);
        $this->db->where('labref', $labref);
        $this->db->update('coa_body', $data);
    }

    function getAnalystId() {
        $analyst_id = $this->session->userdata('user_id');
        $this->db->select('supervisor_id');
        $this->db->where('analyst_id', $analyst_id);
        $query = $this->db->get('analyst_supervisor');
        return $result = $query->result();
        // print_r($result);
    }

    public function getUniformityTestRepeatStatus($labref) {
        $this->db->select_max('repeat_status');
        $this->db->where('labref', $labref);
        $query = $this->db->get('weight_caps_ta');
        return $row = $query->result();
    }

    public function tabs() {

        $data = array();
        $data['test_id'] = $id = $this->uri->segment(4);
        $uri = $this->uri->segment(3);
        $fulluri = $uri . '/' . $id;
        $data['labrefuri'] = $fulluri;
        $data['labref'] = $uri;
        $data['repeat_no'] = $this->getDoStatus();
        $data['settings_view'] = "tabs_v_custom";
        $data['lastworksheet'] = $this->getWorksheet() + 1;
        $this->base_params_tabs($data);
    }

    public function tabs_r() {
        $data['labref'] = $labref = $this->uri->segment(3);
        $data['r'] = $r = $this->uri->segment(4);
        $analyst_id = $this->session->userdata('user_id');
        $data['component'] = $c = $this->uri->segment(5);
        $data['no_of_pages'] = $this->printPages($labref);
        $data['tabs_results'] = $this->getTabs_v($labref, $r);
        $data['tabs_ta'] = $this->getTabsTotal($labref, $r);
        $module_name = $this->uri->segment(1);

        $data['done'] = $this->checkApproval($module_name, $labref, $r, $c);
        $username = $this->getAnalystData();
        $new = $username[0]->analyst_name;
        //$username=$user[0]->username;
        $this->session->set_userdata('mail_name', $new);
        $labref = $this->uri->segment(3);
        $module = $this->uri->segment(2);
        $this->session->set_userdata(array('labref' => $labref, 'module' => $module));
        $data['settings_view'] = 'tabs_r_v';
        $this->base_params($data);
    }

    public function uniformity_r() {
        $data['labref'] = $labref = $this->uri->segment(3);
        $data['r'] = $r = $this->uri->segment(4);
        $data['component'] = $c = $this->uri->segment(5);
        $module_name = $this->uri->segment(1);
        $data['done'] = $this->checkApproval($module_name, $labref, $r, $c);
        $analyst_id = $this->session->userdata('user_id');
        $data['caps_results'] = $this->getCaps_v($labref, $r);
        // print_r($data['caps_results']);
        $username = $this->getAnalystData();
        $new = $username[0]->analyst_name;
        //$username=$user[0]->username;
        $this->session->set_userdata('mail_name', $new);
        $labref = $this->uri->segment(3);
        $module = $this->uri->segment(2);
        $this->session->set_userdata(array('labref' => $labref, 'module' => $module));
        $data['caps_ta'] = $this->getUniformityTotal($labref, $r);
        $data['date_time'] = $this->getDate($labref, $r, $c);
        $data['settings_view'] = 'uniformity_r_v';
        $this->base_params($data);
    }

    function printPages($labref) {
        $dataSource = $this->UniformityPages($labref);
        $new_number = (int) $dataSource;
        return $numbers = range(1, $new_number);
    }

    function UniformityPages($labref) {

        $rawform = $this->justBringDosageForm($labref);
        $dosageForm = $rawform[0]->dosage_form;
        if ($dosageForm == "2") {
            $query = $this->db
                    ->where('labref', $labref)
                    ->get('weight_caps_ta')
                    ->num_rows();
            return $query;
        } else if ($dosageForm == "1") {
            $query = $this->db
                    ->where('labref', $labref)
                    ->get('weight_tablets_ta')
                    ->num_rows();
            return $query;
        }
    }

    function getAnalystData() {
        $supervisor_id = $this->session->userdata('user_id');
        $url = $this->uri->segment(3);
        $data1 = $this->getAnalystId_1($url);
        foreach ($data1 as $data) {
            $analyst_id = $data->analyst_id;
            $this->db->where('analyst_id', $analyst_id);
            $this->db->where('supervisor_id', $supervisor_id);
            $query = $this->db->get('analyst_supervisor');
            $result = $query->result();
        }
        return $result;
        //print_r($result);
    }

    function getAnalystId_1($url = '') {
        $supervisor_id = $this->session->userdata('user_id');
        $this->db->select('analyst_id');
        $this->db->where('supervisor_id', $supervisor_id);
        $this->db->where('labref', $url);
        $query = $this->db->get('tests_done');
        return $result = $query->result();
    }

    function getUsername() {
        $this->db->select('analyst_name');
        $this->db->where('supervisor_id', $this->session->userdata('user_id'));
        $query = $this->db->get('analyst_supervisor');
        return $result = $query->result();
    }

    function getTabs_v($labref, $r) {

        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $query = $this->db->get('weight_tablets');
        return $result = $query->result();
        //print_r($result);
    }

    function getTabs_uv($labref, $r) {

        $this->db->where('labref', $labref);
        $this->db->where('r_status', $r);
        $query = $this->db->get('weight_uniformity');
        return $result = $query->result();
        //print_r($result);
    }

    function getTabsTotal($labref, $r) {
        $labref = $this->uri->segment(3);
        $r = $this->uri->segment(4);
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $query = $this->db->get('weight_tablets_ta');
        return $result = $query->result();
        //print_r($result);
    }

    function getCaps_v($labref, $r) {
        $labref = $this->uri->segment(3);
        $r = $this->uri->segment(4);
        $this->db->where('labref', $labref);
        $this->db->where('r_status', $r);
        $query = $this->db->get('weight_uniformity');
        return $result = $query->result();
        // print_r($result);
    }

    function getUniformityTotal($labref, $r) {
        $labref = $this->uri->segment(3);
        $r = $this->uri->segment(4);
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $query = $this->db->get('weight_caps_ta');
        return $result = $query->result();
        //  print_r($result);
    }

    public function approve_data() {
        $labref = $this->uri->segment(3);
        $r = $this->uri->segment(4);
        $c = $this->uri->segment(5);
        $supervisor_id = $this->session->userdata('user_id');
        $supervisor = $this->getSupervisorName();
        //print_r($supervisor);
        $supervisor_name = $supervisor[0]->fname . " " . $supervisor[0]->lname;
        $analyst = $this->getAnalystName();
        $analyst_name = $analyst[0]->analyst_name;
        $priority = $this->findPriority($labref);
        $urgency = $priority[0]->urgency;
        $approve_data = array(
            'supervisor_name' => $supervisor_name,
            'analyst_name' => $analyst_name,
            'labref' => $labref,
            'repeat_status' => $r,
            'test_name' => 'uniformity',
            'component_no' => $c,
            'test_product' => 'forwetchemistry',
            'supervisor_id' => $supervisor_id,
            'user_type' => '5',
            'status' => '1',
            'priority' => $urgency
        );
        $this->db->insert('supervisor_approvals', $approve_data);

        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $this->db->where('component_no', $c);
        $this->db->where('test_name', 'uniformity');
        $this->db->update('tests_done', array('approval_status' => '1'));


        $this->compareToDecide($labref);

        redirect('supervisors/home/' . $this->session->userdata('lab'));
    }

    public function approve() {
        $labref = $this->uri->segment(3);
        $r = $this->uri->segment(4);
        $c = $this->uri->segment(5);
        $status = '1';
        $this->db->select('status');
        $this->db->where('status', $status);
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $this->db->where('component_no', $c);
        $this->db->where('test_name', 'uniformity');

        $query = $this->db->get('supervisor_approvals');
        if ($query->num_rows() > 0) {
            echo 'Already Approved';
        } else {
            $this->approve_data();
        }
    }

    function justBringDosageForm($labref) {
        $this->db->select('dosage_form');
        $this->db->from('dosage_form df');
        $this->db->join('request r', 'df.id=r.dosage_form');
        $this->db->where('r.request_id', $labref);
        $query = $this->db->get();
        return $result = $query->result();
        //print_r($result);
    }

    public function getSupervisorName() {
        $supervisor_id = $this->session->userdata('user_id');
        $this->db->where('id', $supervisor_id);
        $query = $this->db->get('user');
        return $result = $query->result();
        //print_r($result);
    }

    public function getAnalystName() {
        $supervisor_id = $this->session->userdata('user_id');
        $this->db->where('supervisor_id', $supervisor_id);
        $query = $this->db->get('analyst_supervisor');
        return $result = $query->result();
        //print_r($result);
    }

    function findPriority($labref) {
        $this->db->select('urgency');
        $this->db->where('request_id', $labref);
        $query = $this->db->get('request');
        $result = $query->result();
        return $result;
    }

    public function getUniRepeatStatus($labref) {
        $this->db->select_max('r_status');
        $this->db->where('labref', $labref);
        $query = $this->db->get('weight_uniformity');
        return $row = $query->result();
        // print_r($row);  
    }

    function repeats($labref) {
        echo json_encode(
                $this->db
                        ->select('repeat_status')
                        ->where('labref', $labref)
                        ->get('caps_tabs_data')
                        ->result()
        );
    }

    public function base_params($data) {
        $uri = $this->uri->segment(3);
        $data['title'] = "Weights and uniformity :" . $uri;
        $data['styles'] = array("jquery-ui.css");
        $data['scripts'] = array("jquery-ui.js");
        $data['scripts'] = array("SpryAccordion.js");
        $data['styles'] = array("SpryAccordion.css");
        $data['quick_link'] = "uniformity";
        $data['content_view'] = "settings_v";
        $data['banner_text'] = "NQCL Settings";
        $data['link'] = "settings_management";

        $this->load->view('template', $data);
    }

    public function base_params_tabs($data) {
        $uri = $this->uri->segment(3);
        $data['title'] = "Weights and uniformity - Tabs:" . $uri;
        $data['styles'] = array("jquery-ui.css");
        $data['scripts'] = array("jquery-ui.js");
        $data['scripts'] = array("SpryAccordion.js");
        $data['styles'] = array("SpryAccordion.css");
        $data['quick_link'] = "uniformity";
        $data['content_view'] = "settings_v";
        $data['banner_text'] = "NQCL Settings";
        $data['link'] = "settings_management";

        $this->load->view('template', $data);
    }

}
