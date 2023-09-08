<?php

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;


class Absen_daily extends CI_Controller
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
      $data['title'] = "Riwayat Absensi";

      $id = $this->session->userdata('user_id');

      $data['absen'] = $this->db->query("SELECT * FROM absen
        INNER JOIN karyawan ON karyawan.user_id = absen.user_id
        WHERE absen.user_id='$id'
        ORDER BY absen.id_absen DESC")->result();

      $this->load->view('layout/pegawai/header', $data);
      $this->load->view('pegawai/riwayat_absen', $data);
      $this->load->view('layout/pegawai/footer');
   }

   public function export()
   {
      $id = $this->session->userdata('user_id');

      $this->db->select('*');
      $this->db->from('absen');
      $this->db->join('karyawan', 'karyawan.user_id = absen.user_id');
      $this->db->where('absen.user_id', $id); // Menambahkan WHERE clause
      $query = $this->db->get();
      $data = $query->result_array();

      // Buat objek Spreadsheet
      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();

      // Buat header untuk Excel
      $sheet->setCellValue('A1', 'TANGGAL');
      $sheet->setCellValue('B1', 'NIK');
      $sheet->setCellValue('C1', 'NAMA');
      $sheet->setCellValue('D1', 'WAKTU KERJA');
      $sheet->setCellValue('E1', 'KONDISI');
      $sheet->setCellValue('F1', 'AKTIVITAS');
      $sheet->setCellValue('G1', 'WAKTU ABSEN');
      $sheet->setCellValue('H1', 'LOKASI');
      $sheet->setCellValue('I1', 'KETERANGAN');

      // Tambahkan gaya ke header
      $headerStyle = [
         'font' => ['bold' => true],
         'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
         'borders' => ['outline' => ['borderStyle' => Border::BORDER_THIN]],
         'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['rgb' => 'FFFF00']],
      ];
      $sheet->getStyle('A1:I1')->applyFromArray($headerStyle);

      // Masukkan data laporan absen ke dalam Excel
      $row = 2;
      foreach ($data as $item) {
         $sheet->setCellValue('A' . $row, $item['estimated']);
         $sheet->setCellValue('B' . $row, $item['id_karyawan']);
         $sheet->setCellValue('C' . $row, $item['nama_karyawan']);
         $sheet->setCellValue('D' . $row, $item['shift_line']);
         $sheet->setCellValue('E' . $row, $item['kondisi_kesehatan']);
         $sheet->setCellValue('F' . $row, $item['aktivitas']);
         $sheet->setCellValue('G' . $row, $item['waktu']);
         $sheet->setCellValue('H' . $row, $item['lokasi_kerja']);
         $sheet->setCellValue('I' . $row, $item['keterangan']);
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
      $sheet->getColumnDimension('I')->setAutoSize(true);

      // Atur header untuk file Excel
      $filename = 'laporan_absen.xlsx';
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment;filename="' . $filename . '"');
      header('Cache-Control: max-age=0');

      // Eksport file Excel
      $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
      $writer->save('php://output');
   }
}
