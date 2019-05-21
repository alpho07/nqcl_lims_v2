<?php

class Quotation_notes extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('quotation_no', 'varchar', 30);
		$this -> hasColumn('client_note', 'text');
		$this -> hasColumn('system_note', 'text');
		$this -> hasColumn('note_id', 'int');	
	}

	public function setUp() {
		$this -> setTableName('quotation_notes');
		$this -> hasOne('Quotations_final',
		array(
			'local' => 'quotation_no',
			'foreign' => 'quotation_no'
		));
	}//end setUp

	public function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("quotation_notes");
		$coaData = $query -> execute();
		return $coaData;
	}

	public static function getAllSpecialNotes($quotation_id){
		$query = Doctrine_Query::create()
		-> select('*')
		-> from("quotation_notes")
		-> where("quotation_no = ?", $quotation_id);
		$notes = $query -> execute() -> toArray();
		return $notes;			 	
	}


	public static function getAllDefaultNotes(){
		$query = Doctrine_Query::create()
		-> select('*')
		-> from("quotation_notes")
		-> where("quotation_no = ?", "Default");
		$notes = $query -> execute() -> toArray();
		return $notes;			 	
	}

}
?>
