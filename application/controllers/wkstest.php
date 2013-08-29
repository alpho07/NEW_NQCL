<?php

class Wkstest extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('excel');
    }

    function getLastWorksheet() {
        $labref = $this->uri->segment(3);
        $this->db->select('no_of_sheets');
        $this->db->where('labref', $labref);
        $query = $this->db->get('workbook_worksheets');
        return $result = $query->result();
        // print_r($result);
    }

    //======================================-- ASSAY EXPO TEST=========================================================//
    public function exportTabsToExcel_t() {
        $labref = $this->uri->segment(3);

        $repeat_stat = $this->checkRepeatStatusCaps_t($labref);

        $heading = $this->input->post('heading');
        $potency = $this->input->post('potency');

        $weight = $this->input->post('workingweight');
        $vf1 = $this->input->post('workingvf1');
        $pipette1 = $this->input->post('workingpipette1');
        $vf2 = $this->input->post('workingvf2');
        $pipette2 = $this->input->post('workingpipette2');
        $vf3 = $this->input->post('workingvf3');
        $pipette3 = $this->input->post('workingp3');
        $vf4 = $this->input->post('workingvf4');
        $concetration = $this->input->post('workingmgml');



        $weightA = $this->input->post('u_weight');
        $vf1A = $this->input->post('vf1');
        $pipette1A = $this->input->post('pipette1');
        $vf2A = $this->input->post('vf2');
        $pipette2A = $this->input->post('p2');
        $vf3A = $this->input->post('vf31');
        $pipette3A = $this->input->post('p321');
        $vf4A = $this->input->post('vf32');
        $concetrationA = $this->input->post('mgml');


        $weightB = $this->input->post('u_weight1');
        $vf1B = $this->input->post('vf11');
        $pipette1B = $this->input->post('ppt');
        $vf2B = $this->input->post('vf22');
        $pipette2B = $this->input->post('ppt1');
        $vf3B = $this->input->post('vf33');
        $pipette3B = $this->input->post('ppt2');
        $vf4B = $this->input->post('vf34');
        $concetrationB = $this->input->post('mgml1');

        //sample assay posted data
        $pwnumber = $this->input->post('pwnumber');
        $sampleA = $this->input->post('sampleA');
        $sampleB = $this->input->post('sampleB');
        $sampleC = $this->input->post('sampleC');

        $aiweight = $this->input->post('aiweight');
        $u_weighta = $this->input->post('aweightA');
        $u_weightb = $this->input->post('aweightB');
        $u_weightc = $this->input->post('aweightC');

        $svf1 = $this->input->post('svf1');
        $svf11 = $this->input->post('svf11');
        $svf111 = $this->input->post('vf111');
        $svf31 = $this->input->post('svf3');


        $sp1 = $this->input->post('sp1');
        $sp11 = $this->input->post('sp11');
        $sp12 = $this->input->post('sp112');
        $ssp3 = $this->input->post('ssp3');

        $svf2 = $this->input->post('svf2');
        $svf12 = $this->input->post('svf12');
        $svf22 = $this->input->post('svf22');
        $svf33 = $this->input->post('svf33');


        $spipette2 = $this->input->post('pipette2');
        $spf1 = $this->input->post('spf1');
        $spf2 = $this->input->post('spf2');
        $spf3 = $this->input->post('spf3');


        $svf3 = $this->input->post('vf3');
        $svf13 = $this->input->post('svf13');
        $svf23 = $this->input->post('svf23');
        $svf24 = $this->input->post('svf24');


        $spipette3 = $this->input->post('pipette3');
        $spf21 = $this->input->post('spf21');
        $spf33 = $this->input->post('spf33');
        $spf4 = $this->input->post('spf4');


        $vf41 = $this->input->post('vf41');
        $svf14 = $this->input->post('svf14');
        $svf241 = $this->input->post('svf241');
        $svf25 = $this->input->post('svf25');


        $smgml = $this->input->post('smgml');
        $smgml1 = $this->input->post('smgml1');
        $smgml2 = $this->input->post('smgml2');
        $smgml3 = $this->input->post('smgml3');

        //Other values used
        $tabs_caps_average = $this->input->post('tabs_caps_average');
        $labelclaim = $this->input->post('labelclaim');
        $procedure = $this->input->post('procedure');


        if (!empty($repeat_stat)) {

            // var_dump($_POST);
            $objReader = PHPExcel_IOFactory::createReader('Excel2007');

            //we load the file that we want to read

            $objPHPExcel = $objReader->load("workbooks/" . $labref . "/" . $labref . ".xlsx");

            //$objPHPExcel->createSheet();
            $objPHPExcel->setActiveSheetIndexbyName($heading);
            $objPHPExcel->getActiveSheet()
                    ->setCellValue('I29', $heading)
                    ->setCellValue('I32', 'Standard Preparation For Assay')
                    ->setCellValue('B33', 'Weight')
                    ->setCellValue('C33', 'vf1')
                    ->setCellValue('D33', 'pipette1')
                    ->setCellValue('E33', 'vf2')
                    ->setCellValue('F33', 'pipette2')
                    ->setCellValue('G33', 'vf3')
                    ->setCellValue('H33', 'pipette3')
                    ->setCellValue('I33', 'vf4')
                    ->setCellValue('K33', 'Concetration')

                    //Assay Standard Preparation desired  
                    ->setCellValue('A34', 'Desired Weight')
                    ->setCellValue('B34', $weight)
                    ->setCellValue('C34', $vf1)
                    ->setCellValue('D34', $pipette1)
                    ->setCellValue('E34', $vf2)
                    ->setCellValue('F34', $pipette2)
                    ->setCellValue('G34', $vf3)
                    ->setCellValue('H34', $pipette3)
                    ->setCellValue('I34', $vf4)
                    ->setCellValue('K34', $concetration)
                    ->setCellValue('A35', 'Standard A')
                    ->setCellValue('B35', $weightA)
                    ->setCellValue('C35', $vf1A)
                    ->setCellValue('D35', $pipette1A)
                    ->setCellValue('E35', $vf2A)
                    ->setCellValue('F35', $pipette2A)
                    ->setCellValue('G35', $vf3A)
                    ->setCellValue('H35', $pipette3A)
                    ->setCellValue('I35', $vf4A)
                    ->setCellValue('K35', $concetrationA)
                    ->setCellValue('A36', 'Standard B')
                    ->setCellValue('B36', $weightB)
                    ->setCellValue('C36', $vf1B)
                    ->setCellValue('D36', $pipette1B)
                    ->setCellValue('E36', $vf2B)
                    ->setCellValue('F36', $pipette2B)
                    ->setCellValue('G36', $vf3B)
                    ->setCellValue('H36', $pipette3B)
                    ->setCellValue('I36', $vf4B)
                    ->setCellValue('K36', $concetrationB)
                    //SAMPLE ASSAY PREPARATION
                    ->setCellValue('I38', 'Sample Preparation For Assay')
                    ->setCellValue('B39', 'Powder Weight')
                    ->setCellValue('C39', 'API Weight')
                    ->setCellValue('D39', 'vf1')
                    ->setCellValue('E39', 'pipette1')
                    ->setCellValue('F39', 'vf2')
                    ->setCellValue('G39', 'pipette2')
                    ->setCellValue('H39', 'vf3')
                    ->setCellValue('I39', 'pipette3')
                    ->setCellValue('J39', 'vf4')
                    ->setCellValue('L39', 'Concetration')
                    ->setCellValue('F40', $potency)

                    //Assay Standard Preparation desired  
                    ->setCellValue('A40', 'Desired Weight')
                    ->setCellValue('B40', $pwnumber)
                    ->setCellValue('C40', $aiweight)
                    ->setCellValue('D40', $svf1)
                    ->setCellValue('E40', $sp1)
                    ->setCellValue('F40', $svf2)
                    ->setCellValue('G40', $spipette2)
                    ->setCellValue('H40', $svf3)
                    ->setCellValue('I40', $spipette3)
                    ->setCellValue('J40', $vf41)
                    ->setCellValue('L40', $smgml)
                    ->setCellValue('A41', 'Sample A')
                    ->setCellValue('B41', $sampleA)
                    ->setCellValue('C41', $u_weighta)
                    ->setCellValue('D41', $svf11)
                    ->setCellValue('E41', $sp11)
                    ->setCellValue('F41', $svf12)
                    ->setCellValue('G41', $spf1)
                    ->setCellValue('H41', $svf13)
                    ->setCellValue('I41', $spf21)
                    ->setCellValue('J41', $svf14)
                    ->setCellValue('L41', $smgml1)
                    ->setCellValue('A42', 'Sample B')
                    ->setCellValue('B42', $sampleB)
                    ->setCellValue('C42', $u_weightb)
                    ->setCellValue('D42', $svf111)
                    ->setCellValue('E42', $sp12)
                    ->setCellValue('F42', $svf22)
                    ->setCellValue('G42', $spf2)
                    ->setCellValue('H42', $svf23)
                    ->setCellValue('I42', $spf33)
                    ->setCellValue('J42', $svf241)
                    ->setCellValue('L42', $smgml2)
                    ->setCellValue('A43', 'Sample C')
                    ->setCellValue('B43', $sampleC)
                    ->setCellValue('C43', $u_weightc)
                    ->setCellValue('D43', $svf31)
                    ->setCellValue('E43', $ssp3)
                    ->setCellValue('F43', $svf33)
                    ->setCellValue('G43', $spf3)
                    ->setCellValue('H43', $svf24)
                    ->setCellValue('I43', $spf4)
                    ->setCellValue('J43', $svf25)
                    ->setCellValue('L43', $smgml3)
                    //Other values used
                    ->setCellValue('D48', 'Label Claim')
                    ->setCellValue('D49', 'Tabs or Caps Average')
                    ->setCellValue('D50', 'Procedure Used')
                    ->setCellValue('F48', $labelclaim)
                    ->setCellValue('F49', $tabs_caps_average)
                    ->setCellValue('F50', $procedure);

//             ->setCellValue('A3', 'Worksheet No')
//                    ->setCellValue('B43', $labref);

            $objPHPExcel->getActiveSheet()->setTitle($heading);


            $dir = "workbooks";

            if (is_dir($dir)) {

                /* $objDrawing = new PHPExcel_Worksheet_Drawing();
                  $objDrawing->setName('NQCL');
                  $objDrawing->setDescription('The Image that I am inserting');
                  $objDrawing->setPath('exclusive_image/nqcl.png');
                  $objDrawing->setCoordinates('A1');
                  $objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); */

                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");
                // $this->updateWorksheetNo();

                echo 'Data exported';
            } else {
                echo 'Dir does not exist';
            }
        } else {

            $data = $this->getLastWorksheet();
            echo $worksheetIndex = $data[0]->no_of_sheets;




            // var_dump($_POST);
            $objReader = PHPExcel_IOFactory::createReader('Excel2007');

            //we load the file that we want to read

            $objPHPExcel = $objReader->load("workbooks/" . $labref . "/" . $labref . ".xlsx");

            $objPHPExcel->createSheet();
            $objPHPExcel->setActiveSheetIndex($worksheetIndex);
            $objPHPExcel->getActiveSheet()
                    ->setCellValue('I3', $heading)
                    ->setCellValue('I5', 'Standard Preparation For Assay')
                    ->setCellValue('B7', 'Weight')
                    ->setCellValue('C7', 'vf1')
                    ->setCellValue('D7', 'pipette1')
                    ->setCellValue('E7', 'vf2')
                    ->setCellValue('F7', 'pipette2')
                    ->setCellValue('G7', 'vf3')
                    ->setCellValue('H7', 'pipette3')
                    ->setCellValue('I7', 'vf4')
                    ->setCellValue('K7', 'Concetration')

                    //Assay Standard Preparation desired  
                    ->setCellValue('A8', 'Desired Weight')
                    ->setCellValue('B8', $weight)
                    ->setCellValue('C8', $vf1)
                    ->setCellValue('D8', $pipette1)
                    ->setCellValue('E8', $vf2)
                    ->setCellValue('F8', $pipette2)
                    ->setCellValue('G8', $vf3)
                    ->setCellValue('H8', $pipette3)
                    ->setCellValue('I8', $vf4)
                    ->setCellValue('K8', $concetration)
                    ->setCellValue('A9', 'Standard A')
                    ->setCellValue('B9', $weightA)
                    ->setCellValue('C9', $vf1A)
                    ->setCellValue('D9', $pipette1A)
                    ->setCellValue('E9', $vf2A)
                    ->setCellValue('F9', $pipette2A)
                    ->setCellValue('G9', $vf3A)
                    ->setCellValue('H9', $pipette3A)
                    ->setCellValue('I9', $vf4A)
                    ->setCellValue('K9', $concetrationA)
                    ->setCellValue('A10', 'Standard B')
                    ->setCellValue('B10', $weightB)
                    ->setCellValue('C10', $vf1B)
                    ->setCellValue('D10', $pipette1B)
                    ->setCellValue('E10', $vf2B)
                    ->setCellValue('F10', $pipette2B)
                    ->setCellValue('G10', $vf3B)
                    ->setCellValue('H10', $pipette3B)
                    ->setCellValue('I10', $vf4B)
                    ->setCellValue('K10', $concetrationB)

                    //SAMPLE ASSAY PREPARATION
                    ->setCellValue('I12', 'Sample Preparation For Assay')
                    ->setCellValue('B13', 'Powder Weight')
                    ->setCellValue('C13', 'API Weight')
                    ->setCellValue('D13', 'vf1')
                    ->setCellValue('E13', 'pipette1')
                    ->setCellValue('F13', 'vf2')
                    ->setCellValue('G13', 'pipette2')
                    ->setCellValue('H13', 'vf3')
                    ->setCellValue('I13', 'pipette3')
                    ->setCellValue('J13', 'vf4')
                    ->setCellValue('L13', 'Concetration')
                    ->setCellValue('F14', $potency)

                    //Assay Standard Preparation desired  
                    ->setCellValue('A14', 'Desired Weight')
                    ->setCellValue('B14', $pwnumber)
                    ->setCellValue('C14', $aiweight)
                    ->setCellValue('D14', $svf1)
                    ->setCellValue('E14', $sp1)
                    ->setCellValue('F14', $svf2)
                    ->setCellValue('G14', $spipette2)
                    ->setCellValue('H14', $svf3)
                    ->setCellValue('I14', $spipette3)
                    ->setCellValue('J14', $vf41)
                    ->setCellValue('L14', $smgml)
                    ->setCellValue('A15', 'Sample A')
                    ->setCellValue('B15', $sampleA)
                    ->setCellValue('C15', $u_weighta)
                    ->setCellValue('D15', $svf11)
                    ->setCellValue('E15', $sp11)
                    ->setCellValue('F15', $svf12)
                    ->setCellValue('G15', $spf1)
                    ->setCellValue('H15', $svf13)
                    ->setCellValue('I15', $spf21)
                    ->setCellValue('J15', $svf14)
                    ->setCellValue('L15', $smgml1)
                    ->setCellValue('A16', 'Sample B')
                    ->setCellValue('B16', $sampleB)
                    ->setCellValue('C16', $u_weightb)
                    ->setCellValue('D16', $svf111)
                    ->setCellValue('E16', $sp12)
                    ->setCellValue('F16', $svf22)
                    ->setCellValue('G16', $spf2)
                    ->setCellValue('H16', $svf23)
                    ->setCellValue('I16', $spf33)
                    ->setCellValue('J16', $svf241)
                    ->setCellValue('L16', $smgml2)
                    ->setCellValue('A17', 'Sample C')
                    ->setCellValue('B17', $sampleC)
                    ->setCellValue('C17', $u_weightc)
                    ->setCellValue('D17', $svf31)
                    ->setCellValue('E17', $ssp3)
                    ->setCellValue('F17', $svf33)
                    ->setCellValue('G17', $spf3)
                    ->setCellValue('H17', $svf24)
                    ->setCellValue('I17', $spf4)
                    ->setCellValue('J17', $svf25)
                    ->setCellValue('L17', $smgml3)

                    //Other values used
                    ->setCellValue('D22', 'Label Claim')
                    ->setCellValue('D23', 'Tabs or Caps Average')
                    ->setCellValue('D24', 'Procedure Used')
                    ->setCellValue('F22', $labelclaim)
                    ->setCellValue('F23', $tabs_caps_average)
                    ->setCellValue('F24', $procedure);

//                    ->setCellValue('A3', 'Worksheet No')
//                    ->setCellValue('B43', $labref);




            $objPHPExcel->getActiveSheet()->setTitle($heading);


            $dir = "workbooks";

            if (is_dir($dir)) {

                /* $objDrawing = new PHPExcel_Worksheet_Drawing();
                  $objDrawing->setName('NQCL');
                  $objDrawing->setDescription('The Image that I am inserting');
                  $objDrawing->setPath('exclusive_image/nqcl.png');
                  $objDrawing->setCoordinates('A1');
                  $objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); */

                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");
                $this->updateWorksheetNo();

                echo 'Data exported';
            } else {
                echo 'Dir does not exist';
            }
        }
    }

    function checkRepeatStatusCaps_t($labref) {
        $heading = $this->input->post('heading');
        $this->db->select_max('repeat_status');
        $this->db->where('labref', $labref);
        $this->db->where('component', $heading);
        $query = $this->db->get('multiple_assaystdab');
        $result = $query->result();
        return $result[0]->repeat_status;
    }

//======================================TABS TO EXCEL=========================================================//
    public function exportTabsToExcel() {
        $labref = $this->uri->segment(3);
        $repeat_stat = $this->checkRepeatStatusTabs($labref);
        $tcsv1 = $this->input->post('tcsv1');
        $dfm1 = $this->input->post('dfm1');
        $tcsv2 = $this->input->post('tcsv2');
        $dfm2 = $this->input->post('dfm2');
        $tcsv3 = $this->input->post('tcsv3');
        $dfm3 = $this->input->post('dfm3');
        $tcsv4 = $this->input->post('tcsv4');
        $dfm4 = $this->input->post('dfm4');
        $tcsv5 = $this->input->post('tcsv5');
        $dfm5 = $this->input->post('dfm5');
        $tcsv6 = $this->input->post('tcsv6');
        $dfm6 = $this->input->post('dfm6');
        $tcsv7 = $this->input->post('tcsv7');
        $dfm7 = $this->input->post('dfm7');
        $tcsv8 = $this->input->post('tcsv8');
        $dfm8 = $this->input->post('dfm8');
        $tcsv9 = $this->input->post('tcsv9');
        $dfm9 = $this->input->post('dfm9');
        $tcsv10 = $this->input->post('tcsv10');
        $dfm10 = $this->input->post('dfm10');
        $tcsv11 = $this->input->post('tcsv11');
        $dfm11 = $this->input->post('dfm11');
        $tcsv12 = $this->input->post('tcsv12');
        $dfm12 = $this->input->post('dfm12');
        $tcsv13 = $this->input->post('tcsv13');
        $dfm13 = $this->input->post('dfm13');
        $tcsv14 = $this->input->post('tcsv14');
        $dfm14 = $this->input->post('dfm14');
        $tcsv15 = $this->input->post('tcsv15');
        $dfm15 = $this->input->post('dfm15');
        $tcsv16 = $this->input->post('tcsv16');
        $dfm16 = $this->input->post('dfm16');
        $tcsv17 = $this->input->post('tcsv17');
        $dfm17 = $this->input->post('dfm17');
        $tcsv18 = $this->input->post('tcsv18');
        $dfm18 = $this->input->post('dfm18');
        $tcsv19 = $this->input->post('tcsv19');
        $dfm19 = $this->input->post('dfm19');
        $tcsv20 = $this->input->post('tcsv20');
        $dfm20 = $this->input->post('dfm20');
        if (!empty($repeat_stat)) {

            // var_dump($_POST);
            $objReader = PHPExcel_IOFactory::createReader('Excel2007');

            //we load the file that we want to read

            $objPHPExcel = $objReader->load("workbooks/" . $labref . "/" . $labref . ".xlsx");

            //$objPHPExcel->createSheet();
            $objPHPExcel->setActiveSheetIndexbyName('uniformity');
            $objPHPExcel->getActiveSheet()
                    ->setCellValue('B28', 'UNIFORMITY TABS REPEAT: ' . $repeat_stat)
                    ->setCellValue('A30', 'Tablets(mg)')
                    ->setCellValue('C30', 'Percentage Deviation')
                    ->setCellValue('A31', $tcsv1)
                    ->setCellValue('C31', $dfm1)
                    ->setCellValue('A32', $tcsv2)
                    ->setCellValue('C32', $dfm2)
                    ->setCellValue('A33', $tcsv3)
                    ->setCellValue('C33', $dfm3)
                    ->setCellValue('A34', $tcsv4)
                    ->setCellValue('C34', $dfm4)
                    ->setCellValue('A35', $tcsv5)
                    ->setCellValue('C35', $dfm5)
                    ->setCellValue('A36', $tcsv6)
                    ->setCellValue('C36', $dfm6)
                    ->setCellValue('A37', $tcsv7)
                    ->setCellValue('C37', $dfm7)
                    ->setCellValue('A38', $tcsv8)
                    ->setCellValue('C38', $dfm8)
                    ->setCellValue('A39', $tcsv9)
                    ->setCellValue('C39', $dfm9)
                    ->setCellValue('A40', $tcsv10)
                    ->setCellValue('C40', $dfm10)
                    ->setCellValue('A41', $tcsv11)
                    ->setCellValue('C41', $dfm11)
                    ->setCellValue('A42', $tcsv12)
                    ->setCellValue('C42', $dfm12)
                    ->setCellValue('A43', $tcsv13)
                    ->setCellValue('C43', $dfm13)
                    ->setCellValue('A44', $tcsv14)
                    ->setCellValue('C44', $dfm14)
                    ->setCellValue('A45', $tcsv15)
                    ->setCellValue('C45', $dfm15)
                    ->setCellValue('A46', $tcsv16)
                    ->setCellValue('C46', $dfm16)
                    ->setCellValue('A47', $tcsv17)
                    ->setCellValue('C47', $dfm17)
                    ->setCellValue('A48', $tcsv18)
                    ->setCellValue('C48', $dfm18)
                    ->setCellValue('A49', $tcsv19)
                    ->setCellValue('C49', $dfm19)
                    ->setCellValue('A50', $tcsv20)
                    ->setCellValue('C50', $dfm20)
                    ->setCellValue('A51', 'Worksheet No')
                    ->setCellValue('C51', $labref);





            $objPHPExcel->getActiveSheet()->setTitle("uniformity");


            $dir = "workbooks";

            if (is_dir($dir)) {

                /* $objDrawing = new PHPExcel_Worksheet_Drawing();
                  $objDrawing->setName('NQCL');
                  $objDrawing->setDescription('The Image that I am inserting');
                  $objDrawing->setPath('exclusive_image/nqcl.png');
                  $objDrawing->setCoordinates('A1');
                  $objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); */

                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");
                // $this->updateWorksheetNo();

                echo 'Data exported';
            } else {
                echo 'Dir does not exist';
            }
        } else {

            $data = $this->getLastWorksheet();
            echo $worksheetIndex = $data[0]->no_of_sheets;




            // var_dump($_POST);
            $objReader = PHPExcel_IOFactory::createReader('Excel2007');

            //we load the file that we want to read

            $objPHPExcel = $objReader->load("workbooks/" . $labref . "/" . $labref . ".xlsx");

            $objPHPExcel->createSheet();
            $objPHPExcel->setActiveSheetIndex($worksheetIndex);
            $objPHPExcel->getActiveSheet()
                    ->setCellValue('A2', 'Tablets(mg)')
                    ->setCellValue('C2', 'Percentage Deviation')
                    ->setCellValue('A4', $tcsv1)
                    ->setCellValue('C4', $dfm1)
                    ->setCellValue('A5', $tcsv2)
                    ->setCellValue('C5', $dfm2)
                    ->setCellValue('A6', $tcsv3)
                    ->setCellValue('C6', $dfm3)
                    ->setCellValue('A7', $tcsv4)
                    ->setCellValue('C7', $dfm4)
                    ->setCellValue('A8', $tcsv5)
                    ->setCellValue('C8', $dfm5)
                    ->setCellValue('A9', $tcsv6)
                    ->setCellValue('C9', $dfm6)
                    ->setCellValue('A10', $tcsv7)
                    ->setCellValue('C10', $dfm7)
                    ->setCellValue('A11', $tcsv8)
                    ->setCellValue('C11', $dfm8)
                    ->setCellValue('A12', $tcsv9)
                    ->setCellValue('C12', $dfm9)
                    ->setCellValue('A13', $tcsv10)
                    ->setCellValue('C13', $dfm10)
                    ->setCellValue('A14', $tcsv11)
                    ->setCellValue('C14', $dfm11)
                    ->setCellValue('A15', $tcsv12)
                    ->setCellValue('C15', $dfm12)
                    ->setCellValue('A16', $tcsv13)
                    ->setCellValue('C16', $dfm13)
                    ->setCellValue('A17', $tcsv14)
                    ->setCellValue('C17', $dfm14)
                    ->setCellValue('A18', $tcsv15)
                    ->setCellValue('C18', $dfm15)
                    ->setCellValue('A19', $tcsv16)
                    ->setCellValue('C19', $dfm16)
                    ->setCellValue('A20', $tcsv17)
                    ->setCellValue('C20', $dfm17)
                    ->setCellValue('A21', $tcsv18)
                    ->setCellValue('C21', $dfm18)
                    ->setCellValue('A22', $tcsv19)
                    ->setCellValue('C22', $dfm19)
                    ->setCellValue('A23', $tcsv20)
                    ->setCellValue('C23', $dfm20)
                    ->setCellValue('A25', 'Worksheet No')
                    ->setCellValue('C25', $labref);






            $objPHPExcel->getActiveSheet()->setTitle("uniformity");


            $dir = "workbooks";

            if (is_dir($dir)) {

                /* $objDrawing = new PHPExcel_Worksheet_Drawing();
                  $objDrawing->setName('NQCL');
                  $objDrawing->setDescription('The Image that I am inserting');
                  $objDrawing->setPath('exclusive_image/nqcl.png');
                  $objDrawing->setCoordinates('A1');
                  $objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); */

                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");
                $this->updateWorksheetNo();

                echo 'Data exported';
            } else {
                echo 'Dir does not exist';
            }
        }
    }

    function checkRepeatStatusTabs($labref) {
        $this->db->select_max('repeat_status');
        $this->db->where('labref', $labref);
        $query = $this->db->get('weight_tablets');
        $result = $query->result();
        return $result[0]->repeat_status;
    }

    //====================================UNIFORMITY TO EXCEL====================================================//    


    public function exportCapsToExcel() {
        if ($this->getDoStatus() > 1) {
            echo 'You have reached sample test limit, This test is marked as an OOS sample now';
        } else {
            $data = $this->getLastWorksheet();
            echo $worksheetIndex = $data[0]->no_of_sheets;
            if ($_POST):
                $tcsv1 = $this->input->post('tcsv1');
                $ecsv1 = $this->input->post('ecsv1');
                $csvc1 = $this->input->post('csvc1');
                $dfm1 = $this->input->post('dfm1');

                $tcsv2 = $this->input->post('tcsv2');
                $ecsv2 = $this->input->post('ecsv2');
                $csvc2 = $this->input->post('csvc2');
                $dfm2 = $this->input->post('dfm2');

                $tcsv3 = $this->input->post('tcsv3');
                $ecsv3 = $this->input->post('ecsv3');
                $csvc3 = $this->input->post('csvc3');
                $dfm3 = $this->input->post('dfm3');

                $tcsv4 = $this->input->post('tcsv4');
                $ecsv4 = $this->input->post('ecsv4');
                $csvc4 = $this->input->post('csvc4');
                $dfm4 = $this->input->post('dfm4');

                $tcsv5 = $this->input->post('tcsv5');
                $ecsv5 = $this->input->post('ecsv5');
                $csvc5 = $this->input->post('csvc5');
                $dfm5 = $this->input->post('dfm5');

                $tcsv6 = $this->input->post('tcsv6');
                $ecsv6 = $this->input->post('ecsv6');
                $csvc6 = $this->input->post('csvc6');
                $dfm6 = $this->input->post('dfm6');

                $tcsv7 = $this->input->post('tcsv7');
                $ecsv7 = $this->input->post('ecsv7');
                $csvc7 = $this->input->post('csvc7');
                $dfm7 = $this->input->post('dfm7');

                $tcsv8 = $this->input->post('tcsv8');
                $ecsv8 = $this->input->post('ecsv8');
                $csvc8 = $this->input->post('csvc8');
                $dfm8 = $this->input->post('dfm8');

                $tcsv9 = $this->input->post('tcsv9');
                $ecsv9 = $this->input->post('ecsv9');
                $csvc9 = $this->input->post('csvc9');
                $dfm9 = $this->input->post('dfm9');

                $tcsv10 = $this->input->post('tcsv10');
                $ecsv10 = $this->input->post('ecsv10');
                $csvc10 = $this->input->post('csvc10');
                $dfm10 = $this->input->post('dfm10');

                $tcsv11 = $this->input->post('tcsv11');
                $ecsv11 = $this->input->post('ecsv11');
                $csvc11 = $this->input->post('csvc11');
                $dfm11 = $this->input->post('dfm11');

                $tcsv12 = $this->input->post('tcsv12');
                $ecsv12 = $this->input->post('ecsv12');
                $csvc12 = $this->input->post('csvc12');
                $dfm12 = $this->input->post('dfm12');

                $tcsv13 = $this->input->post('tcsv13');
                $ecsv13 = $this->input->post('ecsv13');
                $csvc13 = $this->input->post('csvc13');
                $dfm13 = $this->input->post('dfm13');

                $tcsv14 = $this->input->post('tcsv14');
                $ecsv14 = $this->input->post('ecsv14');
                $csvc14 = $this->input->post('csvc14');
                $dfm14 = $this->input->post('dfm14');

                $tcsv15 = $this->input->post('tcsv15');
                $ecsv15 = $this->input->post('ecsv15');
                $csvc15 = $this->input->post('csvc15');
                $dfm15 = $this->input->post('dfm15');

                $tcsv16 = $this->input->post('tcsv16');
                $ecsv16 = $this->input->post('ecsv16');
                $csvc16 = $this->input->post('csvc16');
                $dfm16 = $this->input->post('dfm16');

                $tcsv17 = $this->input->post('tcsv17');
                $ecsv17 = $this->input->post('ecsv17');
                $csvc17 = $this->input->post('csvc17');
                $dfm17 = $this->input->post('dfm17');

                $tcsv18 = $this->input->post('tcsv18');
                $ecsv18 = $this->input->post('ecsv18');
                $csvc18 = $this->input->post('csvc18');
                $dfm18 = $this->input->post('dfm18');

                $tcsv19 = $this->input->post('tcsv19');
                $ecsv19 = $this->input->post('ecsv19');
                $csvc19 = $this->input->post('csvc19');
                $dfm19 = $this->input->post('dfm19');

                $tcsv20 = $this->input->post('tcsv20');
                $ecsv20 = $this->input->post('ecsv20');
                $csvc20 = $this->input->post('csvc20');
                $dfm20 = $this->input->post('dfm20');

                $comment = $this->input->post('comment');

                $labref = $this->uri->segment(3);
                // var_dump($_POST);
                $objReader = PHPExcel_IOFactory::createReader('Excel2007');

                //we load the file that we want to read

                $objPHPExcel = $objReader->load("workbooks/" . $labref . "/" . $labref . ".xlsx");

                $objPHPExcel->createSheet();
                $objPHPExcel->setActiveSheetIndex($worksheetIndex);
                $objPHPExcel->getActiveSheet()
                        ->setCellValue('A22', 'Capsules/Sachets/Vials (mg)')
                        ->setCellValue('C22', 'Empty Capsule/ Sachet/Vial  (mg)')
                        ->setCellValue('D22', 'Capsule/Sachet/Vial Content (mg)')
                        ->setCellValue('E22', 'Percentage Deviation')
                        ->setCellValue('A24', $tcsv1)
                        ->setCellValue('C24', $ecsv1)
                        ->setCellValue('D24', $csvc1)
                        ->setCellValue('E24', $dfm1)
                        ->setCellValue('A25', $tcsv2)
                        ->setCellValue('C25', $ecsv2)
                        ->setCellValue('D25', $csvc2)
                        ->setCellValue('E25', $dfm2)
                        ->setCellValue('A26', $tcsv3)
                        ->setCellValue('C26', $ecsv3)
                        ->setCellValue('D26', $csvc3)
                        ->setCellValue('E26', $dfm3)
                        ->setCellValue('A27', $tcsv4)
                        ->setCellValue('C27', $ecsv4)
                        ->setCellValue('D27', $csvc4)
                        ->setCellValue('E27', $dfm4)
                        ->setCellValue('A28', $tcsv5)
                        ->setCellValue('C28', $ecsv5)
                        ->setCellValue('D28', $csvc5)
                        ->setCellValue('E28', $dfm5)
                        ->setCellValue('A29', $tcsv6)
                        ->setCellValue('C29', $ecsv6)
                        ->setCellValue('D29', $csvc6)
                        ->setCellValue('E29', $dfm6)
                        ->setCellValue('A30', $tcsv7)
                        ->setCellValue('C30', $ecsv7)
                        ->setCellValue('D30', $csvc7)
                        ->setCellValue('E30', $dfm7)
                        ->setCellValue('A31', $tcsv8)
                        ->setCellValue('C31', $ecsv8)
                        ->setCellValue('D31', $csvc8)
                        ->setCellValue('E31', $dfm8)
                        ->setCellValue('A32', $tcsv9)
                        ->setCellValue('C32', $ecsv9)
                        ->setCellValue('D32', $csvc9)
                        ->setCellValue('E32', $dfm9)
                        ->setCellValue('A33', $tcsv10)
                        ->setCellValue('C33', $ecsv10)
                        ->setCellValue('D33', $csvc10)
                        ->setCellValue('E33', $dfm10)
                        ->setCellValue('A34', $tcsv11)
                        ->setCellValue('C34', $ecsv11)
                        ->setCellValue('D34', $csvc11)
                        ->setCellValue('E34', $dfm11)
                        ->setCellValue('A35', $tcsv12)
                        ->setCellValue('C35', $ecsv12)
                        ->setCellValue('D35', $csvc12)
                        ->setCellValue('E35', $dfm12)
                        ->setCellValue('A36', $tcsv13)
                        ->setCellValue('C36', $ecsv13)
                        ->setCellValue('D36', $csvc13)
                        ->setCellValue('E36', $dfm13)
                        ->setCellValue('A37', $tcsv14)
                        ->setCellValue('C37', $ecsv14)
                        ->setCellValue('D37', $csvc14)
                        ->setCellValue('E37', $dfm14)
                        ->setCellValue('A38', $tcsv15)
                        ->setCellValue('C38', $ecsv15)
                        ->setCellValue('D38', $csvc15)
                        ->setCellValue('E38', $dfm15)
                        ->setCellValue('A39', $tcsv16)
                        ->setCellValue('C39', $ecsv16)
                        ->setCellValue('D39', $csvc16)
                        ->setCellValue('E39', $dfm16)
                        ->setCellValue('A40', $tcsv17)
                        ->setCellValue('C40', $ecsv17)
                        ->setCellValue('D40', $csvc17)
                        ->setCellValue('E40', $dfm17)
                        ->setCellValue('A41', $tcsv18)
                        ->setCellValue('C41', $ecsv18)
                        ->setCellValue('D41', $csvc18)
                        ->setCellValue('E41', $dfm18)
                        ->setCellValue('A42', $tcsv19)
                        ->setCellValue('C42', $ecsv19)
                        ->setCellValue('D42', $csvc19)
                        ->setCellValue('E42', $dfm19)
                        ->setCellValue('A43', $tcsv20)
                        ->setCellValue('C43', $ecsv20)
                        ->setCellValue('D43', $csvc20)
                        ->setCellValue('E43', $dfm20)
                        ->setCellValue('A45', 'Comment')
                        ->setCellValue('B45', $comment)
                        ->setCellValue('B47', 'Worksheet No')
                        ->setCellValue('C47', $labref);



                $repeat_stat = $this->checkRepeatStatusCaps($labref);

                if (empty($repeat_stat)) {

                    $objPHPExcel->getActiveSheet()->setTitle("uniformity");
                } else {
                    $objPHPExcel->getActiveSheet()->setTitle("uniformity repeat - " . $repeat_stat);
                }

                $dir = "workbooks";

                if (is_dir($dir)) {

                    /* $objDrawing = new PHPExcel_Worksheet_Drawing();
                      $objDrawing->setName('NQCL');
                      $objDrawing->setDescription('The Image that I am inserting');
                      $objDrawing->setPath('exclusive_image/nqcl.png');
                      $objDrawing->setCoordinates('A1');
                      $objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); */

                    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                    $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");
                    $this->updateWorksheetNo();

                    echo 'Data exported';
                } else {
                    echo 'Dir does not exist';
                }


                return true;
            else:
                return false;
            endif;
        }
    }

    function checkRepeatStatusCapsules($labref) {
        $this->db->select_max('repeat_status');
        $this->db->where('labref', $labref);
        $query = $this->db->get('uniformity');
        $result = $query->result();
        return $result[0]->repeat_status;
    }

    //======================================ASSAY TO EXCEL=========================================================//

    public function sendDataFlyingToExcel() {
        $data = $this->getLastWorksheet();
        echo $worksheetIndex = $data[0]->no_of_sheets;
        if ($_POST):
            //Worksheet Information

            $labref = $this->uri->segment(3);

            $heading = $this->input->post('heading');
            $potency = $this->input->post('potency');

            $weight = $this->input->post('workingweight');
            $vf1 = $this->input->post('workingvf1');
            $pipette1 = $this->input->post('workingpipette1');
            $vf2 = $this->input->post('workingvf2');
            $pipette2 = $this->input->post('workingpipette2');
            $vf3 = $this->input->post('workingvf3');
            $pipette3 = $this->input->post('workingp3');
            $vf4 = $this->input->post('workingvf4');
            $concetration = $this->input->post('workingmgml');



            $weightA = $this->input->post('u_weight');
            $vf1A = $this->input->post('vf1');
            $pipette1A = $this->input->post('pipette1');
            $vf2A = $this->input->post('vf2');
            $pipette2A = $this->input->post('p2');
            $vf3A = $this->input->post('vf31');
            $pipette3A = $this->input->post('p321');
            $vf4A = $this->input->post('vf32');
            $concetrationA = $this->input->post('mgml');


            $weightB = $this->input->post('u_weight1');
            $vf1B = $this->input->post('vf11');
            $pipette1B = $this->input->post('ppt');
            $vf2B = $this->input->post('vf22');
            $pipette2B = $this->input->post('ppt1');
            $vf3B = $this->input->post('vf33');
            $pipette3B = $this->input->post('ppt2');
            $vf4B = $this->input->post('vf34');
            $concetrationB = $this->input->post('mgml1');

            //sample assay posted data
            $pwnumber = $this->input->post('pwnumber');
            $sampleA = $this->input->post('sampleA');
            $sampleB = $this->input->post('sampleB');
            $sampleC = $this->input->post('sampleC');

            $aiweight = $this->input->post('aiweight');
            $u_weighta = $this->input->post('aweightA');
            $u_weightb = $this->input->post('aweightB');
            $u_weightc = $this->input->post('aweightC');

            $svf1 = $this->input->post('svf1');
            $svf11 = $this->input->post('svf11');
            $svf111 = $this->input->post('vf111');
            $svf31 = $this->input->post('svf3');


            $sp1 = $this->input->post('sp1');
            $sp11 = $this->input->post('sp11');
            $sp12 = $this->input->post('sp112');
            $ssp3 = $this->input->post('ssp3');

            $svf2 = $this->input->post('svf2');
            $svf12 = $this->input->post('svf12');
            $svf22 = $this->input->post('svf22');
            $svf33 = $this->input->post('svf33');


            $spipette2 = $this->input->post('pipette2');
            $spf1 = $this->input->post('spf1');
            $spf2 = $this->input->post('spf2');
            $spf3 = $this->input->post('spf3');


            $svf3 = $this->input->post('vf3');
            $svf13 = $this->input->post('svf13');
            $svf23 = $this->input->post('svf23');
            $svf24 = $this->input->post('svf24');


            $spipette3 = $this->input->post('pipette3');
            $spf21 = $this->input->post('spf21');
            $spf33 = $this->input->post('spf33');
            $spf4 = $this->input->post('spf4');


            $vf41 = $this->input->post('vf41');
            $svf14 = $this->input->post('svf14');
            $svf241 = $this->input->post('svf241');
            $svf25 = $this->input->post('svf25');


            $smgml = $this->input->post('smgml');
            $smgml1 = $this->input->post('smgml1');
            $smgml2 = $this->input->post('smgml2');
            $smgml3 = $this->input->post('smgml3');

            //Other values used
            $tabs_caps_average = $this->input->post('tabs_caps_average');
            $labelclaim = $this->input->post('labelclaim');
            $procedure = $this->input->post('procedure');




            $objReader = PHPExcel_IOFactory::createReader('Excel2007');

            //we load the file that we want to read

            $objPHPExcel = $objReader->load("workbooks/" . $labref . "/" . $labref . ".xlsx");
            $objPHPExcel->createSheet();
            $objPHPExcel->setActiveSheetIndex($worksheetIndex);
            $objPHPExcel->getActiveSheet()
                    ->setCellValue('I19', $heading)
                    ->setCellValue('I22', 'Standard Preparation For Assay')
                    ->setCellValue('B23', 'Weight')
                    ->setCellValue('C23', 'vf1')
                    ->setCellValue('D23', 'pipette1')
                    ->setCellValue('E23', 'vf2')
                    ->setCellValue('F23', 'pipette2')
                    ->setCellValue('G23', 'vf3')
                    ->setCellValue('H23', 'pipette3')
                    ->setCellValue('I23', 'vf4')
                    ->setCellValue('K23', 'Concetration')

                    //Assay Standard Preparation desired  
                    ->setCellValue('A24', 'Desired Weight')
                    ->setCellValue('B24', $weight)
                    ->setCellValue('C24', $vf1)
                    ->setCellValue('D24', $pipette1)
                    ->setCellValue('E24', $vf2)
                    ->setCellValue('F24', $pipette2)
                    ->setCellValue('G24', $vf3)
                    ->setCellValue('H24', $pipette3)
                    ->setCellValue('I24', $vf4)
                    ->setCellValue('K24', $concetration)
                    ->setCellValue('A25', 'Standard A')
                    ->setCellValue('B25', $weightA)
                    ->setCellValue('C25', $vf1A)
                    ->setCellValue('D25', $pipette1A)
                    ->setCellValue('E25', $vf2A)
                    ->setCellValue('F25', $pipette2A)
                    ->setCellValue('G25', $vf3A)
                    ->setCellValue('H25', $pipette3A)
                    ->setCellValue('I25', $vf4A)
                    ->setCellValue('K25', $concetrationA)
                    ->setCellValue('A26', 'Standard B')
                    ->setCellValue('B26', $weightB)
                    ->setCellValue('C26', $vf1B)
                    ->setCellValue('D26', $pipette1B)
                    ->setCellValue('E26', $vf2B)
                    ->setCellValue('F26', $pipette2B)
                    ->setCellValue('G26', $vf3B)
                    ->setCellValue('H26', $pipette3B)
                    ->setCellValue('I26', $vf4B)
                    ->setCellValue('K26', $concetrationB)

                    //SAMPLE ASSAY PREPARATION
                    ->setCellValue('I28', 'Sample Preparation For Assay')
                    ->setCellValue('B29', 'Powder Weight')
                    ->setCellValue('C29', 'API Weight')
                    ->setCellValue('D29', 'vf1')
                    ->setCellValue('E29', 'pipette1')
                    ->setCellValue('F29', 'vf2')
                    ->setCellValue('G29', 'pipette2')
                    ->setCellValue('H29', 'vf3')
                    ->setCellValue('I29', 'pipette3')
                    ->setCellValue('J29', 'vf4')
                    ->setCellValue('L29', 'Concetration')
                    ->setCellValue('F30', $potency)

                    //Assay Standard Preparation desired  
                    ->setCellValue('A30', 'Desired Weight')
                    ->setCellValue('B30', $pwnumber)
                    ->setCellValue('C30', $aiweight)
                    ->setCellValue('D30', $svf1)
                    ->setCellValue('E30', $sp1)
                    ->setCellValue('F30', $svf2)
                    ->setCellValue('G30', $spipette2)
                    ->setCellValue('H30', $svf3)
                    ->setCellValue('I30', $spipette3)
                    ->setCellValue('J30', $vf41)
                    ->setCellValue('L30', $smgml)
                    ->setCellValue('A31', 'Sample A')
                    ->setCellValue('B31', $sampleA)
                    ->setCellValue('C31', $u_weighta)
                    ->setCellValue('D31', $svf11)
                    ->setCellValue('E31', $sp11)
                    ->setCellValue('F31', $svf12)
                    ->setCellValue('G31', $spf1)
                    ->setCellValue('H31', $svf13)
                    ->setCellValue('I31', $spf21)
                    ->setCellValue('J31', $svf14)
                    ->setCellValue('L31', $smgml1)
                    ->setCellValue('A32', 'Sample B')
                    ->setCellValue('B32', $sampleB)
                    ->setCellValue('C32', $u_weightb)
                    ->setCellValue('D32', $svf111)
                    ->setCellValue('E32', $sp12)
                    ->setCellValue('F32', $svf22)
                    ->setCellValue('G32', $spf2)
                    ->setCellValue('H32', $svf23)
                    ->setCellValue('I32', $spf33)
                    ->setCellValue('J32', $svf241)
                    ->setCellValue('L32', $smgml2)
                    ->setCellValue('A33', 'Sample C')
                    ->setCellValue('B33', $sampleC)
                    ->setCellValue('C33', $u_weightc)
                    ->setCellValue('D33', $svf31)
                    ->setCellValue('E33', $ssp3)
                    ->setCellValue('F33', $svf33)
                    ->setCellValue('G33', $spf3)
                    ->setCellValue('H33', $svf24)
                    ->setCellValue('I33', $spf4)
                    ->setCellValue('J33', $svf25)
                    ->setCellValue('L33', $smgml3)

                    //Other values used
                    ->setCellValue('D38', 'Label Claim')
                    ->setCellValue('D39', 'Tabs or Caps Average')
                    ->setCellValue('D40', 'Procedure Used')
                    ->setCellValue('F38', $labelclaim)
                    ->setCellValue('F39', $tabs_caps_average)
                    ->setCellValue('F40', $procedure)
                    ->setCellValue('A3', 'Worksheet No')
                    ->setCellValue('B43', $labref);


            $repeat_stat = $this->checkRepeatStatusAssay($labref);

            if (empty($repeat_stat)) {

                $objPHPExcel->getActiveSheet()->setTitle("Assay");
            } else {
                $objPHPExcel->getActiveSheet()->setTitle("Assay repeat - " . $repeat_stat);
            }

            $dir = "workbooks";

            if (is_dir($dir)) {

                /* $objDrawing = new PHPExcel_Worksheet_Drawing();
                  $objDrawing->setName('NQCL');
                  $objDrawing->setDescription('The Image that I am inserting');
                  $objDrawing->setPath('exclusive_image/nqcl.png');
                  $objDrawing->setCoordinates('A1');
                  $objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); */

                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");
                $this->updateWorksheetNo();

                echo 'Data exported';
            } else {
                echo 'Dir does not exist';
            }



            return true;
        else:
            return false;
        endif;
    }

    function checkRepeatStatusAssay($labref) {
        $this->db->select_max('repeat_status');
        $this->db->where('labref', $labref);
        $query = $this->db->get('multiple_assaystdab');
        $result = $query->result();
        return $result[0]->repeat_status;
    }

    //======================================DISSOLUTION TO EXCEL=========================================================//
    public function sendDissolutionDataToExcel() {
        $data = $this->getLastWorksheet();
        echo $worksheetIndex = $data[0]->no_of_sheets;
        if ($_POST):
            $labref = $this->uri->segment(3);
            //Tabs caps
            $tc1 = $this->input->post('tc1');
            $tc2 = $this->input->post('tc2');
            $tc3 = $this->input->post('tc3');
            $tc4 = $this->input->post('tc4');
            $tc5 = $this->input->post('tc5');
            $tc6 = $this->input->post('tc6');

            $tcmean = $this->input->post('tcmean');
            $tcreading = $this->input->post('tcreading');

            //Dissolution Conditions
            $DM = $this->input->post('DM');
            $R2 = $this->input->post('R2');
            $apparatus = $this->input->post('apparatus');
            $Rm = $this->input->post('Rm');
            $R3 = $this->input->post('R3');


            //dillution conditions
            $label_claim = $this->input->post('labelclaim');
            $volume_used = $this->input->post('vu');
            $piette = $this->input->post('workingp1');
            $volume = $this->input->post('workingv');
            $piette2 = $this->input->post('workingp2');
            $volume2 = $this->input->post('workingv2');
            $piette3 = $this->input->post('workingp3');
            $volume3 = $this->input->post('workingv3');
            $piette4 = $this->input->post('workingp4');
            $volume4 = $this->input->post('workingv4');
            $concetration = $this->input->post('conc');

            //procedure description
            $procedure = $this->input->post('procedure');

            //standard preparation
            //Standard preparation
            $workingweight = $this->input->post('workingweight');
            $workingvf1 = $this->input->post('workingvf1');
            $workingp11 = $this->input->post('workingp11');
            $workingvf2 = $this->input->post('workingvf2');
            $workingp12 = $this->input->post('workingp12');
            $workingvf3 = $this->input->post('workingvf3');
            $workingp13 = $this->input->post('workingp13');
            $workingvf4 = $this->input->post('workingvf4');
            $workingmgml = $this->input->post('workingmgml');

            $weightA = $this->input->post('u_weightA');
            $v1 = $this->input->post('v11');
            $p1 = $this->input->post('standardp1');
            $vf = $this->input->post('standardvf');
            $p2 = $this->input->post('p20');
            $vf3 = $this->input->post('vf3');
            $p3 = $this->input->post('p211');
            $vf4 = $this->input->post('vf4');
            $dmgml = $this->input->post('dmgml');

            $weightB = $this->input->post('u_weightB');
            $v12 = $this->input->post('v2');
            $p12 = $this->input->post('standardp2');
            $vf12 = $this->input->post('standardvf1');
            $p21 = $this->input->post('p21');
            $vf23 = $this->input->post('vf23');
            $p22 = $this->input->post('p22');
            $vf24 = $this->input->post('vf24');
            $dmgml1 = $this->input->post('dmgml1');

            $objReader = PHPExcel_IOFactory::createReader('Excel2007');

            //we load the file that we want to read

            $objPHPExcel = $objReader->load("workbooks/" . $labref . "/" . $labref . ".xlsx");
            $objPHPExcel->createSheet();
            $objPHPExcel->setActiveSheetIndex($worksheetIndex);
            $objPHPExcel->getActiveSheet()
                    ->setCellValue('E22', 'Tabs/Capsule Weight')
                    ->setCellValue('E23', 'No.')
                    ->setCellValue('F23', 'Tabs/Capsule Weights (mg)')
                    ->setCellValue('E24', '1')
                    ->setCellValue('F24', $tc1)
                    ->setCellValue('E25', '2')
                    ->setCellValue('F25', $tc2)
                    ->setCellValue('E26', '3')
                    ->setCellValue('F26', $tc3)
                    ->setCellValue('E27', '4')
                    ->setCellValue('F27', $tc4)
                    ->setCellValue('E28', '5')
                    ->setCellValue('F28', $tc5)
                    ->setCellValue('E29', '6')
                    ->setCellValue('F29', $tc6)
                    ->setCellValue('E30', 'Total')
                    ->setCellValue('F30', $tcreading)
                    ->setCellValue('E31', 'Mean')
                    ->setCellValue('F31', $tcmean)
                    ->setCellValue('E33', 'Dissolution Conditions')
                    ->setCellValue('H34', 'n Run')
                    ->setCellValue('F35', 'Dissolution Medium')
                    ->setCellValue('H35', $DM)
                    ->setCellValue('F36', 'Volume Used')
                    ->setCellValue('H36', $R2)
                    ->setCellValue('F37', 'Apparatus')
                    ->setCellValue('H37', $apparatus)
                    ->setCellValue('F38', 'Rotations Per minute')
                    ->setCellValue('H38', $Rm)
                    ->setCellValue('F39', 'Time Taken')
                    ->setCellValue('H39', $R3)
                    ->setCellValue('E41', 'Subsequent Dillutions')
                    ->setCellValue('B42', 'Label Claim')
                    ->setCellValue('C42', 'Volume Used')
                    ->setCellValue('D42', 'pipette1')
                    ->setCellValue('E42', 'vf1')
                    ->setCellValue('F42', 'pipette2')
                    ->setCellValue('G42', 'vf2')
                    ->setCellValue('H42', 'pipette3')
                    ->setCellValue('I42', 'vf3')
                    ->setCellValue('J42', 'pipette4')
                    ->setCellValue('K42', 'vf4')
                    ->setCellValue('L42', 'Concetration')
                    ->setCellValue('A43', 'Desired Concetration')
                    ->setCellValue('B43', $label_claim)
                    ->setCellValue('C43', $volume_used)
                    ->setCellValue('D43', $piette)
                    ->setCellValue('E43', $volume)
                    ->setCellValue('F43', $piette2)
                    ->setCellValue('G43', $volume2)
                    ->setCellValue('H43', $piette3)
                    ->setCellValue('I43', $volume3)
                    ->setCellValue('J43', $piette4)
                    ->setCellValue('K43', $volume4)
                    ->setCellValue('L43', $concetration)



                    //SAMPLE ASSAY PREPARATION
                    ->setCellValue('E45', 'Standard Preparation For Dissolution')
                    ->setCellValue('B46', 'Powder Weight')
                    ->setCellValue('C46', 'API Weight')
                    ->setCellValue('D46', 'vf1')
                    ->setCellValue('E46', 'pipette1')
                    ->setCellValue('F46', 'vf2')
                    ->setCellValue('G46', 'pipette2')
                    ->setCellValue('H46', 'vf3')
                    ->setCellValue('I46', 'pipette3')
                    ->setCellValue('J46', 'vf4')
                    ->setCellValue('L46', 'Concetration')

                    //Assay Standard Preparation desired  
                    ->setCellValue('A47', 'Desired Weight')
                    ->setCellValue('B47', $workingweight)
                    ->setCellValue('C47', $workingvf1)
                    ->setCellValue('D47', $workingp11)
                    ->setCellValue('E47', $workingvf2)
                    ->setCellValue('F47', $workingp12)
                    ->setCellValue('G47', $workingvf3)
                    ->setCellValue('H47', $workingp13)
                    ->setCellValue('I47', $workingvf4)
                    ->setCellValue('J47', $workingmgml)
                    ->setCellValue('A48', 'Standard A')
                    ->setCellValue('B48', $weightA)
                    ->setCellValue('C48', $v1)
                    ->setCellValue('D48', $p1)
                    ->setCellValue('E48', $vf)
                    ->setCellValue('F48', $p2)
                    ->setCellValue('G48', $vf3)
                    ->setCellValue('H48', $p3)
                    ->setCellValue('I48', $vf4)
                    ->setCellValue('J48', $dmgml)
                    ->setCellValue('A49', 'Standard B')
                    ->setCellValue('B49', $weightB)
                    ->setCellValue('C49', $v12)
                    ->setCellValue('D49', $p12)
                    ->setCellValue('E49', $vf12)
                    ->setCellValue('F49', $p21)
                    ->setCellValue('G49', $vf23)
                    ->setCellValue('H49', $p22)
                    ->setCellValue('I49', $vf24)
                    ->setCellValue('J49', $dmgml1)


                    //Other values used
                    ->setCellValue('B51', 'Procedure Used')
                    ->setCellValue('C51', $procedure)
                    ->setCellValue('B53', 'Worksheet No')
                    ->setCellValue('C53', $labref);

            $repeat_stat = $this->checkRepeatStatusDissolution($labref);

            if (empty($repeat_stat)) {

                $objPHPExcel->getActiveSheet()->setTitle("Dissolution");
            } else {
                $objPHPExcel->getActiveSheet()->setTitle("Dissolution repeat - " . $repeat_stat);
            }

            $dir = "workbooks";

            if (is_dir($dir)) {

                /* $objDrawing = new PHPExcel_Worksheet_Drawing();
                  $objDrawing->setName('NQCL');
                  $objDrawing->setDescription('The Image that I am inserting');
                  $objDrawing->setPath('exclusive_image/nqcl.png');
                  $objDrawing->setCoordinates('A1');
                  $objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); */

                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");
                $this->updateWorksheetNo();

                echo 'Data exported';
            } else {
                echo 'Dir does not exist';
            }



            return true;
        else:
            return false;
        endif;
    }

    function checkRepeatStatusDissolution($labref) {
        $this->db->select_max('repeat_status');
        $this->db->where('labref', $labref);
        $query = $this->db->get('diss_data');
        $result = $query->result();
        return $result[0]->repeat_status;
    }

    //===================================================SUMMARY SAMPLE==================================================//
    public function getDataToExcel() {
        $component_no = $this->uri->segment(5);
        if ($component_no == '1') {

            $data = $this->getLastWorksheet();
            echo $worksheetIndex = $data[0]->no_of_sheets;
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

            $objReader = PHPExcel_IOFactory::createReader('Excel2007');
            $objPHPExcel = $objReader->load("workbooks/" . $labref . "/" . $labref . ".xlsx");


            echo 'Worksheet loaded';
            $NewWorksheetIndex = $worksheetIndex * 0;
            $objPHPExcel->setActiveSheetIndex($NewWorksheetIndex);
            $objPHPExcel->getActiveSheet()
                    //Worksheet Information
                    ->setCellValue('C88', $SampleName)
                    ->setCellValue('C89', $LabRef)
                    ->setCellValue('C90', $ActiveIng)
                    ->setCellValue('C91', $LabelClaim)
                    ->setCellValue('C92', $DateCompleted)
                    ->setCellValue('C18', 'Assay Standards - ' . $head)
                    ->setCellValue('E17', 'Sample Assay - ' . $head)

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
                    ->setCellValue('B24', $tab1)
                    ->setCellValue('B25', $tab2)
                    ->setCellValue('B26', $tab3)
                    ->setCellValue('B27', $tab4)
                    ->setCellValue('B28', $tab5)
                    ->setCellValue('B29', $tab6)

                    //Other Dssolution Data      
                    ->setCellValue('B32', $desiredweight)
                    ->setCellValue('B33', $disstda)
                    ->setCellValue('B34', $disstdb)
                    ->setCellValue('B35', $concetration)
                    ->setCellValue('B36', $tabaverage)
                    ->setCellValue('B40', $this->input->post('potency'))
                    // Uniformity Data
                    ->setCellValue('B19', $tabscapsaverage)
                    ->setCellValue('F25', $apstandardc)
                    ->setCellValue('B9', $head);

            //$this->addLogo();
            //PEAKS
//                    ->setCellValue('F30', $peak1)
//                    ->setCellValue('F31', $peak2)
//                    ->setCellValue('F32', $peak3)
//                    ->setCellValue('F33', $peak4);


            $objPHPExcel->getActiveSheet()->setTitle("Sample Summary");

            $dir = "workbooks";

            if (is_dir($dir)) {

                /* $objDrawing = new PHPExcel_Worksheet_Drawing();
                  $objDrawing->setName('NQCL');
                  $objDrawing->setDescription('The Image that I am inserting');
                  $objDrawing->setPath('exclusive_image/nqcl.png');
                  $objDrawing->setCoordinates('A1');
                  $objDrawing->setWorksheet($objWorkSheet->getActiveSheet(2)); */

                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objPHPExcel->getActiveSheet()->protectCells('A17:F85', 'PHP');
                $objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);
                $objPHPExcel->getActiveSheet()->getStyle('A86:Z1000')->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);
                $objPHPExcel->getActiveSheet()->getStyle('A9:F16')->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);

                $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");
                // $this->upDatePeaks($labref, $r);  



                echo 'Data exported';
            } else {
                echo 'Dir does not exist';
            }




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
        } elseif ($component_no == '2') {
            $labref = $this->uri->segment(3);
            $head = $this->input->post('head');

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

            $objReader = PHPExcel_IOFactory::createReader('Excel2007');
            $objPHPExcel = $objReader->load("workbooks/" . $labref . "/" . $labref . ".xlsx");

            $objPHPExcel->setActiveSheetIndex(0);
            $objPHPExcel->getActiveSheet()
                    ->setCellValue('C23', 'Assay Standards - ' . $head)
                    ->setCellValue('E29', 'Sample Assay - ' . $head)
                    ->setCellValue('C9', $head)
                    ->setCellValue('D26', $assayDesired)
                    ->setCellValue('D24', $stdA)
                    ->setCellValue('D25', $stdB)
                    ->setCellValue('D27', $dconcetration)
                    ->setCellValue('F39', $samplDesiredpw)
                    ->setCellValue('F40', $samplDesiredap)
                    ->setCellValue('F31', $sastandarda)
                    ->setCellValue('F32', $sastandardb)
                    ->setCellValue('F33', $sastandardc)
                    ->setCellValue('F35', $apstandarda)
                    ->setCellValue('F36', $apstandardb)
                    ->setCellValue('F37', $apstandardc);

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");
            echo 'exported';
        } elseif ($component_no == '3') {
            $labref = $this->uri->segment(3);
            $head = $this->input->post('head');

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

            $objReader = PHPExcel_IOFactory::createReader('Excel2007');
            $objPHPExcel = $objReader->load("workbooks/" . $labref . "/" . $labref . ".xlsx");

            $objPHPExcel->setActiveSheetIndex(0);
            $objPHPExcel->getActiveSheet()
                    ->setCellValue('C28', 'Assay Standards - ' . $head)
                    ->setCellValue('E41', 'Sample Assay - ' . $head)
                    ->setCellValue('D9', $head)
                    ->setCellValue('D31', $assayDesired)
                    ->setCellValue('D29', $stdA)
                    ->setCellValue('D30', $stdB)
                    ->setCellValue('D32', $dconcetration)
                    ->setCellValue('F52', $samplDesiredpw)
                    ->setCellValue('F51', $samplDesiredap)
                    ->setCellValue('F44', $sastandarda)
                    ->setCellValue('F43', $sastandardb)
                    ->setCellValue('F45', $sastandardc)
                    ->setCellValue('F47', $apstandarda)
                    ->setCellValue('F48', $apstandardb)
                    ->setCellValue('F49', $apstandardc);

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");
        } elseif ($component_no == '4') {
            $labref = $this->uri->segment(3);
            $head = $this->input->post('head');

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

            $objReader = PHPExcel_IOFactory::createReader('Excel2007');
            $objPHPExcel = $objReader->load("workbooks/" . $labref . "/" . $labref . ".xlsx");

            $objPHPExcel->setActiveSheetIndex(0);
            $objPHPExcel->getActiveSheet()
                    ->setCellValue('C33', 'Assay Standards - ' . $head)
                    ->setCellValue('E53', 'Sample Assay - ' . $head)
                    ->setCellValue('E9', $head)
                    ->setCellValue('D36', $assayDesired)
                    ->setCellValue('D34', $stdA)
                    ->setCellValue('D35', $stdB)
                    ->setCellValue('D37', $dconcetration)
                    ->setCellValue('F63', $samplDesiredpw)
                    ->setCellValue('F64', $samplDesiredap)
                    ->setCellValue('F55', $sastandarda)
                    ->setCellValue('F56', $sastandardb)
                    ->setCellValue('F57', $sastandardc)
                    ->setCellValue('F59', $apstandarda)
                    ->setCellValue('F60', $apstandardb)
                    ->setCellValue('F61', $apstandardc);

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");
        } elseif ($component_no == '5') {
            $labref = $this->uri->segment(3);
            $head = $this->input->post('head');

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

            $objReader = PHPExcel_IOFactory::createReader('Excel2007');
            $objPHPExcel = $objReader->load("workbooks/" . $labref . "/" . $labref . ".xlsx");

            $objPHPExcel->setActiveSheetIndex(0);
            $objPHPExcel->getActiveSheet()
                    ->setCellValue('C38', 'Assay Standards - ' . $head)
                    ->setCellValue('E65', 'Sample Assay - ' . $head)
                    ->setCellValue('F9', $head)
                    ->setCellValue('D41', $assayDesired)
                    ->setCellValue('D39', $stdA)
                    ->setCellValue('D40', $stdB)
                    ->setCellValue('D42', $dconcetration)
                    ->setCellValue('F75', $samplDesiredpw)
                    ->setCellValue('F76', $samplDesiredap)
                    ->setCellValue('F67', $sastandarda)
                    ->setCellValue('F68', $sastandardb)
                    ->setCellValue('F69', $sastandardc)
                    ->setCellValue('F71', $apstandarda)
                    ->setCellValue('F72', $apstandardb)
                    ->setCellValue('F73', $apstandardc);

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $objWriter->save("workbooks/" . $labref . "/" . $labref . ".xlsx");
        }
    }

    public function updateWorksheetNo() {
        $labref = $this->uri->segment(3);
        $data = $this->getLastWorksheet();
        $worksheetIndex = $data[0]->no_of_sheets;
        $newWorksheetIndex = $worksheetIndex + '1';
        $new_no = array(
            'no_of_sheets' => $newWorksheetIndex
        );
        $this->db->where('labref', $labref);
        $this->db->update('workbook_worksheets', $new_no);
    }

    function getDoStatus() {
        $labref = $this->uri->segment(3);
        $test_id = $this->uri->segment(4);
        $analyst_id = $this->session->userdata('user_id');
        $this->db->where('lab_ref_no', $labref);
        $this->db->where('test_id', $test_id);
        $this->db->where('analyst_id', $analyst_id);
        $query = $this->db->get('sample_issuance')->result();
        return $result = $query[0]->do_count;
    }

}

?>
