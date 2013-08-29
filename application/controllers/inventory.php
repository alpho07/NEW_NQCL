<?php 

class Inventory extends CI_Controller {

  
    public function index() {
      
       $data=array();        
       $data['content_view'] = "inventory_v";
       $this -> base_params($data);
    }
    
    public function refSubs_save(){

            if (is_null($_POST)) {
            echo json_encode(array(
            'status' => 'error',
            'message'=> 'Data was not posted.'
            ));
            }
        else
            {
            echo json_encode(array(
                'status' => 'success',
                'message'=> 'Data added successfully'
            ));
            }
        
        $name = $this -> input -> post("name");
        $source = $this -> input -> post("source");
        $batch_no = $this -> input -> post("batch_no");
        $rs_code = $this -> input -> post("rs_code");
        $date_r = $this -> input -> post("date_r");
        $date_o = $this -> input -> post("date_o");
        $date_e = $this -> input -> post("date_e");
        $date_res = $this -> input -> post("date_res");
        $potency = $this -> input -> post("potency");
        $potency_unit = $this -> input -> post("p_unit");
        $init_mass = $this -> input -> post("init_mass");
        $init_mass_unit = $this -> input -> post("init_mass_unit");
        $application = $this -> input -> post("application");
        $status = $this -> input -> post("status");
        $version_id = $this -> input -> post("version_id");
        $quantity =  $this -> input -> post("quantity");


        for($i = 0; $i < $quantity; $i++) {

        $rs_code_exp = explode("-", $rs_code);
        
        if($rs_code_exp[1] == "WRSR"){
        $restnd_status = "Restandardised";
        $standard_type = "Working";
        } else if($rs_code_exp[1] == "WRS") {
        $restnd_status = "Effective";
        $standard_type = "Working";  
        } else if($rs_code_exp[1] == "PRS") {
        $restnd_status = "Effective";
        $standard_type = "Primary";      
        }

        if($version_id == 1){    

        $count = RefSubs::getCount($name, $standard_type);
        if(isset($count)){
        $count1 = $count[0]['count'];
        $no =  $count1 + 1;

            if($count1 > 0){

            $status = "Reserved";
            }
            else if($count1 <=0){
            $status = "In Use";
            }
        }
        
        else {
        $no = 1;
        }
    
        }

        else if($version_id > 1) {

            $no = null;

        }



            $refSub =  new RefSubs();

            $refSub -> name = $name;
            $refSub -> standard_type = $standard_type;
            $refSub -> source = $source;
            $refSub -> batch_no = $batch_no;
            $refSub -> rs_code = $rs_code.$no;
            $refSub -> date_received = date('y-m-d',strtotime($date_r));
            $refSub -> effective_date = date('y-m-d',strtotime($date_o));
            $refSub -> date_of_expiry = date('y-m-d',strtotime($date_e));
            $refSub -> date_of_restandardisation = date('y-m-d',strtotime($date_res));
            $refSub -> potency = $potency;
            $refSub -> potency_unit = $potency_unit;
            $refSub -> init_mass = $init_mass;
            $refSub -> init_mass_unit = $init_mass_unit;
            $refSub -> status = $status;
            $refSub -> restandardisation_status = $restnd_status; 
            $refSub -> application = $application;
            $refSub -> version_id = $version_id;   
            $refSub -> save();


            $refSubv =  new Refsubsversions();

            $refSubv -> name = $name;
            $refSubv -> standard_type = $standard_type;
            $refSubv -> source = $source;
            $refSubv -> batch_no = $batch_no;
            $refSubv -> rs_code = $rs_code.$no;
            $refSubv -> date_received = date('y-m-d',strtotime($date_r));
            $refSubv -> effective_date = date('y-m-d',strtotime($date_o));
            $refSubv -> date_of_expiry = date('y-m-d',strtotime($date_e));
            $refSubv -> date_of_restandardisation = date('y-m-d',strtotime($date_res));
            $refSubv -> potency = $potency;
            $refSubv -> potency_unit = $potency_unit;
            $refSubv -> init_mass = $init_mass;
            $refSubv -> init_mass_unit = $init_mass_unit;
            $refSubv -> status = $status;
            $refSubv -> restandardisation_status = $restnd_status; 
            $refSubv -> application = $application;
            $refSubv -> version_id = $version_id;   
            $refSubv -> save();

        }

    }
	

    public function editrefsubs(){

        if (is_null($_POST)) {
            echo json_encode(array(
            'status' => 'error',
            'message'=> 'Data was not posted.'
            ));
            }
        else
            {
            echo json_encode(array(
                'status' => 'success',
                'message'=> 'Data added successfully'
            ));
            }
        
        $name = $this -> input -> post("name");
        $source = $this -> input -> post("source");
        $batch_no = $this -> input -> post("batch_no");
        $rs_code = $this -> input -> post("rs_code");
        $date_r = $this -> input -> post("date_r");
        $date_o = $this -> input -> post("date_o");
        $date_e = $this -> input -> post("date_e");
        $date_res = $this -> input -> post("date_res");
        $potency = $this -> input -> post("potency");
        $potency_unit = $this -> input -> post("p_unit");
        $init_mass = $this -> input -> post("init_mass");
        $init_mass_unit = $this -> input -> post("init_mass_unit");
        $application = $this -> input -> post("application");
        $status = $this -> input -> post("status");
        $version_id = $this -> input -> post("version_id");
        $quantity = $this -> input -> post("quantity");

        $rs_code_exp = explode("-", $rs_code);
        
        if($rs_code_exp[1] == "WRSR"){
        $restnd_status = "Restandardised";
        $standard_type = "Working";
        } else if($rs_code_exp[1] == "WRS") {
        $restnd_status = "Effective";
        $standard_type = "Working";  
        } else if($rs_code_exp[1] == "PRS") {
        $restnd_status = "Effective";
        $standard_type = "Primary";      
        }

        if($version_id == 1){    

        $count = RefSubs::getCount($name, $standard_type);
        if(isset($count)){
        $count1 = $count[0]['count'];
        $no =  $count1 + 1;

            if($count1 > 0){

            $status = "Reserved";
            }
            else if($count1 <=0){
            $status = "In Use";
            }
        }
        
        else {
        $no = 1;
        }
    
        }

        else if($version_id > 1) {

            $no = null;

        }


        $update_refsub = array(
        'name' => $name,
        'standard_type' => $standard_type,
        'source' => $source,
        'batch_no' => $batch_no,
        'rs_code' => $rs_code.$no,
        'date_received' => date('y-m-d',strtotime($date_r)),
        'effective_date' => date('y-m-d',strtotime($date_o)),
        'date_of_expiry' => date('y-m-d',strtotime($date_e)),
        'date_of_restandardisation' => date('y-m-d',strtotime($date_res)),
        'potency' => $potency,
        'potency_unit' => $potency_unit,
        'init_mass' => $init_mass,
        'init_mass_unit' => $init_mass_unit,
        'status' => $status,
        'restandardisation_status' => $restnd_status,
        'application' => $application,
        'version_id' => $version_id
        );

        $this -> db -> where(array('rs_code' => $rs_code.$no));
        $this -> db -> update('refsubs', $update_refsub);

        $refSub =  new refsubsversions();

            $refSub -> name = $name;
            $refSub -> standard_type = $standard_type;
            $refSub -> source = $source;
            $refSub -> batch_no = $batch_no;
            $refSub -> rs_code = $rs_code.$no;
            $refSub -> date_received = date('y-m-d',strtotime($date_r));
            $refSub -> effective_date = date('y-m-d',strtotime($date_o));
            $refSub -> date_of_expiry = date('y-m-d',strtotime($date_e));
            $refSub -> date_of_restandardisation = date('y-m-d',strtotime($date_res));
            $refSub -> potency = $potency;
            $refSub -> potency_unit = $potency_unit;
            $refSub -> init_mass = $init_mass;
            $refSub -> init_mass_unit = $init_mass_unit;
            $refSub -> status = $status;
            $refSub -> restandardisation_status = $restnd_status; 
            $refSub -> application = $application;
            $refSub -> version_id = $version_id;   
            $refSub -> save();

    }


    public function edit_refsub(){
        if (is_null($_POST)) {
            echo json_encode(array(
            'status' => 'error',
            'message'=> 'Data was not posted.'
            ));
            }
        else
            {
            echo json_encode(array(
                'status' => 'success',
                'message'=> 'Data added successfully'
            ));
            }

        $refname = $this -> input -> post("refname");
        $refid = $this -> input -> post("refid");
        $refname1 = $this -> input -> post("refname1");

        $stype_array = array('Working','Primary','Working');
        //$s_type = $this -> input -> post("s_type");
        $codes = array('WRS','PRS','WRSR');
        $refids = array($refid, $refid+1, $refid+2);
        
    
        $refalias = str_replace(' ', '_', $refname);

        $name_as_string = "$refname";
        $name_as_string1 = "$refname1";
        $f_letter = $name_as_string[0];
        $f_letter1 = $name_as_string1[0];
        var_dump($refname);

       // $this -> db -> where('name' ,  $refname1);
        //$this -> db -> delete('refsub');
        //$max = RefSub::getMax();

        //var_dump($max);
       //$this -> db -> query('ALTER TABLE refsub AUTO_INCREMENT = ((int)$max -> max + 1)');


        $count = RefSub::getCount($f_letter);

        if(isset($count)){
        $count1 = $count[0]['count']; 
            if($f_letter == $f_letter1){
            $no = $count1;
        }
        else{
            $no =  $count1 + 1;
         }
        }
        else {
            $no = 1;
        }


     /*for ($i=0; $i < count($codes) ; $i++){
        
            $refSub =  new refSub();
            $refSub -> name = $refname;
            $refSub -> s_type = $stype_array[$i];
            $refSub -> code = "NQCL-" . $codes[$i] . "-" . $f_letter . $no . "-" ;
            $refSub -> alias = $refalias;
            $refSub -> save();

       }
       */       
       for($i =0; $i < count($codes); $i++){   
       $this -> db -> where(array('id' => $refids[$i]));
       $this -> db -> update('refsub', array(
            'name' => $refname,
            's_type' => $stype_array[$i],
            'alias' => $refalias,
            'code' => "NQCL-" . $codes[$i]. "-". $f_letter . $no . "-" 
            ));    
    }



    }


    public function refSub_save(){

            if (is_null($_POST)) {
            echo json_encode(array(
            'status' => 'error',
            'message'=> 'Data was not posted.'
            ));
            }
        else
            {
            echo json_encode(array(
                'status' => 'success',
                'message'=> 'Data added successfully'
            ));
            }


        
        $name = $this -> input -> post("name");
        $stype_array = array('Working','Primary','Working');
        //$s_type = $this -> input -> post("s_type");
        $codes = array('WRS','PRS','WRSR');
        
    
        $alias = str_replace(' ', '_', $name);

        $name_as_string = "$name";
        $f_letter = $name_as_string[0];

        $count = RefSub::getCount($f_letter);

        if(isset($count)){
        $count1 = $count[0]['count']; 
        $no =  $count1 + 1;
        }
        else {
            $no = 1;
        }

        
        for ($i=0; $i < count($codes) ; $i++){
        
            $refSub =  new refSub();
            $refSub -> name = $name;
            $refSub -> s_type = $stype_array[$i];
            $refSub -> code = "NQCL-" . $codes[$i] . "-" . $f_letter . $no . "-" ;
            $refSub -> alias = $alias;
            $refSub -> save();

       }     


    }


function GetAutocomplete($options=array())
    {
        $this->db ->distinct();
        $this->db->select('name');
        $this->db->like('name', $options['name'], 'after');
        $query = $this->db->get('refsub');
        return $query->result();

    }
        
        
    function suggestions()
{
    
    $term = $this->input->post('term',TRUE);

    $rows = $this->GetAutocomplete(array('name' => $term));

    $keywords = array();
    foreach ($rows as $row)
         array_push($keywords, $row->name);

    echo json_encode($keywords);
}


    function getCodes() {
    $ref = $this -> uri -> segment(3);
    $ref = str_replace('%20', '_', $ref);
    $codes = Refsub::getCodes($ref);
    echo json_encode($codes);
    }

    function pushCodes(){
    $codes = $this->getCodes();
    $codes_array = array();

    foreach($codes as $code)
        array_push($codes_array, $code->code);
    echo json_encode($codes_array);
    }



     public function refSublist(){

        $data['content_view'] = "refSub_list_v";
        $data['refsub'] = RefSub::getAll();
        $this -> base_params($data);
        
    }

    public function crslist(){
        $refsub = RefSubs::getAllHydrated();
        foreach ($refsub as $r){
            $data[] = $r;
        }
        echo json_encode($data);
    }

     //$refsub = RefSubs::getAllHydrated();
     //$this->arrayJSON = $this -> arrayPHPtoJS($refsub);


     /*public function arrayPHPtoJS($refsub){
        if(is_null($refsub)) return 'null';
        if(is_string($refsub)) return "'".$refsub."'";
        if(self::is_assoc($refsub)){
            $a = array();
            foreach($refsub as $key => $val)
                $a[]=self::arrayPHPtoJS($val);
            return "[" . implode(', ', $a ). "]";
        }
        if(is_array($refsub)){
            $a = array();
            foreach($refsub as $val){
                $a[]=self::arrayPHPtoJS($val);
                return "[".implode(', ', $a) . "]";
            }
            return json_encode($refsub);
        }

        $refsub = RefSubs::getAllHydrated();
     $arrayJSON = $this -> arrayPHPtoJS($refsub);
    }*/

    public function refSubs(){

        $data['content_view'] = "refSubs_v";
    	$this -> base_params($data);
    	
    }

    public function refSubsadd_i(){
        $data['rs'] = Refsub::getAll();
        $data['content_view'] = "refSubs_add_v";
        $this -> base_params($data);
        
    }

    public function refSubslist(){

        $data['content_view'] = "refsubslist_ajax";
        //$data['refsubs'] = Refsubs::getAll();
        $this -> base_params($data);
        

        
    }

    public function refSubsadd(){

      $data['content_view'] = "refSub_add_v";
      $this -> base_params($data);
        
    }

    public function chemicals(){

    	$data['content_view'] = "chemicals_v";
        $this -> base_params($data);
    	
    }

    public function chemicalslist(){

    $data['content_view'] = "chemicals_list_v";
    $data['chemicals'] = Chemicals::getAll();           
    $this -> base_params($data);    
    }

    public function chemicalsadd(){


   $data['content_view'] = "chemicals_add_v";
        $this -> base_params($data);
    }

    public function chemicals_save(){

            if (is_null($_POST)) {
            echo json_encode(array(
            'status' => 'error',
            'message'=> 'Data was not posted.'
            ));
            }
        else
            {
            echo json_encode(array(
                'status' => 'success',
                'message'=> 'Data added successfully'
            ));
            }


        
        $i_desc = $this -> input -> post("i_desc");
        $u_issue = $this -> input -> post("u_issue");
        $physical = $this -> input -> post("physical");
        $value = $this -> input -> post("value");
        $ledger = $this -> input -> post("ledger");
        $variation = $this -> input -> post("variation");
        

        $chem =  new Chemicals();

            $chem -> item_description = $i_desc;
            $chem -> unit_of_issue = $u_issue;
            $chem -> physical = $physical;
            $chem -> value = $value;
            $chem -> ledger = $ledger;
            $chem -> variation = $variation;
            $chem -> save();


    }


    public function equipment(){

    	$data['content_view'] = "equipment_v";
        $this -> base_params($data);    	
    }


      public function equipmentadd(){

        $data['content_view'] = "equipment_add_v";
        $this -> base_params($data);
        
    }


      public function equipmentlist(){

        $data['equipment'] = Equipment::getAll();    
        $data['content_view'] = "equipment_list_v";
        $this -> base_params($data);
        
    }



      public function equipment_save(){

            if (is_null($_POST)) {
            echo json_encode(array(
            'status' => 'error',
            'message'=> 'Data was not posted.'
            ));
            }
        else
            {
            echo json_encode(array(
                'status' => 'success',
                'message'=> 'Data added successfully'
            ));
            }


        
        $name = $this -> input -> post("name");
        $sno = $this -> input -> post("serial_no");
        $nqcl_no = $this -> input -> post("nqcl_no");
        $date_a = $this -> input -> post("date_a");
        $date_c1 = $this -> input -> post("date_c1");
        $date_cn = $this -> input -> post("date_cn");
        $status = $this -> input -> post("status");
        

        $equip =  new Equipment();

            $equip -> name = $name;
            $equip -> serial_no = $sno;
            $equip -> nqcl_no = $nqcl_no;
            $equip -> date_acquired = date('y-m-d',strtotime($date_a));
            $equip -> date_of_calibration = date('y-m-d',strtotime($date_c1));
            $equip -> date_of_nxtcalibration = date('y-m-d',strtotime($date_cn));
            $equip -> status = $status;
            $equip -> save();


    }

    public function equipment_edit(){

            if (is_null($_POST)) {
            echo json_encode(array(
            'status' => 'error',
            'message'=> 'Data was not posted.'
            ));
            }
        else
            {
            echo json_encode(array(
                'status' => 'success',
                'message'=> 'Data added successfully'
            ));
            }


        
        $name = $this -> input -> post("ename");
        $sno = $this -> input -> post("esno");
        $nqcl_no = $this -> input -> post("nqcl_no");
        $date_a = $this -> input -> post("date_acq");
        $date_c1 = $this -> input -> post("date_cal");
        $date_cn = $this -> input -> post("date_nxtcal");
        $status = $this -> input -> post("status");
        $dbid = $this -> input -> post("dbid");
        

        $date_acq = date('y-m-d',strtotime($date_a));
        $date_cal = date('y-m-d',strtotime($date_c1));
        $date_nxtcal = date('y-m-d',strtotime($date_cn));

        $equip_update = array(
         'name' => $name,
         'serial_no' => $sno,
         'nqcl_no' => $nqcl_no,
         'date_acquired' => $date_acq,
         'date_of_calibration' => $date_cal,
         'date_of_nxtcalibration' => $date_nxtcal,
         'status' => $status  
        );

        $this -> db -> where('id', $dbid);
        $this -> db -> update('equipment', $equip_update);

    }






    public function columns(){

    	
        $data['content_view'] = "columns_v";
        $this -> base_params($data);
    	
    }


    public function columnsadd(){

       $data['content_view'] = "columns_add_v";
       $this -> base_params($data);
    }


    public function columnslist(){

        $data['content_view'] = "columns_list_v";
        $data['columns'] = Columns::getAll();
        $data['analysts'] = User::getAllAnalysts();    
        $this -> base_params($data);
        
    }


    public function columns_save(){

            if (is_null($_POST)) {
            echo json_encode(array(
            'status' => 'error',
            'message'=> 'Data was not posted.'
            ));
            }
        else
            {
            echo json_encode(array(
                'status' => 'success',
                'message'=> 'Data added successfully'
            ));
            }

        $col_no = $this -> input -> post("col_no");
        $type = $this -> input -> post("type");
        $sno = $this -> input -> post("serial_no");
        $cdimens = $this -> input -> post("dimensions");
        $mnfcturer = $this -> input -> post("manufacturer");
        $date_r = $this -> input -> post("date_r");
        $status = "Reserved";
        

        $column =  new Columns();

            $column -> type = $type;
            $column -> serial_no = $sno;
            $column -> column_dimensions = $cdimens;
            $column -> manufacturer = $mnfcturer;
            $column -> date_received =date('y-m-d',strtotime($date_r));
            $column -> column_no = $col_no;
         // $column -> date_issued = date('y-m-d',strtotime($date_i));
            $column -> status = $status;
            $column -> save();


    }


    public function column_edit(){

            if (is_null($_POST)) {
            echo json_encode(array(
            'status' => 'error',
            'message'=> 'Data was not posted.'
            ));
            }
        else
            {
            echo json_encode(array(
                'status' => 'success',
                'message'=> 'Data added successfully'
            ));
            }

        
        $type = $this -> input -> post("type");
        $sno = $this -> input -> post("serial_no");
        $col_no = $this -> input -> post("col_no");
        $cdimens = $this -> input -> post("column_dimensions");
        $mnfcturer = $this -> input -> post("manufacturer");
        $date_r = $this -> input -> post("date_r");
        $dbid = $this -> input -> post("dbid");
        
        $update_array = array(
            'type' => $type,
            'serial_no' => $sno,
            'column_dimensions' => $cdimens,
            'manufacturer' => $mnfcturer,
            'column_no' => $col_no 
            );

        $this -> db -> where('id', $dbid);
        $this -> db -> update('columns', $update_array);        

    }



    public function column_issue(){

            if (is_null($_POST)) {
            echo json_encode(array(
            'status' => 'error',
            'message'=> 'Data was not posted.'
            ));
            }
        else
            {
            echo json_encode(array(
                'status' => 'success',
                'message'=> 'Data added successfully'
            ));
            }

        $analyst_id = $this -> input -> post("analyst_id");    
        $column_id = $this -> input -> post("column_id");
        $issue_date = date('y-m-d');
        $status = "Issued";
        

            $column =  new Column_issue();
            $column -> column_id = $column_id;
            $column -> issue_date = $issue_date;
            $column -> analyst_id = $analyst_id;
            $column -> save();
   
            $columnupdate = array('status' => $status);
            $this -> db -> where('id', $column_id);
            $this -> db -> update('columns', $columnupdate); 


    }




    public function reagents(){

    	$data['content_view'] = "reagents_v";
        $this -> base_params($data);
    	
    }

    public function reagentsadd(){
        $data['rgs'] = Reagent::getAll();
        $data['content_view'] = "reagents_add_v";
        $this -> base_params($data);
        
    }

    public function reagentadd(){

        $data['content_view'] = "reagent_add_v";
        $this -> base_params($data);
        
    }



    public function reagentslist(){

        $data['content_view'] = "reagents_list_v";
        $data['reagents'] = Reagents::getAll();    
        $this -> base_params($data);
        
    }

     public function reagentlist(){

        $data['content_view'] = "reagent_list_v";
        $data['reagent'] = Reagent::getAll();    
        $this -> base_params($data);
        
    }


     public function reagents_save(){

            if (is_null($_POST)) {
            echo json_encode(array(
            'status' => 'error',
            'message'=> 'Data was not posted.'
            ));
            }
        else
            {
            echo json_encode(array(
                'status' => 'success',
                'message'=> 'Data added successfully'
            ));
            }


        
        $name = $this -> input -> post("name");
        $comment = $this -> input -> post("comment");
        $mfctrer = $this -> input -> post("manufacturer");
        $batch_no = $this -> input -> post("batch_no");
        $date_r = $this -> input -> post("date_r");
        $date_o = $this -> input -> post("date_o");
        $date_e = $this -> input -> post("date_e");
        $quantity = $this -> input -> post("quantity");
        $qunit = $this -> input -> post("qunit");
        $r_level = $this -> input -> post("reorder_l");
        $rl_unit = $this -> input -> post("rlunit");
        $packaging = $this -> input -> post("packaging");
        $no_of_units = $this -> input -> post("no_of_units");
        

        $reagent =  new Reagents();

            $reagent -> name = $name;
            $reagent -> comment = $comment;
            $reagent -> manufacturer = $mfctrer;
            $reagent -> batch_no = $batch_no;
            $reagent -> date_of_expiry = date('y-m-d',strtotime($date_e));
            $reagent -> date_received =date('y-m-d',strtotime($date_r));
            $reagent -> date_opened = date('y-m-d',strtotime($date_o));
            $reagent -> reorder_level = $r_level;
           // $reagent -> r_level_unit = $rl_unit;
            $reagent -> quantity = $quantity;
            $reagent -> qunit = $qunit;
            $reagent -> packaging = $packaging;
            $reagent -> no_of_units = $no_of_units;
            $reagent -> save();

            if(date('y-m-d') > date('y-m-d',strtotime($date_e))){
                $status = "Expired";
            }
            else{

                $status = "Effective";
            }


            $r_tracking = new Reagents_log();
            $r_tracking -> batch_no = $batch_no;
            $r_tracking -> quantity = $quantity;
            $r_tracking -> qunit = $qunit;
            $r_tracking -> status = $status;  
            $r_tracking -> save();  

    }

     public function reagents_edit(){

            if (is_null($_POST)) {
            echo json_encode(array(
            'status' => 'error',
            'message'=> 'Data was not posted.'
            ));
            }
        else
            {
            echo json_encode(array(
                'status' => 'success',
                'message'=> 'Data added successfully'
            ));
            }


        
        $name = $this -> input -> post("name");
        $mfctrer = $this -> input -> post("manufacturer");
        $batch_no = $this -> input -> post("batch_no");
        $date_r = $this -> input -> post("date_r");
        $date_e = $this -> input -> post("date_e");
        $quantity = $this -> input -> post("quantity");
        $qunit = $this -> input -> post("qunit");
        $r_level = $this -> input -> post("r_level");
        $packaging = $this -> input -> post("packaging");
        $no_of_units = $this -> input -> post("no_of_units");
        $reagent_id = $this -> input -> post("reagent_id");

        $reagent_update = array(
            'name' => $name,
            'manufacturer' => $mfctrer,
            'batch_no' => $batch_no,
            'date_received' => date('y-m-d',strtotime($date_r)),
            'date_of_expiry' => date('y-m-d',strtotime($date_e)),
            'reorder_level' => $r_level,
            'packaging' => $packaging,
            'quantity' => $quantity,
            'qunit' => $qunit,
            'no_of_units' => $no_of_units
            );

        $this -> db -> where('id',$reagent_id);
        $this -> db -> update('reagents', $reagent_update);  

    }


    public function reagent_save(){

            if (is_null($_POST)) {
            echo json_encode(array(
            'status' => 'error',
            'message'=> 'Data was not posted.'
            ));
            }
        else
            {
            echo json_encode(array(
                'status' => 'success',
                'message'=> 'Data added successfully'
            ));
            }


        
        $name = $this -> input -> post("name");
        //$description = $this -> input -> post("description");
        $code = "NQCL-RG-";

        

        $reagent =  new Reagent();

            $reagent -> name = $name;
           // $reagent -> description = $description;
            $reagent -> code =  $code;
            $reagent -> save();

    }






        public function base_params($data) {
		$data['title'] = "Inventory";
		$data['styles'] = array("jquery-ui.css");
		$data['scripts'] = array("jquery-ui.js");
		$data['scripts'] = array("SpryAccordion.js");
		$data['styles'] = array("SpryAccordion.css");		
		//$data['content_view'] = "inventory_v";
		$this -> load -> view('template', $data);
	
        
        
    }
}


?>
