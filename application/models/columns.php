<?php

class Columns extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('column_type', 'varchar', 60);
		$this -> hasColumn('column_no', 'int', 11);
		$this -> hasColumn('serial_no', 'varchar', 30);
		$this -> hasColumn('column_dimensions', 'varchar', 30);
		$this -> hasColumn('manufacturer', 'varchar', 30);
		$this -> hasColumn('date_received', 'date');
		$this -> hasColumn('status', 'varchar', 30);
		$this -> hasColumn('reserved_for', 'varchar', 100);
	}

	public function setUp() {
		$this -> setTableName('columns');
	}//end setUp

	public function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("columns");
		$equipmentData = $query -> execute();
		return $equipmentData;
	}//end getAll

}
?>