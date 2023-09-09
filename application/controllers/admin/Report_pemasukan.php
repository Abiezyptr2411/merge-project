<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class Report_pemasukan extends CI_Controller
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
        $data['title'] = "Laporan Pemasukan Barang";

        $this->load->view('layout/admin/header', $data);
        $this->load->view('admin/report_pemasukan', $data);
        $this->load->view('layout/admin/footer');
    }

    public function filter()
    {
        $data['title'] = "Laporan Pemasukan Barang";
        $tanggal_awal = $this->input->post('created_at');
        $tanggal_akhir = $this->input->post('created_at');

        $this->db->select('barang_masuk.*, barang_masuk.status as status_barang_masuk, barang.id_brg, barang.nama_brg');
        $this->db->from('barang_masuk');
        $this->db->join('barang', 'barang.id_brg = barang_masuk.id_brg', 'left');
        $this->db->order_by('barang_masuk.created_at', 'desc');

        // Tambahkan kondisi WHERE untuk tanggal jika tidak kosong
        if (!empty($tanggal_awal) && !empty($tanggal_akhir)) {
            $tanggal_awal = date('Y-m-d', strtotime($tanggal_awal));
            $tanggal_akhir = date('Y-m-d', strtotime($tanggal_akhir));
            $this->db->where('created_at >=', $tanggal_awal);
            $this->db->where('created_at <=', $tanggal_akhir);
        }

        $query = $this->db->get();
        $data['reportIn'] = $query->result();

        // Muat view laporan absen dengan data yang sudah difilter
        $this->load->view('layout/admin/header', $data);
        $this->load->view('admin/result_laporan_pemasukan', $data);
        $this->load->view('layout/admin/footer');
    }

    public function exportExcel()
    {
        // Ambil data dari database
        $this->db->select('barang_masuk.*, barang_masuk.status as status_barang_masuk, barang.id_brg, barang.nama_brg');
        $this->db->from('barang_masuk');
        $this->db->join('barang', 'barang.id_brg = barang_masuk.id_brg', 'left');
        $this->db->order_by('barang_masuk.created_at', 'desc');
        $query = $this->db->get();
        $data = $query->result_array();

        // Buat objek Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Buat header untuk Excel
        $sheet->setCellValue('A1', 'BARANG ID');
        $sheet->setCellValue('B1', 'NAMA BARANG');
        $sheet->setCellValue('C1', 'TANGGAL MASUK BARANG');
        $sheet->setCellValue('D1', 'QTY');
        $sheet->setCellValue('E1', 'STATUS');

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
            $sheet->setCellValue('C' . $row, $item['created_at']);
            $sheet->setCellValue('D' . $row, $item['jumlah']);

            // Ganti angka status dengan label sesuai logika Anda
            $statusLabel = '';
            switch ($item['status_barang_masuk']) {
                case 'success':
                    $statusLabel = 'Berhasil';
                    break;
                case 'failed':
                    $statusLabel = 'Gagal';
                    break;
            }

            $sheet->setCellValue('E' . $row, $statusLabel);
            $row++;
        }

        // Mengatur lebar kolom agar sesuai dengan isi
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);

        // Atur header untuk file Excel
        $filename = 'laporan_pemasukan_barang.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Eksport file Excel
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }
}
