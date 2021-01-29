<?php
/**
 * Created by PhpStorm.
 * User: DREAM
 * Date: 12/15/2020
 * Time: 10:16 AM
 */
?>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {



  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url_helper');
  }

  public function index()
	{
      $this->load->view('admin/common/header_html');
      $this->load->view('admin/common/header');
      $this->load->view('admin/home');
      $this->load->view('admin/common/footer');
      $this->load->view('admin/common/footer_html');

	}
}
?>
