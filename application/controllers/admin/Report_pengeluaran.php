<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class Report_pengeluaran extends CI_Controller
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
        $data['title'] = "Laporan Pengeluaran Barang";

        $this->load->view('layout/admin/header', $data);
        $this->load->view('admin/report_pengeluaran', $data);
        $this->load->view('layout/admin/footer');
    }

    public function filter()
    {
        $data['title'] = "Laporan Pengeluaran Barang";
        $tanggal_awal = $this->input->post('created_at');
        $tanggal_akhir = $this->input->post('created_at');

        $this->db->select('barang_keluar.*, barang_keluar.status as status_barang_keluar, karyawan.nama_karyawan, jabatan.nama_jabatan, departement.nama_departement, barang.id_brg, barang.nama_brg');
        $this->db->from('barang_keluar');
        $this->db->join('barang', 'barang.id_brg = barang_keluar.id_brg', 'left');
        $this->db->join('karyawan', 'karyawan.id_karyawan = barang_keluar.id_karyawan', 'left');
        $this->db->join('jabatan', 'jabatan.id_jabatan = karyawan.id_jabatan', 'left');
        $this->db->join('departement', 'departement.id_departement = karyawan.id_departement', 'left');
        $this->db->order_by('barang_keluar.created_at', 'desc');

        // Tambahkan kondisi WHERE untuk tanggal jika tidak kosong
        if (!empty($tanggal_awal) && !empty($tanggal_akhir)) {
            $tanggal_awal = date('Y-m-d', strtotime($tanggal_awal));
            $tanggal_akhir = date('Y-m-d', strtotime($tanggal_akhir));
            $this->db->where('created_at >=', $tanggal_awal);
            $this->db->where('created_at <=', $tanggal_akhir);
        }

        $query = $this->db->get();
        $data['reportOut'] = $query->result();

        // Muat view laporan absen dengan data yang sudah difilter
        $this->load->view('layout/admin/header', $data);
        $this->load->view('admin/result_laporan_pengeluaran', $data);
        $this->load->view('layout/admin/footer');
    }

    public function exportExcel()
    {
        // Ambil data dari database
        $this->db->select('barang_keluar.*, barang_keluar.status as status_barang_keluar, karyawan.nama_karyawan, jabatan.nama_jabatan, departement.nama_departement, barang.id_brg, barang.nama_brg');
        $this->db->from('barang_keluar');
        $this->db->join('barang', 'barang.id_brg = barang_keluar.id_brg', 'left');
        $this->db->join('karyawan', 'karyawan.id_karyawan = barang_keluar.id_karyawan', 'left');
        $this->db->join('jabatan', 'jabatan.id_jabatan = karyawan.id_jabatan', 'left');
        $this->db->join('departement', 'departement.id_departement = karyawan.id_departement', 'left');
        $this->db->order_by('barang_keluar.created_at', 'desc');
        $query = $this->db->get();
        $data = $query->result_array();

        // Buat objek Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Buat header untuk Excel
        $sheet->setCellValue('A1', 'INVOICE ID');
        $sheet->setCellValue('B1', 'NAMA PEMINJAM');
        $sheet->setCellValue('C1', 'NAMA DEPARTEMENT');
        $sheet->setCellValue('D1', 'BARANG ID');
        $sheet->setCellValue('E1', 'NAMA BARANG');
        $sheet->setCellValue('F1', 'JUMLAH');
        $sheet->setCellValue('G1', 'STATUS');
        $sheet->setCellValue('H1', 'TGL KELUAR BARANG');

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
            $sheet->setCellValue('A' . $row, $item['invoice_number']);
            $sheet->setCellValue('B' . $row, $item['nama_karyawan']);
            $sheet->setCellValue('C' . $row, $item['nama_departement']);
            $sheet->setCellValue('D' . $row, $item['id_brg']);
            $sheet->setCellValue('E' . $row, $item['nama_brg']);
            $sheet->setCellValue('F' . $row, $item['jumlah']);
            $sheet->setCellValue('H' . $row, $item['created_at']);

            // Ganti angka status dengan label sesuai logika Anda
            $statusLabel = '';
            switch ($item['status_barang_keluar']) {
                case 'success':
                    $statusLabel = 'Berhasil';
                    break;
                case 'failed':
                    $statusLabel = 'Gagal';
                    break;
            }

            $sheet->setCellValue('G' . $row, $statusLabel);
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
        $filename = 'laporan_pengeluaran_barang.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Eksport file Excel
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }
}
