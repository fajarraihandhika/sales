<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('role') !== 'admin') { redirect('auth'); }
        $this->load->model('order_model');
    }

    public function index() {
        $data['produk'] = $this->order_model->get_all_produk();
        
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/produk', $data);
        $this->load->view('templates/footer');
    }

    public function tambah() {
        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required|trim');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
        $this->form_validation->set_rules('stok', 'Stok', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $data['kode_produk'] = $this->order_model->generate_kode_produk();
            $this->load->view('templates/header');
            $this->load->view('templates/sidebar');
            $this->load->view('admin/tambah_produk', $data);
            $this->load->view('templates/footer');
        } else {
            $insert_data = [
                'kode_produk' => $this->input->post('kode_produk'),
                'nama_produk' => $this->input->post('nama_produk'),
                'harga'       => $this->input->post('harga'),
                'stok'        => $this->input->post('stok')
            ];
            $this->order_model->insert_produk($insert_data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success">Produk berhasil ditambahkan!</div>');
            redirect('admin/produk');
        }
    }

    public function edit($id) {
        $data['produk'] = $this->order_model->get_produk_by_id($id);

        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required|trim');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
        $this->form_validation->set_rules('stok', 'Stok', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header');
            $this->load->view('templates/sidebar');
            $this->load->view('admin/edit_produk', $data);
            $this->load->view('templates/footer');
        } else {
            $update_data = [
                'nama_produk' => $this->input->post('nama_produk'),
                'harga'       => $this->input->post('harga'),
                'stok'        => $this->input->post('stok')
            ];
            $this->order_model->update_produk($id, $update_data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success">Produk berhasil diubah!</div>');
            redirect('admin/produk');
        }
    }

    public function hapus($id) {
        if ($this->order_model->is_produk_used($id)) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fw-bold">Produk ini masih terikat dengan riwayat transaksi penjualan, tidak bisa dihapus!</div>');
            redirect('admin/produk');
            return;
        }
    
        $this->order_model->delete_produk($id);
        $this->session->set_flashdata('msg', '<div class="alert alert-danger">Produk berhasil dihapus!</div>');
        redirect('admin/produk');
    }
}