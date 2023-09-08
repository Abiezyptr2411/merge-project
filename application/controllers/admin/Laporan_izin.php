<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class Laporan_izin extends CI_Controller
{

   public function __construct()
   {
      parent::__construct();

      $this->load->helper(array('form', 'url'));
      $this->load->library('form_validation');
      $this->load->model(array('Model'));

      if ($this->session->userdata('role') != '1') {

         redirect('login');
      }
      date_default_timezone_set('asia/jakarta');
   }

   public function index()
   {
      $data['title'] = "Laporan Izin";

      $this->load->view('layout/admin/header', $data);
      $this->load->view('admin/list_laporan_izin', $data);
      $this->load->view('layout/admin/footer');
   }

   public function filter()
   {
      $tanggal_awal = $this->input->post('tanggal_awal');
      $tanggal_akhir = $this->input->post('tanggal_akhir');
      $keterangan = $this->input->post('keterangan');

      $this->db->select('*');
      $this->db->from('izin');
      $this->db->join('karyawan', 'karyawan.user_id = izin.user_id');

      // Tambahkan kondisi WHERE untuk tanggal jika tidak kosong
      if (!empty($tanggal_awal) && !empty($tanggal_akhir)) {
         $tanggal_awal = date('Y-m-d', strtotime($tanggal_awal));
         $tanggal_akhir = date('Y-m-d', strtotime($tanggal_akhir));
         $this->db->where('created_at >=', $tanggal_awal);
         $this->db->where('created_at <=', $tanggal_akhir);
      }

      // Tambahkan kondisi WHERE untuk keterangan jika tidak kosong
      if (!empty($keterangan)) {
         $this->db->where('status_izin', $keterangan);
      }

      $query = $this->db->get();
      $data['izin'] = $query->result();

      // Muat view laporan absen dengan data yang sudah difilter
      $this->load->view('layout/admin/header', $data);
      $this->load->view('admin/result_laporan_izin', $data);
      $this->load->view('layout/admin/footer');
   }

   public function exportExcel()
   {
      // Ambil data dari database
      $this->db->select('*');
      $this->db->from('izin');
      $this->db->join('karyawan', 'karyawan.user_id = izin.user_id');
      $query = $this->db->get();
      $data = $query->result_array();

      // Buat objek Spreadsheet
      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();

      // Buat header untuk Excel
      $sheet->setCellValue('A1', 'NIK');
      $sheet->setCellValue('B1', 'NAMA');
      $sheet->setCellValue('C1', 'TANGGAL AWAL');
      $sheet->setCellValue('D1', 'TANGGAL AKHIR');
      $sheet->setCellValue('E1', 'KETERANGAN');
      $sheet->setCellValue('F1', 'LAMPIRAN');
      $sheet->setCellValue('G1', 'TANGGAL PENGAJUAN');
      $sheet->setCellValue('H1', 'STATUS');

      // Tambahkan gaya ke header
      $headerStyle = [
         'font' => ['bold' => true],
         'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
         'borders' => ['outline' => ['borderStyle' => Border::BORDER_THIN]],
         'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['rgb' => 'FFFF00']],
      ];
      $sheet->getStyle('A1:H1')->applyFromArray($headerStyle);

      // Masukkan data laporan absen ke dalam Excel
      $row = 2;
      foreach ($data as $item) {
         $sheet->setCellValue('A' . $row, $item['id_karyawan']);
         $sheet->setCellValue('B' . $row, $item['nama_karyawan']);
         $sheet->setCellValue('C' . $row, $item['tgl_awal']);
         $sheet->setCellValue('D' . $row, $item['tgl_akhir']);
         $sheet->setCellValue('E' . $row, $item['keterangan']);
         $sheet->setCellValue('F' . $row, $item['bukti']);
         $sheet->setCellValue('G' . $row, $item['created_at']);

         // Ganti angka status dengan label sesuai logika Anda
         $statusLabel = '';
         switch ($item['status_izin']) {
            case '0':
               $statusLabel = 'Menunggu';
               break;
            case '1':
               $statusLabel = 'Diterima';
               break;
            case '2':
               $statusLabel = 'Ditolak';
               break;
         }

         $sheet->setCellValue('H' . $row, $statusLabel);
         $row++;
      }

      // Mengatur lebar kolom agar sesuai dengan isi
      $sheet->getColumnDimension('A')->setAutoSize(true);
      $sheet->getColumnDimension('B')->setAutoSize(true);
      $sheet->getColumnDimension('C')->setAutoSize(true);
      $sheet->getColumnDimension('D')->setAutoSize(true);
      $sheet->getColumnDimension('E')->setAutoSize(true);
      $sheet->getColumnDimension('F')->setAutoSize(true);
      $sheet->getColumnDimension('G')->setAutoSize(true);
      $sheet->getColumnDimension('H')->setAutoSize(true);

      // Atur header untuk file Excel
      $filename = 'laporan_izin.xlsx';
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment;filename="' . $filename . '"');
      header('Cache-Control: max-age=0');

      // Eksport file Excel
      $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
      $writer->save('php://output');
   }
}
