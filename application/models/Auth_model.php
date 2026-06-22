<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

    public function login($username) {
        // Mengambil data user berdasarkan username
        $this->db->where('username', $username);
        return $this->db->get('users')->row_array();
    }

    public function get_sales_id($id_user) {
        // Mengambil id_sales jika user yang login adalah sales
        $this->db->where('id_user', $id_user);
        return $this->db->get('sales')->row_array();
    }

    public function register_user($user_data, $sales_data = null) {
        $this->db->trans_start();
    
        // 1. Simpan ke tabel users
        $this->db->insert('users', $user_data);
        $id_user = $this->db->insert_id();
    
        // 2. Jika role-nya sales, simpan juga ke tabel sales
        if ($user_data['role'] == 'sales' && $sales_data != null) {
            $sales_data['id_user'] = $id_user;
            $this->db->insert('sales', $sales_data);
        }
    
        $this->db->trans_complete();
        return $this->db->trans_status();
    }
    
    // Fungsi pembantu untuk generate ID Sales otomatis (misal: SL001, SL002)
    public function generate_id_sales() {
        $this->db->select('id_sales_person');
        $this->db->order_by('id_sales_person', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('sales')->row_array();
    
        if ($query) {
            $no_terakhir = substr($query['id_sales_person'], 2);
            $next_no = sprintf('%03d', intval($no_terakhir) + 1);
        } else {
            $next_no = '001';
        }
    
        return 'SL' . $next_no;
    }
}