<?php

use Dompdf\Dompdf;
use Dompdf\Options;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class Payslip extends CI_Controller
{

   public function __construct()
   {
      parent::__construct();

      $this->load->helper(array('form', 'url'));
      $this->load->library('form_validation');
      $this->load->model(array('Model'));

      if ($this->session->userdata('role') != '3') {

         redirect('login');
      }
      date_default_timezone_set('asia/jakarta');
   }

   public function index()
   {
      $data['title'] = "Slip Gaji Karyawan";

      $id = $this->session->userdata('user_id');

      $data['data'] = $this->db->query("SELECT * FROM payroll
        LEFT JOIN karyawan ON karyawan.id_karyawan = payroll.id_karyawan
        LEFT JOIN jabatan ON jabatan.id_jabatan = payroll.id_jabatan
        LEFT JOIN departement ON departement.id_departement = payroll.id_departement
        WHERE payroll.user_id='$id'
        ORDER BY payroll.id_pembayaran DESC")->result();

      $this->load->view('layout/pegawai/header', $data);
      $this->load->view('pegawai/list_gaji', $data);
      $this->load->view('layout/pegawai/footer');
   }

   public function exportToPDF($id)
   {
      // Fetch data from the database, similar to your 'view' function
      $data['view'] = $this->db->query("SELECT * FROM payroll
        LEFT JOIN karyawan ON karyawan.id_karyawan = payroll.id_karyawan
        LEFT JOIN jabatan ON jabatan.id_jabatan = payroll.id_jabatan
        LEFT JOIN departement ON departement.id_departement = payroll.id_departement
        WHERE payroll.id_pembayaran='$id'")->result();

      // Load the PDF view
      $pdf_html = $this->load->view('pegawai/cetak_gaji', $data, true);

      // Create DOMPDF options
      $options = new Options();
      $options->set('defaultFont', 'Helvetica'); // Set default font (optional)

      // Create a DOMPDF instance
      $pdf = new Dompdf($options);

      // Load HTML content for the PDF
      $pdf->loadHtml($pdf_html);

      // Set paper size and orientation (optional)
      $pdf->setPaper('A4', 'portrait');

      // Render the PDF (optional)
      $pdf->render();

      // Set the filename for the PDF file
      $filename = 'slip_gaji.pdf';

      // Stream the PDF to the browser for download
      $pdf->stream($filename, array('Attachment' => 0));
   }

   public function export()
   {
      $id = $this->session->userdata('user_id');

      // Ambil data dari database
      $this->db->select('*');
      $this->db->from('payroll');
      $this->db->join('karyawan', 'karyawan.user_id = payroll.user_id');
      $this->db->join('jabatan', 'jabatan.id_jabatan = payroll.id_jabatan');
      $this->db->join('departement', 'departement.id_departement = payroll.id_departement');
      $this->db->where('payroll.user_id', $id);

      $query = $this->db->get();
      $data = $query->result_array();

      // Buat objek Spreadsheet
      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();

      // Buat header untuk Excel
      $sheet->setCellValue('A1', 'TANGGAL');
      $sheet->setCellValue('B1', 'NIK');
      $sheet->setCellValue('C1', 'NAMA');
      $sheet->setCellValue('D1', 'JABATAN');
      $sheet->setCellValue('E1', 'DEPARTEMENT');
      $sheet->setCellValue('F1', 'NOMOR PEMBAYARAN');
      $sheet->setCellValue('G1', 'GAJI POKOK');
      $sheet->setCellValue('H1', 'GAJI JABATAN');
      $sheet->setCellValue('I1', 'TUNJANGAN MAKAN');
      $sheet->setCellValue('J1', 'TUNJANGAN AKTIVITAS');
      $sheet->setCellValue('K1', 'UPAH LEMBUR');
      $sheet->setCellValue('L1', 'POTONGAN PAJAK');
      $sheet->setCellValue('M1', 'POTONGAN BPJS');
      $sheet->setCellValue('N1', 'PINJAMAN');
      $sheet->setCellValue('O1', 'TOTAL');

      // Tambahkan gaya ke header
      $headerStyle = [
         'font' => ['bold' => true],
         'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
         'borders' => ['outline' => ['borderStyle' => Border::BORDER_THIN]],
         'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['rgb' => 'FFFF00']],
      ];
      $sheet->getStyle('A1:O1')->applyFromArray($headerStyle);

      // Masukkan data laporan absen ke dalam Excel
      $row = 2;
      foreach ($data as $item) {
         $sheet->setCellValue('A' . $row, $item['tanggal_pembayaran']);
         $sheet->setCellValue('B' . $row, $item['id_karyawan']);
         $sheet->setCellValue('C' . $row, $item['nama_karyawan']);
         $sheet->setCellValue('D' . $row, $item['nama_jabatan']);
         $sheet->setCellValue('E' . $row, $item['nama_departement']);
         $sheet->setCellValue('F' . $row, $item['id_pembayaran']);
         $sheet->setCellValue('G' . $row, $item['gaji_pokok']);
         $sheet->setCellValue('H' . $row, $item['tunjangan_jabatan']);
         $sheet->setCellValue('I' . $row, $item['tunjangan_makan']);
         $sheet->setCellValue('J' . $row, $item['tunjangan_aktivitas']);
         $sheet->setCellValue('K' . $row, $item['upah_lembur']);
         $sheet->setCellValue('L' . $row, $item['pph23']);
         $sheet->setCellValue('M' . $row, $item['bpjs']);
         $sheet->setCellValue('N' . $row, $item['pinjaman']);
         $sheet->setCellValue('O' . $row, $item['thp']);
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
      $sheet->getColumnDimension('J')->setAutoSize(true);
      $sheet->getColumnDimension('K')->setAutoSize(true);
      $sheet->getColumnDimension('L')->setAutoSize(true);
      $sheet->getColumnDimension('M')->setAutoSize(true);
      $sheet->getColumnDimension('N')->setAutoSize(true);
      $sheet->getColumnDimension('O')->setAutoSize(true);

      // Atur header untuk file Excel
      $filename = 'laporan_payroll.xlsx';
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment;filename="' . $filename . '"');
      header('Cache-Control: max-age=0');

      // Eksport file Excel
      $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
      $writer->save('php://output');
   }
}
