<?php

class Client_billing extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('request_id', 'int', 11);
		$this -> hasColumn('client_id', 'varchar', 30);
		$this -> hasColumn('test_id', 'int', 11);
		$this -> hasColumn('method_id', 'int', 11);
		$this -> hasColumn('test_charge', 'int', 11);
		$this -> hasColumn('method_charge', 'int', 11);
		$this -> hasColumn('component_status', 'int', 11);
		$this -> hasColumn('stage_status', 'int', 11);
		$this -> hasColumn('charge_system', 'int', 11);
		$this -> hasColumn('stages', 'int', 11);
		$this -> hasColumn('total', 'int', 11);
		$this -> hasColumn('currency', 'varchar', 11);
		$this -> hasColumn('proforma_no', 'varchar', 50);

	}

	public function setUp() {
		$this->actAs('Timestampable');
		$this -> setTableName('client_billing');
		
		$this -> hasMany('tests',array(
			'local' => 'test_id',
			'foreign' => 'id'			
		));
		
		$this -> hasMany('test_methods',array(
			'local' => 'method_id',
			'foreign' => 'id'			
		));

		$this -> hasOne('clients',array(
			'local' => 'client_id',
			'foreign' => 'id'			
		));

		$this -> hasMany('coa_body',array(
			'local' => 'request_id',
			'foreign' => 'labref'			
		));

		$this -> hasOne('Dispatch_register',array(
			'local' => 'request_id',
			'foreign' => 'request_id'			
		));


	}//end setUp


	public function getChargesPerClient($rid){
		$query = Doctrine_Query::create()
		-> select("c.test_charge,c.method_charge,t.Name,cb.compedia, cb.method")
		-> from("client_billing c")
		-> leftJoin("c.coa_body cb")
		-> leftJoin("c.tests t")
		-> where("c.request_id =?", $rid)
		-> andWhere("c.test_id = cb.test_id");
		$clientData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $clientData;
	}
	
	public function getCurrency($reqid){
		$query = Doctrine_Query::create()
		-> select("c.currency")
		-> from("client_billing c")
		-> where("c.request_id =?", $reqid);
		$cData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $cData;
	}

	public function getAll2(){
		$query = Doctrine_Query::create()
		-> select("c.*, t.*, m.*, cl.*")
		-> from("client_billing c")
		-> leftJoin("c.tests t")
		-> leftJoin("c.test_methods m")
		-> leftJoin("c.clients cl")
		-> groupBy("c.request_id");
		$clientData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $clientData;
	}

	public function getTotal($rid){
		$query = Doctrine_Query::create()
		-> select('c.*, m.*, t.*, sum(c.test_charge + c.method_charge)')
		-> from("client_billing c")
		-> where("c.request_id =?", $rid)
		-> leftJoin("c.tests t")
		-> leftJoin("c.test_methods m");
		$clientData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $clientData;	
	}
	
	public function getTotalperClient($cid){
		$query = Doctrine_Query::create()
		-> select('sum(c.test_charge + c.method_charge), d.id, c.id')
		-> from("client_billing c")
		-> where("c.client_id =?", $cid)
		-> leftJoin("c.Dispatch_register d")
		-> andWhere("d.date =?", date('y-m-d'));
		//-> orWhere("d.date = ?", date('y-m-d', time() - 60*60*24));
		$clientData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $clientData;	
	}


		public function getTotalperClientProforma($cid,$proforma_no){
			$query = Doctrine_Query::create()
			-> select('sum(c.test_charge + c.method_charge), d.id, c.id')
			-> from("client_billing c")
			-> where("c.client_id =?", $cid)
			-> andWhere("c.proforma_no =?", $proforma_no)
			-> leftJoin("c.Dispatch_register d");
			//-> orWhere("d.date = ?", date('y-m-d', time() - 60*60*24));
			$clientData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
			return $clientData;	
	}


	public function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("client_billing");
		$clientData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $clientData;
	}//end getall

	public function getClient_billingPerRequest($id){
		$query = Doctrine_Query::create()
		-> select('*')
		-> from("client_billing c")
		-> leftJoin("c.tests t")
		-> leftJoin("c.test_methods m")
		-> where("c.request_id =?", $id);
		$clientData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $clientData;	
	}

}