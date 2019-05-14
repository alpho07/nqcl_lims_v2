<?php

class Inventory extends MY_Controller {


    public function index() {
      $this->load->library('excel');
       $data=array();
       $data['content_view'] = "inventory_v";
       $this -> base_params($data);
    }
	
	function getReport(){
		$year =date('Y');
		$year1= date('Y')+1;
		$status = $this->input->post('report');
		
		if($status=='All'){
		return $this->db->get('equipment')->result();	
		}elseif($status=='Working'){
		return $this->db->where('status','Working')->get('equipment')->result();	
		}elseif($status=='Calibrated'){
					return $this->db->where('status','Calibrated')->get('equipment')->result();	

		}elseif($status=='Pending Calibration'){
					return $this->db->where('status','Pending Calibration')->get('equipment')->result();	

		}elseif($status=='60'){
					return $this->db->query("SELECT *
FROM `equipment` 
WHERE YEAR(`date_of_nxtcalibration`)='$year' OR YEAR(`date_of_nxtcalibration`)='$year1' 
AND DATEDIFF( `date_of_nxtcalibration` , `date_of_calibration` ) <= 60")->result();	

		}elseif($status=='30'){
					return $this->db->query("SELECT *
FROM `equipment` 
WHERE YEAR(`date_of_nxtcalibration`)='$year' OR YEAR(`date_of_nxtcalibration`)='$year1' 
AND DATEDIFF( `date_of_nxtcalibration` , `date_of_calibration` ) <= 30")->result();	

		}elseif($status=='14'){
					return $this->db->query("SELECT *
FROM `equipment` 
WHERE YEAR(`date_of_nxtcalibration`)='$year' OR YEAR(`date_of_nxtcalibration`)='$year1' 
AND DATEDIFF( `date_of_nxtcalibration` , `date_of_calibration` ) <= 14")->result();	

		}elseif($status=='Decommissioned'){
					return $this->db->where('status','Decommissioned')->get('equipment')->result();	

		}elseif($status=='Decommissioned'){
					return $this->db->where('status','Out of Service')->get('equipment')->result();	

		}
	}
	
	
		function getReportColumn(){
	
		$column_types = $this->input->post('column_types');
		$dimensions = $this->input->post('dimensions');
		$issuedto = $this->input->post('issuedto');
		$status = $this->input->post('status');
		
		if($column_types=='' && $status=='' && $dimensions=='' && $issuedto==''){
			echo '1';
			$query = $this->db-> 
		query("SELECT ct.column_type, c.serial_no,c.column_no,c.issuance_status,ct.column_dimensions, ct.quantity_received, ct.date_received,ct.status, CONCAT(u.fname, '', u.lname) name,ci.issue_date FROM columns c
JOIN column_types ct ON c.column_type_id = ct.id
JOIN column_issue ci ON c.column_type_id = ci.column_id
LEFT JOIN user u ON ci.analyst_id = u.id");
		return $equipmentData = $query -> result();

	
		}elseif($column_types!='' && $status=='' && $dimensions=='' && $issuedto==''){
		$query = $this->db-> 
		query("SELECT ct.column_type, c.serial_no,c.column_no,c.issuance_status,ct.column_dimensions, ct.quantity_received, ct.date_received,ct.status, CONCAT(u.fname, '', u.lname) name,ci.issue_date FROM columns c
JOIN column_types ct ON c.column_type_id = ct.id
JOIN column_issue ci ON c.column_type_id = ci.column_id
LEFT JOIN user u ON ci.analyst_id = u.id");
		return $equipmentData = $query -> result();
		
		}elseif($column_types!='' && $status!='' && $dimensions=='' && $issuedto==''){
				$query = $this->db-> 
		query("SELECT ct.column_type, c.serial_no,c.column_no,c.issuance_status,ct.column_dimensions, ct.quantity_received, ct.date_received,ct.status, CONCAT(u.fname, '', u.lname) name,ci.issue_date FROM columns c
JOIN column_types ct ON c.column_type_id = ct.id
JOIN column_issue ci ON c.column_type_id = ci.column_id
LEFT JOIN user u ON ci.analyst_id = u.id");
		return $equipmentData = $query -> result();	

		}elseif($column_types!='' && $status!='' && $dimensions!='' && $issuedto==''){
			$query = $this->db-> 
		query("SELECT ct.column_type, c.serial_no,c.column_no,c.issuance_status,ct.column_dimensions, ct.quantity_received, ct.date_received,ct.status, CONCAT(u.fname, '', u.lname) name,ci.issue_date FROM columns c
JOIN column_types ct ON c.column_type_id = ct.id
JOIN column_issue ci ON c.column_type_id = ci.column_id
LEFT JOIN user u ON ci.analyst_id = u.id");
		return $equipmentData = $query -> result();	

		}elseif($column_types!='' && $status!='' && $dimensions!='' && $issuedto!=''){
					$query = $this->db-> 
		query("SELECT ct.column_type, c.serial_no,c.column_no,c.issuance_status,ct.column_dimensions, ct.quantity_received, ct.date_received,ct.status, CONCAT(u.fname, '', u.lname) name,ci.issue_date FROM columns c
JOIN column_types ct ON c.column_type_id = ct.id
JOIN column_issue ci ON c.column_type_id = ci.column_id
LEFT JOIN user u ON ci.analyst_id = u.id");
		return $equipmentData = $query -> result();

		}else{
			$query = $this->db-> 
		query("SELECT ct.column_type, c.serial_no,c.column_no,c.issuance_status,ct.column_dimensions, ct.quantity_received, ct.date_received,ct.status, CONCAT(u.fname, '', u.lname) name,ci.issue_date FROM columns c
JOIN column_types ct ON c.column_type_id = ct.id
JOIN column_issue ci ON c.column_type_id = ci.column_id
LEFT JOIN user u ON ci.analyst_id = u.id");
		return $equipmentData = $query -> result();
		}
		}
	
	
	
	
	
	
    function ExcelGenerator() {
		
        unlink("equipment.xlsx");
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load("f.xlsx");
        $objPHPExcel->getActiveSheet(0);
     
            $signatories = $this->getReport();
        

        $worksheet = $objPHPExcel->getActiveSheet();
        $styleArray = array(
            'borders' => array(
                'outline' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THICK,
                    'color' => array('argb' => 'FFFF0000'),
                ),
            ),
        );
        $row2 = 4;
        $i = 1;
        foreach ($signatories as $signatures):
            $col = 0;
            $worksheet
                    ->setCellValueByColumnAndRow($col++, $row2, $i)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->name)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->model)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->serial_no)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->nqcl_no)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->date_of_calibration)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->date_of_nxtcalibration)
                    ->setCellValueByColumnAndRow($col++, $row2, "")
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->status);
                    

            $row2++;
            $i++;
        endforeach;

        // $objPHPExcel->getActiveSheet()->setCellValue('B1', strtoupper(str_replace(array("%20", "/", ",", " ", ".", "(", ")", "?"), "_", $cname)));
        
		
			if($status=='All'){
		$objPHPExcel->getActiveSheet()->setTitle('ALL EQUIPMENTS');
		}elseif($status=='Working'){
			$objPHPExcel->getActiveSheet()->setTitle('WORKING ');
		}elseif($status=='Calibrated'){
			$objPHPExcel->getActiveSheet()->setTitle('CALIBRATED ');
		}elseif($status=='Pending Calibration'){
			$objPHPExcel->getActiveSheet()->setTitle('PENDING CALIBRATION');
		}elseif($status=='30'){
			$objPHPExcel->getActiveSheet()->setTitle('PENDING IN 30Days');
		}elseif($status=='Decommissioned'){
			$objPHPExcel->getActiveSheet()->setTitle('DECOMMISSIONED');
		}

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');


        $objWriter->save("equipment.xlsx");

        redirect('equipment.xlsx');
        echo 'Data exported';
    }
	
	
	 function ExcelGeneratorColumns() {
		
        unlink("columns.xlsx");
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load("c.xlsx");
        $objPHPExcel->getActiveSheet(0);
     
            $signatories = $this->getReportColumn();
        

        $worksheet = $objPHPExcel->getActiveSheet();
        $styleArray = array(
            'borders' => array(
                'outline' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THICK,
                    'color' => array('argb' => 'FFFF0000'),
                ),
            ),
        );
        $row2 = 4;
        $i = 1;
        foreach ($signatories as $signatures):
            $col = 0;
            $worksheet
                    ->setCellValueByColumnAndRow($col++, $row2, $i)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->column_type)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->column_no)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->column_dimensions)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->serial_no)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->status)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->date_received)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->name)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->issue_date)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->quantity_received);
                    

            $row2++;
            $i++;
        endforeach;

        // $objPHPExcel->getActiveSheet()->setCellValue('B1', strtoupper(str_replace(array("%20", "/", ",", " ", ".", "(", ")", "?"), "_", $cname)));
        
		
		

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');


        $objWriter->save("columns.xlsx");

        redirect('columns.xlsx');
        echo 'Data exported';
    }

	
	

    public function refSubs_save(){

        if (is_null($_POST)) {
                echo json_encode(array(
                    'status' => 'error',
                    'message'=> 'Data was not posted.'
                ));
            }
        else
            {
            echo json_encode(array(
                    'status' => 'success',
                    'message'=> 'Data added successfully'
                ));
            }

		$custodian = $this->session->userdata('user_id');
        $name = $this -> input -> post("name");
        $source = $this -> input -> post("source");
        $batch_no = $this -> input -> post("batch_no");
        $rs_code = $this -> input -> post("rs_code");
        $date_r = $this -> input -> post("date_r");
        $date_o = $this -> input -> post("date_o");
        $date_e = $this -> input -> post("date_e");
        $date_res = $this -> input -> post("date_res");
        $potency = $this -> input -> post("potency");
        $potency_unit = $this -> input -> post("p_unit");
        $potency_type = $this -> input -> post("potency_type");
        $init_mass = $this -> input -> post("init_mass");
        $init_mass_unit = $this -> input -> post("init_mass_unit");
        $application = $this -> input -> post("application");
        $status = $this -> input -> post("status");
        $version_id = $this -> input -> post("version_id");
        $quantity =  $this -> input -> post("quantity");
        $storage_conditions = $this -> input -> post("storage_conditions");
        $water_content = $this -> input -> post("water_content");
		$lod = $this -> input -> post("lod");

		//File input name
		$files = $_FILES;

        //for($i = 0; $i < $quantity; $i++) {

        $rs_code_exp = explode("-", $rs_code);

        if($rs_code_exp[1] == "WRSR"){
        $restnd_status = "Restandardised";
        $standard_type = "Working";
        } else if($rs_code_exp[1] == "WRS") {
        $restnd_status = "Effective";
        $standard_type = "Working";
        } else if($rs_code_exp[1] == "PRS") {
        $restnd_status = "Effective";
        $standard_type = "Primary";
        }


       /* if($version_id == 1){

        $count = RefSubs::getCount($name, $standard_type, $batch_no);
        if(isset($count)){
        $count1 = $count[0]['count'];
        $no =  $count1 + 1;

            if($count1 > 0){

             $status = "Reserved";
            }
            else if($count1 <=0){
            $status = "In Use";
            }
        }

        else {
        $no = 1;
        }

        }

        else if($version_id > 1) {

            $no = null;

        }
        */


        //$s_no = Refsubs::getLastSerial($name);
        $count = RefSubs::getCount2($batch_no, $name, $source);
        $serials = Refsubs::getSerialNos($batch_no, $name, $source);
        if((int)$count[0]['count'] > 0){
            //$db_rscode = Refsubs::getCode($batch_no);
            //$f_rs_code = $db_rscode[0]['rs_code'];

            $no = $serials[0]['distinct'];
            $total_quantity = $quantity * $init_mass;
            $existing_quantity = Refsubs::getQuantity($batch_no);
            $status = "Reserved";
            //$existing_quantity[0]['count'];
           // $overall_quantity = $total_quantity + $existing_quantity;
        }
        elseif((int)$count[0]['count'] == 0){
            $names = Refsubs::getNameCount($name);
            $s_no = Refsubs::getLastSerial($name);
            if((int)$names[0]['count'] >= 1){
                $no = (int)$s_no[0]['max'] + 1;
                $status= "Reserved";
            }
            else{
                $status = "In Use";
                $no = "1";
            }

            $f_rs_code = $rs_code.$no;
            //$total_quantity = $quantity;

        }

			//Full Code
			$rcode = $rs_code.$no;


            $refSub =  new RefSubs();



            $refSub -> name = $name;
            $refSub -> standard_type = $standard_type;
            $refSub -> source = $source;
            $refSub -> batch_no = $batch_no;
            $refSub -> rs_code = $rs_code.$no;
            $refSub -> date_received = date('y-m-d',strtotime($date_r));
            $refSub -> effective_date = date('y-m-d',strtotime($date_o));
            $refSub -> date_of_expiry = date('y-m-d',strtotime($date_e));
            $refSub -> date_of_restandardisation = date('y-m-d',strtotime($date_res));
            $refSub -> potency = $potency;
            $refSub -> potency_unit = $potency_unit;
            $refSub -> potency_type = $potency_type;
            $refSub -> init_mass = $init_mass;
            $refSub -> init_mass_unit = $init_mass_unit;
            $refSub -> status = $status;
            $refSub -> restandardisation_status = $restnd_status;
            $refSub -> application = $application;
            $refSub -> version_id = $version_id;
            $refSub -> quantity = $quantity;
            $refSub -> serial_no = $no;
            $refSub -> storage_conditions = $storage_conditions;
            $refSub -> water_content = $water_content;
			$refSub -> lod = $lod;
			$refSub -> custodian = $custodian;
            $refSub -> save();
			
			//Do cert upload
			if(!empty($files['cert']['name'])){
				$this -> do_standard_cert_upload($files ,$rcode);
			}
    }

	public function do_standard_cert_upload($files, $file_name){

		//Get name of the file input
		$file_input_name = array_keys($files)[0];

		//Set config parameters
		$config['upload_path'] = './scans/standards/';
		$config['allowed_types'] = 'pdf';
		//$config['max_size'] = 100;
		$config['file_name'] = $file_name;

		//Load upload library
		$this->load->library('upload', $config);

		if(!($this->upload->do_upload($file_input_name))){

			//Set json encode parameters
			$key = "error";
			$msg = $this->upload->display_errors('', '');

			//Send error message to json for display
			$this -> sendNoticeToJson($key, $msg);
		}
		else{

			//Set standards with certificate upload OK status
			$cert_status = 1;
			$update_cert_status = array('cert_status'=> $cert_status);
			$this -> db -> where(array('rs_code' => $file_name));
			$this -> db -> update('refsubs', $update_cert_status);

		}

	}

	public function sendNoticeToJson($key, $msg){
		echo json_encode(array(
            'status' => $key,
            'message'=> $msg
        ));
	}



    public function showSubsCount(){
        $batch_no = $this -> uri -> segment(3);
        $count = RefSubs::getCount2($batch_no);
        $s_no = Refsubs::getLastSerial($batch_no);
        //var_dump($count[0]['count']);
        var_dump($s_no);
        if((int)$count[0]['count'] > 0){

            $no = (int)$count[0]['count'];
            $existing_quantity = Refsubs::getQuantity($batch_no);
            //var_dump($existing_quantity);
            for($i=0;$i<count($existing_quantity);$i++){
              $q[] = $existing_quantity[$i]['quantity'] * $existing_quantity[$i]['init_mass'];
            }
            var_dump($q);
        }
        elseif((int)$count[0]['count'] < 1){
            $no = "1";
        }

        echo $no;
    }

    public function editrefsubs(){

        if (is_null($_POST)) {
            echo json_encode(array(
            'status' => 'error',
            'message'=> 'Data was not posted.'
            ));
            }
        else
            {
            echo json_encode(array(
                'status' => 'success',
                'message'=> 'Data added successfully'
            ));
            }

		$replace_confirm = $this -> input -> post("replace_confirm");
        $name = $this -> input -> post("name");
        $source = $this -> input -> post("source");
        $batch_no = $this -> input -> post("batch_no");
        $rs_code = $this -> input -> post("rs_code");
        $date_r = $this -> input -> post("date_r");
        $date_o = $this -> input -> post("date_o");
        $date_e = $this -> input -> post("date_e");
		$restandardisation = $this -> input -> post("restandardisation");
			if($restandardisation == "Yes"){
				$date_res = date('Y-m-d');
			}
			else{
				$date_res = '0000-00-00';
			}
        $potency = $this -> input -> post("potency");
        $potency_unit = $this -> input -> post("p_unit");
        $potency_type = $this -> input -> post("potency_type");
        $init_mass = $this -> input -> post("init_mass");
        $init_mass_unit = $this -> input -> post("init_mass_unit");
        $application = $this -> input -> post("application");
        $status = $this -> input -> post("status");
        $version_id = $this -> input -> post("version_id");
        $quantity = $this -> input -> post("quantity");
        $edit_status = '1';
        $comment = $this -> input -> post("comment");
        $dbid = $this -> input -> post("dbid");
        $storage_conditions = $this -> input -> post("storage_conditions");
        $water_content = $this -> input -> post("water_content");

        $rs_code_exp = explode("-", $rs_code);

        if($rs_code_exp[1] == "WRSR"){
        $restnd_status = "Restandardised";
        $standard_type = "Working";
        } else if($rs_code_exp[1] == "WRS") {
        $restnd_status = "Effective";
        $standard_type = "Working";
        } else if($rs_code_exp[1] == "PRS") {
        $restnd_status = "Effective";
        $standard_type = "Primary";
        }

        if($version_id == 1){

        $count = RefSubs::getCount($name, $standard_type);
        if(isset($count)){
        $count1 = $count[0]['count'];
        $no =  $count1 + 1;

            if($count1 > 0){

            $status = "Reserved";
            }
            else if($count1 <=0){
            $status = "In Use";
            }
        }

        else {
        $no = 1;
        }

        }

        else if($version_id > 1) {

            $no = null;

        }

		//Get full code
		$rcode = $rs_code.$no;

        $update_refsub = array(
        'name' => $name,
        'standard_type' => $standard_type,
        'source' => $source,
        'batch_no' => $batch_no,
        'rs_code' => $rs_code.$no,
        'date_received' => date('y-m-d',strtotime($date_r)),
        'effective_date' => date('y-m-d',strtotime($date_o)),
        'date_of_expiry' => date('y-m-d',strtotime($date_e)),
        'date_of_restandardisation' => $date_res,
        'potency' => $potency,
        'potency_unit' => $potency_unit,
        'potency_type' => $potency_type,
        'init_mass' => $init_mass,
        'init_mass_unit' => $init_mass_unit,
        'status' => $status,
        'restandardisation_status' => $restandardisation,
        'application' => $application,
        'version_id' => $version_id,
        'edit_status' => $edit_status,
        'comment' => $comment,
        'quantity' => $quantity,
        'storage_conditions' => $storage_conditions,
        'water_content' => $water_content
        );

        $this -> db -> where(array('id' => $dbid));
        $this -> db -> update('refsubs', $update_refsub);

        $rf_id =  $this->db->select_max('log_id')->get('refsubs_log')->result();
        $this->db->where('log_id',$rf_id[0]->log_id)->update('refsubs_log',array('who'=>  $this->session->userdata('full_name')));

		//Upload files
		$files = $_FILES;
		$file = $rcode.'.pdf';
		$path =$files['cert']['file_path'];
		//Condition

		if(empty($replace_confirm)){
			if(!file_exists($path.$file)){
				//Do cert upload
				$this -> do_standard_cert_upload($files ,$rcode);
			}
			else {
				$key = 'notice';
				$msg = 'Replace existing certificate?';

				//Send error message to json for display
				$this -> sendNoticeToJson($key, $msg);
			}
		}
		else{

			//Delete existing certificate
			unlink($path.$file);

			//Do Upload
			$this -> do_standard_cert_upload($files, $rcode);

		}

	}


         public function edit_reagent(){
            if (is_null($_POST)) {
                    echo json_encode(array(
                    'status' => 'error',
                    'message'=> 'Data was not posted.'
                ));
                }
            else
                {
                    echo json_encode(array(
                    'status' => 'success',
                    'message'=> 'Data added successfully'
                    ));
                }

                $reagentname = $this -> input -> post("refname");
                $rgnt_id = $this -> input -> post("rgnt_id");
                $comment = $this -> input -> post("comment");
                $edit_status = "1";

                $reagent_update_array = array('name' => $reagentname,'comment'=> $comment, 'edit_status' => $edit_status);
                $this -> db -> where(array('id' => $rgnt_id));
                $this -> db -> update('reagent', $reagent_update_array);

        }



    public function edit_refsub(){
        if (is_null($_POST)) {
            echo json_encode(array(
            'status' => 'error',
            'message'=> 'Data was not posted.'
            ));
            }
        else
            {
            echo json_encode(array(
                'status' => 'success',
                'message'=> 'Data added successfully'
            ));
            }

        $refname = $this -> input -> post("refname");
        $refid = $this -> input -> post("refid");
        $refname1 = $this -> input -> post("refname1");
        $comment = $this -> input -> post("comment");
        $edit_status = "1";

        $stype_array = array('Working','Primary','Working');
        //$s_type = $this -> input -> post("s_type");
        $codes = array('WRS','PRS','WRSR');
        $refids = array($refid, $refid+1, $refid+2);


        $refalias = str_replace(' ', '_', $refname);

        $name_as_string = "$refname";
        $name_as_string1 = "$refname1";
        $f_letter = $name_as_string[0];
        $f_letter1 = $name_as_string1[0];
        var_dump($refname);

       // $this -> db -> where('name' ,  $refname1);
        //$this -> db -> delete('refsub');
        //$max = RefSub::getMax();

        //var_dump($max);
       //$this -> db -> query('ALTER TABLE refsub AUTO_INCREMENT = ((int)$max -> max + 1)');


        $count = RefSub::getCount($f_letter);

        if(isset($count)){
        $count1 = $count[0]['count'];
            if($f_letter == $f_letter1){
            $no = $count1;
        }
        else{
            $no =  $count1 + 1;
         }
        }
        else {
            $no = 1;
        }


     /*for ($i=0; $i < count($codes) ; $i++){

            $refSub =  new refSub();
            $refSub -> name = $refname;
            $refSub -> s_type = $stype_array[$i];
            $refSub -> code = "NQCL-" . $codes[$i] . "-" . $f_letter . $no . "-" ;
            $refSub -> alias = $refalias;
            $refSub -> save();

       }
       */
       for($i =0; $i < count($codes); $i++){
       $this -> db -> where(array('id' => $refids[$i]));
       $this -> db -> update('refsub', array(
            'name' => $refname,
            's_type' => $stype_array[$i],
            'alias' => $refalias,
            'code' => "NQCL-" . $codes[$i]. "-". $f_letter . $no . "-",
            'comment' => $comment,
            'edit_status' => $edit_status
            ));
    }



    }


    public function refSub_save(){

            if (is_null($_POST)) {
            echo json_encode(array(
            'status' => 'error',
            'message'=> 'Data was not posted.'
            ));
            }
        else
            {
            echo json_encode(array(
                'status' => 'success',
                'message'=> 'Data added successfully'
            ));
            }



        $name = $this -> input -> post("name");
        $stype_array = array('Working','Primary','Working');
        //$s_type = $this -> input -> post("s_type");
        $codes = array('WRS','PRS','WRSR');


        $alias1 = str_replace(' ', '_', $name);
		$alias2 = str_replace('(', '-', $alias1);
		$alias = str_replace(')','-', $alias2);
	
        $name_as_string = "$name";
        $f_letter = $name_as_string[0];

        $count = RefSub::getCount($f_letter);

        if(isset($count)){
        $count1 = $count[0]['count'];
        $no =  $count1 + 1;
        }
        else {
            $no = 1;
        }


        for ($i=0; $i < count($codes) ; $i++){

            $refSub =  new refSub();
            $refSub -> name = $name;
            $refSub -> s_type = $stype_array[$i];
            $refSub -> code = "NQCL-" . $codes[$i] . "-" . $f_letter . $no . "-" ;
            $refSub -> alias = $alias;
            $refSub -> save();

       }


    }


function GetAutocomplete($options=array())
    {
        $this->db ->distinct();
        $this->db->select('name');
        $this->db->like('name', $options['name'], 'after');
        $query = $this->db->get('refsub');
        return $query->result();

    }

function getSourceAutocomplete($options=array())
    {
    	$this->db ->distinct();
    	$this->db->select('source');
    	$this->db->like('source', $options['source'], 'after');
    	$query = $this->db->get('refsubs');
    	return $query->result();

    }

function getReagentsAutocomplete($options=array())
    {
        $this->db ->distinct();
        $this->db->select('name');
        $this->db->like('name', $options['name'], 'after');
        $query = $this->db->get('reagent');
        return $query->result();
    }

 function getRefsubAutocomplete($options=array())
    {
    	$this->db ->distinct();
    	$this->db->select('name');
    	$this->db->like('name', $options['name'], 'after');
    	$query = $this->db->get('refsub');
    	return $query->result();
    }


       function reagentSuggestions(){
            $term = $this->input->post('term',TRUE);
            $rows = $this->getReagentsAutocomplete(array('name' => $term));
            $keywords = array();
            foreach ($rows as $row)
                 array_push($keywords, $row->name);
            echo json_encode($keywords);
       }

    function suggestions()
{

    $term = $this->input->post('term',TRUE);

    $rows = $this->GetAutocomplete(array('name' => $term));

    $keywords = array();
    foreach ($rows as $row)
         array_push($keywords, $row->name);

    echo json_encode($keywords);
}


function refsubSuggestions()
{
	$term = $this->input->post('term',TRUE);
	$rows = $this->getRefsubAutocomplete(array('name' => $term));
	$keywords = array();
	foreach ($rows as $row)
		array_push($keywords, $row->name);

	echo json_encode($keywords);
}

function sourceSuggestions()
	{
	$term = $this->input->post('term',TRUE);
	$rows = $this->getSourceAutocomplete(array('source' => $term));
	$keywords = array();
	foreach ($rows as $row)
		array_push($keywords, $row->source);

	echo json_encode($keywords);
	}

    function getCodes() {
    $ref = $this -> uri -> segment(3);
    $ref1 = str_replace('%20', '_', $ref);
	$ref2 = str_replace('(', '-', $ref1);
	$ref = str_replace(')', '-', $ref2);
    $codes = Refsub::getCodes($ref);
    echo json_encode($codes);
    }

    function getReagentAlias(){
    $ref = $this -> uri -> segment(3);
    $ref = str_replace('%20', '_', $ref);
    $codes = Reagent::getCodes($ref);
    echo json_encode($codes);
    }

    function pushCodes(){
    $codes = $this->getCodes();
    $codes_array = array();

    foreach($codes as $code)
        array_push($codes_array, $code->code);
    echo json_encode($codes_array);
    }



     public function refSublist(){

        $data['content_view'] = "refSub_list_v";
        $data['refsub'] = RefSub::getAll();
        $this -> base_params($data);

    }

    public function crslist(){
        $refsub = RefSubs::getAllHydrated();
        foreach ($refsub as $r){
            $data[] = $r;
        }
        echo json_encode($data);
    }

    public function rgntlist(){
        $reagent = Reagents::getAll();
        foreach($reagent as $r){
            $data[] = $r;
        }
        echo json_encode($data);
    }

    public function rgnt_issue_list(){
        $id = $this -> uri -> segment(3);

        //Do Query
        $sql = "SELECT CONCAT(u.fname, ' ', u.lname) as issuee_name, r.issuer_name, r.s13_number, r.quantity_issued, r.date_issued from reagents_issuance r, user u WHERE r.reagent_id = '$id' AND u.id = r.issuee_id";
        $query = $this->db->query($sql);
        $reagents_issue =  $query -> result_array();

        if(!empty($reagents_issue)){
          foreach($reagents_issue as $r){
              $data[] = $r;
          }
          echo json_encode($data);
        }
        else{
          echo "[]";
        }
    }

    public function rgnt_issue_list_all(){
        //Do Query
        $sql = "SELECT CONCAT(u.fname, ' ', u.lname) as issuee_name, re.name as reagent_name, re.batch_no as reagent_batch, re.date_received as reagent_rdate, re.s11_voucher, re.packaging, re.manufacturer, re.reorder_level, re.quantity, r.issuer_name, r.s13_number, r.quantity_issued, r.date_issued from reagents_issuance r, user u, reagents re WHERE r.reagent_id = re.id AND u.id = r.issuee_id";
        $query = $this->db->query($sql);
        $reagents_issue =  $query -> result_array();

        if(!empty($reagents_issue)){
          foreach($reagents_issue as $r){
              $data[] = $r;
          }
          echo json_encode($data);
        }
        else{
          echo "[]";
        }
    }

     public function clmnlist(){
        $column = Columns::getAll();
        foreach($column as $c){
            $data[] = $c;
        }
        echo json_encode($data);
    }
	

    public function qpmntlist(){
        $equipment = Equipment::getAll();
        foreach($equipment as $e){
            $data[] = $e;
        }
        echo json_encode($data);
    }

     public function clmnlog_list(){
        $cid = $this -> uri -> segment(3);
        $column_log = Columns_log::getColumnLog($cid);
        foreach($column_log as $cl){
            $data[] = $cl;
        }
        echo json_encode($data);
    }



    public function qpmntlog_list(){
        $eid = $this -> uri -> segment(3);
        $query_array = array('equipment_log_id' => $eid);
        $query = $this -> db -> get_where('equipment_log', $query_array);
		var_dump($query);
                foreach($query-> result() as $row){
                    $data[] = $row;
                }
        echo json_encode($data);
    }

     public function rfsblog_episode_list(){
        $rid = $this -> uri -> segment(3);
        $query_array = array('refsub_log_id' => $rid);
        $query = $this -> db -> get_where('refsub_log', $query_array);
                foreach($query-> result() as $row){
                    $data[] = $row;
                }
        echo json_encode($data);
    }

    public function rgntlog_episode_list(){
        $rid = $this -> uri -> segment(3);
        $query_array = array('reagent_log_id' => $rid);
        $query = $this -> db -> get_where('reagent_log', $query_array);
                foreach($query-> result() as $row){
                    $data[] = $row;
                }
        echo json_encode($data);
    }

     public function rgntlog_list(){
        $rid = $this -> uri -> segment(3);
        $query_array = array('reagents_log_id' => $rid);
        $query = $this -> db -> get_where('reagents_log1', $query_array);
                foreach($query-> result() as $row){
                    $data[] = $row;
                }
        echo json_encode($data);
    }

    public function rfsbslog_list(){
        $rid = $this -> uri -> segment(3);
        $query_array = array('refsubs_log_id' => $rid);
        $query = $this -> db -> get_where('refsubs_log', $query_array);
                foreach($query-> result() as $row){
                    $data[] = $row;
                }
        echo json_encode($data);
    }

     //$refsub = RefSubs::getAllHydrated();
     //$this->arrayJSON = $this -> arrayPHPtoJS($refsub);


     /*public function arrayPHPtoJS($refsub){
        if(is_null($refsub)) return 'null';
        if(is_string($refsub)) return "'".$refsub."'";
        if(self::is_assoc($refsub)){
            $a = array();
            foreach($refsub as $key => $val)
                $a[]=self::arrayPHPtoJS($val);
            return "[" . implode(', ', $a ). "]";
        }
        if(is_array($refsub)){
            $a = array();
            foreach($refsub as $val){
                $a[]=self::arrayPHPtoJS($val);
                return "[".implode(', ', $a) . "]";
            }
            return json_encode($refsub);
        }

        $refsub = RefSubs::getAllHydrated();
     $arrayJSON = $this -> arrayPHPtoJS($refsub);
    }*/

    public function refSubs(){

        $data['content_view'] = "refSubs_v";
    	$this -> base_params($data);

    }

    public function refSubsadd_i(){
        $data['rs'] = Refsub::getAll();
        $data['content_view'] = "refSubs_add_v";
        $this -> base_params($data);

    }

    public function refSubslist(){

        $data['content_view'] = "refsubslist_ajax";
        $data['refsubs'] = Refsubs::getAll();
        $this -> base_params($data);


    }

    public function reagents_fancybox(){
    	$rid = $this -> uri -> segment(3);
    	$data['content_view'] = "fancybox_div_reagentslist";
    	$data['reagent'] = Reagents::getReagent($rid);
    	$this -> load -> view ("template1", $data);
    }

    public function refsublist_fancybox(){
        $rid = $this -> uri -> segment(3);
        $data['content_view'] = "fancybox_div_refsubslist";
        $data['refsub'] = Refsubs::getRefSub($rid);
        $this -> load -> view ("template1", $data);
    }

    public function refSubsadd(){

      $data['content_view'] = "refSub_add_v";
      $this -> base_params($data);

    }

    public function chemicals(){

    	$data['content_view'] = "chemicals_v";
        $this -> base_params($data);

    }

    public function chemicalslist(){

    $data['content_view'] = "chemicals_list_v";
    $data['chemicals'] = Chemicals::getAll();
    $this -> base_params($data);
    }

    public function chemicalsadd(){


   $data['content_view'] = "chemicals_add_v";
        $this -> base_params($data);
    }

    public function chemicals_save(){

            if (is_null($_POST)) {
            echo json_encode(array(
            'status' => 'error',
            'message'=> 'Data was not posted.'
            ));
            }
        else
            {
            echo json_encode(array(
                'status' => 'success',
                'message'=> 'Data added successfully'
            ));
            }



        $i_desc = $this -> input -> post("i_desc");
        $u_issue = $this -> input -> post("u_issue");
        $physical = $this -> input -> post("physical");
        $value = $this -> input -> post("value");
        $ledger = $this -> input -> post("ledger");
        $variation = $this -> input -> post("variation");


        $chem =  new Chemicals();

            $chem -> item_description = $i_desc;
            $chem -> unit_of_issue = $u_issue;
            $chem -> physical = $physical;
            $chem -> value = $value;
            $chem -> ledger = $ledger;
            $chem -> variation = $variation;
            $chem -> save();


    }


    public function equipment(){

    	$data['content_view'] = "equipment_v";
        $this -> base_params($data);
    }


      public function equipmentadd(){
        $data['content_view'] = "equipment_add_v";
        $this -> base_params($data);
    }


      public function equipmentlist(){

        $data['equipment'] = Equipment::getAll();
		$data['stats']=$this->getCount();
        $data['content_view'] = "equipment_list_v";
        $this -> base_params($data);

    }
	
	function getCount(){
		return $this->db->query("SELECT status, COUNT(*) count
FROM equipment 
GROUP by status")->result();
	}

    public function equipment_fancybox(){
        $eid = $this -> uri -> segment(3);
        $data['content_view'] = "fancybox_equipmentlist";
        $data['equipment'] = Equipment::getEquipmentEdit($eid);
		
        $this -> load -> view ("template1", $data);
    }

    public function reagentslist(){

    	$data['content_view'] = "reagents_list_ajax_v";
        $data['reagents'] = Reagents::getAll();
        $this -> base_params($data);
    }

    public function reagent_issues_list(){
      $data['content_view'] = "reagents_issues_list_ajax_v";
      $data['reagents'] = Reagents::getAll();
      $this -> base_params($data);
    }

    public function reagentsadd(){

    	$data['content_view'] = "reagents_add_v";
    	$this -> base_params($data);

    }

    public function reagentadd(){

    	$data['content_view'] = "reagent_add_v";
    	$this -> base_params($data);

    }

    public function reagent_save(){

    	if (is_null($_POST)) {
    		echo json_encode(array(
    				'status' => 'error',
    				'message'=> 'Data was not posted.'
    		));
    	}
    	else
    	{
    		echo json_encode(array(
    				'status' => 'success',
    				'message'=> 'Data added successfully'
    		));
    	}



    	$name = $this -> input -> post("name");
    	//$description = $this -> input -> post("description");
    	$code = "NQCL-RG-";
    	$alias = str_replace(' ', '_', $name);

    	$reagent =  new Reagent();

    	$reagent -> name = $name;
    	$reagent -> code =  $code;
    	$reagent -> alias = $alias;
    	$reagent -> save();

    }

    public function reagents_save(){

    	if (is_null($_POST)) {
    		echo json_encode(array(
    				'status' => 'error',
    				'message'=> 'Data was not posted.'
    		));
    	}
    	else
    	{
    		echo json_encode(array(
    				'status' => 'success',
    				'message'=> 'Data added successfully'
    		));
    	}



    	$name = $this -> input -> post("name");
    	$comment = $this -> input -> post("comment");
    	$mfctrer = $this -> input -> post("manufacturer");
    	$batch_no = $this -> input -> post("batch_no");
    	$date_r = $this -> input -> post("date_r");
    	$date_o = $this -> input -> post("date_o");
    	$date_e = $this -> input -> post("date_e");
    	$quantity = $this -> input -> post("quantity");
    	$qunit = $this -> input -> post("qunit");
    	$r_level = $this -> input -> post("reorder_l");
    	$rl_unit = $this -> input -> post("rlunit");
    	$packaging = $this -> input -> post("packaging");
    	$no_of_units = $this -> input -> post("no_of_units");
    	$form = $this -> input -> post("form");
    	$reagentid = $this -> input -> post("reagentid");
      $s11_voucher = $this -> input -> post("s11_voucher");

        if(date('y-m-d') > date('y-m-d',strtotime($date_e))){
            $status = "Expired";
        }
        else{

            $status = "Effective";
        }

    	$reagent =  new Reagents();

    	$reagent -> name = $name;
    	$reagent -> comment = $comment;
    	$reagent -> manufacturer = $mfctrer;
    	$reagent -> batch_no = $batch_no;
    	$reagent -> date_of_expiry = date('y-m-d',strtotime($date_e));
    	$reagent -> date_received =date('y-m-d',strtotime($date_r));
    	$reagent -> date_opened = date('y-m-d',strtotime($date_o));
    	$reagent -> reorder_level = $r_level;
    	// $reagent -> r_level_unit = $rl_unit;
    	$reagent -> volume = $quantity;
    	$reagent -> qunit = $qunit;
    	$reagent -> packaging = $packaging;
    	$reagent -> quantity = $no_of_units;
        $reagent -> form = $form;
    	$reagent -> status = $status;
      $reagent -> s11_voucher = $s11_voucher;

        $reagent -> save();




    	$r_tracking = new Reagents_log();
    	$r_tracking -> batch_no = $batch_no;
    	$r_tracking -> quantity = $quantity;
    	$r_tracking -> qunit = $qunit;
    	$r_tracking -> status = $status;
    	$r_tracking -> save();

    }


    public function reagentlist(){

    		$data['content_view'] = "reagent_list_v";
    		$data['reagent'] = Reagent::getAll();
    		$this -> base_params($data);
    }


    public function reagents_edit(){

    	if (is_null($_POST)) {
    		echo json_encode(array(
    				'status' => 'error',
    				'message'=> 'Data was not posted.'
    		));
    	}
    	else
    	{
    		echo json_encode(array(
    				'status' => 'success',
    				'message'=> 'Data added successfully'
    		));
    	}



    	$name = $this -> input -> post("name");
    	$mfctrer = $this -> input -> post("manufacturer");
    	$batch_no = $this -> input -> post("batch_no");
    	$date_r = $this -> input -> post("date_r");
    	$date_e = $this -> input -> post("date_e");
    	$quantity = $this -> input -> post("quantity");
    	$qunit = $this -> input -> post("qunit");
    	$r_level = $this -> input -> post("r_level");
    	$packaging = $this -> input -> post("packaging");
    	$volume = $this -> input -> post("volume");
    	$reagent_id = $this -> input -> post("reagent_id");
        $edit_status = "1";
        $comment = $this -> input -> post("comment");
        $form = $this -> input -> post("form");
        $status = $this -> input -> post("status");

    	$reagent_update = array(
    			'name' => $name,
    			'manufacturer' => $mfctrer,
    			'batch_no' => $batch_no,
    			'date_received' => date('y-m-d',strtotime($date_r)),
    			'date_of_expiry' => date('y-m-d',strtotime($date_e)),
    			'reorder_level' => $r_level,
    			'packaging' => $packaging,
    			'quantity' => $quantity,
    			'qunit' => $qunit,
    			'volume' => $volume,
                'edit_status' => $edit_status,
                'comment' => $comment,
                'form' => $form,
                'status' => $status
    	);

    	$this -> db -> where('id',$reagent_id);
    	$this -> db -> update('reagents', $reagent_update);

    }

    public function reagents_issue(){

      //Echo json response
      if (is_null($_POST)) {
        echo json_encode(array(
            'status' => 'error',
            'message'=> 'Data was not posted.'
        ));
      }
      else
      {
        echo json_encode(array(
            'status' => 'success',
            'message'=> 'Reagent Issued Successfully'
        ));
      }

      //Get input values
      $s13_number = $this -> input -> post("s13_number");
      $reagent_id = $this -> input -> post("reagent_id");
      $issuee_id = $this -> input -> post("issuee_id");
      $issuer_id = $this -> input -> post("issuer_id");
      $issuer_name = $this -> input -> post("issuer_name");
      $quantity_issued = $this -> input -> post("quantity_issued");
      $date_issued = date('y-m-d');

      //Point to Model Objects
      $r_issue = new Reagents_issuance();
      $r_issue -> s13_number = $s13_number;
      $r_issue -> reagent_id = $reagent_id;
      $r_issue -> issuee_id = $issuee_id;
      $r_issue -> issuer_id = $issuer_id;
      $r_issue -> issuer_name = $issuer_name;
      $r_issue -> quantity_issued = $quantity_issued;
      $r_issue -> date_issued = $date_issued;
      $r_issue -> save();

      //Get existing quantity
      $e_qty = Reagents::getQuantity($reagent_id);
      $existing_quantity = $e_qty[0]['quantity'];
      $i_count = $e_qty[0]['issuance_count'];

      //Calculate remaining quantity
      $remaining_qty = $existing_quantity - $quantity_issued;

      //Calculate issuance count
      $issuance_count = $i_count + 1;

      //Update main reagents table
      $where_array = array('id'=>$reagent_id);
      $update_array = array('quantity'=> $remaining_qty, 'issuance_count' => $issuance_count);

      $this -> db -> where($where_array);
      $this -> db -> update('reagents',$update_array);

    }

    public function reagents_issue_view(){
      $rid = $this -> uri -> segment(3);
      $data['content_view'] = "reagents_issue_view";
      $data['reagent'] = Reagents::getReagent($rid);
      $data['analysts'] = User::getAnalystsAll();
      $this -> load -> view ("template1", $data);
    }

	public function refsubCheckAvailability()
		{
    		$substance_name = $this->uri->segment(3);
    		$substance_count = Refsub::getNameCount($substance_name);

    		if($substance_count[0]['count'] == 1 ){
    			echo json_encode(array('status'=>'Unavailable',
    					'message'=>'Standard Exists'));
    		}
    		else{

    			echo json_encode(array('status'=>'Available'));
    		}

		}

    public function reagentCheckAvailability()

        {
            $reagent_name = $this->uri->segment(3);
            $reagent_count = Reagent::getNameCount($reagent_name);

            if($reagent_count[0]['count'] == 1 ){
                echo json_encode(array('status'=>'Unavailable',
                        'message'=>'Standard Exists'));
            }
            else{

                echo json_encode(array('status'=>'Available'));
            }

        }

      public function equipment_save(){

            if (is_null($_POST)) {
            echo json_encode(array(
            'status' => 'error',
            'message'=> 'Data was not posted.'
            ));
            }
        else
            {
            echo json_encode(array(
                'status' => 'success',
                'message'=> 'Data added successfully'
            ));
            }


        $maxid = Equipment::getMax();
        $serial_id = (int)$maxid[0]['count'];

        $name = $this -> input -> post("name");
        $sno = $this -> input -> post("serial_no");
        $model = $this -> input -> post("model");
        $nqcl_no = "NQCL" . "-" . date('Y') ."-" . ($serial_id + 1);
        $date_a = $this -> input -> post("date_a");
        $date_c1 = $this -> input -> post("date_c1");
        $date_cn = $this -> input -> post("date_cn");
        $status = $this -> input -> post("status");
        $type = $this -> input -> post("type");


        $equip =  new Equipment();

            $equip -> name = $name;
            $equip -> serial_no = $sno;
            $equip -> model = $model;
            $equip -> nqcl_no = $nqcl_no;
            $equip -> date_acquired = date('y-m-d',strtotime($date_a));
            $equip -> date_of_calibration = date('y-m-d',strtotime($date_c1));
            $equip -> date_of_nxtcalibration = date('y-m-d',strtotime($date_cn));
            $equip -> status = $status;
            $equip -> type = $type;
            $equip -> save();


    }

    /*public function maxquip(){
         $maxid = Equipment::getMax();
         var_dump((int)$maxid[0]['count'] + 1);


    }*/

    public function equipment_edit(){

            if (is_null($_POST)) {
            echo json_encode(array(
            'status' => 'error',
            'message'=> 'Data was not posted.'
            ));
            }
        else
            {
            echo json_encode(array(
                'status' => 'success',
                'message'=> 'Data added successfully'
            ));
            }

        $name = $this -> input -> post("ename");
        $sno = $this -> input -> post("esno");
        $model = $this -> input -> post("model");
        //$nqcl_no = $this -> input -> post("nqcl_no");
        $date_a = $this -> input -> post("date-acq");
        $date_c1 = $this -> input -> post("date-cal");
        $date_cn = $this -> input -> post("date-nxtcal");
        $status = $this -> input -> post("status");
        $dbid = $this -> input -> post("dbid");
        $comment = $this -> input -> post("comment");
        $type = $this -> input -> post("type");
        $date_acq = date('y-m-d',strtotime($date_a));
        $date_cal = date('y-m-d',strtotime($date_c1));
        $date_nxtcal = date('y-m-d',strtotime($date_cn));
        $edit_status = "1";


        $equip_update = array(
         'name' => $name,
         'serial_no' => $sno,
         'date_acquired' => $date_acq,
         'date_of_calibration' => $date_cal,
         'date_of_nxtcalibration' => $date_nxtcal,
         'status' => $status,
         'edit_status' => $edit_status,
         'comment' => $comment,
         'model' => $model,
         'type' => $type
        );

        $this -> db -> where('id', $dbid);
        $this -> db -> update('equipment', $equip_update);


    }

    public function columns(){


        $data['content_view'] = "columns_v";
        $this -> base_params($data);

    }


    public function columns_fancybox(){
        $cid = $this -> uri -> segment(3);
        $data['content_view'] = "fancybox_columnslist";
        $data['analysts'] = User::getAnalystsAll();
        $data['column'] = Columns::getColumnEdit($cid);
        $this -> load -> view ("template1", $data);
    }

    public function columnsadd(){

       $data['content_view'] = "columns_add_v";
       $this -> base_params($data);
    }


    public function columnslist(){

        $data['content_view'] = "columns_list_v";
        $data['columns'] = Columns::getAll();
		$data['types']=$this->getColumn('column_type','column_types');
		$data['dimensions']=$this->getColumn('column_dimensions','column_types');
        $data['analysts'] = User::getAllAnalysts();
        $data['analystsd'] = User::getAllAnalystsData();
	
        $this -> base_params($data);

    }
	
	function getColumn($details,$table){
		return $this->db->query("SELECT id, $details FROM $table GROUP BY $details")->result();
	}

    public function columns_showHistory() {

        $data['cid'] = $this -> uri -> segment(3);
        //$data['content_view'] = "columns_history_v";
        $data['column'] = Columns::getColumn($data['cid']);
        $this -> load -> view ("columns_history_v", $data);

    }

    public function reagents_showHistory() {

        $data['rid'] = $this -> uri -> segment(3);
        //$data['content_view'] = "columns_history_v";
        $data['reagents'] = Reagents::getReagent($data['rid']);
        $this -> load -> view ("reagents_history_v", $data);

    }

    public function reagent_showHistory() {

        $data['rid'] = $this -> uri -> segment(3);
        //$data['content_view'] = "columns_history_v";
        $data['reagent'] = Reagent::getReagent($data['rid']);
        $this -> load -> view ("reagent_history_v", $data);

    }

    public function refsub_showHistory() {

        $data['rid'] = $this -> uri -> segment(3);
        //$data['content_view'] = "columns_history_v";
        $data['refsub'] = Refsub::getRefsub1($data['rid']);
        $this -> load -> view ("refsub_history_v", $data);

    }
    public function equipment_showHistory() {

        $data['eid'] = $this -> uri -> segment(3);
        //$data['content_view'] = "columns_history_v";
        $data['equipment'] = Equipment::getEquipment($data['eid']);
        $this -> load -> view ("equipment_history_v", $data);

    }

    public function refsubs_showHistory() {

        $data['rid'] = $this -> uri -> segment(3);
        //$data['content_view'] = "columns_history_v";
        $data['refsubs'] = Refsubs::getRefsub($data['rid']);
        $this -> load -> view ("refsubs_history_v", $data);

    }

    public function columns_save(){

            if (is_null($_POST)) {
            echo json_encode(array(
            'status' => 'error',
            'message'=> 'Data was not posted.'
            ));
            }
        else
            {
            echo json_encode(array(
                'status' => 'success',
                'message'=> 'Data added successfully'
            ));
            }

        $col_no = $this -> input -> post("col_no");
        $type = $this -> input -> post("type");
        $sno = $this -> input -> post("serial_no");
        $cdimens = $this -> input -> post("dimensions");
        $mnfcturer = $this -> input -> post("manufacturer");
        $date_r = $this -> input -> post("date_r");
        $status = "Reserved";


        $column =  new Columns();

            $column -> column_type = $type;
            $column -> serial_no = $sno;
            $column -> column_dimensions = $cdimens;
            $column -> manufacturer = $mnfcturer;
            $column -> date_received =date('y-m-d',strtotime($date_r));
            $column -> column_no = $col_no;
         // $column -> date_issued = date('y-m-d',strtotime($date_i));
            $column -> column_status = $status;
            $column -> save();


    }


    public function column_edit(){

            if (is_null($_POST)) {
            echo json_encode(array(
            'status' => 'error',
            'message'=> 'Data was not posted.'
            ));
            }
        else
            {
            echo json_encode(array(
                'status' => 'success',
                'message'=> 'Data added successfully'
            ));
            }

        $type = $this -> input -> post("type");
        $sno = $this -> input -> post("serial_no");
        //$col_no = $this -> input -> post("col_no");
        $cdimens = $this -> input -> post("column_dimensions");
        $mnfcturer = $this -> input -> post("manufacturer");
        $date_r = $this -> input -> post("date_r");
        $dbid = $this -> input -> post("dbid");
		$column_type_id = $this->input->post("column_type_id");
        $status = $this -> input -> post("status");
        $comment = $this -> input -> post("comment");
        $edit_status = "1";
		$column_status = $this->input->post("status");
		$issued_to = $this->input->post("issued_to");
		$dbissued_to = $this->input->post("dbissued_to");
		$quantity_received = $this->input->post("quant_r");
		
		//Set issuance status
		if(!empty($issued_to)){
			$issuance_status = 1;
		}else{
			$issuance_status = 0;
		}
		
		//Update Column Type
		  $update_columnType = array(
			  'column_type' => $type,
			  'column_dimensions' => $cdimens,
			  'manufacturer' => $mnfcturer,
			  'date_received' => date('Y-m-d', strtotime($date_r)),
			  'quantity_received' => $quantity_received
		  );
		  
		  //Update Column Issue
		  $update_columnIssue = array(
			 'analyst_id' => $issued_to,
			 'issue_date' => date('Y-m-d')
		  );
		  
		  //Update Main Column
		  $updateColumnMain = array(
			 'serial_no' => $sno,
			 'comment' => $comment,
			 'issuance_status' => $issuance_status,
			 'column_status' => $column_status,
			 'edit_status' => $edit_status
		  );


        $this -> db -> where('id', $column_type_id);
        $this -> db -> update('column_types', $update_columnType);
        
		if($issued_to != $dbissued_to){
			$this -> db -> where('id', $dbid);
			$this -> db -> update('column_issue', $update_columnIssue);
		}
		
        $this -> db -> where('id', $dbid);
        $this -> db -> update('columns', $updateColumnMain);

    }

    public function column_delete(){
       $cid = $this -> uri -> segment(3);
       $this -> db -> delete('columns', array('id' => $cid));
    }

    public function reagent_episode_delete(){
       $cid = $this -> uri -> segment(3);
       $this -> db -> delete('reagent', array('id' => $cid));
    }

    public function reagent_delete(){
       $cid = $this -> uri -> segment(3);
       $this -> db -> delete('reagents', array('id' => $rid));
    }

    public function equipment_delete(){
       $eid = $this -> uri -> segment(3);
       $this -> db -> delete('equipment', array('id' => $eid));
    }

    public function standard_episode_delete(){
       $cid = $this -> uri -> segment(3);
       $this -> db -> delete('refsub', array('id' => $cid));
    }

    public function standard_delete(){
       $cid = $this -> uri -> segment(3);
       $this -> db -> delete('refSubs', array('id' => $cid));
    }

     public function columns_fancybox_issue(){
        $cid = $this -> uri -> segment(3);
        $data['content_view'] = "columns_issue_v";
        $data['analysts'] = User::getAllAnalysts();
        $data['column'] = Columns::getColumn($cid);
        $this -> load -> view ("template1", $data);
    }

    public function column_issue(){

            if (is_null($_POST)) {
            echo json_encode(array(
            'status' => 'error',
            'message'=> 'Data was not posted.'
            ));
            }
        else
            {
            echo json_encode(array(
                'status' => 'success',
                'message'=> 'Data added successfully'
            ));
            }

        $analyst_id = $this -> input -> post("analyst_id");
        $column_id = $this -> input -> post("column_id");
        $issue_date = date('y-m-d');
        $status = "Issued";
        $column_id = $this-> uri -> segment(3);

            $column =  new Column_issue();
            $column -> column_id = $column_id;
            $column -> issue_date = $issue_date;
            $column -> analyst_id = $analyst_id;
            $column -> save();

            $columnupdate = array('status' => $status,
                'issued_to' => $analyst_id, 'edit_status' => "1");
            $this -> db -> where('id', $column_id);
            $this -> db -> update('columns', $columnupdate);


    }


        public function base_params($data) {
        $data['title'] = "Inventory";
        //$data['content_view'] = "inventory_v";
        $this -> load -> view('template', $data);
    }


}


?>
