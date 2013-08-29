<?php

class Assign extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function assing_reviewer() {
        $data['labref'] = $this->uri->segment(3);
        $data['reviewers'] = $this->getReviewers();       
        $data['title'] = 'Reviewer page';
        $data['settings_view'] = 'reviewer_assign';
        $this->base_params($data);
    }

    public function getReviewers() {
        $this->db->select('alias,id');
        $this->db->where('user_type', 6);
        $query = $this->db->get('user');
        foreach ($query->result() as $value) {
            $data[] = $value;
        }
        return $data;
    }

    public function getAJAXReviewers() {
        $this->db->select('alias,id');
        $this->db->where('user_type', 6);
        $query = $this->db->get('user');
        foreach ($query->result() as $value) {
            $data[] = $value;
        }
        echo json_encode($data);
    }

    
    public function sendSamplesFolder() {
        $reveiwer_id = $this->session->userdata('user_id');
        $folder = $this->uri->segment(3);
        $data1 = $this->input->post('reviewer');
        
           $priority=  $this->findPriority($folder);
            $urgency=$priority[0]->urgency;

        //$data2 = $this ->getReviewers();
        $data = array(
            'reviewer_id' => $data1,
            'folder' => $folder,
            'time_done'=>date('m-d-Y H:i:s'),
            'priority'=>$urgency
        );
        $this->db->insert('reviewer_worksheets', $data);
     
        $this->upDate();
        $this->createDir();
        $this->full_copy();
        $this->addSampleTrackingInformation();
        $this->addSignature();
        

        echo 'Reloading page.....';

        // redirect('uploaded_worksheets');
    }
    function findPriority($labref){
        $this->db->select('urgency');
        $this->db->where('request_id',$labref);
        $query=  $this->db->get('request');
        $result=$query->result();
        return $result;
    }
    
               function addSignature(){                    
                    $name=  $this->getReviewer();
                    $signature_name=$name[0]->fname." ".$name[0]->lname;
                    $designation ='ANALYST:';
                    $labref = $this -> uri->segment(3);
                    $date_signed=date('m-d-Y');
                    
                    $signature=array(
                        'labref'=>$labref,
                        'designation'=>$designation,
                        'signature_name'=>$signature_name,
                        'date_signed'=>$date_signed
                    );
                    $this->db->insert('signature_table',$signature);
                    
                  
                    
                    redirect('documentation/home/');
                   }
                   
     function addSampleTrackingInformation() {
        $reviewer = $this->getReviewer();
        $userInfo = $this->getUsersInfo();
        $reviewer_name = $reviewer[0]->fname . " " . $reviewer[0]->lname;
        $activity = 'Samples Issuing for review';
        $labref = $this->uri->segment(3);
        $names = $userInfo[0]->fname . " " . $userInfo[0]->lname;
        $from = $names . '- Documentation';
        $to = $reviewer_name . '- Reviewer';
        $date = date('m-d-Y H:i:s');
        $array_data = array(
            'activity' => $activity,
            'from' => $from,
            'to' => $to,
            'date' => $date,
            'stage'=>'7',
            'current_location' => 'Review'
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

    public function upDate() {
        $folder = $this->uri->segment(3);
        $data = array(
            'assign_status' => 1 //chane this to 1
        );
        $this->db->where('labref', $folder);
        $this->db->update('supervisor_approvals', $data);
    }

    public function createDir() {
        $data2 = $this->getReviewers();
        $rootDir = 'reviewers';
        $reviewer_folder = $this->input->post('reviewer');
        if (is_dir($rootDir)) {
            // echo basename($dirName);
            $w = mkdir($rootDir . '/' . $reviewer_folder, 0777, TRUE);
            if ($w) {
                echo 'subdir has been created';
            } else {
                echo 'An error occured';
            }
        }
    }
    function approve(){
        $labref=  $this->uri->segment(3);
        $data =array(
            'status'=>'1',
            'time_done '=> date('d-M-Y')
        );
        $this->db->where('folder',$labref);
        $this->db->update('reviewer_worksheets',$data);
        redirect('reviewer');
    }
       function reject(){
        $labref=  $this->uri->segment(3);
        $data =array(
            'status'=>'2',
            'time_done '=>'NOW()'
        );
        $this->db->where('folder',$labref);
        $this->db->update('reviewer_worksheets',$data);
        redirect('reviewer');
    }

    public function full_copy() {
        $labref = $this->uri->segment(3);
        $data2 = $this->getReviewers();
        $reviewer_folder = $this->input->post('reviewer');
        $source = 'analyst_uploads/'.date('Y').'/'.date('M').'/'. $labref . '/' . $labref . '.xlsx';
        $newfolder = 'reviewers';
        if (is_dir($newfolder)) {
            mkdir($newfolder . '/' . $reviewer_folder . '/' . date('Y') . '/' . date('M') . '/' . $labref, 0777, TRUE);
            mkdir($newfolder . '/' . $reviewer_folder . '/' . date('Y') . '/' . $labref, 0777, TRUE);
        }
        $target = $newfolder . '/' . $reviewer_folder . '/' . date('Y') . '/' . date('M') . '/' . $labref . '/' . $labref . '.xlsx';
        $target2=$newfolder . '/' . $reviewer_folder . '/' . date('Y') . $labref . '/' . $labref . '.xlsx';
        copy($source, $target);
        copy($source, $target2);
        
    }

    public function base_params($data) {
        $labref = $this->uri->segment(3);
        $data['title'] = "Reviewer - " . $labref;
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