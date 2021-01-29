<?php
/**
 * Created by PhpStorm.
 * User: DREAM
 * Date: 12/17/2020
 * Time: 7:36 PM
 */
?>
<?php

class League extends CI_Controller{


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
    $sports = $this->Admin_model->getSports();
    $data = array(
      'sports' => $sports,
    );
    $this->load->view('admin/common/header_html');
    $this->load->view('admin/common/header');
    $this->load->view('admin/league',$data);
    $this->load->view('admin/common/footer');
    $this->load->view('admin/common/footer_html');

  }

  public function create(){
    if (isset($_POST['league_id']) && !empty($_POST['league_id'])) {

      $this->Admin_model->createLeague($_POST);
      $this->session->set_flashdata('alert_message', 'Created a league successfully!');
      redirect("admin/league/index");

    }
  }

  public function ajaxList(){
    $this->db->select('league.*, sport.name as sport_name');
    $this->db->join('sport', 'sport.id = league.sport_id', 'left');
    $leagues = $this->db->get('league');
    $data = array();
    foreach($leagues->result() as $rows)
    {

        $data[]= array(
            "id" => $rows->id,
            "sport_id"=> $rows->sport_id,
            "sport_name" => $rows->sport_name,
            "tournament_id"=> $rows->tournament_id,
            "name"=> $rows->name,
            "link"=>$rows->link 
        );     
    }
    $output = array(
        "data" => $data
    );
    echo json_encode($output);
    exit();

  }

}

?>