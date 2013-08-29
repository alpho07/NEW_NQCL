<?php

class Tests extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('Name', 'varchar', 35);
		$this -> hasColumn('Department', 'varchar', 25);
		$this -> hasColumn('Alias', 'varchar', 25);
		$this -> hasColumn('Test_type', 'int', 11);
		$this -> hasColumn('Charge', 'int', 11);
	}

	public function setUp() {
		$this -> setTableName('tests');
		$this -> hasOne('request_details as request_detail',
		array(
		'local'=>'id',
		'foreign' => 'test_id'
		));
	}//end setUp

	public function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("tests");
		$testData = $query -> execute();
		return $testData;
	}//end getall

	public function getWetChemistry() {
		$query = Doctrine_Query::create() -> select("*") -> from("tests") -> where('Department = 1');
		$testData = $query -> execute();
		return $testData;
	}//end getall

	public function getMicrobiologicalAnalysis() {
		$query = Doctrine_Query::create() -> select("*") -> from("tests") -> where('Department = 2');
		$testData = $query -> execute();
		return $testData;
	}//end getall

	public function getMedicalDevices() {
		$query = Doctrine_Query::create() -> select("*") -> from("tests") -> where('Department = 3');
		$testData = $query -> execute();
		return $testData;
	}//end getall

	public function getAllHydrated() {
		$query = Doctrine_Query::create() -> select("Name,Charge") -> from("tests");
		$testData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $testData;
	}
	
		public static function getTestName($reqid, $dept_id, $tests_version_id){
		$query=Doctrine_Query::create()
		->select("t.Name, t.Department, t.Id" )
		->from("Tests t, Request_details r")
		->where('r.Request_id = ?', $reqid)
		->andWhere("r.test_id = t.id") 
		->andWhere('t.Department =?', $dept_id)
		//->andWhere('r.version_id =?', $tests_version_id)
		//->andWhere('t.Department = ?',$dept_id);
		; 
		$testData=$query->execute(array(), DOCTRINE::HYDRATE_ARRAY);
		return $testData;
	}
	
	
	public static function getTestName3($test_id) {
		
		$query = Doctrine_Query::create()
		->select('t.Name' )
		->from('Tests t')
		->where('t.id = ?', $test_id);
		
		$testNamesData = $query->execute() -> toArray();
		return $testNamesData;
	}

	public static function getTestNames($user_id){
		
		$query = Doctrine_Query::create()
		->select('t.Name, t.Department, t.Id')
		->from('Tests t, Sample_issuance s')
		->where('s.Analyst_id = ?', $user_id)
		->andWhere('t.Id = s.Test_id');
		
		$testNamesData = $query->execute(array(), Doctrine::HYDRATE_ARRAY);
		return $testNamesData;
		
	}

	public static function getWorksheet($test_id){
		
		$query = Doctrine_Query::create()
		->select('alias')
		->from('tests')
		->where('id = ?', $test_id);		
		$worksheetData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $worksheetData;
	}

	public static function getWetchem() {
		
		$query = Doctrine_Query::create()
		->select('id')
		->from('tests')
		->where('department = ?', 1);		
		$worksheetData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $worksheetData;
		
	}

	public static function getMedevices() {
		
		$query = Doctrine_Query::create()
		->select('id')
		->from('tests')
		->where('department = ?', 3);		
		$worksheetData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $worksheetData;
		
	}

	public static function getBiological() {
		
		$query = Doctrine_Query::create()
		->select('id')
		->from('tests')
		->where('department = ?', 2);		
		$worksheetData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $worksheetData;
		
	}
	
	public static function getUnit($reqid){
		$query =  Doctrine_Query::create()
		->select('Department')
		->from('Tests, Request_details')
		
		->Where('request_id = ?', $reqid)
		->andWhere('id = test_id')
		->groupBy('Department');
		$unitdata = $query -> execute()->toArray();
		return $unitdata;
		
	}

	public static function getUnit2($reqid){
		$query =  Doctrine_Query::create()
		->select('Department')
		->from('Tests, Request_details')
		//-> where("request_details.version_id IN (select max(request_details.version_id) from request_details where request_details.request_id = '$reqid')")
		->where('Tests.id = Request_details.test_id')
		->groupBy('Department');
		$unitdata = $query -> execute()->toArray();
		return $unitdata;
		
	}

		public function getCharges($test_id) {
		$query = Doctrine_Query::create() -> select("*") 
		-> from("tests")
		-> where("id = ?", $test_id);
		$methodData = $query -> execute() -> toArray();
		return $methodData;
	}


}
?>