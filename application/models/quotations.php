<?php

class Quotations extends Doctrine_Record {
	
	public function setTableDefinition() {
	
	$this->hasColumn('Client_number','varchar', 35);	
	$this->hasColumn('Client_name','varchar', 35);
	$this->hasColumn('Sample_name','varchar', 35);
	$this->hasColumn('Sample_no','int', 11);
	$this->hasColumn('Quotation_date','varchar',35);
	$this->hasColumn('Active_ingredients','varchar',35);
	$this->hasColumn('Dosage_form','int', 11);
	}

	public function setUp() {
		$this -> setTableName('Quotations');
	}//end setUp


	public function getLastId(){
		$query = Doctrine_Query::create()
		-> select('max(id)')
		-> from("quotations");
		$lastreqid = $query -> execute() -> toArray();
		return $lastreqid;
	}


public function getSample($reqid) {
		$query = Doctrine_Query::create() -> select("*") 
		-> from("quotations")
		-> where("client_number =?", $reqid);
		$productData = $query -> execute() -> toArray();
		return $productData;
	}//end getall

	public function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("Quotations");
		$productData = $query -> execute() -> toArray();
		return $productData;
	}//end getall

}

?>