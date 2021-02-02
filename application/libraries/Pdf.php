<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

use Dompdf\Dompdf;
class Pdf 
{ 
  function __construct() { 
    // include autoloader
    require_once dirname(__FILE__).'/dompdf/autoload.inc.php';
    // instantiate and use the dompdf class
    $pdf = new DOMPDF();
    $CI =& get_instance();
    $CI->dompdf = $pdf;
  }

  function createPDF($html, $filename='', $download=TRUE, $paper='A4', $orientation='portrait'){
      require_once dirname(__FILE__).'/dompdf/autoload.inc.php';
      
      $dompdf = new \Dompdf\DOMPDF();
      $dompdf->load_html($html);
      $dompdf->set_paper($paper, $orientation);
    //  $dompdf->set_option('isRemoteEnabled', true);
      $dompdf->render();
      if($download)
          $dompdf->stream($filename.'.pdf', array('Attachment' => 1));
      else
          $dompdf->stream($filename.'.pdf', array('Attachment' => 0));
  }
}