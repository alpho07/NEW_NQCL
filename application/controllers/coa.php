<?php

class Coa extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('dompdf_lib');
    }

    function generateCoa($labref) {
        // error_reporting(1);
        $data['labref'] = $labref = $this->uri->segment(3);
        $data['information'] = $this->getRequestInformation($labref);
        $data['tests_requested'] = $this->getRequestedTests($labref);
        $data['trd'] = $this->getRequestedTestsDisplay2($labref);
       // print_r($data['trd']);
        $data['signatories'] = $this->getSignatories($labref);
        $data['coa_details'] = $this->getAssayDissSummary($labref);
        $data['conclusion'] = $this->salvageConclusion($labref);
        $data['coa_number'] = $this->salvageCOANumbering();

        $data['settings_view'] = 'coa_v';
        $this->base_params($data);
    }

    function saveCOA() {
        $labref = $this->uri->segment(3);
        $test_id = $this->getRequestedTestIds($labref);

        if ($this->checkIfCOABodyExists($labref) == '1') {
            $compedia_array = $this->input->post('compedia');
            $specification_array = $this->input->post('specification');
            $testid_array = $this->input->post('tests');
            $determined_array=array();
            $temp_array1=array();
            $count=0;
            foreach($testid_array as $temp_array){
              $temp_array1=$this->input->post('determined_'.$count);
              $determined_array[$temp_array]= implode(',',$temp_array1); 
              $count++;
            }
            
            $method_array = $this->input->post('method');
            $conclusion_array = $this->input->post('conclusion');
            $complies_array = $this->input->post('complies');
            $spec_count = 0;
            foreach ($testid_array as $testid) {

                $update_data = array(
                    'method' => $method_array[$spec_count],
                    'compedia' => $compedia_array[$spec_count],
                    'specification' => $specification_array[$spec_count],
                    'determined' => $determined_array[$testid],
                    'complies' => $complies_array[$spec_count]
                );
                

                

                $this->db->where('labref', $labref);
                $this->db->where('test_id', $testid);
                $this->db->update('coa_body', $update_data);
                $spec_count++;
            }
            //$this->db->where( 'test_id',$testid);
            $new_numbers=  $this->salvageCOANumbering();
            $number=$new_numbers[0]->number+1;
            $this->db->where('labref', $labref);
            $this->db->update('coa_body', array('conclusion' => $this->input->post('conclusion')));
            $this->db->update('coa_number',array('number'=> $number ));
            $this->coaIsDraftedUpdate($labref);
            
            $this->generateCoaDraft($labref);
         //$this->output->enable_profiler();
        } else {
            $compedia_array = $this->input->post('compedia');
            $specification_array = $this->input->post('specification');
            $testid_array = $this->input->post('tests');
            $spec_count = 0;
            foreach ($testid_array as $testid) {
                $update_data = array(
                    'compedia' => $compedia_array[$spec_count],
                    'specification' => $specification_array[$spec_count]
                );
                $this->db->where('labref', $labref);
                $this->db->where('test_id', $testid);
                $this->db->update('coa_body', $update_data);
                $spec_count++;
            }
            //  $this->generateCoaDraft($labref);
        }
    }

    function coaIsDraftedUpdate($labref) {
        $coaUpdate = array('coa_status' => '1');
        $this->db->where('labref', $labref);
        $this->db->update('reviewer_documentation', $coaUpdate);
    }

    function getCOABody($labref) {
        $this->db->where('labref', $labref);
        $query = $this->db->get('coa_body');
        $result = $query->result();
        return $result;
        //print_r($result);
    }

    function checkIfCOABodyExists($labref) {
        $this->db->select('labref');
        $this->db->where('labref', $labref);
        $query = $this->db->get('coa_body');
        if ($query->num_rows() > 0) {
            return '1';
        } else {
            return '0';
        }
    }

    function generateCoaDraft($labref, $offset = 0) {
        // error_reporting(1);
        $data['labref'] = $labref = $this->uri->segment(3);
        $data['information'] = $this->getRequestInformation($labref);
        $data['tests_requested'] = $this->getRequestedTests($labref);
        $data['trd'] = $this->getRequestedTestsDisplay2($labref);
        $data['coa_details'] = $this->getAssayDissSummary($labref);
        $data['signatories'] = $this->getSignatories($labref);
        $data['compedia_specification'] = $this->getCOABody($labref);
        $data['conclusion'] = $this->salvageConclusion($labref);
        $data['coa_number'] = $this->salvageCOANumbering();
        $html = $this->load->view('coa_v', $data, true);
        $this->dompdf_lib->createPDF($html, $labref);
    }

    function makeCoaSecondPart($labref) {
        $cd = $this->getCOABody($labref);
        for ($i = 0; $i < count($cd); $i++) {
            echo $cd[$i]->compedia;
        }
    }

    function getRequestInformation($labref) {
        $this->db->from('request r');
        $this->db->join('clients c', 'r.client_id = c.id');
        $this->db->where('r.request_id', $labref);
        $this->db->limit(1);
        $query = $this->db->get();
        $Information = $query->result();
        return $Information;
    }

    function getRequestedTests($labref) {
        $this->db->select('name');
        $this->db->from('tests t');
        $this->db->join('request_details rd', 't.id=rd.test_id');
        $this->db->where('rd.request_id', $labref);
        $this->db->order_by('name', 'desc');
        $query = $this->db->get();
        $result = $query->result();
        $output = array_map(function ($object) {
                    return $object->name;
                }, $result);
        return $tests = implode(', ', $output);
    }

    function getRequestedTestIds($labref) {
        $this->db->select('test_id');
        $this->db->from('coa_body');
        //$this->db->join('request_details rd', 't.id=rd.test_id');
        $this->db->where('labref', $labref);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
        // print_r($result);
    }

    function getRequestedTestsDisplay($labref) {
        $this->db->select('name');
        $this->db->from('tests t');
        $this->db->join('request_details rd', 't.id=rd.test_id');
        $this->db->where('rd.request_id', $labref);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    function getRequestedTestsDisplay2($labref) {
        $query = $this->db->query("SELECT  t.id as test_id, cb.method AS methods,`name` , `compedia`,`determined` , `specification`,complies
                                 FROM (
                                       `tests` t, `coa_body` cb
                                       )
                                JOIN `request_details` rd ON `t`.`id` = `cb`.`test_id`
                                WHERE `rd`.`request_id` = '$labref'
                                AND cb.labref = '$labref'
                                GROUP BY name
                                ORDER BY name DESC
                                LIMIT 0 , 30");
        $result = $query->result();
       // print_r($result);

        return $result;
        // print_r($result);
    }

    function salvageConclusion($labref) {
        $this->db->select('conclusion');
        $this->db->where('labref', $labref);
        $this->db->group_by('labref');
        $query = $this->db->get('coa_body');
        
        return $result = $query->result();
        //print_r($result);
    }

    function salvageCOANumbering() {
        $this->db->select('number');
        $query = $this->db->get('coa_number');
        return $result = $query->result();
        //print_r($result);
    }

    function getAssayDissSummary($labref) {
        $this->db->where('labref', $labref);
        $query = $this->db->get('coa_body');
         $result = $query->result();
        // print_r($result);
         return $result;
    }

    function getSignatories($labref) {
        $this->db->where('labref', $labref);
        $query = $this->db->get('signature_table');
        return $result = $query->result();
        // print_r($result);
    }

    public function base_params($data) {
        $labref = $this->uri->segment(3);
        $data['title'] = "COA - " . $labref;
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

