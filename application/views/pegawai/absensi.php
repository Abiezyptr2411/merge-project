<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
   <div class="layout-px-spacing">

      <form id="absensiForm" action="<?= base_url('pegawai/absensi/proses_absen'); ?>" method="post" enctype="multipart/form-data">
         <div class="row justify-content-center align-items-center layout-top-spacing">


            <div class="col-xl-8 col-lg-6 col-md-12 col-sm-12 col-12 layout-spacing">
               <div class="widget widget-chart-three">
                  <div class="widget-heading">
                     <div class="">
                        <h5 class="">Form Absensi</h5>
                     </div>
                  </div>

                  <div class="widget-content">
                     <div class="form-group row mb-4 ml-2 mr-2 mt-4">
                        <label for="lokasiKerja" class="col-xl-2 col-sm-3 col-form-label">Lokasi Kerja</label>
                        <div class="col-xl-8 col-lg-9 col-sm-10">
                           <input type="text" class="form-control" name="lokasi_kerja" id="lokasiKerja" value="" readonly>
                        </div>
                        <div class="col-xl-2 col-lg-4 col-sm-2">
                           <button type="button" class="btn btn-primary" id="generateLocation"><i class="fas fa-location-crosshairs fa-lg text-white"></i></button>
                        </div>
                     </div>

                     <div class="form-group row mb-4 ml-2 mr-2 mt-4">
                        <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Waktu Kerja</label>
                        <div class="col-xl-6 col-lg-9 col-sm-10">
                           <select name="shift_line" class="form-control">
                              <option hidden>Pilih Waktu Kerja</option>
                              <option value="08.00 - 17.00">08.00 - 17.00</option>
                              <option value="09.00 - 18.00">09.00 - 18.00</option>
                           </select>
                        </div>
                     </div>

                     <div class="form-group row mb-4 ml-2 mr-2 mt-4">
                        <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Aktivitas</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                           <textarea name="aktivitas" class="form-control"></textarea>
                        </div>
                     </div>

                     <div class="form-group row ml-2 mr-2 mt-4">
                        <label class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Kesehatan</label>
                        <div class="col-xl-10 col-lg-9 col-sm-10">
                           <div class="card-deck">
                              <div class="card text-center bg-success">
                                 <div class="card-body">
                                    <h5 class="card-title text-white">SEHAT</h5>
                                    <img src="<?= base_url('assets/happy.png') ?>" class="card-img-top" alt="Image 1" style="width: 70px; margin: 0 auto;"><br><br>
                                    <input type="radio" name="kondisi_kesehatan" value="SEHAT" checked>
                                 </div>
                              </div>
                              <div class="card text-center bg-warning">
                                 <div class="card-body">
                                    <h5 class="card-title text-white">TIDAK FIT</h5>
                                    <img src="<?= base_url('assets/face-mask.png') ?>" class="card-img-top" alt="Image 2" style="width: 70px; margin: 0 auto;"><br><br>
                                    <input type="radio" name="kondisi_kesehatan" value="TIDAK FIT">
                                 </div>
                              </div>
                              <div class="card text-center bg-danger">
                                 <div class="card-body">
                                    <h5 class="card-title text-white">SAKIT</h5>
                                    <img src="<?= base_url('assets/sakit.png') ?>" class="card-img-top" alt="Image 3" style="width: 70px; margin: 0 auto;"><br><br>
                                    <input type="radio" name="kondisi_kesehatan" value="SAKIT">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>

                     <hr>
                     <?php if ($waktu != 'dilarang') { ?>
                        <button class="btn btn-primary btn-rounded ml-3 mt-2 mb-4 px-5">Absen <?= $waktu ?></button>
                        <input type="hidden" name="ket" id="ket" value="<?= $waktu ?>">
                        <input type="hidden" name="by" id="by" value="<?= date('Y-m-d') ?>">
                     <?php }  ?>
                  </div>
               </div>
            </div>

         </div>
      </form>
   </div>
</div>
<!--  END CONTENT AREA  -->


</div>
<!-- END MAIN CONTAINER -->