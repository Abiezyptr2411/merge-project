  <!--  BEGIN CONTENT AREA  -->
  <div id="content" class="main-content">
     <div class="layout-px-spacing">



        <div class="row layout-top-spacing" id="cancel-row">

           <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
              <div class="widget widget-chart-three">
                 <div class="widget-heading">
                    <div class="">
                       <h5 class="">Hasil Laporan Penggajian</h5>
                    </div>

                    <div class="dropdown ">
                       <a class="dropdown-toggle" href="<?php echo base_url('admin/laporan_gaji/exportExcel'); ?>" role="button">
                          <i class="fas fa-file-excel fa-xl text-success"></i>
                       </a>
                    </div>
                 </div>

                 <div class="widget-content">
                    <div class="widget-content widget-content-area br-6">
                       <form action="<?= site_url('admin/laporan_gaji/filter') ?>" method="post">
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
                                <label class="ml-1">Karyawan <span class="text-danger">*</span></label>
                                <select name="keterangan" class="form-control basic-jabatan">
                                   <option value="">Pilih Karyawan</option>
                                   <?php foreach ($karyawan as $k) : ?>
                                      <option value="<?= $k->id_karyawan ?>"><?= $k->nama_karyawan ?></option>
                                   <?php endforeach; ?>
                                </select>
                             </div>

                             <div class="col-md-3 mt-2">
                                <button type="submit" class="mt-4 ml-5 btn btn-secondary btn-rounded"><i class="fas fa-search"></i>&nbsp; Filter Data</button>
                             </div>

                          </div>
                          <hr>

                       </form>

                       <table id="zero-config" class="table table-striped" style="width:100%">
                          <thead>
                             <tr>
                                <th>No.</th>
                                <th>Tanggal</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Departement</th>
                                <th>No. Pembayaran</th>
                                <th>Gaji Pokok</th>
                                <th>Tunjangan Jabatan</th>
                                <th>Tunjangan Makan</th>
                                <th>Tunjangan Aktivitas</th>
                                <th>Upah Lembur</th>
                                <th>Potongan PPH23</th>
                                <th>Potongan BPJS</th>
                                <th>Pinjaman</th>
                                <th>Total Pembayaran</th>
                             </tr>
                          </thead>
                          <tbody>
                             <?php $no = 1;
                              foreach ($gaji as $row) : ?>
                                <tr>
                                   <td><?= $no++; ?></td>
                                   <td><?php echo date('d F Y', strtotime($row->tanggal_pembayaran)); ?></td>
                                   <td><?= $row->id_karyawan ?></td>
                                   <td><?= $row->nama_karyawan ?></td>
                                   <td><?= $row->nama_jabatan ?></td>
                                   <td><?= $row->nama_departement ?></td>
                                   <td><strong><?= $row->id_pembayaran ?></strong></td>
                                   <td><strong>Rp. <?= number_format($row->gaji_pokok, 2) ?></strong></td>
                                   <td><strong>Rp. <?= number_format($row->tunjangan_jabatan, 2) ?></strong></td>
                                   <td><strong>Rp. <?= number_format($row->tunjangan_makan, 2) ?></strong></td>
                                   <td><strong>Rp. <?= number_format($row->tunjangan_aktivitas, 2) ?></strong></td>
                                   <td><strong>Rp. <?= number_format($row->upah_lembur, 2) ?></strong></td>
                                   <td><strong>Rp. <?= number_format($row->pph23, 2) ?></strong></td>
                                   <td><strong>Rp. <?= number_format($row->bpjs, 2) ?></strong></td>
                                   <td><strong>Rp. <?= number_format($row->pinjaman, 2) ?></strong></td>
                                   <td><strong>Rp. <?= number_format($row->thp, 2) ?></strong></td>
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