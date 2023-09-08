  <!--  BEGIN CONTENT AREA  -->
  <div id="content" class="main-content">
     <div class="layout-px-spacing">



        <div class="row layout-top-spacing" id="cancel-row">

           <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
              <div class="widget widget-chart-three">
                 <div class="widget-heading">
                    <div class="">
                       <h5 class="">Filter Laporan Absen</h5>
                    </div>

                    <div class="dropdown ">
                       <a class="dropdown-toggle" href="<?php echo base_url('admin/laporan_absen/exportExcel'); ?>" role="button">
                          <i class="fas fa-file-excel fa-xl text-success"></i>
                       </a>
                    </div>
                 </div>

                 <div class="widget-content">
                    <div class="widget-content widget-content-area br-6">
                       <form action="<?= site_url('admin/laporan_absen/filter') ?>" method="post">
                          <div class="row ml-2 mt-4 mr-2 mb-2">
                             <div class="col-md-4">
                                <label class="ml-1">Tanggal Absen <span class="text-danger">*</span></label>
                                <input type="date" name="tanggal" class="form-control">
                             </div>

                             <div class="col-md-4">
                                <label class="ml-1">Keterangan <span class="text-danger">*</span></label>
                                <select name="keterangan" class="form-control">
                                   <option value="">Pilih Keterangan</option>
                                   <option value="Masuk">Masuk</option>
                                   <option value="Pulang">Pulang</option>
                                </select>
                             </div>
                             <button type="submit" class="mt-4 ml-5 btn btn-secondary btn-rounded"><i class="fas fa-search"></i>&nbsp; Filter Data</button>
                          </div>
                          <hr>

                       </form>
                    </div>
                 </div>
              </div>
           </div>

        </div>

     </div>
  </div>
  <!--  END CONTENT AREA  -->