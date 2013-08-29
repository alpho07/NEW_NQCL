<?php

class Q_request_details extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('client_number', 'varchar', 35);
		$this -> hasColumn('test_id', 'int', 11);
	}

	public function setUp() {
		$this -> setTableName('q_request_details');
	}//end setUp

	public function getTestsNames($reqid){
		$query = Doctrine_Query::create()
		-> select("alias, Test_type")
		-> from("tests, q_request_details")
		-> where('q_request_details.client_number =?', $reqid)
		-> andWhere('tests.id = q_request_details.test_id')
		//-> where("request_details.version_id IN (select max(request_details.version_id) from request_details where request_details.request_id = '$reqid')")
		//-> andWhere('tests.id = request_details.test_id')
		;
		$testData = $query -> execute(array(), DOCTRINE::HYDRATE_ARRAY);
		return $testData;
	}

}
?>