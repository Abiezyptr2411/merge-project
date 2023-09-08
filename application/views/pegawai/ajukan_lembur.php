<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
   <div class="layout-px-spacing">

      <form action="<?= site_url('pegawai/lembur/proses_lembur'); ?>" method="post" enctype="multipart/form-data">
         <div class="row justify-content-center align-items-center layout-top-spacing">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 layout-spacing">
               <div class="widget widget-chart-three">
                  <div class="widget-heading">
                     <div class="">
                        <h5 class="">Pengajuan Lembur</h5>
                     </div>
                  </div>

                  <div class="widget-content">
                     <div class="row ml-2 mt-3 mr-2 mb-2">
                        <div class="col-md-12 mt-3 mr-4">
                           <label class="ml-1">Tanggal <span class="text-danger">*</span></label>
                           <input type="text" name="tanggal_lembur" class="form-control mr-3" value="<?= date('Y-m-d') ?>" readonly>
                        </div>
                     </div>

                     <div class="row ml-2 mt-4 mr-2 mb-2">
                        <div class="col-md-6">
                           <label class="ml-1">Jam Mulai <span class="text-danger">*</span></label>
                           <input type="time" name="jam_mulai" class="form-control" placeholder="00:00">
                        </div>

                        <div class="col-md-6">
                           <label class="ml-1">Jam Akhir <span class="text-danger">*</span></label>
                           <input type="time" name="jam_akhir" class="form-control" placeholder="23:59">
                        </div>

                        <div class="col-md-12 mt-3">
                           <label class="ml-1">Pekerjaan <span class="text-danger">*</span></label>
                           <textarea name="pekerjaan" class="form-control"></textarea>
                        </div>

                        <div class="col-md-12 mt-3">
                           <label class="ml-1">Lampiran <span class="text-muted"><small>(optional) | Max : 2MB</small></span></label><br>
                           <input type="file" name="lampiran" class="form-control">
                        </div>
                     </div>
                     <hr>
                     <div class="col-md-12 mt-3">
                        <button type="submit" class="btn btn-primary btn-block mt-2 mb-4">Submit</button>
                     </div>
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