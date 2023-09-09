<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class Report_permintaan extends CI_Controller
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
        $data['title'] = "Laporan Permintaan Barang";

        $this->load->view('layout/admin/header', $data);
        $this->load->view('admin/report_permintaan', $data);
        $this->load->view('layout/admin/footer');
    }

    public function filter()
    {
        $data['title'] = "Laporan Permintaan Barang";
        $tanggal_awal = $this->input->post('created_at');
        $tanggal_akhir = $this->input->post('created_at');

        $this->db->select('permintaan.*, karyawan.nama_karyawan, users.user_id, barang.nama_brg, permintaan.status as status_permintaan');
        $this->db->from('permintaan');
        $this->db->join('users', 'users.user_id = permintaan.user_id', 'left');
        $this->db->join('karyawan', 'karyawan.user_id = users.user_id', 'left');
        $this->db->join('barang', 'barang.id_brg = permintaan.id_brg', 'left');
        $this->db->order_by('permintaan.created_at', 'desc');

        // Tambahkan kondisi WHERE untuk tanggal jika tidak kosong
        if (!empty($tanggal_awal) && !empty($tanggal_akhir)) {
            $tanggal_awal = date('Y-m-d', strtotime($tanggal_awal));
            $tanggal_akhir = date('Y-m-d', strtotime($tanggal_akhir));
            $this->db->where('created_at >=', $tanggal_awal);
            $this->db->where('created_at <=', $tanggal_akhir);
        }

        $query = $this->db->get();
        $data['reportReq'] = $query->result();

        // Muat view laporan absen dengan data yang sudah difilter
        $this->load->view('layout/admin/header', $data);
        $this->load->view('admin/result_laporan_permintaan', $data);
        $this->load->view('layout/admin/footer');
    }

    public function exportExcel()
    {
        // Ambil data dari database
        $this->db->select('permintaan.*, karyawan.nama_karyawan, users.user_id, barang.nama_brg, permintaan.status as status_permintaan');
        $this->db->from('permintaan');
        $this->db->join('users', 'users.user_id = permintaan.user_id', 'left');
        $this->db->join('karyawan', 'karyawan.user_id = users.user_id', 'left');
        $this->db->join('barang', 'barang.id_brg = permintaan.id_brg', 'left');
        $this->db->order_by('permintaan.created_at', 'desc');
        $query = $this->db->get();
        $data = $query->result_array();

        // Buat objek Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Buat header untuk Excel
        $sheet->setCellValue('A1', 'NAMA KARYAWAN');
        $sheet->setCellValue('B1', 'NAMA BARANG');
        $sheet->setCellValue('C1', 'QTY');
        $sheet->setCellValue('D1', 'TGL PENGAJUAN BARANG');
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
            $sheet->setCellValue('A' . $row, $item['nama_karyawan']);
            $sheet->setCellValue('B' . $row, $item['nama_brg']);
            $sheet->setCellValue('C' . $row, $item['qty']);
            $sheet->setCellValue('D' . $row, $item['created_at']);

            // Ganti angka status dengan label sesuai logika Anda
            $statusLabel = '';
            switch ($item['status_permintaan']) {
                case 'waiting confirm':
                    $statusLabel = 'Menunggu Konfirmasi';
                    break;
                case 'accepted':
                    $statusLabel = 'Disetujui';
                    break;
                case 'rejected':
                    $statusLabel = 'Ditolak';
                    break;
                case 'return':
                    $statusLabel = 'Barang Kembali';
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
        $filename = 'laporan_permintaan_barang.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Eksport file Excel
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }
}
