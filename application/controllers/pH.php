<?php

class Ph extends CI_Controller {

    function __construct() {
        parent::__construct();
    }
    public function worksheet() {
        $data=array();        
		
		$ndq = $this -> uri -> segment(3);
		$yr = $this -> uri -> segment(4);
		$mnth = $this -> uri -> segment(5);
		$id = $this -> uri -> segment(6);
	   
	   
	   $data['labref'] = $ndq. "/".$yr."/".$mnth."/".$id;
	   $data['test_id'] = $this -> uri -> segment(7);
		
       $data['settings_view'] = "pHv";	
        $this -> base_params($data);
    }
    
    public function save_first(){
        $first=$this->input->post('spp');
       
	   $ndq = $this -> uri -> segment(3);
		$yr = $this -> uri -> segment(4);
		$mnth = $this -> uri -> segment(5);
		$id = $this -> uri -> segment(6);
	   
	   
	   $labref = $ndq. "/".$yr."/".$mnth."/".$id;
	   $test_id = $this -> uri -> segment(7);
	   
         $query="INSERT INTO tbl_ph (sample_prep, labref) VALUES('$first','$labref')";
		 $query2 ="UPDATE sample_issuance SET status_id = 3 WHERE lab_ref_no = '$labref' && test_id = '$test_id'";
		 mysql_query($query2);
         $results=  mysql_query($query);
         if($results){
             redirect('pH/pH_page2/'.$labref."/".$test_id);
         }else{
             echo mysql_error();
         }
    }
	
        public function pH_page2(){
        $data=array(); 
		
		$ndq = $this -> uri -> segment(3);
		$yr = $this -> uri -> segment(4);
		$mnth = $this -> uri -> segment(5);
		$id = $this -> uri -> segment(6);
	   
	   
	   $data['labref'] = $ndq. "/".$yr."/".$mnth."/".$id;
	   $data['test_id'] = $this -> uri -> segment(7);
       $data['settings_view'] = "pHv2";	
       $this -> base_params($data);
        }
        public function save_ph() {
        $ph1 = $this->input->post('pH1');
        $ph2 = $this->input->post('pH2');
        $ph3 = $this->input->post('pH3');
        $ph4 = $this->input->post('pH4');
        $mean=  $this->input->post('pHmean');
        $samplepH =  $this->input->post('pHreading');
     
        $ndq = $this -> uri -> segment(3);
		$yr = $this -> uri -> segment(4);
		$mnth = $this -> uri -> segment(5);
		$id = $this -> uri -> segment(6);
	   
	   
	   $labref = $ndq. "/".$yr."/".$mnth."/".$id;
	   $test_id = $this -> uri -> segment(7);    
    $sql = "UPDATE tbl_ph SET  ph1='$ph1',ph2='$ph2',ph3='$ph3',ph4='$ph4',mean='$mean',sampleph='$samplepH' Where labref='$labref'";
    //execute $sql here or it will overwrite on loop
    $k=mysql_query($sql);
    
    if($k){
        redirect('pH/pH_page3/'.$labref."/".$test_id);
    }else{
       echo 'The error is:'. mysql_error();
    }

    }
    public function pH_page3() {
         $data=array(); 
		$ndq = $this -> uri -> segment(3);
		$yr = $this -> uri -> segment(4);
		$mnth = $this -> uri -> segment(5);
		$id = $this -> uri -> segment(6);
	   
	   
	   $data['labref'] = $ndq. "/".$yr."/".$mnth."/".$id;
	   $data['test_id'] = $this -> uri -> segment(7);
		        
         $data['settings_view'] = "pHappendix";	
        $this -> base_params($data); 
    }
    
      
    public function pH_appendix_save() {
        $phprep = $this->input->post('phprep');
        $phprep1 = $this->input->post('phprep1');
       
	    $ndq = $this -> uri -> segment(3);
		$yr = $this -> uri -> segment(4);
		$mnth = $this -> uri -> segment(5);
		$id = $this -> uri -> segment(6);
	   
	   
	   $labref = $ndq. "/".$yr."/".$mnth."/".$id;
	   $test_id = $this -> uri -> segment(7);
         
    $sql = "UPDATE tbl_ph SET  regend_prep='$phprep',other_sample_tests='$phprep1' Where labref='$labref'";
    //execute $sql here or it will overwrite on loop
    $k=mysql_query($sql);
    
    if($k){
        redirect('pH/send_to_next/'.$labref."/".$test_id);
    }else{
       echo 'The error is:'. mysql_error();  
        
    }
      }
    public function send_to_next() {
         $data=array();        
         $data['settings_view'] = "phsample_sent_v";	
        $this -> base_params($data); 
    }
    public function base_params($data) {
		$data['title'] = "pH Measurements";
		$data['styles'] = array("jquery-ui.css");
		$data['scripts'] = array("jquery-ui.js");
		$data['scripts'] = array("SpryAccordion.js");
		$data['styles'] = array("SpryAccordion.css");
		$data['quick_link'] = "uniformity";
		$data['content_view'] = "settings_v";
		$data['banner_text'] = "NQCL Settings";
		$data['link'] = "settings_management";

		$this -> load -> view('template', $data);
	}
        

}
