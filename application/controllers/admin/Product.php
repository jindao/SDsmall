<?php

class Product extends CI_Controller{


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
    $this->load->view('admin/product/list');
    $this->load->view('admin/common/footer');
    $this->load->view('admin/common/footer_html');
  }

  public function create()
  {
    // POST request
    if (isset($_POST['category_id']) && !empty($_POST['category_id'])) {
      
      if(isset($_POST['season_id']) && !empty($_POST['season_id']))
      {
        if($_POST["season_id"] == '0'){
            if( isset($_POST['league_id']) && !empty($_POST['league_id']) ){

              if( $_POST["league_id"] == "0" ) {
                  // All leagues - All seasons
                  $leagues = $this->Admin_model->getLeagues($_POST['category_id']);
                  foreach($leagues as $league){
                    $_POST["league_id"] = $league["id"];
                    $seasons = $this->Admin_model->getSeasons("", $league["id"]);
                    foreach($seasons as $season){
                      $_POST["season_id"] = $season["link"];
                      $_POST["country_id1"] = $this->getCountryIDFromSeason( $season["link"]);
                      $_POST["season_from"] = $this->getFromSeason( $season["link"]);
                      $_POST["season_to"] = $this->getToSeason( $season["link"]);
                      $this->createProductOne( $_POST );
                    }
                  }
              } else {
                  // Selected league - all seasons
                  $seasons = $this->Admin_model->getSeasons("", $_POST["league_id"]);
                  foreach($seasons as $season){
                    $_POST["season_id"] = $season["link"];
                    $_POST["country_id1"] = $this->getCountryIDFromSeason( $season["link"]);
                    $_POST["season_from"] = $this->getFromSeason( $season["link"]);
                    $_POST["season_to"] = $this->getToSeason( $season["link"]);
                    $this->createProductOne( $_POST );
                  }
              }
            } else {
                // exeption 
            }
        } else {
            // Selected season
            $this->createProductOne( $_POST );
        }

      } else {
        if( isset($_POST['league_id']) && !empty($_POST['league_id']) ){
          if( $_POST["league_id"] == "0" ) {
              // All leagues - All seasons
              $leagues = $this->Admin_model->getLeagues($_POST['category_id']);
              foreach($leagues as $league){
                $_POST["league_id"] = $league["id"];
                $seasons = $this->Admin_model->getSeasons("", $league["id"]);
                foreach($seasons as $season){
                  $_POST["season_id"] = $season["link"];
                  $_POST["country_id1"] = $this->getCountryIDFromSeason( $season["link"]);
                  $_POST["season_from"] = $this->getFromSeason( $season["link"]);
                  $_POST["season_to"] = $this->getToSeason( $season["link"]);
                  $this->createProductOne( $_POST );
                }
              }
          } else {
              // Selected league - all seasons
              $seasons = $this->Admin_model->getSeasons("", $_POST["league_id"]);
              foreach($seasons as $season){
                $_POST["season_id"] = $season["link"];
                $_POST["country_id1"] = $this->getCountryIDFromSeason( $season["link"]);
                $_POST["season_from"] = $this->getFromSeason( $season["link"]);
                $_POST["season_to"] = $this->getToSeason( $season["link"]);
                $this->createProductOne( $_POST );
              }
          }
        } else {
            // exeption 
        }
      }
      redirect("admin/product/index");
    } 

    // Get request
    $leagues = $this->Admin_model->getLeagues();
    $countrys = $this->Admin_model->getCountrys();
    $sports = $this->Admin_model->getSports();
    $seasons = $this->Admin_model->getSeasons();
    $last_update = $this->Admin_model->getLastUpdate();
    $data = array(
      'countrys' => $countrys,
      'sports' => $sports,
      'last_update' => $last_update,
    );
    $this->load->view('admin/common/header_html');
    $this->load->view('admin/common/header');
    $this->load->view('admin/product/create', $data);
    $this->load->view('admin/common/footer');
    $this->load->view('admin/common/footer_html');
  }

  function getCountryIDFromSeason($season_name){
    $pieces = explode("/", $season_name);
    if(is_array($pieces) && count($pieces) > 3 ) {
      $country_name = $pieces[2];
      $query = $this->db->select("*")->where('link' , $country_name)->get("country");
      $result = $query->row();
      if(isset($result)) return $result->id;
    } 
    return "";
  }

  function getFromSeason($season_name){
    $year = false;
    $season_from = "";
    $season_to = "";
    if(preg_match_all("/\d{4}/", $season_name, $match)) {
      $year = $match[0];
      if(count($year) > 1)
      {
        $season_from = $year[0];
        $season_to = $year[1];
      }
      else if( count($year) == 1) {
        $season_from = $year[0];
      }
    }
    return $season_from;
  }

  function getToSeason($season_name){
    $year = false;
    $season_from = "";
    $season_to = "";
    if(preg_match_all("/\d{4}/", $season_name, $match)) {
      $year = $match[0];
      if(count($year) > 1)
      {
        $season_from = $year[0];
        $season_to = $year[1];
      }
      else if( count($year) == 1) {
        $season_from = $year[0];
      }
    }
    return $season_to;
  }

  function createProductOne($post)
  {
    $sport_link = $this->Admin_model->getSports($post['category_id'])[0]["link"];
    $table_name = $sport_link . "_statistics";
    $season_link = $post['season_id'];
    //$this->db->from($table_name);
    $this->db->select($table_name.'.*, match.*');
    $this->db->join($table_name, $table_name.'.match_id = match.id', 'left');
    $this->db->like('match.season_link',$season_link);
    $matchs = $this->db->get('match');

    $field_array = $this->db->query("select * from ".$table_name)->list_fields();
    $data = '<table class="table table-striped- table-bordered table-hover table-checkable dataTable" style = ""> <thead> <tr>';

    $field_array_mand = array_diff($field_array, array('id' , 'match_id'));
    foreach($field_array_mand as $field){
         $data .= '<th>'.$field . "</th>";
    }
    $data .= "</tr> </thead> <tbody>";

    $count = 0;
    $match_result = $matchs->result();
    if(count($match_result) < 1)
    {
      $this->session->set_flashdata('alert_message', 'Failed!. No data exist.');
    }
    else {
      // Csv file creating
      $filename = "assets/products/product".(new DateTime())->format('YmdHisv').".csv";
      $fp = fopen($filename, 'w');
      fputcsv($fp, $field_array_mand);
      foreach($match_result as $rows)
      { 
        $data .= "<tr>";
        $line = array();
        foreach($field_array_mand as $field){
            if($count < 3 )
              $data .= '<td>'.$rows->$field . "</td>";
            $line[] = $rows->$field;
        }

        fputcsv($fp, $line);

        $data .= "</tr>";
        $count+=1;
      }
      $data .= " </tbody></table>";

      $post['sample_view'] = $data;
      $post['file_path'] = $filename;

      $this->Admin_model->createProduct($post);
      $this->session->set_flashdata('alert_message', 'Created a product successfully!');
    }
  }

  public function edit($id = 0)
  {
    // POST request
    if (isset($_POST['category_id']) && !empty($_POST['category_id'])) {

      $sport_link = $this->Admin_model->getSports($_POST['category_id'])[0]["link"];
      $table_name = $sport_link . "_statistics";
      $season_link = $_POST['season_id'];

      //$this->db->from($table_name);
      $this->db->select($table_name.'.*, match.*');
      $this->db->join($table_name, $table_name.'.match_id = match.id', 'left');
      $this->db->like('match.season_link',$season_link);
      $matchs = $this->db->get('match');

      $field_array = $this->db->query("select * from ".$table_name)->list_fields();
      $data = '<table class="table table-striped- table-bordered table-hover table-checkable dataTable" style = ""> <thead> <tr>';

      $field_array_mand = array_diff($field_array, array('id' , 'match_id'));
      foreach($field_array_mand as $field){
           $data .= '<th>'.$field . "</th>";
      }
      $data .= "</tr> </thead> <tbody>";

      $count = 0;
      $match_result = $matchs->result();
      if(count($match_result) < 1)
      {
        $this->session->set_flashdata('alert_message', 'Failed!. No data exist.');
      }
      else {
        // Csv file creating
        $filename = "assets/products/product".(new DateTime())->format('YmdHisv').".csv";
        $fp = fopen($filename, 'w');
        fputcsv($fp, $field_array_mand);
        foreach($match_result as $rows)
        { 
          $data .= "<tr>";
          $line = array();
          foreach($field_array_mand as $field){
              if($count < 3 )
                $data .= '<td>'.$rows->$field . "</td>";
              $line[] = $rows->$field;
          }

          fputcsv($fp, $line);

          $data .= "</tr>";
          $count+=1;
          
        }
        $data .= " </tbody></table>";

        $_POST['sample_view'] = $data;
        $_POST['file_path'] = $filename;

        $this->Admin_model->updateProduct($_POST);
        $this->session->set_flashdata('alert_message', 'Updated a product successfully!');
        redirect("admin/product/index");
      }
    } 

    // Get request
    $countrys = $this->Admin_model->getCountrys();
    $sports = $this->Admin_model->getSports();
    $last_update = $this->Admin_model->getLastUpdate();
    $product = $this->Admin_model->getProduct($id);
    $data = array(
      'countrys' => $countrys,
      'sports' => $sports,
      'last_update' => $last_update,
      'product' => $product
    );
    $this->load->view('admin/common/header_html');
    $this->load->view('admin/common/header');
    $this->load->view('admin/product/edit', $data);
    $this->load->view('admin/common/footer');
    $this->load->view('admin/common/footer_html');
  }

  public function bulkUpdate(){
    $last_update = $this->Admin_model->getLastUpdate();
    $this->db->from("product");
    $this->db->where('season_from',0)->or_where("season_from", date("Y") )->or_where("season_to",date("Y"));
    $products = $this->db->get();
    foreach($products->result() as $product)
    {  
      $sport_link = $this->Admin_model->getSports($product->category_id)[0]["link"];
      $table_name = $sport_link . "_statistics";
      $season_link = $product->season_link;

      $this->db->from('match');
      $this->db->select($table_name.'.*, match.*');
      $this->db->join($table_name, $table_name.'.match_id = match.id', 'left');
      $this->db->like('match.season_link',$season_link);
      $matchs = $this->db->get();

      $field_array = $this->db->query("select * from ".$table_name)->list_fields();
      $data = '<table class="table table-striped- table-bordered table-hover table-checkable dataTable" style = ""> <thead> <tr>';

      $field_array_mand = array_diff($field_array, array('id' , 'match_id'));
      foreach($field_array_mand as $field){
           $data .= '<th>'.$field . "</th>";
      }
      $data .= "</tr> </thead> <tbody>";

      $count = 0;
      $match_result = $matchs->result();
      if(count($match_result) < 1)
      {
        $this->session->set_flashdata('alert_message', 'Failed!. No data exist.');
      }
      else {
        // Csv file creating
        $filename = "assets/products/product".(new DateTime())->format('YmdHisv').".csv";
        $fp = fopen($filename, 'w');
        fputcsv($fp, $field_array_mand);
        foreach($match_result as $rows)
        { 
          $data .= "<tr>";
          $line = array();
          foreach($field_array_mand as $field){
              if($count < 3 )
                $data .= '<td>'.$rows->$field . "</td>";
              $line[] = $rows->$field;
          }

          fputcsv($fp, $line);

          $data .= "</tr>";
          $count+=1;
          
        }
        $data .= " </tbody></table>"; 

        if (!$this->db->update('product',array(
          'file_path' => $filename,
          'sample_view' => html_entity_decode($data,ENT_QUOTES),
          'last_update' => $last_update,
          'updated_at' => date('Y-m-d H:i:s')
        ), 'id = '.$product->id )) {
                return -1;        
          }

        $this->session->set_flashdata('alert_message', 'Updated a product successfully!');
      }
    }

    redirect("admin/product/index");
  }

  public function ajaxLeagueList()
  {
    $sport_id = $this->input->post("sport_id");
    echo json_encode($this->Admin_model->getLeagues($sport_id));
    exit();
  }

  public function ajaxSeasonList()
  {
    $country_id = $this->input->post("country_link");
    $league_id = $this->input->post("league_id");
    echo json_encode($this->Admin_model->getSeasons($country_id, $league_id ));
    exit();
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

      $this->db->from('product');
      $this->db->select('product.*, country.name as country_name, league.name as league_name,  sport.name as sport_name, season.name as season_name');
      $this->db->join('country', 'country.id = product.country_id', 'left');
      $this->db->join('league', 'league.id = product.league_id', 'left');
      $this->db->join('sport', 'sport.id = product.category_id', 'left');
      $this->db->join('season', 'season.link = product.season_link', 'left');

      $valid_columns = array(
          0=>'sport.name',
          1=>'country.name',
          2=>'season.name',
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
              'Actions' => '<a href= "#" onclick="viewSampleData('.$rows->id.');" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Sample Data"><i class="la la-print"></i></a><a href= "'.base_url().'admin/product/download/'.$rows->id.'" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Download"><i class="fa flaticon2-download-2"></i></a> <a href="'.base_url().'admin/product/edit/'.$rows->id.'" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View"><i class="la la-edit"></i></a>'
          );     
      }
      $countTotalProducts = $this->Admin_model->countTotalProducts();
      $output = array(
          "draw" => $draw,
          "recordsTotal" => $countTotalProducts,
          "recordsFiltered" => $countTotalProducts,
          "data" => $data
      );
      echo json_encode($output);
      exit();
  }
  public function ajaxViewSample()
  {
    $product_id = intval($this->input->post("product_id"));
    echo json_encode($this->Admin_model->getViewSample($product_id));
    exit();
  }
  public function download($id){
    $this->load->helper('download');
    $fileinfo = $this->Admin_model->getFilePath($id);
    force_download($fileinfo, NULL);
  }
}

?>