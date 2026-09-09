<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?= base_url('bootstrap/dist/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('bootstrap-icons/font/bootstrap-icons.css') ?>">

    <script defer src="<?= base_url('/alpinejs/dist/cdn.min.js') ?>"></script>
    <link rel="stylesheet" href="<?= base_url('sweetalert2/dist/sweetalert2.min.css') ?>">

    <title><?php $this->renderSection('tab-title'); ?></title>

    <style>
        body {
            background: #f5f6f8;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: #fff;
            border-right: 1px solid #e5e7eb;
            z-index: 1000;
        }

        .sidebar-brand {
            height: 70px;
            display: flex;
            align-items: center;
            padding: 0 24px;
            font-weight: 600;
            font-size: 18px;
            border-bottom: 1px solid #e5e7eb;
        }

        .sidebar-nav {
            padding: 20px 12px;
        }

        .sidebar .nav-link {
            color: #6b7280;
            padding: 11px 14px;
            margin-bottom: 4px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sidebar .nav-link:hover {
            background: #f3f4f6;
            color: #111827;
        }

        .sidebar .nav-link.active {
            background: #eef2ff;
            color: #4f46e5;
            font-weight: 500;
        }

        .sidebar .nav-link i {
            font-size: 18px;
        }

        .main-wrapper {
            margin-left: 250px;
        }

        .top-navbar {
            height: 70px;
            background: #fff;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
        }

        .page-content {
            padding: 28px;
        }

        .stat-card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 20px;
        }

        .stat-icon {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f3f4f6;
            font-size: 20px;
        }

        .mobile-menu {
            display: none;
        }

        @media (max-width: 768px) {

            .sidebar {
                transform: translateX(-100%);
                transition: 0.25s ease;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-wrapper {
                margin-left: 0;
            }

            .mobile-menu {
                display: block;
            }

            .page-content {
                padding: 20px;
            }
        }
    </style>
</head>

<body x-data="{ sidebarOpen: false }">

    <!-- SIDEBAR -->
    <aside class="sidebar" :class="{ 'show': sidebarOpen }">

        <div class="sidebar-brand">
            <i class="bi bi-mortarboard-fill me-2 text-primary"></i>
            Student Portal
        </div>

        <nav class="sidebar-nav">

            <small class="text-uppercase text-muted px-3 fw-semibold">
                Main
            </small>

            <div class="mt-2">

                <a href="<?= base_url('registrar') ?>"
                    class="nav-link <?= $this->renderSection('active-dashboard'); ?>">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>

                <a href="<?= base_url('/registrar/manage-student') ?>"
                    class="nav-link <?= $this->renderSection('active-student'); ?>">
                    <i class="bi bi-people"></i>
                    <span>Manage Students</span>
                </a>

                <a href="<?= base_url('registrar/manage-subjects') ?>"
                    class="nav-link <?= $this->renderSection('active-subject'); ?>">
                    <i class="bi bi-journal-bookmark"></i>
                    <span>Manage Subjects</span>
                </a>

                <a href="<?= base_url('registrar/manage-enrollment') ?>"
                    class="nav-link <?= $this->renderSection('active-enrollment'); ?>">
                    <i class="bi bi-journal-check"></i>
                    <span>Manage Enrollment</span>
                </a>

                <a href="<?= base_url('/registrar/manage-schedules') ?>"
                    class="nav-link <?= $this->renderSection('active-schedule'); ?>">
                    <i class="bi bi-calendar3"></i>
                    <span>Manage Schedules</span>
                </a>

                <a href="<?= base_url('registrar/reports') ?>"
                    class="nav-link <?= $this->renderSection('active-report'); ?>">
                    <i class="bi bi-bar-chart"></i>
                    <span>Reports</span>
                </a>

            </div>

            <small class="text-uppercase text-muted px-3 d-block mt-4 fw-semibold">
                Others
            </small>

            <div class="mt-2">

                <a href="<?= base_url('student/announcements') ?>"
                    class="nav-link <?= $this->renderSection('active'); ?>">
                    <i class="bi bi-megaphone"></i>
                    <span>Announcements</span>
                </a>

                <a href="<?= base_url('student/settings') ?>" class="nav-link <?= $this->renderSection('active'); ?>">
                    <i class="bi bi-gear"></i>
                    <span>Settings</span>
                </a>

                <a href="<?= base_url('/logout') ?>" class="nav-link text-danger">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Logout</span>
                </a>

            </div>

        </nav>

    </aside>


    <!-- MAIN -->
    <div class="main-wrapper">

        <!-- NAVBAR -->
        <header class="top-navbar sticky-top">

            <div class="d-flex align-items-center gap-3">

                <button class="btn btn-light mobile-menu" @click="sidebarOpen = !sidebarOpen">
                    <i class="bi bi-list"></i>
                </button>

                <div class="d-flex align-items-center gap-2">
                    <img src="<?= base_url('logo/dsf_logo.png') ?>" alt="DSF LOGO" width="45" height="45"
                        class="img-fluid">

                    <div>
                        <h5 class="mb-0 text-primary">
                            Dipolog School of Fisheries
                        </h5>
                    </div>
                </div>
                <!-- <div>
                    <h5 class="mb-0">
                        Dipolog School of Fisheries
                    </h5>
                </div> -->

            </div>


            <!-- USER -->
            <div class="dropdown">

                <button class="btn d-flex align-items-center gap-2" data-bs-toggle="dropdown">

                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                        style="width: 36px; height: 36px;">
                        <i class="bi bi-person"></i>
                    </div>

                    <span class="d-none d-md-block">
                        Juan Dela Cruz
                    </span>

                    <i class="bi bi-chevron-down small"></i>

                </button>

                <ul class="dropdown-menu dropdown-menu-end">

                    <li>
                        <a class="dropdown-item" href="<?= base_url('student/profile') ?>">
                            <i class="bi bi-person me-2"></i>
                            Profile
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="<?= base_url('student/settings') ?>">
                            <i class="bi bi-gear me-2"></i>
                            Settings
                        </a>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item text-danger" href="<?= base_url('/logout') ?>">
                            <i class="bi bi-box-arrow-right me-2"></i>
                            Logout
                        </a>
                    </li>

                </ul>

            </div>

        </header>


        <!-- PAGE CONTENT -->
        <main class="page-content">

            <?= $this->renderSection('content'); ?>

        </main>

    </div>

    <script src="<?= base_url('sweetalert2/dist/sweetalert2.all.min.js') ?>"></script>
    <script src="<?= base_url('bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>

</body>

</html>