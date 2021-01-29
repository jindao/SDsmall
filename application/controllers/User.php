<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{
  private $registerErrors = array();
  private $user_id;
  private $num_rows = 5;

  public function __construct()
  {
    parent::__construct();
    $this->load->library('email');
    $this->load->model(array('Auth_model',));  

  }

  public function _remap($method, $params = array())
  {
    $method = $method;

    if (method_exists($this, $method))
    {
      return call_user_func_array(array($this, $method), $params);
    }
  }

  public function login()
  {
    if (isset($_POST) && isset($_POST['username'])) {
      
      $checkUser = $this->Auth_model->checkUserExsists($_POST);
      
      if ( is_array($checkUser) ) {
        $remember_me = false;
        if (isset($_POST['rememberme'])) {
            $remember_me = true;
        }
        $this->setLoginSession($checkUser, $remember_me);
        redirect(base_url());
        return ;
      } else {
        $this->session->set_flashdata('userError', 'Username or password is incorrect!');
      }
    }
//    $head['title'] = lang('user_login');
//    $head['description'] = lang('user_login');
//    $head['keywords'] = str_replace(" ", ",", $head['title']);
    $this->load->view('common/header_html');
    $this->load->view('common/header');
    $this->load->view('login');
    $this->load->view('common/footer');
    $this->load->view('common/footer_html');

  }

  public function setLoginSession($user, $remember_me)
    {
        if ($remember_me == true) {
            set_cookie('logged_user', $user["username"], 2678400);
        }
        $_SESSION['logged_user'] = $user["username"];
        $this->session->set_userdata('logged_data', $user);
    }

  public function signup()
  {
    if ( isset($_POST) &&  isset($_POST['username'])) {
      $result = $this->registerUser();
      if (!$result) {
        $this->session->set_flashdata('userError', $this->registerErrors);
      } else {
        $this->setLoginSession($_POST['username'], false);
        return ;
      }
    }
    $this->load->view('common/header_html');
    $this->load->view('common/header');
    $this->load->view('signup');
    $this->load->view('common/footer');
    $this->load->view('common/footer_html');
  }
  private function registerUser()
  {
      $errors = array();
      if (mb_strlen(trim($_POST['password'])) == 0) {
          $errors[] = 'Please enter password';
      }
      if (mb_strlen(trim($_POST['re_password'])) == 0) {
          $errors[] = 'Please repeat password';
      }
      if ($_POST['password'] != $_POST['re_password']) {
          $errors[] = 'Passwords dont match';
      }
      if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
          $errors[] = 'Invalid email';
      }
      $count_emails = $this->Auth_model->countUsersWithEmail($_POST['email']);
      if ($count_emails > 0) {
          $errors[] = 'Email is taken';
      }
      if (!empty($errors)) {
          $this->registerErrors = $errors;
          return false;
      }
      $this->Auth_model->registerUser($_POST);
      return true;
  }
  public function forget() {

    if (isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $user = $this->Auth_model->getUserInfoFromEmail($_POST['email']);
        if ($user != null) {
            $myDomain = $this->config->item('base_url');
            $newPass = $this->Auth_model->updateUserPassword($_POST['email']);
            $this->sendmail->sendTo($_POST['email'], 'Admin', 'New password for ' . $myDomain, 'Hello, your new password is ' . $newPass);
            $this->session->set_flashdata('userError', 'New password sent.');
            redirect( base_url().'user/login');
        }
    }

    $this->load->view('common/header_html');
    $this->load->view('common/header');
    $this->load->view('forget');
    $this->load->view('common/footer');
    $this->load->view('common/footer_html');
  }

  // public function myaccount($page = 0)
  // {
  //   if (isset($_POST['update'])) {
  //     $_POST['id'] = $_SESSION['logged_user'];
  //     $count_emails = $this->Public_model->countPublicUsersWithEmail($_POST['email'], $_POST['id']);
  //     if ($count_emails == 0) {
  //       $this->Public_model->updateProfile($_POST);
  //     }
  //     redirect(LANG_URL . '/myaccount');
  //   }
  //   $head = array();
  //   $data = array();
  //   $head['title'] = lang('my_acc');
  //   $head['description'] = lang('my_acc');
  //   $head['keywords'] = str_replace(" ", ",", $head['title']);
  //   $data['userInfo'] = $this->Public_model->getUserProfileInfo($_SESSION['logged_user']);
  //   $rowscount = $this->Public_model->getUserOrdersHistoryCount($_SESSION['logged_user']);
  //   $data['orders_history'] = $this->Public_model->getUserOrdersHistory($_SESSION['logged_user'], $this->num_rows, $page);
  //   $data['links_pagination'] = pagination('myaccount', $rowscount, $this->num_rows, 2);
  //   $this->render('user', $head, $data);
  // }

  public function logout()
  {
//    session_unset();
//    var_dump($_SESSION);
    unset($_SESSION['logged_user']);
    redirect(base_url());
  }
  public function updatepass(){
    if (isset($_POST)) {
      $_POST['username'] = $_SESSION["logged_user"];
      $checkUser = $this->Auth_model->checkUserExsists($_POST);
      if( is_array($checkUser) ) {
        $this->Auth_model->updateUserNewPassword( $checkUser['email'] , $_POST["newpassword"]);
        $this->session->set_flashdata('userError', 'Successfully password updated.');

      } else {
        $this->session->set_flashdata('userError', 'Failed to change password.');

      }
      redirect(base_url()."myaccount/accountaccess");
    }
  }

  public function submitaccountinfo(){

    if (isset($_POST)) {
      $loggin_user_id = 0;
      if( is_array($this->session->userdata("logged_data")) ){
        $loggin_user_id = $this->session->userdata("logged_data")["userid"];
      }
      if( $this->Auth_model->updateUserAccountInfo($loggin_user_id,$_POST) ) {
        $this->session->set_flashdata('userError', 'Successfully updated.');
      } else {
        $this->session->set_flashdata('userError', 'Failed to update.');
      }
      redirect(base_url()."myaccount/accountinfo");
    }
  }

}
