<?php
?>
<?php

class Season extends CI_Controller{


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
    $leagues = $this->Admin_model->getLeagues();
    $data = array(
      'leagues' => $leagues,
    );
    $this->load->view('admin/common/header_html');
    $this->load->view('admin/common/header');
    $this->load->view('admin/season',$data);
    $this->load->view('admin/common/footer');
    $this->load->view('admin/common/footer_html');

  }

  public function create(){
    if (isset($_POST['season_link']) && !empty($_POST['season_link'])) {

      $this->Admin_model->createSeason($_POST);
      $this->session->set_flashdata('alert_message', 'Created a season successfully!');
      redirect("admin/season/index");

    }
  }

  public function ajaxList(){
    $this->db->select('season.*, league.name as league_name');
    $this->db->join('league', 'league.id = season.league_id', 'left');
    $seasons = $this->db->get('season');
    $data = array();
    foreach($seasons->result() as $rows)
    {
        $data[]= array(
            "season_name"=> $rows->name,
            "season_link" => $rows->link,
            "league_name"=> $rows->league_name,
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