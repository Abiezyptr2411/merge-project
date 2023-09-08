<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
   <div class="layout-px-spacing">

      <div class="row justify-content-center align-items-center layout-top-spacing">

         <div class="col-xl-8 col-lg-6 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="widget widget-chart-three left-card">
               <div class="widget-heading">
                  <div class="">
                     <h5 class="">Tambah Inventaris Kantor</h5>
                  </div>
               </div>

               <div class="widget-content">
                  <form action="<?= site_url('admin/barang/proses') ?>" method="post">
                     <div class="row ml-2 mt-4 mr-2 mb-2">
                        <div class="col-md-6">
                           <label class="ml-1">Kode </label>
                           <?php
                           // Generate angka acak antara 10000000 dan 999999999
                           $angka_acak = mt_rand(1000, 9999);

                           // Generate karakter acak huruf kapital
                           $karakter_acak = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 5);

                           // Gabungkan angka acak dan karakter acak
                           $hasil = $angka_acak . $karakter_acak;
                           ?>
                           <input type="text" name="id_brg" class="form-control" value="<?= $hasil; ?>" readonly>
                        </div>

                        <div class="col-md-6">
                           <label class="ml-1">Merek <span class="text-danger">*</span></label>
                           <input type="text" name="nama_brg" class="form-control" placeholder="Merek Barang">
                        </div>

                        <div class="col-md-6 mt-3">
                           <label class="ml-1">Kategori <span class="text-danger">*</span></label>
                           <select name="id_kategori" class="form-control basic-jabatan">
                              <option hidden>Pilih Kategori</option>
                              <?php foreach ($kategori as $kat) : ?>
                                 <option value="<?= $kat->id_kategori ?>"><?= $kat->nama_kategori ?></option>
                              <?php endforeach; ?>
                           </select>
                        </div>

                        <div class="col-md-6 mt-3">
                           <label class="ml-1">Harga <span class="text-danger">*</span></label>
                           <input type="text" name="harga" class="form-control" placeholder="Rp. 0.00">
                        </div>

                        <div class="col-md-6 mt-0">
                           <label class="ml-1">Kondisi <span class="text-danger">*</span></label>
                           <select name="kondisi" class="form-control">
                              <option value="Baik">Baik</option>
                              <option value="Rusak">Rusak</option>
                           </select>
                        </div>

                        <div class="col-md-6 mt-0">
                           <label class="ml-1">Lokasi <span class="text-danger">*</span></label>
                           <select name="id_unit" class="form-control basic-dept">
                              <option hidden>Pilih Lokasi</option>
                              <?php foreach ($unit as $u) : ?>
                                 <option value="<?= $u->id_unit ?>"><?= $u->nama_unit ?></option>
                              <?php endforeach; ?>
                           </select>
                        </div>

                     </div>
                     <hr>
                     <button type="submit" class="mb-4 ml-4 btn btn-primary">Submit</button>
                     <a href="<?= site_url('admin/barang') ?>" class="mb-4 ml-2 btn btn-danger">Kembali</a>
                  </form>
               </div>
            </div>
         </div>


      </div>
   </div>

</div>
<!--  END CONTENT AREA  -->


</div>
<!-- END MAIN CONTAINER -->