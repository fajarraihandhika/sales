<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('role') !== 'admin') { redirect('auth'); }
        $this->load->model('order_model');
    }

    public function index() {
        $data['sales'] = $this->order_model->get_all_sales_list();
        
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/sales', $data);
        $this->load->view('templates/footer');
    }

    public function hapus($id) {
        if ($this->order_model->is_sales_used($id)) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fw-bold">Sales ini masih memiliki riwayat transaksi order, tidak bisa dihapus!</div>');
            redirect('admin/sales');
            return;
        }
    
        $this->order_model->delete_sales($id);
        $this->session->set_flashdata('msg', '<div class="alert alert-danger">Data & Akun login sales berhasil dihapus!</div>');
        redirect('admin/sales');
    }
}