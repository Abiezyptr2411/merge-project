<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
{

   public function __construct()
   {
      parent::__construct();

      $this->load->model('model');

      if ($this->session->userdata('role') != '1') {
         redirect('login');
      }
   }


   public function index()
   {
      $data['title'] = 'Kategori Barang';

      $this->db->select('*');
      $this->db->from('kategori');
      $this->db->order_by('id_kategori', 'desc');
      $data['kategori'] = $this->db->get()->result();

      $this->load->view('layout/admin/header', $data);
      $this->load->view('admin/kategori', $data);
      $this->load->view('layout/admin/footer');
   }


   public function proses()
   {
      // Ambil data dari form atau request
      $nama_kategori = $this->input->post('nama_kategori');

      // Data untuk tabel 'karyawan' termasuk id_user
      $data = array(
         'nama_kategori' => $nama_kategori,
      );

      // Simpan data karyawan ke tabel karyawan
      $this->db->insert('kategori', $data);

      // Redirect atau berikan respons sesuai kebutuhan Anda
      $this->session->set_flashdata('success', 'Data kategori berhasil ditambah');
      redirect('admin/kategori');
   }


   public function proses_ubah()
   {
      $id_kategori = $this->input->post('id_kategori');
      $nama_kategori = $this->input->post('nama_kategori');

      $data = array(
         'nama_kategori' => $nama_kategori,
      );

      $where = array(
         'id_kategori' => $id_kategori
      );

      $this->model->update('kategori', $data, $where);

      $this->session->set_flashdata('success', 'Data kategori berhasil diubah');
      redirect('admin/kategori');
   }

   public function delete($id)
   {
      $where = array('id_kategori' => $id);
      $this->model->delete($where, 'kategori');

      $this->session->set_flashdata('success', 'Data kategori berhasil dihapus');
      redirect('admin/kategori');
   }
}
