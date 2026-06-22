<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Proteksi Hak Akses Sales
        if ($this->session->userdata('role') !== 'sales') {
            redirect('auth');
        }
        $this->load->model('order_model');
    }

    public function index() {
        $id_user = $this->session->userdata('id_user');
        $id_sales = $this->session->userdata('id_sales');
    
        $data['my_orders']   = $this->order_model->get_orders_by_sales($id_user);
        $data['total_omset'] = $this->order_model->get_total_omset_by_sales($id_sales);
        $data['total_order'] = $this->order_model->get_count_orders_by_sales($id_sales);
        $data['order_draft'] = $this->order_model->get_count_by_status_sales('draft', $id_sales);
    
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('sales/dashboard', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_order() {
        $this->form_validation->set_rules('id_pelanggan', 'Pelanggan', 'required');
        $this->form_validation->set_rules('id_produk', 'Produk', 'required');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required|numeric|greater_than[0]');
    
        if ($this->form_validation->run() == FALSE) {
            $data['pelanggan'] = $this->db->get('pelanggan')->result_array();
            $data['produk'] = $this->order_model->get_aktif_produk(); // hanya produk yang stoknya > 0
    
            $this->load->view('templates/header');
            $this->load->view('templates/sidebar');
            $this->load->view('sales/tambah', $data);
            $this->load->view('templates/footer');
        } else {
            $id_user = $this->session->userdata('id_user');
            $sales = $this->db->get_where('sales', ['id_user' => $id_user])->row_array();
    
            $id_produk = $this->input->post('id_produk');
            $jumlah = $this->input->post('jumlah');
            $produk = $this->db->get_where('produk', ['id_produk' => $id_produk])->row_array();
    
            // Validasi stok tersedia
            if (!$produk || $jumlah > $produk['stok']) {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger fw-bold">Jumlah pesanan melebihi stok tersedia (Sisa stok: '.($produk['stok'] ?? 0).')!</div>');
                redirect('sales/dashboard/tambah_order');
                return;
            }
    
            $total_harga = $produk['harga'] * $jumlah;
            $no_order = $this->order_model->generate_no_order(); // pakai generator resmi, bukan random
    
            $data_order = [
                'no_order'      => $no_order,
                'tanggal_order' => date('Y-m-d'),
                'id_pelanggan'  => $this->input->post('id_pelanggan'),
                'id_sales'      => $sales['id_sales'],
                'total_harga'   => $total_harga,
                'status'        => 'draft'
            ];
    
            $data_detail = [
                'id_produk'    => $id_produk,
                'jumlah'       => $jumlah,
                'harga_satuan' => $produk['harga'],
                'subtotal'     => $total_harga   // <-- FIX: subtotal sekarang ikut tersimpan
            ];
    
            $this->order_model->insert_sales_order($data_order, $data_detail);
            $this->session->set_flashdata('msg', '<div class="alert alert-success fw-bold">Sales Order berhasil dibuat!</div>');
            redirect('sales/dashboard');
        }
    }
    
    public function edit_order($id_order) {
        $order = $this->db->get_where('sales_order', ['id_order' => $id_order])->row_array();
        if (!$order || $order['status'] !== 'draft') {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fw-bold">Orderan dikunci karena sedang diproses Logistik!</div>');
            redirect('sales/dashboard');
            return;
        }
    
        $this->form_validation->set_rules('id_pelanggan', 'Pelanggan', 'required');
        $this->form_validation->set_rules('id_produk', 'Produk', 'required');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required|numeric|greater_than[0]');
    
        if ($this->form_validation->run() == FALSE) {
            $data['order'] = $order;
            // FIX: nama tabel yang benar adalah sales_order_detail, bukan detail_order
            $data['detail'] = $this->db->get_where('sales_order_detail', ['id_order' => $id_order])->row_array();
            $data['pelanggan'] = $this->db->get('pelanggan')->result_array();
            $data['produk'] = $this->order_model->get_aktif_produk();
    
            $this->load->view('templates/header');
            $this->load->view('templates/sidebar');
            $this->load->view('sales/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $id_produk = $this->input->post('id_produk');
            $jumlah = $this->input->post('jumlah');
            $produk = $this->db->get_where('produk', ['id_produk' => $id_produk])->row_array();
    
            if (!$produk || $jumlah > $produk['stok']) {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger fw-bold">Jumlah pesanan melebihi stok tersedia (Sisa stok: '.($produk['stok'] ?? 0).')!</div>');
                redirect('sales/dashboard/edit_order/'.$id_order);
                return;
            }
    
            $total_harga = $produk['harga'] * $jumlah;
    
            $data_order = [
                'id_pelanggan' => $this->input->post('id_pelanggan'),
                'total_harga'  => $total_harga
            ];
    
            $data_detail = [
                'id_produk'    => $id_produk,
                'jumlah'       => $jumlah,
                'harga_satuan' => $produk['harga'],
                'subtotal'     => $total_harga   // <-- FIX juga di sini
            ];
    
            $this->order_model->update_sales_order($id_order, $data_order, $data_detail);
            $this->session->set_flashdata('msg', '<div class="alert alert-success fw-bold">Data orderan berhasil diperbarui!</div>');
            redirect('sales/dashboard');
        }
    }
}