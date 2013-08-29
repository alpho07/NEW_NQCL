<?php

class Clients extends Doctrine_Record {

	public function setTableDefinition() {
		
		$this -> hasColumn('Clientid', 'int', 11);
		$this -> hasColumn('Name', 'varchar', 50);
		$this -> hasColumn('Address', 'varchar', 25);
		$this -> hasColumn('Client_type', 'varchar', 5);
		$this -> hasColumn('Contact_person', 'varchar', 25);
		$this -> hasColumn('Contact_phone', 'int', 10);
		//$this -> hasColumn('Ref_number', 'varchar',20);
		$this -> hasColumn('Version_id','int', 11);
		$this -> hasColumn('Alias', 'varchar', 50);
	
	}

	public function setUp() {
		$this->actAs('Timestampable');
		$this -> setTableName('clients');
		$this -> hasMany('Request',array(
			'local' => 'Clientid',
			'foreign' => 'client_id'			
				));
	}//end setUp

	public function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("clients");
		$clientData = $query -> execute();
		return $clientData;
	}//end getall

	public function getAllHydrated() {
		$query = Doctrine_Query::create() -> select("Name,Address,Client_type,Contact_person,Contact_phone") -> from("clients");
		$clientData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $clientData;
	}


	public function getClient($reqid) {

		$query = Doctrine_Query::create() 
		-> select("c.*") 
		-> from("clients c, request r")
		-> where("r.request_id = '$reqid' && r.client_id = c.id");
		//where("id IN (select max(id) from request where r.request_id = '$reqid') && r.client_id = c.id");
		$clientData =  $query -> execute() -> getFirst();
		return $clientData;
	}


		public function getClient2($reqid) {

		$query = Doctrine_Query::create() 
		-> select("c.*") 
		-> from("clients c, request r")
		-> where("r.request_id = '$reqid' && r.client_id = c.id");
		//where("r.id IN (select max(r.id) from request where r.request_id = '$reqid') && r.client_id = c.clientid");
		$clientData =  $query -> execute() -> getLast();
		return $clientData;
	}



	public function getNames($cl_id) {
		$query = Doctrine_Query::create() 
		-> select("*") 
		-> from("clients")
		-> where("id IN (select max(id) from clients where clientid = '$cl_id')");
		;
		$clientData = $query -> execute();
		return $clientData;
	}

	public function getLast(){
		$query = Doctrine_Query::create()
		-> select("*")
		-> from("clients");
		$lastClientData = $query -> execute() -> toArray();
		return $lastClientData;
	}
	
	public function getHistory($reqid, $version_id){
		$query = Doctrine_Query::create()
		-> select("*")
		-> from("clients , request")
		-> where("request.client_id = clients.clientid")
		-> andWhere("clients.version_id =?", $version_id)
		-> andWhere("request.request_id =?", $reqid)
		-> orderBy('id DESC');
		$lastClientData = $query -> execute() -> getLast();
		return $lastClientData;
	}


	public function getClientInfo($id){
		$query = Doctrine_Query::create()
		-> select("*")
		-> from("clients")
		-> where("id =?", $id);
		$clientdata = $query -> execute() -> toArray();
		return $clientdata;
	}

	public function getLastId(){

		$query = Doctrine_Query::create()
		-> select("max(id)")
		-> from("clients");
		$lastid = $query -> execute() -> toArray();
		return $lastid;
	}

	public function getClientDetails($ref) {
		$query = Doctrine_Query::create()
		-> select('*')
		-> from('clients')
		-> where('alias =?', $ref);
		$clientdetails = $query -> execute() -> toArray();
		return $clientdetails;
	}

}
?>