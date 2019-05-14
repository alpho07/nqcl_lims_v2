<?php
include APPPATH . 'third_party/FPDF/fpdf17/fpdf.php';
include APPPATH . 'third_party/FPDF/FPDI/fpdi.php';
class Ph extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    public function worksheet() {
         $data['test_id']=$this->uri->segment(4);
        $data['labref'] = $this->uri->segment(3);
        $data['settings_view'] = "pHv";
        $this->base_params($data);
    }

    function getDoStatus() {
        $labref = $this->uri->segment(3);
        $analyst_id = $this->session->userdata('user_id');
        $this->db->where('lab_ref_no', $labref);
        $this->db->where('test_id', 4);
        $this->db->where('analyst_id', $analyst_id);
        $query = $this->db->get('sample_issuance')->result();
        return $result = $query[0]->do_count;
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

    public function save() {


        $labref = $this->uri->segment(3);
        $max_row_id = $this->getpHRepeatStatus($labref);
        (int) $new_status = (int) $max_row_id[0]->repeat_status + 1;
        $analyst_id = $this->session->userdata('user_id');
       
     

        $ph = array(
            0 => array('labref' => $labref, 'run' => $this->input->post('ph1'), 'component' => 0, 'analyst_id' => $analyst_id, 'repeat_status' => $new_status),
            1 => array('labref' => $labref, 'run' => $this->input->post('ph2'), 'component' => 0, 'analyst_id' => $analyst_id, 'repeat_status' => $new_status),
            2 => array('labref' => $labref, 'run' => $this->input->post('ph3'), 'component' => 0, 'analyst_id' => $analyst_id, 'repeat_status' => $new_status),
            3 => array('labref' => $labref, 'run' => $this->input->post('ph4'), 'component' => 0, 'analyst_id' => $analyst_id, 'repeat_status' => $new_status)
        );
        foreach ($ph as $ph_top):
            $this->db->insert('ph_top', $ph_top);
        endforeach;
        
        $phbottom=array(
            'labref'=>$labref,
            'comments'=>  $this->input->post('comments'),
            'mean'=>$this->input->post('phmean'),
            'ph'=>$this->input->post('sampleph'),
            'component'=>0,
            'repeat_status'=>$new_status,
            'analyst_id'=>$analyst_id
           );
           $this->db->insert('ph_bottom',$phbottom);
         // $this->Returning_to_Supervisor($labref);

 $this->RegisterpHValues($labref, $new_status);
          $test_id=  $this->uri->segment(4);
        //$this->deletePDFgen($labref, $test_id, $analyst_id);
       $pdf_name=$labref.'_ph';
       $this->insertPDFgen($labref, $pdf_name, $test_id, $analyst_id);
        $this->updateSampleIssuance();
        $this->updateTestIssuanceStatus();
        $this->updateSampleSummary();
        $this->post_posting();
        $this->updatepHCOADetails($labref);
        $this->save_test();
      
        $this->updateUploadStatus($labref, $test_id);
      
    }
    
    
      function RegisterpHValues($labref,$repeat_status) {
		  
        if (file_exists('samplepdfs/'.$labref.'_ph.pdf')) {
           unlink('samplepdfs/'.$labref.'_ph.pdf');
        } else {
           // echo 'Not found';
        }
        $top = $this->getpHa($labref, $repeat_status);
       
         $bottom = $this->getpHb($labref, $repeat_status);
        

        $full_name = 'samplepdfs/ph.pdf';     
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
            
            $xa=1;
            $ya1=(int)164;
            
            for($u=0; $u<count($top);$u++){
            
            $pdf->SetXY(95, $ya1+=5);
           // $pdf->Write(1, $uniformity[$u]->tcsv);
            $pdf->MultiCell(10, 1,   $top[$u]->run, 0, 'R');            
           
            
          }
            $pdf->SetFont('Arial' ,'B');
            $pdf->SetXY(95, 189);
           // $pdf->Write(1, $uniformity[$u]->tcsv);
            $pdf->MultiCell(10, 1,   $bottom[0]->mean, 0, 'R');   
            
         
              $pdf->SetFont('Arial' ,'B');
              $pdf->SetFontSize(10);
               $pdf->SetXY(115, 205);
                $pdf->Write(1, $bottom[0]->ph);
         //   $pdf->MultiCell(10, 1,   $top[$u]->run, 0, 'R');  
          

              $pdf->SetFont('Arial');
            $pdf->SetXY(27, 55);
           // $pdf->Write(1, $uniformity[$u]->tcsv);
            $pdf->MultiCell(140, 7,   $bottom[0]->comments,0, 'L');   
          
          
       

            $i++;
        } while ($i <= $pagecount);
        $pdf->Output('samplepdfs/'.$labref.'_ph.pdf', 'F');
         
        echo 'Done';
    }

    function updateTestIssuanceStatus() {
        $labref = $this->uri->segment(3);

        $analyst_id = $this->session->userdata('user_id');
        $done_status = '1';
        $data = array(
            'done_status' => $done_status
        );
        $this->db->where('lab_ref_no', $labref);
        $this->db->where('test_id', 7);
        $this->db->where('analyst_id', $analyst_id);
        $this->db->update('sample_issuance', $data);

        $this->comparetToDecide($labref);
    }

    function post_posting() {
        $labref = $this->uri->segment(3);
        $posts = array(
            'labref' => $labref,
            'component' => 'pH',
            'component_no' => '0',
            'test_name' => 'pH',
            'date_time' => date('d-m-Y H:i:s')
        );
        $this->db->insert('posting_status', $posts);
    }

    function check_repeat_status() {
        $this->db->select_max('repeat_status');
        $this->db->where('labref', $this->uri->segment(3));
        $this->db->where('test_name', 'pH');
        $query = $this->db->get('tests_done');
        return $result = $query->result();
    }

    function save_test() {
        $labref = $this->uri->segment(3);
		$test_id= $this->uri->segment(4);
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
            'test_name' => 'pH',
            'repeat_status' => $new_r_status,
            'supervisor_id' => $supervisor_id,
            'test_subject' => 'pH_r',
            'analyst_id' => $analyst_id,
            'priority' => $urgency,
			'test_id'=>$test_id
        );
        $this->db->insert('tests_done', $final_test_done);
    }

    function updateSampleSummary() {
        $labref = $this->uri->segment(3);
        $data = array(
            'determined' => $this->input->post('sampleph'),
           
        );
        $this->db->where('test_id', 7);
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

    public function getDisintegrationTestRepeatStatus($labref) {
        $this->db->select_max('repeat_status');
        $this->db->where('labref', $labref);
        $query = $this->db->get('ph_top');
        return $row = $query->result();
    }

    public function pH_r() {
        $data['labref'] = $labref = $this->uri->segment(3);
        $data['r'] = $r = $this->uri->segment(4);
        $data['c'] = $c = $this->uri->segment(5);
          $data['test_name']=$module = $this->uri->segment(1);
         $data['test_id'] =  $this->uri->segment(6);
        $data['analyst_id'] =  $this->uri->segment(7);
        $data['test'] =  $this->uri->segment(8);
        $data['done'] = $this->checkApproval('pH_r', $labref, $r, $c);
        $username = $this->getAnalystData();
        $new = $username[0]->analyst_name;
        //$username=$user[0]->username;
        $this->session->set_userdata('mail_name', $new);
        $labref = $this->uri->segment(3);
        $module = $this->uri->segment(2);
        $this->session->set_userdata(array('labref' => $labref, 'module' => $module));
        $data['ph_top'] = $this->getpHa($labref, $r);
        $data['ph_bottom'] = $this->getpHb($labref, $r);
        $data['date_time'] = $this->getDate($labref, $r, $c);
        $data['settings_view'] = 'pHv_r_v';
        $this->base_params($data);
    }
    
        function getpHa($labref,$r){
            return $this->db
                    ->where('labref',$labref)
                    ->where('repeat_status',$r)
                    ->get('ph_top')
                    ->result();
        }
            function getpHb($labref,$r){
            return $this->db
                    ->where('labref',$labref)
                    ->where('repeat_status',$r)
                    ->get('ph_bottom')
                    ->result();
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

    public function approve_data() {
        $labref = $this->uri->segment(3);
         $this->Returning_to_documentation($labref);
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
            'test_name' => 'pH',
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
        $this->db->where('test_name', 'pH');
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
        $this->db->where('test_name', 'pH');

        $query = $this->db->get('supervisor_approvals');
        if ($query->num_rows() > 0) {
            echo 'Already Approved';
        } else {
            $this->approve_data();
        }
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

    public function getpHRepeatStatus($labref) {
        $this->db->select_max('repeat_status');
        $this->db->where('labref', $labref);
        $query = $this->db->get('ph_top');
        return $row = $query->result();
        // print_r($row);  
    }

    function repeats($labref) {
        echo json_encode(
                $this->db
                        ->select('repeat_status')
                        ->where('labref', $labref)
                        ->get('ph_top')
                        ->result()
        );
    }

    public function base_params($data) {
        $data['title'] = "pH Measurements";
        $data['content_view'] = "settings_v";
        $this->load->view('template', $data);
    }

}
