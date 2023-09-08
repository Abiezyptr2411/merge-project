  <!--  BEGIN CONTENT AREA  -->
  <div id="content" class="main-content">
     <div class="layout-px-spacing">



        <div class="row layout-top-spacing" id="cancel-row">

           <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
              <div class="widget widget-chart-three">
                 <div class="widget-heading">
                    <div class="">
                       <h5 class="">Data Jabatan</h5>
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
                                <th>Nama Jabatan</th>
                                <th>Gaji Pokok</th>
                                <th>Tunjangan Jabatan</th>
                                <th>Tunjangan Makan</th>
                                <th>Tunjangan Aktifitas</th>
                                <th>Pajak</th>
                                <th>BPJS</th>
                                <th class="no-content"></th>
                             </tr>
                          </thead>
                          <tbody>
                             <?php foreach ($jabatan as $j) : ?>
                                <tr>
                                   <td><strong><?= $j->nama_jabatan ?></strong></td>
                                   <td>Rp. <?= number_format($j->gaji_pokok, 2) ?></td>
                                   <td>Rp. <?= number_format($j->tunjangan_jabatan, 2) ?></td>
                                   <td>Rp. <?= number_format($j->tunjangan_makan, 2) ?></td>
                                   <td>Rp. <?= number_format($j->tunjangan_aktifitas, 2) ?></td>
                                   <td><b><?= $j->tipe_pajak ?></b> <br>Rp. <?= number_format($j->nominal_pajak, 2) ?></td>
                                   <td>Rp. <?= number_format($j->bpjs, 2) ?></td>
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
                                            <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#exampleModalCenter<?= $j->id_jabatan ?>">Update</a>
                                            <a class="dropdown-item" href="<?= site_url('admin/jabatan/delete/' . $j->id_jabatan) ?>">Delete</a>
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
     <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
           <div class="modal-header">
              <h5 class="modal-title" id="exampleModalCenterTitle"><strong>Tambah Jabatan</strong></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                 </svg>
              </button>
           </div>
           <form action="<?= site_url('admin/jabatan/proses') ?>" method="post">
              <div class="modal-body">
                 <div class="row">
                    <div class="col-md-6">
                       <label class="ml-1">Nama Jabatan <span class="text-danger">*</span></label>
                       <input type="text" name="nama_jabatan" class="form-control" placeholder="Nama Jabatan">
                    </div>

                    <div class="col-md-6">
                       <label class="ml-1">Gaji Pokok <span class="text-danger">*</span></label>
                       <input type="text" name="gaji_pokok" class="form-control" placeholder="Rp. 0.00">
                    </div>

                    <div class="col-md-6 mt-3">
                       <label class="ml-1">Tunjangan Jabatan <span class="text-danger">*</span></label>
                       <input type="text" name="tunjangan_jabatan" class="form-control" placeholder="Rp. 0.00">
                    </div>

                    <div class="col-md-6 mt-3">
                       <label class="ml-1">Tunjangan Makan <span class="text-danger">*</span></label>
                       <input type="text" name="tunjangan_makan" class="form-control" placeholder="Rp. 0.00">
                    </div>

                    <div class="col-md-6 mt-3">
                       <label class="ml-1">Tunjangan Aktifitas <span class="text-danger">*</span></label>
                       <input type="text" name="tunjangan_aktifitas" class="form-control" placeholder="Rp. 0.00">
                    </div>

                    <div class="col-md-3 mt-3">
                       <label class="ml-1">Tipe Pajak <span class="text-danger">*</span></label>
                       <select name="tipe_pajak" class="form-control">
                          <option value="PPH 23">PPH 23</option>
                       </select>
                    </div>

                    <div class="col-md-3 mt-3">
                       <label class="ml-1">Nominal Pajak <span class="text-danger">*</span></label>
                       <input type="text" name="nominal_pajak" class="form-control" placeholder="Rp. 0.00">
                    </div>

                    <div class="col-md-6 mt-3">
                       <label class="ml-1">BPJS TK & Kes <span class="text-danger">*</span></label>
                       <input type="text" name="bpjs" class="form-control" placeholder="Rp. 0.00">
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
  <?php foreach ($jabatan as $j) : ?>
     <div class="modal fade" id="exampleModalCenter<?= $j->id_jabatan ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
           <div class="modal-content">
              <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalCenterTitle"><strong>Ubah Jabatan : <i><?= $j->nama_jabatan ?></i></strong></h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                       <line x1="18" y1="6" x2="6" y2="18"></line>
                       <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                 </button>
              </div>
              <form action="<?= site_url('admin/jabatan/proses_ubah') ?>" method="post">
                 <div class="modal-body">
                    <div class="row">

                       <div class="col-md-6">
                          <label class="ml-1">Gaji Pokok <span class="text-danger">*</span></label>
                          <input type="hidden" name="id_jabatan" value="<?= $j->id_jabatan ?>">
                          <input type="text" name="gaji_pokok" class="form-control" <?= $j->gaji_pokok !== null ? 'value="' . $j->gaji_pokok . '"' : 'placeholder="Rp. 0.00"' ?>>
                       </div>

                       <div class="col-md-6">
                          <label class="ml-1">Tunjangan Jabatan <span class="text-danger">*</span></label>
                          <input type="text" name="tunjangan_jabatan" class="form-control" <?= $j->tunjangan_jabatan !== null ? 'value="' . $j->tunjangan_jabatan . '"' : 'placeholder="Rp. 0.00"' ?>>
                       </div>

                       <div class="col-md-6 mt-3">
                          <label class="ml-1">Tunjangan Makan <span class="text-danger">*</span></label>
                          <input type="text" name="tunjangan_makan" class="form-control" <?= $j->tunjangan_makan !== null ? 'value="' . $j->tunjangan_makan . '"' : 'placeholder="Rp. 0.00"' ?>>
                       </div>

                       <div class="col-md-6 mt-3">
                          <label class="ml-1">Tunjangan Aktifitas <span class="text-danger">*</span></label>
                          <input type="text" name="tunjangan_aktifitas" class="form-control" <?= $j->tunjangan_aktifitas !== null ? 'value="' . $j->tunjangan_aktifitas . '"' : 'placeholder="Rp. 0.00"' ?>>
                       </div>


                       <div class="col-md-3 mt-3">
                          <label class="ml-1">Tipe Pajak <span class="text-danger">*</span></label>
                          <select name="tipe_pajak" class="form-control">
                             <option value="<?= $j->tipe_pajak ?>" hidden><?= $j->tipe_pajak ?></option>
                             <option value="PPH 23">PPH 23</option>
                          </select>
                       </div>

                       <div class="col-md-3 mt-3">
                          <label class="ml-1">Nominal Pajak <span class="text-danger">*</span></label>
                          <input type="text" name="nominal_pajak" class="form-control" <?= $j->nominal_pajak !== null ? 'value="' . $j->nominal_pajak . '"' : 'placeholder="Rp. 0.00"' ?>>
                       </div>

                       <div class="col-md-6 mt-3">
                          <label class="ml-1">BPJS TK & Kes <span class="text-danger">*</span></label>
                          <input type="text" name="bpjs" class="form-control" <?= $j->bpjs !== null ? 'value="' . $j->bpjs . '"' : 'placeholder="Rp. 0.00"' ?>>
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