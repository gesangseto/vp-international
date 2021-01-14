<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>VP International</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url() ?>assets/templates/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="shortcut icon" href="<?= base_url() ?>assets/favicon.ico">

    <!-- Custom styles for this template-->
    <link href="<?= base_url() ?>assets/templates/css/sb-admin-2.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="<?= base_url() ?>assets/font-awesome/css/font-awesome.min.css"> -->

    <!-- DATA TABLES CSS -->

    <link href="<?= base_url() ?>assets/templates/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <script src="<?= base_url() ?>assets/swal/sweetalert.min.js"></script>
</head>
<style>
    .table-condensed {
        font-size: 14px;
    }
</style>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= site_url() ?>Dashboard">
                <!-- <div class="sidebar-brand-icon">
                    <img src="<?= base_url('assets/logo.png') ?>" width="60">
                </div> -->
                <div class="sidebar-brand-text mx-3">VP Int </div>
            </a>
            <!-- Divider -->
            <!-- <hr class="sidebar-divider"> -->
            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="<?= site_url() ?>Dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Menu
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <?php
            // $menu = json_decode($menu, true);
            $colapse = 1;
            $current_url = $_SERVER['REQUEST_URI'];

            $controller = $this->router->fetch_class();
            $parent_url =  $this->uri->segment(1);
            $children_url = '/' . $this->uri->segment(1) . '/' . $controller;
            foreach ($menu as $row) {
                $activeStatus = '';
                $showStatus = '';
                if ($parent_url == $row['menu_url']) {
                    $activeStatus = ' active ';
                    $showStatus = ' show ';
                }
            ?>
                <li class="nav-item <?= $activeStatus ?>">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse<?= $colapse ?>" aria-expanded="true" aria-controls="collapseTwo">
                        <i class="<?= $row['icon'] ?>"></i>
                        <span><?= $row['menu_name'] ?></span>
                    </a>
                    <div id="collapse<?= $colapse ?>" class="collapse <?= $showStatus ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <?php foreach ($row['children'] as $row_children) {
                                if ($controller == $row_children['child_url']) {
                                    echo "<a class='collapse-item active' href='" . site_url($row['menu_url'] . '/' . $row_children['child_url']) . "'>" . $row_children['child_name'] . "</a>";
                                } else {
                                    echo "<a class='collapse-item' href='" . site_url($row['menu_url'] . '/' . $row_children['child_url']) . "'>" . $row_children['child_name'] . "</a>";
                                }
                            }
                            ?>
                        </div>
                    </div>
                </li>
            <?php

                $colapse = $colapse + 1;
            }
            // die;
            ?>


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="<?= base_url() ?>/uploads/app-debug.apk" download data-toggle="tooltip" title="Download Android APK">
                                <i class="fas fa-mobile " style="color:#8FC9FF"></i>
                            </a>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $this->session->userdata('email') ?></span>
                                <!-- <img class="img-profile rounded-circle" src="<?= base_url('uploads/photo/' . $this->session->userdata('photo')) ?>"> -->
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <!-- <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a> -->
                                <a class="dropdown-item" href="<?= site_url('Profile') ?>">
                                    <i class="fas fa-lock fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Lihat Profil
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>