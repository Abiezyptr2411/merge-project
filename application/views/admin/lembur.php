  <!--  BEGIN CONTENT AREA  -->
  <div id="content" class="main-content">
     <div class="layout-px-spacing">



        <div class="row layout-top-spacing" id="cancel-row">

           <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
              <div class="widget widget-chart-three">
                 <div class="widget-heading">
                    <div class="">
                       <h5 class="">Pengajuan Lembur</h5>
                    </div>
                 </div>

                 <div class="widget-content">
                    <div class="widget-content widget-content-area br-6">
                       <table id="zero-config" class="table table-striped" style="width:100%">
                          <thead>
                             <tr>
                                <th>No.</th>
                                <th>Tanggal</th>
                                <th>Nama</th>
                                <th>Waktu Lembur</th>
                                <th>Total Waktu</th>
                                <th>Pekerjaan</th>
                                <th class="no-content">Lampiran</th>
                             </tr>
                          </thead>
                          <tbody>
                             <?php
                              $no = 1;
                              foreach ($lembur as $row) :
                                 // Menghitung selisih waktu (total waktu) antara jam_mulai dan jam_akhir
                                 $jam_mulai = strtotime($row->jam_mulai);
                                 $jam_akhir = strtotime($row->jam_akhir);
                                 $total_waktu = ($jam_akhir - $jam_mulai) / 3600; // Menghitung total waktu dalam jam

                              ?>
                                <tr>
                                   <td><?= $no++; ?></td>
                                   <td><?php echo date('d F Y', strtotime($row->tanggal_lembur)); ?></td>
                                   <td><strong><?= $row->nama_karyawan ?></strong> <br><?= $row->id_karyawan ?></td>
                                   <td><strong><?php echo date('H:i:s', $jam_mulai) . " - " . date('H:i:s', $jam_akhir); ?></strong></td>
                                   <td><?= $total_waktu ?> jam</td>
                                   <td><?= $row->pekerjaan ?></td>
                                   <td>
                                      <?php if ($row->lampiran == NULL) { ?>
                                         <i class="fas fa-minus fa-lg"></i>
                                      <?php } else { ?>
                                         <?= $row->lampiran ?>
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