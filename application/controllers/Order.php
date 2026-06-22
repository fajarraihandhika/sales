<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Proteksi: Hanya sales yang boleh masuk ke controller ini
        if ($this->session->userdata('role') !== 'sales') {
            redirect('auth');
        }
        $this->load->model('order_model');
    }

    // Form Tambah Transaksi Sales Order
    public function tambah() {
        // Validasi input form
        $this->form_validation->set_rules('id_pelanggan', 'Pelanggan', 'required');
        $this->form_validation->set_rules('id_produk[]', 'Produk', 'required');
        $this->form_validation->set_rules('jumlah[]', 'Jumlah', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $data['no_order'] = $this->order_model->generate_no_order();
            $data['pelanggan'] = $this->order_model->get_all_pelanggan();
            $data['produk'] = $this->order_model->get_aktif_produk();
            
            // Load view form order (Sesuaikan dengan template bootstrap kamu nanti)
            $this->load->view('sales/order_form', $data);
        } else {
            $this->_proses_simpan();
        }
    }

    private function _proses_simpan() {
        $id_pelanggan = $this->input->post('id_pelanggan');
        $arr_id_produk = $this->input->post('id_produk');
        $arr_jumlah    = $this->input->post('jumlah');
        
        $id_sales = $this->session->userdata('id_sales'); // Diambil dari session login sales
        $no_order = $this->order_model->generate_no_order();

        $detail_data = [];
        $total_harga_order = 0;

        // Loop untuk memproses setiap item produk yang dipilih
        foreach ($arr_id_produk as $index => $id_produk) {
            $qty = $arr_jumlah[$index];
            
            // Ambil data harga asli produk dari DB untuk menghindari manipulasi input/HTML
            $produk = $this->db->get_where('produk', ['id_produk' => $id_produk])->row_array();
            
            if ($produk) {
                // HITUNG OTOMATIS: Subtotal per item produk
                $subtotal = $produk['harga'] * $qty;
                $total_harga_order += $subtotal; // Akumulasi ke total harga nota

                $detail_data[] = [
                    'id_produk'    => $id_produk,
                    'jumlah'       => $qty,
                    'harga_satuan' => $produk['harga'],
                    'subtotal'     => $subtotal
                ];
            }
        }

        // Siapkan data untuk tabel header
        $header_data = [
            'no_order'      => $no_order,
            'id_pelanggan'  => $id_pelanggan,
            'id_sales'      => $id_sales,
            'tanggal_order' => date('Y-m-d'),
            'total_harga'   => $total_harga_order,
            'status'        => 'draft' // Status default awal sesuai soal
        ];

        // Jalankan perintah insert ke model
        $simpan = $this->order_model->insert_order($header_data, $detail_data);

        if ($simpan) {
            $this->session->set_flashdata('success', 'Sales Order ' . $no_order . ' berhasil dibuat dengan status Draft!');
            redirect('sales/dashboard');
        } else {
            $this->session->set_flashdata('error', 'Gagal menyimpan transaksi, coba lagi.');
            redirect('sales/order/tambah');
        }
    }
}