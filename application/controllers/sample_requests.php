<?php

//error_reporting(0);

class Sample_requests extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('excel');
        $labref = $this->uri->segment(3);
    }

    public function index() {
        $data['samples'] = $this->getSampleRequests();
        $data['settings_view'] = "sample_v_labrefs";
        $this->base_params($data);
    }

    public function samples() {
        error_reporting(0);
        $labref = $this->uri->segment(3);
        $r = $this->uri->segment(4);
        $c = $this->uri->segment(5);
        $data['settings_view'] = "sample_v";

        // $labref=  $this->uri->segment(1);
        $data['labref'] = $this->uri->segment(3);
        $data['r'] = $this->uri->segment(4);
        $data['c'] = $this->uri->segment(5);
        $data['no_of_pages'] = $this->printPages($labref);
        $data['no_of_repeats']=  $this->repeatPage($labref,$c);
        // $data['stdweight']=  Assaystdab::getStandards($labref);
        $data['stdweight'] = $this->getStandard($labref, $r, $c);
        $data['worksheetInfo'] = $this->getWorksheetInfo($labref, $r, $c);
        $data['stddesired'] = $this->getStandardDesired($labref, $r, $c);
        $data['sample_assay'] = $this->getSampleAssay($labref, $r, $c);
        $data['sample_assay_desired'] = $this->getSampleAssayDesired($labref, $r, $c);
        $data['dissolutionts'] = $this->getDissolutionTabsCaps($labref, $r, $c);
        $data['dissolutionData'] = $this->getOtherDissolutionData($labref, $r, $c);
        $data['tabs'] = $this->getTabletCaps($labref, $r);
        $data['unassay'] = $this->getUniformityAssay($labref, $c);
        $data['component_name'] = $this->findComponentNameM($labref, $r, $c);



        $this->base_params($data);
    }

    function findComponentNameM($labref, $r, $c) {

        $this->db->select('component');
        $this->db->where('labref', $labref);
        $this->db->where('repeat_status', $r);
        $this->db->where('component_no', $c);
        $this->db->group_by('component');
        $query = $this->db->get('multiple_assay_desiredw');
        return $result = $query->result();
    }

    public function getStandard($labref, $r, $c) {
        $this->db->select('weight');
        $this->db->where('labref', $labref);
        $this->db->where('component_no', $c);
        $this->db->where('repeat_status', $r);
        $sql = $this->db->get('multiple_assaystdab');
        /* $sql= $this->db->query("SELECT assaystdab.weight
          FROM assaystdab
          WHERE assaystdab.labref ='NDQB2012832'"); */
        if ($sql->num_rows() > 0) {
            foreach ($sql->result() as $value) {
                $data[] = $value;
                // $data[1]=$value;
            }
        }
        return $data;
    }

    public function getWorksheetInfo($labref) {
        $this->db->select('request.request_id, request.active_ing, request.label_claim, request.product_name');
        $this->db->where('request.request_id', $labref);
        $sql = $this->db->get('request');
        /* $sql= $this->db->query("SELECT request.request_id, request.active_ing,request.label_claim, sample_information.chemical_name
          FROM request,sample_information
          WHERE request.request_id ='NDQB2012832' AND sample_information.lab_ref_no='NDQB2012832'"); */
        if ($sql->num_rows() > 0) {
            foreach ($sql->result() as $value) {
                $data[] = $value;
                // $data[1]=$value;
            }
        }
        return $data;
    }

    /* public function getCaps($labref,$r) {
      $this->db->select('actual_average,cstatus');
      $this->db->where('labref', $labref);
      $this->db->where('repeat_status', $r);
      $sql = $this->db->get('weight_caps_ta');
      if ($sql->num_rows() > 0) {
      foreach ($sql->result() as $value) {
      var_dump($data = $value);
      // $data[1]=$value;
      }

      return $data;
      } */

    public function getTabletCaps($labref, $r) {
        $this->db->select('average');
        $this->db->where('labref', $labref);
        //$this->db->where('component_no',$c);
        $this->db->where('repeat_status', $r);
        $sql = $this->db->get('caps_tabs_data');
        if ($sql->num_rows() > 0) {
            foreach ($sql->result() as $value) {
                $data = $value;
                // $data[1]=$value;
            }
        }
        return $data;
    }

    public function getStandardDesired($labref, $r, $c) {
        $this->db->select('desired_weight,concetration,potency');
        $this->db->where('labref', $labref);
        $this->db->where('component_no', $c);
        $this->db->where('repeat_status', $r);
        $sql = $this->db->get('multiple_assay_desiredw');
        /* $sql= $this->db->query("SELECT desired_weight
          FROM assay_desiredw
          WHERE labref ='NDQB2012832'"); */
        if ($sql->num_rows() > 0) {
            foreach ($sql->result() as $value) {
                $data = $value;
                // $data[1]=$value;
            }
        }
        return $data;
    }

    public function getSampleAssay($labref, $r, $c) {

        $this->db->select('powder_weight, api_weight,concetration');
        $this->db->where('labref', $labref);
        $this->db->where('component_no', $c);
        $this->db->where('repeat_status', $r);
        $sql = $this->db->get('multiple_sample_assay_abc');

        /* $sql= $this->db->query("SELECT powder_weight, api_weight
          FROM sample_assay_abc
          WHERE labref ='NDQB2012832'"); */
        if ($sql->num_rows() > 0) {
            foreach ($sql->result() as $value) {
                $data[] = $value;
                // $data[1]=$value;
            }
        }
        return $data;
    }

    public function getDissolutionTabsCaps($labref, $r, $c) {

        $this->db->select('tab_caps_weights');
        $this->db->where('labref', $labref);
        $this->db->where('component_no', $c);
        $this->db->where('repeat_status', $r);
        $sql = $this->db->get('dissolution_tabs_caps');

        if ($sql->num_rows() > 0) {
            foreach ($sql->result() as $value) {
                $data[] = $value;
                // $data[1]=$value;
            }
        }
        return $data;
    }

    public function getUniformityAssay($labref) {

        $this->db->select('average');
        $this->db->where('labref', $labref);
        $sql = $this->db->get('caps_tabs_data');

        if ($sql->num_rows() > 0) {
            foreach ($sql->result() as $value) {
                $data[] = $value;
                // $data[1]=$value;
            }
        }
        return $data;
    }

    function getPeaks($labref, $r) {
        $this->db->select('peak1,peak2,peak3,peak4');
        $this->db->where('labref', $labref);
        $this->db->where('component_no', $c);
        $this->db->where('repeat_status', $r);
        $query = $this->db->get('multiple_assay_desiredw');
        return $query->result();
    }

    public function getOtherDissolutionData($labref, $r, $c) {
        $this->db->select('desired_weight, stda,stdb,desired_conc,tabs_caps_mean');
        $this->db->where('labref', $labref);
        $this->db->where('component_no', $c);
        $this->db->where('repeat_status', $r);
        $sql = $this->db->get('diss_data');

        /* $sql= $this->db->query("SELECT powder_weight, api_weight
          FROM sample_assay_desiredw
          WHERE labref ='NDQB2012832'"); */
        if ($sql->num_rows() > 0) {
            foreach ($sql->result() as $value) {
                $data[] = $value;
                // $data[1]=$value;
            }
        }
        return $data;
    }

    public function getSampleRequests() {
        $analyst_id = $this->session->userdata('user_id');

        $sql = $this->db->query("SELECT DISTINCT labref, repeat_status,analyst_id,component_no
FROM
(
    SELECT labref, repeat_status, component_no,analyst_id
    FROM multiple_assaystdab
    UNION ALL
    SELECT labref, repeat_status,component_no,analyst_id
    FROM diss_data
    GROUP BY labref DESC
) x WHERE analyst_id='$analyst_id'");
        if ($sql->num_rows() > 0) {
            foreach ($sql->result() as $value) {
                $data[] = $value;
                // $data[1]=$value;
            }
        }
        return $data;
    }

    public function getSampleAssayDesired($labref, $r, $c) {
        $this->db->select('powder_weight, api_weight');
        $this->db->where('labref', $labref);
        $this->db->where('component_no', $c);
        $this->db->where('repeat_status', $r);
        $sql = $this->db->get('multiple_sample_assay_desiredw');
        /* $sql= $this->db->query("SELECT powder_weight, api_weight
          FROM sample_assay_desiredw
          WHERE labref ='NDQB2012832'"); */
        if ($sql->num_rows() > 0) {
            foreach ($sql->result() as $value) {
                $data[] = $value;
                // $data[1]=$value;
            }
        }
        return $data;
    }

    public function getDataToExcel() {
        if ($_POST):
            $labref = $this->uri->segment(3);
            //$this->output->enable_profiler();
            $SampleName = $this->input->post('SampleName');
            $LabRef = $this->input->post('LabRef');
            $LabelClaim = $this->input->post('LabelClaim');
            $ActiveIng = $this->input->post('ActiveInng');
            $DateCompleted = $this->input->post('DateCompleted');



            //standard Assay
            $assayDesired = $this->input->post('assayDesired');
            $stdA = $this->input->post('standardA');
            $stdB = $this->input->post('standardB');
            $dconcetration = $this->input->post('dconcetration');

            //sample preparation, powder Weight
            $samplDesiredpw = $this->input->post('sampleDesiredpw');
            $sastandarda = $this->input->post('sastandarda');
            $sastandardb = $this->input->post('sastandardb');
            $sastandardc = $this->input->post('sastandardc');

            //sample API weight
            $samplDesiredap = $this->input->post('sampleDesiredap');
            $apstandarda = $this->input->post('apstandarda');
            $apstandardb = $this->input->post('apstandardb');
            $apstandardc = $this->input->post('apstandardc');
            //$sampleconcetration = $this->input->post('sampleconcetration');
            //Uniformity of weight
            $tabscapsaverage = $this->input->post('tabcapssaverage');
            // $capsaverage = $this->input->post('capsaverage');
            //tab and cap status
            // $tabstatus = $this->input->post('tabstatus');
            // $capstatus= $this->input->post('capstatus');
            //Dissolution Tabs
            $tab1 = $this->input->post('tab1');
            $tab2 = $this->input->post('tab2');
            $tab3 = $this->input->post('tab3');
            $tab4 = $this->input->post('tab4');
            $tab5 = $this->input->post('tab5');
            $tab6 = $this->input->post('tab6');

            //Dissolution Other Tests
            $desiredweight = $this->input->post('desiredweight');
            $disstda = $this->input->post('disstda');
            $disstdb = $this->input->post('disstdb');
            $concetration = $this->input->post('concetration');
            $tabaverage = $this->input->post('tabaverage');

            $head = $this->input->post('head');
            // var_dump($_POST);
            $objReader = PHPExcel_IOFactory::createReader('Excel2007');

            //we load the file that we want to read

            $objPHPExcel = $objReader->load("workbooks/" . $labref . "/" . $labref . ".xlsx");


            echo 'Worksheet loaded';

            $objPHPExcel->setActiveSheetIndex(0);
            $objWorkSheet = $objPHPExcel->getActiveSheet();
            //Worksheet Information
            $objWorkSheet->setCellValue('B40', $SampleName)
                    ->setCellValue('B41', $LabRef)
                    ->setCellValue('B42', $LabelClaim)
                    ->setCellValue('B43', $ActiveIng)
                    ->setCellValue('B44', $DateCompleted)


                    //Sample and Standard Assay Information
                    ->setCellValue('D21', $assayDesired)
                    ->setCellValue('D19', $stdA)
                    ->setCellValue('D20', $stdB)
                    ->setCellValue('D22', $dconcetration)
                    ->setCellValue('F27', $samplDesiredpw)
                    ->setCellValue('F28', $samplDesiredap)
                    ->setCellValue('F19', $sastandarda)
                    ->setCellValue('F20', $sastandardb)
                    ->setCellValue('F21', $sastandardc)
                    ->setCellValue('F23', $apstandarda)
                    ->setCellValue('F24', $apstandardb)
                    ->setCellValue('F25', $apstandardc)
                    // ->setCellValue('F29',$sampleconcetration)
                    //Dissolution
                    ->setCellValue('B31', $tab1)
                    ->setCellValue('B32', $tab2)
                    ->setCellValue('B33', $tab3)
                    ->setCellValue('B34', $tab4)
                    ->setCellValue('B35', $tab5)
                    ->setCellValue('B36', $tab6)

                    //Other Dssolution Data      
                    ->setCellValue('D30', $desiredweight)
                    ->setCellValue('D31', $disstda)
                    ->setCellValue('D32', $disstdb)
                    ->setCellValue('D33', $concetration)
                    ->setCellValue('D34', $tabaverage)



                    // Uniformity Data
                    ->setCellValue('B19', $tabscapsaverage)
                    ->setCellValue('F25', $apstandardc);
            //$this->addLogo();

            $objWorkSheet->setTitle("Sample Summary");

            $dir = "workbooks";

            if (is_dir($dir)) {

                /*  $objDrawing = new PHPExcel_Worksheet_Drawing();
                  $objDrawing->setName('NQCL');
                  $objDrawing->setDescription('The Image that I am inserting');
                  $objDrawing->setPath('exclusive_image/nqcl.png');
                  $objDrawing->setCoordinates('A1');
                  $objDrawing->setWorksheet($objWorkSheet->getSheet(2)); */

                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");


                echo 'Data exported';
            } else {
                echo 'Dir does not exist';
            }

            return true;
        else:
            return false;
        endif;


        //we create a new file
        /* $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
          $dirName='excel/'.$labref;


          if (!is_dir($dirName))
          mkdir($dirName, 0777);

          $suffixes = array('.xlsx', '_R1.xlsx', '_R2.xlsx', '_R3.xlsx');
          foreach ($suffixes as $suffix) {
          $fileName = $dirName . '/' . $labref . $suffix;
          if (!file_exists($fileName)) {
          $objWriter->save($fileName);
          break;
          }
          }
         */


        // $this->readData();
        // $this->getWorksheet();
    }

    function printPages($labref) {
        $dataSource = $this->getAssayMultipleCount($labref);
        $limit = $dataSource[0]->totalRows;
        return $numbers = range(1, $limit);
    }
    function repeatPage($labref,$component_no ){   
        $paging=  $this->getRepeats($labref, $component_no);
        $limit = $paging[0]->totalRows;
       return range(1, $limit);
    }
    
    function getRepeats($labref,$component_no){
      
$query = $this->db->query("SELECT COUNT( * ) AS totalRows
                            FROM (

                            SELECT DISTINCT component, repeat_status
                            FROM `multiple_assaystdab`
                            WHERE labref = '$labref'
                            AND component_no = '$component_no'
                            )x");
return $result=  $query->result();


    }

    function getAssayMultipleCount($labref) {
        $query = $this->db->query("SELECT COUNT(*) as totalRows
                            FROM(
                            SELECT DISTINCT component
                            FROM `multiple_assay_desiredw`
                            WHERE labref = '$labref'
                            )x");
        $result = $query->result();
        return $result;
    }

    public function getWorksheet() {
        $data['labref'] = $this->uri->segment(3);
        $data['r'] = $this->uri->segment(4);
        $data['settings_view'] = 'worksheet_v';
        $this->base_params($data);
    }

    public function base_params($data) {
        $data['title'] = "Sample Requests";
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
