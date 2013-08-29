<?php

class Reagents extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('name', 'varchar', 50);
		$this -> hasColumn('comment', 'varchar', 255);
		$this -> hasColumn('manufacturer', 'varchar', 35);
		$this -> hasColumn('batch_no', 'varchar', 15);
		$this -> hasColumn('date_received', 'date');
		$this -> hasColumn('date_opened', 'date');
		$this -> hasColumn('date_of_expiry', 'date');
		$this -> hasColumn('reorder_level', 'varchar', 30);
		$this -> hasColumn('packaging', 'varchar', 30);
		$this -> hasColumn('volume', 'int', 11);
		$this -> hasColumn('qunit','varchar', 15);
		$this -> hasColumn('quantity','int', 11);
	}

	public function setUp() {
		$this -> setTableName('reagents');
	}//end setUp


	public function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("reagents");
		$equipmentData = $query -> execute();
		return $equipmentData;
	}//end getAll

}
?>