<?php 
class Q_test_multis extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('client_number', 'varchar',30);
		$this -> hasColumn('stages_no', 'int',11);
		$this -> hasColumn('method_id', 'int',11);			
	}
	
	public function setUp(){
		$this -> setTableName('q_test_multis');
	}
	
	public static function getAll() {
	$query = Doctrine_Query::create() -> select("*")
	-> from("q_test_multis");
	$test_multi = $query -> execute() -> toArray();
	return $test_multi;
	}	

	public static function getMultis($reqid, $tid) {
	$query = Doctrine_Query::create() -> select("*")
	-> from("q_test_multis")
	-> where("client_number =?", $reqid);
	$q_test_multis = $query -> execute() -> toArray();
	return $q_test_multis;
	}	

} 
?>