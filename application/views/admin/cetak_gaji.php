<!DOCTYPE html>
<html>

<head>
   <title></title>
   <style type="text/css">
      * {
         font-family: Century Gothic, sans-serif;
      }

      .center {
         text-align: center;
      }

      .right {
         text-align: right;
      }

      .left {
         text-align: left;
      }

      p {
         font-size: 10px;
      }

      .top-min {
         margin-top: -10px;
      }

      .uppercase {
         text-transform: uppercase;
      }

      .bold {
         font-weight: bold;
      }

      .d-block {
         display: block;
      }

      hr {
         border: 0;
         border-top: 1px solid #000;
      }

      .hr-dash {
         border-style: dashed none none none;
      }

      table {
         font-size: 10px;
      }

      table thead tr td {
         padding: 5px;
      }

      .w-100 {
         width: 100%;
      }

      .line {
         border: 0;
         border-top: 1px solid #000;
         border-style: dashed none none none;
      }

      .body {
         margin-top: -10px;
      }

      .b-p {
         font-size: 12px !important;
      }

      .w-long {
         width: 100px;
      }
   </style>
</head>

<body>
   <?php foreach ($view as $row) : ?>
      <div class="header">
         <table>
            <tr>
               <h2>SLIP GAJI KARYAWAN</h2>
            </tr>
            <hr>
         </table>

         <br>


         <table>
            <tr>
               <td><strong>NO. PEMBAYARAN</strong></td>
               <td>&nbsp;&nbsp; :</td>
               <td>&nbsp;&nbsp;#<?= $row->id_pembayaran ?></td>
            </tr>

            <tr>
               <td><strong>TGL PEMBAYARAN</strong></td>
               <td>&nbsp;&nbsp; :</td>
               <td>&nbsp;&nbsp;<?= date('d F Y', strtotime($row->tanggal_pembayaran)) ?></td>
            </tr>

            <tr>
               <td><strong>NAMA</strong></td>
               <td>&nbsp;&nbsp; :</td>
               <td>&nbsp;&nbsp;<?= $row->nama_karyawan ?></td>
            </tr>

            <tr>
               <td><strong>NIK</strong></td>
               <td>&nbsp;&nbsp; :</td>
               <td>&nbsp;&nbsp;<?= $row->id_karyawan ?></td>
            </tr>

            <tr>
               <td><strong>JABATAN</strong></td>
               <td>&nbsp;&nbsp; :</td>
               <td>&nbsp;&nbsp;<?= $row->nama_jabatan ?></td>
            </tr>

            <tr>
               <td><strong>DEPT.</strong></td>
               <td>&nbsp;&nbsp; :</td>
               <td>&nbsp;&nbsp;<?= $row->nama_departement ?></td>
            </tr>
         </table>
      </div>
      <br><br>
      <div class="body">
         <table class="w-100">
            <thead>
               <tr>
                  <td><b>PENDAPATAN</b></td>
                  <td><b>JUMLAH</b></td>
               </tr>
               <tr>
                  <td colspan="4" class="line"></td>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td>Gaji Pokok</td>
                  <td>Rp. <?= number_format($row->gaji_pokok, 2) ?></td>
               </tr>

               <tr>
                  <td>Tunjangan Jabatan</td>
                  <td>Rp. <?= number_format($row->tunjangan_jabatan, 2) ?></td>
               </tr>

               <tr>
                  <td>Tunjangan Makan</td>
                  <td>Rp. <?= number_format($row->tunjangan_makan, 2) ?></td>
               </tr>

               <tr>
                  <td>Tunjangan Aktivitas</td>
                  <td>Rp. <?= number_format($row->tunjangan_aktivitas, 2) ?></td>
               </tr>

               <tr>
                  <td>Upah Lembur</td>
                  <td>Rp. <?= number_format($row->upah_lembur, 2) ?></td>
               </tr>
            </tbody>
         </table>
         <hr class="hr-dash">

         <table class="w-100">
            <thead>
               <tr>
                  <td><b>POTONGAN</b></td>
                  <td><b>JUMLAH</b></td>
               </tr>
               <tr>
                  <td colspan="4" class="line"></td>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td>PPH 23</td>
                  <td>Rp. <?= number_format($row->pph23, 2) ?></td>
               </tr>

               <tr>
                  <td>Potongan BPJS</td>
                  <td>Rp. <?= number_format($row->bpjs, 2) ?></td>
               </tr>

               <tr>
                  <td>Potongan Absen</td>
                  <td>Rp. 0</td>
               </tr>

               <tr>
                  <td>Pinjaman</td>
                  <td>Rp. <?= number_format($row->pinjaman, 2) ?></td>
               </tr>
            </tbody>
         </table>
         <hr class="hr-dash">

         <table class="w-100">
            <thead>
               <tr>
                  <td><b>TAKE HOME PAY</b></td>
                  <td><b>Rp. <?= number_format($row->thp, 2) ?></b></td>
               </tr>
               <tr>
                  <td colspan="4" class="line"></td>
               </tr>
            </thead>
         </table>
      </div>
   <?php endforeach; ?>
</body>

</html>