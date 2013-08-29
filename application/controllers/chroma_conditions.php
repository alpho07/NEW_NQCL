<?php
class Chroma_conditions extends MY_Controller {
	

public function hplc(){

$data=array();        
$data['settings_view'] = "chroma_hplc";
$this -> base_params($data);	
	
}


public function uv(){

$data=array();        
$data['settings_view'] = "chroma_uv";
$this -> base_params($data);	
	
}


public function base_params($data) {
$data['title'] = "Chromatographic Conditions";
$data['styles'] = array("jquery-ui.css");
$data['scripts'] = array("jquery-ui.js");
$data['scripts'] = array("SpryAccordion.js");
$data['styles'] = array("SpryAccordion.css");		
$data['content_view'] = "settings_v";
$data['banner_text'] = "Chromatographic Conditions";
$data['link'] = "settings_management";
$this -> load -> view('template', $data);
}

}
?>