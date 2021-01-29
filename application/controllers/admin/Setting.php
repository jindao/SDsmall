<?php
?>

<?php

class Setting extends CI_Controller{


  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url_helper');
    $this->load->model(array('Admin_model',));
    $user = $this->session->userdata('logged_data'); // role_id = 1
    if( !isset($user) || $user["role_id"] != '1')
      redirect( base_url().'user/login');
  }

  public function index()
  {
    // POST request
    if (isset($_POST['last_update']) && !empty($_POST['last_update'])) {
      if($this->Admin_model->submitLastUpdate($_POST['last_update']))
        $this->session->set_flashdata('alert_message', 'Updated successfully!');
    }

    // GET request
    $last_update = $this->Admin_model->getLastUpdate();
    $data = array(
      'last_update' => $last_update,
    );

    $this->load->view('admin/common/header_html');
    $this->load->view('admin/common/header');
    $this->load->view('admin/setting', $data);
    $this->load->view('admin/common/footer');
    $this->load->view('admin/common/footer_html');

  }
}

?>