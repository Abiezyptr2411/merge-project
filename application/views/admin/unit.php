  <!--  BEGIN CONTENT AREA  -->
  <div id="content" class="main-content">
     <div class="layout-px-spacing">



        <div class="row layout-top-spacing" id="cancel-row">

           <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
              <div class="widget widget-chart-three">
                 <div class="widget-heading">
                    <div class="">
                       <h5 class="">Data Kategori</h5>
                    </div>

                    <div class="dropdown ">
                       <a class="dropdown-toggle" href="javascript:void(0);" data-toggle="modal" data-target="#exampleModalCenter" role="button">
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
                                <th>Lokasi Unit</th>
                                <th class="no-content"></th>
                             </tr>
                          </thead>
                          <tbody>
                             <?php $no = 1;
                              foreach ($unit as $row) : ?>
                                <tr>
                                   <td><?= $no++; ?></td>
                                   <td class="text-secondary"><strong><?= $row->nama_unit ?></strong></td>
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
                                            <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#exampleModalCenter<?= $row->id_unit ?>">Update</a>
                                            <a class="dropdown-item" href="<?= site_url('admin/unit/delete/' . $row->id_unit) ?>">Delete</a>
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

  <!-- Modal create-->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
           <div class="modal-header">
              <h5 class="modal-title" id="exampleModalCenterTitle"><strong>Tambah Lokasi Unit</strong></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                 </svg>
              </button>
           </div>
           <form action="<?= site_url('admin/unit/proses') ?>" method="post">
              <div class="modal-body">
                 <div class="row">
                    <div class="col-md-12">
                       <label class="ml-1">Lokasi Unit <span class="text-danger">*</span></label>
                       <input type="text" name="nama_unit" class="form-control" placeholder="Nama Lokasi Unit">
                    </div>
                 </div>
              </div>
              <div class="modal-footer">
                 <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                 <button type="submit" class="btn btn-primary">Save</button>
              </div>
           </form>
        </div>
     </div>
  </div>


  <!-- Modal update-->
  <?php foreach ($unit as $row) : ?>
     <div class="modal fade" id="exampleModalCenter<?= $row->id_unit ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
           <div class="modal-content">
              <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalCenterTitle"><strong>Ubah Data Unit</i></strong></h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                       <line x1="18" y1="6" x2="6" y2="18"></line>
                       <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                 </button>
              </div>
              <form action="<?= site_url('admin/unit/proses_ubah') ?>" method="post">
                 <div class="modal-body">
                    <div class="row">

                       <div class="col-md-12">
                          <label class="ml-1">Lokasi Unit <span class="text-danger">*</span></label>
                          <input type="hidden" name="id_unit" value="<?= $row->id_unit ?>">
                          <input type="text" name="nama_unit" class="form-control" value="<?= $row->nama_unit ?>">
                       </div>
                    </div>
                 </div>
                 <div class="modal-footer">
                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                 </div>
              </form>
           </div>
        </div>
     </div>
  <?php endforeach; ?>