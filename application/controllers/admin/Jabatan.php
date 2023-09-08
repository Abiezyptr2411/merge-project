<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jabatan extends CI_Controller
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
      $data['title'] = 'Jabatan';

      $this->db->select('*');
      $this->db->from('jabatan');
      $this->db->order_by('created_at', 'desc');
      $data['jabatan'] = $this->db->get()->result();

      $this->load->view('layout/admin/header', $data);
      $this->load->view('admin/jabatan', $data);
      $this->load->view('layout/admin/footer');
   }

   public function proses()
   {
      // form validasi anggota
      $this->form_validation->set_rules('nama_jabatan', 'nama jabatan', 'required');
      $this->form_validation->set_rules('gaji_pokok', 'gaji pokok', 'required');
      $this->form_validation->set_rules('tunjangan_jabatan', 'tunjangan jabatan', 'required');

      // jika form anggota gagal maka balik ke form
      if ($this->form_validation->run() == FALSE) {
         $data['title'] = 'Jabatan';

         $this->db->select('*');
         $this->db->from('jabatan');
         $this->db->order_by('created_at', 'desc');
         $data['jabatan'] = $this->db->get()->result();

         $this->load->view('layout/admin/header', $data);
         $this->load->view('admin/jabatan', $data);
         $this->load->view('layout/admin/footer');
      } else {
         // cek data
         $nama_jabatan = $this->input->post('nama_jabatan');
         $query = $this->db->get_where('jabatan', array('nama_jabatan' => $nama_jabatan));
         if ($query->num_rows() > 0) {
            // jika sudah ada, tampilkan flashdata dan balik ke halaman form
            $_SESSION["block"] = 'Silahkan periksa username dan password anda';
            redirect('admin/jabatan');
         } else {
            // proses data
            $data = array(
               'nama_jabatan'          => $nama_jabatan,
               'gaji_pokok'            => $this->input->post('gaji_pokok'),
               'tunjangan_jabatan'     => $this->input->post('tunjangan_jabatan'),
               'tunjangan_makan'       => $this->input->post('tunjangan_makan') !== '' ? $this->input->post('tunjangan_makan') : null,
               'tunjangan_aktifitas'   => $this->input->post('tunjangan_aktifitas') !== '' ? $this->input->post('tunjangan_aktifitas') : null,
               'tipe_pajak'            => $this->input->post('tipe_pajak'),
               'nominal_pajak'         => $this->input->post('nominal_pajak') !== '' ? $this->input->post('nominal_pajak') : null,
               'bpjs'                  => $this->input->post('bpjs') !== '' ? $this->input->post('bpjs') : null,
            );

            // insert data to table
            $this->db->insert('jabatan', $data);

            // memproses halaman ketika input berhasil
            $this->session->set_flashdata('success', 'Data jabatan berhasil ditambah');
            redirect('admin/jabatan');
         }
      }
   }


   public function proses_ubah()
   {
      $id_jabatan = $this->input->post('id_jabatan');
      $gaji_pokok = $this->input->post('gaji_pokok');
      $tunjangan_jabatan = $this->input->post('tunjangan_jabatan');
      $tunjangan_makan = $this->input->post('tunjangan_makan');
      $tunjangan_aktifitas = $this->input->post('tunjangan_aktifitas');
      $tipe_pajak = $this->input->post('tipe_pajak');
      $nominal_pajak = $this->input->post('nominal_pajak');
      $bpjs = $this->input->post('bpjs');

      // Setel nilai-nilai menjadi null jika mereka kosong
      if (empty($gaji_pokok)) {
         $gaji_pokok = null;
      }
      if (empty($tunjangan_jabatan)) {
         $tunjangan_jabatan = null;
      }
      if (empty($tunjangan_makan)) {
         $tunjangan_makan = null;
      }
      if (empty($tunjangan_aktifitas)) {
         $tunjangan_aktifitas = null;
      }
      if (empty($tipe_pajak)) {
         $tipe_pajak = null;
      }
      if (empty($nominal_pajak)) {
         $nominal_pajak = null;
      }
      if (empty($bpjs)) {
         $bpjs = null;
      }

      $data = array(
         'gaji_pokok' => $gaji_pokok,
         'tunjangan_jabatan' => $tunjangan_jabatan,
         'tunjangan_makan' => $tunjangan_makan,
         'tunjangan_aktifitas' => $tunjangan_aktifitas,
         'tipe_pajak' => $tipe_pajak,
         'nominal_pajak' => $nominal_pajak,
         'bpjs' => $bpjs,
      );

      $where = array(
         'id_jabatan' => $id_jabatan
      );

      $this->model->update('jabatan', $data, $where);

      $this->session->set_flashdata('success', 'Data jabatan berhasil diubah');
      redirect('admin/jabatan');
   }

   public function delete($id)
   {
      $where = array('id_jabatan' => $id);
      $this->model->delete($where, 'jabatan');

      $this->session->set_flashdata('success', 'Data jabatan berhasil dihapus');
      redirect('admin/jabatan');
   }
}
