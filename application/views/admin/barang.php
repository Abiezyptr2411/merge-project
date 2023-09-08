  <!--  BEGIN CONTENT AREA  -->
  <div id="content" class="main-content">
     <div class="layout-px-spacing">



        <div class="row layout-top-spacing" id="cancel-row">

           <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
              <div class="widget widget-chart-three">
                 <div class="widget-heading">
                    <div class="">
                       <h5 class="">Data Inventaris Kantor</h5>
                    </div>

                    <div class="dropdown ">
                       <a class="dropdown-toggle" href="<?= site_url('admin/barang/add') ?>" role="button">
                          <i class="fas fa-plus-circle fa-lg text-primary"></i>
                       </a>
                    </div>
                 </div>

                 <div class="widget-content">
                    <div class="widget-content widget-content-area br-6">
                       <a href="<?php echo base_url('admin/barang/exportExcel'); ?>" class="mb-2 mt-4 mr-3" style="float: right;">
                          <i class="fas fa-file-excel fa-xl text-success"></i>
                       </a>
                       <table id="zero-config" class="table table-striped" style="width:100%">
                          <thead>
                             <tr>
                                <th>No.</th>
                                <th>Kode</th>
                                <th>Kategori</th>
                                <th>Merek</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Kondisi</th>
                                <th class="no-content">Lokasi</th>
                                <th class="no-content"></th>
                             </tr>
                          </thead>
                          <tbody>
                             <?php $no = 1;
                              foreach ($barang as $row) : ?>
                                <tr>
                                   <td><?= $no++; ?></td>
                                   <td class="text-secondary"><strong><?= $row->id_brg ?></strong></td>
                                   <td><strong><?= $row->nama_kategori ?></strong></td>
                                   <td><strong><?= $row->nama_brg ?></strong></td>
                                   <td>Rp. <?= number_format($row->harga) ?></td>
                                   <td><?= number_format($row->stok) ?></td>
                                   <td>
                                      <?php if ($row->kondisi == "Baik") { ?>
                                         <span class="badge badge-success"> Baik </span>
                                      <?php } else { ?>
                                         <span class="badge badge-warning"> Rusak </span>
                                      <?php } ?>
                                   </td>
                                   <td><?= $row->nama_unit ?></td>
                                   <td>
                                      <div class="dropdown ">
                                         <a class="dropdown-toggle" href="#" role="button" id="uniqueVisitors" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal">
                                               <circle cx="12" cy="12" r="1"></circle>
                                               <circle cx="19" cy="12" r="1"></circle>
                                               <circle cx="5" cy="12" r="1"></circle>
                                            </svg>
                                         </a>

                                         <div class="dropdown-menu mt-4" aria-labelledby="uniqueVisitors">
                                            <a class="dropdown-item" href="<?= site_url('admin/barang/update/' . $row->id_brg) ?>">Update</a>
                                            <a class="dropdown-item" href="<?= site_url('admin/barang/delete/' . $row->id_brg) ?>">Delete</a>
                                         </div>
                                      </div>
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