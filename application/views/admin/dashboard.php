<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
   <div class="layout-px-spacing">

      <div class="row layout-top-spacing">

         <div class="col-xl-9 col-lg-6 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="widget widget-chart-three">
               <div class="widget-heading">
                  <div class="">
                     <h5 class="">Grafik Pembayaran</h5>
                  </div>
               </div>

               <div class="widget-content">
                  <div style="width: 90%; margin: 0 auto;">
                     <canvas id="payrollChart"></canvas>
                  </div>
               </div>
            </div>
         </div>

         <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
            <div class="widget widget-activity-five">

               <div class="widget-heading">
                  <h5 class="">Notifikasi Pengajuan</h5>
               </div>

               <div class="widget-content">

                  <div class="w-shadow-top"></div>

                  <div class="mt-container mx-auto">
                     <div class="timeline-line">
                        <?php foreach ($permohonan as $item) : ?>
                           <div class="item-timeline timeline-new">
                              <div class="t-dot">
                                 <img src="<?= base_url('assets/default.jpg') ?>" width="30" class="img-fluid rounded-circle" alt="avatar">
                              </div>&nbsp;&nbsp;&nbsp;
                              <div class="t-content">
                                 <div class="t-uppercontent">
                                    <h5><?= $item->nama_karyawan ?> <strong>(<?= $item->id_karyawan ?>)</strong> <a href="<?= site_url('admin/izin') ?>"><span><br>Mengajukan permohonan <?= $item->kategori_izin ?></span></a></h5>
                                 </div>
                                 <p><?= date('d M, Y', strtotime($item->tgl_izin)) ?></p>
                              </div>
                           </div>
                        <?php endforeach; ?>
                     </div>
                  </div>

                  <div class="w-shadow-bottom"></div>
               </div>
            </div>
         </div>

         <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget widget-chart-three">
               <div class="widget-heading">
                  <div class="">
                     <h5 class="">Pemberitahuan Masa Kontrak</h5>
                  </div>
               </div>

               <div class="widget-content">
                  <table id="zero-config" class="table table-striped" style="width:100%">
                     <thead>
                        <tr>
                           <th>No.</th>
                           <th>Nama</th>
                           <th>Jabatan</th>
                           <th>Departement</th>
                           <th>Tanggal Kontrak Berakhir</th>
                           <th>Estimasi Hari Tersisa</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php $no = 1;
                        foreach ($karyawan as $k) : ?>
                           <tr>
                              <td><?= $no++; ?></td>
                              <td><strong><?= $k->nama_karyawan ?></strong></td>
                              <td><?= $k->nama_jabatan ?></td>
                              <td><?= $k->nama_departement ?></td>
                              <td><?= date('d F Y', strtotime($k->tgl_kontrak_berakhir)) ?></td>
                              <td><strong><?= $k->estimasi_hari ?> hari</strong></td>
                           </tr>
                        <?php endforeach; ?>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>

      </div>
   </div>
</div>
<!--  END CONTENT AREA  -->


</div>
<!-- END MAIN CONTAINER -->