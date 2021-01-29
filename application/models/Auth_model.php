<?php

class Auth_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function registerUser($post)
    {
        $input = array(
            'email' => trim($post['email']),
            'password' => password_hash($post['password'], PASSWORD_DEFAULT),
            'name'  => $post["username"],
            'role_id' => 3,
        );
        if (!$this->db->insert('user', $input)) {
            //log_message('error', print_r($this->db->error(), true));
            //show_error(lang('database_error'));
        }
    }

    public function countUsersWithEmail($email)
    {
        $this->db->where('email', $email);
        return $this->db->count_all_results('user');
    }

    public function checkUserExsists($post)
    {
        $this->db->where('email', $post['username'])->or_where('name', $post['username']);
        $query = $this->db->get('user');
        $row = $query->row_array();
        if (empty($row) || !password_verify($post['password'], $row['password'])) {
            return "";
        }

        return array( 'username' => $row['name'], 'email' => $row['email'] , 'userid' => $row["id"], 'role_id' => $row["role_id"]);
    }

    public function updateUserPassword($email)
    {
        $newPass = str_shuffle(bin2hex(openssl_random_pseudo_bytes(4)));
        $this->db->where('email', $email);
        if (!$this->db->update('user', ['password' => password_hash($newPass, PASSWORD_DEFAULT)])) {
            // log_message('error', print_r($this->db->error(), true));
            // show_error(lang('database_error'));
        }
        return $newPass;
    }

    public function updateUserNewPassword($email, $newPass)
    {
        $this->db->where('email', $email);
        if (!$this->db->update('user', ['password' => password_hash($newPass, PASSWORD_DEFAULT)])) {
            // log_message('error', print_r($this->db->error(), true));
            // show_error(lang('database_error'));
            return false;
        }
        return true;
    }

    public function updateUserAccountInfo($user_id, $post)
    {
        $this->db->where('id', $user_id);
        if (!$this->db->update('user', [
            'first_name' => $post["firstname"],
            'last_name' => $post["lastname"],
            'company_name' => $post["companyname"],
            'country_id' => $post["country"],
            'town_city' => $post["towncity"],
            'address' => $post["address"],
            'zip_code' => $post["zipcode"],
            'VAT_number' => $post["vatnumber"],
            ])) {
            // log_message('error', print_r($this->db->error(), true));
            // show_error(lang('database_error'));
            return false;
        }
        return true;
    }

    public function getUserInfoFromEmail($email)
    {
        $this->db->where('email', $email);
        $result = $this->db->get('user');
        return $result->row_array();
    }

    public function getUserInfoFromID($userid)
    {
        $this->db->where('id', $userid);
        $result = $this->db->get('user');
        return $result->row_array();
    }

}
