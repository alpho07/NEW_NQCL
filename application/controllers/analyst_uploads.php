<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Analyst_Uploads extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url', 'file'));
        $this->load->library('excel');
        date_default_timezone_set('Africa/Nairobi');
    }

    function worksheet() {
        $data['labref'] = $this->uri->segment(3);
        $data['error'] = '';
        $data['settings_view'] = 'upload_analyst_v';
        $data['supervisor']=  $this->getMySupervisor();
        $this->base_params($data);
    }

    function do_upload() {
        $this->makeDir();
        $year = date('Y');
        $month = date('M');
        $labref = $this->uri->segment(3);

        $filename = "analyst_upoads/" . $year . '/' . $month . '/' . $labref . '/' . $labref . '.xlsx';
        if (file_exists($filename)) {
            $data['labref'] = $this->uri->segment(3);
            $data['settings_view'] = 'analyst_file_present_v';
            $this->base_params($data);
        } else {

            $config['upload_path'] = "analyst_uploads/" . $year . '/' . $month . '/' . $labref;
           // $config['upload_path'] = "store_for_issue/" .$labref;
            $config['allowed_types'] = 'xls|xlsx';


            $this->load->library('upload', $config);
            //$this->SaveFileDetails();

            if (!$this->upload->do_upload('worksheet')) {
                $data['labref'] = $this->uri->segment(3);
                $data['error'] = $this->upload->display_errors();

                $data['settings_view'] = 'upload_analyst_v';
                $this->base_params($data);
            } else {
                //$this->full_copy();
               // $this->LockCertainCells();
                $this->success();
               // echo 'Uploaded.....';
                
            }
        }
    }
    
     function LockCertainCells(){
         $labref=  $this->uri->segment(3);
          $objReader = new PHPExcel_Reader_Excel2007();
          $path = "analyst_uploads/" . date('Y') . '/' . date('M') . '/'. $labref .'/'. $labref . ".xlsx";
          $objPHPExcel = $objReader->load($path);
          $objPHPExcel->setActiveSheetIndexbyName('Sample Summary');
          $objPHPExcel->getActiveSheet()->protectCells('A17:G85','PHPExcel');
          $objPHPExcel ->getActiveSheet()->getProtection()->setSheet(true);                         
      }
    

    function success() {

        $year = date('Y');
        $month = date('M');
        $labref = $this->uri->segment(3);

        $config['upload_path'] = "analyst_uploads/" . $year . '/' . $month . '/' . $labref;
        ;
        $config['allowed_types'] = 'xls|xlsx';


        $this->load->library('upload', $config);
        $data['upload_data'] = $this->upload->data();
        $data['labref'] = $this->uri->segment(3);
        $data['settings_view'] = 'upload_success_1';
        $this->base_params($data);
    }

    function upload_re() {
        $data['labref'] = $this->uri->segment(3);
        $data['error'] = '';
        $data['settings_view'] = 'analyst_file_exists_v';
        $this->base_params($data);
    }

    function re_upload() {
        $labref = $this->uri->segment(3);
        $filename = "analyst_uploads/" . $labref . '.xlsx';
        unlink($filename);

        $config['upload_path'] = "excel_file_uploads";
        $config['allowed_types'] = 'xls|xlsx';


        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('worksheet')) {
            $data['error'] = $this->upload->display_errors();
            $data['labref'] = $this->uri->segment(3);
            $data['settings_view'] = 'upload_analyst_v';
            $this->base_params($data);
        } else {


            $data['upload_data'] = $this->upload->data();
            $data['labref'] = $this->uri->segment(3);
            $data['settings_view'] = 'upload_success_1';
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
            $data['settings_view'] = 'analyst_file_present_v';
            $this->base_params($data);
        } else {

            $config['upload_path'] = "repeated_tests";
            $config['allowed_types'] = 'xls|xlsx';
            $config['file_name'] = $labref . ".xlsx";


            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('worksheet')) {
                $data['error'] = $this->upload->display_errors();

                $data['settings_view'] = 'analyst_file_upload_v';
                $this->base_params($data);
            } else {
                // $this->readexcel_repeated();
            }
        }
    }

    public function makeDir() {
        $dirname = 'analyst_uploads';

        $year = date('Y');
        $month = date('M');
        $labref = $this->uri->segment(3);

        // if (is_dir($dirname)) {
        // echo basename($dirName);
        $dirToMake = ($year . '/' . $month . '/' . $labref);
        //  }

        $root = $dirname;
        $dArray = explode("/", $dirToMake);
        if (file_exists($root) && is_dir($root)) {
            // just a quick check
            if (substr($root, 0, -1) !== "/")
                $root .= "/";
            foreach ($dArray as $v) {
                if (strlen($v) == 0)
                    continue;
                $root = $root . $v . "/";
                if (file_exists($root) && is_dir($root))
                    continue;
                mkdir($root);
            }
        }
        else
            throw new Exception("Root directory does not exist");
    }
    
    
    
    
    

    public function getUploader() {
        $uploader_id=  $this->session->userdata('user_id');        
        $this->db->where('id',$uploader_id);
        $query=  $this->db->get('user');
        return $result=$query->result();
    }
  
    public function is_valid_filename() {
        $dirname='analyst_uploads';
        $labref=  $this->uri->segment(3);
        $extension='.xlsx';
        $filename=$labref.$extension;
        $directory_and_file=$dirname.'/'.$labref.'/'.$filename;
        if (is_dir($dirname)) {
            if (file_exists($directory_and_file)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
   function check_repeat_status(){
        $this->db->select_max('repeat_status');
        $this->db->where('labref',  $this->uri->segment(3));
        $this->db->where('test_name','uniformity');
        $query=  $this->db->get('tests_done');
        return $result=$query->result();
        
    }

    public function SaveFileDetails() {
          $data1=  $this->getAnalystId();
        $supervisor_id=$data1[0]->supervisor_id;
        $labref=  $this->uri->segment(3);
        $data=$this->check_repeat_status();
        $r_status= $data[0]->repeat_status;
        $new_r_status=$r_status+1;
        $analyst_id=  $this->session->userdata('user_id');
        
        $final_test_done=array(
            'labref'=>$labref,
            'test_name'=>'Test',
            'repeat_status'=>$new_r_status,
            'supervisor_id'=>$supervisor_id, 
            'test_subject'=>'Summary',
            'analyst_id'=>$analyst_id
        );
        $this->db->insert('tests_done',$final_test_done);
    }
     function getAnalystId(){
        $analyst_id=  $this->session->userdata('user_id');
        $this->db->select('supervisor_id');
        $this->db->where('analyst_id',$analyst_id);
        $query=  $this->db->get('analyst_supervisor');
        return $result=$query->result();
       // print_r($result);
    }
    
      public  function full_copy( $source,$newfolder ) {
      $labref=  $this->uri->segment(3);     
      $source='analyst_uploads/'.date('Y').'/'.date('M').'/'.$labref;
      $newfolder='store_for_issue/'.$labref;
  
      if(is_dir($source)){
          mkdir($newfolder,0777,TRUE);
      }
      if(is_dir($newfolder))
      copy( $source, $newfolder );
}

function getMySupervisor(){
    $my_id= $this->session->userdata('user_id');
    $this->db->select('supervisor_id,supervisor_name');
    $this->db->where('analyst_id',$my_id);
    $query=  $this->db->get('analyst_supervisor');
   return $result=$query->result();
   
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
