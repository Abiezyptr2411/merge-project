<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class Report_mutasi extends CI_Controller
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
        $data['title'] = "Laporan Mutasi Barang";
        $data['product'] = $this->db->query("SELECT * FROM barang")->result();

        $this->load->view('layout/admin/header', $data);
        $this->load->view('admin/report_mutasi', $data);
        $this->load->view('layout/admin/footer');
    }

    public function filter()
    {
        $data['title'] = "Laporan Mutasi Barang";
        $data['product'] = $this->db->query("SELECT * FROM barang")->result();
        $data['id_brg'] = $this->input->post('id_brg'); // Menambahkan id_brg ke data

        $this->db->select('b.id_brg, b.nama_brg, COALESCE(SUM(bm.jumlah), 0) AS jumlah_masuk, COALESCE(SUM(bk.jumlah), 0) AS jumlah_keluar, (COALESCE(SUM(bm.jumlah), 0) - COALESCE(SUM(bk.jumlah), 0)) AS saldo, bm.created_at as date_in, bk.created_at as date_out');
        $this->db->from('barang AS b');
        $this->db->join('barang_masuk AS bm', 'b.id_brg = bm.id_brg', 'left');
        $this->db->join('barang_keluar AS bk', 'b.id_brg = bk.id_brg', 'left');
        $this->db->group_by('b.id_brg, b.nama_brg');

        // Tambahkan kondisi WHERE untuk id_brg jika tidak kosong
        if (!empty($data['id_brg'])) {
            $this->db->where('b.id_brg', $data['id_brg']);
        }

        $query = $this->db->get();
        $data['reportMut'] = $query->result();

        $this->load->view('layout/admin/header', $data);
        $this->load->view('admin/result_laporan_mutasi', $data);
        $this->load->view('layout/admin/footer');
    }


    public function exportExcel()
    {
        $id_brg = $this->uri->segment(4);

        $this->db->select('b.id_brg, b.nama_brg, COALESCE(SUM(bm.jumlah), 0) AS jumlah_masuk, COALESCE(SUM(bk.jumlah), 0) AS jumlah_keluar, (COALESCE(SUM(bm.jumlah), 0) - COALESCE(SUM(bk.jumlah), 0)) AS saldo, bm.created_at as date_in, bk.created_at as date_out');
        $this->db->from('barang AS b');
        $this->db->join('barang_masuk AS bm', 'b.id_brg = bm.id_brg', 'left');
        $this->db->join('barang_keluar AS bk', 'b.id_brg = bk.id_brg', 'left');
        $this->db->group_by('b.id_brg, b.nama_brg');

        // Tambahkan kondisi WHERE untuk id_brg jika tidak kosong
        if (!empty($id_brg)) {
            $this->db->where('b.id_brg', $id_brg);
        }

        $query = $this->db->get();
        $data = $query->result_array();

        // Buat objek Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Buat header untuk Excel
        $sheet->setCellValue('A1', 'BARANG ID');
        $sheet->setCellValue('B1', 'NAMA BARANG');
        $sheet->setCellValue('C1', 'TGL BARANG MASUK');
        $sheet->setCellValue('D1', 'JUMLAH MASUK');
        $sheet->setCellValue('E1', 'TGL BARANG KELUAR');
        $sheet->setCellValue('F1', 'JUMLAH KELUAR');
        $sheet->setCellValue('G1', 'SALDO (STOK)');

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
            $sheet->setCellValue('A' . $row, $item['id_brg']);
            $sheet->setCellValue('B' . $row, $item['nama_brg']);
            $sheet->setCellValue('C' . $row, $item['date_in']);
            $sheet->setCellValue('D' . $row, $item['jumlah_masuk']);
            $sheet->setCellValue('E' . $row, $item['date_out']);
            $sheet->setCellValue('F' . $row, $item['jumlah_keluar']);
            $sheet->setCellValue('G' . $row, $item['saldo']);
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

        // Atur header untuk file Excel
        $filename = 'laporan_mutasi_barang.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Eksport file Excel
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }
}
