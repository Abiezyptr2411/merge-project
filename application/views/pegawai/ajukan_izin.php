<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
   <div class="layout-px-spacing">

      <form action="<?= site_url('pegawai/izin/proses_izin'); ?>" method="post" enctype="multipart/form-data">
         <div class="row justify-content-center align-items-center layout-top-spacing">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 layout-spacing">
               <div class="widget widget-chart-three">
                  <div class="widget-heading">
                     <div class="">
                        <h5 class="">Pengajuan Izin</h5>
                     </div>
                  </div>

                  <div class="widget-content">
                     <div class="row ml-2 mt-3 mr-2 mb-2">
                        <div class="col-md-12 mt-3 mr-4">
                           <label class="ml-1">Kategori Izin <span class="text-danger">*</span></label>
                           <select name="kategori_izin" class="form-control">
                              <option hidden>Choose one</option>
                              <option value="Cuti">Cuti</option>
                              <option value="Sakit">Sakit</option>
                              <option value="Izin">Izin</option>
                           </select>
                        </div>
                     </div>

                     <div class="row ml-2 mt-4 mr-2 mb-2">
                        <div class="col-md-6">
                           <label class="ml-1">Tanggal Awal <span class="text-danger">*</span></label>
                           <input type="date" name="tgl_awal" class="form-control" placeholder="00:00">
                        </div>

                        <div class="col-md-6">
                           <label class="ml-1">Tanggal Akhir <span class="text-danger">*</span></label>
                           <input type="date" name="tgl_akhir" class="form-control" placeholder="23:59">
                        </div>

                        <div class="col-md-12 mt-3">
                           <label class="ml-1">keterangan <span class="text-danger">*</span></label>
                           <textarea name="keterangan" class="form-control"></textarea>
                        </div>

                        <div class="col-md-12 mt-3">
                           <label class="ml-1">Bukti / Lampiran</label><br>
                           <input type="file" name="bukti" class="form-control">
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