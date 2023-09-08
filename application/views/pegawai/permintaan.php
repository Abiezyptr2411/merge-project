  <!--  BEGIN CONTENT AREA  -->
  <div id="content" class="main-content">
      <div class="layout-px-spacing">



          <div class="row layout-top-spacing" id="cancel-row">

              <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                  <div class="widget widget-chart-three">
                      <div class="widget-heading">
                          <div class="">
                              <h5 class="">Pengajuan Permintaan Barang</h5>
                          </div>

                          <div class="dropdown ">
                              <a class="dropdown-toggle" href="<?= site_url('pegawai/permintaan/pengajuan') ?>" role="button">
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
                                          <th>Tanggal Pengajuan</th>
                                          <th>Nama Karyawan</th>
                                          <th>Nama Barang</th>
                                          <th>Qty</th>
                                          <th>Status</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php
                                        $no = 1;
                                        foreach ($request as $row) : ?>
                                          <tr>
                                              <td><?= $no++; ?></td>
                                              <td><?php echo date('d F Y', strtotime($row->date_request)); ?></td>
                                              <td><?= $row->nama_karyawan ?></td>
                                              <td><?= $row->nama_brg ?></td>
                                              <td><?= $row->qty ?></td>
                                              <td>
                                                  <?php if ($row->status_permintaan === 'waiting confirm') : ?>
                                                      <span class="badge badge-warning">Menunggu Konfirmasi</span>
                                                  <?php elseif ($row->status_permintaan === 'accepted') : ?>
                                                      <span class="badge badge-success">Diterima</span>
                                                  <?php elseif ($row->status_permintaan === 'rejected') : ?>
                                                      <span class="badge badge-danger">Ditolak</span>
                                                  <?php elseif ($row->status_permintaan === 'return') : ?>
                                                      <span class="badge badge-primary">Barang Kembali</span>
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