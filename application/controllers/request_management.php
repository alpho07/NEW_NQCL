<?php
class Request_Management extends MY_Controller {

	function __construct() {
		parent::__construct();
	}

	public function index() {
		$this -> listing();
	}

	function GetAutocomplete($options=array())
    {
        $this->db ->distinct();
        $this->db->select('name');
        $this->db->like('name', $options['name'], 'after');
        $query = $this->db->get('clients');
        return $query->result();

    }
        
        
    function suggestions()
{
    
    $term = $this->input->post('term',TRUE);

    $rows = $this->GetAutocomplete(array('name' => $term));

    $keywords = array();
    foreach ($rows as $row)
         array_push($keywords, $row->name);

    echo json_encode($keywords);
	
	
}


function GetAutocompleteManufacturerAddress($options=array())
    {
        $this->db ->distinct();
        $this->db->select('manufacturer_add');
        $this->db->like('manufacturer_add', $options['manufacturer_add'], 'after');
        $query = $this->db->get('request');
        return $query->result();

    }
        
        
    function suggestions1()
{
    
    $term = $this->input->post('term',TRUE);

    $rows = $this->GetAutocompleteManufacturerAddress(array('manufacturer_add' => $term));

    $keywords = array();
    foreach ($rows as $row)
         array_push($keywords, $row->manufacturer_add);

    echo json_encode($keywords);
}

	function GetLabelClaim($options=array())
    {
        $this->db ->distinct();
        $this->db->select('label_claim');
        $this->db->like('label_claim', $options['label_claim'], 'after');
        $query = $this->db->get('request');
        return $query->result();

    }
        
        
    function suggestions2()
{
    
    $term = $this->input->post('term',TRUE);

    $rows = $this->GetLabelClaim(array('label_claim' => $term));

    $keywords = array();
    foreach ($rows as $row)
         array_push($keywords, $row->label_claim);

    echo json_encode($keywords);
}

function GetProductName($options=array())
    {
        $this->db ->distinct();
        $this->db->select('product_name');
        $this->db->like('product_name', $options['product_name'], 'after');
        $query = $this->db->get('request');
        return $query->result();

    }
        
        
    function suggestions3()
{
    
    $term = $this->input->post('term',TRUE);

    $rows = $this->GetProductName(array('product_name' => $term));

    $keywords = array();
    foreach ($rows as $row)
         array_push($keywords, $row->product_name);

    echo json_encode($keywords);
}



    function getCodes() {
    $ref = $this -> uri -> segment(3);
    $ref = str_replace('%20', '_', $ref);
    $codes = Clients::getClientDetails($ref);
    echo json_encode($codes);
    }

    function pushCodes(){
    $codes = $this->getCodes();
    $codes_array = array();

    foreach($codes as $code)
        array_push($codes_array, $code->code);
    echo json_encode($codes_array);
    }

    function suggestions4()
{
    
    $term = $this->input->post('term',TRUE);

    $rows = $this->GetProductDescription(array('description' => $term));

    $keywords = array();
    foreach ($rows as $row)
         array_push($keywords, $row->description);

    echo json_encode($keywords);
}

	function GetProductDescription($options=array())
    {
        $this->db ->distinct();
        $this->db->select('description');
        $this->db->like('description', $options['description'], 'after');
        $query = $this->db->get('request');
        return $query->result();

    }


    public function test_methods(){
    $reqid = $this -> uri -> segment(3);
    $data['tests'] = Request_details::getTests($reqid);
    $data['settings_view'] = "tests_methods_v";
    $this -> base_params($data);
    }


    public function getTestMethods(){
    	$testid = $this -> uri -> segment(3);
    	$methods = Test_methods::getMethods($testid);
    	echo json_encode($methods);
    }

     public function getMethodTypes(){
    	$types = Test_methods_types::getAll();
    	echo json_encode($types);
    }

	public function history(){
		
		$reqid = $this -> uri -> segment(3);
		$version_id = $this -> uri -> segment(4);
		//$data['row_count'] = Request::getRowCount();
		$data['history'] = Request::getHistory($reqid, $version_id);
		//$this -> view -> load('history_table');
		//$data['test_history'] = Request_details::testHistory($reqid, $version_id);
		//$data['settings_view'] = "history";
		$this -> load -> view('history',$data);
	
	}


	public function other_history(){
		
		$reqid = $this -> uri -> segment(3);
		$version_id = $this -> uri -> segment(4);
		//$data['row_count'] = Request::getRowCount();
		$data['chistory'] = Clients::getHistory($reqid, $version_id);
		$data['thistory'] = Request_details::getTestHistory($reqid, $version_id);
		//$this -> view -> load('history_table');
		//$data['test_history'] = Request_details::testHistory($reqid, $version_id);
		//$data['settings_view'] = "history";
		$this -> load -> view('other_history',$data);
	
	}
	

	public function getLabelPdf(){
		
		require_once("application/helpers/dompdf/dompdf_config.inc.php");
	    
	    $this->load->helper('dompdf','file');
	    $this->load->helper('file');
	    
	    $dompdf = new DOMPDF();
	    $dompdf->set_paper('A4', "portrait");
	    
	    $saveTo = './labels'; 
	    $data['reqid'] = $this -> uri -> segment(3);
		$data['prints_no'] = $this -> uri -> segment(4);   
	    $labelname = "Label". $data['reqid'] ."-". $data['prints_no'] . ".pdf";
	    $data['infos'] =Request::getSample($data['reqid']);
	    $data['settings_view'] = "tests_label_v";
	    $this -> base_params($data);
	    $html = $this->load->view('tests_label_v', $data, TRUE);
	    
	    $dompdf->load_html($html);
	    $dompdf->render();
	    write_file($saveTo."/".$labelname, $dompdf->output());
}

	public function edit_view() {
		$data['requests'] = Request::getAll();
		$this -> load -> view("requests_v_ajax", $data);
	}

	public function requests_list(){
        $request = Request::getAllHydrated();
        foreach ($request as $r){
            $data[] = $r;
        }
        echo json_encode($data);
    }

    public function getClientInfo(){
    	$id = $this -> uri -> segment(3);
    	$id = Clients::getClientInfo($id);
    	echo json_encode($id);
    }	

	public function listing() {
		//$data = array();
		$data['settings_view'] = "requests_v_ajax";
		$data['info'] =Request::getAll();
		$this -> base_params($data);
	}//end listing


	function ajax_loader() {
        $this->db->select_max('id');
        $query = $this->db->get('request');
        $data = $query->result();
        echo json_encode($data);
}


		function ajax_client_loader() {
        $this->db->select_max('id');
        $query = $this->db->get('clients');
        $data = $query->result();
        return $data;
	}

	public function add() {
		$data['new_clientid'] = $this -> ajax_client_loader();
		$data['months'] = Months::getAll();
		$data['title'] = "Add New Request";
		$data['last_req_id']= Request::getLastRequestId();
		$data['lastClient'] = Clients::getLastId();
		//var_dump($data['last_req_id']);
		$data['dosageforms'] = Dosage_form::getAll();
		$data['packages'] = Packaging::getAll();
		$data['usertypes'] = User_type::getAll();
		$data['clients'] = Clients::getAll();
		$data['sample_id'] = Sample_Information::getAll();
		$data['wetchemistry'] = Tests::getWetChemistry();
		$data['microbiologicalanalysis'] = Tests::getMicrobiologicalAnalysis();
		$data['medicaldevices'] = Tests::getMedicalDevices();
		$data['scripts'] = array("jquery-ui.js");
		$data['scripts'] = array("jquery.ui.core.js","jquery.ui.datepicker.js","jquery.ui.widget.js");		
		$data['styles'] = array("jquery.ui.all.css");
		$data['settings_view'] = "request_v";
		$this -> base_params($data);
	}//end add

	
	public function edit(){
		$reqid = $this -> uri -> segment(3);
		$data['reqid'] = $this -> uri -> segment(3);
		$data['tests_checked']  = Request_details::getTestsNames($reqid);
		$data['tests_issued'] = Sample_issuance::getIssuedTests2($reqid);
		$data['months'] = Months::getAll();
		$data['dosageforms'] = Dosage_form::getAll();
		$data['wetchemistry'] = Tests::getWetChemistry();
		$data['microbiologicalanalysis'] = Tests::getMicrobiologicalAnalysis();
		$data['medicaldevices'] = Tests::getMedicalDevices();
		$data['client'] = Clients::getClient2($reqid);
		$data['request'] = Request::getAll5($reqid);	
		$data['settings_view'] = "edit_request_v";
		$data['info'] =Request::getAll();
		$this -> base_params($data);
	}
	
	
	public function getTestName(){
		$test_id = $this -> uri -> segment(3);
		$test = Tests::getTestName3($test_id);
        foreach ($test as $t){
            $data[] = $t;
        }
        echo json_encode($data);
	}


	public function save() {


		if (is_null($_POST)) {
            echo json_encode(array(
            'status' => 'error',
            'message'=> 'Data was not posted.'
            ));  
            }
        else
            {
            echo json_encode(array(
                'status' => 'success',
                'message'=> 'Data added successfully',
                'array' => json_encode($_POST)
            ));
            }

            $dsgntr = $this -> input -> post("dsgntr");
            $dsgntn = $this -> input -> post("dsgntn");
            $moa = $this -> input -> post("moa");
            $crs = $this -> input -> post("crs");
		$mtid = $this -> input -> post("mtid");
        $dateformat = $this -> input -> post("dateformat");   
        $Analysistype = $this -> input -> post("analysistype");    
        $Analysistype_mid = $this -> input -> post("analysistypemid");   
        $id_multic = $this -> input -> post("id_mc");   
        $Multic_mid = $this -> input -> post("Multicomponentmid");
        $Multis_mid = $this -> input -> post("Multistagemid");   
        $Multistage = $this -> input -> post("Multistage");
        $Multicomponent = $this -> input -> post("Multicomponent");
       	$aas_no = $this -> input -> post("aas_no");
        $method_type = $this -> input -> post("methdids");
        $multi_no2 = $this -> input -> post("multi_no2"); 
        $testids = $this -> input -> post("testids");
		$charge = $this -> input -> post("charge");	    
        $multi_no = $this -> input -> post("multi_no");    
        $method_types = $this -> input -> post("method_type");   
        $method_test = $this -> input -> post("method_test");  
		$methods = $this -> input -> post("methods");
		$test =$this -> input -> post("test");
		$clientid = $this -> input -> post("clientid");
		$product_name = $this -> input -> post("product_name");
		$dosage_form = $this -> input -> post("dosage_form");
		$manufacturer_name = $this -> input -> post("manufacturer_name");
		$manufacturer_address = $this -> input -> post("manufacturer_address");
		$batch_no = $this -> input -> post("batch_no");
			if($dateformat == 'dmy'){
			$expiry_date = $this -> input -> post("date_e");
			$manufacture_date = $this -> input -> post("date_m");
			}
			else if($dateformat == 'my'){
			$ed = "31 ". $this -> input -> post("e_date");
			$md = "01 ". $this -> input -> post("m_date");	
			$expiry_date = str_replace(' ', '-', $ed);
			$manufacture_date = str_replace(' ', '-', $md);
			}
		$label_claim = $this -> input -> post("label_claim");
		$active_ingredients = $this -> input -> post("active_ingredients");
		$quantity = $this -> input -> post("quantity");
		$applicant_reference_number = $this -> input -> post("applicant_reference_number");
		$client_number = $this -> input -> post("ndqno");
		$designator_name = $this -> input -> post("designator_name");
		$designation = $this -> input -> post("designation");
		$designation_date = $this -> input -> post("designation_date");
		$urgency = $this -> input -> post("urgency");
		$edit_notes = $this -> input -> post("edit_notes");
		$country_of_origin = $this -> input -> post("country_of_origin");
		$product_lic_no = $this -> input -> post("product_lic_no");
		$presentation = $this -> input -> post("presentation");
		$description = $this -> input -> post("description");
		$clientsampleref = $this -> input -> post("applicant_reference_number");
		$packaging = $this -> input -> post("packaging");
		
		
		$request = new Request();
			$request -> dsgntn = $dsgntn;
			$request -> dsgntr = $dsgntr;
			$request -> moa = $moa;
			$request -> crs = $crs;
			$request -> clientsampleref = $clientsampleref;
			$request -> dateformat = $dateformat;
			$request -> description = $description;
			$request -> presentation = $presentation;
			$request -> product_lic_no = $product_lic_no;
			$request -> country_of_origin = $country_of_origin;
			$request -> client_id = $clientid;
			$request -> product_name = $product_name;
			$request -> Dosage_Form = $dosage_form;
			$request -> Manufacturer_Name = $manufacturer_name;
			$request -> Manufacturer_add = $manufacturer_address;
			$request -> Batch_no = $batch_no;
			//if($dateformat == 'dmy'){
			$request -> exp_date = date('Y-m-d', strtotime($expiry_date));
			$request -> Manufacture_date = date('Y-m-d', strtotime($manufacture_date));
			//}
			$request -> label_claim = $label_claim;
			$request -> Urgency = $urgency;
			$request -> active_ing = $active_ingredients;
			$request -> sample_qty = $quantity;
			$request -> request_id = $client_number;
			$request -> Designator_Name = $designator_name;
			$request -> Designation = $designation;
			$request -> Designation_date = date('y-m-d',strtotime($designation_date));
			$request -> edit_notes = $edit_notes;
			$request -> packaging = $packaging;
			$request -> save();
			$this->create_sample_folder($client_number);
                        //$this->add_sample_to_priority_table();4
                        $this->addSampleTrackingInformation();
		

		for($i=0;$i<count($test);$i++){
			$request = new Request_details();
			$request -> test_id = $test[$i];
			$request -> request_id = $client_number;
			$request -> save();
		}

		for($i=0;$i<count($test);$i++){
			$coa = new Coa_body();
			$coa -> test_id = $test[$i];
			$coa -> labref = $client_number;
			$coa -> save();
		}
                for($i=0;$i<count($test);$i++){
			$coa = new Sample_summary();
			$coa -> test_id = $test[$i];
			$coa -> labref = $client_number;
			$coa -> save();
		}
		
		if($this -> checkUserExistsThenSendorError() == '0' ){
			$client_name = $this -> input -> post("client_name");
			$client_address = $this -> input -> post("client_address");
			$client_number = $this -> input -> post("clientT");
			$contact_person = $this -> input -> post("contact_person");
			$contact_phone = $this -> input -> post("contact_phone");
			//$client_ref_no = $this -> input -> post("client_ref_no");
			$client_id = $this -> input -> post("clientid");
			$alias = str_replace(' ', '_', $client_name);
			//variable storing the class instance
			$client = new Clients();
			
			//passing the variables posted above to the class variable
			$client -> Name = $client_name;
			$client -> Address = $client_address;
			$client -> Client_type = $client_number;
			$client -> Contact_person = $contact_person;
			$client -> Contact_phone = $contact_phone;
			//$client -> Ref_number = $client_ref_no;
			
			$client -> Clientid = $client_id;
			$client -> Alias = $alias;
			//save the data						
			$client -> save();
		}


		
				
	}



	   public function checkUserExistsThenSendorError() {
        $user_is = $this->input->post('clientid');
        $this->db->select('clientid');
        $this->db->where('id', $user_is);
        $query = $this->db->get('clients');
	        if ($query->num_rows() > 0) {
	            return '1';
	        } else {
	            return '0';
	        }
    	}	




	public function quotation(){
		
		$reqid = $this -> uri -> segment(4);
		$methodIdArray = Request_test_methods::getMethods($reqid);
		$testIdArray = Request_details::getTests($reqid);
		
		foreach ($methodIdArray as $methodArray){
		$data['method_charges'][] = Test_methods_charges::getCharges($methodArray['test_id']);
		}
		
		foreach ($testIdArray as $testArray){
		$data['test_charges'][] = Tests::getCharges($testArray['test_id']);
		}
		
		/*for($i = 0; $i < count($testIdArray); $i++){
		$data['test_charges'][] = Tests_charges::getCharges($testIdArray[$i]['id']);
		}*/
		
		//var_dump($testIdArray);
		$data['settings_view'] = 'invoice_v';
		$this -> base_params($data);
	}

	public function getMethodCharges(){
		$mid = $this -> uri -> segment(3);
		$data['mcharges'] = Test_methods_charges::getMethodCharges($mid);
		$data['settings_view'] = "mcharges_v";
	}

	public function update(){
		
			
		//Variables storing the analysis request variables
		//variable storing the class instance
		
		$tests =$this -> input -> post("test");
		$clientid = $this -> input -> post("client_id");
		$product_name = $this -> input -> post("product_name");
		$dosage_form = $this -> input -> post("dosage_form");
		$manufacturer_name = $this -> input -> post("manufacturer_name");
		$manufacturer_address = $this -> input -> post("manufacturer_address");
		$batch_no = $this -> input -> post("batch_no");
		$dateformat = $this -> input -> post("dateformat");
		$expiry_date = $this -> input -> post("date_e");
		$manufacture_date = $this -> input -> post("date_m");
		$label_claim = $this -> input -> post("label_claim");
		$active_ingredients = $this -> input -> post("active_ingredients");
		$quantity = $this -> input -> post("quantity");
		$applicant_reference_number = $this -> input -> post("client_ref_no");
		$client_number = $this -> input -> post("lab_ref_no");
		$designator_name = $this -> input -> post("designator_name");
		$designation = $this -> input -> post("designation");
		$designation_date = $this -> input -> post("designation_date");
		$edit_notes = $this -> input -> post("edit_notes");
		$country_of_origin = $this -> input -> post("country_of_origin");
		$product_lic_no = $this -> input -> post("product_lic_no");
		$presentation = $this -> input -> post("presentation");
		$description = $this -> input -> post("description");
		$tests_issued = Sample_issuance::getIssuedTests2($client_number);

		//$client_id =  $this -> input -> post("client_id");
			//Variables hold client information
			$client_name = $this -> input -> post("client_name");
			$client_address = $this -> input -> post("client_address");
			$client_type = $this -> input -> post("clientT");
			$contact_person = $this -> input -> post("contact_person");
			$contact_phone = $this -> input -> post("contact_phone");
			$client_ref_no = $this -> input -> post("client_ref_no");

		//Analysis update array holds above variables , later to 
		//be passed to update() function (CodeIgniter.)

		$analysis_update_array =  array(
		'client_id' => $clientid ,
		'product_name' => $product_name,
		'Dosage_form' => $dosage_form  ,
		'Manufacturer_Name' => $manufacturer_name ,
		'Manufacturer_add' => $manufacturer_address ,
		'Batch_no'  => $batch_no,
		'dateformat' => $dateformat ,
		'exp_date' => $expiry_date ,
		'Manufacture_date' => $manufacture_date  ,
		'label_claim' =>  $label_claim  ,
		'active_ing' => $active_ingredients ,
		'sample_qty' => $quantity ,
		'clientsampleref' => $applicant_reference_number  ,
		'request_id' => $client_number  ,
		'Designation_date' =>  $designation_date ,
		'edit_notes' => $edit_notes ,
		'country_of_origin' => $country_of_origin  ,
		'product_lic_no' => $product_lic_no ,
		'presentation' => $presentation ,
		'description' =>  $description  );

		//Array stores client details to be updated
		$client_update_array = array(
			 'Name' => $client_name ,
			 'Address' => $client_address,
			 'Client_type' => $client_type,
			 'Contact_person' => $contact_person,
			 'Contact_phone' => $contact_phone
		);

		//For loop , iterates through array of test ids, updating
		//each accordingly

		for($i = 0; $i < count($tests); $i++){

		foreach($tests_issued as $tests_i){
			if($tests[$i] != $tests_i['Test_id']){
				$request = new Request_details();
				$request -> test_id = $test[$i];
				$request -> request_id = $client_number;
				$request -> save();
			}	
		 }

		}
	
		//Codeigniter where() and update() methods update tables accordingly.
		$this -> db -> where('request_id', $client_number);
		$this -> db -> update('request', $analysis_update_array);
		
		$this -> db -> where('clientid', $clientid);
		$this -> db -> update('clients', $client_update_array);
		
		//User is redirected to the requests listing page.
		redirect("request_management/listing");
		
		
	}
	
	public function edit_history(){
		$reqid = $this -> uri -> segment(3);
		$data['title'] = "Requests Edit History";
		$data['settings_view'] = "requests_edit_history_v";
		$data['info'] = Request::getHistory($reqid);
		//$data['requestInformation'] = $requestInformation;
		$this -> base_params($data);
		
	}
	
	
	
	
	public function requests($id){
		$data['title'] = "Request Information";
		$data['settings_view'] = "requests_v";
		$requestInformation = Request::getRequest($id);
		$data['requestInformation'] = $requestInformation;
		$this -> base_params($data);
	}


	public function create_sample_folder($labref){
		$workbooks = "Workbooks";
		if(is_dir($workbooks)){
			mkdir($workbooks."/".$labref, 0777, true);
			$this -> create_workbook($labref);
		}
	}

	public function create_workbook($labref){
		$workbooks = "Workbooks";
		$target = "original_workbook/Template.xlsx";
		$destination = "Workbooks/".$labref. "/". $labref. ".xlsx";
		if(is_dir($workbooks."/".$labref)){
			copy($target, $destination);		
		 }
		//redirect("request_management/listing");
	}
        public function add_sample_to_priority_table(){
            $data=array(
                'labref'=> $this -> input -> post("ndqno"),
                'priority'=>'High'
            );
            $this->db->insert('priority_table',$data);
        }
         public function getUsersInfo() {
        $user_id = $this->session->userdata('user_id');
        $this->db->select('fname,lname');
        $this->db->where('id', $user_id);
        $query = $this->db->get('user');
        return $result = $query->result();
    }
        
        function addSampleTrackingInformation(){
            $userInfo=  $this->getUsersInfo();
            $client=$this -> input -> post("client_name");
            $activity='Samples Recieving';
            $labref=$this -> input -> post("ndqno");
            $names=$userInfo[0]->fname." ". $userInfo[0]->lname;
            $from = $client. '- Client';
            $to= $names .'- Documentation';
            $date=date('d-M-Y H:i:s');
         
            $array_data=array(
              'labref'=>$labref,
                'activity'=>$activity,
                'from'=>$from,
                'to'=>$to,
                'date'=>$date,
                'stage'=>'1',
                'current_location'=>'Documentation'
            );
            $this->db->insert('worksheet_tracking',$array_data);
        }


	public function base_params($data) {
		$data['title'] = "Request Management";
		$data['styles'] = array("jquery-ui.css");
		$data['scripts'] = array("jquery-ui.js");
		$data['scripts'] = array("SpryAccordion.js");
		$data['styles'] = array("SpryAccordion.css");
		$data['quick_link'] = "request";
		$data['content_view'] = "settings_v";
		$data['banner_text'] = "NQCL Settings";
		$data['link'] = "settings_management";

		$this -> load -> view('template', $data);
	}//end base_params
}