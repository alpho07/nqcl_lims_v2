<?php

class Assign extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function assing_reviewer($labref='') {
        $data['labref'] = $this->uri->segment(3);
         $data['formicrobiology'] = $this->uri->segment(4);
         $data['test_id'] = $this->uri->segment(5);
         $data['id'] = $this->uri->segment(6);
        $data['reviewers'] = $this -> getReviewersArray(); 
        $data['assign_data']=  $this->getAssignment($labref);
        $data['title'] = 'Reviewer page';
        $data['settings_view'] = 'reviewer_assign';
        $this->base_params($data);
    }
    
     function getAssignment($labref){
         return $this->db->query("SELECT rl.*, CONCAT(u.title,' ',u.fname,' ', u.lname) as person FROM reviewer_log rl, user u WHERE rl.r_id = u.id AND  rl.labref='$labref'")->result();
     }
    
	function getReviewersArray(){
		$this->db->select('u.fname as fname, u.lname as lname, u.id as id');
        $this->db->from('user u');
        $this->db->join('users_types as us', 'us.email = u.email', 'left');
        $this->db->where('us.usertype_id = 3');
		$this->db->or_where('us.usertype_id = 28');
		$this->db->or_where('us.usertype_id = 31');
        $query = $this->db->get()-> result_array();
		return $query;
	}
	
		function getReviewersArray_JSON(){
		$this->db->select('u.fname as fname, u.lname as lname, u.id as id');
        $this->db->from('user u');
        $this->db->join('users_types as us', 'us.email = u.email', 'left');
        $this->db->where('us.usertype_id = 3');
		$this->db->or_where('us.usertype_id = 28');
		$this->db->or_where('us.usertype_id = 31');
        $query = $this->db->get()-> result_array();
		echo json_encode( $query);
	}
	
    function show(){
      $data=$this->db->list_tables();
      foreach ($data as $tablename):
          echo '<ul><li>truncate '.$tablename.';</li></ul>';
      endforeach;
    }
    
    function rejectReason($labref){
        $id = $this->session->userdata('user_id');
        $user = $this->getReviewerName($id);
        $name = $user[0]->title ." " . $user[0]->fname . " " . $user[0]->lname;
        $this->db->where('folder',$labref)->where('director_id',$id)->delete('directors');
        $update =array(
         //  'assign_status' => 0,
            'reject_status' => 1,
            'reject_reason'=>  $this->input->post('rejectedRe').". Rejected by: "  .$name = $user[0]->title ." " . $user[0]->fname . " " . $user[0]->lname,
           // 'director_id'=>57
        );
        $this->db->where('labref',$labref)->update('reviewer_documentation',$update);
        $this->Rejection_COA($labref);
    }

    
    function edit_assignment($labref){
        $date=  $this->input->post('date_field');
        $this->db->where('id',$labref)->update('assigned_samples',array('date_time_tracker'=>$date));
        echo 'done';
    }
    public function getReviewers() {
        $this->db->select('u.fname as fname, u.lname as lname, u.id as id');
        $this->db->from('user u');
        $this->db->join('users_types as us', 'us.email = u.email', 'left');
        $this->db->where('us.usertype_id = 3');
		$this->db->or_where('us.usertype_id = 28');
		$this->db->or_where('us.usertype_id = 31');
        $query = $this->db->get();
		foreach ($query -> result() as $value){
			$data[] = $value;
		}
        echo json_encode($data);
    }

    public function getAJAXReviewers() {
        $this->db->select('u.fname as fname, u.lname as lname, u.id as id');
        $this->db->from('user u');
        $this->db->join('users_types as us', 'us.email = u.email', 'left');
        $this->db->where('us.usertype_id = 6');
        $query = $this->db->get();
		foreach ($query -> result() as $value){
			$data[] = $value;
		}
        echo json_encode($data);
    }
    
     public function getAJAXReviewers1() {
        $this->db->select('u.fname as fname, u.lname as lname, u.id as id,u.title as title');
        $this->db->from('user u');
        $this->db->join('users_types as us', 'us.email = u.email', 'left');
        $this->db->where('us.usertype_id = 3');
		$this->db->or_where('us.usertype_id = 28');
		$this->db->or_where('us.usertype_id = 31');
        $query = $this->db->get();
		
		foreach ($query -> result() as $value){
			$data[] = $value;
		}
        echo json_encode($data);
    }
    
      public function getAJAXDdirector() {
        $this->db->select('u.fname as fname, u.lname as lname, u.id as id');
        $this->db->from('user u');
        $this->db->join('users_types as us', 'us.email = u.email', 'left');
        $this->db->where('us.usertype_id = 25');
        $query = $this->db->get();
		foreach ($query -> result() as $value){
			$data[] = $value;
		}
        echo json_encode($data);
    }
	
	function getReviewerName($id){
		return $this->db->where('id',$id)->get('user')->result();
	}
	
	function IssueStandAlone(){
		       $reveiwer_id = $this->session->userdata('user_id');
        $folder = $this->input->post('labref_no');
        $data1 = $this->input->post('reviewer');
        
           $priority=  $this->findPriority($folder);
            $urgency=$priority[0]->urgency;

        $r_name = $this->getReviewerName($data1);
        $data = array(
            'reviewer_id' => $data1,
            'folder' => $folder,
            'time_done'=>date('Y-m-d'),
            'priority'=>'',
           'microbiology'=>'',
		   'reviewer_name'=>$r_name[0]->title ." ". $r_name[0]->fname ." " .$r_name[0]->lname,
            'test_id'=>''
        );
      $this->db->insert('reviewer_worksheets', $data);  
	$this->db->where('labref',$folder)->update('assigned_samples',array('stat'=>1)); 	
		
	}

    
   public function sendSamplesFolder() {
        $reveiwer_id = $this->session->userdata('user_id');
        $folder = $this->uri->segment(3);
        $data1 = $this->input->post('director');
        
           $priority=  $this->findPriority($folder);
            $urgency=$priority[0]->urgency;
            $this->Assigning_for_wk_review($folder, $this->getReviewerNameM($data1));
              if($this->uri->segment(4)=='formicrobiology'){
       $micro = 'formicrobiology';
      }else{
         $micro = 'forwetchemistry';   
      }
       //

        //$data2 = $this ->getReviewers();
        $data = array(
            'reviewer_id' => $data1,
            'folder' => $folder,
            'time_done'=>date('Y-m-d'),
            'priority'=>$urgency,
           'microbiology'=>$micro,
            'test_id'=>$this->uri->segment(6)
        );
      $this->db->insert('reviewer_worksheets', $data);
      
      
         $withdraw = array(
            'labref'=>$folder,
            'date_action'=>date('d-m-Y'),
            'r_id'=>$data1,
            'status'=>'Assigned'
        );
        $this->db->insert('reviewer_log',$withdraw);
        
     // $this->updateAssignedSamples();
      $this->db->where('labref',$folder)->update('assigned_samples',array('stat'=>1)); 
      $this->db->where('labref',$folder)->where('test_product',$micro)->update('supervisor_approvals',array('assign_status'=>1)); 
    
       // $this->createDir();
       // $this->full_copy();
      $this->addSampleTrackingInformation();
      $this->addSignature();
        

        echo 'Reloading page.....';

        // redirect('uploaded_worksheets');
    }
    
    public function reviewerDetailsView() {
        $data['reqid'] = $this -> uri -> segment(3);
        $data['content_view'] = 'reviewer_details_v';
        $this -> load ->view ('template1', $data);
    }

    public function getReviewerDetails(){
        $reqid = $this -> uri -> segment(3);
        $reviewer_details = Reviewer_worksheets::getReviewerDetails($reqid);
        if(!empty($reviewer_details)){
            foreach ($reviewer_details as $rd) {
                $data[] = $rd;
            }
            echo json_encode($data);
        }
        else{
            echo "[]"; 
        }
    }


    function complete_review($labref){
        $this->db->where('labref',$labref)->update('review_samples',array('a_stat'=>1)); 
        
                $supervisor = $this->getSupervisor($labref);
        $from = $supervisor[0]->analyst_name;
        $date = date('d-M-Y H:i:s');
        $activity = 'Documentation - Awaiting D.Director;\'s Review';
        $array_data = array(
            'activity' => $activity,
            'from' => $from,
            'to' => 'Documentation',
            'date' => $date,
            'stage' => '8',
            'current_location' => 'Documentation'
        );
        $this->db->where('labref', $labref)->update('worksheet_tracking', $array_data);
        $this->db->where('labref', $labref)->update('review_samples ', array('date_time_returned' => $date));
        
              redirect('request_management/review_samples');
    }
    
        public function getSupervisor($labref) {
        // $user_id = $this->session->userdata('user_id');
        $this->db->select('analyst_name');
        $this->db->where('labref', $labref);
        $query = $this->db->get('review_samples');
        return $result = $query->result();
    }
    
             function updateAssignedSamples(){
                 $labref = $this -> input -> post("labref_no");  
                 $analyst_name = $this -> input -> post("rev_name");  
                 $date=date('d-m-Y H:i:s');
                 $this->db->insert('review_samples',array(
                   'labref'=>$labref,
                   'analyst_name'=>$analyst_name,
                   'date_time'=>$date
                 ));
                 
                }
    
    function findPriority($labref){
        $this->db->select('urgency');
        $this->db->where('request_id',$labref);
        $query=  $this->db->get('request');
        $result=$query->result();
        return $result;
    }
    
               function addSignature(){                    
                    $name=  $this->getReviewer();
                    $signature_name=$name[0]->fname." ".$name[0]->lname;
                    $designation ='ANALYST:';
                    $labref = $this -> uri->segment(3);
                    $date_signed=date('m-d-Y');
                    
                    $signature=array(
                        'labref'=>$labref,
                        'designation'=>$designation,
                        'signature_name'=>$signature_name,
                        'date_signed'=>$date_signed
                    );
                    $this->db->insert('signature_table',$signature);
                    
                  
                    
                    redirect('documentation/home/');
                   }
                   
     function addSampleTrackingInformation() {
        $reviewer = $this->getReviewer();
        $userInfo = $this->getUsersInfo();
        $reviewer_name = $reviewer[0]->fname . " " . $reviewer[0]->lname;
        $activity = 'Samples Issuing for review';
        $labref = $this->uri->segment(3);
        $names = $userInfo[0]->fname . " " . $userInfo[0]->lname;
        $from = $names . '- Documentation';
        $to = $reviewer_name . '- Reviewer';
        $date = date('m-d-Y H:i:s');
        $array_data = array(
            'activity' => $activity,
            'from' => $from,
            'to' => $to,
            'date' => $date,
            'stage'=>'7',
            'current_location' => 'Review'
        );
            $this->db->insert('sample_details',array(
                     'labref' =>$labref,
                     'by'=>$reviewer_name,
                     'activity'=>'Review', 
                     'user_id'=>$reviewer[0]->id,
                     'date_issued'=>date('Y-m-d')
                     
                 ));
        
        $this->db->where('labref', $labref);
        $this->db->update('worksheet_tracking', $array_data);
    }

    function getReviewer() {
        $analyst_id = $this->input->post('reviewer');
        $this->db->select('id,fname,lname');
        $this->db->where('id', $analyst_id);
        $query = $this->db->get('user');
        return $result = $query->result();
        //print_r($result);
    }

    public function getUsersInfo() {
        $user_id = $this->session->userdata('user_id');
        $this->db->select('fname,lname');
        $this->db->where('id', $user_id);
        $query = $this->db->get('user');
        return $result = $query->result();
    }

    public function upDate($id) {
        $folder = $this->uri->segment(3);
        $data = array(
            'assign_status' => 1 //change this to 1
        );
        $this->db->where('id', $id);
        $this->db->update('supervisor_approvals', $data);
    }
    
      public function upDate_wet() {
        $folder = $this->uri->segment(3);
        $data = array(
            'assign_status' => 1 //change this to 1
        );
        $this->db->where('labref', $folder);
        $this->db->where('department', 1);
        $this->db->update('supervisor_approvals', $data);
    }

    public function createDir() {
        $data2 = $this->getReviewers();
        $rootDir = 'reviewers';
        $reviewer_folder = $this->input->post('reviewer');
        if (is_dir($rootDir)) {
            // echo basename($dirName);
            $w = mkdir($rootDir . '/' . $reviewer_folder, 0777, TRUE);
            if ($w) {
                echo 'subdir has been created';
            } else {
                echo 'An error occured';
            }
        }
    }
    function approve(){
        $labref=  $this->uri->segment(6);
        $data =array(
            'status'=>'1',
            'time_done '=> date('d-M-Y')
        );
        $this->db->where('id',$labref);
        $this->db->update('reviewer_worksheets',$data);
        redirect('reviewer');
    }
       function reject(){
        $labref=  $this->uri->segment(3);
        $data =array(
            'status'=>'2',
            'time_done '=>'NOW()'
        );
        $this->db->where('folder',$labref);
        $this->db->update('reviewer_worksheets',$data);
        redirect('reviewer');
    }

    public function full_copy() {
        $labref = $this->uri->segment(3);
          $test_id = $this->uri->segment(5);
        $data2 = $this->getReviewers();
        $reviewer_folder = $this->input->post('reviewer');

        $newfolder = 'reviewers';
        if (is_dir($newfolder)) {
            mkdir($newfolder . '/' . $reviewer_folder . '/' . date('Y') . '/' . $labref, 0777, TRUE);
            if ($this->uri->segment(4) == 'formicrobiology' && $test_id =='49') {
                $source = 'analyst_uploads/' . $labref . '_micro.xlsx';
                $target2 = $newfolder . '/' . $reviewer_folder . '/' . date('Y') . '/' . $labref . '/' . $labref . '_micro.xlsx';
                copy($source, $target2);
            } else if($this->uri->segment(4) == 'formicrobiology' && $test_id =='50') {
                $source = 'analyst_uploads/' . $labref . '_microlal.xlsx';
                $target2 = $newfolder . '/' . $reviewer_folder . '/' . date('Y') . '/' . $labref . '/' . $labref . '_microlal.xlsx';
               
             
                copy($source, $target2);
              
            }else{
              $source = 'analyst_uploads/' . $labref . '.xlsx';
                $target2 = $newfolder . '/' . $reviewer_folder . '/' . date('Y') . '/' . $labref . '/' . $labref . '.xlsx';
                copy($source, $target2);  
            }
        } else {
        if ($this->uri->segment(4) == 'formicrobiology' && $test_id =='49') {
                $source = 'analyst_uploads/' . $labref . '_micro.xlsx';
                $target2 = $newfolder . '/' . $reviewer_folder . '/' . date('Y') . '/' . $labref . '/' . $labref . '_micro.xlsx';
                copy($source, $target2);
            } else if($this->uri->segment(4) == 'formicrobiology' && $test_id =='50') {
                $source = 'analyst_uploads/' . $labref . '_microlal.xlsx';
                $target2 = $newfolder . '/' . $reviewer_folder . '/' . date('Y') . '/' . $labref . '/' . $labref . '_microlal.xlsx';
                copy($source, $target2);
            }else{
              $source = 'analyst_uploads/' . $labref . '.xlsx';
                $target2 = $newfolder . '/' . $reviewer_folder . '/' . date('Y') . '/' . $labref . '/' . $labref . '.xlsx';
                copy($source, $target2);  
            }
        }
    }
    
    

    public function base_params($data) {
        $labref = $this->uri->segment(3);
        $data['title'] = "Reviewer - " . $labref;
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

?> 