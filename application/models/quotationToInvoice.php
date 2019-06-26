<?php

class QuotationToInvoice extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('request_id', 'varchar', 50);
		$this -> hasColumn('quotation_no', 'varchar', 50);
		$this -> hasColumn('inv_quotation_no', 'varchar', 50);
		$this -> hasColumn('inv_quotations_id', 'varchar', 50);
		$this -> hasColumn('quotations_id', 'varchar', 50);
		//$this -> hasColumn('Request_id', 'int', 25);
	}

	public function setUp() {
		$this -> setTableName('quotationToInvoice');
		/*$this -> hasOne('Departments as Department',
		array(
		'local'=> 'dept_id',
		'foreign' => 'id'
		));*/
	}//end setUp

	

}
?>