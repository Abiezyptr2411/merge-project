<?php

use Dompdf\Dompdf;
use Dompdf\Options;

class Payslip extends CI_Controller
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
      $data['title'] = "Payroll";
      $data['data'] = $this->db->query("SELECT * FROM payroll
        LEFT JOIN karyawan ON karyawan.id_karyawan = payroll.id_karyawan
        LEFT JOIN jabatan ON jabatan.id_jabatan = payroll.id_jabatan
        LEFT JOIN departement ON departement.id_departement = payroll.id_departement
        ORDER BY payroll.id_pembayaran DESC")->result();
      $this->load->view('layout/admin/header', $data);
      $this->load->view('admin/list_gaji', $data);
      $this->load->view('layout/admin/footer');
   }

   public function hitung_gaji()
   {
      $data['title'] = "Hitung Gaji";
      $data['karyawan'] = $this->model->get('karyawan')->result();
      $data['jabatan'] = $this->model->get('jabatan')->result();
      $data['departement'] = $this->model->get('departement')->result();

      $this->load->view('layout/admin/header', $data);
      $this->load->view('admin/hitung_gaji', $data);
      $this->load->view('layout/admin/footer');
   }

   public function getKaryawanDetail($id_karyawan)
   {
      // Misalkan tabel karyawan Anda adalah "karyawan" dan tabel jabatan dan departemen adalah "jabatan" dan "departemen"
      $this->db->select('users.user_id, jabatan.nama_jabatan, departement.nama_departement, karyawan.id_departement AS id_dept, karyawan.id_jabatan, jabatan.gaji_pokok, jabatan.tunjangan_jabatan, jabatan.tunjangan_makan, jabatan.tunjangan_aktifitas, karyawan.id_karyawan, jabatan.tipe_pajak, jabatan.nominal_pajak, jabatan.bpjs, lembur.jam_mulai, lembur.jam_akhir');
      $this->db->from('karyawan');
      $this->db->join('jabatan', 'karyawan.id_jabatan = jabatan.id_jabatan');
      $this->db->join('departement', 'karyawan.id_departement = departement.id_departement');
      $this->db->join('users', 'karyawan.user_id = users.user_id');
      $this->db->where('karyawan.id_karyawan', $id_karyawan);

      // Gabungkan dengan tabel "lembur" untuk menghitung upah lembur
      $this->db->join('lembur', 'karyawan.user_id = lembur.user_id');

      // Hitung total jam lembur
      $this->db->select('SUM(TIMESTAMPDIFF(SECOND, lembur.jam_mulai, lembur.jam_akhir)) as total_jam_lembur', false);

      $data = $this->db->get()->row();

      // Gantilah ini dengan tarif upah lembur per jam yang sesuai
      $tarif_upah_lembur_per_jam = 50000; // Ganti dengan tarif upah lembur per jam yang sesuai

      // Hitung upah lembur berdasarkan total jam lembur dan tarif upah lembur per jam
      $total_upah_lembur = ($data->total_jam_lembur / 3600) * $tarif_upah_lembur_per_jam;

      // Masukkan nilai total upah lembur ke dalam data
      $data->total_upah_lembur = $total_upah_lembur;

      // Format data sebagai JSON
      header('Content-Type: application/json');
      echo json_encode($data);
   }


   public function proses()
   {
      $id_pembayaran = $this->input->post('id_pembayaran');
      $user_id = $this->input->post('user_id');
      $id_karyawan = $this->input->post('id_karyawan');
      $tanggal_pembayaran = $this->input->post('tanggal_pembayaran');
      $tanggal_penggajian = $this->input->post('tanggal_penggajian');
      $id_jabatan = $this->input->post('id_jabatan');
      $id_departement = $this->input->post('id_departement');
      $gaji_pokok = $this->input->post('gaji_pokok');
      $upah_lembur = $this->input->post('upah_lembur');
      $tunjangan_aktivitas = $this->input->post('tunjangan_aktivitas');
      $qty = $this->input->post('qty');
      $tunjangan_jabatan = $this->input->post('tunjangan_jabatan');
      $tunjangan_makan = $this->input->post('tunjangan_makan');
      $pph23 = $this->input->post('pph23');
      $bpjs = $this->input->post('bpjs');
      $pinjaman = $this->input->post('pinjaman');
      $keterangan_pembayaran = $this->input->post('keterangan_pembayaran');

      // Hitung Total Take-Home Pay (THP)
      $thp = $gaji_pokok + $upah_lembur + $tunjangan_aktivitas + $tunjangan_jabatan + $tunjangan_makan - $pph23 - $bpjs - $pinjaman;

      // Data yang akan disimpan ke dalam database
      $data = array(
         'id_pembayaran'        => $id_pembayaran,
         'user_id'        => $user_id,
         'id_karyawan'  => $id_karyawan,
         'tanggal_pembayaran'  => $tanggal_pembayaran,
         'tanggal_penggajian'  => $tanggal_penggajian,
         'id_jabatan'  => $id_jabatan,
         'id_departement'  => $id_departement,
         'gaji_pokok'  => $gaji_pokok,
         'upah_lembur'  => $upah_lembur,
         'tunjangan_aktivitas'  => $tunjangan_aktivitas * $qty,
         'qty'                  => $qty,
         'tunjangan_jabatan'  => $tunjangan_jabatan,
         'tunjangan_makan'  => $tunjangan_makan,
         'pph23'  => $pph23,
         'bpjs'  => $bpjs,
         'pinjaman'  => $pinjaman,
         'thp'  => $thp,
         'keterangan_pembayaran'  => $keterangan_pembayaran,
      );

      $this->db->insert('payroll', $data);

      $this->session->set_flashdata('success', 'Berhasil membuat slip gaji karyawan');
      redirect('admin/payslip');
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
      $pdf_html = $this->load->view('admin/cetak_gaji', $data, true);

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
}
