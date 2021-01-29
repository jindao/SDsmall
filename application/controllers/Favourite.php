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

class Favourite extends CI_Controller {



  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url_helper');
    $this->load->library('session');
    $this->load->model(array('Admin_model',));

  }


  public function ajaxFavouriteList(){

    $logged_user_id = 0;
    if(is_array($this->session->userdata('logged_data'))){
        if(isset($this->session->userdata('logged_data')["userid"])){
            $logged_user_id = $this->session->userdata('logged_data')["userid"];
        }
    }
    
    $this->db->from('user_favourite');
    $this->db->select('product.*, country.name as country_name, league.name as league_name,  sport.name as sport_name, season.name as season_name');
    $this->db->join('product', 'product.id = user_favourite.product_id', 'left');
    $this->db->join('country', 'country.id = product.country_id', 'left');
    $this->db->join('league', 'league.id = product.league_id', 'left');
    $this->db->join('sport', 'sport.id = product.category_id', 'left');
    $this->db->join('season', 'season.link = product.season_link', 'left');
    $this->db->where('user_favourite.user_id',$logged_user_id);

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
              'AddCart'   => '<a href="javascript:manageShoppingCart(\'add\', '. $rows->id .',\'' .base_url().'checkout'.'\');" class="btn btn-addtocart"> Add&nbspto&nbspcart<i class="la la-lg m-0 la-shopping-cart"></i></a>'
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

}

?>