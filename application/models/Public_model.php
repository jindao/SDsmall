<?php

class Public_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getShopItems($array_items)
    {
        $this->db->select('product.*,season.name as season_name');
        $this->db->from('product');
        if (count($array_items) > 1) {
            $i = 1;
            $where = '';
            foreach ($array_items as $id) {
                $i == 1 ? $open = '(' : $open = '';
                $i == count($array_items) ? $or = '' : $or = ' OR ';
                $where .= $open . 'product.id = ' . $id . $or;
                $i++;
            }
            $where .= ')';
            $this->db->where($where);
        } else {
            $this->db->where('product.id =', current($array_items));
        }
        $this->db->join('season', 'season.link = product.season_link', 'inner');
        $query = $this->db->get();
        return $query->result_array();
    }


    public function setOrder($post)
    {
        $q = $this->db->query('SELECT MAX(order_id) as order_id FROM order');
        $rr = $q->row_array();
        if ($rr['order_id'] == 0) {
            $rr['order_id'] = 1233;
        }
        $post['order_id'] = $rr['order_id'] + 1;
        
        //$customer_id = $this->setCustomer($post);

        $products = $this->getShopItems(array_unique($_SESSION['shopping_cart']));
        
        $product_names = "";
        foreach ($products as $product) {
            $product_names = $product_names. ", ". $product["season_name"];
        }
        $product_names = trim($product_names, ",");

        $this->db->trans_begin();
        if (!$this->db->insert('order', array(
                    'order_id' => $post['order_id'],
                    'customer_id' => $post["customer_id"],
                    'user_id'    => $post["user_id"],
                    'products' => $product_names ,
                    'paid_amount' => $post['paid_amount'],
                    'payment_type' => $post['payment_type'],
                    'processed' => 1,
                    'datetime' => time(),
                ))) {
            // database error on insert
        }
        $new_order_id = $this->db->insert_id();

        foreach ($products as $product) {
            //$article['num_added'] = $count_articles[$article['id']];
            //$article['price'] = $article['price'] == '' ? 0 : $article['price'];
            //$article['sum_price'] = $article['price'] * 1 ; // $count_articles[$article['id']];  // with  not product as downloads no need count...
            //$finalSum = $finalSum + $article['sum_price'];
            //$article['sum_price'] = number_format($article['sum_price'], 2);
            //$article['price'] = $article['price'] != '' ? number_format($article['price'], 2) : 0;

            if (!$this->db->insert('order_product', array(
                'order_id' => $new_order_id,
                'user_id' => $post["user_id"],
                'product_id' => $product["id"],
                'price' => $product["price"],
            ))) {
                    // database error on insert
                }
            
        }
        
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return $post['order_id'];

        }
    }
    public function setCustomer($post)
    {
        $this->db->insert('user', array(
            'first_name' => $post['firstname'],
            'last_name' => $post['lastname'],
            'billingaddress' => $post['billingaddress'],
            'city' => $post['city'],
            'country' => $post['country'],
            'email' => $post['email'],
            'zipcode' => $post['zipcode']
        ));
        return $this->db->insert_id();
    }

    //// 
    public function productsCount($big_get)
    {
        $this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
        $this->db->where('products_translations.abbr', MY_LANGUAGE_ABBR);
        if (!empty($big_get) && isset($big_get['category'])) {
            $this->getFilter($big_get);
        }
        $this->db->where('visibility', 1);
        if ($this->showOutOfStock == 0) {
            $this->db->where('quantity >', 0);
        }
        if ($this->showInSliderProducts == 0) {
            $this->db->where('in_slider', 0);
        }
        if ($this->multiVendor == 0) {
            $this->db->where('vendor_id', 0);
        }
        return $this->db->count_all_results('products');
    }

    public function getNewProducts()
    {
        $this->db->select('vendors.url as vendor_url, products.id, products.quantity, products.image, products.url, products_translations.price, products_translations.title, products_translations.old_price');
        $this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
        $this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
        $this->db->where('products_translations.abbr', MY_LANGUAGE_ABBR);
        $this->db->where('products.in_slider', 0);
        $this->db->where('visibility', 1);
        if ($this->showOutOfStock == 0) {
            $this->db->where('quantity >', 0);
        }
        $this->db->order_by('products.id', 'desc');
        $this->db->limit(5);
        $query = $this->db->get('products');
        return $query->result_array();
    }

    public function getLastBlogs()
    {
        $this->db->limit(5);
        $this->db->join('blog_translations', 'blog_translations.for_id = blog_posts.id', 'left');
        $this->db->where('blog_translations.abbr', MY_LANGUAGE_ABBR);
        $query = $this->db->select('blog_posts.id, blog_translations.title, blog_translations.description, blog_posts.url, blog_posts.time, blog_posts.image')->get('blog_posts');
        return $query->result_array();
    }

    public function getPosts($limit, $page, $search = null, $month = null)
    {
        if ($search !== null) {
            $search = $this->db->escape_like_str($search);
            $this->db->where("(blog_translations.title LIKE '%$search%' OR blog_translations.description LIKE '%$search%')");
        }
        if ($month !== null) {
            $from = intval($month['from']);
            $to = intval($month['to']);
            $this->db->where("time BETWEEN $from AND $to");
        }
        $this->db->join('blog_translations', 'blog_translations.for_id = blog_posts.id', 'left');
        $this->db->where('blog_translations.abbr', MY_LANGUAGE_ABBR);
        $query = $this->db->select('blog_posts.id, blog_translations.title, blog_translations.description, blog_posts.url, blog_posts.time, blog_posts.image')->get('blog_posts', $limit, $page);
        return $query->result_array();
    }

    public function getProducts($limit = null, $start = null, $big_get, $vendor_id = false)
    {
        if ($limit !== null && $start !== null) {
            $this->db->limit($limit, $start);
        }
        if (!empty($big_get) && isset($big_get['category'])) {
            $this->getFilter($big_get);
        }
        $this->db->select('vendors.url as vendor_url, products.id,products.image, products.quantity, products_translations.title, products_translations.price, products_translations.old_price, products.url');
        $this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
        $this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
        $this->db->where('products_translations.abbr', MY_LANGUAGE_ABBR);
        $this->db->where('visibility', 1);
        if ($vendor_id !== false) {
            $this->db->where('vendor_id', $vendor_id);
        }
        if ($this->showOutOfStock == 0) {
            $this->db->where('quantity >', 0);
        }
        if ($this->showInSliderProducts == 0) {
            $this->db->where('in_slider', 0);
        }
        if ($this->multiVendor == 0) {
            $this->db->where('vendor_id', 0);
        }
        $this->db->order_by('position', 'asc');
        $query = $this->db->get('products');
        return $query->result_array();
    }

    public function getOneLanguage($myLang)
    {
        $this->db->select('*');
        $this->db->where('abbr', $myLang);
        $result = $this->db->get('languages');
        return $result->row_array();
    }

    private function getFilter($big_get)
    {

        if ($big_get['category'] != '') {
            (int) $big_get['category'];
            $findInIds = array();
            $findInIds[] = $big_get['category'];
            $query = $this->db->query('SELECT id FROM shop_categories WHERE sub_for = ' . $this->db->escape($big_get['category']));
            foreach ($query->result() as $row) {
                $findInIds[] = $row->id;
            }
            $this->db->where_in('products.shop_categorie', $findInIds);
        }
        if ($big_get['in_stock'] != '') {
            if ($big_get['in_stock'] == 1)
                $sign = '>';
            else
                $sign = '=';
            $this->db->where('products.quantity ' . $sign, '0');
        }
        if ($big_get['search_in_title'] != '') {
            $this->db->like('products_translations.title', $big_get['search_in_title']);
        }
        if ($big_get['search_in_body'] != '') {
            $this->db->like('products_translations.description', $big_get['search_in_body']);
        }
        if ($big_get['order_price'] != '') {
            $this->db->order_by('products_translations.price', $big_get['order_price']);
        }
        if ($big_get['order_procurement'] != '') {
            $this->db->order_by('products.procurement', $big_get['order_procurement']);
        }
        if ($big_get['order_new'] != '') {
            $this->db->order_by('products.id', $big_get['order_new']);
        } else {
            $this->db->order_by('products.id', 'DESC');
        }
        if ($big_get['quantity_more'] != '') {
            $this->db->where('products.quantity > ', $big_get['quantity_more']);
        }
        if ($big_get['quantity_more'] != '') {
            $this->db->where('products.quantity > ', $big_get['quantity_more']);
        }
        if ($big_get['brand_id'] != '') {
            $this->db->where('products.brand_id = ', $big_get['brand_id']);
        }
        if ($big_get['added_after'] != '') {
            $time = strtotime($big_get['added_after']);
            $this->db->where('products.time > ', $time);
        }
        if ($big_get['added_before'] != '') {
            $time = strtotime($big_get['added_before']);
            $this->db->where('products.time < ', $time);
        }
        if ($big_get['price_from'] != '') {
            $this->db->where('products_translations.price >= ', $big_get['price_from']);
        }
        if ($big_get['price_to'] != '') {
            $this->db->where('products_translations.price <= ', $big_get['price_to']);
        }
    }

    public function getShopCategories()
    {
        $this->db->select('shop_categories.sub_for, shop_categories.id, shop_categories_translations.name');
        $this->db->where('abbr', MY_LANGUAGE_ABBR);
        $this->db->order_by('position', 'asc');
        $this->db->join('shop_categories', 'shop_categories.id = shop_categories_translations.for_id', 'INNER');
        $query = $this->db->get('shop_categories_translations');
        $arr = array();
        if ($query !== false) {
            foreach ($query->result_array() as $row) {
                $arr[] = $row;
            }
        }
        return $arr;
    }

    public function getSeo($page)
    {
        $this->db->where('page_type', $page);
        $this->db->where('abbr', MY_LANGUAGE_ABBR);
        $query = $this->db->get('seo_pages_translations');
        $arr = array();
        if ($query !== false) {
            foreach ($query->result_array() as $row) {
                $arr['title'] = $row['title'];
                $arr['description'] = $row['description'];
            }
        }
        return $arr;
    }

    public function getOneProduct($id)
    {
        $this->db->where('products.id', $id);

        $this->db->select('vendors.url as vendor_url, products.*, products_translations.title,products_translations.description, products_translations.price, products_translations.old_price, products.url, shop_categories_translations.name as categorie_name');

        $this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
        $this->db->where('products_translations.abbr', MY_LANGUAGE_ABBR);

        $this->db->join('shop_categories_translations', 'shop_categories_translations.for_id = products.shop_categorie', 'inner');
        $this->db->where('shop_categories_translations.abbr', MY_LANGUAGE_ABBR);
        $this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
        $this->db->where('visibility', 1);
        $query = $this->db->get('products');
        return $query->row_array();
    }

    public function getCountQuantities()
    {
        $query = $this->db->query('SELECT SUM(IF(quantity<=0,1,0)) as out_of_stock, SUM(IF(quantity>0,1,0)) as in_stock FROM products WHERE visibility = 1');
        return $query->row_array();
    }

    /*
     * Users for notification by email
     */

    public function getNotifyUsers()
    {
        $result = $this->db->query('SELECT email FROM users WHERE notify = 1');
        $arr = array();
        foreach ($result->result_array() as $email) {
            $arr[] = $email['email'];
        }
        return $arr;
    }

    private function getOneProductForSerialize($id)
    {
        $this->db->select('vendors.name as vendor_name, vendors.id as vendor_id, products.*, products_translations.price');
        $this->db->where('products.id', $id);
        $this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
        $this->db->join('products_translations', 'products_translations.for_id = products.id', 'inner');
        $this->db->where('products_translations.abbr', MY_DEFAULT_LANGUAGE_ABBR);
        $query = $this->db->get('products');
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    public function setVendorOrder($post)
    {
        $i = 0;
        $post['products'] = array();
        foreach ($post['id'] as $product) {
            $post['products'][$product] = $post['quantity'][$i];
            $i++;
        }

        /*
         * Loop products and check if its from vendor - save order for him
         */
        foreach ($post['products'] as $product_id => $product_quantity) {
            $productInfo = $this->getOneProduct($product_id);
            if ($productInfo['vendor_id'] > 0) {

                $q = $this->db->query('SELECT MAX(order_id) as order_id FROM vendors_orders');
                $rr = $q->row_array();
                if ($rr['order_id'] == 0) {
                    $rr['order_id'] = 1233;
                }
                $post['order_id'] = $rr['order_id'] + 1;


                unset($post['id'], $post['quantity']);
                $post['date'] = time();
                $post['products'] = serialize(array($product_id => $product_quantity));
                $this->db->trans_begin();
                if (!$this->db->insert('vendors_orders', array(
                            'order_id' => $post['order_id'],
                            'products' => $post['products'],
                            'date' => $post['date'],
                            'referrer' => $post['referrer'],
                            'clean_referrer' => $post['clean_referrer'],
                            'payment_type' => $post['payment_type'],
                            'paypal_status' => @$post['paypal_status'],
                            'discount_code' => @$post['discountCode'],
                            'vendor_id' => $productInfo['vendor_id']
                        ))) {
                    log_message('error', print_r($this->db->error(), true));
                }
                $lastId = $this->db->insert_id();
                if (!$this->db->insert('vendors_orders_clients', array(
                            'for_id' => $lastId,
                            'first_name' => $post['first_name'],
                            'last_name' => $post['last_name'],
                            'email' => $post['email'],
                            'phone' => $post['phone'],
                            'address' => $post['address'],
                            'city' => $post['city'],
                            'post_code' => $post['post_code'],
                            'notes' => $post['notes']
                        ))) {
                    log_message('error', print_r($this->db->error(), true));
                }
                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    return false;
                } else {
                    $this->db->trans_commit();
                }
            }
        }
    }

    public function setActivationLink($link, $orderId)
    {
        $result = $this->db->insert('confirm_links', array('link' => $link, 'for_order' => $orderId));
        return $result;
    }

    public function getSliderProducts()
    {
        $this->db->select('vendors.url as vendor_url, products.id, products.quantity, products.image, products.url, products_translations.price, products_translations.title, products_translations.basic_description, products_translations.old_price');
        $this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
        $this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
        $this->db->where('products_translations.abbr', MY_LANGUAGE_ABBR);
        $this->db->where('visibility', 1);
        $this->db->where('in_slider', 1);
        if ($this->showOutOfStock == 0) {
            $this->db->where('quantity >', 0);
        }
        $query = $this->db->get('products');
        return $query->result_array();
    }

    public function getbestSellers($categorie = 0, $noId = 0)
    {
        $this->db->select('vendors.url as vendor_url, products.id, products.quantity, products.image, products.url, products_translations.price, products_translations.title, products_translations.old_price');
        $this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
        $this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
        if ($noId > 0) {
            $this->db->where('products.id !=', $noId);
        }
        $this->db->where('products_translations.abbr', MY_LANGUAGE_ABBR);
        if ($categorie != 0) {
            $this->db->where('products.shop_categorie !=', $categorie);
        }
        $this->db->where('visibility', 1);
        if ($this->showOutOfStock == 0) {
            $this->db->where('quantity >', 0);
        }
        $this->db->order_by('products.procurement', 'desc');
        $this->db->limit(5);
        $query = $this->db->get('products');
        return $query->result_array();
    }

    public function sameCagegoryProducts($categorie, $noId, $vendor_id = false)
    {
        $this->db->select('vendors.url as vendor_url, products.id, products.quantity, products.image, products.url, products_translations.price, products_translations.title, products_translations.old_price');
        $this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
        $this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
        $this->db->where('products.id !=', $noId);
        if ($vendor_id !== false) {
            $this->db->where('vendor_id', $vendor_id);
        }
        $this->db->where('products.shop_categorie =', $categorie);
        $this->db->where('products_translations.abbr', MY_LANGUAGE_ABBR);
        $this->db->where('visibility', 1);
        if ($this->showOutOfStock == 0) {
            $this->db->where('quantity >', 0);
        }
        $this->db->order_by('products.id', 'desc');
        $this->db->limit(5);
        $query = $this->db->get('products');
        return $query->result_array();
    }

    public function getOnePost($id)
    {
        $this->db->select('blog_translations.title, blog_translations.description, blog_posts.image, blog_posts.time');
        $this->db->where('blog_posts.id', $id);
        $this->db->join('blog_translations', 'blog_translations.for_id = blog_posts.id', 'left');
        $this->db->where('blog_translations.abbr', MY_LANGUAGE_ABBR);
        $query = $this->db->get('blog_posts');
        return $query->row_array();
    }

    public function getArchives()
    {
        $result = $this->db->query("SELECT DATE_FORMAT(FROM_UNIXTIME(time), '%M %Y') as month, MAX(time) as maxtime, MIN(time) as mintime FROM blog_posts GROUP BY DATE_FORMAT(FROM_UNIXTIME(time), '%M %Y')");
        if ($result->num_rows() > 0) {
            return $result->result_array();
        }
        return false;
    }

    public function getFooterCategories()
    {
        $this->db->select('shop_categories.id, shop_categories_translations.name');
        $this->db->where('abbr', MY_LANGUAGE_ABBR);
        $this->db->where('shop_categories.sub_for =', 0);
        $this->db->join('shop_categories', 'shop_categories.id = shop_categories_translations.for_id', 'INNER');
        $this->db->limit(10);
        $query = $this->db->get('shop_categories_translations');
        $arr = array();
        if ($query !== false) {
            foreach ($query->result_array() as $row) {
                $arr[$row['id']] = $row['name'];
            }
        }
        return $arr;
    }

    public function setSubscribe($array)
    {
        $num = $this->db->where('email', $arr['email'])->count_all_results('subscribed');
        if ($num == 0) {
            $this->db->insert('subscribed', $array);
        }
    }

    public function getDynPagesLangs($dynPages)
    {
        if (!empty($dynPages)) {
            $this->db->join('textual_pages_tanslations', 'textual_pages_tanslations.for_id = active_pages.id', 'left');
            $this->db->where_in('active_pages.name', $dynPages);
            $this->db->where('textual_pages_tanslations.abbr', MY_LANGUAGE_ABBR);
            $result = $this->db->select('textual_pages_tanslations.name as lname, active_pages.name as pname')->get('active_pages');
            $ar = array();
            $i = 0;
            foreach ($result->result_array() as $arr) {
                $ar[$i]['lname'] = $arr['lname'];
                $ar[$i]['pname'] = $arr['pname'];
                $i++;
            }
            return $ar;
        } else
            return $dynPages;
    }

    public function getOnePage($page)
    {
        $this->db->join('textual_pages_tanslations', 'textual_pages_tanslations.for_id = active_pages.id', 'left');
        $this->db->where('textual_pages_tanslations.abbr', MY_LANGUAGE_ABBR);
        $this->db->where('active_pages.name', $page);
        $result = $this->db->select('textual_pages_tanslations.description as content, textual_pages_tanslations.name')->get('active_pages');
        return $result->row_array();
    }

    public function changePaypalOrderStatus($order_id, $status)
    {
        $processed = 0;
        if ($status == 'canceled') {
            $processed = 2;
        }
        $this->db->where('order_id', $order_id);
        if (!$this->db->update('orders', array(
                    'paypal_status' => $status,
                    'processed' => $processed
                ))) {
            log_message('error', print_r($this->db->error(), true));
        }
    }

    public function getCookieLaw()
    {
        $this->db->join('cookie_law_translations', 'cookie_law_translations.for_id = cookie_law.id', 'inner');
        $this->db->where('cookie_law_translations.abbr', MY_LANGUAGE_ABBR);
        $this->db->where('cookie_law.visibility', '1');
        $query = $this->db->select('link, theme, message, button_text, learn_more')->get('cookie_law');
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    public function confirmOrder($md5)
    {
        $this->db->limit(1);
        $this->db->where('link', $md5);
        $result = $this->db->get('confirm_links');
        $row = $result->row_array();
        if (!empty($row)) {
            $orderId = $row['for_order'];
            $this->db->limit(1);
            $this->db->where('order_id', $orderId);
            $result = $this->db->update('orders', array('confirmed' => '1'));
            return $result;
        }
        return false;
    }

    public function getValidDiscountCode($code)
    {
        $time = time();
        $this->db->select('type, amount');
        $this->db->where('code', $code);
        $this->db->where($time . ' BETWEEN valid_from_date AND valid_to_date');
        $query = $this->db->get('discount_codes');
        return $query->row_array();
    }

    public function countPublicUsersWithEmail($email, $id = 0)
    {
        if ($id > 0) {
            $this->db->where('id !=', $id);
        }
        $this->db->where('email', $email);
        return $this->db->count_all_results('users_public');
    }

    public function registerUser($post)
    {
        $this->db->insert('users_public', array(
            'name' => $post['name'],
            'phone' => $post['phone'],
            'email' => $post['email'],
            'password' => md5($post['pass'])
        ));
        return $this->db->insert_id();
    }

    public function updateProfile($post)
    {
        $array = array(
            'name' => $post['name'],
            'phone' => $post['phone'],
            'email' => $post['email']
        );
        if (trim($post['pass']) != '') {
            $array['password'] = md5($post['pass']);
        }
        $this->db->where('id', $post['id']);
        $this->db->update('users_public', $array);
    }

    public function checkPublicUserIsValid($post)
    {
        $this->db->where('email', $post['email']);
        $this->db->where('password', md5($post['pass']));
        $query = $this->db->get('users_public');
        $result = $query->row_array();
        if (empty($result)) {
            return false;
        } else {
            return $result['id'];
        }
    }

    public function getUserProfileInfo($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('users_public');
        return $query->row_array();
    }

    public function sitemap()
    {
        $query = $this->db->select('url')->get('products');
        return $query;
    }

    public function sitemapBlog()
    {
        $query = $this->db->select('url')->get('blog_posts');
        return $query;
    }

    public function getUserOrdersHistoryCount($userId)
    {
        $this->db->where('user_id', $userId);
        return $this->db->count_all_results('orders');
    }

    public function getUserOrdersHistory($userId, $limit, $page)
    {
        $this->db->where('user_id', $userId);
        $this->db->order_by('id', 'DESC');
        $this->db->select('orders.*, orders_clients.first_name,'
                . ' orders_clients.last_name, orders_clients.email, orders_clients.phone, '
                . 'orders_clients.address, orders_clients.city, orders_clients.post_code,'
                . ' orders_clients.notes, discount_codes.type as discount_type, discount_codes.amount as discount_amount');
        $this->db->join('orders_clients', 'orders_clients.for_id = orders.id', 'inner');
        $this->db->join('discount_codes', 'discount_codes.code = orders.discount_code', 'left');
        $result = $this->db->get('orders', $limit, $page);
        return $result->result_array();
    }

}
