<?php
?>

<?php

class Order extends CI_Controller{


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
    $this->load->view('admin/order');
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

      $this->db->from('order');
      $this->db->select('order.*, user.first_name, user.last_name');
      $this->db->join('user', 'user.id = order.customer_id', 'left');

      $valid_columns = array(
          0=>'user.first_name',
          1=>'order.products',
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

      $orders = $this->db->get();
      $data = array();
      foreach($orders->result() as $rows)
      {
          $data[]= array(
              'Username' => $rows->first_name,
              'Product' => $rows->products,
              'PaidAmount' => $rows->paid_amount,
              'PaymentType' => $rows->payment_type,
              'Processed' => $rows->proccessed,
              'Confirmed' => $rows->confirmed,
              'Created' => $rows->datetime,
          );     
      }
      $countTotalOrders = $this->Admin_model->countTotalOrders();
      $output = array(
          "draw" => $draw,
          "recordsTotal" => $countTotalOrders,
          "recordsFiltered" => $countTotalOrders,
          "data" => $data
      );
      echo json_encode($output);
      exit();
  }
  
}

?>