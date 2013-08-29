<?php

class  MY_Controller  extends  CI_Controller  {
public $labref;
    function __construct()
    {
        parent::__construct();
         //Instantiate a Doctrine Entity Manager
        //$this->em = $this->doctrine->em;
        $this->name="Alphonce";
        $this->labref=  $this->uri->segment(3);
    }
    
    //TRACK ANALYST SUPERVISOR INFO
    public function sample_issuance_count($labref){        
        $this->db->where('lab_ref_no',$labref);
        $this->db->where('done_status',0);
        return $this->db->count_all_results('sample_issuance');
       
    }
    public function tests_done_count($labref){
     $this->db->where('labref',$labref);   
     return $this->db->count_all_results('tests_done');   
    }
    
    function comparetToDecide($labref) {
        
        $analyst = $this->getAnalyst();
        $supervisor = $this->getSupervisorA();
      
        $date = date('d-M-Y H:i:s');
        $analyst_name = $analyst[0]->fname . " " . $analyst[0]->lname;
        $supervisor_name = $supervisor[0]->supervisor_name;
        
        $from = $analyst_name . ' - Analyst';
        $to = $supervisor_name . ' - Supervisor';

      echo  $sample_issuance = $this->sample_issuance_count($labref);
       echo  $tests_done = $this->tests_done_count($labref);
        
        if (($sample_issuance > 0) && ($tests_done <= 0)) {
            //echo 'All samples are with the Analyst';
        } else if ($sample_issuance > 0 && $tests_done > 0) {
           // echo 'Some tests have not been done yet - In transition ';
            $activity = 'Analysis && Supervision';
            $array_data = array(
                'activity' => $activity,
                'from' => $from,
                'to' => $to,
                'date' => $date,
                'stage'=>'3',
                'current_location' => 'Between analysis and Supervision - In transition'
            );
            $this->db->where('labref', $labref);
            $this->db->update('worksheet_tracking', $array_data);
            
        } else if (($sample_issuance === 0) && ($tests_done > 0)) {
           // echo 'samples are entirely with the supervisor';

            $activity = 'Supervision';
            $array_data = array(
                'activity' => $activity,
                'from' => $from,
                'to' => $to,
                'date' => $date,
                'stage'=>'4',
                'current_location' => 'Supervisor'
            );
            $this->db->where('labref', $labref);
            $this->db->update('worksheet_tracking', $array_data);
        }
    }
    
    //TRACK SUPERVISOR DOCUMENTATION INFO
    
      public function supervisor_issuance_count($labref){        
        $this->db->where('labref',$labref);
        $this->db->where('approval_status',0);
        return $this->db->count_all_results('tests_done');
       
    }
    public function documentation_count($labref){
     $this->db->where('labref',$labref);   
     return $this->db->count_all_results('supervisor_approvals');   
    }
    
    function compareToDecide($labref) {
        
        $documentation = 'Documentation';
        $supervisor = $this->getSupervisor();
      
        $date = date('d-M-Y H:i:s');
        
        $supervisor_name = $supervisor[0]->fname ." ".$supervisor[0]->lname;
        
        
        $from = $supervisor_name . '- Supervisor';
        $to = $documentation;

      echo  $sample_issuance = $this->supervisor_issuance_count($labref);
       echo  $tests_done = $this->documentation_count($labref);
        
        if (($sample_issuance > 0) && ($tests_done <= 0)) {
            //echo 'All samples are with the Analyst';
        } else if ($sample_issuance > 0 && $tests_done > 0) {
           // echo 'Some tests have not been done yet - In transition ';
            $activity = 'Submission to Documentation';
            $array_data = array(
                'activity' => $activity,
                'from' => $from,
                'to' => $to,
                'date' => $date,
                 'stage'=>'5',
                'current_location' => 'Between Supervisor and Documentation - In transition'
            );
            $this->db->where('labref', $labref);
            $this->db->update('worksheet_tracking', $array_data);
            
        } else if (($sample_issuance === 0) && ($tests_done > 0)) {
           // echo 'samples are entirely with the supervisor';

            $activity = 'Documentation - Awaiting review';
            $array_data = array(
                'activity' => $activity,
                'from' => $from,
                'to' => $to,
                'date' => $date,
                'stage'=>'6',
                'current_location' => 'Documentation'
            );
            $this->db->where('labref', $labref);
            $this->db->update('worksheet_tracking', $array_data);
        }
    }

    

    function getAnalyst() {
        $analyst_id = $this->session->userdata('user_id');
        $this->db->select('fname,lname');
        $this->db->where('id', $analyst_id);
        $query = $this->db->get('user');
        return $result = $query->result();
        //print_r($result);
    }

    public function getSupervisor() {
        $user_id = $this->session->userdata('user_id');
        $this->db->select('fname,lname');
        $this->db->where('id', $user_id);
        $query = $this->db->get('user');
        return $result = $query->result();
        
    }
    
      public function getSupervisorA() {
        $user_id = $this->session->userdata('user_id');
        $this->db->select('supervisor_name');
        $this->db->where('analyst_id', $user_id);
        $query = $this->db->get('analyst_supervisor');
        return $result = $query->result();
        
    }
    
      function checkRepeatStatus($labref,$table_name){
        $this->db->select_max('repeat_status');
        $this->db->where('labref',$labref);
        $query=  $this->db->get($table_name);
        return $result=  $query->result();
               
        
    }

}

