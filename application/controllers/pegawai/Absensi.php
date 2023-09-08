<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absensi extends CI_Controller
{
   public function index()
   {
      $data['title'] = "Dashboard";
      // mengambil session id pegawai
      $id = $this->session->userdata('user_id');

      // menampilkan query data pegawai
      $data['pegawai'] = $this->db->query("SELECT * FROM karyawan 
        JOIN jabatan ON jabatan.id_jabatan = karyawan.id_jabatan
        JOIN departement ON departement.id_departement = karyawan.id_departement
        WHERE karyawan.user_id='$id'")->result();
      $tahun      = date('Y');
      $bulan      = date('m');
      $hari       = date('d');
      $absen      = $this->model->absendaily($this->session->userdata('user_id'), $tahun, $bulan, $hari);
      if ($absen->num_rows() == 0) {
         $data['waktu'] = 'masuk';
      } elseif ($absen->num_rows() == 1) {
         $data['waktu'] = 'pulang';
      } else {
         $data['waktu'] = 'dilarang';
      }
      $detail_pegawai = $this->model->detail_pegawai($id);
      $data['detail_pegawai'] = $detail_pegawai;
      $data['absen'] = $this->db->query("SELECT * FROM absen
        JOIN karyawan on karyawan.user_id = absen.user_id
        WHERE absen.user_id='$id'
        ORDER BY absen.id_absen  DESC LIMIT 2")->result();
      $this->load->view('layout/pegawai/header', $data);
      $this->load->view('pegawai/absensi', $data);
      $this->load->view('layout/pegawai/footer');
   }

   //proses absen
   public function proses_absen()
   {
      $id = $this->session->userdata('user_id');
      $p = $this->input->post();
      $data = [
         'user_id'    => $id,
         'lokasi_kerja' => $p['lokasi_kerja'],
         'shift_line' => $p['shift_line'],
         'aktivitas' => $p['aktivitas'],
         'kondisi_kesehatan' => $p['kondisi_kesehatan'],
         'keterangan' => $p['ket'],
         'estimated' => $p['by']
      ];
      $this->db->insert('absen', $data);

      // Tambahkan keterangan ke dalam flash data
      $this->session->set_flashdata('success', 'Berhasil melakukan absen ' . $p['ket']);

      redirect('pegawai/absensi');
   }
}
