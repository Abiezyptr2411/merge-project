  <!--  BEGIN CONTENT AREA  -->
  <div id="content" class="main-content">
      <div class="layout-px-spacing">



          <div class="row layout-top-spacing" id="cancel-row">

              <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                  <div class="widget widget-chart-three">
                      <div class="widget-heading">
                          <div class="">
                              <h5 class="">Hasil Laporan Pemasukan Barang</h5>
                          </div>

                          <div class="dropdown ">
                              <a class="dropdown-toggle" href="<?php echo base_url('admin/report_pengeluaran/exportExcel'); ?>" role="button">
                                  <i class="fas fa-file-excel fa-xl text-success"></i>
                              </a>
                          </div>
                      </div>

                      <div class="widget-content">
                          <div class="widget-content widget-content-area br-6">
                              <form action="<?= site_url('admin/report_pengeluaran/filter') ?>" method="post">
                                  <div class="row ml-2 mt-4 mr-2 mb-2">
                                      <div class="col-md-5">
                                          <label class="ml-1">Dari Tanggal <span class="text-danger">*</span></label>
                                          <input type="date" name="tanggal_awal" class="form-control">
                                      </div>

                                      <div class="col-md-5">
                                          <label class="ml-1">Sampai Tanggal <span class="text-danger">*</span></label>
                                          <input type="date" name="tanggal_akhir" class="form-control">
                                      </div>
                                      <button type="submit" class="mt-4 ml-2 btn btn-secondary btn-rounded"><i class="fas fa-search"></i>&nbsp; Filter Data</button>
                                  </div>
                                  <hr>

                              </form>

                              <table id="zero-config" class="table table-striped" style="width:100%">
                                  <thead>
                                      <tr>
                                          <th>No.</th>
                                          <th>Invoice ID</th>
                                          <th>Nama Peminjam</th>
                                          <th>Nama Barang</th>
                                          <th>Qty</th>
                                          <th>Tanggal Masuk Barang</th>
                                          <th class="no-content">Status</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php $no = 1;
                                        foreach ($reportOut as $row) :
                                        ?>
                                          <tr>
                                              <td><?= $no++; ?></td>
                                              <td><?= $row->invoice_number ?></td>
                                              <td><?= $row->nama_karyawan ?><br><small><b><?= $row->nama_departement ?></b></small></td>
                                              <td><?= $row->nama_brg ?></td>
                                              <td><strong><?= $row->jumlah ?></strong></td>
                                              <td><?php echo date('d F Y', strtotime($row->created_at)); ?></td>
                                              <td>
                                                  <?php if ($row->status_barang_keluar == 'success') { ?>
                                                      <span class="badge badge-primary text-white"> Berhasil </span>
                                                  <?php } elseif ($row->status_barang_keluar == 'failed') { ?>
                                                      <span class="badge badge-danger text-white"> Gagal </span>
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