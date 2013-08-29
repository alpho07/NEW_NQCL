<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Identification extends MY_Controller{
    function __construct() {
        parent::__construct();
    }
    function worksheet(){
        $data['labref']=  $this->uri->segment(3);
        $data['settings_view']='identification_v';
        $this->base_params($data);
    }
    
    function saveDescription($labref){
      $array=array(
          'labref'=>$labref,
          'description'=>  $this->input->post('description')
      ); 
      $this->db->insert('identification',$array);
      $this->save_test();
      $this->updateTestIssuanceStatus();
      echo 'saved';
    }
    
        function save_test() {
        $data1 = $this->getAnalystId();
        $supervisor_id = $data1[0]->supervisor_id;
        $labref = $this->uri->segment(3);
        $priority = $this->findPriority($labref);
        $urgency = $priority[0]->urgency;
//        $data = $this->check_repeat_status();
//        $r_status = $data[0]->repeat_status + 1;
//        $new_r_status = $r_status;
        $analyst_id = $this->session->userdata('user_id');

//        $max_component = $this->getDissComponentNo($labref);
//        (int) $new_component = (int) $max_component[0]->component_no;
//        $component = $this->input->post('active_ingredient');
        $final_test_done = array(
            'labref' => $labref,
           'component_no' => '',
           'component' => '',
            'test_name' => 'identification',
            'repeat_status' => '',
            'supervisor_id' => $supervisor_id,
            'test_subject' => 'identification_r',
            'analyst_id' => $analyst_id,
            'priority' => $urgency
        );
        $this->db->insert('tests_done', $final_test_done);
    }
   function updateTestIssuanceStatus() {
        $labref = $this->uri->segment(3);
        $analyst_id = $this->session->userdata('user_id');
        $done_status = '1';
        $data = array(
            'done_status' => $done_status
        );
        $this->db->where('lab_ref_no', $labref);
        $this->db->where('test_id', 1);
        $this->db->where('analyst_id', $analyst_id);
        $this->db->update('sample_issuance', $data);
        
        $this->comparetToDecide($labref);
    }
    
       function getAnalystId() {
        $analyst_id = $this->session->userdata('user_id');
        $this->db->select('supervisor_id');
        $this->db->where('analyst_id', $analyst_id);
        $query = $this->db->get('analyst_supervisor');
        return $result = $query->result();
        // print_r($result);
    }
  function findPriority($labref) {
        $this->db->select('urgency');
        $this->db->where('request_id', $labref);
        $query = $this->db->get('request');
        $result = $query->result();
        return $result;
    }
    
      public function base_params($data) {
        $data['title'] = "Identification";
        $data['styles'] = array("jquery-ui.css");
        $data['scripts'] = array("jquery-ui.js");
        $data['scripts'] = array("SpryAccordion.js");
        $data['styles'] = array("SpryAccordion.css");
        $data['content_view'] = "settings_v";
        //$data['banner_text'] = "NQCL Settings";
        //$data['link'] = "settings_management";

        $this->load->view('template', $data);
    }
}
?>
