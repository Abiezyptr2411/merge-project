  <!--  BEGIN CONTENT AREA  -->
  <div id="content" class="main-content">
     <div class="layout-px-spacing">



        <div class="row layout-top-spacing" id="cancel-row">

           <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
              <div class="widget widget-chart-three">
                 <div class="widget-heading">
                    <div class="">
                       <h5 class="">Riwayat Absensi</h5>
                    </div>

                    <div class="dropdown ">
                       <a class="dropdown-toggle" href="<?= site_url('pegawai/absen_daily/export') ?>" role="button">
                          <i class="fas fa-file-excel fa-xl text-success"></i>
                       </a>
                    </div>
                 </div>

                 <div class="widget-content">
                    <div class="widget-content widget-content-area br-6">
                       <table id="zero-config" class="table table-striped" style="width:100%">
                          <thead>
                             <tr>
                                <th>Tanggal</th>
                                <th>Nama</th>
                                <th>Waktu Kerja</th>
                                <th>Kondisi</th>
                                <th>Aktivitas</th>
                                <th>Waktu Absen</th>
                                <th class="no-content">Keterangan</th>
                             </tr>
                          </thead>
                          <tbody>
                             <?php $no = 1;
                              foreach ($absen as $row) : ?>
                                <tr>
                                   <td><?php echo date('d F Y', strtotime($row->estimated)); ?></td>
                                   <td><strong><?= $row->nama_karyawan ?></strong> <br><?= $row->id_karyawan ?></td>
                                   <td><?= $row->shift_line ?></td>
                                   <td><strong><?= $row->kondisi_kesehatan ?></strong></td>
                                   <td><?= $row->aktivitas ?></td>
                                   <td>
                                      <?php
                                       // Mengatur zona waktu ke WIB
                                       date_default_timezone_set('Asia/Jakarta');

                                       // Mengambil data waktu dari $row->waktu dan mengonversinya ke format yang diinginkan
                                       $waktu = strtotime($row->waktu);
                                       $formattedTime = date('d F Y, H:i', $waktu);

                                       // Menambahkan informasi WIB
                                       $formattedTimeWithWIB = $formattedTime . ' WIB';

                                       echo $formattedTimeWithWIB;
                                       ?>
                                   </td>
                                   <td>
                                      <?php if ($row->keterangan == "masuk") { ?>
                                         <span class="badge badge-success"> Masuk </span>
                                      <?php } else { ?>
                                         <span class="badge badge-danger"> Pulang </span>
                                      <?php } ?>
                                   </td>
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
  </div>
  <!--  END CONTENT AREA  -->