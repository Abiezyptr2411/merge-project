 <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
 <script src="<?= base_url('assets') ?>/js/libs/jquery-3.1.1.min.js"></script>
 <script src="<?= base_url('bootstrap') ?>/js/popper.min.js"></script>
 <script src="<?= base_url('bootstrap') ?>/js/bootstrap.min.js"></script>
 <script src="<?= base_url('plugins') ?>/perfect-scrollbar/perfect-scrollbar.min.js"></script>
 <script src="<?= base_url('assets') ?>/js/app.js"></script>
 <script src="<?= base_url('plugins') ?>/select2/select2.min.js"></script>
 <script src="<?= base_url('plugins') ?>/select2/custom-select2.js"></script>
 <script src="<?= base_url('plugins') ?>/js/scrollspyNav.js"></script>
 <script src="<?= base_url('plugins') ?>/dropify/dropify.min.js"></script>
 <script src="<?= base_url('plugins') ?>/flatpickr/flatpickr.js"></script>
 <script src="<?= base_url('assets') ?>/js/apps/invoice-add.js"></script>
 <script>
    $(document).ready(function() {
       App.init();
    });
 </script>
 <script src="<?= base_url('assets') ?>/js/custom.js"></script>
 <!-- END GLOBAL MANDATORY SCRIPTS -->

 <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
 <script src="<?= base_url('plugins') ?>/apex/apexcharts.min.js"></script>
 <script src="<?= base_url('assets') ?>/js/dashboard/dash_1.js"></script>
 <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

 <!-- BEGIN PAGE LEVEL SCRIPTS -->
 <script src="<?= base_url('plugins') ?>/table/datatable/datatables.js"></script>
 <script>
    $('#zero-config').DataTable({
       "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
          "<'table-responsive'tr>" +
          "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
       "oLanguage": {
          "oPaginate": {
             "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
             "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
          },
          "sInfo": "Showing page _PAGE_ of _PAGES_",
          "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
          "sSearchPlaceholder": "Search...",
          "sLengthMenu": "Results :  _MENU_",
       },
       "stripeClasses": [],
       "lengthMenu": [7, 10, 20, 50],
       "pageLength": 7
    });
 </script>

 <script>
    function confirmStatusChange(url) {
       Swal.fire({
          title: 'Confirmation Request',
          text: 'Anda yakin ingin menerima permintaan ini?',
          icon: 'info',
          showCancelButton: true,
          confirmButtonColor: '#800080',
          cancelButtonColor: '#FFA500',
          confirmButtonText: 'Ya, Terima!'
       }).then((result) => {
          if (result.isConfirmed) {
             window.location.href = url;
          }
       });
    }

    function rejectStatusChange(url) {
       Swal.fire({
          title: 'Confirmation Reject',
          text: 'Anda yakin ingin tolak permintaan ini?',
          icon: 'error',
          showCancelButton: true,
          confirmButtonColor: '#800080',
          cancelButtonColor: '#FFA500',
          confirmButtonText: 'Ya, Tolak!'
       }).then((result) => {
          if (result.isConfirmed) {
             window.location.href = url;
          }
       });
    }

    function returnStatusChange(url) {
       Swal.fire({
          title: 'Confirmation Return',
          text: 'Anda yakin barang tersebut telah kembali?',
          icon: 'success',
          showCancelButton: true,
          confirmButtonColor: '#800080',
          cancelButtonColor: '#FFA500',
          confirmButtonText: 'Ya, Yakin!'
       }).then((result) => {
          if (result.isConfirmed) {
             window.location.href = url;
          }
       });
    }
 </script>

 <!-- END PAGE LEVEL SCRIPTS -->

 <script>
    var ss = $(".basic-jabatan").select2({
       tags: true,
       language: {
          noResults: function() {
             return "Data not found";
          }
       },
       createTag: function(params) {
          // Prevent creation of new tags
          return null;
       }
    });
 </script>

 <script>
    var ss = $(".basic-dept").select2({
       tags: true,
       language: {
          noResults: function() {
             return "Data not found";
          }
       },
       createTag: function(params) {
          // Prevent creation of new tags
          return null;
       }
    });
 </script>

 <script>
    $(document).ready(function() {
       <?php if ($this->session->flashdata('success')) : ?>
          Swal.fire({
             icon: 'success',
             title: 'Sukses!',
             text: '<?= $this->session->flashdata("success") ?>',
          });
       <?php endif; ?>
    });

    $(document).ready(function() {
       <?php if ($this->session->flashdata('failed')) : ?>
          Swal.fire({
             icon: 'error',
             title: 'Opps!',
             text: '<?= $this->session->flashdata("failed") ?>',
          });
       <?php endif; ?>
    });
 </script>

 <!-- <script>
    const selectKaryawan = $('#selectKaryawan');
    const inputJabatan = $('#inputJabatan');
    const inputDepartemen = $('#inputDepartemen');
    const inputGajiPokok = $('#inputGajiPokok');
    const inputTunjanganJabatan = $('#inputTunjanganJabatan');
    const inputTunjanganMakan = $('#inputTunjanganMakan');
    const inputTunjanganAktifitas = $('#inputTunjanganAktifitas');
    const inputTipePajak = $('#inputTipePajak');
    const inputNominalPajak = $('#inputNominalPajak');
    const inputBPJS = $('#inputBPJS');

    selectKaryawan.on('change', function() {
       const selectedValue = selectKaryawan.val();

       // Menggunakan jQuery AJAX untuk mengambil data terkait
       $.ajax({
          url: "<?php echo site_url('admin/payslip/getKaryawanDetail/') ?>" + selectedValue,
          method: 'GET',
          dataType: 'json',
          success: function(data) {
             // Menampilkan data terkait di dalam form
             inputJabatan.val(data.nama_jabatan);
             inputDepartemen.val(data.nama_departement);
             inputGajiPokok.val(data.gaji_pokok);
             inputTunjanganJabatan.val(data.tunjangan_jabatan);
             inputTunjanganMakan.val(data.tunjangan_makan);
             inputTunjanganAktifitas.val(data.tunjangan_aktifitas);
             inputTipePajak.val(data.tipe_pajak);
             inputNominalPajak.val(data.nominal_pajak);
             inputBPJS.val(data.bpjs);
          },
          error: function(xhr, status, error) {
             console.error('Error:', error);
          }
       });
    });
 </script> -->

 <script>
    const selectKaryawan = $('#selectKaryawan');
    const inputIDJabatan = $('#inputIDJabatan');
    const inputJabatan = $('#inputJabatan');
    const inputUser = $('#inputUser');
    const inputIDKaryawan = $('#inputIDKaryawan');
    const inputIDDepartement = $('#inputIDDepartement');
    const inputDepartemen = $('#inputDepartemen');
    const inputGajiPokok = $('#inputGajiPokok');
    const inputTunjanganJabatan = $('#inputTunjanganJabatan');
    const inputTunjanganMakan = $('#inputTunjanganMakan');
    const inputTunjanganAktifitas = $('#inputTunjanganAktifitas');
    const inputTipePajak = $('#inputTipePajak');
    const inputNominalPajak = $('#inputNominalPajak');
    const inputBPJS = $('#inputBPJS');
    const inputUpahLembur = $('#inputUpahLembur'); // Menambah input untuk menampilkan upah lembur

    selectKaryawan.on('change', function() {
       const selectedValue = selectKaryawan.val();

       // Menggunakan jQuery AJAX untuk mengambil data terkait
       $.ajax({
          url: "<?php echo site_url('admin/payslip/getKaryawanDetail/') ?>" + selectedValue,
          method: 'GET',
          dataType: 'json',
          success: function(data) {
             // Menggunakan operator ternary untuk mengganti data kosong dengan 0
             inputUser.val(data.user_id || 0);
             inputIDKaryawan.val(data.id_karyawan || 0);
             inputJabatan.val(data.nama_jabatan || 0);
             inputIDJabatan.val(data.id_jabatan || 0);
             inputIDDepartement.val(data.id_dept || 0);
             inputDepartemen.val(data.nama_departement || 0);
             inputGajiPokok.val(data.gaji_pokok || 0);
             inputTunjanganJabatan.val(data.tunjangan_jabatan || 0);
             inputTunjanganMakan.val(data.tunjangan_makan || 0);
             inputTunjanganAktifitas.val(data.tunjangan_aktifitas || 0);
             inputTipePajak.val(data.tipe_pajak || 0);
             inputNominalPajak.val(data.nominal_pajak || 0);
             inputBPJS.val(data.bpjs || 0);

             // Mengganti nilai inputUpahLembur dengan nilai upah lembur dari respons JSON
             inputUpahLembur.val(data.total_upah_lembur || 0);
          },
          error: function(xhr, status, error) {
             console.error('Error:', error);
          }
       });
    });
 </script>

 <script>
    // Mengambil data gaji dari controller
    fetch('<?php echo base_url("admin/dashboard/getPayrollData"); ?>')
       .then(response => response.json())
       .then(data => {
          var ctx = document.getElementById('payrollChart').getContext('2d');
          var chart = new Chart(ctx, {
             type: 'bar',
             data: {
                labels: data.labels,
                datasets: [{
                   label: 'Total Salary',
                   data: data.values,
                   backgroundColor: 'rgba(75, 192, 192, 0.2)',
                   borderColor: 'rgba(75, 192, 192, 1)',
                   borderWidth: 1
                }]
             },
             options: {
                scales: {
                   y: {
                      beginAtZero: true
                   }
                }
             }
          });
       });
 </script>




 </body>

 </html>