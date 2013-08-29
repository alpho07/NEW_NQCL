<?php

class Reagent extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('name', 'varchar', 50);
		$this -> hasColumn('code', 'varchar', 30);
		$this -> hasColumn('description', 'varchar', 30);
	}

	public function setUp() {
		$this -> setTableName('reagent');
	}//end setUp


	public function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("reagent");
		$equipmentData = $query -> execute();
		return $equipmentData;
	}//end getAll

}
?>