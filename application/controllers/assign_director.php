<?php

class Assign_director extends CI_Controller {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Africa/Nairobi');
    }

    public function assing_reviewer() {
        $data['labref'] = $this->uri->segment(3);
        $data['reviewers'] = $this->getReviewers();
        $data['title'] = 'Reviewer page';
        $data['settings_view'] = 'reviewer_assign';
        $this->base_params($data);
    }

    public function getAJAXDirectors() {
        $this->db->select('alias,id');
        $this->db->where('user_type', 7);
        $query = $this->db->get('user');
        foreach ($query->result() as $value) {
            $data[] = $value;
        }
        echo json_encode($data);
    }

    public function sendSamplesFolderToDirector() {
       
        $folder = $this->uri->segment(3);
        $data1 = $this->input->post('director');
         $priority=  $this->findPriority($folder);
            $urgency=$priority[0]->urgency;

        //$data2 = $this ->getReviewers();
        $data = array(
            'director_id' => $data1,
            'folder' => $folder,
            'time_done' => date('d-M-Y H:i:s'),
            'priority'=>$urgency
        );
        $this->db->insert('directors', $data);
        $this->upDate();
        $this->createDir();
        $this->full_copy();
        $this->addSampleTrackingInformation();
        $this->addSignature();

        echo 'Reloading page.....';

        // redirect('uploaded_worksheets');
    }
    function addSignature(){                    
                    $name=  $this->getDeputyDirector();
                    $signature_name=$name[0]->fname." ".$name[0]->lname;
                    $designation ='ANALYST: ';
                    $labref = $this -> uri->segment(3);
                    $date_signed=date('m-d-Y');
                    
                    $signature=array(
                        'labref'=>$labref,
                        'designation'=>$designation,
                        'signature_name'=>$signature_name,
                        'date_signed'=>$date_signed
                    );
                    $this->db->insert('signature_table',$signature);
                   // redirect('documentation/home/');
                   }
                   
                   
                   
                   
                   
                                     
     function addSampleTrackingInformation() {
        $reviewer = $this->getDeputyDirector();
        $userInfo = $this->getUsersInfo();
        $reviewer_name = $reviewer[0]->fname . " " . $reviewer[0]->lname;
        $activity = 'Pre approve';
        $labref = $this->uri->segment(3);
        $names = $userInfo[0]->fname . " " . $userInfo[0]->lname;
        $from = $names . '- Documentation';
        $to = $reviewer_name . '- Deputy Director';
        $date = date('m-d-Y H:i:s');
        $array_data = array(
            'activity' => $activity,
            'from' => $from,
            'to' => $to,
            'date' => $date,
            'stage'=>'9',
            'current_location' => 'Deputy Directors\'s office'
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
                   
                   
                  function getDeputyDirector(){
                  $analyst_id = $this->input->post('director');
                  $this->db->select('fname,lname');
                  $this->db->where('id',$analyst_id);
                  $query=  $this->db->get('user');
                  return $result=$query->result();
                  //print_r($result);
                }

    public function upDate() {
        $folder = $this->uri->segment(3);
        $data = array(
            'assign_status' => 1 //change this to 1
        );
        $this->db->where('labref', $folder);
        $this->db->update('reviewer_documentation', $data);
    }

    public function createDir() {

        $rootDir = 'directors';
        $reviewer_folder = $this->input->post('directors');
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

    public function full_copy() {
        $labref = $this->uri->segment(3);

        $reviewer_folder = $this->input->post('director');
        $source = 'reviewer_uploads/'. $labref . '.xlsx';
        $source1 = 'workbooks/' . $labref .'/'. $labref . '.pdf';
        $newfolder = 'director';
        $test='test';
        $excelFile=$labref.".xlsx";
        $pdfFile=$labref.".pdf";
        if (is_dir($newfolder)) {
            mkdir($newfolder . '/' . $reviewer_folder . '/' . date('Y') . '/' . date('M') . '/' . $labref, 0777, TRUE);
            //mkdir($newfolder . '/' . $reviewer_folder . '/' . date('Y') . '/' . $labref, 0777, TRUE);
        }
        $target = $newfolder . '/' . $reviewer_folder . '/' . date('Y') . '/' . date('M') . '/' . $labref . '/'.$excelFile ;
        $target2 = $newfolder . '/' . $reviewer_folder . '/' . date('Y') .'/'. date('M') .'/'. $labref . '/' . $pdfFile;
        copy($source, $target);
       copy($source1, $target2);
    }
    
        function findPriority($labref){
        $this->db->select('urgency');
        $this->db->where('request_id',$labref);
        $query=  $this->db->get('request');
        $result=$query->result();
        return $result;
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