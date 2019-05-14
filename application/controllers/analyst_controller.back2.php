<?php
include APPPATH . 'third_party/FPDF/fpdf17/fpdf.php';
include APPPATH . 'third_party/FPDF/FPDI/fpdi.php';


class Analyst_Controller extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library(array('excel', 'Word'));
    }
  
	
	function check_file(){
		$labref=$this->input->post('ndq_number');
		$filename = 'Workbooks/'.$labref.'/'.$labref.'.xlsx';

if (file_exists($filename)) {
    echo "The file $labref.xlsx  exists, if you suspect it's a different error, please contact the system Administrator <a href=\"http://192.168.1.41/NQCL/analyst_controller\">Back</a> ";
} else {
    echo "ERROR: $labref.xlsx  does not exist, You will need to create it, Do you want to do that now <a href=\"http://192.168.1.41/NQCL/analyst_controller/create_sample_folder/$labref\">Yes</a> || <a href=\"http://192.168.1.41/NQCL/analyst_controller\">No</a>";
}
	}
        
        function doTest($labref, $test_id) {
              $data['labref'] = $labref;
              $data['test_id'] = $test_id;
              
                $data['test_name'] =  $this->getTest($test_id);
           $data['settings_view'] = "microbiology_tv";       
        $this->base_params($data); 
        }
        
        function getTest($id) {
            return $this->db->where('id',$id)->get('tests')->result();
        }
	
	 public function create_sample_folder($labref) {
        $workbooks = "Workbooks";
        if (is_dir($workbooks)) {
            mkdir($workbooks . "/" . $labref, 0777, true);
            $this->create_workbook($labref);
        }
    }
	
	  public function create_workbook($labref) {
        $workbooks = "Workbooks";
        $target = "original_workbook/Template1.xlsx";
        $destination = "Workbooks/" . $labref . "/" . $labref . ".xlsx";
        if (is_dir($workbooks . "/" . $labref)) {
            copy($target, $destination);
        }
        echo "The file $labref.xlsx  has been succesfully created, you can now try to re-perform your previous actions. Go <a href=\"http://192.168.1.41/NQCL/analyst_controller\">Back</a> ";
    }

    function check_workbook() {
        $data['settings_view'] = "analyst_workbook";
        $this->base_params($data);
    }

        function worksheet_center() {
        $data['settings_view'] = "worksheet_center";
        $data['sheets'] = $this->pdfs();
        $this->base_params($data);
    }

    function my_repo() {
        $data['settings_view'] = "worksheet_repo";
        $data['sheets'] = $this->mypdfs();
        $this->base_params($data);
    }
    
    function worksheet_processor($an,$alias) {
        $data['settings_view'] = "worksheet_processor";
        $data['an']=$an;
        $data['al']=$alias;
        $data['labrefs']=  $this->loadLabrefBatch();
        $data['sheets'] = $this->mypdfs();
        $this->base_params($data);
    }

    function worksheet_uploads() {
        $data['settings_view'] = "worksheet_uploader";
        $this->base_params($data);
    }

    function pdfs() {
        $id = $this->session->userdata('user_id');
        return $this->db->where('analyst_id',$id)->get('pdf_test_generator')->result();
    }

    function mypdfs() {
        $analyst_id = $this->session->userdata('user_id');
        return $this->db->where('analyst_id', $analyst_id)->get('worksheet_center')->result();
    }

    function upload() {
          // $w_name = $this->input->post('wkname');
       
        $id = $this->session->userdata('user_id');
        $fdir = "pdfcenter/" . $id;
        if (is_dir($fdir)):
        else:
            mkdir($fdir, 777);
        endif;
      

            $config['upload_path'] = $fdir;          
            $config['allowed_types'] = 'pdf';
            $config['overwrite'] = TRUE;

            $this->load->library('upload', $config);



            if (!$this->upload->do_upload('worksheet')) {
                $data['error'] = $this->upload->display_errors();
                $data['sheets'] = $this->mypdfs();
                $data['settings_view'] = 'worksheet_uploader';
                $this->base_params($data);
            } else {
                $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
                $w_name = $upload_data['file_name'];
                $nname = explode(".", $w_name);                
                $sname = $this->sanitize_name($nname[0]);
                $this->SaveWorksheet($w_name, $sname, $id);
                $data['success'] = 'Worksheet Successfully Uploaded';
                $data['sheets'] = $this->mypdfs();
                $data['settings_view'] = 'worksheet_repo';
                $this->base_params($data);
            }
        
    }
    

    
      function delete_m($id,$alias) {
        $this->db->where('id', $id)->delete('worksheet_center');
        unlink('pdfcenter/' . $alias. '.pdf');
        redirect('analyst_controller/my_repo');
    }
    

    public function SaveWorksheet($filename, $alias, $id) {
        $this->db->where('alias',$alias)->delete('worksheet_center');
        $file_details = array(
            'filename' => $filename,
            'analyst_id' => $id,
            'alias' => $alias,
        );
        $this->db->insert('worksheet_center', $file_details);
    }
    
    function process_batch($an,$alias){
        $da = explode("_", $alias);        
        $full= str_replace($da[0],'',$alias);
        
            
        
        $data = $this->input->post('labref');
        for($i=0;$i<count($data);$i++):
            $this->db->where('request_id',$data[$i])->delete('pdf_test_generator');
            $array = array(
                'request_id'=>$data[$i],
                'test_id'=>'11111',
                'full_name'=>$data[$i].$full,
                'analyst_id'=>$an                
            );
         $this->db->insert('pdf_test_generator',$array);
        $this->makeCopy($an,$alias,$full,$data[$i]);
        endfor;
        echo 'Batch Process Successfully Completed';
       
    }


    
    function makeCopy($an,$alias,$full,$labref){
        $source = 'pdfcenter/'.$an.'/'.$alias.'.pdf';
        $destination = 'samplepdfs/'.$labref.$full.'.pdf';  
        copy($source, $destination);
    }

    function setDone($labref) {
        $analyst_id = $this->session->userdata('user_id');
        $this->db
                ->where('lab_ref_no', $labref)
                ->where('analyst_id', $analyst_id)
                ->update('sample_issuance', array('completion' => '1'));
    }

    function count_messages($id) {
        return $this->db->where('reciever', $id)->where('recieved', '0')->count_all_results('messages');
    }

    function getRequirementStatus($labref) {
        $count = $this->db->where('labref', $labref)->where('equip_status', '1')->get('sample_issuance')->result();
        return $count[0]->equip_status;
    }

    function success($labref) {
        $data['settings_view'] = "analyst_gen";
        $data['labref'] = $labref;
        $this->base_params($data);
    }
    
     function generation_success($labref) {
        $data['settings_view'] = "analyst_gen_1";
        $data['labref'] = $labref;
        $this->base_params($data);
    }
    
    function show_tests($labref){
        $data['TD']=  $this->loadTestsDone($labref);
        $this->load->view('tests_done_gen',$data);
    }

    function mergePDF($labref) {
        if (file_exists('worksheets/' . $labref . '.pdf')) {
            unlink('worksheets/' . $labref . '.pdf');
        } else {
            
        }
      //  $this->RegisterStandards($labref);
        $pdf = $this->pdfMerger();
        $hdform = array('sf');
        $selector = $this->input->post('test_names');
        $ftform = array('reeq','track');
        $whole_array = array_merge($hdform, $selector, $ftform);
        foreach ($whole_array as $file):
            $pdf->addPDF('samplepdfs/' . $file . '.pdf', 'all');
        endforeach;
        $pdf->merge('file', 'worksheets/' . $labref . '.pdf');
        //$this->wholesheet_stamp($labref);
        // redirect('samplepdfs/' . $labref . '.pdf');
        // $this->wholesheet_stamp($labref);
    }
    
       function mergePDFCompleted($labref) {
        if (file_exists('worksheets_completed/' . $labref . '.pdf')) {
            unlink('worksheets_completed/' . $labref . '.pdf');
        } else {
            
        }
        $this->RegisterReagentsUsed($labref);
		$this->RegisterStandards($labref);
        $pdf = $this->pdfMerger();
        $hdform = array('sf');
        $selector = $this->input->post('test_names');
        $ftform = array($labref.'_track',$labref.'_tracking');
        $whole_array = array_merge($hdform, $selector, $ftform);
        foreach ($whole_array as $file):
            $pdf->addPDF('samplepdfs/' . $file . '.pdf', 'all');
        endforeach;
        $pdf->merge('file', 'worksheets_completed/' . $labref . '.pdf');
        //$this->wholesheet_stamp($labref);
        // redirect('samplepdfs/' . $labref . '.pdf');
        // $this->wholesheet_stamp($labref);
    }

    function get_onesheet($sheet_name, $labref) {

        $this->singlesheet_stamp($labref, $sheet_name);
    }

    function loadTests() {
        return $this->db->select('id, name,LOWER(alias) as alias')->get('worksheet_tests')->result();
    }
    
      function loadTestsDone($labref) {
          $id = $this->session->userdata('user_id');
        echo json_encode( $this->db->where('request_id',$labref)->where('analyst_id',$id)->select('id, full_name')->get('pdf_test_generator')->result());
    }

    function load() {
        $hdform = array('sf');
        $selector = $this->input->post('test_names');
        $ftform = array('reeq', 'track');

        $whole_array = array_merge($hdform, $selector, $ftform);
        foreach ($whole_array as $test):
            print_r($test);
        endforeach;
    }

    public function index() {
        // error_reporting(0);
        if ($this->checkIfHasASupervisor() === '1') {
            $data = array();
            $data['settings_view'] = "analyst_v";

            $userarray = $this->session->userdata;
            $user_id = $userarray['user_id'];
            $data['msg_counter']=  $this->count_messages($user_id);
            $data['monographs'] = Monographs::getAll();
            $data['tests_assigned'] = Sample_issuance::getTests($user_id);
            $data['testnames'] = Tests::getTestNames($user_id);
            $data['labrefs'] = $this->loadLabref();
            $data['sheets'] = $this->loadSheets();
            $data['T'] = $this->loadTests();
           
            //$results=$this->get_tests();
            //var_dump($results);
            $this->base_params($data);
        } else {
            // $this->checkIfHasASupervisor();
            $data['settings_view'] = "analyst_v_error";
            $this->base_params($data);
        }
    }
    
    
       public function index_completed() {
        // error_reporting(0);
        if ($this->checkIfHasASupervisor() === '1') {
            $data = array();
            $data['settings_view'] = "analyst_v_2";

            $userarray = $this->session->userdata;
            $user_id = $userarray['user_id'];
            $data['msg_counter']=  $this->count_messages($user_id);
            $data['monographs'] = Monographs::getAll();
            $data['tests_assigned'] = Sample_issuance::getTests_completed($user_id);
            $data['testnames'] = Tests::getTestNames($user_id);
            $data['labrefs'] = $this->loadLabref();
            $data['sheets'] = $this->loadSheets();
            $data['T'] = $this->loadTests();
           
            //$results=$this->get_tests();
            //var_dump($results);
            $this->base_params($data);
        } else {
            // $this->checkIfHasASupervisor();
            $data['settings_view'] = "analyst_v_error";
            $this->base_params($data);
        }
    }
    
    function set_completion(){
        $analyst_id = $this->session->userdata('user_id');
        $labref = $this->input->post('set_done');
        for($i=0;$i<count($labref);$i++){
            $update_array=array(
              'completion' => '1' 
            );
            $this->db->where('lab_ref_no',$labref[$i])
                    ->where('analyst_id',$analyst_id)
                    
                    ->update('sample_issuance',$update_array);
        }
        echo 'Update Success';
    }
    

    function save($labref) {
        echo 'yes';
    }

    function getDownloadCounter($labref, $test) {
        $count = $this->db->where('labref', $labref)->where('test', $test)->get('analyst_download_counter')->num_rows();
        $counter = array('count' => $count);
        echo json_encode($counter);
    }

    function loadfinal() {
        $data['final_submission'] = $this->retrieveFinalSubmission();
        $data['settings_view'] = 'final_submission_v';
        $this->base_params($data);
    }

    function getMicroNumber($labref) {
        echo json_encode($this->db->where('labref', $labref)->get('microbiology_tracking')->result());
    }
	
	
	   function RegisterStandards($labref) {
        if (file_exists('samplepdfs/'.$labref.'_CHROMATOGRAPHIC_CONDITIONS.pdf')) {
            unlink('samplepdfs/'.$labref.'_CHROMATOGRAPHIC_CONDITIONS.pdf');
        } else {
           // echo 'Not found';
        }
        $standards = $this->getStandards($labref);
        $c_conds_assay = $this->getColumnsChromaCA($labref);
        $c_conds_diss = $this->getColumnsChromaCD($labref);

        $full_name = 'samplepdfs/HPLC_Conditions__Assay___Dissolution_.pdf';     
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
            $pdf->SetFontSize(9);
            
            //chromatographic conditions assay
          $pdf->SetXY(70, 52);
          $pdf->Write(1, $c_conds_assay[0]->column_no);
          $pdf->SetXY(125, 52);
          $pdf->Write(1, $c_conds_assay[0]->column_type.", ".$c_conds_assay[0]->column_dimensions);
          $pdf->SetXY(70, 58);
          $pdf->Write(1, $c_conds_assay[0]->column_temp);
          $pdf->SetXY(70, 63);
          $pdf->Write(1, $c_conds_assay[0]->detection);
          $pdf->SetXY(128, 63);
          $pdf->Write(1, $c_conds_assay[0]->injection);
          $pdf->SetXY(25, 79);
          $pdf->MultiCell(90, 3, $c_conds_assay[0]->mobile_phase, 0,'L');
          $pdf->SetXY(178, 79);
          $pdf->Write(1, $c_conds_assay[0]->flow_rate);
          $pdf->SetXY(178, 85);
          $pdf->Write(1, $c_conds_assay[0]->pump_pressure);
          
          
            //chromatographic conditions dissolution
          $pdf->SetXY(70, 109);
          $pdf->Write(1, $c_conds_diss[0]->column_no);
          $pdf->SetXY(125, 109);
          $pdf->Write(1, $c_conds_diss[0]->column_type.", ".$c_conds_diss[0]->column_dimensions);
          $pdf->SetXY(70, 115);
          $pdf->Write(1, $c_conds_diss[0]->column_temp);
          $pdf->SetXY(70, 120);
          $pdf->Write(1, $c_conds_diss[0]->detection);
          $pdf->SetXY(128, 120);
          $pdf->Write(1, $c_conds_diss[0]->injection);
          $pdf->SetXY(25, 137);
          $pdf->MultiCell(63, 2, $c_conds_diss[0]->mobile_phase, 0,'L');

          $pdf->SetXY(178, 137);
          $pdf->Write(1, $c_conds_diss[0]->flow_rate);
          $pdf->SetXY(178, 142);
          $pdf->Write(1, $c_conds_diss[0]->pump_pressure);
            
            
            
            
            
            
            $xa=1;
            $ya=(int)172;
                $pdf->SetFontSize(10);
           for($s=0; $s<count($standards);$s++){

            $pdf->SetXY(38, $ya+=7);
            $pdf->Write(1, $standards[$s]->name);
            
            $pdf->SetXY(115, $ya);
            $pdf->Write(1, $standards[$s]->rs_code);
            
            $pdf->SetXY(160, $ya);
            $pdf->Write(1, round($standards[$s]->potency,4));
            
              
            }
       





            $i++;
        } while ($i <= $pagecount);
        $pdf->Output('samplepdfs/'.$labref.'_CHROMATOGRAPHIC_CONDITIONS.pdf', 'F');
        $test_id ='500';
        $analyst_id = $this->session->userdata('user_id');
         $this->deletePDFgen($labref, $test_id, $analyst_id);
          $pdf_name=$labref.'_CHROMATOGRAPHIC_CONDITIONS';
          $this->insertPDFgen($labref, $pdf_name, $test_id, $analyst_id);
    
    }

    function checkIfWorksheetExists($labref, $sheetName) {

        $data = $this->getLastWorksheet();
        $worksheetIndex = $data[0]->no_of_sheets;

        $sanitized_sheet = str_replace("_", " ", $sheetName);
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load("workbooks/" . $labref . "/" . $labref . ".xlsx");
        $sheets = $objPHPExcel->getSheetNames();
        if (in_array($sanitized_sheet, $sheets, true)) {
            $this->setWindowsUserAndDeleteLocalExcelWorbook($labref);
            redirect('workbooks/' . $labref . '/' . $labref . '.xlsx');
        } else {
            $objPHPExcel->createSheet();
            $objPHPExcel->setActiveSheetIndex($worksheetIndex);
            $objPHPExcel->getActiveSheet()->setTitle('component');
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");
            $this->updateWorksheetNo();
            $test_id = $this->uri->segment(5);
            $this->setDoneStatus($labref, $test_id);
            $this->setWindowsUserAndDeleteLocalExcelWorbook($labref);
            redirect('workbooks/' . $labref . '/' . $labref . '.xlsx');
            //redirect('analyst_controller');
        }
    }

    function loadLabref() {
        $analyst_id = $this->session->userdata('user_id');
        return $this->db->select('lab_ref_no')->where('analyst_id', $analyst_id)->group_by('lab_ref_no')->get('sample_issuance')->result();
    }

    function loadsheets() {

        return $this->db->where('w_chem', 1)->get('tests')->result();
    }

    function checkIfWorksheetExists_extra($labref, $sheet_name) {
        $analyst_id = $this->session->userdata('user_id');
        $query = $this->db->where('labref', $labref)->where('sheet_name', $sheet_name)->get('custom_sheets')->num_rows();
        if ($query == '0') {
            $this->db->insert('custom_sheets', array('labref' => $labref, 'sheet_name' => $sheet_name, 'analyst_id' => $analyst_id));
            $this->stamp($labref, $sheet_name);
        } else {
            $this->stamp($labref, $sheet_name);
        }
    }

    function checkMicrobiology($labref, $sheet_name) {
        $analyst_id = $this->session->userdata('user_id');
        $query = $this->db->where('labref', $labref)->where('sheet_name', $sheet_name)->get('custom_sheets')->num_rows();
        if ($query == '0') {
            $this->db->insert('custom_sheets', array('labref' => $labref, 'sheet_name' => $sheet_name, 'analyst_id' => $analyst_id));
            $this->postData($labref, $sheet_name);
        } else {
            $this->postData($labref, $sheet_name);
        }
    }

    function upload_microbial_assay() {
        $data['test_name'] = $this->uri->segment(2);
        $data['labref'] = $this->uri->segment(3);
        $data['test_id'] = $this->uri->segment(4);
        $data['error'] = '';
        $data['settings_view'] = 'upload_v_micro';
        $this->base_params($data);
    }
    
    
     function upload_microbial_assay_s() {
        $data['test_name'] = $this->uri->segment(2);
        $data['labref'] = $this->uri->segment(3);
        $data['test_id'] = $this->uri->segment(4);
        $data['error'] = '';
        $data['settings_view'] = 'upload_v_micro_1';
        $this->base_params($data);
    }

    function upload_micro_be() {
        $data['test_name'] = $this->uri->segment(2);
        $data['labref'] = $this->uri->segment(3);
        $data['test_id'] = $this->uri->segment(4);
        $data['error'] = '';
        $data['settings_view'] = 'upload_v_microbe';
        $this->base_params($data);
    }
    
        function upload_micro_be_s() {
        $data['test_name'] = $this->uri->segment(2);
        $data['labref'] = $this->uri->segment(3);
        $data['test_id'] = $this->uri->segment(4);
        $data['error'] = '';
        $data['settings_view'] = 'upload_v_microbe_1';
        $this->base_params($data);
    }

    function postData($labref, $sheet_name) {

        $component = $this->input->post('component');
        $sample_name = $this->input->post('sample_name');
        $micro_lab_number = $this->input->post('micro_lab_number');
        $date_recieved = $this->input->post('date_recieved');
        $date_test_set = $this->input->post('date_test_set');
        $date_of_result = $this->input->post('date_of_result');
        $label_claim = $this->input->post('labelclaim');
        $qty = $this->input->post('qty');
        $unit = $this->input->post('unit');
        $test_id = $this->input->post('test_id');


        $download = $this->getDownloadCount($labref, $sheet_name);
        $analyst_id = $this->session->userdata('user_id');
        $names = $this->getAnalyst($analyst_id);
        $full_names = $names[0]->fname . " " . $names[0]->lname;
        $footer = $labref . ' / ' . ucfirst(str_replace('_', ' ', $sheet_name)) . ' / Download ' . $download . '  /  Analyst - ' . $full_names . ' /  Date ' . date('d-m-Y');


        $sanitized_sheet = str_replace("_", " ", $sheet_name);
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load("microbiology_custom_worksheets/" . $sheet_name . ".xlsx");
        $objPHPExcel->getActiveSheet(0);
        $objPHPExcel->getActiveSheet()
                ->setCellValue('B13', ucfirst($component) . " Microbial Assay")
                ->setCellValue('B14', ucwords($sample_name))
                ->setCellValue('B15', $labref)
                ->setCellValue('B16', ucfirst($component))
                ->setCellValue('B17', ucfirst('Each ' . $unit . ' ml contains' . $qty . ' mg of ' . $label_claim))
                ->setCellValue('B18', $date_test_set)
                ->setCellValue('B19', $date_of_result)
                ->setCellValue('A12', 'MICOBIOLOGY NO.')
                ->setCellValue('B12', $micro_lab_number)
                ->setCellValue('C12', 'DATE RECEIVED')
                ->setCellValue('D12', $date_recieved);
        $objPHPExcel->getActiveSheet()->setTitle('component');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B ' . $footer . " " . $objPHPExcel->getProperties()->getTitle() . '&RPage &P of &N');
        if ($test_id == '50') {
            $objWriter->save("microbio_worksheets/" . $labref . "_microlal.xlsx");
        } else if ($test_id == '49') {
            $objWriter->save("microbio_worksheets/" . $labref . "_micro.xlsx");
        }

        $this->updateDownloadCount($labref, $sheet_name);
        $this->updateUploadStatus($labref, $test_id);
        $this->setDoneStatus($labref, $test_id);


        // redirect("microbio_worksheets/" . $labref . '_' . $sheet_name . ".xlsx");
    }

    function getSheet() {

        $data = $this->getLastWorksheet();
        $worksheetIndex = $data[0]->no_of_sheets;

        $sanitized_sheet = str_replace("_", " ", $sheetName);
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load("workbooks/" . $labref . "/" . $labref . ".xlsx");
        $sheets = $objPHPExcel->getSheetNames();
        if (in_array($sanitized_sheet, $sheets, true)) {
            $this->setWindowsUserAndDeleteLocalExcelWorbook($labref);
            redirect('workbooks/' . $labref . '/' . $labref . '.xlsx');
        } else {
            $objPHPExcel->createSheet();
            $objPHPExcel->setActiveSheetIndex($worksheetIndex);
            $objPHPExcel->getActiveSheet()->setTitle($sanitized_sheet);
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");
            $this->updateWorksheetNo();
            $test_id = $this->uri->segment(5);
            $this->setDoneStatus($labref, $test_id);
            $this->setWindowsUserAndDeleteLocalExcelWorbook($labref);
            redirect('workbooks/' . $labref . '/' . $labref . '.xlsx');
            //redirect('analyst_controller');
        }
    }

    function singlesheet_stamp($labref, $sheet_name) {
        if (file_exists('single_sheets/' . $sheet_name . '.pdf')) {
            unlink('single_sheets/' . $sheet_name . '.pdf');
        } else {
            echo 'Not found';
        }
        //$download = 1;
        $this->checkDownloadData($sheet_name, $labref);
        $query = $this->db->where('labref', $labref)->where('name', $sheet_name)->get('worksheet_monitor')->result();
        $pre = $query[0]->counter;
        $download = $pre;
        $analyst_id = $this->session->userdata('user_id');
        $d_reason = $this->input->post('reasons');
        $names = $this->getAnalyst($analyst_id);
        $full_names = $names[0]->fname . " " . $names[0]->lname;

        $full_name = 'samplepdfs/' . $sheet_name . '.pdf';
        $this->post_reason($labref, $sheet_name, $analyst_id, $d_reason, $download,$full_names);
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
            $pdf->SetFontSize(7);

            $pdf->SetXY(30, 265);
            $pdf->Write(1, $labref . ' / ' . ucfirst(str_replace('_', ' ', $sheet_name)) . ' / Download ' . $download . '  /  Analyst - ' . $full_names . ' /  Date ' . date('d-m-Y'));
            $pdf->SetXY(160, 265);
            $pdf->Write(1, 'Page ' . $pdf->PageNo() . ' of {nb}');
            $pdf->SetXY(10, 268);
            $pdf->Write(1, 'DOWNLOAD REASON:' . $d_reason);





            $i++;
        } while ($i <= $pagecount);
        $pdf->Output('single_sheets/' . $sheet_name . '.pdf', 'F');
    }

    function stamp_addendum($labref) {
        $selector = $this->input->post('test_names');
        $s_name = $selector[0];
        if (file_exists('samplepdfs/' .$labref.'_'.$s_name . '.pdf')) {
            unlink('samplepdfs/' . $labref.'_'.$s_name . '.pdf');
        } else {
            echo $s_name;
        }
        //$download = 1;
       
        $analyst_id = $this->session->userdata('user_id');
      
        $names = $this->getAnalyst($analyst_id);
        $full_names = $names[0]->fname . " " . $names[0]->lname;

        $full_name = 'samplepdfs/' . $s_name . '.pdf';
 
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
            $pdf->SetFontSize(7);

            $pdf->SetXY(30, 265);
            $pdf->Write(1, $labref . ' / ' . ucfirst(str_replace('_', ' ', $s_name)) . '  /  Analyst - ' . $full_names . ' /  Date ' . date('d-m-Y'));
            $pdf->SetXY(160, 265);
            $pdf->Write(1, 'Page ' . $pdf->PageNo() . ' of {nb}');
         





            $i++;
        } while ($i <= $pagecount);
        $pdf->Output('single_sheets/' . $labref.'_'.$s_name . '.pdf', 'F');
    }
    
      
    
         function RegisterReagentsUsed($labref) {
        if (file_exists('samplepdfs/'.$labref.'_track.pdf')) {
           unlink('samplepdfs/'.$labref.'_track.pdf');
        } else {
           // echo 'Not found';
        }
        $reagent = $this->getReagentsBP($labref);
        $equipment = $this->getEquipmentBP($labref);

        $full_name = 'samplepdfs/reeq.pdf';     
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

            $pdf->SetFont('Arial','B');
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetFontSize(6);
            
            $xa=1;
            $ya1=(int)58;
            
            for($r=0; $r<count($reagent);$r++){

            $pdf->SetXY(31, $ya1+=9);
            $pdf->Write(1, $reagent[$r]->name);
            
           $pdf->SetXY(80, $ya1);
            $pdf->Write(1, $reagent[$r]->manufacturer);
           
            $pdf->SetXY(110, $ya1);
            $pdf->Write(1, $reagent[$r]->batch_no);
            
              
          }
          
               $xa=1;
            $ya3=(int)153;
            
           for($e=0; $e<count($equipment);$e++){

            $pdf->SetXY(31, $ya3+=10);
            $pdf->Write(1, $equipment[$e]->name);
            
           $pdf->SetXY(83, $ya3);
            $pdf->Write(1, $equipment[$e]->nqcl_no);
           
          }
       
       





            $i++;
        } while ($i <= $pagecount);
        $pdf->Output('samplepdfs/'.$labref.'_track.pdf', 'F');
          $this->RegisterInitialTracking($labref);
        echo 'Done';
    }
    

    
    
     function RegisterInitialTracking($labref) {
        if (file_exists('samplepdfs/' . $labref. '_tracking.pdf')) {
            unlink('samplepdfs/' . $labref. '_tracking.pdf');
        } else {
           // echo 'Not found';
        }
	
        $analyst_id = $this->session->userdata('user_id');
        $supervisor = $this->getSupervisorID($analyst_id);
       $trackingIssuing = $this->getTrackingIssuing($labref);
        $trackingAnalysis = $this->getTrackingAnalysis($labref,$analyst_id);

        $full_name = 'samplepdfs/track.pdf';     
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

            $pdf->SetFont('Arial','B');
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetFontSize(7);
            
            $xa=1;
            $ya1=(int)166;
             $ya2=(int)173;
            
           // for($t=0; $r<count($tracking);$t++){

            $pdf->SetXY(31, $ya1);
            $pdf->Write(1, $trackingIssuing[0]->activity);
            
             $pdf->SetXY(62, $ya1);          
             $pdf->Write(1, $trackingIssuing[0]->by);
            
            
               $pdf->SetXY(115, $ya1);
              $pdf->Write(1, $trackingAnalysis[0]->by);
            
              $pdf->SetXY(172, $ya1);
            $pdf->Write(1, $trackingIssuing[0]->date_issued);
            
              // $pdf->SetXY(31, $ya2);
            // $pdf->Write(1, $tracking[1]->activity);
            
             // $pdf->SetXY(62, $ya2);
            // $pdf->Write(1, $tracking[1]->by);
            
               // $pdf->SetXY(115, $ya2);
            // $pdf->Write(1, $supervisor[0]->supervisor_name);
            
        
            
            
//           $pdf->SetXY(80, $ya1);
//            $pdf->Write(1, $reagent[$r]->manufacturer);
//           
//            $pdf->SetXY(110, $ya1);
//            $pdf->Write(1, $reagent[$r]->batch_no);
            
              
        //  }
          
         
            $i++;
        } while ($i <= $pagecount);
        $pdf->Output('samplepdfs/'.$labref.'_tracking.pdf', 'F');
         
        echo 'Done';
    }
    

    function post_reason($labref, $test, $analyst_id, $reason, $counter) {
        $data_array = array(
            'labref' => $labref,
            'name' => $test,
            'analyst_id' => $analyst_id,
			
            'reason' => $reason,
            'counter' => $counter
        );
        $this->db->insert('worksheet_reason', $data_array);
        $this->db->insert('analyst_download_counter', array('labref' => $labref, 'test' => $test));
    }

    function post_request($labref, $test) {
        $analyst_id = $this->session->userdata('user_id');
        $names = $this->getAnalyst($analyst_id);
        $full_names = $names[0]->fname . " " . $names[0]->lname;
        $d_reason = $this->input->post('reasons');
        $snames = $this->getSupervisorID($analyst_id);
        $sid = $snames[0]->supervisor_id;
        $data_array = array(
            'labref' => $labref,
            'supervisor_id' => $sid,
            'analyst_id' => $analyst_id,
            'reason' => $full_names . " is seeking approval to download another sheet for " . $test . ",Reason: " . $d_reason
        );
        $this->db->insert('analyst_request', $data_array);
    }
	function Mog($labref){
		 return $this->db->where('request_id',$labref)->get('monograph_usage')->result();
	}

    function wholesheet_stamp($labref) {
        echo 'here';
        if (file_exists('worksheets_stamped/' . $labref . '.pdf')) {
            unlink('worksheets_stamped/' . $labref . '.pdf');
        }
        //$download = 1;
//        $this->checkDownloadData($sheet_name, $labref);
//        $query = $this->db->where('labref', $labref)->where('name', $sheet_name)->get('worksheet_monitor')->result();
//        $pre = $query[0]->counter;
//        $download = $pre;
        $sample_info = $this->loadSampleInfo($labref);
        $sample_count = $this->samples($labref);
		$mog = $this->Mog($labref);
        $tests = $this->load_tests($labref);
        $clients = $this->getRequestInformation($labref);
        $analyst_id = $this->session->userdata('user_id');
        $names = $this->getAnalyst($analyst_id);
        $full_names = $names[0]->fname . " " . $names[0]->lname;

        $full_name = 'worksheets/' . $labref . '.pdf';

        $pdf = new FPDI('P', 'mm', 'A4');
        $pdf->AliasNbPages();

        $pagecount = $pdf->setSourceFile($full_name);

        $i = 1;
        do {

            $j = $pdf->PageNo();
            // add a page
            $pdf->AddPage();
            // import page
            $tplidx = $pdf->ImportPage($i);

            $pdf->useTemplate($tplidx, 10, 10, 200);

            $pdf->SetFont('Arial','B','8');
            $pdf->SetTextColor(0, 0, 0);
            //$pdf->SetFontSize(8);

            if ($j == 0) {
                $pdf->SetXY(80, 69);
                $pdf->Write(1, $sample_info[0]->designation_date);
                $pdf->SetXY(158, 69);
                $pdf->Write(1, $sample_info[0]->request_id);
                $pdf->SetXY(83, 77);
                $pdf->Write(1, $sample_info[0]->product_name);

                $pdf->SetXY(83, 86);
                $pdf->Write(1, $sample_info[0]->active_ing);
               
                
                $pdf->SetXY(83, 99);
                $pdf->Write(1, $sample_info[0]->description);

                $pdf->SetXY(83, 117);
                $pdf->Write(1, $sample_info[0]->presentation);

                $pdf->SetXY(83, 130);				
                $pdf->MultiCell(70, 2, $sample_info[0]->label_claim, 0,'L');

                $pdf->SetXY(72, 144);
                $pdf->Write(1, $sample_info[0]->batch_no);
                $pdf->SetXY(158, 144);
                $pdf->Write(1, $sample_info[0]->product_lic_no);
                $pdf->SetXY(72, 150);
                $pdf->Write(1, $sample_info[0]->manufacture_date);

                $pdf->SetXY(158, 150);
                $pdf->Write(1, $sample_info[0]->exp_date);
                $pdf->SetXY(72, 156);
                $pdf->Write(1, $clients[0]->name);
                $pdf->SetXY(72, 162);
                $pdf->Write(1, $clients[0]->address);

                $pdf->SetXY(72, 168);
                $pdf->Write(1, $sample_info[0]->clientsampleref);

                $pdf->SetXY(72, 174);
                $pdf->Write(1, $sample_info[0]->manufacturer_name);

                $pdf->SetXY(72, 183);
                $pdf->Write(1, $sample_info[0]->country_of_origin);

                $pdf->SetXY(120, 183);
                $pdf->Write(1, $sample_count[0]->quantity_issued . " " . $sample_count[0]->sample_packaging);
                $k = 194;
                $t=194;
                for ($w = 0; $w < count($tests); $w++) {
                    $pdf->SetXY(40, $k+=6);
                    $pdf->Write(1, $tests[$w]->name);
                }
				
				  for ($y = 0; $y < count($mog); $y++) {
                    $pdf->SetXY(130, $t+=6);
                    $pdf->Write(1, $mog[$y]->comment);
					
                }
				

                $pdf->SetXY(58, 238);
                $pdf->Write(1, $full_names);

               
            }

            $pdf->SetXY(30, 265);
            $pdf->Write(1, $labref . ' /  Analyst - ' . $full_names . ' /  Date ' . date('d-m-Y'));
            $pdf->SetXY(160, 265);
            $pdf->Write(1, 'Page ' . $pdf->PageNo() . ' of {nb}');



            $i++;
        } while ($i <= $pagecount);
        $pdf->Output('worksheets_stamped/' . $labref . '.pdf', 'F');
         $this->db->where('lab_ref_no',$labref)->update('sample_issuance',array('download_status'=>'1'));
        redirect('worksheets_stamped/' . $labref . '.pdf');
    }
    
    function getlimits($labref){
      return $this->db->where('request_id',$labref)->get('request_details')->result();  
    }
    
    
    function wholesheet_stamped($labref) {
        
        if (file_exists('worksheets_stamped_gen/' . $labref . '.pdf')) {
            unlink('worksheets_stamped_gen/' . $labref . '.pdf');
        }
        //$download = 1;
//        $this->checkDownloadData($sheet_name, $labref);
//        $query = $this->db->where('labref', $labref)->where('name', $sheet_name)->get('worksheet_monitor')->result();
//        $pre = $query[0]->counter;
//        $download = $pre;
        $sample_info = $this->loadSampleInfo($labref);
        $sample_count = $this->samples($labref);
        $tests = $this->load_tests($labref);
        		$mog = $this->Mog($labref);
                        $limits = $this->getlimits($labref);
        $clients = $this->getRequestInformation($labref);
        $analyst_id = $this->session->userdata('user_id');
        $names = $this->getAnalyst($analyst_id);
        $full_names = $names[0]->fname . " " . $names[0]->lname;

        $full_name = 'worksheets_completed/' . $labref . '.pdf';

        $pdf = new FPDI('P', 'mm', 'A4');
        $pdf->AliasNbPages();

        $pagecount = $pdf->setSourceFile($full_name);

        $i = 1;
        do {

            $j = $pdf->PageNo();
            // add a page
            $pdf->AddPage();
            // import page
            $tplidx = $pdf->ImportPage($i);

            $pdf->useTemplate($tplidx, 10, 10, 200);

            $pdf->SetFont('Arial','B','8');
            $pdf->SetTextColor(0, 0, 0);
            //$pdf->SetFontSize(8);

            if ($j == 0) {
                $pdf->SetXY(80, 69);
                $pdf->Write(1, $sample_info[0]->designation_date);
                $pdf->SetXY(158, 69);
                $pdf->Write(1, $sample_info[0]->request_id);
                $pdf->SetXY(83, 77);                
				$pdf->MultiCell(118, 4, $sample_info[0]->product_name, 0,'L');

                $pdf->SetXY(83, 86);
                $pdf->Write(1, $sample_info[0]->active_ing);                
                         
                $pdf->SetXY(83, 99);
                $pdf->Write(1, $sample_info[0]->description);

                $pdf->SetXY(83, 117);
                $pdf->Write(1, $sample_info[0]->presentation);

                $pdf->SetXY(83, 129.5);
                $pdf->MultiCell(118, 4, $sample_info[0]->label_claim, 0,'L');

                $pdf->SetXY(72, 144);
                $pdf->Write(1, $sample_info[0]->batch_no);
                $pdf->SetXY(158, 144);
                $pdf->Write(1, $sample_info[0]->product_lic_no);
                $pdf->SetXY(72, 150);
                $pdf->Write(1, $sample_info[0]->manufacture_date);

                $pdf->SetXY(158, 150);
                $pdf->Write(1, $sample_info[0]->exp_date);
                //$pdf->SetXY(72, 156);
                //$pdf->Write(1, $clients[0]->name);
                //$pdf->SetXY(72, 162);
                //$pdf->Write(1, $clients[0]->address);

                $pdf->SetXY(72, 168);
                $pdf->Write(1, $sample_info[0]->clientsampleref);

                $pdf->SetXY(72, 174);
                $pdf->Write(1, $sample_info[0]->manufacturer_name);

                $pdf->SetXY(72, 183);
                $pdf->Write(1, $sample_info[0]->country_of_origin);

                $pdf->SetXY(120, 183);
                $pdf->Write(1, $sample_count[0]->quantity_issued . " " . $sample_count[0]->sample_packaging);
                $k = 194;
                $t=194;
                $l=194;
                for ($w = 0; $w < count($tests); $w++) {
                    $pdf->SetXY(40, $k+=6);
                    $pdf->Write(1, $tests[$w]->name);
                }
                 for ($y = 0; $y < count($mog); $y++) {
                $pdf->SetXY(140, $t+=6);
                    $pdf->Write(1, $mog[$y]->comment);
                 }
                 
                 
                  for ($lim = 0; $lim < count($limits); $lim++) {
                $pdf->SetXY(83, $l+=6);
                    $pdf->Write(1, $limits[$lim]->limits);
                 }


                $pdf->SetXY(58, 238);
                $pdf->Write(1, $full_names);

               
            }

            $pdf->SetXY(30, 265);
            $pdf->Write(1, $labref . ' /  Analyst - ' . $full_names . ' /  Date ' . date('d-m-Y'));
            $pdf->SetXY(160, 265);
            $pdf->Write(1, 'Page ' . $pdf->PageNo() . ' of {nb}');



            $i++;
        } while ($i <= $pagecount);
        $pdf->Output('worksheets_stamped_gen/' . $labref . '.pdf', 'F');
        // $this->db->where('lab_ref_no',$labref)->update('sample_issuance',array('download_status'=>'1'));
        redirect('worksheets_stamped_gen/' . $labref . '.pdf');
    }

    function stamp($labref, $sheet_name) {
        $download = $this->getDownloadCount($labref, $sheet_name);
        $analyst_id = $this->session->userdata('user_id');
        $names = $this->getAnalyst($analyst_id);
        $full_names = $names[0]->fname . " " . $names[0]->lname;

        $full_name = 'custom_worksheets/' . $sheet_name . '.pdf';

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
            $pdf->SetFontSize(7);

            $pdf->SetXY(30, 265);
            $pdf->Write(1, $labref . ' / ' . ucfirst(str_replace('_', ' ', $sheet_name)) . ' / Download ' . $download . '  /  Analyst - ' . $full_names . ' /  Date ' . date('d-m-Y'));
            $pdf->SetXY(160, 265);
            $pdf->Write(1, 'Page ' . $pdf->PageNo() . ' of {nb}');



            $i++;
        } while ($i <= $pagecount);
        $pdf->Output('generated_custom_sheets/' . $labref . '_' . $sheet_name . '.pdf', 'F');
        $this->updateDownloadCount($labref, $sheet_name);

        redirect('generated_custom_sheets/' . $labref . '_' . $sheet_name . '.pdf');
    }

    function updateDownloadCount($labref, $sheet_name) {
        $repeat = $this->getDownloadCount($labref, $sheet_name);
        $repeat_status = $repeat + 1;
        $this->db->update('custom_sheets', array('repeat_status' => $repeat_status));
    }

    function getDownloadCount($labref, $sheet_name) {
        $query = $this->db->select('repeat_status')->where('labref', $labref)->where('sheet_name', $sheet_name)->get('custom_sheets')->result();
        $pre = $query[0]->repeat_status;
        if ($pre == '0') {
            return $pre + 1;
        } else {
            return $pre;
        }
    }

    function getDownloadCountSingleSheets($sheet_name, $labref) {
        $query = $this->db->where('labref', $labref)->where('name', $sheet_name)->get('worksheet_monitor')->result();
        $pre = $query[0]->counter;
        $this->db->where('labref', $labref)->where('name', $sheet_name)->update('worksheet_monitor', array('counter' => $pre + 1));
    }

    function checkDownloadData($sheet_name, $labref) {
        $query = $this->db->where('labref', $labref)->where('name', $sheet_name)->get('worksheet_monitor')->num_rows();
		 $analyst_id = $this->session->userdata('user_id');
        $d_reason = $this->input->post('reasons');
        $names = $this->getAnalyst($analyst_id);
        $full_names = $names[0]->fname . " " . $names[0]->lname;

        if ($query < 1) {
            $counter = 2;
            $reasons = $this->input->post('reasons');

            $data = array(
                'labref' => $labref,
                'name' => $sheet_name,
                'analyst_id' => $this->session->userdata('user_id'),
                'reason' => $reasons,
                'counter' => $counter,
				'analyst_name'=>$full_names
            );
            $this->db->insert('worksheet_monitor', $data);
        } else {
            $this->getDownloadCountSIngleSheets($sheet_name, $labref);
        }
    }

    public function getAnalyst($analyst_id) {
        $this->db->where('id', $analyst_id);
        $query = $this->db->get('user');
        return $result = $query->result();
    }

    public function getSupervisorID($analyst_id) {
        $this->db->where('analyst_id', $analyst_id);
        $query = $this->db->get('analyst_supervisor');
        return $result = $query->result();
    }

    function uploadSpace() {

        $data['test_id'] = $this->uri->segment(4);
        $data['labref'] = $this->uri->segment(3);

        $data['settings_view'] = "worksheet_upload_v";
        $data['error'] = "";
        $this->base_params($data);
    }

    function do_upload() {
        $labref = $this->uri->segment(3);
        $test_id = $this->uri->segment(4);
        $filename = "workbooks/" . $labref . '/' . $labref . '.xlsx';
        unlink($filename);

        $config['upload_path'] = "workbooks/" . $labref;
        $config['allowed_types'] = 'xls|xlsx';


        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('worksheet')) {
            $data['error'] = $this->upload->display_errors();
            $data['labref'] = $this->uri->segment(3);
            $data['settings_view'] = 'upload_analyst_v';
            $this->base_params($data);
        } else {
            $this->updateUploadStatus($labref, $test_id);
            redirect('analyst_controller');
        }
    }

    function retrieveFinalSubmission() {
        $user_id = $this->session->userdata('user_id');
        return $this->db
                        ->select('lab_ref_no')
                        ->where('analyst_id', $user_id)
                        ->group_by('lab_ref_no')
                        ->get('sample_issuance')
                        ->result();
    }

    function checkIfHasASupervisor() {
        $this->db->where('analyst_id', $this->session->userdata('user_id'));
        $query = $this->db->get('analyst_supervisor');
        if ($query->num_rows() > 0) {
            return '1';
        }
        return '0';
    }

    function checkForDoneUniformity() {
        $user_id = $this->session->userdata('user_id');
        $this->db->select('test_name');
        $this->db->from('test_done td');
    }

    function validateURL() {
        $user_id = $this->session->userdata('user_id');
        $tests_assigned = Sample_issuance::getTests($user_id);
        foreach ($tests_assigned as $test):
            $worksheet = Tests::getWorksheet($test->Test_id);
            $test = site_url() . $worksheet[0]['Alias'];
            $this->url_exists($test);
        endforeach;
        //  $first=  $this->uri->segment(1);
        //  $this->url_exists($first);
    }

    function createClass() {
        $myFile = "test.php";
        $fh = fopen($myFile, 'w');
        $stringData = "<?php \n";
        $myvar = fwrite($fh, $stringData);
        $stringData = "class xyz extends MY_Controller{\n"
                . "function __construct(){\n"
                . "parent::__construct();\n"
                . "}\n"
                . "}";
        fwrite($fh, $stringData);
        fclose($fh);
        echo 'succes';
    }

    public function base_params($data) {
        $data['title'] = "Analyst";
        $data['styles'] = array("jquery-ui.css");
        $data['scripts'] = array("jquery-ui.js");
        $data['scripts'] = array("SpryAccordion.js");
        $data['styles'] = array("SpryAccordion.css");
        $data['content_view'] = "settings_v";
        //$data['banner_text'] = "NQCL Settings";
        //$data['link'] = "settings_management";

        $this->load->view('template', $data);
    }

}
