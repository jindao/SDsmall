<?php
?>

<?php

class User extends CI_Controller{


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
    $this->load->view('admin/user');
    $this->load->view('admin/common/footer');
    $this->load->view('admin/common/footer_html');
  }

  public function ajaxList()
  {
      $draw = intval($this->input->post("draw"));
      $start = intval($this->input->post("start"));
      $length = intval($this->input->post("length"));
      $order = $this->input->post("order");
      $search= $this->input->post("search");  
      $search = $search['value'];
      $col = 0;
      $dir = "";
      if(!empty($order))
      {
          foreach($order as $o)
          {
              $col = $o['column'];
              $dir= $o['dir'];
          }
      }

      if($dir != "asc" && $dir != "desc")
      {
          $dir = "desc";
      }

      $this->db->from('user');
      //$this->db->select('user.*, country.name as country_name');
      //$this->db->join('country', 'country.id = user.country_id', 'left');

      $valid_columns = array(
          0=>'name',
          1=>'email',
      );
      if(!isset($valid_columns[$col]))
      {
          $order = null;
      }
      else
      {
          $order = $valid_columns[$col];
      }
      if($order !=null)
      {
          $this->db->order_by($order, $dir);
      }
      
      if(!empty($search))
      {
          $x=0;
          foreach($valid_columns as $sterm)
          {
              if($x==0)
              {
                  $this->db->like($sterm,$search);
              }
              else
              {
                  $this->db->or_like($sterm,$search);
              }
              $x++;
          }                 
      }
      $this->db->limit($length,$start);

      $users = $this->db->get();
      $data = array();
      foreach($users->result() as $rows)
      {
          $data[]= array(
              'Username' => $rows->name,
              'Email' => $rows->email,
          );     
      }
      $countTotalUsers = $this->Admin_model->countTotalUsers();
      $output = array(
          "draw" => $draw,
          "recordsTotal" => $countTotalUsers,
          "recordsFiltered" => $countTotalUsers,
          "data" => $data
      );
      echo json_encode($output);
      exit();
  }
  
}

?>