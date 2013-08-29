<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
require_once("dompdf/dompdf_config.inc.php");
 
class Dompdf_lib extends Dompdf{
     
        function createPDF($html, $filename='',$stream=TRUE){  
            $this->load_html($html);
            $this->render();
            $this->set_paper('a4', 'potratit');
            if ($stream) {
                $this->stream($filename.".pdf");
                file_put_contents('workbooks/'.$filename.'/'.$filename.".pdf",  $this->output()); 
                 
           } else {
              return $this->output();
           }
        }
 
}
?>