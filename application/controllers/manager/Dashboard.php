<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('role') !== 'manager') {
            redirect('auth');
        }
        $this->load->model('order_model');
    }

    public function index() {
        $data['total_omset']    = $this->order_model->get_total_omset();
        $data['total_order']    = $this->order_model->get_count_all_orders();
        $data['all_orders']     = $this->order_model->get_all_orders();
        $data['laporan_produk'] = $this->order_model->get_laporan_per_produk(5); // top 5 produk
    
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('manager/dashboard', $data);
        $this->load->view('templates/footer');
    }
    
    public function cetak_laporan() {
        $data['total_omset']    = $this->order_model->get_total_omset();
        $data['total_order']    = $this->order_model->get_count_all_orders();
        $data['all_orders']     = $this->order_model->get_all_orders();
        $data['laporan_produk'] = $this->order_model->get_laporan_per_produk(null); // semua produk untuk laporan resmi
    
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('manager/cetak_laporan', $data);
        $this->load->view('templates/footer');
    }

    
}