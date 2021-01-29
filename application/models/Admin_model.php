<?php

class Admin_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }
    public function getLeagues($sport_id = "")
    {
        $this->db->select('*');
        if($sport_id != "")
        {
            $this->db->where('sport_id' , $sport_id);
        }
        $query = $this->db->get('league');
        return $query->result_array();
    }

    public function getSports($id = "")
    {
        if($id != ""){
            $this->db->where('id',$id);
        }
                
        $query = $this->db->get('sport');
        return $query->result_array();
    }

    public function getCountrys()
    {
        $query = $this->db->select('*')->get('country');
        return $query->result_array();
    }

    public function getSeasons($country_id = "" , $league_id = "")
    {
        $this->db->select('*');
        if($country_id != "")
        {
            $this->db->like('link' , $country_id);
        }
        if($league_id != "")
        {
            $this->db->like('league_id' , $league_id);
        }
        $query = $this->db->get('season');
        return $query->result_array();
    }

    public function getLastUpdate()
    {
        $query = $this->db->select("*")->where('key' , 'last_update')->get("value_store");
        $result = $query->row();
        if(isset($result)) return $result->value;
        return "";
    }

    public function submitLastUpdate($last_update)
    {
        $this->db->where('key', 'last_update');
        if (!$this->db->update('value_store', array(
            "value" => $last_update,
        )))
        {
            return -1;
        }
        return 1;
    }

    public function createProduct($post)
    {
        if (!isset($post['product_name'])) {
            $post['product_name'] = "";
        }

        if (!$this->db->insert('product', array(
                    'category_id' => $post['category_id'],
                    'country_id' => $post['country_id1'],
                    'league_id' => $post['league_id'],
                    'season_link' => $post['season_id'],
                    'season_from' => $post['season_from'],
                    'season_to' => $post['season_to'],
                    'summary_columns' => $post['summary_columns'],
                    'detail_columns' => $post['detail_columns'],
                    'price' => $post['price'],
                    'file_path' => $post['file_path'],
                    'sample_view' => html_entity_decode($post['sample_view'],ENT_QUOTES),
                    'last_update' => $post["last_updated"],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ))) {
            return -1;        
        }
        $id = $this->db->insert_id();
        return $id;
    }

    public function updateProduct($post)
    {
        $this->db->where('id', $post['product_id']);

        if (!$this->db->update('product', array(
                    'category_id' => $post['category_id'],
                    'country_id' => $post['country_id1'],
                    'league_id' => $post['league_id'],
                    'season_link' => $post['season_id'],
                    'season_from' => $post['season_from'],
                    'season_to' => $post['season_to'],
                    'summary_columns' => $post['summary_columns'],
                    'detail_columns' => $post['detail_columns'],
                    'price' => $post['price'],
                    'file_path' => $post['file_path'],
                    'sample_view' => html_entity_decode($post['sample_view'],ENT_QUOTES),
                    'last_update' => $post["last_updated"],
                    'updated_at' => date('Y-m-d H:i:s')
                ))) {
            return -1;        
        }
        return $post['product_id'];
    }
    public function countTotalProducts()
    {
        $query = $this->db->select("COUNT(*) as num")->get("product");
        $result = $query->row();
        if(isset($result)) return $result->num*1;
        return 0;
    }

    public function getViewSample($p_id)
    {
        $query = $this->db->select("*")->where('id' , $p_id)->get("product");
        $result = $query->row();
        if(isset($result)) return $result->sample_view;
        return "";
    }
    public function getFilePath($p_id)
    {
        $query = $this->db->select("*")->where('id' , $p_id)->get("product");
        $result = $query->row();
        if(isset($result)) return $result->file_path;
        return "";
    }

    public function updateSport($post)
    {
        $this->db->where('id', $post["id"]);
        if (!$this->db->update('sport', array(
            "name" => $post["name"],
            "link" => $post["link"],
        )))
        {
            return -1;
        }
        return 1;
    }

    public function createSport($post)
    {
        $lastid = $this->db->query('SELECT MAX(id) as max_id FROM sport')->row()->max_id;
        if (!$this->db->insert('sport', array(
            "id"    => ++$lastid,
            "name" => $post["name"],
            "link" => $post["link"],
        )))
        {
            return -1;
        }
        return 1;
    }

    public function createLeague($post){
        if (!$this->db->insert('league', array(
            "id"    => $post["league_id"],
            "name" => $post["league_name"],
            "link" => $post["league_link"],
            "sport_id" => $post["sport_id"],
            "tournament_id" => $post["tourID"],
        )))
        {
            return -1;
        }
        $id = $this->db->insert_id();
        return $id;
    }

    public function createSeason($post){
        if (!$this->db->insert('season', array(
            "name" => $post["season_name"],
            "link" => $post["season_link"],
            "league_id" => $post["league_id"],
        )))
        {
            return -1;
        }
        $id = $this->db->insert_id();
        return $id;
    }

    public function countTotalUsers(){

        $query = $this->db->select("COUNT(*) as num")->get("user");
        $result = $query->row();
        if(isset($result)) return $result->num*1;
        return 0;
    }

    public function countTotalOrders(){

        $query = $this->db->select("COUNT(*) as num")->get("order");
        $result = $query->row();
        if(isset($result)) return $result->num*1;
        return 0;
    }
    public function isFavouriteProduct($product_id, $logged_user_id)
    {
        
        $query = $this->db->select("COUNT(*) as num")->where('product_id', $product_id)->where('user_id', $logged_user_id)->get("user_favourite");
        $result = $query->row();
        if(isset($result)) return $result->num*1;
        return 0;
    }

    public function updateFavouriteProduct($product_id, $logged_user_id, $checked)
    {
        $result = true;
        if($checked)
        {
            if (!$this->db->insert('user_favourite', array(
                "product_id" => $product_id,
                "user_id" => $logged_user_id,
            )))
            {
                $result = false;
            }
        } else {

            $this->db->where('product_id', $product_id);
            $this->db->where('user_id', $logged_user_id);
            $this->db->delete('user_favourite'); 
        }
        return $result;
    }





    //// temp functions

    public function getProducts($lang)
    {
        $this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
        $this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
        $this->db->where('products_translations.abbr', $lang);
        $query = $this->db->select('vendors.name as vendor_name, vendors.id as vendor_id, products.id as product_id, products.image as product_image, products.time as product_time_created, products.time_update as product_time_updated, products.visibility as product_visibility, products.shop_categorie as product_category, products.quantity as product_quantity_available, products.procurement as product_procurement, products.url as product_url, products.virtual_products, products.brand_id as product_brand_id, products.position as product_position , products_translations.title, products_translations.description, products_translations.price, products_translations.old_price, products_translations.basic_description')->get('products');
        return $query->result_array();
    }

    public function getProduct($id)
    {
        $this->db->where('product.id', $id);
        $this->db->limit(1);
        $query = $this->db->get('product');
        return $query->row_array();
    }

    
    public function setProduct($post)
    {
        if (!isset($post['brand_id'])) {
            $post['brand_id'] = null;
        }
        if (!isset($post['virtual_products'])) {
            $post['virtual_products'] = null;
        }
        $this->db->trans_begin();
        $i = 0;
        foreach ($_POST['translations'] as $translation) {
            if ($translation == MY_DEFAULT_LANGUAGE_ABBR) {
                $myTranslationNum = $i;
            }
            $i++;
        }
        if (!$this->db->insert('products', array(
                    'image' => $post['image'],
                    'shop_categorie' => $post['shop_categorie'],
                    'quantity' => $post['quantity'],
                    'in_slider' => $post['in_slider'],
                    'position' => $post['position'],
                    'virtual_products' => $post['virtual_products'],
                    'folder' => time(),
                    'brand_id' => $post['brand_id'],
                    'time' => time()
                ))) {
            log_message('error', print_r($this->db->error(), true));
        }
        $id = $this->db->insert_id();

        $this->db->where('id', $id);
        if (!$this->db->update('products', array(
                    'url' => except_letters($_POST['title'][$myTranslationNum]) . '_' . $id
                ))) {
            log_message('error', print_r($this->db->error(), true));
        }
        $this->setProductTranslation($post, $id);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    private function setProductTranslation($post, $id)
    {
        $i = 0;
        $current_trans = $this->getTranslations($id);
        foreach ($post['translations'] as $abbr) {
            $arr = array();
            $emergency_insert = false;
            if (!isset($current_trans[$abbr])) {
                $emergency_insert = true;
            }
            $post['title'][$i] = str_replace('"', "'", $post['title'][$i]);
            $post['price'][$i] = str_replace(' ', '', $post['price'][$i]);
            $post['price'][$i] = str_replace(',', '', $post['price'][$i]);
            $arr = array(
                'title' => $post['title'][$i],
                'basic_description' => $post['basic_description'][$i],
                'description' => $post['description'][$i],
                'price' => $post['price'][$i],
                'old_price' => $post['old_price'][$i],
                'abbr' => $abbr,
                'for_id' => $id
            );

            if (!$this->db->insert('products_translations', $arr)) {
                log_message('error', print_r($this->db->error(), true));
            }
            $i++;
        }
    }

    private function getTranslations($id)
    {
        $this->db->where('for_id', $id);
        $query = $this->db->get('products_translations');
        $arr = array();
        foreach ($query->result() as $row) {
            $arr[$row->abbr]['title'] = $row->title;
            $arr[$row->abbr]['basic_description'] = $row->basic_description;
            $arr[$row->abbr]['description'] = $row->description;
            $arr[$row->abbr]['price'] = $row->price;
            $arr[$row->abbr]['old_price'] = $row->old_price;
        }
        return $arr;
    }

    public function deleteProduct($id)
    {
        $this->db->trans_begin();
        $this->db->where('for_id', $id);
        if (!$this->db->delete('products_translations')) {
            log_message('error', print_r($this->db->error(), true));
        }

        $this->db->where('id', $id);
        if (!$this->db->delete('products')) {
            log_message('error', print_r($this->db->error(), true));
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

}
