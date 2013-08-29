<?php

class Supervisors extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $data['done_tests'] = $this->getTestsDone();
        $data['settings_view'] = 'supervisors_index_v';
        $this->base_params($data);
    }

    function home() {
        $labref = $this->uri->segment(3);
        $this->session->set_userdata('lab', $labref);
        $data['analyst_data'] = $this->getAnalystData();
        //var_dump($data['analyst_data']);
        //var_dump($this->getTestsDone());
        $data1 = $this->getSessionAnalystId();
        $name = $data1[0]->analyst_name;
        $id = $data1[0]->analyst_id;
        $this->session->set_userdata(array('analyst_id' => $id, 'analyst_name' => $name));
        $data['pm_count'] = $this->pm_count();
        //$data['username']=  $this->getUsername();
        $data['settings_view'] = 'supervisors_v';
        $this->base_params($data);
    }

    function pm_count() {
        $user_id = $this->session->userdata('user_id');
        $this->db->select('pm_count,username');
        $this->db->where('id', $user_id);
        $query = $this->db->get('user');
        $result = $query->result();
        return $result;
    }

    function getTestsDone() {
        $supervisor_id = $this->session->userdata('user_id');
        $this->db->select('labref,priority');
        $this->db->where('supervisor_id', $supervisor_id);
        $this->db->group_by('labref');
        //$this->db->group_by('repeat_status');
        $query = $this->db->get('tests_done');
        return $result = $query->result();
        // print_r($result);
    }

    function getAnalystData() {
        $supervisor_id = $this->session->userdata('user_id');
        $url = $this->uri->segment(3);
        $data1 = $this->getAnalystId($url);
        foreach ($data1 as $data) {
            $analyst_id = $data->analyst_id;
            $this->db->where('labref', $url);
            $this->db->where('analyst_id', $analyst_id);
            $this->db->where('supervisor_id', $supervisor_id);
            $query = $this->db->get('tests_done');
            $result = $query->result();
        }
        return $result;
        //print_r($result);
    }

    function getAnalystId($url = '') {
        $supervisor_id = $this->session->userdata('user_id');
        $this->db->select('analyst_id');
        $this->db->where('supervisor_id', $supervisor_id);
        $this->db->where('labref', $url);
        $query = $this->db->get('tests_done');
        return $result = $query->result();
    }

    function getSessionAnalystId() {
        $supervisor_id = $this->session->userdata('user_id');
        $this->db->select('analyst_id,analyst_name');
        $this->db->where('supervisor_id', $supervisor_id);
        $query = $this->db->get('analyst_supervisor');
        return $result = $query->result();
    }

    public function getSupervisor() {
        $user_id = $this->session->userdata('user_id');
        $this->db->select('fname,lname');
        $this->db->where('id', $user_id);
        $query = $this->db->get('user');
        return $result = $query->result();
       // print_r($result);
    }

    public function base_params($data) {
        $data['title'] = "Supervisors";
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
