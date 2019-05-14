<?php

class Invoice_tests extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('index', 'int', 11);
		$this -> hasColumn('lab_ref_no', 'varchar', 30);
		$this -> hasColumn('test', 'varchar', 50);
		$this -> hasColumn('method', 'varchar', 50);
		$this -> hasColumn('compedia', 'varchar', 50);
		$this -> hasColumn('cost', 'double');
	}

	public function setUp() {
		$this->actAs('Timestampable');
		$this -> setTableName('invoice');
		
		$this -> hasOne('invoice',array(
			'local' => 'lab_ref_no',
			'foreign' => 'lab_ref_no'			
		));

	}//end setUp



}