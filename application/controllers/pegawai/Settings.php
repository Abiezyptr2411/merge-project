<?php

class Settings extends CI_Controller
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
      $data['title'] = "Pengaturan";

      $id = $this->session->userdata('user_id');

      $data['general'] = $this->db->query("SELECT * FROM karyawan
        LEFT JOIN users ON users.user_id = karyawan.user_id
        WHERE karyawan.user_id='$id'")->result();

      $data['bio'] = $this->db->query("SELECT bio, user_id FROM karyawan
        WHERE user_id='$id'")->result();

      $data['account'] = $this->db->query("SELECT * FROM users
        WHERE user_id='$id'")->result();

      $this->load->view('layout/pegawai/header', $data);
      $this->load->view('pegawai/pengaturan', $data);
      $this->load->view('layout/pegawai/footer');
   }

   public function update_general()
   {
      $nama_karyawan = $this->input->post('nama_karyawan');
      $nik = $this->input->post('nik');
      $no_kk = $this->input->post('no_kk');
      $email = $this->input->post('email');
      $no_telp = $this->input->post('no_telp');
      $alamat = $this->input->post('alamat');
      $user_id = $this->session->userdata('user_id');

      // Mengecek apakah no_telp null atau tidak
      if ($no_telp === null) {
         // Jika no_telp null, set ke string "Belum melengkapi data"
         $no_telp = 0;
      }

      // Data yang akan diupdate ke dalam tabel 'karyawan'
      $data_karyawan = array(
         'nama_karyawan' => $nama_karyawan,
         'nik' => $nik,
         'no_kk' => $no_kk,
         'no_telp' => $no_telp,
         'alamat' => $alamat
      );

      // Data yang akan diupdate ke dalam tabel 'users'
      $data_users = array(
         'email' => $email
      );

      // Kondisi WHERE untuk mengidentifikasi data yang akan diupdate berdasarkan user_id
      $this->db->where('user_id', $user_id);

      // Melakukan update data "general information" di tabel 'karyawan'
      $this->db->update('karyawan', $data_karyawan);

      // Kondisi WHERE untuk mengidentifikasi data yang akan diupdate berdasarkan user_id
      $this->db->where('user_id', $user_id);

      // Melakukan update data email di tabel 'users'
      $this->db->update('users', $data_users);

      $this->session->set_flashdata('success', 'Berhasil mengubah general information');
      redirect('pegawai/settings');
   }

   public function proses_ubah()
   {
      $nama_karyawan = $this->input->post('nama_karyawan');
      $nik = $this->input->post('nik');
      $no_kk = $this->input->post('no_kk');
      $email = $this->input->post('email');
      $no_telp = $this->input->post('no_telp');
      $alamat = $this->input->post('alamat');
      $user_id = $this->session->userdata('user_id');

      $data_karyawan = array(
         'user_id' => $user_id,
         'nama_karyawan' => $nama_karyawan,
         'nik' => $nik,
         'no_kk' => $no_kk,
         'no_telp' => $no_telp,
         'alamat' => $alamat
      );

      $where = array(
         'user_id' => $user_id
      );

      // Data yang akan diupdate ke dalam tabel 'users'
      $data_users = array(
         'user_id' => $user_id,
         'email' => $email
      );

      // Melakukan update data email di tabel 'users'
      $this->model->update('users', $data_users, $where);

      // Melakukan update data lainnya di tabel 'karyawan'
      $this->model->update('karyawan', $data_karyawan, $where);

      $this->session->set_flashdata('success', 'Berhasil mengubah general information');
      redirect('pegawai/settings');
   }

   public function about()
   {
      $bio = $this->input->post('bio');
      $user_id = $this->session->userdata('user_id');

      $data_karyawan = array(
         'user_id' => $user_id,
         'bio' => $bio,
      );

      $where = array(
         'user_id' => $user_id
      );

      // Melakukan update data lainnya di tabel 'karyawan'
      $this->model->update('karyawan', $data_karyawan, $where);

      $this->session->set_flashdata('success', 'Berhasil mengubah biodata anda');
      redirect('pegawai/settings');
   }

   public function ubah_akun()
   {
      $username = $this->input->post('username');
      $password = $this->input->post('password');
      $confirm_password = $this->input->post('confirm_password');

      // Validasi form
      $this->form_validation->set_rules('username', 'Username', 'required');

      // Hanya tambahkan validasi untuk password jika password tidak kosong
      if (!empty($password)) {
         $this->form_validation->set_rules('password', 'Password Baru', 'required|matches[confirm_password]');
         $this->form_validation->set_rules('confirm_password', 'Ulangi Password', 'required');
      }

      if ($this->form_validation->run() != FALSE) {
         $user_id = $this->session->userdata('user_id');

         // Data yang akan diupdate untuk tabel 'users'
         $data_users = array(
            'username' => $username
         );

         // Hanya update password jika password tidak kosong
         if (!empty($password)) {
            $data_users['password'] = md5($password);
         }

         $where_users = array(
            'user_id' => $user_id
         );

         // Melakukan update data di tabel 'users'
         $this->model->update('users', $data_users, $where_users);
         redirect('login/logout');
      } else {
         $data['title'] = "Ubah Password";

         $this->load->view('layout/pegawai/header', $data);
         $this->load->view('pegawai/pengaturan', $data);
         $this->load->view('layout/pegawai/footer');
      }
   }
}
