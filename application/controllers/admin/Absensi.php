<?php

class Absensi extends CI_Controller
{

   public function __construct()
   {
      parent::__construct();

      $this->load->model('model');
      $this->load->helper('maps');

      if ($this->session->userdata('role') != '1') {
         redirect('login');
      }
   }

   public function index()
   {
      $data['title'] = "Riwayat Absensi";

      $data['absen'] = $this->db->query("SELECT * FROM absen
        INNER JOIN karyawan ON karyawan.user_id = absen.user_id
        ORDER BY absen.id_absen DESC")->result();

      $this->load->view('layout/admin/header', $data);
      $this->load->view('admin/riwayat_absen', $data);
      $this->load->view('layout/admin/footer');
   }
}
