    <div id="content" class="main-content">
       <div class="layout-px-spacing">



          <div class="account-settings-container layout-top-spacing">

             <div class="account-content">
                <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                   <div class="row">
                      <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                         <?php foreach ($general as $g) : ?>
                            <form id="general-info" action="<?= site_url('pegawai/settings/update_general') ?>" method="post" class="section general-info">
                               <div class="info">
                                  <h6 class="">General Information</h6>
                                  <div class="row">
                                     <div class="col-lg-11 mx-auto">
                                        <div class="row">
                                           <div class="col-xl-2 col-lg-12 col-md-4">
                                              <div class="upload mt-4 pr-md-4">
                                                 <img src="<?= base_url('assets/default.jpg') ?>" class="img-fluid" alt="avatar">
                                              </div>
                                           </div>
                                           <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                                              <div class="form">
                                                 <div class="row">
                                                    <div class="col-sm-4">
                                                       <div class="form-group">
                                                          <label>Nama Lengkap</label>
                                                          <input type="hidden" name="user_id" value="<?= $g->user_id ?>">
                                                          <input type="text" name="nama_karyawan" class="form-control mb-4" value="<?= $g->nama_karyawan ?>">
                                                       </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                       <div class="form-group">
                                                          <label>NIK KTP</label>
                                                          <input type="text" name="nik" class="form-control mb-4" value="<?= $g->nik ?>">
                                                       </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                       <div class="form-group">
                                                          <label>NOMOR KK</label>
                                                          <input type="text" name="no_kk" class="form-control mb-4" value="<?= $g->no_kk ?>">
                                                       </div>
                                                    </div>
                                                    <div class="col-sm-8">
                                                       <div class="form-group">
                                                          <label>Email</label>
                                                          <input type="text" name="email" class="form-control mb-4" value="<?= $g->email ?>">
                                                       </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                       <div class="form-group">
                                                          <label>Nomor Telp</label>
                                                          <?php if ($g->no_telp === null) : ?>
                                                             <input type="number" name="no_telp" class="form-control mb-4" value="0">
                                                          <?php else : ?>
                                                             <input type="number" name="no_telp" class="form-control mb-4" value="<?= $g->no_telp ?>">
                                                          <?php endif; ?>
                                                       </div>
                                                    </div>

                                                 </div>
                                                 <div class="form-group">
                                                    <label>Alamat</label>
                                                    <input type="text" name="alamat" class="form-control mb-4" value="<?= $g->alamat ?>">
                                                 </div>
                                                 <hr>
                                                 <button type="submit" class="btn btn-primary btn-block">UBAH DATA</button>
                                              </div>
                                           </div>
                                        </div>
                                     </div>
                                  </div>
                               </div>
                            </form>
                         <?php endforeach; ?>
                      </div>

                      <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                         <?php foreach ($bio as $bio) : ?>
                            <form id="about" action="<?= site_url('pegawai/settings/about') ?>" method="post" class="section about">
                               <div class="info">
                                  <h5 class="">About</h5>
                                  <div class="row">
                                     <div class="col-md-11 mx-auto">
                                        <div class="form-group">
                                           <label for="aboutBio">Bio</label>
                                           <input type="hidden" name="user_id" value="<?= $bio->user_id ?>">
                                           <textarea class="form-control" name="bio" rows="10"><?= $bio->bio; ?></textarea>
                                        </div>
                                     </div>
                                  </div>
                                  <div class="col-md-12 text-right mb-5">
                                     <button type="submit" class="btn btn-primary mr-5 mt-3">UBAH DATA</button>
                                  </div>
                               </div>
                            </form>
                         <?php endforeach; ?>
                      </div>

                      <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                         <?php foreach ($account as $akun) : ?>
                            <form id="edu-experience" action="<?= site_url('pegawai/settings/ubah_akun') ?>" method="post" class="section edu-experience">
                               <div class="info">
                                  <h5 class="">Pengaturan Akun</h5>
                                  <div class="row">
                                     <div class="col-md-11 mx-auto">

                                        <div class="edu-section">
                                           <div class="row">
                                              <div class="col-md-12">
                                                 <label>Username</label>
                                                 <div class="input-group mb-4">
                                                    <div class="input-group-append">
                                                       <span class="input-group-text">
                                                          @
                                                       </span>
                                                    </div>
                                                    <input type="text" name="username" class="form-control form-control-user" value="<?= $akun->username ?>">
                                                 </div>
                                              </div>
                                              <div class="col-sm-6">
                                                 <label>Kata Sandi</label>
                                                 <div class="input-group">
                                                    <div class="input-group-append">
                                                       <span class="input-group-text">
                                                          <i class="fas fa-lock"></i>
                                                       </span>
                                                    </div>
                                                    <input type="password" name="password" class="form-control form-control-user" placeholder="Password">
                                                 </div>
                                              </div>
                                              <div class="col-sm-6">
                                                 <label>Ulangi Kata Sandi</label>
                                                 <div class="input-group">
                                                    <div class="input-group-append">
                                                       <span class="input-group-text">
                                                          <i class="fas fa-lock"></i>
                                                       </span>
                                                    </div>
                                                    <input type="password" name="confirm_password" class="form-control form-control-user" placeholder="Password">
                                                 </div>
                                              </div>
                                           </div>

                                        </div>

                                     </div>
                                  </div>
                                  <div class="col-md-12 text-right mb-5">
                                     <button type="submit" class="btn btn-primary mr-5 mt-3">UBAH AKUN</button>
                                  </div>
                               </div>
                            </form>
                         <?php endforeach; ?>
                      </div>

                   </div>
                </div>
             </div>
          </div>

       </div>
    </div>