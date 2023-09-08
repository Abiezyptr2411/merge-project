<?php

class Izin extends CI_Controller
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
      $data['title'] = "Pengajuan Izin";

      $id = $this->session->userdata('user_id');

      $data['cuti'] = $this->db->query("SELECT * FROM izin
        INNER JOIN karyawan ON karyawan.user_id = izin.user_id
        WHERE izin.user_id='$id' AND izin.kategori_izin='Cuti'")->result();

      $data['izin'] = $this->db->query("SELECT * FROM izin
        INNER JOIN karyawan ON karyawan.user_id = izin.user_id
        WHERE izin.user_id='$id' AND izin.kategori_izin='Izin'")->result();

      $data['sakit'] = $this->db->query("SELECT * FROM izin
        INNER JOIN karyawan ON karyawan.user_id = izin.user_id
        WHERE izin.user_id='$id' AND izin.kategori_izin='Sakit'")->result();

      $this->load->view('layout/pegawai/header', $data);
      $this->load->view('pegawai/izin', $data);
      $this->load->view('layout/pegawai/footer');
   }

   public function daftar_cuti()
   {
      $data['title'] = "Pengajuan Cuti";

      $id = $this->session->userdata('user_id');

      // Query untuk mengambil nama_karyawan berdasarkan user_id
      $query = $this->db->get_where('karyawan', array('user_id' => $id));

      // Mengecek apakah data ditemukan
      if ($query->num_rows() > 0) {
         // Mengambil hasil query
         $result = $query->row();
         $data['nama_karyawan'] = $result->nama_karyawan;
      } else {
         // Jika data tidak ditemukan, atur nama_karyawan ke kosong atau sesuai kebutuhan
         $data['nama_karyawan'] = '';
      }

      $data['cuti'] = $this->db->query("SELECT * FROM izin
        INNER JOIN karyawan ON karyawan.user_id = izin.user_id
         WHERE izin.user_id='$id' AND izin.kategori_izin='Cuti'
        ORDER BY izin.id_izin DESC")->result();

      $this->load->view('layout/pegawai/header', $data);
      $this->load->view('pegawai/cuti_list', $data);
      $this->load->view('layout/pegawai/footer');
   }

   public function daftar_izin()
   {
      $data['title'] = "Pengajuan Izin";

      $id = $this->session->userdata('user_id');

      // Query untuk mengambil nama_karyawan berdasarkan user_id
      $query = $this->db->get_where('karyawan', array('user_id' => $id));

      // Mengecek apakah data ditemukan
      if ($query->num_rows() > 0) {
         // Mengambil hasil query
         $result = $query->row();
         $data['nama_karyawan'] = $result->nama_karyawan;
      } else {
         // Jika data tidak ditemukan, atur nama_karyawan ke kosong atau sesuai kebutuhan
         $data['nama_karyawan'] = '';
      }

      $data['izin'] = $this->db->query("SELECT * FROM izin
        INNER JOIN karyawan ON karyawan.user_id = izin.user_id
        WHERE izin.user_id='$id' AND izin.kategori_izin='Izin'
        ORDER BY izin.id_izin DESC")->result();

      $this->load->view('layout/pegawai/header', $data);
      $this->load->view('pegawai/izin_list', $data);
      $this->load->view('layout/pegawai/footer');
   }

   public function daftar_sakit()
   {
      $data['title'] = "Pengajuan Izin";

      $id = $this->session->userdata('user_id');

      // Query untuk mengambil nama_karyawan berdasarkan user_id
      $query = $this->db->get_where('karyawan', array('user_id' => $id));

      // Mengecek apakah data ditemukan
      if ($query->num_rows() > 0) {
         // Mengambil hasil query
         $result = $query->row();
         $data['nama_karyawan'] = $result->nama_karyawan;
      } else {
         // Jika data tidak ditemukan, atur nama_karyawan ke kosong atau sesuai kebutuhan
         $data['nama_karyawan'] = '';
      }

      $data['sakit'] = $this->db->query("SELECT * FROM izin
        INNER JOIN karyawan ON karyawan.user_id = izin.user_id
        WHERE izin.user_id='$id' AND izin.kategori_izin='Sakit'
        ORDER BY izin.id_izin DESC")->result();

      $this->load->view('layout/pegawai/header', $data);
      $this->load->view('pegawai/sakit_list', $data);
      $this->load->view('layout/pegawai/footer');
   }

   public function pengajuan()
   {
      $data['title'] = "Pengajuan Izin";

      $this->load->view('layout/pegawai/header', $data);
      $this->load->view('pegawai/ajukan_izin', $data);
      $this->load->view('layout/pegawai/footer');
   }

   public function proses_izin()
   {
      $kategori_izin = $this->input->post('kategori_izin');
      $tgl_awal = $this->input->post('tgl_awal');
      $tgl_akhir = $this->input->post('tgl_akhir');
      $keterangan = $this->input->post('keterangan');
      $bukti = null; // Set default nilai untuk bukti

      // Konfigurasi upload file
      $config['upload_path'] = './uploads/'; // Lokasi penyimpanan file
      $config['allowed_types'] = 'pdf|png|jpg|jpeg'; // Hanya izinkan file PDF
      $config['max_size'] = 2048; // Maksimum 2MB

      $this->load->library('upload', $config);

      // Cek apakah ada file yang diunggah
      if (!empty($_FILES['bukti']['name'])) {
         if (!$this->upload->do_upload('bukti')) {
            // Jika upload gagal, tampilkan pesan kesalahan
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
            redirect('pegawai/izin');
         } else {
            // Jika upload berhasil, simpan nama file
            $bukti = $this->upload->data('file_name');
         }
      }

      // Data yang akan disimpan ke dalam database
      $data = array(
         'user_id'         => $this->session->userdata('user_id'),
         'kategori_izin'  => $kategori_izin,
         'tgl_awal'       => $tgl_awal,
         'tgl_akhir'       => $tgl_akhir,
         'keterangan'       => $keterangan,
         'bukti'        => $bukti // Menggunakan nilai yang telah ditentukan (null jika tidak diunggah)
      );

      $this->db->insert('izin', $data);

      $this->session->set_flashdata('success', 'Berhasil mengajukan lembur');
      redirect('pegawai/izin');
   }
}
