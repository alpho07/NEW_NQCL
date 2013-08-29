<?php

class Coa_body extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('labref', 'varchar', 20);
		$this -> hasColumn('test_id', 'int', 11);
		$this -> hasColumn('compedia', 'varchar', 100);
		$this -> hasColumn('specification', 'varchar', 100);
	}

	public function setUp() {
		$this -> setTableName('coa_body');
	}//end setUp

	public function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("coab_body");
		$coaData = $query -> execute();
		return $coaData;
	}


}
?>