  <!--  BEGIN CONTENT AREA  -->
  <div id="content" class="main-content">
      <div class="layout-px-spacing">



          <div class="row layout-top-spacing" id="cancel-row">

              <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                  <div class="widget widget-chart-three">
                      <div class="widget-heading">
                          <div class="">
                              <h5 class="">Hasil Laporan Mutasi Barang</h5>
                          </div>

                          <div class="dropdown ">
                              <a class="dropdown-toggle" href="<?= site_url('admin/report_mutasi/exportExcel/' . $id_brg) ?>" role="button">
                                  <i class="fas fa-file-excel fa-xl text-success"></i>
                              </a>
                          </div>
                      </div>

                      <div class="widget-content">
                          <div class="widget-content widget-content-area br-6">
                              <form action="<?= site_url('admin/report_mutasi/filter') ?>" method="post">
                                  <div class="row ml-2 mt-3 mr-2 mb-2">
                                      <div class="col-md-5">
                                          <label class="ml-1">Pilih Barang</label>
                                          <select name="id_brg" class="form-control basic-jabatan">
                                              <option value="">-- Pilih Barang --</option>
                                              <?php foreach ($product as $row) : ?>
                                                  <option value="<?= $row->id_brg ?>"><?= $row->nama_brg ?></option>
                                              <?php endforeach; ?>
                                          </select>
                                      </div>
                                      <button type="submit" class="mt-4 ml-3 btn btn-secondary btn-rounded"><i class="fas fa-search"></i>&nbsp; Filter Data</button>
                                  </div>
                                  <hr>
                              </form>

                              <table id="zero-config" class="table table-striped" style="width:100%">
                                  <thead>
                                      <tr>
                                          <th>No.</th>
                                          <th>Barang ID</th>
                                          <th>Nama Barang</th>
                                          <th>Tgl Barang Masuk</th>
                                          <th>Jumlah Masuk</th>
                                          <th>Tgl Barang Keluar</th>
                                          <th>Jumlah Keluar</th>
                                          <th class="no-content">Sisa Stok</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php $no = 1;
                                        foreach ($reportMut as $row) :
                                        ?>
                                          <tr>
                                              <td><?= $no++; ?></td>
                                              <td><?= $row->id_brg ?></td>
                                              <td><?= $row->nama_brg ?></td>
                                              <td><?php echo date('d F Y', strtotime($row->date_in)); ?></td>
                                              <td><strong><?= $row->jumlah_masuk ?></strong></td>
                                              <td><?php echo date('d F Y', strtotime($row->date_in)); ?></td>
                                              <td><strong><?= $row->jumlah_keluar ?></strong></td>
                                              <td><strong><?= $row->saldo ?></strong></td>
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