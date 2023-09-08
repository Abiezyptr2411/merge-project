<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model extends CI_Model
{

   public function cek_auth($email_or_username, $password)
   {
      $this->db->where("(email='$email_or_username' OR username='$email_or_username')", NULL, FALSE);
      $this->db->where('password', md5($password));
      $this->db->limit(1);
      $result = $this->db->get('users');

      if ($result->num_rows() > 0) {
         return $result->row();
      } else {
         return FALSE;
      }
   }

   public function get($table)
   {
      return $this->db->get($table);
   }

   public function insert($data, $table)
   {
      $this->db->insert($table, $data);
   }

   public function update($table, $data, $where)
   {
      $this->db->update($table, $data, $where);
   }

   public function delete($where, $table)
   {
      $this->db->where($where);
      $this->db->delete($table);
   }

   public function detail_pegawai($id = NULL)
   {
      $query = $this->db->get_where('karyawan', array('id_karyawan' => $id))->row();
      return $query;
   }

   function absendaily($id, $tahun, $bulan, $hari)
   {
      $this->db->select('*');
      $this->db->from('absen');
      $this->db->where('user_id', $id);
      $this->db->where('year(waktu)', $tahun);
      $this->db->where('month(waktu)', $bulan);
      $this->db->where('day(waktu)', $hari);
      return $this->db->get();
   }

   function hari($hari)
   {

      switch ($hari) {
         case 'Sun':
            $hari_ini = "Minggu";
            break;

         case 'Mon':
            $hari_ini = "Senin";
            break;

         case 'Tue':
            $hari_ini = "Selasa";
            break;

         case 'Wed':
            $hari_ini = "Rabu";
            break;

         case 'Thu':
            $hari_ini = "Kamis";
            break;

         case 'Fri':
            $hari_ini = "Jumat";
            break;

         case 'Sat':
            $hari_ini = "Sabtu";
            break;

         default:
            $hari_ini = "Tidak di ketahui";
            break;
      }

      return $hari_ini;
   }
   function tgl_indo($tanggal)
   {
      $bulan = array(
         1 =>   'Januari',
         'Februari',
         'Maret',
         'April',
         'Mei',
         'Juni',
         'Juli',
         'Agustus',
         'September',
         'Oktober',
         'November',
         'Desember'
      );
      $pecahkan = explode('-', $tanggal);

      return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
   }

   // Model untuk menghasilkan nomor invoice berikutnya
   public function get_next_invoice_number()
   {
      // Ambil nomor invoice terakhir dari database
      $this->db->select('invoice_number');
      $this->db->order_by('invoice_number', 'DESC');
      $query = $this->db->get('barang_masuk');

      if ($query->num_rows() > 0) {
         $row = $query->row();
         $last_invoice_number = (int)$row->invoice_number;
      } else {
         // Jika tidak ada nomor invoice sebelumnya, Anda bisa mulai dari nomor 1.
         $last_invoice_number = 0; // Ubah menjadi 1 jika ingin memulai dari nomor 1
      }

      // Generate nomor invoice berikutnya
      $next_invoice_number = $last_invoice_number + 1;

      // Simpan nomor invoice baru ke dalam database untuk digunakan di masa depan
      $data = array(
         'invoice_number' => $next_invoice_number
      );
      $this->db->insert('barang_masuk', $data);

      return $next_invoice_number;
   }
}
