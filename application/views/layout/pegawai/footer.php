 <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
 <script src="<?= base_url('assets') ?>/js/libs/jquery-3.1.1.min.js"></script>
 <script src="<?= base_url('bootstrap') ?>/js/popper.min.js"></script>
 <script src="<?= base_url('bootstrap') ?>/js/bootstrap.min.js"></script>
 <script src="<?= base_url('plugins') ?>/perfect-scrollbar/perfect-scrollbar.min.js"></script>
 <script src="<?= base_url('assets') ?>/js/app.js"></script>
 <script src="<?= base_url('plugins') ?>/select2/select2.min.js"></script>
 <script src="<?= base_url('plugins') ?>/select2/custom-select2.js"></script>
 <script src="<?= base_url('plugins') ?>/js/scrollspyNav.js"></script>
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
 <script src="<?= base_url('plugins') ?>/dropify/dropify.min.js"></script>
 <script src="<?= base_url('plugins') ?>/blockui/jquery.blockUI.min.js"></script>
 <!-- <script src="plugins/tagInput/tags-input.js"></script> -->
 <script src="<?= base_url('assets') ?>/js/users/account-settings.js"></script>
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


 <script>
    document.getElementById("generateLocation").addEventListener("click", async function() {
       const loadingAlert = Swal.fire({
          title: 'Loading...',
          allowOutsideClick: false,
          showCancelButton: false,
          showConfirmButton: false,
          didOpen: () => {
             Swal.showLoading()
          }
       });

       if (navigator.geolocation) {
          try {
             const position = await new Promise((resolve, reject) => {
                navigator.geolocation.getCurrentPosition(resolve, reject);
             });

             const latitude = position.coords.latitude;
             const longitude = position.coords.longitude;
             const location = "Latitude: " + latitude + ", Longitude: " + longitude;
             document.getElementById("lokasiKerja").value = location;

             // Menunggu selama 2 detik
             await new Promise(resolve => setTimeout(resolve, 2000));

             // Tutup SweetAlert loading dan tampilkan alert sukses
             loadingAlert.close();
             Swal.fire({
                icon: 'success',
                title: 'Lokasi berhasil di-generate',
                showConfirmButton: false,
                timer: 1500
             });
          } catch (error) {
             loadingAlert.close();
             Swal.fire({
                icon: 'error',
                title: 'Gagal mendapatkan lokasi',
                text: 'Geolocation tidak didukung oleh peramban ini atau izin ditolak.'
             });
          }
       } else {
          loadingAlert.close();
          Swal.fire({
             icon: 'error',
             title: 'Gagal mendapatkan lokasi',
             text: 'Geolocation tidak didukung oleh peramban ini.'
          });
       }
    });
 </script>


 </body>

 </html>