<?php

class Refsub extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('name', 'varchar', 30);
		$this -> hasColumn('s_type', 'varchar', 30);
		$this -> hasColumn('code', 'varchar', 30);
		$this -> hasColumn('alias','varchar', 50);
	}

	public function setUp() {
		$this -> setTableName('refsub');
	}


	public function getMax(){
		$query = Doctrine_Query::create()
		-> select(max())
		-> from('refsub');
		$maxData = $query -> execute() -> toArray();
		return $maxData;
	}

	public function getCount($f_letter) {
		$query = Doctrine_Query::create() 
		-> select('count(distinct(name))')
		-> from("refsub")
		-> where("name like '$f_letter%'")
		;
		$requestData = $query -> execute() -> toArray();
		return $requestData;
	}

	public function getAll(){
		$query = Doctrine_Query::create()
		-> select('*')
		-> from ('refsub')
		-> groupBy('name');
		$refsubs = $query -> execute();
		return $refsubs;
	}
	
	public function getCodes($ref){
		$query = Doctrine_Query::create()
		-> select('code')
		-> from ('refsub')
		-> where('alias =?', $ref);
		$refsubs = $query -> execute() -> toArray();
		return $refsubs;
	}

}


?>