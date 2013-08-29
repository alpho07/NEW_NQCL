<?php

//
//error_reporting(0);
class Dissolution extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('excel');
    }

    public function worksheet() {
 
        $labref = $this->uri->segment(3);
        $data['settings_view'] = "dissolution_v";
        $data['labref'] = $this->uri->segment(3);
        $data['assayweight'] = $this->getStandards($labref);
        //$data['standards']=  $this->getStandards($labref);
        // $data['lastworksheet'] = $this->getWorksheet() + 1;
        $this->base_params($data);
    
    }

    
      function loadComponents($labref) {
        echo json_encode($this->db->select('name')
                ->where('request_id', $labref)
                ->where('status', 1)
                ->get('components')
                ->result()
                );
    }
     function loadRepeatComponents($labref) {
        echo json_encode($this->db->select('name')
                ->where('request_id', $labref)
                ->where('status', 1)
                ->get('components')
                ->result()
                );
    }
    
    
   function getdata($labref,$component) {
       $component=  $this->input->post('heading');
        echo json_encode($this->db->select('repeat_status')
                ->where('labref', $labref)
                 ->where('component', $component)
                ->group_by('repeat_status')
                ->get('multiple_assaystdab')
                ->result()
                );
    }
    function getAB($labref,$component,$repeat_status){      
        echo json_encode($this->db->select('*')
                ->where('labref', $labref)
                 ->where('component', $component)
                ->where('repeat_status', $repeat_status)               
                ->get('multiple_assaystdab')
                ->result()
                );
 
    }
     
       
    
    function getStandards($labref) {
        $this->db->where('labref', $labref);
        $query = $this->db->get('multiple_assaystdab');
        $result = $query->result();
        return $result;
    }

    public function dis_tab_weights() {
        $data = array();
        $data['settings_view'] = "dissolution_weights";

        $this->base_params($data);
    }

    public function multidissolution() {
        $data = array();
        $data['settings_view'] = "dissolution_multistaged_v";

        $this->base_params($data);
    }

    public function multistaged() {
        $data = array();
        $data['settings_view'] = "dissolution_multi_stage_v";
        $data['labref'] = $this->uri->segment(3);
        $this->base_params($data);
    }

    public function getWorksheet() {
        $res = mysql_query("SELECT MAX(id) AS lastId FROM worksheets");
        while ($row = mysql_fetch_assoc($res)) {
            $lastId = $row['lastId'];
        }
        return $lastId;
    }
    
        function getDoStatus(){
        $labref=  $this->uri->segment(3);
        $component= $this->input->post('heading');
        $analyst_id=  $this->session->userdata('user_id');
        $this->db->select_max('repeat_status');
        $this->db->where('labref',$labref);
        $this->db->where('component', $component);
        $this->db->where('analyst_id',$analyst_id);
        $query=  $this->db->get('diss_data')->result();
        return $result=$query[0]->repeat_status;     
        
          }
    

    public function save_dissolution_data() {
          if($this->getDoStatus()==2){
            echo 'This test has reached the number of testing limit and has been maked as an OOS sample';
        }else{
        $labref = $this->uri->segment(3);
        $analyst_id = $this->session->userdata('user_id');
        $max_component = $this->getDissComponentNo($labref);
        (int) $new_component = (int) $max_component[0]->component_no + 1;
        //$this->output->enable_profiler();
        $max_row_id = $this->getDissolutionTestRepeatStatus($labref);
        (int) $new_status = (int) $max_row_id[0]->repeat_status + 1;

        $component = $this->input->post('heading');
        //Dissolution Conditions
        $DM = $this->input->post('DM');
        $R2 = $this->input->post('R2');
        $apparatus = $this->input->post('apparatus');
        $Rm = $this->input->post('Rm');
        $R3 = $this->input->post('R3');
        $tcmean = $this->input->post('tcmean');
        $tcreading = $this->input->post('tcreading');

        $dissolution_conds = array(
            'labref' => $labref,
            'component_no' => $new_component,
            'component' => $component,
            'dissolution_medium' => $DM,
            'volume_used' => $R2,
            'apparatus' => $apparatus,
            'rotations_per_minute' => $Rm,
            'time_taken' => $R3,
            'diss_total' => $tcreading,
            'diss_mean' => $tcmean,
            'repeat_status' => $new_status,
            'analyst_id' => $analyst_id
        );
        $this->db->insert('diss_mean', $dissolution_conds);
        //$this->output->enable_profiler();

        $label_claim = $this->input->post('labelclaim');
        $volume_used = $this->input->post('vu');
        $piette = $this->input->post('workingp1');
        $volume = $this->input->post('workingv');
        $piette2 = $this->input->post('workingp2');
        $volume2 = $this->input->post('workingv2');
        $piette3 = $this->input->post('workingp3');
        $volume3 = $this->input->post('workingv3');
        $piette4 = $this->input->post('workingp4');
        $volume4 = $this->input->post('workingv4');
        $concetration = $this->input->post('conc');
        $procedure = $this->input->post('procedure');


        $dissolution_subsequent = array(
            'labref' => $labref,
            'component_no' => $new_component,
            'component' => $component,
            'label_claim' => $label_claim,
            'volume_used' => $volume_used,
            'pipette' => $piette,
            'volume' => $volume,
            'pipette2' => $piette2,
            'volume2' => $volume2,
            'pipette3' => $piette3,
            'volume3' => $volume3,
            'pipette4' => $piette4,
            'volume4' => $volume4,
            'concetration' => $concetration,
            'procedure' => $procedure,
            'repeat_status' => $new_status,
            'analyst_id' => $analyst_id
        );
        $this->db->insert('diss_subsequent_dillutions', $dissolution_subsequent);
        //$this->output->enable_profiler();

        $tc1 = $this->input->post('tc1');
        $tc2 = $this->input->post('tc2');
        $tc3 = $this->input->post('tc3');
        $tc4 = $this->input->post('tc4');
        $tc5 = $this->input->post('tc5');
        $tc6 = $this->input->post('tc6');
        $stage = $this->input->post('distage');



        $array = array(
            0 => array('labref' => $labref, 'stage' => $stage, 'component_no' => $new_component, 'component' => $component, 'tab_caps_weights' => $tc1, 'repeat_status' => $new_status, 'analyst_id' => $analyst_id)
            , 1 => array('labref' => $labref, 'stage' => $stage, 'component_no' => $new_component, 'component' => $component, 'tab_caps_weights' => $tc2, 'repeat_status' => $new_status, 'analyst_id' => $analyst_id)
            , 2 => array('labref' => $labref, 'stage' => $stage, 'component_no' => $new_component, 'component' => $component, 'tab_caps_weights' => $tc3, 'repeat_status' => $new_status, 'analyst_id' => $analyst_id)
            , 3 => array('labref' => $labref, 'stage' => $stage, 'component_no' => $new_component, 'component' => $component, 'tab_caps_weights' => $tc4, 'repeat_status' => $new_status, 'analyst_id' => $analyst_id)
            , 4 => array('labref' => $labref, 'stage' => $stage, 'component_no' => $new_component, 'component' => $component, 'tab_caps_weights' => $tc5, 'repeat_status' => $new_status, 'analyst_id' => $analyst_id)
            , 5 => array('labref' => $labref, 'stage' => $stage, 'component_no' => $new_component, 'component' => $component, 'tab_caps_weights' => $tc6, 'repeat_status' => $new_status, 'analyst_id' => $analyst_id)
        );


        foreach ($array as $v) {
            $this->db->insert('dissolution_tabs_caps', $v);
        }

        //Standard preparation
        $workingweight = $this->input->post('workingweight');
        $workingvf1 = $this->input->post('workingvf1');
        $workingp11 = $this->input->post('workingp11');
        $workingvf2 = $this->input->post('workingvf2');
        $workingp12 = $this->input->post('workingp12');
        $workingvf3 = $this->input->post('workingvf3');
        $workingp13 = $this->input->post('workingp13');
        $workingvf4 = $this->input->post('workingvf4');
        $workingmgml = $this->input->post('workingmgml');

        $u_weightA = $this->input->post('u_weightA');
        $v11 = $this->input->post('v11');
        $standardp1 = $this->input->post('standardp1');
        $standardvf = $this->input->post('standardvf');
        $p20 = $this->input->post('p20');
        $vf3 = $this->input->post('vf3');
        $p211 = $this->input->post('p211');
        $vf4 = $this->input->post('vf4');
        $dmgml = $this->input->post('dmgml');

        $u_weightB = $this->input->post('u_weightB');
        $v2 = $this->input->post('v2');
        $standardp2 = $this->input->post('standardp2');
        $standardvf1 = $this->input->post('standardvf1');
        $p21 = $this->input->post('p21');
        $vf23 = $this->input->post('vf23');
        $p22 = $this->input->post('p22');
        $vf24 = $this->input->post('vf24');
        $dmgml1 = $this->input->post('dmgml1');




        $data = array(
            0 => array(
                'labref' => $labref,
                'component_no' => $new_component,
                'component' => $component,
                'weight' => $workingweight,
                'vf1' => $workingvf1,
                'pipette1' => $workingp11,
                'vf2' => $workingvf2,
                'pipette2' => $workingp12,
                'vf3' => $workingvf3,
                'pipette3' => $workingp13,
                'vf4' => $workingvf4,
                'concetration' => $workingmgml,
                'repeat_status' => $new_status,
                'analyst_id' => $analyst_id
            ),
            1 => array(
                'labref' => $labref,
                'component_no' => $new_component,
                'component' => $component,
                'weight' => $u_weightA,
                'vf1' => $v11,
                'pipette1' => $standardp1,
                'vf2' => $standardvf,
                'pipette2' => $p20,
                'vf3' => $vf3,
                'pipette3' => $p211,
                'vf4' => $vf4,
                'concetration' => $dmgml,
                'repeat_status' => $new_status,
                'analyst_id' => $analyst_id
            ),
            2 => array(
                'labref' => $labref,
                'component_no' => $new_component,
                'component' => $component,
                'weight' => $u_weightB,
                'vf1' => $v2,
                'pipette1' => $standardp2,
                'vf2' => $standardvf1,
                'pipette2' => $p21,
                'vf3' => $vf23,
                'pipette3' => $p22,
                'vf4' => $vf24,
                'concetration' => $dmgml1,
                'repeat_status' => $new_status,
                'analyst_id' => $analyst_id
            )
        );
        foreach ($data as $key) {
            $this->db->insert('diss_stdassay_prep', $key);
        }



        $dissolution_weights = array(
            'labref' => $labref,
            'component_no' => $new_component,
            'component' => $component,
            'desired_weight' => $desired_weight = $this->input->post('workingweight'),
            'stdA' => $this->input->post('u_weightA'),
            'stdB' => $this->input->post('u_weightB'),
            'desired_conc' => $conc = $this->input->post('conc'),
            'tabs_caps_mean' => $conc = $this->input->post('tcmean'),
            'repeat_status' => $new_status,
            'analyst_id' => $analyst_id
        );
        $this->db->insert('diss_data', $dissolution_weights);
        $this->save_test();
        $this->updateTestIssuanceStatus();
        //$this->updateSampleIssuance();
        redirect('analyst_controller');
    }
    }

    function updateTestIssuanceStatus() {
        $labref = $this->uri->segment(3);
        $analyst_id = $this->session->userdata('user_id');
        $done_status = '1';
        $data = array(
            'done_status' => $done_status
        );
        $this->db->where('lab_ref_no', $labref);
        $this->db->where('test_id', 2);
        $this->db->where('analyst_id', $analyst_id);
        $this->db->update('sample_issuance', $data);
        
        $this->comparetToDecide($labref);
    }

    function check_repeat_status() {
        $component = $this->input->post('active_ingredient');
        $this->db->select_max('repeat_status');
        $this->db->where('labref', $this->uri->segment(3));
        $this->db->where('component', $component);
        $this->db->where('test_name', 'dissolution');
        $query = $this->db->get('tests_done');
        $result = $query->result();
        print_r($result);
    }

    public function diss_r() {
        $data['labref'] = $labref = $this->uri->segment(3);
        $data['r'] = $r = $this->uri->segment(4);
        $data['no_of_pages'] = $this->printPages($labref);
        $data['component'] = $component = $this->uri->segment(5);
        $data['diss_conds_conc'] = $this->getDissCondsConclusion($labref, $r, $component);
        $data['subsequent'] = $this->getSubsequentDillutions($labref, $r, $component);
        $data['diss_tabs'] = $this->getTabsData($labref, $r, $component);
        $data['diss_std_prep'] = $this->getDissoulutionStdPrep($labref, $r, $component);
        $data['component_name'] = $this->findComponentNameM($labref, $r, $component);
        $username=$this->getAnalystData();
        $new=$username[0]->analyst_name;
        $this->session->set_userdata('mail_name', $new);
        $labref = $this->uri->segment(3);
        $module = $this->uri->segment(2);
        $this->session->set_userdata(array('labref' => $labref, 'module' => $module));
        //$data['sample_assay_standars_abc'] = $this->getSampleAssayStandardABC($labref, $r);
        $data['settings_view'] = 'dissolution_r_v';
        $this->base_params($data);
    }
    
          function getAnalystData() {
        $supervisor_id = $this->session->userdata('user_id');
        $url = $this->uri->segment(3);
        $data1 = $this->getAnalystId_1($url);
        foreach ($data1 as $data) {
            $analyst_id = $data->analyst_id;          
            $this->db->where('analyst_id', $analyst_id);
            $this->db->where('supervisor_id', $supervisor_id);
            $query = $this->db->get('analyst_supervisor');
            $result = $query->result();
        }
        return $result;
        //print_r($result);
    }
  function getAnalystId_1($url = '') {
        $supervisor_id = $this->session->userdata('user_id');
        $this->db->select('analyst_id');
        $this->db->where('supervisor_id', $supervisor_id);
        $this->db->where('labref', $url);
        $query = $this->db->get('tests_done');
        return $result = $query->result();
    }
    

    function findComponentNameM($labref, $r, $component_no) {
        $labref = $this->uri->segment(3);
        $r = $this->uri->segment(4);
        $this->db->select('component');
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $this->db->where('component_no', $component_no);
        $this->db->group_by('component');
        $query = $this->db->get('dissolution_tabs_caps');
        return $result = $query->result();
    }

    function getUsername() {
        $this->db->select('username');
        $this->db->where('id', $this->session->userdata('analyst_id'));
        $query = $this->db->get('user');
        return $result = $query->result();
    }

    function getTabsData($labref, $r, $component) {
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $this->db->where('component_no', $component);
        $query = $this->db->get('dissolution_tabs_caps');
        return $result = $query->result();
    }

    function getDissCondsConclusion($labref, $r, $component) {
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $this->db->where('component_no', $component);
        $query = $this->db->get('diss_mean');
        return $result = $query->result();
    }

    function getSubsequentDillutions($labref, $r, $component) {
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $this->db->where('component_no', $component);
        $query = $this->db->get('diss_subsequent_dillutions');
        return $result = $query->result();
    }

    function getDissoulutionStdPrep($labref, $r, $component) {
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $this->db->where('component_no', $component);
        $query = $this->db->get('diss_stdassay_prep`');
        return $result = $query->result();
    }

    function save_test() {
        $data1 = $this->getAnalystId();
        $supervisor_id = $data1[0]->supervisor_id;
        $labref = $this->uri->segment(3);
        $priority = $this->findPriority($labref);
        $urgency = $priority[0]->urgency;
        $data = $this->check_repeat_status();
        $r_status = $data[0]->repeat_status + 1;
        $new_r_status = $r_status;
        $analyst_id = $this->session->userdata('user_id');

        $max_component = $this->getDissComponentNo($labref);
        (int) $new_component = (int) $max_component[0]->component_no;
        $component = $this->input->post('active_ingredient');
        $final_test_done = array(
            'labref' => $labref,
            'component_no' => $new_component,
            'component' => $component,
            'test_name' => 'dissolution',
            'repeat_status' => $new_r_status,
            'supervisor_id' => $supervisor_id,
            'test_subject' => 'diss_r',
            'analyst_id' => $analyst_id,
            'priority' => $urgency
        );
        $this->db->insert('tests_done', $final_test_done);
    }

    function findPriority($labref) {
        $this->db->select('urgency');
        $this->db->where('request_id', $labref);
        $query = $this->db->get('request');
        $result = $query->result();
        return $result;
    }

    function getAnalystId() {
        $analyst_id = $this->session->userdata('user_id');
        $this->db->select('supervisor_id');
        $this->db->where('analyst_id', $analyst_id);
        $query = $this->db->get('analyst_supervisor');
        return $result = $query->result();
        // print_r($result);
    }

    public function getAssayStdAB($labref) {
        $this->db->select('weight');
        $this->db->where('labref', $labref);
        $query = $this->db->get('assaystdab');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $value) {
                $data[] = $value;
            }
        }
        return $data;
    }

    public function getDissolutionTestRepeatStatus($labref) {
        $component = $this->input->post('active_ingredient');
        $this->db->select_max('repeat_status');
        $this->db->where('labref', $labref);
        $this->db->where('component', $component);
        $query = $this->db->get('diss_data');
        return $row = $query->result();
    }

    public function approve_data() {
        $labref = $this->uri->segment(3);
        $r = $this->uri->segment(4);
        $supervisor_id = $this->session->userdata('user_id');
        $supervisor = $this->getSupervisorName();
        $supervisor_name = $supervisor[0]->fname . " " . $supervisor[0]->lname;
        $analyst = $this->getAnalystName();
        $analyst_name = $analyst[0]->analyst_name;
        $priority = $this->findPriority($labref);
        $urgency = $priority[0]->urgency;

        $approve_data = array(
            'supervisor_name' => $supervisor_name,
            'analyst_name' => $analyst_name,
            'labref' => $labref,
            'repeat_status' => $r,
            'test_name' => 'dissolution',
            'test_product' => 'tablets',
            'supervisor_id' => $supervisor_id,
            'user_type' => '5',
            'status' => '1',
            'priority' => $urgency
        );
        $this->db->insert('supervisor_approvals', $approve_data);

        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $this->db->where('test_name', 'dissolution');
        $this->db->update('tests_done', array('approval_status' => '1'));
        
        $this->compareToDecide($labref);

        redirect('supervisors/home/' . $this->session->userdata('lab'));
    }

    public function approve() {
        $labref = $this->uri->segment(3);
        $r = $this->uri->segment(4);
        $status = '1';
        $this->db->select('status');
        $this->db->where('status', $status);
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $this->db->where('test_name', 'dissolution');
        $query = $this->db->get('supervisor_approvals');
        if ($query->num_rows() > 0) {
            redirect('supervisors/home/' . $this->session->userdata('lab'));
        } else {
            $this->approve_data();
        }
    }

    public function getSupervisorName() {
        $supervisor_id = $this->session->userdata('user_id');
        $this->db->where('id', $supervisor_id);
        $query = $this->db->get('user');
        return $result = $query->result();
        //print_r($result);
    }

    public function getAnalystName() {
        $supervisor_id = $this->session->userdata('user_id');
        $this->db->where('supervisor_id', $supervisor_id);
        $query = $this->db->get('analyst_supervisor');
        return $result = $query->result();
        //print_r($result);
    }

    public function getDataToExcel() {
        if ($_POST):
            $labref = $this->uri->segment(3);
            //Tabs caps
            $tc1 = $this->input->post('tc1');
            $tc2 = $this->input->post('tc2');
            $tc3 = $this->input->post('tc3');
            $tc4 = $this->input->post('tc4');
            $tc5 = $this->input->post('tc5');
            $tc6 = $this->input->post('tc6');

            $tcmean = $this->input->post('tcmean');
            $tcreading = $this->input->post('tcreading');

            //Dissolution Conditions
            $DM = $this->input->post('DM');
            $R2 = $this->input->post('R2');
            $apparatus = $this->input->post('apparatus');
            $Rm = $this->input->post('Rm');
            $R3 = $this->input->post('R3');


            //dillution conditions
            $label_claim = $this->input->post('labelclaim');
            $volume_used = $this->input->post('vu');
            $piette = $this->input->post('workingp1');
            $volume = $this->input->post('workingv');
            $concetration = $this->input->post('conc');

            //procedure description
            $procedure = $this->input->post('procedure');

            //standard preparation
            //Standard preparation
            $workingweight = $this->input->post('workingweight');
            $workingvf1 = $this->input->post('workingvf1');
            $workingp11 = $this->input->post('workingp11');
            $workingvf2 = $this->input->post('workingvf2');
            $workingp12 = $this->input->post('workingp12');
            $workingvf3 = $this->input->post('workingvf3');
            $workingp13 = $this->input->post('workingp13');
            $workingvf4 = $this->input->post('workingvf4');
            $workingmgml = $this->input->post('workingmgml');

            $weightA = $this->input->post('u_weightA');
            $v1 = $this->input->post('v11');
            $p1 = $this->input->post('standardp1');
            $vf = $this->input->post('standardvf');
            $p2 = $this->input->post('p20');
            $vf3 = $this->input->post('vf3');
            $p3 = $this->input->post('p211');
            $vf4 = $this->input->post('vf4');
            $dmgml = $this->input->post('dmgml');

            $weightB = $this->input->post('u_weightB');
            $v12 = $this->input->post('v2');
            $p12 = $this->input->post('standardp2');
            $vf12 = $this->input->post('standardvf1');
            $p21 = $this->input->post('p21');
            $vf23 = $this->input->post('vf23');
            $p22 = $this->input->post('p22');
            $vf24 = $this->input->post('vf24');
            $dmgml1 = $this->input->post('dmgml1');

            $objReader = PHPExcel_IOFactory::createReader('Excel2007');

            //we load the file that we want to read

            $objPHPExcel = $objReader->load("workbooks/" . $labref . "/" . $labref . ".xlsx");


            $objWorkSheet = $objPHPExcel->createSheet(1);


            $objWorkSheet->setCellValue('E22', 'Tabs/Capsule Weight')
                    ->setCellValue('E23', 'No.')
                    ->setCellValue('F23', 'Tabs/Capsule Weights (mg)')
                    ->setCellValue('E24', '1')
                    ->setCellValue('F24', $tc1)
                    ->setCellValue('E25', '2')
                    ->setCellValue('F25', $tc2)
                    ->setCellValue('E26', '3')
                    ->setCellValue('F26', $tc3)
                    ->setCellValue('E27', '4')
                    ->setCellValue('F27', $tc4)
                    ->setCellValue('E28', '5')
                    ->setCellValue('F28', $tc5)
                    ->setCellValue('E29', '6')
                    ->setCellValue('F29', $tc6)
                    ->setCellValue('E30', 'Total')
                    ->setCellValue('F30', $tcreading)
                    ->setCellValue('E31', 'Mean')
                    ->setCellValue('F31', $tcmean)
                    ->setCellValue('E33', 'Dissolution Conditions')
                    ->setCellValue('H34', 'n Run')
                    ->setCellValue('F35', 'Dissolution Medium')
                    ->setCellValue('H35', $DM)
                    ->setCellValue('F36', 'Volume Used')
                    ->setCellValue('H36', $R2)
                    ->setCellValue('F37', 'Apparatus')
                    ->setCellValue('H37', $apparatus)
                    ->setCellValue('F38', 'Rotations Per minute')
                    ->setCellValue('H38', $Rm)
                    ->setCellValue('F39', 'Time Taken')
                    ->setCellValue('H39', $R3)
                    ->setCellValue('E41', 'Subsequent Dillutions')
                    ->setCellValue('B42', 'Label Claim')
                    ->setCellValue('C42', 'Volume Used')
                    ->setCellValue('D42', 'pipette1')
                    ->setCellValue('E42', 'vf1')
                    ->setCellValue('F42', 'Concetration')
                    ->setCellValue('A43', 'Desired Concetration')
                    ->setCellValue('B43', $label_claim)
                    ->setCellValue('C43', $volume_used)
                    ->setCellValue('D43', $piette)
                    ->setCellValue('E43', $volume)
                    ->setCellValue('F43', $concetration)



                    //SAMPLE ASSAY PREPARATION
                    ->setCellValue('E45', 'Standard Preparation For Dissolution')
                    ->setCellValue('B46', 'Powder Weight')
                    ->setCellValue('C46', 'API Weight')
                    ->setCellValue('D46', 'vf1')
                    ->setCellValue('E46', 'pipette1')
                    ->setCellValue('F46', 'vf2')
                    ->setCellValue('G46', 'pipette2')
                    ->setCellValue('H46', 'vf3')
                    ->setCellValue('I46', 'pipette3')
                    ->setCellValue('J46', 'vf4')
                    ->setCellValue('L46', 'Concetration')

                    //Assay Standard Preparation desired  
                    ->setCellValue('A47', 'Desired Weight')
                    ->setCellValue('B47', $workingweight)
                    ->setCellValue('C47', $workingvf1)
                    ->setCellValue('D47', $workingp11)
                    ->setCellValue('E47', $workingvf2)
                    ->setCellValue('F47', $workingp12)
                    ->setCellValue('G47', $workingvf3)
                    ->setCellValue('H47', $workingp13)
                    ->setCellValue('I47', $workingvf4)
                    ->setCellValue('J47', $workingmgml)
                    ->setCellValue('A48', 'Standard A')
                    ->setCellValue('B48', $weightA)
                    ->setCellValue('C48', $v1)
                    ->setCellValue('D48', $p1)
                    ->setCellValue('E48', $vf)
                    ->setCellValue('F48', $p2)
                    ->setCellValue('G48', $vf3)
                    ->setCellValue('H48', $p3)
                    ->setCellValue('I48', $vf4)
                    ->setCellValue('J48', $dmgml)
                    ->setCellValue('A49', 'Standard B')
                    ->setCellValue('B49', $weightB)
                    ->setCellValue('C49', $v12)
                    ->setCellValue('D49', $p12)
                    ->setCellValue('E49', $vf12)
                    ->setCellValue('F49', $p21)
                    ->setCellValue('G49', $vf23)
                    ->setCellValue('H49', $p22)
                    ->setCellValue('I49', $vf24)
                    ->setCellValue('J49', $dmgml1)


                    //Other values used
                    ->setCellValue('B51', 'Procedure Used')
                    ->setCellValue('C51', $procedure);

//$objPHPExcel->setTitle("dissolution");

            $dir = "workbooks";

            if (is_dir($dir)) {

                /* $objDrawing = new PHPExcel_Worksheet_Drawing();
                  $objDrawing->setName('NQCL');
                  $objDrawing->setDescription('The Image that I am inserting');
                  $objDrawing->setPath('exclusive_image/nqcl.png');
                  $objDrawing->setCoordinates('A1');
                  $objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); */

                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");


                echo 'Data exported';
            } else {
                echo 'Dir does not exist';
            }



            return true;
        else:
            return false;
        endif;
    }

    function getDissComponentNo($labref) {
        $this->db->select_max('component_no');
        $this->db->where('labref', $labref);
        $query = $this->db->get('dissolution_tabs_caps');
        return $result = $query->result();
        // print_r($result);
    }

    function printPages($labref) {
        $dataSource = $this->getAssayMultipleCount($labref);
        $limit = $dataSource[0]->totalRows;
        return $numbers = range(1, $limit);
    }

    function getAssayMultipleCount($labref) {
        $query = $this->db->query("SELECT COUNT(*) as totalRows
                            FROM(
                            SELECT DISTINCT component
                            FROM `dissolution_tabs_caps`
                            WHERE labref = '$labref'
                            )x");
        $result = $query->result();
        return $result;
    }
    
      function getAssayStandardABM($labref, $r, $component_no) {
        $labref = $this->uri->segment(3);
        $r = $this->uri->segment(4);
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $this->db->where('component_no', $component_no);
        $query = $this->db->get('multiple_assaystdab');
        return $result = $query->result();
        //print_r($result);    
    }
 

    public function base_params($data) {
        $data['title'] = "Dissolution";
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