<?php
$this->session = \Config\Services::session();
$this->session->start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>PUDC</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?= base_url() ?>/assets-admin/img/logo.png" rel="icon">
    <link href="<?= base_url() ?>/assets-admin/img/logo.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url() ?>/assets-admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/assets-admin/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url() ?>/assets-admin/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/assets-admin/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="<?= base_url() ?>/assets-admin/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="<?= base_url() ?>/assets-admin/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="<?= base_url() ?>/assets-admin/vendor/simple-datatables/style.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url() ?>/assets-admin/css/select2.min.css">


    <!-- Template Main CSS File -->
    <link href="<?= base_url() ?>/assets-admin/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Jan 29 2024 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<style>
.btn-primary {
    color: #fff;
    background-color: #64b5f6 !important;
    border-color: #64b5f6 !important;
}
</style>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="index.html" class=" d-flex align-items-center">
                <img src="<?= base_url() ?>/assets-admin/img/logo_pudc.png" width="250" height="70" alt="">
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <!-- <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div> -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="<?= base_url('assets-admin/img/profile/' . $this->session->get("photo_profile")); ?>"
                            alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2"
                            style="color:white"><?= $this->session->get("display_name") ?></span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6><?= $this->session->get("display_name") ?></h6>
                            <span><?= $this->session->get("level_name") ?></span>
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="<?= base_url() ?>/profile">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Profile</span>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="<?= base_url() ?>/logout">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link <?= ($url == 'product' || $url == 'masterapproval' || $url == 'productin' || $url == 'productout' || $url == 'productout_app' ? '' : 'collapsed') ?>"
                    data-bs-target="#components-nav-3" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-archive-fill"></i><span>Menu Utama</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav-3"
                    class="nav-content collapse <?= ($url == 'product' || $url == 'masterapproval' || $url == 'productin' || $url == 'productout' || $url == 'productout_app' ? 'show' : '') ?>"
                    data-bs-parent="#sidebar-nav">

                    <?php if ($this->session->get("id_level") == 1 || $this->session->get("id_level") == 4) { ?>
                    <li>
                        <a href="/product" class="<?= ($url == 'product' ? 'active' : '') ?>">
                            <i class="bi bi-table"></i><span>Alat Tulis Kantor</span>
                        </a>
                    </li>
                    <?php } ?>
                    <?php if ($this->session->get("id_level") == 1) { ?>
                    <li>
                        <a href="/masterapproval" class="<?= ($url == 'masterapproval' ? 'active' : '') ?>">
                            <i class="bi bi-table"></i><span>Master Approval</span>
                        </a>
                    </li>
                    <?php } ?>
                    <?php if ($this->session->get("id_level") == 1 || $this->session->get("id_level") == 4) { ?>
                    <li>
                        <a href="/productin" class="<?= ($url == 'productin' ? 'active' : '') ?>">
                            <i class="bi bi-table"></i><span>Pembelian ATK</span>
                        </a>
                    </li>
                    <li>
                        <a href="/productout" class="<?= ($url == 'productout' ? 'active' : '') ?>">
                            <i class="bi bi-table"></i><span>Pengajuan ATK</span>
                        </a>
                    </li>
                    <?php } ?>

                    <?php if ($this->session->get("id_level") == 1 || $this->session->get("id_level") == 2 || $this->session->get("id_level") == 3) { ?>
                    <li>
                        <a href="/productout_app" class="<?= ($url == 'productout_app' ? 'active' : '') ?>">
                            <i class="bi bi-table"></i><span>Approval Pengajuan</span>
                        </a>
                    </li>
                    <?php } ?>

                </ul>
            </li>
            <?php if ($this->session->get("id_level") == 3) { ?>
            <li class="nav-item">
                <a class="nav-link " data-bs-target="#components-nav-laporan" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-wrench-adjustable-circle"></i><span>Laporan</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav-laporan" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="/laporan_product" target="_blank" class="">
                            <i class="bi bi-file"></i><span>Laporan Stok Produk</span>
                        </a>
                    </li>
                    <li>
                        <a href="/laporan_productin" target="_blank" class="">
                            <i class="bi bi-file"></i><span>Laporan Pembelian Produk</span>
                        </a>
                    </li>
                    <li>
                        <a href="/laporan_productout" target="_blank" class="">
                            <i class="bi bi-file"></i><span>Laporan Pengajuan Produk</span>
                        </a>
                    </li>

                </ul>
            </li>
            <?php } ?>
            <?php if ($this->session->get("id_level") == 1 || $this->session->get("id_level") == 4) { ?>
            <li class="nav-item">
                <a class="nav-link <?= ($url == 'user' || $url == 'level' ? '' : 'collapsed') ?>"
                    data-bs-target="#components-nav-3" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-wrench-adjustable-circle"></i><span>Pengaturan</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav-3"
                    class="nav-content collapse <?= ($url == 'user' || $url == 'level' ? 'show' : '') ?>"
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="/user" class="<?= ($url == 'user' ? 'active' : '') ?>">
                            <i class="bi bi-table"></i><span>Pengguna</span>
                        </a>
                    </li>
                    <?php if ($this->session->get("id_level") == 1) { ?>
                    <li>
                        <a href="/level" class="<?= ($url == 'level' ? 'active' : '') ?>">
                            <i class="bi bi-table"></i><span>Level Pengguna</span>
                        </a>
                    </li>
                    <?php } ?>

                </ul>
            </li>
            <?php } ?>
        </ul>

    </aside><!-- End Sidebar-->

    <?= $this->renderSection('content') ?>


    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright" style="color:white">
            &copy; Copyright <strong><span>PUDC</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
            <!-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> -->
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="<?= base_url() ?>/assets-admin/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="<?= base_url() ?>/assets-admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>/assets-admin/vendor/chart.js/chart.umd.js"></script>
    <script src="<?= base_url() ?>/assets-admin/vendor/echarts/echarts.min.js"></script>
    <script src="<?= base_url() ?>/assets-admin/vendor/quill/quill.min.js"></script>
    <script src="<?= base_url() ?>/assets-admin/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="<?= base_url() ?>/assets-admin/vendor/tinymce/tinymce.min.js"></script>
    <script src="<?= base_url() ?>/assets-admin/vendor/php-email-form/validate.js"></script>


    <script>
    function change_password() {
        var newPassword = $('#newPassword').val().trim();
        var renewPassword = $('#renewPassword').val().trim();
        var currentPassword = $('#currentPassword').val().trim();
        var cek = 0;
        if (newPassword.length == 0 || renewPassword.length == 0 || currentPassword.length == 0) {
            cek = 1;
            swal("Isi kolom terlebih dahulu", "", "error");
        } else {
            if (newPassword != renewPassword) {
                cek = 1;
                $('#newPassword').val("");
                $('#renewPassword').val("");
                swal("Password Baru Tidak Sama", "", "error");
            }
        }
        if (cek == 0) {
            $.ajax({
                type: "POST",
                url: '<?= $action2 ?>',
                data: {
                    currentPassword: currentPassword,
                    newPassword: newPassword,
                },
                context: document.body
            }).done(function(data) {
                if (data == 1) {
                    $('#newPassword').val("");
                    $('#renewPassword').val("");
                    $('#currentPassword').val("");
                    swal("Success", "Pasdword sudah diubah", "success");
                } else {
                    swal("Password Lama Tidak Sama", "", "error");
                }
                console.log(data);
            })
        }
    }

    function bacaGambaredit(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#gambar_edit').attr('src', e.target.result);
                console.log(e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }

    }
    $('#gambar').change(function() {
        bacaGambaredit(this);
    })
    $(document).ready(function() {
        bacaGambaredit(this);
    });
    </script>
</body>

</html>