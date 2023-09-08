<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
   <div class="layout-px-spacing">

      <div class="row layout-top-spacing">

         <div class="col-xl-8 col-lg-7 col-12">
            <div class="alert alert-light-primary border-0 notification-alert" role="alert">
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert">
                     <line x1="18" y1="6" x2="6" y2="18"></line>
                     <line x1="6" y1="6" x2="18" y2="18"></line>
                  </svg>
               </button>
               <span class="text-dark">Anda dapat mengubah data ini jika memang ada kesalahan data.</span>
               <a href="javascript:void(0)">Learn more</a>
            </div>
         </div>

         <div class="col-xl-4 col-lg-5 col-12 layout-spacing text-right">

            <div class="notification-action-btns d-lg-block d-flex justify-content-between flex-sm-row flex-column">
               <a class="btn btn-primary  notification-action-btn mb-sm-0 mb-3">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bar-chart">
                     <line x1="12" y1="20" x2="12" y2="10"></line>
                     <line x1="18" y1="20" x2="18" y2="4"></line>
                     <line x1="6" y1="20" x2="6" y2="16"></line>
                  </svg> Daftar Karyawan
               </a>
               <a class="btn btn-dark  notification-action-btn">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download-cloud mr-1">
                     <polyline points="8 17 12 21 16 17"></polyline>
                     <line x1="12" y1="12" x2="12" y2="21"></line>
                     <path d="M20.88 18.09A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.29"></path>
                  </svg> Tambah Karyawan
               </a>
            </div>

         </div>

         <div class="col-xl-12 col-lg-6 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="widget widget-chart-three">
               <div class="widget-heading">
                  <div class="">
                     <h5 class="">Update Karyawan</h5>
                  </div>
               </div>

               <div class="widget-content">
                  <form action="<?= site_url('admin/karyawan/proses_ubah') ?>" method="post">
                     <div class="row ml-2 mt-4 mr-2 mb-2">
                        <div class="col-md-6">
                           <label class="ml-1">ID Karyawan <span class="text-danger">*</span></label>
                           <input type="text" name="id_karyawan" class="form-control" value="<?= $karyawan->id_karyawan ?>" readonly>
                        </div>

                        <div class="col-md-6">
                           <label class="ml-1">Nama Karyawan<span class="text-danger">*</span></label>
                           <input type="text" name="nama_karyawan" class="form-control" value="<?= $karyawan->nama_karyawan ?>">
                        </div>

                        <div class="col-md-6 mt-3">
                           <label class="ml-1">Jabatan <span class="text-danger">*</span></label>
                           <select name="id_jabatan" class="form-control basic-jabatan">
                              <option value="<?= $karyawan->id_jabatan ?>"><?= $karyawan->nama_jabatan ?></option>
                              <?php foreach ($jabatan as $j) : ?>
                                 <option value="<?= $j->id_jabatan ?>"><?= $j->nama_jabatan ?></option>
                              <?php endforeach; ?>
                           </select>
                        </div>

                        <div class="col-md-6 mt-3">
                           <label class="ml-1">Departement <span class="text-danger">*</span></label>
                           <select name="id_departement" class="form-control basic-dept">
                              <option value="<?= $karyawan->id_departement ?>"><?= $karyawan->nama_departement ?></option>
                              <?php foreach ($departement as $d) : ?>
                                 <option value="<?= $d->id_departement ?>"><?= $d->nama_departement ?></option>
                              <?php endforeach; ?>
                           </select>
                        </div>

                        <div class="col-md-6">
                           <label class="ml-1">NIK<span class="text-danger">*</span></label>
                           <input type="text" name="nik" class="form-control" value="<?= $karyawan->nik ?>">
                        </div>

                        <div class="col-md-6">
                           <label class="ml-1">No. KK<span class="text-danger">*</span></label>
                           <input type="text" name="no_kk" class="form-control" value="<?= $karyawan->no_kk ?>">
                        </div>

                        <div class="col-md-12 mt-3">
                           <label class="ml-1">Alamat<span class="text-danger">*</span></label>
                           <textarea name="alamat" class="form-control"><?= $karyawan->alamat ?></textarea>
                        </div>

                        <div class="col-md-4 mt-3">
                           <label class="ml-1">No. Kontrak<span class="text-danger">*</span></label>
                           <input type="text" name="no_kontrak" class="form-control" value="<?= $karyawan->no_kontrak ?>">
                        </div>

                        <div class="col-md-4 mt-3">
                           <label class="ml-1">Tgl Kontrak<span class="text-danger">*</span></label>
                           <input type="date" name="tgl_kontrak" class="form-control" value="<?= $karyawan->tgl_kontrak ?>">
                        </div>
                        <div class="col-md-4 mt-3">
                           <label class="ml-1">Tgl Berakhir<span class="text-danger">*</span></label>
                           <input type="date" name="tgl_kontrak_berakhir" class="form-control" value="<?= $karyawan->tgl_kontrak_berakhir ?>">
                        </div>

                     </div>
                     <hr>
                     <input type="submit" name="time" class="mb-4 ml-4 btn btn-primary">
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