  <!--  BEGIN CONTENT AREA  -->
  <div id="content" class="main-content">
     <div class="layout-px-spacing">



        <div class="row layout-top-spacing" id="cancel-row">

           <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
              <div class="widget widget-chart-three">
                 <div class="widget-heading">
                    <div class="">
                       <h5 class="">Pengajuan Izin Sakit <strong><?= $nama_karyawan ?></strong></h5>
                    </div>
                 </div>

                 <div class="widget-content">
                    <div class="widget-content widget-content-area br-6">
                       <table id="zero-config" class="table table-striped" style="width:100%">
                          <thead>
                             <tr>
                                <th>No.</th>
                                <th>Tanggal Awal</th>
                                <th>Tanggal Akhir</th>
                                <th>Keterangan</th>
                                <th>Lampiran</th>
                                <th>Tanggal Pengajuan</th>
                                <th class="no-content">Status</th>
                             </tr>
                          </thead>
                          <tbody>
                             <?php $no = 1;
                              foreach ($sakit as $row) :
                              ?>
                                <tr>
                                   <td><?= $no++; ?></td>
                                   <td><?php echo date('d F Y', strtotime($row->tgl_awal)); ?></td>
                                   <td><?php echo date('d F Y', strtotime($row->tgl_akhir)); ?></td>
                                   <td><strong><?= $row->keterangan ?></strong></td>
                                   <td>
                                      <a href="<?= base_url('uploads/' . $row->bukti) ?>" target="_blank"><i class="fas fa-eye"></i>&nbsp; Bukti Pengajuan</a>
                                   </td>
                                   <td><?php echo date('d F Y', strtotime($row->created_at)); ?></td>
                                   <td>
                                      <?php if ($row->status_izin == 1) { ?>
                                         <span class="badge badge-success"> Diterima </span>
                                      <?php } elseif ($row->status_izin == 2) { ?>
                                         <span class="badge badge-danger"> Ditolak </span>
                                      <?php } else { ?>
                                         <span class="badge badge-warning"> Menunggu </span>
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