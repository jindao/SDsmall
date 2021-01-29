
<?php
class MyAccount extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url_helper');
    $this->load->library('session');
    $this->load->model(array('Admin_model','Auth_model'));

    
  }

  public function _remap($page)
  {

    $user = $this->session->userdata('logged_data');
    if( ! isset($user) )
      redirect( base_url().'user/login');
    
    $title = array(
      'accountinfo' => 'Account Information',
      'accountaccess' => 'MY ACCOUNT',
      'billinfo' => 'Billing Information',
      'deleteaccount' => 'Delete account',
      'favourite' => 'MY ACCOUNT',
      'download' => 'MY ACCOUNT',
      'invoice' => 'invoices'
    );
    $desc = array(
      'accountinfo' => 'Last Activity: 09/12/2020 - 2:30 pm',
      'accountaccess' => 'Last Activity: 09/12/2020 - 2:30 pm',
      'billinfo' => 'Last Activity: 09/12/2020 - 2:30 pm',
      'deleteaccount' => 'Last Activity: 09/12/2020 - 2:30 pm',
      'favourite' => 'Last Activity: 09/12/2020 - 2:30 pm',
      'download' => 'Last Activity: 09/12/2020 - 2:30 pm',
      'invoice' => 'Last Activity: 09/12/2020 - 2:30 pm'
    );
    $navigation = array(
      'accountinfo' => 'My account&nbsp/&nbspAccount information',
      'accountaccess' => 'My account&nbsp/&nbspAccount access',
      'billinfo' => 'My account&nbsp/&nbspBill information',
      'deleteaccount' => 'My account&nbsp/&nbspDelete account',
      'favourite' => 'My account&nbsp/&nbspFavorite',
      'download' => 'My account&nbsp/&nbspDownloads',
      'invoice' => 'My account&nbsp/&nbspInvoice'
    );
    $data['title'] = $title[$page];
    $data['description'] = $desc[$page];
    $data['navigation'] = $navigation[$page];

    $this->load->view('common/header_html');
    $this->load->view('common/header');
    $this->load->view('common/sub_header', $data);
    if($page == "accountinfo"){

      $countrys = $this->Admin_model->getCountrys();


      $content_data = array( 'countrys' => $countrys, 'user' => $this->Auth_model->getUserInfoFromID($user["userid"]));

      $this->load->view($page,  $content_data);

    } else {
      $this->load->view($page);
    }
    $this->load->view('common/footer');
    $this->load->view('common/footer_html');
  }

  
}
?>