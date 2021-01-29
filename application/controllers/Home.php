
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {



  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url_helper');
    $this->load->library(array('session','ShoppingCart'));
    $this->load->model(array('Admin_model',));
  }

  public function index()
	{
    $leagues = $this->Admin_model->getLeagues();
    $countrys = $this->Admin_model->getCountrys();
    $sports = $this->Admin_model->getSports();
    $data = array(
      'countrys' => $countrys,
      'sports' => $sports,
      'leagues' => $leagues,
    );
    $this->load->view('common/header_html');
    $this->load->view('common/header');
    $this->load->view('home', $data);
    $this->load->view('common/footer');
    $this->load->view('common/footer_html');
  }
  
  public function ajaxProductList(){
      
    $page = 1;
    $perpage = 10;
    $length = 10;
    $start = 1;
    if (isset($_POST['pagination']))
    {
      $page = $_POST['pagination']['page'];
      $perpage =  $_POST['pagination']['perpage'];
      $length  = $perpage;
      $start = ($page - 1) * $perpage;
    }

    $field = "Sport";
    $sort = "asc";
    if (isset($_POST['sort']))
    {
      $field = $_POST['sort']["field"];
      $sort = $_POST['sort']['sort'];
    }

    $valid_columns = array(
        "Sport"=>'sport.name',
        "Country"=>'country.name',
        "Competition"=>'season.name',
        "Season"=>'season.name',
        "Price"=>'season.name',
    );

    $this->db->from('product');
    $this->db->select('product.*, country.name as country_name, league.name as league_name,  sport.name as sport_name, season.name as season_name');
    $this->db->join('country', 'country.id = product.country_id', 'left');
    $this->db->join('league', 'league.id = product.league_id', 'left');
    $this->db->join('sport', 'sport.id = product.category_id', 'left');
    $this->db->join('season', 'season.link = product.season_link', 'left');

    if(!isset($valid_columns[$field]))
    {
        $order = null;
    }
    else
    {
        $order = $valid_columns[$field];
    }
    if($order !=null)
    {
        $this->db->order_by($order, $sort);
    }
    
    if(isset($_POST['query']) && is_array($_POST['query']))
    {
      
      foreach($_POST['query'] as $key => $query)
      {
        if($key == "generalSearch")
        {
          $x=0;
          if($_POST["query"][$key] != "")
          {
            $this->db->group_start();
            foreach($valid_columns as $sterm)
            {
              
              if($x==0)
              {
                  $this->db->like($sterm,$query);
              }
              else
              {
                  $this->db->or_like($sterm,$query);
              }
              $x++;
            }
            $this->db->group_end();
          }
          
        } else {
          $this->db->like($key,$query);
        }

      }                 
    }
    $countTotalProducts = $this->db->count_all_results('', false);
    $this->db->limit($length,$start);

    $products = $this->db->get();
    $logged_user_id = 0;
    if(is_array($this->session->userdata('logged_data'))){
        if(isset($this->session->userdata('logged_data')["userid"])){
            $logged_user_id = $this->session->userdata('logged_data')["userid"];
        }
    }
    
    $data = array();
    foreach($products->result() as $rows)
      {
          $isFavourite = $this->Admin_model->isFavouriteProduct($rows->id, $logged_user_id);
          $data[]= array(
              "id"   => $rows->id, 
              'Sport' => $rows->sport_name,
              'Country' => $rows->country_name,
              'Competition' => $rows->league_name,
              'Season' => $rows->season_name,
              'MatchSummary' => $rows->summary_columns,
              'DetailedStats' => $rows->detail_columns,
              'Price' => $rows->price,
              'LastUpdate' => $rows->last_update,
              'Favourite' => $isFavourite > 0,
              'ViewSample' => '<a href= "#" onclick="viewSampleData('.$rows->id.');" ><span class="viewsample">View Sample</span></a>',
              'AddCart'   => '<a href="javascript:manageShoppingCart(\'add\', '. $rows->id .',\'' .base_url().'checkout'.'\');" class="btn btn-addtocart"> Add&nbspto&nbspcart<i class="la la-lg m-0 la-shopping-cart"></i></a>'
          );     
      }
      //$countTotalProducts = $this->Admin_model->countTotalProducts();
      $output = array(
          "meta" => array(
              "page"=> $page,
              "pages"=> $countTotalProducts / $perpage,
              "perpage"=> $perpage,
              "total"=> $countTotalProducts,
              "sort"=> "asc",
            ),
          "data" => $data
      );
      echo json_encode($output);
      exit();
  }


  public function manageShoppingCart()
  {
      if (!$this->input->is_ajax_request()) {
          exit('No direct script access allowed');
      }
      $this->shoppingcart->manageShoppingCart();
  }
  public function clearShoppingCart()
  {
      $this->shoppingcart->clearShoppingCart();
  }
  public function changeFavourite()
  {
    if (isset($_POST['product_id']) && isset($_POST['checked']) && is_array($this->session->userdata('logged_data')) && isset($this->session->userdata('logged_data')['userid'])  )
    {
      $logged_user_id = $this->session->userdata('logged_data')['userid'];
      $result = false;
      if($_POST['checked'] == "1"){
        $result = $this->Admin_model->updateFavouriteProduct($_POST['product_id'], $logged_user_id, true);
      } else {
        $result = $this->Admin_model->updateFavouriteProduct($_POST['product_id'], $logged_user_id, false);
      }
      if($result)
        echo "1";
      else
        echo "0";  
    } else {
      echo "0";
    }
    exit; 
  }
}