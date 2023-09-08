<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class Barang extends CI_Controller
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
      $data['title'] = 'List Barang';

      $this->db->select('*');
      $this->db->from('barang');
      $this->db->join('kategori', 'kategori.id_kategori = barang.id_kategori');
      $this->db->join('unit', 'unit.id_unit = barang.id_unit');
      $this->db->order_by('created_at', 'desc');
      $data['barang'] = $this->db->get()->result();

      $this->load->view('layout/admin/header', $data);
      $this->load->view('admin/barang', $data);
      $this->load->view('layout/admin/footer');
   }

   public function add()
   {
      $data['title'] = 'Tambah Barang';

      $data['kategori'] = $this->model->get('kategori')->result();
      $data['unit'] = $this->model->get('unit')->result();

      $this->load->view('layout/admin/header', $data);
      $this->load->view('admin/addbarang', $data);
      $this->load->view('layout/admin/footer');
   }

   public function proses()
   {
      // Ambil data dari form atau request
      $id_brg = $this->input->post('id_brg');
      $id_kategori = $this->input->post('id_kategori');
      $id_unit = $this->input->post('id_unit');
      $nama_brg = $this->input->post('nama_brg');
      $harga = $this->input->post('harga');
      $kondisi = $this->input->post('kondisi');

      // Data untuk tabel 'karyawan' termasuk id_user
      $data = array(
         'id_brg' => $id_brg,
         'id_kategori' => $id_kategori,
         'id_unit' => $id_unit,
         'nama_brg' => $nama_brg,
         'harga' => $harga,
         'kondisi' => $kondisi,
      );

      // Simpan data karyawan ke tabel karyawan
      $this->db->insert('barang', $data);

      // Redirect atau berikan respons sesuai kebutuhan Anda
      $this->session->set_flashdata('success', 'Data inventaris berhasil ditambah');
      redirect('admin/barang');
   }

   public function update($id)
   {
      $data['title'] = 'Update Barang';

      $data['kategori'] = $this->model->get('kategori')->result();
      $data['unit'] = $this->model->get('unit')->result();

      $where = array('id_brg' => $id);

      $this->db->select('*');
      $this->db->from('barang');
      $this->db->join('kategori', 'kategori.id_kategori = barang.id_kategori');
      $this->db->join('unit', 'unit.id_unit = barang.id_unit');
      $this->db->where('barang.id_brg', $id);
      $data['barang'] = $this->db->get()->row();

      $this->load->view('layout/admin/header', $data);
      $this->load->view('admin/updatebarang', $data);
      $this->load->view('layout/admin/footer');
   }


   public function proses_ubah()
   {
      $id_brg = $this->input->post('id_brg');
      $id_kategori = $this->input->post('id_kategori');
      $id_unit = $this->input->post('id_unit');
      $nama_brg = $this->input->post('nama_brg');
      $harga = $this->input->post('harga');
      $kondisi = $this->input->post('kondisi');

      $data = array(
         'id_kategori' => $id_kategori,
         'id_unit' => $id_unit,
         'nama_brg' => $nama_brg,
         'harga' => $harga,
         'kondisi' => $kondisi,
      );

      $where = array(
         'id_brg' => $id_brg
      );

      $this->model->update('barang', $data, $where);

      $this->session->set_flashdata('success', 'Data inventaris berhasil diubah');
      redirect('admin/barang');
   }

   public function delete($id)
   {
      $where = array('id_brg' => $id);
      $this->model->delete($where, 'barang');

      $this->session->set_flashdata('success', 'Data inventaris berhasil dihapus');
      redirect('admin/barang');
   }

   public function exportExcel()
   {
      // Ambil data dari database
      $this->db->select('*');
      $this->db->from('barang');
      $this->db->join('kategori', 'kategori.id_kategori = barang.id_kategori');
      $this->db->join('unit', 'unit.id_unit = barang.id_unit');
      $this->db->order_by('created_at', 'desc');
      $query = $this->db->get();
      $data = $query->result_array();

      // Buat objek Spreadsheet
      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();

      // Buat header untuk Excel
      $sheet->setCellValue('A1', 'KODE');
      $sheet->setCellValue('B1', 'KATEGORI');
      $sheet->setCellValue('C1', 'MEREK');
      $sheet->setCellValue('D1', 'HARGA');
      $sheet->setCellValue('E1', 'JUMLAH');
      $sheet->setCellValue('F1', 'KONDISI');
      $sheet->setCellValue('G1', 'LOKASI');
      $sheet->setCellValue('H1', 'TANGGAL INPUT');

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
         $sheet->setCellValue('B' . $row, $item['nama_kategori']);
         $sheet->setCellValue('C' . $row, $item['nama_brg']);
         $sheet->setCellValue('D' . $row, $item['harga']);
         $sheet->setCellValue('E' . $row, $item['stok']);
         $sheet->setCellValue('F' . $row, $item['kondisi']);
         $sheet->setCellValue('G' . $row, $item['nama_unit']);
         $sheet->setCellValue('H' . $row, $item['created_at']);
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
      $filename = 'all_barang.xlsx';
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment;filename="' . $filename . '"');
      header('Cache-Control: max-age=0');

      // Eksport file Excel
      $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
      $writer->save('php://output');
   }
}
