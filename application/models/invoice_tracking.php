<?php
class Invoice_tracking extends Doctrine_Record {
	public function setTableDefinition() {
		$this -> hasColumn('invoice_no', 'varchar',50);
		$this -> hasColumn('quotation_no', 'varchar',50);
		$this -> hasColumn('stage', 'varchar',50);
		$this -> hasColumn('notes', 'varchar',50);		
		$this -> hasColumn('user_id', 'int',11);
		$this -> hasColumn('user_type_id', 'int', 11);
		$this -> hasColumn('discount', 'int',11);
		$this -> hasColumn('amount_kes', 'int', 11);
		$this -> hasColumn('batch_total_kes', 'int', 11);
		$this -> hasColumn('payable_amount_kes', 'int', 11);
		$this -> hasColumn('amount_usd', 'int', 11);
		$this -> hasColumn('batch_total_usd', 'int', 11);
		$this -> hasColumn('payable_amount_usd', 'int', 11);
		$this -> hasColumn('currency', 'varchar', 20);
		$this -> hasColumn('date', 'date');		
	}

	public function setUp() {
		$this -> setTableName('invoice_tracking');

		$this -> hasOne('User', array(
			'local' => 'user_id',
			'foreign' => 'id'
		));

		$this->hasOne('User_type', array(
			'local' => 'user_type_id',
			'foreign' => 'id'
		));
	}

	//Get tracking by User Id
	public static function getTrackingByUSer($user_id) {
		$query = Doctrine_Query::create() -> select("*") 
		->from("invoice_tracking i")
		->where("user_id =?", $user_id)
		->leftJoin('i.User u')
		->leftJoin('i.User_type ut');
		$inv_tracking = $query -> execute(array(), DOCTRINE::HYDRATE_ARRAY);
		return $inv_tracking;
	}

	//Get tracking by Invoice Number
	public static function getTrackingByInvoice($invoice_no) {
		$query = Doctrine_Query::create() 
		-> select("i.*, u.fname, u.lname, ut.*") 
		-> from("invoice_tracking i")
		-> leftJoin('i.User u')
		-> leftJoin('i.User_type ut')
		-> where("invoice_no =?", $invoice_no);
		$inv_tracking = $query -> execute(array(), DOCTRINE::HYDRATE_ARRAY);
		return $inv_tracking;
	}
	
	public static function getTrackingByQuotation($quotation_no) {
		$query = Doctrine_Query::create() 
		-> select("i.*, u.fname, u.lname, ut.*") 
		-> from("invoice_tracking i")
		-> leftJoin('i.User u')
		-> leftJoin('i.User_type ut')
		-> where("quotation_no =?", $quotation_no);
		$inv_tracking = $query -> execute(array(), DOCTRINE::HYDRATE_ARRAY);
		return $inv_tracking;
	}

	//Get all tracking data
	public static function getAllTrackingData() {
		$query = Doctrine_Query::create() 
		-> select("*") 
		-> from("invoice_tracking i")
		->leftJoin('i.User u')
		->leftJoin('i.User_type ut');;
		$inv_tracking = $query -> execute(array(), DOCTRINE::HYDRATE_ARRAY);
		return $inv_tracking;
	}


	public static function getLastEntry($invoice_no){
		$query = Doctrine_Query::create() 
		-> select("*") 
		-> from("invoice_tracking")
		-> where("invoice_no=?", $invoice_no)
		-> orderBy("id DESC")
        -> limit(1);
		$inv_tracking = $query -> execute(array(), DOCTRINE::HYDRATE_ARRAY);
		return $inv_tracking;
	}

}