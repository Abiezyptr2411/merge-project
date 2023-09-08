  <!--  BEGIN CONTENT AREA  -->
  <div id="content" class="main-content">
     <div class="layout-px-spacing">



        <div class="row layout-top-spacing" id="cancel-row">

           <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
              <div class="widget widget-chart-three">
                 <div class="widget-heading">
                    <div class="">
                       <h5 class="">Data Karyawan</h5>
                    </div>

                    <div class="dropdown ">
                       <a class="dropdown-toggle" href="<?= site_url('admin/karyawan/add') ?>" role="button">
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
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Dept.</th>
                                <th>Nik</th>
                                <th>No. KK</th>
                                <th>Alamat</th>
                                <th>No. Kontrak</th>
                                <th>Tgl Kontrak</th>
                                <th>Tgl. Berakhir</th>
                                <th class="no-content"></th>
                             </tr>
                          </thead>
                          <tbody>
                             <?php $no = 1;
                              foreach ($karyawan as $row) : ?>
                                <tr>
                                   <td><?= $no++; ?></td>
                                   <td><strong><?= $row->nama_karyawan ?></strong><br><?= $row->id_karyawan ?></td>
                                   <td><?= $row->nama_jabatan ?></td>
                                   <td><?= $row->nama_departement ?></td>
                                   <td><?= $row->nik ?></td>
                                   <td><?= $row->no_kk ?></td>
                                   <td><?= $row->alamat ?></td>
                                   <td><?= $row->no_kontrak ?></td>
                                   <td><?php echo date('d F Y', strtotime($row->tgl_kontrak)); ?></td>
                                   <td><?php echo date('d F Y', strtotime($row->tgl_kontrak_berakhir)); ?></td>
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
                                            <a class="dropdown-item" href="<?= site_url('admin/karyawan/update/' . $row->id_karyawan) ?>">Update</a>
                                            <a class="dropdown-item" href="<?= site_url('admin/karyawan/delete/' . $row->id_karyawan) ?>">Delete</a>
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