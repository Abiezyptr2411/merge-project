<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
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
      $data['title'] = 'Dashboard';

      // Query database untuk mengambil data dari tabel karyawan dengan join ke tabel lembur dan izin
      $query = $this->db->query("SELECT *, izin.created_at AS tgl_izin
       FROM izin
       JOIN karyawan ON karyawan.user_id = izin.user_id
       WHERE status_izin='0'");

      // Menyimpan hasil query dalam array
      $data['permohonan'] = $query->result();

      $this->db->select('karyawan.*, jabatan.nama_jabatan, departement.nama_departement');
      $this->db->from('karyawan');

      // Join ke tabel jabatan
      $this->db->join('jabatan', 'karyawan.id_jabatan = jabatan.id_jabatan', 'left');

      // Join ke tabel departement
      $this->db->join('departement', 'karyawan.id_departement = departement.id_departement', 'left');

      // Tanggal sekarang
      $today = date('Y-m-d');

      // Tanggal 1 bulan mendekati
      $oneMonthAhead = date('Y-m-d', strtotime("+1 month"));

      $this->db->where('tgl_kontrak_berakhir >=', $today);
      $this->db->where('tgl_kontrak_berakhir <=', $oneMonthAhead);

      $query = $this->db->get();
      $data['karyawan'] = $query->result();

      // Hitung estimasi berapa lama lagi kontrak akan berakhir
      foreach ($data['karyawan'] as &$karyawan) {
         $tgl_berakhir = strtotime($karyawan->tgl_kontrak_berakhir);
         $tgl_sekarang = strtotime(date('Y-m-d'));
         $estimasi_hari = ($tgl_berakhir - $tgl_sekarang) / (60 * 60 * 24); // Perhitungan dalam hari
         $karyawan->estimasi_hari = ceil($estimasi_hari); // Pembulatan ke atas
      }

      $this->load->view('layout/admin/header', $data);
      $this->load->view('admin/dashboard', $data);
      $this->load->view('layout/admin/footer');
   }


   public function getPayrollData()
   {
      // Array untuk menyimpan data gaji per bulan
      $monthlyData = array_fill(1, 12, 0);

      $currentYear = date('Y');
      $payrollData = $this->db
         ->select('MONTH(tanggal_pembayaran) as month, SUM(thp) as total_salary')
         ->where('YEAR(tanggal_pembayaran)', $currentYear)
         ->group_by('MONTH(tanggal_pembayaran)')
         ->get('payroll')
         ->result();

      // Mengisi data gaji berdasarkan bulan
      foreach ($payrollData as $data) {
         $month = (int) $data->month;
         $monthlyData[$month] = (float) $data->total_salary;
      }

      // Membuat array untuk label bulan
      $monthLabels = array(
         'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
         'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
      );

      $chartData = [
         'labels' => $monthLabels,
         'values' => array_values($monthlyData), // Menggunakan array_values untuk mengambil nilai-nilai dari array asosiatif
      ];

      $this->output
         ->set_content_type('application/json')
         ->set_output(json_encode($chartData));
   }
}
