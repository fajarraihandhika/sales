<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Proteksi: Hanya Admin yang boleh masuk ke sini
        if ($this->session->userdata('role') !== 'admin') {
            redirect('auth');
        }
        $this->load->model('order_model');
    }

    // Halaman Utama Dashboard Admin
    public function index() {
        $data['nama_admin'] = $this->session->userdata('nama_lengkap');
        $data['orders'] = $this->order_model->get_all_orders();
    
        // Data KPI untuk summary card
        $data['total_omset']      = $this->order_model->get_total_omset();
        $data['total_order']      = $this->order_model->get_count_all_orders();
        $data['pending_kirim']    = $this->order_model->get_count_by_status('dikirim');
        $data['order_draft']      = $this->order_model->get_count_by_status('draft');
    
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/dashboard', $data);
        $this->load->view('templates/footer');
    }

    // Fungsi untuk mengubah status order
    public function ubah_status($id_order, $status_baru) {
        // Validasi agar status yang dimasukkan sesuai dengan ENUM di database
        $status_valid = ['draft', 'dikirim', 'selesai', 'dibatalkan'];
        
        if (in_array($status_baru, $status_valid)) {
            $this->order_model->update_status($id_order, $status_baru);
            $this->session->set_flashdata('msg', '<div style="color:green; font-weight:bold;">Status order berhasil diperbarui menjadi: '.ucfirst($status_baru).'</div>');
        } else {
            $this->session->set_flashdata('msg', '<div style="color:red; font-weight:bold;">Status tidak valid!</div>');
        }

        redirect('admin/dashboard');
    }

    public function detail($id_order) {
        $data['order'] = $this->order_model->get_order_header($id_order);
    
        if (!$data['order']) {
            show_404();
        }
    
        $data['items'] = $this->order_model->get_order_detail_items($id_order);
    
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/detail_order', $data);
        $this->load->view('templates/footer');
    }
}