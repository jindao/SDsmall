<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends CI_Controller {
  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url_helper');
    $this->load->library('session');
  }

  public function index()
  {
    $data['title'] = "FREQUENTLY ASKED QUESTIONS";
    $data['description'] = "";
    $data['navigation'] = "";
    $this->load->view('common/header_html');
    $this->load->view('common/header');
    $this->load->view('common/sub_header', $data);
    $this->load->view('faq');
    $this->load->view('common/footer_html');
    $this->load->view('common/footer');
  }
}