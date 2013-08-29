<?php

class Analyst_Controller extends CI_Controller {

  
    public function index() {
      if ($this->checkIfHasASupervisor() === '1') {
            $data = array();
            $data['settings_view'] = "analyst_v";

            $userarray = $this->session->userdata;
            $user_id = $userarray['user_id'];

            $data['tests_assigned'] = Sample_issuance::getTests($user_id);
            $data['testnames'] = Tests::getTestNames($user_id);

            //$results=$this->get_tests();
            //var_dump($results);
            $this->base_params($data);
        } else {
            //echo $this->checkIfHasASupervisor();
            $data['settings_view'] = "analyst_v_error";
            $this->base_params($data);
        }
    }
    function checkIfHasASupervisor(){
        $this->db->where('analyst_id',  $this->session->userdata('user_id'));
        $query=  $this->db->get('analyst_supervisor');       
        if ($query->num_rows()>0) {
            return '1';
        }
        return '0';
    }
    
    function checkForDoneUniformity(){
        $user_id=$this->session->userdata('user_id');
        $this->db->select('test_name');
        $this->db->form('test_done td');
    }
	
        public function base_params($data) {
		$data['title'] = "Analyst";
		$data['styles'] = array("jquery-ui.css");
		$data['scripts'] = array("jquery-ui.js");
		$data['scripts'] = array("SpryAccordion.js");
		$data['styles'] = array("SpryAccordion.css");		
		$data['content_view'] = "settings_v";
		//$data['banner_text'] = "NQCL Settings";
		//$data['link'] = "settings_management";

		$this -> load -> view('template', $data);
	
        
        
    }
}


