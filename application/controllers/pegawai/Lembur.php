<?php

class Lembur extends CI_Controller
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
      $data['title'] = "Pengajuan Lembur";

      $id = $this->session->userdata('user_id');

      $data['lembur'] = $this->db->query("SELECT * FROM lembur
        INNER JOIN karyawan ON karyawan.user_id = lembur.user_id
        WHERE lembur.user_id='$id'
        ORDER BY lembur.id_lembur DESC")->result();

      $this->load->view('layout/pegawai/header', $data);
      $this->load->view('pegawai/riwayat_lembur', $data);
      $this->load->view('layout/pegawai/footer');
   }

   public function pengajuan()
   {
      $data['title'] = "Pengajuan Lembur";

      $this->load->view('layout/pegawai/header', $data);
      $this->load->view('pegawai/ajukan_lembur', $data);
      $this->load->view('layout/pegawai/footer');
   }

   public function proses_lembur()
   {
      $tanggal_lembur = $this->input->post('tanggal_lembur');
      $jam_mulai = $this->input->post('jam_mulai');
      $jam_akhir = $this->input->post('jam_akhir');
      $pekerjaan = $this->input->post('pekerjaan');
      $lampiran = null; // Set default nilai untuk lampiran

      // Konfigurasi upload file
      $config['upload_path'] = './uploads/'; // Lokasi penyimpanan file
      $config['allowed_types'] = 'pdf'; // Hanya izinkan file PDF
      $config['max_size'] = 2048; // Maksimum 2MB

      $this->load->library('upload', $config);

      // Cek apakah ada file yang diunggah
      if (!empty($_FILES['lampiran']['name'])) {
         if (!$this->upload->do_upload('lampiran')) {
            // Jika upload gagal, tampilkan pesan kesalahan
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
            redirect('pegawai/lembur');
         } else {
            // Jika upload berhasil, simpan nama file
            $lampiran = $this->upload->data('file_name');
         }
      }

      // Data yang akan disimpan ke dalam database
      $data = array(
         'user_id' => $this->session->userdata('user_id'),
         'tanggal_lembur' => $tanggal_lembur,
         'jam_mulai' => $jam_mulai,
         'jam_akhir' => $jam_akhir,
         'pekerjaan' => $pekerjaan,
         'lampiran' => $lampiran // Menggunakan nilai yang telah ditentukan (null jika tidak diunggah)
      );

      $this->db->insert('lembur', $data);

      $this->session->set_flashdata('success', 'Berhasil mengajukan lembur');
      redirect('pegawai/lembur');
   }
}
