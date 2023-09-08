<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Departement extends CI_Controller
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
      $data['title'] = 'Departement';

      $this->db->select('*');
      $this->db->from('departement');
      $this->db->order_by('id_departement', 'desc');
      $data['departement'] = $this->db->get()->result();

      $this->load->view('layout/admin/header', $data);
      $this->load->view('admin/departement', $data);
      $this->load->view('layout/admin/footer');
   }

   public function proses()
   {
      // form validasi anggota
      $this->form_validation->set_rules('nama_departement', 'nama departement', 'required');

      // jika form anggota gagal maka balik ke form
      if ($this->form_validation->run() == FALSE) {
         $data['title'] = 'Departement';

         $this->db->select('*');
         $this->db->from('departement');
         $this->db->order_by('id_departement', 'desc');
         $data['departement'] = $this->db->get()->result();

         $this->load->view('layout/admin/header', $data);
         $this->load->view('admin/departement', $data);
         $this->load->view('layout/admin/footer');
      } else {
         // cek data
         $nama_departement = $this->input->post('nama_departement');
         $query = $this->db->get_where('departement', array('nama_departement' => $nama_departement));
         if ($query->num_rows() > 0) {
            // jika sudah ada, tampilkan flashdata dan balik ke halaman form
            $_SESSION["block"] = 'Silahkan periksa username dan password anda';
            redirect('admin/departement');
         } else {
            // proses data
            $data = array(
               'nama_departement'          => $nama_departement,
            );

            // insert data to table
            $this->db->insert('departement', $data);

            // memproses halaman ketika input berhasil
            $this->session->set_flashdata('success', 'Data departement berhasil ditambah');
            redirect('admin/departement');
         }
      }
   }


   public function proses_ubah()
   {
      $id_departement = $this->input->post('id_departement');
      $nama_departement = $this->input->post('nama_departement');

      $data = array(
         'nama_departement' => $nama_departement,
      );

      $where = array(
         'id_departement' => $id_departement
      );

      $this->model->update('departement', $data, $where);

      $this->session->set_flashdata('success', 'Data departement berhasil diubah');
      redirect('admin/departement');
   }

   public function delete($id)
   {
      $where = array('id_departement' => $id);
      $this->model->delete($where, 'departement');

      $this->session->set_flashdata('success', 'Data departement berhasil dihapus');
      redirect('admin/departement');
   }
}
