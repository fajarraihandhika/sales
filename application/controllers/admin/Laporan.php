<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('role') !== 'admin') {
            redirect('auth');
        }
        $this->load->model('order_model');
    }

    public function index() {
        $data['laporan_stok']      = $this->order_model->get_laporan_stok();
        $data['ringkasan_status']  = $this->order_model->get_ringkasan_status_order();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/laporan', $data);
        $this->load->view('templates/footer');
    }
}