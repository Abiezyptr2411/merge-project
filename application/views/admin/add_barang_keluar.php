<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
    <div class="layout-px-spacing">

        <form action="<?= site_url('admin/barang_keluar/add_proses'); ?>" method="post" enctype="multipart/form-data">
            <div class="row justify-content-center align-items-center layout-top-spacing">
                <div class="col-xl-8 col-lg-6 col-md-12 col-sm-12 col-12 layout-spacing">
                    <div class="widget widget-chart-three">
                        <div class="widget-heading">
                            <div class="">
                                <h5 class="">Tambah Barang Keluar</h5>
                            </div>
                        </div>

                        <div class="widget-content">
                            <div class="row ml-2 mt-4 mr-2 mb-2">
                                <div class="col-md-6">
                                    <label class="ml-1">Nama Barang <span class="text-danger">*</span></label>
                                    <input type="hidden" name="status" class="form-control" value="success">
                                    <select name="id_brg" class="form-control basic-jabatan">
                                        <?php foreach ($product as $row) : ?>
                                            <option value="<?= $row->id_brg ?>"><?= $row->nama_brg ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="ml-1">Nama Peminjam <span class="text-danger">*</span></label>
                                    <select name="id_karyawan" class="form-control basic-jabatan">
                                        <?php foreach ($karyawan as $row) : ?>
                                            <option value="<?= $row->id_karyawan ?>"><?= $row->nama_karyawan ?> - <?= $row->nama_departement ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row ml-2 mt-4 mr-2 mb-2">
                                <div class="col-md-12">
                                    <label class="ml-1">Quantity <span class="text-danger">*</span></label>
                                    <input type="number" name="jumlah" class="form-control" required>
                                </div>
                            </div>
                            <hr>
                            <div class="col-md-12 mt-3">
                                <button type="submit" class="btn btn-primary btn-block mt-2 mb-4">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!--  END CONTENT AREA  -->


</div>
<!-- END MAIN CONTAINER -->