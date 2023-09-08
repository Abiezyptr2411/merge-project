<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\IOFactory;

class Karyawan extends CI_Controller
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
      $data['title'] = 'Karyawan';

      $data['jabatan'] = $this->model->get('jabatan')->result();

      $this->db->select('karyawan.*, users.*, jabatan.*, departement.*');
      $this->db->from('karyawan');
      $this->db->join('users', 'karyawan.user_id = users.user_id', 'left');
      $this->db->join('jabatan', 'karyawan.id_jabatan = jabatan.id_jabatan', 'left');
      $this->db->join('departement', 'karyawan.id_departement = departement.id_departement', 'left');
      $this->db->order_by('karyawan.created_at', 'desc');
      $data['karyawan'] = $this->db->get()->result();

      $this->load->view('layout/admin/header', $data);
      $this->load->view('admin/karyawan', $data);
      $this->load->view('layout/admin/footer');
   }

   public function add()
   {
      $data['title'] = 'Tambah Karyawan';

      $data['jabatan'] = $this->model->get('jabatan')->result();
      $data['departement'] = $this->model->get('departement')->result();

      $this->load->view('layout/admin/header', $data);
      $this->load->view('admin/addkaryawan', $data);
      $this->load->view('layout/admin/footer');
   }

   public function proses()
   {
      // Ambil data karyawan dari form atau request
      $id_karyawan = $this->input->post('id_karyawan');
      $nama_karyawan = $this->input->post('nama_karyawan');
      $id_jabatan = $this->input->post('id_jabatan');
      $id_departement = $this->input->post('id_departement');
      $nik = $this->input->post('nik');
      $no_kk = $this->input->post('no_kk');
      $alamat = $this->input->post('alamat');
      $no_kontrak = $this->input->post('no_kontrak');
      $tgl_kontrak = $this->input->post('tgl_kontrak');
      $tgl_kontrak_berakhir = $this->input->post('tgl_kontrak_berakhir');
      $username = $this->input->post('username');
      $email = $this->input->post('email');
      $password = md5($this->input->post('password')); // Menggunakan MD5 untuk mengenkripsi kata sandi

      // Data untuk tabel 'users'
      $userData = array(
         'username'  => $username,
         'email'     => $email,
         'password'  => $password,
         'role'      => 3,
         'status'    => 1,
      );

      // Simpan data pengguna ke tabel users dan ambil ID pengguna yang baru saja dimasukkan
      $this->db->insert('users', $userData);
      $id_user = $this->db->insert_id(); // Ambil ID pengguna yang baru saja dimasukkan

      // Data untuk tabel 'karyawan' termasuk id_user
      $karyawanData = array(
         'id_karyawan' => $id_karyawan,
         'nama_karyawan' => $nama_karyawan,
         'id_jabatan' => $id_jabatan,
         'id_departement' => $id_departement,
         'nik' => $nik,
         'no_kk' => $no_kk,
         'alamat' => $alamat,
         'no_kontrak' => $no_kontrak,
         'tgl_kontrak' => $tgl_kontrak,
         'tgl_kontrak_berakhir' => $tgl_kontrak_berakhir,
         'user_id' => $id_user, // Masukkan ID pengguna ke dalam kolom id_user
      );

      // Simpan data karyawan ke tabel karyawan
      $this->db->insert('karyawan', $karyawanData);

      // Redirect atau berikan respons sesuai kebutuhan Anda
      $this->session->set_flashdata('success', 'Data karyawan berhasil ditambah');
      redirect('admin/karyawan');
   }

   public function import_excel()
   {
      $config['upload_path'] = './excel_upload/'; // Sesuaikan dengan lokasi penyimpanan file
      $config['allowed_types'] = 'xls|xlsx';

      $this->load->library('upload', $config);

      if (!$this->upload->do_upload('excel_file')) {
         // Gagal unggah file
         $error = array('error' => $this->upload->display_errors());
         $this->load->view('upload_form', $error);
      } else {
         // Sukses unggah file
         $file_data = $this->upload->data();
         $file_path = './excel_upload/' . $file_data['file_name'];

         // Proses file Excel
         $spreadsheet = IOFactory::load($file_path);
         $worksheet = $spreadsheet->getActiveSheet();
         $rows = $worksheet->toArray();

         // Mulai dari indeks 1 untuk menghindari baris judul (header)
         for ($i = 1; $i < count($rows); $i++) {
            $username = $rows[$i][0];
            $email = $rows[$i][1];
            $password = md5($rows[$i][2]); // Kolom password

            // Cek apakah pengguna dengan username tersebut sudah ada
            $existing_user = $this->db->get_where('users', array('username' => $username))->row();

            if ($existing_user) {
               $user_id = $existing_user->user_id;
            } else {
               // Jika belum ada, buat pengguna baru di tabel "users"
               $user_data = array(
                  'username' => $username,
                  'email' => $email,
                  'password' => $password,
                  'role' => 3,
                  'status' => 1,
               );
               $this->db->insert('users', $user_data);

               // Ambil user_id yang baru saja dibuat
               $user_id = $this->db->insert_id();
            }

            // Insert data ke tabel "karyawan" dengan user_id yang sesuai
            $id_karyawan = $rows[$i][3];
            $nama_karyawan = $rows[$i][4];
            $jabatan = $rows[$i][5];
            $departement = $rows[$i][6];
            $nik = $rows[$i][7];
            $no_kk = $rows[$i][8];
            $alamat = $rows[$i][9];
            $no_kontrak = $rows[$i][10];
            $tgl_kontrak = $rows[$i][11];
            $tgl_kontrak_berakhir = $rows[$i][12];

            $karyawan_data = array(
               'id_karyawan' => $id_karyawan,
               'user_id' => $user_id,
               'nama_karyawan' => $nama_karyawan,
               'id_jabatan' => $jabatan,
               'id_departement' => $departement,
               'nik' => $nik,
               'no_kk' => $no_kk,
               'alamat' => $alamat,
               'no_kontrak' => $no_kontrak,
               'tgl_kontrak' => $tgl_kontrak,
               'tgl_kontrak_berakhir' => $tgl_kontrak_berakhir,
            );
            $this->db->insert('karyawan', $karyawan_data);
         }

         // Setelah selesai, arahkan pengguna ke halaman yang sesuai
         $this->session->set_flashdata('success', 'Data karyawan berhasil diunggah');
         redirect('admin/karyawan');
      }
   }

   public function update($id)
   {
      $data['title'] = 'Update Karyawan';

      $data['jabatan'] = $this->model->get('jabatan')->result();
      $data['departement'] = $this->model->get('departement')->result();

      $where = array('id_karyawan' => $id);

      $this->db->select('karyawan.*, users.*, jabatan.*, departement.*');
      $this->db->from('karyawan');
      $this->db->join('users', 'karyawan.user_id = users.user_id', 'left');
      $this->db->join('jabatan', 'karyawan.id_jabatan = jabatan.id_jabatan', 'left');
      $this->db->join('departement', 'karyawan.id_departement = departement.id_departement', 'left');
      $this->db->where('karyawan.id_karyawan', $id);
      $data['karyawan'] = $this->db->get()->row();

      $this->load->view('layout/admin/header', $data);
      $this->load->view('admin/updatekaryawan', $data);
      $this->load->view('layout/admin/footer');
   }

   public function proses_ubah()
   {
      $id_karyawan = $this->input->post('id_karyawan');
      $nama_karyawan = $this->input->post('nama_karyawan');
      $id_jabatan = $this->input->post('id_jabatan');
      $id_departement = $this->input->post('id_departement');
      $nik = $this->input->post('nik');
      $no_kk = $this->input->post('no_kk');
      $alamat = $this->input->post('alamat');
      $no_kontrak = $this->input->post('no_kontrak');
      $tgl_kontrak = $this->input->post('tgl_kontrak');
      $tgl_kontrak_berakhir = $this->input->post('tgl_kontrak_berakhir');

      $data = array(
         'nama_karyawan' => $nama_karyawan,
         'id_jabatan' => $id_jabatan,
         'id_departement' => $id_departement,
         'nik' => $nik,
         'no_kk' => $no_kk,
         'alamat' => $alamat,
         'no_kontrak' => $no_kontrak,
         'tgl_kontrak' => $tgl_kontrak,
         'tgl_kontrak_berakhir' => $tgl_kontrak_berakhir,
      );

      $where = array(
         'id_karyawan' => $id_karyawan
      );

      $this->model->update('karyawan', $data, $where);

      $this->session->set_flashdata('success', 'Data karyawan berhasil diubah');
      redirect('admin/karyawan');
   }

   public function delete($id)
   {
      $where = array('id_karyawan' => $id);
      $this->model->delete($where, 'karyawan');

      $this->session->set_flashdata('success', 'Data karyawan berhasil dihapus');
      redirect('admin/karyawan');
   }
}
