<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Upload extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url', 'file'));
        $this->load->library('excel');
        date_default_timezone_set('Asia/Kuwait');
    }

    function worksheet() {
        $data['labref'] = $this->uri->segment(3);
        $data['error'] = '';
        $data['settings_view'] = 'upload_v';
        $this->base_params($data);
    }

    function do_upload() {

        $labref = $this->uri->segment(3);
        $filename = "reviewer_uploads/" . $labref . '.xlsx';
        if (file_exists($filename)) {
            $data['labref'] = $this->uri->segment(3);
            $data['settings_view'] = 'file_present_v';
            $this->base_params($data);
        } else {

            $config['upload_path'] = "reviewer_uploads";
            $config['allowed_types'] = 'xls|xlsx';


            $this->load->library('upload', $config);
            $this->SaveFileDetails();

            if (!$this->upload->do_upload('worksheet')) {
                $data['labref'] = $this->uri->segment(3);
                $data['error'] = $this->upload->display_errors();

                $data['settings_view'] = 'upload_v';
                $this->base_params($data);
            } else {
                $this->readexcel();
            }
        }
    }

    function success() {
        $config['upload_path'] = "reviewer_uploads";
        $config['allowed_types'] = 'xls|xlsx';


        $this->load->library('upload', $config);
        $data['upload_data'] = $this->upload->data();
        $data['labref'] = $this->uri->segment(3);
        $data['settings_view'] = 'upload_success';
        $this->base_params($data);
    }

    function upload_re() {
        $data['labref'] = $this->uri->segment(3);
        $data['error'] = '';
        $data['settings_view'] = 'file_exists_v';
        $this->base_params($data);
    }

    function re_upload() {
        $labref = $this->uri->segment(3);
        $filename = "reviewer_uploads/" . $labref . '.xlsx';
        unlink($filename);

        $config['upload_path'] = "reviewer_uploads";
        $config['allowed_types'] = 'xls|xlsx';


        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('worksheet')) {
            $data['error'] = $this->upload->display_errors();
            $data['labref'] = $this->uri->segment(3);
            $data['settings_view'] = 'upload_v';
            $this->base_params($data);
        } else {
            $this->readexcel_update();

            $data['upload_data'] = $this->upload->data();
            $data['labref'] = $this->uri->segment(3);
            $data['settings_view'] = 'upload_success';
            $this->base_params($data);
        }
    }

    public function repeated_test() {
        $data['labref'] = $this->uri->segment(3);
        $data['settings_view'] = 'upload_v_repeat';
        $this->base_params($data);
    }

    public function do_upload_repeated() {

        $labref = $this->uri->segment(3);
        $filename = "repeated_tests/" . $labref . '.xlsx';
        if (file_exists($filename)) {
            $data['labref'] = $this->uri->segment(3);
            $data['settings_view'] = 'file_present_v';
            $this->base_params($data);
        } else {

            $config['upload_path'] = "repeated_tests";
            $config['allowed_types'] = 'xls|xlsx';
            $config['file_name'] = $labref . ".xlsx";


            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('worksheet')) {
                $data['error'] = $this->upload->display_errors();

                $data['settings_view'] = 'upload_v';
                $this->base_params($data);
            } else {
                $this->readexcel_repeated();
            }
        }
    }

    public function readexcel_update() {
        // $analyst_id=  $this->session->userdata('user_id');
        $labref = $this->uri->segment(3);
        $objReader = new PHPExcel_Reader_Excel2007();
        $path = "reviewer_uploads/" . $labref . ".xlsx";
        $objPHPExcel = $objReader->load($path);

        $objWorksheet = $objPHPExcel->setActiveSheetIndexbyName('Sample Summary');
        $G75 = $objWorksheet->getCell('B10')->getValue();
        $G76 = $objWorksheet->getCell('B11')->getValue();
        $G77 = $objWorksheet->getCell('B12')->getValue();

        $E107 = $objWorksheet->getCell('B14')->getValue();
        $E108 = $objWorksheet->getCell('B15')->getValue();
        $E109 = $objWorksheet->getCell('B16')->getValue();

        $analyst_id = $this->session->userdata('user_id');

        $sample_assay_summary = array(
            'labref' => $labref,
            'average' => $G75,
            'rsd' => $G76,
            'n' => $G77,
            'analyst_id' => $analyst_id
        );
        $this->db->where('test_id',5);
        $this->db->where('labref', $labref);
        $this->db->update('sample_summary', $sample_assay_summary);


        $dissolution_summary = array(
            'labref' => $labref,
            'average' => $E107,
            'rsd' => $E108,
            'n' => $E109,
            'analyst_id' => $analyst_id
        );
        $this->db->where('test_id',2);
        $this->db->where('labref', $labref);
        $this->db->update('sample_summary', $dissolution_summary);
    }

    public function readexcel() {
        $labref = $this->uri->segment(3);
        if (!file_exists("reviewer_uploads/" . $labref . '.xlsx')) {
            $data['error'] = 'You have uploaded an INVALID FILE or WORKSHEET!';
            $data['labref'] = $this->uri->segment(3);
            $data['settings_view'] = 'upload_v';
            $this->base_params($data);
        } else {

            $analyst_id = $this->session->userdata('user_id');

            $objReader = new PHPExcel_Reader_Excel2007();
            $path = "reviewer_uploads/" . $labref . ".xlsx";
            $objPHPExcel = $objReader->load($path);

            $objWorksheet = $objPHPExcel->setActiveSheetIndexbyName('Sample Summary');
            //Assay components
            $B9 = $objWorksheet->getCell('B9')->getValue();
            $C9 = $objWorksheet->getCell('C9')->getValue();
            $D9 = $objWorksheet->getCell('D9')->getValue();
            $E9 = $objWorksheet->getCell('E9')->getValue();
            $F9 = $objWorksheet->getCell('F9')->getValue();
            
            //Assay
            $B10 = $objWorksheet->getCell('B10')->getValue();
            $B11 = $objWorksheet->getCell('B11')->getValue();
            $B12 = $objWorksheet->getCell('B12')->getValue();
            
            $C10 = $objWorksheet->getCell('C10')->getValue();
            $C11 = $objWorksheet->getCell('C11')->getValue();
            $C12 = $objWorksheet->getCell('C12')->getValue();
            
            $D10 = $objWorksheet->getCell('D10')->getValue();
            $D11 = $objWorksheet->getCell('D11')->getValue();
            $D12 = $objWorksheet->getCell('D12')->getValue();
            
            $E10 = $objWorksheet->getCell('E10')->getValue();
            $E11 = $objWorksheet->getCell('E11')->getValue();
            $E12 = $objWorksheet->getCell('E12')->getValue();
            
            $F10 = $objWorksheet->getCell('F10')->getValue();
            $F11 = $objWorksheet->getCell('F11')->getValue();
            $F12 = $objWorksheet->getCell('F12')->getValue();           
            
        
            
            //Dissolution

            $B14 = $objWorksheet->getCell('B14')->getValue();
            $B15 = $objWorksheet->getCell('B15')->getValue();
            $B16 = $objWorksheet->getCell('B16')->getValue();
            
            $C14 = $objWorksheet->getCell('C14')->getValue();
            $C15 = $objWorksheet->getCell('C15')->getValue();
            $C16 = $objWorksheet->getCell('C16')->getValue();
            
            $D14 = $objWorksheet->getCell('D14')->getValue();
            $D15 = $objWorksheet->getCell('D15')->getValue();
            $D16 = $objWorksheet->getCell('D16')->getValue();
           
            $E14 = $objWorksheet->getCell('E14')->getValue();
            $E15 = $objWorksheet->getCell('E15')->getValue();
            $E16 = $objWorksheet->getCell('E16')->getValue();
            
            $F14 = $objWorksheet->getCell('F14')->getValue();
            $F15 = $objWorksheet->getCell('F15')->getValue();
            $F16 = $objWorksheet->getCell('F16')->getValue();
            
            
         //Assay Saving   
        if($B10==true && $C10==false){
            $data = "$B9 $B10% (Rsd = $B11% ; n = $B12)";
            $this->save_assay($data);
        }else if($B10==true && $C10==true && $D10==false){
            $data = "$B9 $B10% (Rsd = $B11% ; n = $B12),$C9 $C10% (Rsd = $C11% ; n = $C12)";
            $this->save_assay($data);
        }else if($B10==true && $C10==true && $D10==true && $E10==false){
            $data = "$B9 $B10% (Rsd = $B11% ; n = $B12),$C9 $C10% (Rsd = $C11% ; n = $C12),$D9 $D10% (Rsd = $D11% ; n = $D12)";
             $this->save_assay($data);
        }else if($B10==true && $C10==true && $D10==true && $E10==true && $F10==false){
            $data = "$B9 $B10% (Rsd = $B11% ; n = $B12),$C9 $C10% (Rsd = $C11% ; n = $C12),$D9 $D10% (Rsd = $D11% ; n = $D12),$E9 $E10% (Rsd = $E11% ; n = $E12)";
             $this->save_assay($data);
        }else if($B10==true && $C10==true && $D10==true && $E10==true && $F10==true ){
            $data = "$B9 $B10% (Rsd = $B11% ; n = $B12),$C9 $C10% (Rsd = $C11% ; n = $C12),$D9 $D10% (Rsd = $D11% ; n = $D12),$E9 $E10% (Rsd = $E11% ; n = $E12),$F9 $F10% (Rsd = $F11% ; n = $F12)";
             $this->save_assay($data);
        }else{
            echo 'No data detecetd on the Assay Summary worksheet';
        }
          
        
        
        
            //Dissolution Saving   
        if($B14==true && $C14==false){
            $data = "$B9 $B14% (Rsd = $B15% ; n = $B16)";
            $this->save_diss($data);
        }else if($B14==true && $C14==true && $D14==false){
            $data = "$B9 $B14% (Rsd = $B15% ; n = $B16),$C9 $C14% (Rsd = $C15% ; n = $C16)";
            $this->save_diss($data);
        }else if($B14==true && $C14==true && $D14==true && $E14==false){
            $data = "$B9 $B14% (Rsd = $B15% ; n = $B16),$C9 $C14% (Rsd = $C15% ; n = $C16),$D9 $D14% (Rsd = $D15% ; n = $D16)";
             $this->save_diss($data);
        }else if($B14==true && $C14==true && $D14==true && $E14==true && $F14==false){
            $data = "$B9 $B14% (Rsd = $B15% ; n = $B16),$C9 $C14% (Rsd = $C15% ; n = $C16),$D9 $D14% (Rsd = $D15% ; n = $D16),$E9 $E14% (Rsd = $E15% ; n = $E16)";
             $this->save_diss($data);
        }else if($B14==true && $C14==true && $D14==true && $E14==true && $F14==true ){
            $data = "$B9 $B14% (Rsd = $B15% ; n = $B16),$C9 $C14% (Rsd = $C15% ; n = $C16),$D9 $D14% (Rsd = $D15% ; n = $D16),$E9 $E14% (Rsd = $E15% ; n = $E16),$F9 $F14% (Rsd = $F15% ; n = $F16)";
             $this->save_diss($data);
        }else{
            echo 'No data detecetd on Dissolution worksheet';
        }

       $this->updateAccross();
       $this->updateAnalyst($labref);
        }
    } 
        function updateAnalyst($labref){
            $this->db->where('labref',$labref);
                $this->db->update('sample_issuance',array('status'=>'1'));

    }
    function save_assay($data) {
        $labref = $this->uri->segment(3);     
        echo $data;
        $assay_summary = array(
            'determined' => $data
           );
        $this->db->where('test_id', 5);
        $this->db->where('labref', $labref);
        $this->db->update('coa_body', $assay_summary);

    }
    
        function save_diss($data) {
        $labref = $this->uri->segment(3);     
        echo $data;
        $dissolution_summary = array(
            'determined' => $data
           );
        $this->db->where('test_id', 2);
        $this->db->where('labref', $labref);
        $this->db->update('coa_body', $dissolution_summary);
      

    }
    
    function updateAccross(){
      
        $this->letDocumentationKnow();
        $this->addSampleTrackingInformation();
        $this->approve();  
    }
    
     function addSampleTrackingInformation() {
     
        $userInfo = $this->getUsersInfo();
       
        $activity = 'To Generate draft COA';
        $labref = $this->uri->segment(3);
        $names = $userInfo[0]->fname . " " . $userInfo[0]->lname;
        $from = $names . '- Reviewer';
        $to = 'Documentation';
        $date = date('m-d-Y H:i:s');
        $array_data = array(
            'activity' => $activity,
            'from' => $from,
            'to' => $to,
            'date' => $date,
            'stage'=>'8',
            'current_location' => 'Documentation'
        );
        $this->db->where('labref', $labref);
        $this->db->update('worksheet_tracking', $array_data);
    }

    function getReviewer() {
        $analyst_id = $this->input->post('reviewer');
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
    
    

    function identifyReviewer() {
        $user_id = $this->session->userdata('user_id');
        $this->db->select('fname,lname');
        $this->db->where('id', $user_id);
        $Query = $this->db->get('user');
        return $result = $Query->result();
    }

    function letDocumentationKnow() {
        $names = $this->identifyReviewer();
        $name = $names[0]->fname . " " . $names[0]->lname;
        $user_id = $this->session->userdata('user_id');
        $labref = $this->uri->segment(3);
        $date = date('Y-m-d H:i:s');
        $details = $name;
        $priority=  $this->findPriority($labref);
            $urgency=$priority[0]->urgency;

        $data = array(
            'labref' => $labref,
            'reviewer_name' => $details,
            'time_rev_finished' => $date,
            'reviewer_id' => $user_id,
            'priority'=>$urgency
        );
        $this->db->insert('reviewer_documentation', $data);
    }

     function findPriority($labref){
        $this->db->select('urgency');
        $this->db->where('request_id',$labref);
        $query=  $this->db->get('request');
        $result=$query->result();
        return $result;
    }
    
    function approve() {
        $labref = $this->uri->segment(3);
        $date = date('Y-m-d H:i:s');
        $data = array(
            'status' => '1',
            'time_done ' => $date
        );
        $this->db->where('folder', $labref);
        $this->db->update('reviewer_worksheets', $data);
        redirect('reviewer');
    }

    public function readexcel_repeated() {
        $analyst_id=$this->session->userdata('user_id');
        $labref = $this->uri->segment(3);
        if (!file_exists("repeated_tests/" . $labref . '.xlsx')) {
            $data['error'] = 'You have uploaded an INVALID FILE or WORKSHEET!';
            $data['labref'] = $this->uri->segment(3);
            $data['settings_view'] = 'upload_v_repeat';
            $this->base_params($data);
        } else {



            $objReader = new PHPExcel_Reader_Excel2007();
            $path = "reviewer_uploads/" . $labref . ".xlsx";
            $objPHPExcel = $objReader->load($path);

            $objWorksheet = $objPHPExcel->setActiveSheetIndexbyName('Sample Summary');
            $G75 = $objWorksheet->getCell('B10')->getValue();
            $G76 = $objWorksheet->getCell('B11')->getValue();
            $G77 = $objWorksheet->getCell('B12')->getValue();

            $E107 = $objWorksheet->getCell('B14')->getValue();
            $E108 = $objWorksheet->getCell('B15')->getValue();
            $E109 = $objWorksheet->getCell('B16')->getValue();

            $sample_assay_summary = array(
                'labref' => $labref,
                'average' => $G75,
                'rsd' => $G76,
                'n' => $G77,
                'analyst_id' => $analyst_id
            );
            $this->db->insert('sample_assay_summary', $sample_assay_summary);


            $dissolution_summary = array(
                'labref' => $labref,
                'average' => $E107,
                'rsd' => $E108,
                'n' => $E109,
                'analyst_id' => $analyst_id
            );
            $this->db->insert('dissolution_summary', $dissolution_summary);

            redirect('upload/success/' . $labref);
        }
    }

    public function SaveFileDetails() {
        $labref = $this->uri->segment(3);
        $file_details = array(
            'nqcl_number' => $labref,
            'filename' => $labref . '.xlsx'
        );
        $query = $this->db->insert('files', $file_details);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function base_params($data) {
        $labref = $this->uri->segment(3);
        $data['title'] = "Upload Worksheet -" . $labref . '.xlsx';
        $data['styles'] = array("jquery-ui.css");
        $data['scripts'] = array("jquery-ui.js");
        $data['scripts'] = array("SpryAccordion.js");
        $data['styles'] = array("SpryAccordion.css");
        $data['quick_link'] = "uniformity";
        $data['content_view'] = "settings_v";
        $data['banner_text'] = "NQCL Settings";
        $data['link'] = "settings_management";

        $this->load->view('template', $data);
    }

}

?>
