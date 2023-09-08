  <!--  BEGIN CONTENT AREA  -->
  <div id="content" class="main-content">
     <div class="layout-px-spacing">



        <div class="row layout-top-spacing" id="cancel-row">

           <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
              <div class="widget widget-chart-three">
                 <div class="widget-heading">
                    <div class="">
                       <h5 class="">Filter Laporan Absen</h5>
                    </div>

                    <div class="dropdown ">
                       <a class="dropdown-toggle" href="<?php echo base_url('admin/laporan_absen/exportExcel'); ?>" role="button">
                          <i class="fas fa-file-excel fa-xl text-success"></i>
                       </a>
                    </div>
                 </div>

                 <div class="widget-content">
                    <div class="widget-content widget-content-area br-6">
                       <form action="<?= site_url('admin/laporan_absen/filter') ?>" method="post">
                          <div class="row ml-2 mt-4 mr-2 mb-2">
                             <div class="col-md-4">
                                <label class="ml-1">Tanggal Absen <span class="text-danger">*</span></label>
                                <input type="date" name="tanggal" class="form-control">
                             </div>

                             <div class="col-md-4">
                                <label class="ml-1">Keterangan <span class="text-danger">*</span></label>
                                <select name="keterangan" class="form-control">
                                   <option value="">Pilih Keterangan</option>
                                   <option value="Masuk">Masuk</option>
                                   <option value="Pulang">Pulang</option>
                                </select>
                             </div>
                             <button type="submit" class="mt-4 ml-5 btn btn-secondary btn-rounded"><i class="fas fa-search"></i>&nbsp; Filter Data</button>
                          </div>
                          <br>
                       </form>

                       <table id="zero-config" class="table table-striped" style="width:100%">
                          <thead>
                             <tr>
                                <th>Tanggal</th>
                                <th>Nama</th>
                                <th>Waktu Kerja</th>
                                <th>Kondisi</th>
                                <th>Aktivitas</th>
                                <th>Waktu Absen</th>
                                <th>Lokasi</th>
                                <th class="no-content">Keterangan</th>
                             </tr>
                          </thead>
                          <tbody>
                             <?php $no = 1;
                              foreach ($absen as $row) : ?>
                                <tr>
                                   <td><?php echo date('d F Y', strtotime($row->estimated)); ?></td>
                                   <td><strong><?= $row->nama_karyawan ?></strong> <br><?= $row->id_karyawan ?></td>
                                   <td><?= $row->shift_line ?></td>
                                   <td><strong><?= $row->kondisi_kesehatan ?></strong></td>
                                   <td><?= $row->aktivitas ?></td>
                                   <td>
                                      <?php
                                       // Mengatur zona waktu ke WIB
                                       date_default_timezone_set('Asia/Jakarta');

                                       // Mengambil data waktu dari $row->waktu dan mengonversinya ke format yang diinginkan
                                       $waktu = strtotime($row->waktu);
                                       $formattedTime = date('d F Y, H:i', $waktu);

                                       // Menambahkan informasi WIB
                                       $formattedTimeWithWIB = $formattedTime . ' WIB';

                                       echo $formattedTimeWithWIB;
                                       ?>
                                   </td>
                                   <?php
                                    // Mencari koordinat Latitude dan Longitude dalam string
                                    preg_match('/Latitude: ([-\d.]+), Longitude: ([-\d.]+)/', $row->lokasi_kerja, $matches);

                                    if (count($matches) == 3) {
                                       // Ambil nilai Latitude dan Longitude
                                       $latitude = trim($matches[1]);
                                       $longitude = trim($matches[2]);

                                       // URL Google Maps dengan koordinat Latitude dan Longitude
                                       $mapsUrl = "https://www.google.com/maps?q={$latitude},{$longitude}";
                                    } else {
                                       $mapsUrl = '#'; // Tautan tidak valid jika format tidak sesuai
                                    }
                                    ?>
                                   <td><a href="<?= $mapsUrl ?>" class="text-primary"><?= $row->lokasi_kerja ?></a></td>
                                   <td>
                                      <?php if ($row->keterangan == "masuk") { ?>
                                         <span class="badge badge-success"> Masuk </span>
                                      <?php } else { ?>
                                         <span class="badge badge-danger"> Pulang </span>
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