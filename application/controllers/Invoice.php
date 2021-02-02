<?php

class Invoice extends CI_Controller {
  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url_helper');
    $this->load->library('session');
    $this->load->model(array('Public_model'));

    $user = $this->session->userdata('logged_data'); // role_id = 1
    if( !isset($user))
      redirect( base_url().'user/login');
  }

  public function ajaxList()
  {
    $this->db->from('order');
    $this->db->select('order.*, user.first_name, user.last_name');
    $this->db->join('user', 'user.id = order.customer_id', 'left');
    $orders = $this->db->get();
    $data = array();
    foreach($orders->result() as $rows)
    {
        $data[]= array(
            'id'      => $rows->id,
            'invoice' => $rows->order_id,
            'amount' => $rows->paid_amount,
            'status' => $rows->proccessed,
            'issued' => $rows->datetime,
            'due' => $rows->datetime,
            'pdf'   => '<a target="_blank" href = "'.base_url().'invoice/generateInvoicePdf/'.$rows->id.'" ><span class="viewsample">View </span></a>&nbsp;&nbsp;&nbsp;<a target="_blank" href = "'.base_url().'invoice/downloadInvoicePdf/'.$rows->id.'" ><span class="viewsample">Download </span></a>',
        );     
    }
    $output = array(
        "data" => $data
    );
    echo json_encode($output);
    exit();
  }

  function generateInvoicePdf($id)
  {

      $this->load->library('pdf');
      $order_data = $this->Public_model->getOrder($id);

      $html = $this->load->view('GeneratePdfView', [ "id" => $id, 'order_data' =>$order_data ], true);
      $this->pdf->createPDF($html, 'Invoice', false);
  }
  function downloadInvoicePdf($id)
  {
    $this->load->library('pdf');
    $order_data = $this->Public_model->getOrder($id);
    $html = $this->load->view('GeneratePdfView', [ "id" => $id, 'order_data' =>$order_data ], true);
    $this->pdf->createPDF($html, 'Invoice');
  }
  function bulkDownloadInvoicePdf()
  {
    if ( isset($_POST) &&  isset($_POST['order_ids'])) {
      $this->load->library('pdf');

      $order_ids = json_decode($_POST['order_ids']);
      foreach($order_ids as $id)
      {
        $order_data = $this->Public_model->getOrder($id);
        $html = $this->load->view('GeneratePdfView', ["id" => $id, 'order_data' =>$order_data], true);
        $this->pdf->createPDF($html, 'Invoice');
      }
     
    }
     
  }  
}

?>