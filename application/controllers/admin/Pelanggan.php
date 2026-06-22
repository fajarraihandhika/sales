<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('role') !== 'admin') { redirect('auth'); }
        $this->load->model('order_model');
    }

    public function index() {
        // Ambil data pelanggan dari database via model
        $data['pelanggan'] = $this->order_model->get_produk_pelanggan();
        
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/pelanggan', $data);
        $this->load->view('templates/footer');
    }

    public function tambah() {
        $this->form_validation->set_rules('nama_pelanggan', 'Nama Pelanggan', 'required|trim');
        $this->form_validation->set_rules('no_telp', 'No Telepon', 'required|trim|numeric');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header');
            $this->load->view('templates/sidebar');
            $this->load->view('admin/tambah_pelanggan');
            $this->load->view('templates/footer');
        } else {
            $insert_data = [
                'nama_pelanggan' => $this->input->post('nama_pelanggan'),
                'no_telp'        => $this->input->post('no_telp'),
                'alamat'         => $this->input->post('alamat')
            ];
            $this->order_model->insert_pelanggan($insert_data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success fw-bold">Pelanggan baru berhasil ditambahkan!</div>');
            redirect('admin/pelanggan');
        }
    }

    public function edit($id) {
        $data['pelanggan'] = $this->order_model->get_pelanggan_by_id($id);

        $this->form_validation->set_rules('nama_pelanggan', 'Nama Pelanggan', 'required|trim');
        $this->form_validation->set_rules('no_telp', 'No Telepon', 'required|trim|numeric');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header');
            $this->load->view('templates/sidebar');
            $this->load->view('admin/edit_pelanggan', $data);
            $this->load->view('templates/footer');
        } else {
            $update_data = [
                'nama_pelanggan' => $this->input->post('nama_pelanggan'),
                'no_telp'        => $this->input->post('no_telp'),
                'alamat'         => $this->input->post('alamat')
            ];
            $this->order_model->update_pelanggan($id, $update_data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success fw-bold">Data pelanggan berhasil diubah!</div>');
            redirect('admin/pelanggan');
        }
    }

    public function hapus($id) {
        if ($this->order_model->is_pelanggan_used($id)) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fw-bold">Pelanggan ini masih terikat dengan riwayat transaksi penjualan, tidak bisa dihapus!</div>');
            redirect('admin/pelanggan');
            return;
        }
    
        $this->order_model->delete_pelanggan($id);
        $this->session->set_flashdata('msg', '<div class="alert alert-danger fw-bold">Pelanggan berhasil dihapus!</div>');
        redirect('admin/pelanggan');
    }
}