  <!--  BEGIN CONTENT AREA  -->
  <div id="content" class="main-content">
      <div class="layout-px-spacing">
          <div class="row layout-top-spacing" id="cancel-row">
              <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                  <div class="widget widget-chart-three">
                      <div class="widget-heading">
                          <div class="">
                              <h5 class="">Barang Masuk</h5>
                          </div>

                          <div class="dropdown ">
                              <a class="dropdown-toggle" href="<?= site_url('admin/barang_masuk/add') ?>" role="button">
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
                                          <th>Tgl Masuk Barang</th>
                                          <th>Invoice ID</th>
                                          <th>Nama Barang</th>
                                          <th>Qty</th>
                                          <th>Status</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php
                                        $no = 1;
                                        foreach ($productIn as $row) : ?>
                                          <tr>
                                              <td><?= $no++; ?></td>
                                              <td><?php echo date('d F Y', strtotime($row->created_at)); ?></td>
                                              <td><?= $row->invoice_number ?></td>
                                              <td><strong><?= $row->nama_brg ?></strong> <br><small>Product ID : <b><?= $row->id_brg ?></b></small></td>
                                              <td><?= $row->jumlah ?></td>
                                              <td>
                                                  <?php if ($row->status_barang_masuk === 'success') : ?>
                                                      <span class="badge badge-success">Berhasil</span>
                                                  <?php elseif ($row->status_barang_masuk === 'failed') : ?>
                                                      <span class="badge badge-danger">Gagal</span>
                                                  <?php endif; ?>
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