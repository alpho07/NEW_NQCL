<?php

class Sample_issue extends MY_Controller{
	function __construct(){
		parent::__construct();
	}//end constructor
	
	//public function index(){
		//$this -> listing();
	//}//end index
	
		public function save() {
			
		$lab_ref_no = $this -> input -> post("lab_ref_no");
		$analyst_id = $this -> input -> post("analyst_id");
		$dept_id = $this -> input -> post("dept_id");
		$sample_qty = $this -> input -> post("upd_samples_qty");
		$samples_no = $this -> input -> post("samples_no");
		$tests_version_id = $this  -> input -> post("tests_version_id");
		$req_version_id = $this  -> input -> post("req_version_id");
		$version_id = $this -> input -> post("version_id");	
			
		
		$upd_qty = $sample_qty - $samples_no; 
		$reqid = $lab_ref_no;
		$mytests = Tests::getTestName($reqid, $dept_id, $tests_version_id);
		
	
 
		
		//var_dump($mytests);
		foreach ($mytests as $test) {	
		//$test_id = $this -> input -> post("test_id");
		$lab_ref_no = $this -> input -> post("lab_ref_no");
		$analyst_id = $this -> input -> post("analyst_id");
		//$department_id = $this -> input -> post("department_id");
		$samples_no = $this -> input -> post("samples_no");
		$status_id = $this -> input -> post("status_id");
		$dept_id = $this -> input -> post("dept_id");
		$split_status = $this -> input -> post("splitstatus");
		
		
		
		$sample_issue = new Sample_issuance();
		$sample_issue -> Test_id = $test['id'];
		$sample_issue -> Lab_ref_no = $lab_ref_no;
		$sample_issue -> Department_id = $dept_id;
		$sample_issue -> Samples_no = $samples_no;
		$sample_issue -> Status_id = $status_id;
		$sample_issue -> Analyst_id = $analyst_id;
		$sample_issue -> Split_status = $split_status;
				
		
		$sample_issue -> save();
		$this->updateUrgency();
		}              
                
		
		$lab_ref_no = $this -> input -> post("lab_ref_no");
		$dept_id = $this -> input -> post("dept_id");
		//redirect("/sample_issue/assign/$lab_ref_no/$dept_id/$upd_qty");

		$sql = "UPDATE request SET sample_qty = '$upd_qty'  where request_id = '$lab_ref_no'"; 
  		mysql_query($sql);
                  $this->giveWorksheet();
                  $this->addSignature();
                  $this->addSampleTrackingInformation();
                
		
		redirect("/sample_issue/listing");
		
		}
                
                
                   function addSignature(){                    
                    $name=  $this->getAnalyst();
                    $signature_name=$name[0]->fname." ".$name[0]->lname;
                    $designation ='ANALYST';
                    $labref = $this -> input -> post("lab_ref_no");
                    $date_signed=date('m-d-Y');
                    
                    $signature=array(
                        'labref'=>$labref,
                        'designation'=>$designation,
                        'signature_name'=>$signature_name,
                        'date_signed'=>$date_signed
                    );
                    $this->db->insert('signature_table',$signature);
                   }
                   
      
        
      function addSampleTrackingInformation() {
        $analyst = $this->getAnalyst();
        $userInfo = $this->getUsersInfo();
        $analyst_name = $analyst[0]->fname . " " . $analyst[0]->lname;
        $activity = 'Analysis';
        $labref = $this->uri->segment(3);
        $names = $userInfo[0]->fname . " " . $userInfo[0]->lname;
        $from = $names . '- Documentation';
        $to = $analyst_name . '- Analyst';
        $date = date('m-d-Y H:i:s');
        $array_data = array(
            'activity' => $activity,
            'from' => $from,
            'to' => $to,
            'date' => $date,
            'stage'=>'2',
            'current_location'=>'Analysis'
        );
        $this->db->where('labref', $labref);
        $this->db->update('worksheet_tracking', $array_data);
    }

    function getAnalyst() {
        $analyst_id = $this->input->post("analyst_id");
        $this->db->select('fname,lname');
        $this->db->where('id', $analyst_id);
        $query = $this->db->get('user');
        return $result = $query->result();
        //print_r($result);
    }

    public function getUsersInfo() {
        $user_id = $this->session->userdata('user_id');
        $this->db->select('fname,lname');
        $this->db->where('id', $user_id);
        $query = $this->db->get('user');
        return $result = $query->result();
    }

    function giveWorksheet() {
        $reqid = $this->uri->segment(3);
        if($this->checkIfSampleIsIssuedAlready($reqid)=='1'){
            echo 'Sample is already issued';
        }else{
        $analyst_id = $this->input->post('analyst_id');
        $data = array(
            'labref' => $reqid,
            'analyst_id' => $analyst_id
        );
        $this->db->insert('workbook_worksheets', $data);
    }
   }
    function checkIfSampleIsIssuedAlready(){
        $labref=  $this->uri->segment(3);
        $this->db->where('labref',$labref);
        $query=  $this->db->get('workbook_worksheets');
        $result=$query->num_rows();
        if($result > 0){
            return '1';
        }else{
            return '0';
        }
    }

    public function edit(){
		
		$reqid = $this -> uri -> segment(3);
		$version_id = $this -> uri -> segment(4);
		$data['sample_issues'] = Sample_issuance::getSampleIssue($reqid, $version_id);
		$data['tests'] = Request_details::getTests($reqid);
		$data['sample_listing'] = Request::getAll5($reqid);
		$data['wetchem'] = Tests::getWetchem();
		$data['biological'] = Tests::getBiological();
		$data['medevices'] = Tests::getMedevices();
		
		$data['title'] = "Sample Split and Issue -  Edit";
     	$data['content_view'] = "sample_split_edit_v";
		$data['banner_text'] = "Sample Split by Unit";
		$data['link'] = "home";
		$data['quick_link'] = "sample_split_edit_v";
		$this -> load -> view("template", $data);
		
	}
	
	
	
	
	public function update() {
			
		$lab_ref_no = $this -> input -> post("lab_ref_no");
		$analyst_id = $this -> input -> post("analyst_id");
		$e_analyst_id = $this -> input -> post("aid");
		$dept_id = $this -> input -> post("dept_id");
		$sample_qty = $this -> input -> post("upd_samples_qty");
		$samples_no = $this -> input -> post("samples_no");
		$issued_samples_no = $this -> input -> post("issued_samples_no");
		$tests_version_id = $this  -> input -> post("tests_version_id");
		$req_version_id = $this  -> input -> post("req_version_id");
		$version_id = $this -> input -> post("version_id");	
		$edit_notes = $this -> input -> post("edit_notes");	
		$samples_returned = $this -> input -> post("samples_returned");
		$issues_version_id = $this -> input -> post("issues_version_id");
		
		
		
		//$diff = $samples_no - $issued_samples_no;
		$upd_qty = $samples_returned + $sample_qty - $samples_no; 
		$reqid = $lab_ref_no;
		$mytests = Sample_issuance::getIssuedTests($reqid, $issues_version_id, $dept_id);
		//Tests::getTestName($reqid, $dept_id, $tests_version_id);

		//var_dump($mytests);
		foreach ($mytests as $test) {
			
		$lab_ref_no = $this -> input -> post("lab_ref_no");
		$analyst_id = $this -> input -> post("analyst_id");
		$dept_id = $this -> input -> post("dept_id");
		$sample_qty = $this -> input -> post("upd_samples_qty");
		$samples_no = $this -> input -> post("samples_no");
		$tests_version_id = $this  -> input -> post("tests_version_id");
		$req_version_id = $this  -> input -> post("req_version_id");
		$version_id = $this -> input -> post("version_id");
		$edit_notes = $this -> input -> post("edit_notes");	
		$samples_returned = $this -> input -> post("samples_returned");	
		$status_id = 2;
		$split_status = 1;
				
		
		$sample_issue = new Sample_issuance();
		$sample_issue -> Test_id = $test['Test_id'];
		$sample_issue -> Lab_ref_no = $lab_ref_no;
		$sample_issue -> Department_id = $dept_id;
		$sample_issue -> Samples_no = $samples_no;
		$sample_issue -> Status_id = $status_id;
		$sample_issue -> Analyst_id = $analyst_id;
		$sample_issue -> Split_status = $split_status;
		$sample_issue -> Version_id = $version_id;
		$sample_issue -> Edit_notes = $edit_notes;
		$sample_issue -> Samples_returned = $samples_returned;
		
		$sample_issue -> save();
		
		}
		
		$version_array = array('version_id' => 0);
		
		$this -> db -> where(
		array('lab_ref_no' => $reqid,
		'version_id' => $issues_version_id,
		'department_id' => $dept_id,
		'analyst_id' => $e_analyst_id
		));
		
		$this -> db -> update('sample_issuance', $version_array);
		
		
		$update_qty_array = array('sample_qty' => $upd_qty);
		$this -> db -> where(array(
		'request_id'=> $reqid,
		'version_id'=> $req_version_id
		));
		$this -> db -> update('request', $update_qty_array);
				
		redirect("/sample_issue/issued_listing");
		
		}
	
	
	
	public function sample_split() {
		
		$reqid = $this -> uri -> segment(3);
		$data['tests'] = Request_details::getTests($reqid);
		$data['sample_listing'] = Request::getAll5($reqid);
		$data['wetchem'] = Tests::getWetchem();
		$data['biological'] = Tests::getBiological();
		$data['medevices'] = Tests::getMedevices();
		
		$data['title'] = "Sample Split and Issue";
     	       $data['content_view'] = "sample_split_v";
		$data['banner_text'] = "Sample Split by Unit";
		$data['link'] = "home";
		$data['quick_link'] = "sample_split_v";
		$this -> load -> view("template", $data);
	}
	

	public function samples_all() {
		
		$reqid = $this -> uri -> segment(3);
		$data['tests'] = Request_details::getTests($reqid);
		$data['sample_listing'] = Request::getAll5($reqid);
		$data['wetchem'] = Tests::getWetchem();
		$data['biological'] = Tests::getBiological();
		$data['medevices'] = Tests::getMedevices();
		
		$data['title'] = "Sample Split and Issue";
     	$data['content_view'] = "samples_listing_all_v";
		$data['banner_text'] = "All Samples";
		$data['link'] = "home";
		$data['quick_link'] = "samples_listing_all_v";
		$this -> load -> view("template", $data);
	}


	
	public function issued_listing(){
		
		$reqid = $this -> uri -> segment(3);
		$data['tests'] = Request_details::getTests($reqid);
		$data['sample_listing'] = Request::getAll5($reqid);
		$data['sample_issues'] = Sample_issuance::getAll();
		$data['wetchem'] = Tests::getWetchem();
		$data['biological'] = Tests::getBiological();
		$data['medevices'] = Tests::getMedevices();
		
		$data['title'] = "Samples Issued Listing";
     	$data['content_view'] = "sample_issuance_listing_v";
		//$data['settings_view'] = "sample_issuance_listing_v";
		$data['banner_text'] = "Sample Split by Unit";
		$data['link'] = "home";
		$data['quick_link'] = "sample_issuance_listing_v";
		$this -> load -> view("template", $data);
		
	}
	
	public function withdraw_save(){
		//$testid = $this -> input -> post("testid");
		$reqid = $this -> input -> post("lab_ref_no");
		$version_id = $this -> input -> post("version_id");
		$req_version_id = $this -> input -> post("req_version_id");
		$withdrawal_status = $this -> input -> post("w_status");
		
		$samples_returned = $this -> input -> post("samples_returned");
		$issued_samples_available = $this -> input -> post("issued_samples");
		$req_samples_available = $this -> input -> post("request_samples");
		
		if($withdrawal_status == 0){
		$issued_sample_qty = $issued_samples_available;
		$used_samples = $issued_samples_available - $samples_returned;
		$request_sample_qty = $req_samples_available + $samples_returned;
		$wstatus = 1;
		}

		else if($withdrawal_status == 1){
		$issued_sample_qty = $samples_returned;
		$used_samples = 0;
		$request_sample_qty = $req_samples_available - $samples_returned;
		$wstatus = 0;
		}	

		
		$issue_data1 = array(
		'samples_no' => $issued_sample_qty,
		'samples_used' => $used_samples
		);
		
		$issue_data2 = array(
		'withdrawal_status' => $wstatus,
		'samples_returned' => $samples_returned
		);
		
		$request_data = array(
		'sample_qty' => $request_sample_qty
		);
		
		$this -> db -> where(array('request_id' => $reqid));
		$this -> db -> update('request', $request_data);
		
		$this -> db -> where(array('lab_ref_no' => $reqid));
		$this -> db -> update('sample_issuance', $issue_data1);
		
		$this -> db -> where(array('lab_ref_no' => $reqid));
		$this -> db -> update('sample_issuance', $issue_data2);
		
		redirect('sample_issue/issued_listing');
		
	}
	
	
	public function withdraw(){
		$reqid = $this -> uri -> segment(3);
		//$version_id = $this -> uri -> segment(4);
		$data['w_status'] = $this -> uri -> segment(5);
		$data['sample_listing'] = Request::getAll5($reqid);
		$data['sample_issues'] = Sample_issuance::getSampleIssue($reqid);
		$data['content_view'] = "withdraw_test_v"; 
		$data['title'] = "Sample Withdrawal";
		$this -> load -> view('template',$data);
	}
	
	
	public function listing() {
			
		$reqid = $this -> uri -> segment(3);	
		$data['sample_listing'] = Request::getAll();
		//$data['departments'] = Departments::getDepartments($reqid);
		$data['title'] = "Sample Information";
     	$data['content_view'] = "sample_listing_v";
		$data['banner_text'] = "Sample Listing";
		$data['link'] = "home";
		$data['quick_link'] = "sample_listing_v";
		$this -> load -> view("template", $data);
		
		
	}
	
	
	
	
		public function assign() {
			
		$reqid = $this -> uri -> segment(3);	
		$dept_id = $this -> uri -> segment(4);
		$data['departments'] = Departments::getDepartments($reqid);		
		$data['mytests'] = Tests::getTestName($reqid, $dept_id);
		$data['analysts'] = User::getAnalysts($reqid);
		
		
		$data['title'] = "Sample Information";
     	        $data['content_view'] = "sample_issuance_v";
		$data['banner_text'] = "Sample Issuance";
		$data['link'] = "home";
		$data['quick_link'] = "sample_issuance_v";
		$this -> load -> view("template", $data);
		
		
	}
		
		
		
		
		public function worksheets(){
		
		
		$test_id = end($this->uri->segments);	

		$worksheet = Tests::getWorksheet($test_id); 
	 
	 	$worksheet_name = $worksheet[0]['Alias'];
	
	 
		$data['title'] = $worksheet_name;
     	$data['content_view'] = $worksheet_name . "_v";
		$data['banner_text'] = $worksheet_name. "Worksheet";
		$data['link'] = "home";
		$data['quick_link'] = $worksheet_name;
		$this -> load -> view("template", $data);
			
			
		}
                function updateUrgency(){
                    $request_id=  $this->uri->segment(3);
                    $urgency=  $this->findOutTypeOfUrgency($request_id);
                    echo $urgent=$urgency[0]->urgency;
                    $this->db->where('lab_ref_no',$request_id);
                    $this->db->update('sample_issuance',array('priority'=>$urgent));
                }
                function findOutTypeOfUrgency($request_id){
                    $this->db->select('urgency');
                    $this->db->where('request_id',$request_id);
                    $query=  $this->db->get('request');
                    return $result=  $query->result();
                  // print_r($result);
                }
	
	
}

?>
