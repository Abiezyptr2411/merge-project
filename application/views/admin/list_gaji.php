  <!--  BEGIN CONTENT AREA  -->
  <div id="content" class="main-content">
     <div class="layout-px-spacing">



        <div class="row layout-top-spacing" id="cancel-row">

           <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
              <div class="widget widget-chart-three">
                 <div class="widget-heading">
                    <div class="">
                       <h5 class="">Daftar Pembayaran Gaji</h5>
                    </div>

                    <div class="dropdown ">
                       <a class="dropdown-toggle" href="<?= site_url('admin/payslip/hitung_gaji') ?>" role="button">
                          <i class="fas fa-plus-circle fa-lg text-primary"></i>
                       </a>
                    </div>
                 </div>

                 <div class="widget-content">
                    <div class="widget-content widget-content-area br-6">
                       <table id="zero-config" class="table table-striped" style="width:100%">
                          <thead>
                             <tr>
                                <th>No.</th>
                                <th>Tanggal Pembayaran</th>
                                <th>No. Transaksi</th>
                                <th>Total Pembayaran</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Departement</th>
                                <th class="no-content"></th>
                             </tr>
                          </thead>
                          <tbody>
                             <?php $no = 1;
                              foreach ($data as $row) : ?>
                                <tr>
                                   <td><?= $no++; ?></td>
                                   <td><?php echo date('d F Y', strtotime($row->tanggal_pembayaran)); ?></td>
                                   <td class="text-secondary"><strong><?= $row->id_pembayaran ?></strong></td>
                                   <td class="text-success"><strong>Rp. <?= number_format($row->thp, 2) ?></strong></td>
                                   <td><?= $row->nama_karyawan ?></td>
                                   <td><?= $row->nama_jabatan ?></td>
                                   <td><?= $row->nama_departement ?></td>
                                   <td>
                                      <a class="btn btn-sm btn-outline-dark" href="<?= site_url('admin/payslip/exportToPDF/' . $row->id_pembayaran) ?>">Download</a>
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