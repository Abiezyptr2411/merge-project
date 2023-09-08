   <div id="content" class="main-content">
      <div class="layout-px-spacing">

         <div class="row invoice layout-top-spacing layout-spacing">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

               <div class="doc-container">

                  <div class="row justify-content-center align-items-center">
                     <div class="col-xl-9">

                        <div class="invoice-content">

                           <div class="invoice-detail-body">
                              <form action="<?= site_url('admin/payslip/proses') ?>" method="post">

                                 <div class="invoice-detail-title">

                                    <img src="<?= base_url('assets/logo.svg') ?>" alt="" width="70">
                                    <h3>Buat Slip Gaji</h3>



                                 </div>
                                 <div class="invoice-detail-terms">

                                    <div class="row justify-content-between">

                                       <div class="col-md-12">

                                          <div class="form-group mb-0">
                                             <label class="mb-2">Karyawan</label>
                                             <input type="hidden" id="inputUser" name="user_id" class="form-control form-control-sm mt-2" readonly>
                                             <input type="hidden" id="inputIDKaryawan" name="id_karyawan" class="form-control form-control-sm mt-2" readonly>
                                             <select name="id_karyawan" class="form-control basic-jabatan" id="selectKaryawan">
                                                <option hidden>Pilih Karyawan</option>
                                                <?php foreach ($karyawan as $k) : ?>
                                                   <option value="<?= $k->id_karyawan ?>"><?= $k->nama_karyawan ?></option>
                                                <?php endforeach; ?>
                                             </select>
                                          </div>
                                       </div>

                                       <div class="col-md-8">
                                          <div class="form-group mb-4">
                                             <label for="date">Nama Jabatan</label>
                                             <input type="hidden" id="inputIDJabatan" name="id_jabatan" class="form-control form-control-sm mt-2" readonly>
                                             <input type="text" id="inputJabatan" class="form-control form-control-sm mt-2" readonly>
                                          </div>
                                       </div>

                                       <div class="col-md-4">
                                          <div class="form-group mb-4">
                                             <label for="date">Nama Departemen</label>
                                             <input type="hidden" id="inputIDDepartement" name="id_departement" class="form-control form-control-sm mt-2" readonly>
                                             <input type="text" id="inputDepartemen" class="form-control form-control-sm mt-2" readonly>
                                          </div>
                                       </div>


                                       <div class="col-md-4">

                                          <div class="form-group mb-4">
                                             <label for="number">Nomor Pembayaran</label>
                                             <?php
                                             // Generate angka acak antara 10000000 dan 999999999
                                             $angka_acak = mt_rand(10000000, 999999999);

                                             // Generate karakter acak huruf kapital
                                             $karakter_acak = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 5);

                                             // Gabungkan angka acak dan karakter acak
                                             $hasil = $angka_acak . $karakter_acak;
                                             ?>
                                             <input type="text" class="form-control form-control-sm mt-2" name="id_pembayaran" value="<?= $hasil; ?>" readonly>
                                          </div>

                                       </div>

                                       <div class="col-md-4">

                                          <div class="form-group mb-4">
                                             <label for="date">Tanggal Pembayaran</label>
                                             <input type="date" name="tanggal_pembayaran" class="form-control form-control-sm mt-2" value="<?php echo date('Y-m-d'); ?>">
                                          </div>
                                       </div>

                                       <div class="col-md-4">
                                          <div class="form-group mb-4">
                                             <label for="due">Tanggal Penggajian</label>
                                             <input type="date" name="tanggal_penggajian" class="form-control form-control-sm mt-2" value="<?php echo date('Y-m-d'); ?>">
                                          </div>

                                       </div>

                                    </div>

                                 </div>


                                 <div class="invoice-detail-items">

                                    <div class="row ml-2 mt-4 mr-2 mb-2">
                                       <div class="col-md-6">
                                          <label class="ml-1">Gaji Pokok </label>
                                          <input type="text" id="inputGajiPokok" name="gaji_pokok" class="form-control form-control-sm mt-2">
                                       </div>

                                       <div class="col-md-3">
                                          <label class="ml-1">Tunjangan Jabatan</label>
                                          <input type="text" id="inputTunjanganJabatan" name="tunjangan_jabatan" class="form-control form-control-sm mt-2">
                                       </div>

                                       <div class="col-md-3">
                                          <label class="ml-1">Tunjangan Makan</label>
                                          <input type="text" id="inputTunjanganMakan" name="tunjangan_makan" class="form-control form-control-sm mt-2">
                                       </div>

                                       <div class="col-md-9 mt-3">
                                          <label class="ml-1">Tunjangan Aktivitas</label>
                                          <input type="text" id="inputTunjanganAktifitas" name="tunjangan_aktivitas" class="form-control form-control-sm mt-2">
                                       </div>

                                       <div class="col-md-3 mt-3">
                                          <label class="ml-1">Qty</label>
                                          <input type="number" id="inputQty" value="1" name="qty" class="form-control form-control-sm mt-2" min="1">
                                       </div>

                                       <div class="col-md-3 mt-3">
                                          <label class="ml-1">Pajak PPH23</label>
                                          <input type="text" id="inputNominalPajak" name="pph23" class="form-control form-control-sm mt-2">
                                       </div>

                                       <div class="col-md-3 mt-3">
                                          <label class="ml-1">BPJS</label>
                                          <input type="text" id="inputBPJS" name="bpjs" class="form-control form-control-sm mt-2">
                                       </div>

                                       <div class="col-md-3 mt-3">
                                          <label class="ml-1">Upah Lembur</label>
                                          <input type="text" id="inputUpahLembur" name="upah_lembur" class="form-control form-control-sm mt-2">
                                       </div>


                                       <div class="col-md-3 mt-3">
                                          <label class="ml-1">Pinjaman</label>
                                          <input type="text" name="pinjaman" value="0" class="form-control form-control-sm mt-2">
                                       </div>


                                    </div>

                                 </div>


                                 <div class="invoice-detail-total">

                                    <div class="row">

                                       <div class="col-md-12 align-self-center">

                                          <div class="form-group row invoice-note">
                                             <label for="invoice-detail-notes" class="col-sm-12 col-form-label col-form-label-sm">Notes:</label>
                                             <div class="col-sm-12">
                                                <textarea class="form-control" name="keterangan_pembayaran" id="invoice-detail-notes" style="height: 88px;">Pembayaran gaji periode, <?php echo date('F Y'); ?></textarea>
                                             </div>
                                          </div>

                                       </div>

                                    </div>

                                 </div>

                                 <div class="invoice-detail-note">

                                    <div class="row">

                                       <div class="col-md-12 align-self-center">

                                          <button type="submit" class="btn btn-primary btn-block">Submit</button>

                                       </div>

                                    </div>

                                 </div>
                              </form>

                           </div>

                        </div>

                     </div>
                  </div>


               </div>

            </div>
         </div>
      </div>

      <div class="footer-wrapper">
         <div class="footer-section f-section-1">
            <p class="">Copyright © 2021 <a target="_blank" href="https://designreset.com">DesignReset</a>, All rights reserved.</p>
         </div>
         <div class="footer-section f-section-2">
            <p class="">Coded with <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart">
                  <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
               </svg></p>
         </div>
      </div>

   </div>