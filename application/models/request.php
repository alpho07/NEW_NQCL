<?php

class Request extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('request_id', 'varchar', 20);
		$this -> hasColumn('client_id', 'varchar', 11);
		$this -> hasColumn('sample_qty', 'int', 11);
		$this -> hasColumn('product_name', 'varchar', 30);
		$this -> hasColumn('label_claim', 'varchar', 255);
		$this -> hasColumn('active_ing', 'varchar', 200);
		$this -> hasColumn('Dosage_Form', 'varchar', 30);
		$this -> hasColumn('Manufacturer_Name', 'varchar', 50);
		$this -> hasColumn('Manufacturer_add', 'varchar', 50);
		$this -> hasColumn('Batch_no', 'varchar', 20);
		$this -> hasColumn('exp_date', 'date');
		$this -> hasColumn('Manufacture_date', 'date');
		$this -> hasColumn('Designator_Name', 'varchar', 50);
		$this -> hasColumn('Designation', 'varchar', 30);
		$this -> hasColumn('Designation_date', 'date');
		$this -> hasColumn('Urgency', 'int', 11);
		$this -> hasColumn('edit_notes', 'varchar', 255 );
		$this -> hasColumn('presentation', 'varchar', 255);
		$this -> hasColumn('description', 'varchar', 255);
		$this -> hasColumn('product_lic_no', 'varchar', 35);
		$this -> hasColumn('country_of_origin', 'varchar', 35);
		$this -> hasColumn('dateformat', 'varchar', 10);
		$this -> hasColumn('clientsampleref', 'varchar' , 30);
		$this -> hasColumn('moa', 'varchar', 30);
		$this -> hasColumn('crs', 'varchar', 30);
		$this -> hasColumn('dsgntr', 'varchar', 30);
		$this -> hasColumn('dsgntn', 'varchar', 30);
		$this -> hasColumn('packaging', 'int', 11);
	}

	public function setUp() {
		$this->actAs('Timestampable');
		$this -> setTableName('request');
		$this -> hasOne('Clients', array(
			'local' => 'client_id',
			'foreign' => 'clientid'
		));
		$this -> hasOne('Packaging', array(
			'local' => 'packaging',
			'foreign' => 'id'
			));
	}

	
	
	public function getHistory($reqid) {
		$query = Doctrine_Query::create() 
		-> select("*") 
		-> from("request")
		-> where("request_id = ?", $reqid)
		-> orderBy("id DESC")
		-> limit(3); 
		$requestData = $query -> execute();
		return $requestData;
	}//end getall
	
	public function getAll7() {
		$query = Doctrine_Query::create() 
		-> select("*") 
		-> from("request");
		$requestData = $query -> execute();
		return $requestData;
	}

	public function getAll() {
		$query = Doctrine_Query::create() 
		-> select("*") 
		-> from("request");
		$requestData = $query -> execute();
		return $requestData;
	}//end getall

	 public static function get_value($delivery){
  	
		$query=Doctrine_Query::create()-> select("*")->from("request")-> where("id=$delivery");
		$order=$query->execute();
		return $order[0];
	}

	public function getAllHydrated() {
		$query = Doctrine_Query::create() 
		-> select("r.*, c.*, p.*")
		-> from("request r")
		-> innerJoin("r.Clients c")
		-> innerJoin("r.Packaging p");
		$requestData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $requestData;
	}

	public function getRequest($id) {
		$query = Doctrine_Query::create() -> select("*") -> from("request") -> where("Request_id = $id");
		$requestData = $query -> execute();
		return $requestData;
	}//end getRequest

	
	public function getRequestId() {
		$query = Doctrine_Query::create() 
		-> select('*')
		-> from("request");
		$requestData = $query -> execute() -> getLast();
		return $requestData;
	}//end getRequest
	
	
	public function getProducts($lab_ref_no) {
		$query = Doctrine_Query::create() 
		-> select('*')
		-> from("request")
		-> where('request_id =?', $lab_ref_no);
		$requestData = $query -> execute();
		return $requestData;
	}

	public function getSample($reqid) {
		$query = Doctrine_Query::create() 
		-> select('*')
		-> from("request")
		-> where('request_id =?', $reqid);
		$requestData = $query -> execute() -> toArray();
		return $requestData;
	}
	
	
	public function getAll5($reqid) {
		$query = Doctrine_Query::create() 
		-> select('*')
		-> from("request")
		-> where("request_id = ?", $reqid);
		$requestData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $requestData;
	}

	public function getLastRequestId(){
		$query = Doctrine_Query::create()
		-> select('max(id)')
		-> from("request");
		$lastreqid = $query -> execute() -> toArray();
		return $lastreqid;
	}
	
}
?>