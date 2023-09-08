<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
   <title><?php echo $title ?></title>
   <link rel="icon" type="image/x-icon" href="<?= base_url('assets') ?>/img/favicon.ico" />
   <link href="<?= base_url('assets') ?>/css/loader.css" rel="stylesheet" type="text/css" />
   <script src="<?= base_url('assets') ?>/js/loader.js"></script>

   <!-- BEGIN GLOBAL MANDATORY STYLES -->
   <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
   <link href="<?= base_url('bootstrap') ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
   <link href="<?= base_url('assets') ?>/css/plugins.css" rel="stylesheet" type="text/css" />
   <!-- END GLOBAL MANDATORY STYLES -->

   <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
   <link href="<?= base_url('plugins') ?>/apex/apexcharts.css" rel="stylesheet" type="text/css">
   <link href="<?= base_url('assets') ?>/css/dashboard/dash_1.css" rel="stylesheet" type="text/css" class="dashboard-analytics" />
   <link rel="stylesheet" type="text/css" href="<?= base_url('assets') ?>/css/elements/alert.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

   <!-- BEGIN PAGE LEVEL STYLES -->
   <link rel="stylesheet" type="text/css" href="<?= base_url('plugins') ?>/table/datatable/datatables.css">
   <link rel="stylesheet" type="text/css" href="<?= base_url('plugins') ?>/table/datatable/dt-global_style.css">
   <link href="<?= base_url('assets') ?>/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
   <link rel="stylesheet" type="text/css" href="<?= base_url('plugins') ?>/select2/select2.min.css">
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
   <link href="<?= base_url('plugins') ?>/flatpickr/flatpickr.css" rel="stylesheet" type="text/css">
   <link href="<?= base_url('plugins') ?>/flatpickr/custom-flatpickr.css" rel="stylesheet" type="text/css">
   <link href="<?= base_url('assets') ?>/css/apps/invoice-add.css" rel="stylesheet" type="text/css" />
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   <!-- END PAGE LEVEL STYLES -->

</head>

<style>
   .left-card {
      height: auto;
      /* Atur tinggi sesuai dengan kebutuhan */
   }

   .right-card {
      height: auto;
      /* Atur tinggi sesuai dengan kebutuhan */
   }
</style>


<body class="dashboard-analytics">

   <!-- BEGIN LOADER -->
   <div id="load_screen">
      <div class="loader">
         <div class="loader-content">
            <div class="spinner-grow align-self-center"></div>
         </div>
      </div>
   </div>
   <!--  END LOADER -->

   <!--  BEGIN NAVBAR  -->
   <div class="header-container fixed-top">
      <header class="header navbar navbar-expand-sm">
         <ul class="navbar-item flex-row">
            <li class="nav-item align-self-center page-heading">
               <div class="page-header">
                  <div class="page-title">
                     <h3><?= date('l, d F Y'); ?></h3>
                  </div>
               </div>
            </li>
         </ul>
         <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu">
               <line x1="3" y1="12" x2="21" y2="12"></line>
               <line x1="3" y1="6" x2="21" y2="6"></line>
               <line x1="3" y1="18" x2="21" y2="18"></line>
            </svg>
         </a>
      </header>
   </div>
   <!--  END NAVBAR  -->

   <!--  BEGIN MAIN CONTAINER  -->
   <div class="main-container" id="container">

      <div class="overlay"></div>
      <div class="search-overlay"></div>

      <!--  BEGIN SIDEBAR  -->
      <div class="sidebar-wrapper sidebar-theme">

         <nav id="compactSidebar">

            <div class="theme-logo">
               <a href="index.html">
                  <img src="<?= base_url('assets/logo.svg') ?>" class="navbar-logo" alt="logo">
               </a>
            </div>

            <ul class="menu-categories">
               <li class="menu menu-single">
                  <a href="<?= site_url('admin/dashboard') ?>" class="menu-toggle">
                     <div class="base-menu">
                        <div class="base-icons">
                           <i class="fas fa-gauge text-white fa-lg"></i>
                        </div>
                     </div>
                  </a>
                  <div class="tooltip"><span>Dashboard</span></div>
               </li>

               <li class="menu">
                  <a href="#app" data-active="false" class="menu-toggle">
                     <div class="base-menu">
                        <div class="base-icons">
                           <i class="fas fa-building text-white fa-lg"></i>
                        </div>
                     </div>
                  </a>
                  <div class="tooltip"><span>Perusahaan</span></div>
               </li>

               <li class="menu">
                  <a href="#inventory" data-active="false" class="menu-toggle">
                     <div class="base-menu">
                        <div class="base-icons">
                           <i class="fas fa-boxes-packing text-white fa-lg"></i>
                        </div>
                     </div>
                  </a>
                  <div class="tooltip"><span>Manajemen Inventaris</span></div>
               </li>

               <li class="menu menu-single">
                  <a href="<?= site_url('admin/karyawan') ?>" class="menu-toggle">
                     <div class="base-menu">
                        <div class="base-icons">
                           <i class="fas fa-user text-white fa-lg"></i>
                        </div>
                     </div>
                  </a>
                  <div class="tooltip"><span>Karyawan</span></div>
               </li>

               <li class="menu menu-single">
                  <a href="<?= site_url('admin/absensi') ?>" class="menu-toggle">
                     <div class="base-menu">
                        <div class="base-icons">
                           <i class="fas fa-clipboard-user text-white fa-lg"></i>
                        </div>
                     </div>
                  </a>
                  <div class="tooltip"><span>Absensi</span></div>
               </li>

               <li class="menu menu-single">
                  <a href="<?= site_url('admin/lembur') ?>" data-active="false" class="menu-toggle">
                     <div class="base-menu">
                        <div class="base-icons">
                           <i class="fas fa-clock text-white fa-lg"></i>
                        </div>
                     </div>
                  </a>
                  <div class="tooltip"><span>Lembur</span></div>
               </li>

               <li class="menu menu-single">
                  <a href="<?= site_url('admin/izin') ?>" data-active="false" class="menu-toggle">
                     <div class="base-menu">
                        <div class="base-icons">
                           <i class="fas fa-envelope-open text-white fa-lg"></i>
                        </div>
                     </div>
                  </a>
                  <div class="tooltip"><span>Izin</span></div>
               </li>

               <li class="menu menu-single">
                  <a href="<?= site_url('admin/payslip') ?>" data-active="false" class="menu-toggle">
                     <div class="base-menu">
                        <div class="base-icons">
                           <i class="fas fa-receipt text-white fa-lg"></i>
                        </div>
                     </div>
                  </a>
                  <div class="tooltip"><span>Payslip</span></div>
               </li>

               <li class="menu">
                  <a href="#tables" data-active="false" class="menu-toggle">
                     <div class="base-menu">
                        <div class="base-icons">
                           <i class="fas fa-pie-chart text-white fa-lg"></i>
                        </div>
                     </div>
                  </a>
                  <div class="tooltip"><span>Laporan</span></div>
               </li>
            </ul>

            <div class="sidebar-bottom-actions">

               <div class="dropdown user-profile-dropdown">
                  <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <img src="<?= base_url('assets/default.jpg') ?>" class="img-fluid" alt="avatar">
                  </a>
                  <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
                     <div class="dropdown-inner">
                        <div class="user-profile-section">
                           <div class="media mx-auto">
                              <div class="media-body">
                                 <h5><?php echo $this->session->userdata('email') ?></h5>
                                 <p>Admin Role</p>
                              </div>
                           </div>
                        </div>
                        <div class="dropdown-item">
                           <a href="user_profile.html">
                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                 <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                 <circle cx="12" cy="7" r="4"></circle>
                              </svg> <span> Profile</span>
                           </a>
                        </div>
                        <div class="dropdown-item">
                           <a href="<?= site_url('login/logout') ?>">
                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out">
                                 <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                 <polyline points="16 17 21 12 16 7"></polyline>
                                 <line x1="21" y1="12" x2="9" y2="12"></line>
                              </svg> <span>Log Out</span>
                           </a>
                        </div>

                     </div>
                  </div>
               </div>

            </div>

         </nav>

         <div id="compact_submenuSidebar" class="submenu-sidebar">

            <div class="submenu" id="app">
               <div class="menu-title">
                  <h3>Perusahaan</h3>
               </div>
               <ul class="submenu-list" data-parent-element="#app">
                  <li>
                     <a href="<?= site_url('admin/jabatan') ?>"> Jabatan </a>
                  </li>
                  <li>
                     <a href="<?= site_url('admin/departement') ?>"> Departement </a>
                  </li>
               </ul>
            </div>

            <div class="submenu" id="inventory">
               <div class="menu-title">
                  <h3>Inventaris</h3>
               </div>
               <ul class="submenu-list" data-parent-element="#more">
                  <li class="sub-submenu">
                     <a role="menu" class="collapsed" data-toggle="collapse" data-target="#users" aria-expanded="false">
                        <div> Master Data</div> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                           <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                     </a>
                     <ul id="users" class="collapse" data-parent="#compact_submenuSidebar">
                        <li>
                           <a href="<?= site_url('admin/barang') ?>">Data Barang </a>
                        </li>
                        <li>
                           <a href="<?= site_url('admin/kategori') ?>">Data Kategori </a>
                        </li>
                        <li>
                           <a href="<?= site_url('admin/unit') ?>">Data Unit </a>
                        </li>
                     </ul>
                  </li>

                  <li class="sub-submenu">
                     <a role="menu" class="collapsed" data-toggle="collapse" data-target="#starter-kit" aria-expanded="false">
                        <div>Transaksi</div> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                           <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                     </a>
                     <ul id="starter-kit" class="collapse" data-parent="#compact_submenuSidebar">
                        <li>
                           <a href="<?= base_url('admin/barang_masuk') ?>"> Barang Masuk </a>
                        </li>
                        <li>
                           <a href="<?= base_url('admin/barang_keluar') ?>"> Barang Keluar </a>
                        </li>
                     </ul>
                  </li>

                  <li>
                     <a href="<?= base_url('admin/permintaan') ?>">Permintaan </a>
                  </li>

                  <li class="sub-submenu">
                     <a role="menu" class="collapsed" data-toggle="collapse" data-target="#errors" aria-expanded="false">
                        <div> Laporan</div> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                           <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                     </a>
                     <ul id="errors" class="collapse" data-parent="#compact_submenuSidebar">
                        <li>
                           <a href="<?= base_url('admin/report_pemasukan') ?>" target="_blank"> Pemasukan Barang</a>
                        </li>
                        <li>
                           <a href="<?= base_url('admin/report_pengeluaran') ?>" target="_blank"> Pengeluaran Barang</a>
                        </li>
                        <li>
                           <a href="<?= base_url('admin/report_permintaan') ?>" target="_blank"> Permintaan Barang</a>
                        </li>
                        <li>
                           <a href="<?= base_url('admin/report_mutasi') ?>" target="_blank"> Mutasi Barang</a>
                        </li>
                     </ul>
                  </li>
               </ul>
            </div>

            <div class="submenu" id="tables">
               <div class="menu-title">
                  <h3>Laporan</h3>
               </div>
               <ul class="submenu-list" data-parent-element="#tables">
                  <li>
                     <a href="<?= site_url('admin/laporan_absen') ?>">Laporan Absensi </a>
                  </li>
                  <li>
                     <a href="<?= site_url('admin/laporan_izin') ?>">Laporan Izin </a>
                  </li>
                  <li>
                     <a href="<?= site_url('admin/laporan_gaji') ?>">Laporan Gaji </a>
                  </li>
               </ul>
            </div>

            <div class="submenu" id="more">
               <div class="menu-title">
                  <h3>Extra Elements</h3>
               </div>
               <ul class="submenu-list" data-parent-element="#more">
                  <li>
                     <a href="fonticons.html">Font Icons </a>
                  </li>

                  <li class="sub-submenu">
                     <a role="menu" class="collapsed" data-toggle="collapse" data-target="#users" aria-expanded="false">
                        <div> Users</div> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                           <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                     </a>
                     <ul id="users" class="collapse" data-parent="#compact_submenuSidebar">
                        <li>
                           <a href="user_profile.html">Profile </a>
                        </li>
                        <li>
                           <a href="user_account_setting.html">Account Settings </a>
                        </li>
                     </ul>
                  </li>

                  <li>
                     <a href="dragndrop_dragula.html">Drag and Drop </a>
                  </li>
                  <li>
                     <a href="charts_apex.html">Charts </a>
                  </li>
                  <li>
                     <a href="map_jvector.html">Maps </a>
                  </li>

                  <li class="sub-submenu">
                     <a role="menu" class="collapsed" data-toggle="collapse" data-target="#errors" aria-expanded="false">
                        <div> Errors</div> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                           <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                     </a>
                     <ul id="errors" class="collapse" data-parent="#compact_submenuSidebar">
                        <li>
                           <a href="pages_error404.html" target="_blank"> 404 </a>
                        </li>
                        <li>
                           <a href="pages_error500.html" target="_blank"> 500 </a>
                        </li>
                        <li>
                           <a href="pages_error503.html" target="_blank"> 503 </a>
                        </li>
                        <li>
                           <a href="pages_maintenence.html" target="_blank"> Maintanence </a>
                        </li>
                     </ul>
                  </li>

                  <li class="sub-submenu">
                     <a role="menu" class="collapsed" data-toggle="collapse" data-target="#pages" aria-expanded="false">
                        <div> Pages</div> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                           <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                     </a>
                     <ul id="pages" class="collapse" data-parent="#compact_submenuSidebar">
                        <li>
                           <a href="pages_helpdesk.html">Helpdesk </a>
                        </li>
                        <li>
                           <a href="pages_contact_us.html">Contact Form </a>
                        </li>
                        <li>
                           <a href="pages_faq.html">FAQ </a>
                        </li>
                        <li>
                           <a href="pages_faq2.html">FAQ 2 </a>
                        </li>
                        <li>
                           <a href="pages_privacy.html">Privacy Policy </a>
                        </li>
                        <li>
                           <a href="pages_coming_soon.html" target="_blank">Coming Soon </a>
                        </li>
                     </ul>
                  </li>

                  <li class="sub-submenu">
                     <a role="menu" class="collapsed" data-toggle="collapse" data-target="#auth" aria-expanded="false">
                        <div> Authentication</div> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                           <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                     </a>
                     <ul id="auth" class="collapse" data-parent="#compact_submenuSidebar">
                        <li>
                           <a href="auth_login.html" target="_blank"> Login </a>
                        </li>
                        <li>
                           <a href="auth_login_boxed.html" target="_blank"> Login Boxed </a>
                        </li>
                        <li>
                           <a href="auth_register.html" target="_blank"> Register </a>
                        </li>
                        <li>
                           <a href="auth_register_boxed.html" target="_blank"> Register Boxed </a>
                        </li>
                        <li>
                           <a href="auth_lockscreen.html" target="_blank"> Unlock </a>
                        </li>
                        <li>
                           <a href="auth_lockscreen_boxed.html" target="_blank"> Unlock Boxed </a>
                        </li>
                        <li>
                           <a href="auth_pass_recovery.html" target="_blank"> Recover ID </a>
                        </li>
                        <li>
                           <a href="auth_pass_recovery_boxed.html" target="_blank"> Recover ID Boxed </a>
                        </li>
                     </ul>
                  </li>

                  <li class="sub-submenu">
                     <a role="menu" class="collapsed" data-toggle="collapse" data-target="#starter-kit" aria-expanded="false">
                        <div>Starter Kit</div> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                           <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                     </a>
                     <ul id="starter-kit" class="collapse" data-parent="#compact_submenuSidebar">
                        <li>
                           <a href="starter_kit_blank_page.html"> Blank Page </a>
                        </li>
                        <li>
                           <a href="starter_kit_breadcrumb.html"> Breadcrumb </a>
                        </li>
                        <li>
                           <a href="starter_kit_boxed.html"> Boxed </a>
                        </li>
                        <li>
                           <a href="starter_kit_single_click_menu.html">Single Click Menu</a>
                        </li>
                     </ul>
                  </li>
               </ul>
            </div>

         </div>

      </div>
      <!--  END SIDEBAR  -->