<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

   public function __construct()
   {
      parent::__construct();

      $this->load->model('model');

      if ($this->session->userdata('role') != '3') {
         redirect('login');
      }
   }

   public function index()
   {
      $data['title'] = 'Dashboard';

      $this->load->view('layout/pegawai/header', $data);
      $this->load->view('pegawai/dashboard', $data);
      $this->load->view('layout/pegawai/footer');
   }
}
