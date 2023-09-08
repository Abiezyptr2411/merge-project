  <!--  BEGIN CONTENT AREA  -->
  <div id="content" class="main-content">
     <div class="layout-px-spacing">



        <div class="row layout-top-spacing" id="cancel-row">

           <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
              <div class="widget widget-chart-three">
                 <div class="widget-heading">
                    <div class="">
                       <h5 class="">Data Pengajuan Izin</h5>
                    </div>

                    <div class="dropdown ">
                       <a class="dropdown-toggle" href="<?= site_url('pegawai/izin/pengajuan') ?>" role="button">
                          <i class="fas fa-plus-circle fa-lg text-primary"></i>
                       </a>
                    </div>
                 </div>

                 <div class="widget-content">
                    <div class="widget-content widget-content-area br-6">
                       <div class="row ml-3 mr-3">
                          <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 mt-4 layout-spacing">
                             <div class="widget widget-card-two">
                                <div class="widget-content">

                                   <div class="media">
                                      <div class="media-body">
                                         <h6><strong>PENGAJUAN CUTI</strong></h6>
                                         <p class="meta-date-time mt-2">1 Data Terakhir</p>
                                      </div>
                                   </div>

                                   <div class="card-bottom-section">
                                      <div class="alert alert-outline-dark ml-3 mr-3 mb-4" role="alert">
                                         <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                         <?php if (empty($cuti)) { ?>
                                            Tidak ada pengajuan
                                         <?php } else { ?>
                                            <?php foreach ($cuti as $c) : ?>
                                               <strong>Anda memiliki pengajuan <span class="text-success">Aktif</span></strong>
                                            <?php endforeach; ?>
                                         <?php } ?>


                                      </div>
                                      <a href="<?= site_url('pegawai/izin/daftar_cuti') ?>" class="btn">Lihat Detail</a>
                                   </div>
                                </div>
                             </div>
                          </div>

                          <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 mt-4 layout-spacing">
                             <div class="widget widget-card-two">
                                <div class="widget-content">

                                   <div class="media">
                                      <div class="media-body">
                                         <h6><strong>PENGAJUAN IZIN</strong></h6>
                                         <p class="meta-date-time mt-2">1 Data Terakhir</p>
                                      </div>
                                   </div>

                                   <div class="card-bottom-section">
                                      <div class="alert alert-outline-dark ml-3 mr-3 mb-4" role="alert">
                                         <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                         <?php if (empty($izin)) { ?>
                                            Tidak ada pengajuan
                                         <?php } else { ?>
                                            <strong>Anda memiliki pengajuan <span class="text-success">Aktif</span></strong>
                                         <?php } ?>


                                      </div>
                                      <a href="<?= site_url('pegawai/izin/daftar_izin') ?>" class="btn">Lihat Detail</a>
                                   </div>
                                </div>
                             </div>
                          </div>

                          <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 mt-4 layout-spacing">
                             <div class="widget widget-card-two">
                                <div class="widget-content">

                                   <div class="media">
                                      <div class="media-body">
                                         <h6><strong>PENGAJUAN IZIN SAKIT</strong></h6>
                                         <p class="meta-date-time mt-2">1 Data Terakhir</p>
                                      </div>
                                   </div>

                                   <div class="card-bottom-section">
                                      <div class="alert alert-outline-dark ml-3 mr-3 mb-4" role="alert">
                                         <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                         <?php if (empty($sakit)) { ?>
                                            Tidak ada pengajuan
                                         <?php } else { ?>
                                            <strong>Anda memiliki pengajuan <span class="text-success">Aktif</span></strong>
                                         <?php } ?>


                                      </div>
                                      <a href="<?= site_url('pegawai/izin/daftar_sakit') ?>" class="btn">Lihat Detail</a>
                                   </div>
                                </div>
                             </div>
                          </div>
                       </div>
                    </div>
                 </div>
              </div>
           </div>

        </div>

     </div>
  </div>
  <!--  END CONTENT AREA  -->