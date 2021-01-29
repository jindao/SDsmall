<?php
?>

<?php

class Sport extends CI_Controller{


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
    $this->load->view('admin/common/header_html');
    $this->load->view('admin/common/header');
    $this->load->view('admin/sport');
    $this->load->view('admin/common/footer');
    $this->load->view('admin/common/footer_html');
  }

  public function ajaxList(){
    $sports = $this->db->get('sport');
    $data = array();
    $count = 0;
    foreach($sports->result() as $rows)
    {
      $count += 1;
      $data[]= array(
          'ID'  => $count,
          'Sport' => $rows->name,
          'Link' => $rows->link,
          'Actions' => json_encode($rows)
      );     
    }
    $output = array(
      "data" => $data
    );
    echo json_encode($output);
    exit();
  }

  public function ajaxUpdateSport(){
    $result = $this->Admin_model->updateSport($_POST);
    echo json_encode($result);
    exit();
  }

  public function ajaxCreateSport(){
    $result = $this->Admin_model->createSport($_POST);
    echo json_encode($result);
    exit();
  }

}

?>