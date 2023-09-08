  <!--  BEGIN CONTENT AREA  -->
  <div id="content" class="main-content">
     <div class="layout-px-spacing">



        <div class="row layout-top-spacing" id="cancel-row">

           <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
              <div class="widget widget-chart-three">
                 <div class="widget-heading">
                    <div class="">
                       <h5 class="">Hasil Laporan Pengajuan Izin</h5>
                    </div>

                    <div class="dropdown ">
                       <a class="dropdown-toggle" href="<?php echo base_url('admin/laporan_izin/exportExcel'); ?>" role="button">
                          <i class="fas fa-file-excel fa-xl text-success"></i>
                       </a>
                    </div>
                 </div>

                 <div class="widget-content">
                    <div class="widget-content widget-content-area br-6">
                       <form action="<?= site_url('admin/laporan_izin/filter') ?>" method="post">
                          <div class="row ml-2 mt-4 mr-2 mb-2">
                             <div class="col-md-3">
                                <label class="ml-1">Dari Tanggal <span class="text-danger">*</span></label>
                                <input type="date" name="tanggal_awal" class="form-control">
                             </div>

                             <div class="col-md-3">
                                <label class="ml-1">Sampai Tanggal <span class="text-danger">*</span></label>
                                <input type="date" name="tanggal_akhir" class="form-control">
                             </div>

                             <div class="col-md-3">
                                <label class="ml-1">Status <span class="text-danger">*</span></label>
                                <select name="keterangan" class="form-control">
                                   <option value="">Pilih Status</option>
                                   <option value="0">Menunggu</option>
                                   <option value="1">Diterima</option>
                                   <option value="1">Ditolak</option>
                                </select>
                             </div>
                             <button type="submit" class="mt-4 ml-5 btn btn-secondary btn-rounded"><i class="fas fa-search"></i>&nbsp; Filter Data</button>
                          </div>
                          <hr>

                       </form>

                       <table id="zero-config" class="table table-striped" style="width:100%">
                          <thead>
                             <tr>
                                <th>No.</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Tanggal Awal</th>
                                <th>Tanggal Akhir</th>
                                <th>Keterangan</th>
                                <th>Tanggal Pengajuan</th>
                                <th class="no-content">Status</th>
                             </tr>
                          </thead>
                          <tbody>
                             <?php $no = 1;
                              foreach ($izin as $row) :
                              ?>
                                <tr>
                                   <td><?= $no++; ?></td>
                                   <td><?= $row->id_karyawan; ?></td>
                                   <td><strong><?= $row->nama_karyawan ?></strong></td>
                                   <td><?php echo date('d F Y', strtotime($row->tgl_awal)); ?></td>
                                   <td><?php echo date('d F Y', strtotime($row->tgl_akhir)); ?></td>
                                   <td><strong><?= $row->keterangan ?></strong></td>
                                   <td><?php echo date('d F Y', strtotime($row->created_at)); ?></td>
                                   <td>
                                      <?php if ($row->status_izin == 1) { ?>
                                         <span class="badge badge-success text-white"> Diterima </span>
                                      <?php } elseif ($row->status_izin == 2) { ?>
                                         <span class="badge badge-danger text-white"> Ditolak </span>
                                      <?php } else { ?>
                                         <span class="badge badge-warning text-white"> Menunggu </span>
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