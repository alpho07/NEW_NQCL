<?php
error_reporting(1);
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class User_Management extends MY_Controller {
	function __construct() {
		parent::__construct();
		
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
	}

	public function index() {
		$this->load->view('login_v');
	}

	public function login() {
               $this->keepLogoutLog();
		$data = array();
		$data['title'] = "System Login";
		$this -> load -> view("login_v", $data);
	}

public function submit() {
		$username=$_POST['username'];
		$password=$_POST['password'];
		if ($this->_submit_validate() === FALSE) {
			$this->index();
			return;
		}
		$reply=User::login($username, $password);
		$n=$reply->toArray();
		//echo($n['username']);

		$myvalue=$n['user_type'];
		$namer=$n['fname'];
		$id_d=$n['id'];
		$inames=$n['lname'];
		//$disto=$n['district'];
		//$faci=$n['facility'];
	    $user_id=$n['id'];	
            $user_message=$n['pm_count'];
            
            $this->keepLog();
            $data=$this->setPrioritySessionOnCourse();
            $this->session->set_userdata('data',$data);
		
		
		
		if($myvalue == 2){	
		
		redirect("home_controller");
		}
		
		else if($myvalue == 1){
			
			redirect("analyst_controller");
		}
		else if ($myvalue == 3){
			redirect("inventory");
		}
                  else if ($myvalue == 5){
			redirect("documentation/home/");
		}
                else if ($myvalue == 6){
			redirect("reviewer");
		}
                   else if ($myvalue == 7){
			redirect("directors");
		}
                 else if ($myvalue == 8){
			redirect("directors/superDirector");
		}
        
   
}

        function keepLog() {
         $user_id = $this->session->userdata('user_id');
        $names = $this->getUsersInfo();
        $name = $names[0]->fname . " " . $names[0]->lname;
        $date_time = date("d-m-Y H:i:s");
        
        $details = array(
            'user_id'=>$user_id,
            'name' => $name,
            'login_time' => $date_time,
            'did' => 'Logged In'
        );
        $this->db->insert('user_log_table', $details);
        $messages=  $this->checkForMessages();
        foreach ($messages as $message){
        $this->session->set_userdata('messages',$message->pm_count);
        }
    }
    
    function setPrioritySessionOnCourse(){
        $query=$this->db->get('priority_table');
        $result=$query->result();
        return $result;
        
        }
        
    
    
    function keepLogoutLog(){
       $user_id = $this->session->userdata('user_id');
        $names = $this->getUsersInfo();
        $name = $names[0]->fname . " " . $names[0]->lname;
        $date_time = date("d-m-Y H:i:s");
        
        $details = array(
            'user_id'=>$user_id,
            'name' => $name,
            'login_time' => $date_time,
            'did' => 'Logged Out'
        );
        $this->db->insert('user_log_table', $details);
    }


    public function getUsersInfo() {
        $user_id = $this->session->userdata('user_id');
        $this->db->where('id', $user_id);
        $query = $this->db->get('user');
        return $result = $query->result();
    }
    function checkForMessages(){
        $user_id=  $this->session->userdata('user_id');
        $this->db->select('pm_count');
        $this->db->where('id',$user_id);
        $query=  $this->db->get('user');
       return  $result=$query->result();
       // print_r($result);
    }





	private function _submit_validate() {
		
		$this->form_validation->set_rules('username', 'Username', 
			'trim|required|callback_authenticate');
		
		$this->form_validation->set_rules('password', 'Password',
			'trim|required');
	
		$this->form_validation->set_message('authenticate','Invalid login. Please try again.');
	
		return $this->form_validation->run();

	}
	
	public function authenticate() {
		
		return Current_User::login($this->input->post('username'), 
									$this->input->post('password'));
		
	}
		

	public function go_home($data) {
		$data['title'] = "System Home";
		$data['content_view'] = "home_v";
		$data['banner_text'] = "Dashboards";
		$data['link'] = "home";
		$this -> load -> view("template", $data);
	}
		
	
}
