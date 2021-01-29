<?php
/**
 * Created by PhpStorm.
 * User: DREAM
 * Date: 12/14/2020
 * Time: 7:55 PM
 */
?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Download extends CI_Controller {



  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url_helper');
    $this->load->library('session');
    $this->load->model(array('Admin_model',));

  }

  public function index()
  {
    $this->load->view('common/header_html');
    $this->load->view('common/header');
    $this->load->view('mydownload');
    $this->load->view('common/footer_html');
    $this->load->view('common/footer');
  }

  public function ajaxDownloadList(){

    $logged_user_id = 0;
    if(is_array($this->session->userdata('logged_data'))){
        if(isset($this->session->userdata('logged_data')["userid"])){
            $logged_user_id = $this->session->userdata('logged_data')["userid"];
        }
    }
    
    $this->db->from('order_product');
    $this->db->select('product.*, country.name as country_name, league.name as league_name,  sport.name as sport_name, season.name as season_name');
    $this->db->join('product', 'product.id = order_product.product_id', 'left');
    $this->db->join('country', 'country.id = product.country_id', 'left');
    $this->db->join('league', 'league.id = product.league_id', 'left');
    $this->db->join('sport', 'sport.id = product.category_id', 'left');
    $this->db->join('season', 'season.link = product.season_link', 'left');
    $this->db->where('order_product.user_id',$logged_user_id);

    $products = $this->db->get();
      $data = array();
      foreach($products->result() as $rows)
      {

          $data[]= array(
              'Sport' => $rows->sport_name,
              'Country' => $rows->country_name,
              'Competition' => $rows->league_name,
              'Season' => $rows->season_name,
              'MatchSummary' => $rows->summary_columns,
              'DetailedStats' => $rows->detail_columns,
              'Price' => $rows->price,
              'LastUpdate' => $rows->last_update,
              'ViewSample' => '<a href= "#" onclick="viewSampleData('.$rows->id.');" ><span class="viewsample">View Sample</span></a>',
              'Download'   => '<a href= "'.base_url().'download/download/'.$rows->id.'" class="btn btn-md btn-addtocart"> Download&nbsp<i class="flaticon2-download-2"></i></a>'
               // <a href = "#" class="btn btn-md btn-addtocart"> Download&nbsp<i class="flaticon2-download-2"></i></a>     
            );     
      }

    
      $output = array(
       // "draw" => $draw,
       // "recordsTotal" => $countTotalProducts,
       // "recordsFiltered" => $countTotalProducts,
        "data" => $data
    );
    echo json_encode($output);
    exit();

  }

  public function download($id){
    $this->load->helper('download');
    $fileinfo = $this->Admin_model->getFilePath($id);
    force_download($fileinfo, NULL);
  }
}

?>