<?php

class Lembur extends CI_Controller
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
      $data['title'] = "Pengajuan Lembur";

      $data['lembur'] = $this->db->query("SELECT * FROM lembur
        INNER JOIN karyawan ON karyawan.user_id = lembur.user_id
        ORDER BY lembur.id_lembur DESC")->result();

      $this->load->view('layout/admin/header', $data);
      $this->load->view('admin/lembur', $data);
      $this->load->view('layout/admin/footer');
   }
}
