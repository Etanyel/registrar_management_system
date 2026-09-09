<?= $this->extend('registrar/layout') ?>

<?= $this->section('active-student') ?>
active
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container-fluid" x-data="registrarStudent()">
    <!-- Page Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">

        <div>
            <h4 class="mb-1 fw-semibold" x-show="!addStudent" x-cloak>Manage Students</h4>
            <p class="text-muted mb-0" x-show="!addStudent" x-cloak>
                Manage student information, enrollment, and academic status.
            </p>
        </div>

        <button class="btn btn-primary" x-on:click="addStudent = true" x-show="!addStudent">
            <i class="bi bi-person-plus me-1"></i>
            Add Student
        </button>

    </div>


    <!-- Statistics -->
    <div class="row g-3 mb-4" x-show="!addStudent" x-cloak>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center">

                    <div class="rounded-3 bg-primary-subtle text-primary p-3 me-3">
                        <i class="bi bi-people fs-4"></i>
                    </div>

                    <div>
                        <small class="text-muted">Total Students</small>
                        <h4 class="mb-0 fw-semibold">1,248</h4>
                    </div>

                </div>
            </div>
        </div>


        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center">

                    <div class="rounded-3 bg-success-subtle text-success p-3 me-3">
                        <i class="bi bi-person-check fs-4"></i>
                    </div>

                    <div>
                        <small class="text-muted">Active Students</small>
                        <h4 class="mb-0 fw-semibold">1,180</h4>
                    </div>

                </div>
            </div>
        </div>


        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center">

                    <div class="rounded-3 bg-warning-subtle text-warning p-3 me-3">
                        <i class="bi bi-person-dash fs-4"></i>
                    </div>

                    <div>
                        <small class="text-muted">Dropped</small>
                        <h4 class="mb-0 fw-semibold">12</h4>
                    </div>

                </div>
            </div>
        </div>


        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center">

                    <div class="rounded-3 bg-info-subtle text-info p-3 me-3">
                        <i class="bi bi-mortarboard fs-4"></i>
                    </div>

                    <div>
                        <small class="text-muted">Graduated</small>
                        <h4 class="mb-0 fw-semibold">56</h4>
                    </div>

                </div>
            </div>
        </div>

    </div>


    <!-- Student List -->
    <div class="card border-0 shadow-sm" x-show="!addStudent" x-cloak>

        <!-- Card Header -->
        <div class="card-header bg-white border-0 pt-3 px-3">

            <div class="d-flex flex-column flex-lg-row justify-content-between gap-3">

                <div>
                    <h5 class="mb-1 fw-semibold">Student List</h5>
                    <small class="text-muted">
                        View and manage registered students.
                    </small>
                </div>

                <!-- Search -->
                <div class="d-flex gap-2">

                    <div class="input-group">
                        <span class="input-group-text bg-white">
                            <i class="bi bi-search"></i>
                        </span>

                        <input type="text" class="form-control" placeholder="Search student...">
                    </div>

                    <button class="btn btn-outline-secondary">
                        <i class="bi bi-funnel"></i>
                    </button>

                </div>

            </div>

        </div>


        <!-- Table -->
        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>
                            <th class="px-3">Student No.</th>
                            <th>Student Name</th>
                            <th>Program</th>
                            <th>Year</th>
                            <th>Section</th>
                            <th>Status</th>
                            <th class="text-end px-3">Action</th>
                        </tr>

                    </thead>

                    <tbody>

                        <tr>

                            <td class="px-3 fw-medium">
                                2026-0001
                            </td>

                            <td>
                                <div class="d-flex align-items-center">

                                    <div class="rounded-circle bg-primary-subtle text-primary
                                                d-flex align-items-center justify-content-center
                                                me-2" style="width: 38px; height: 38px;">
                                        <i class="bi bi-person"></i>
                                    </div>

                                    <div>
                                        <div class="fw-medium">
                                            Juan Dela Cruz
                                        </div>
                                        <small class="text-muted">
                                            juan@example.com
                                        </small>
                                    </div>

                                </div>
                            </td>

                            <td>BSIT</td>

                            <td>3rd Year</td>

                            <td>BSIT 3A</td>

                            <td>
                                <span class="badge text-bg-success">
                                    Active
                                </span>
                            </td>

                            <td class="text-end px-3">

                                <div class="dropdown">

                                    <button class="btn btn-sm btn-light" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots"></i>
                                    </button>

                                    <ul class="dropdown-menu dropdown-menu-end">

                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <i class="bi bi-eye me-2"></i>
                                                View Record
                                            </a>
                                        </li>

                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <i class="bi bi-pencil me-2"></i>
                                                Edit Student
                                            </a>
                                        </li>

                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <i class="bi bi-journal-text me-2"></i>
                                                Enrollment History
                                            </a>
                                        </li>

                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>

                                        <li>
                                            <a class="dropdown-item text-warning" href="#">
                                                <i class="bi bi-person-dash me-2"></i>
                                                Drop Student
                                            </a>
                                        </li>

                                    </ul>

                                </div>

                            </td>

                        </tr>


                        <tr>

                            <td class="px-3 fw-medium">
                                2026-0002
                            </td>

                            <td>
                                <div class="d-flex align-items-center">

                                    <div class="rounded-circle bg-primary-subtle text-primary
                                                d-flex align-items-center justify-content-center
                                                me-2" style="width: 38px; height: 38px;">
                                        <i class="bi bi-person"></i>
                                    </div>

                                    <div>
                                        <div class="fw-medium">
                                            Maria Santos
                                        </div>
                                        <small class="text-muted">
                                            maria@example.com
                                        </small>
                                    </div>

                                </div>
                            </td>

                            <td>BSHM</td>

                            <td>2nd Year</td>

                            <td>BSHM 2B</td>

                            <td>
                                <span class="badge text-bg-success">
                                    Active
                                </span>
                            </td>

                            <td class="text-end px-3">

                                <div class="dropdown">

                                    <button class="btn btn-sm btn-light" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots"></i>
                                    </button>

                                    <ul class="dropdown-menu dropdown-menu-end">

                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <i class="bi bi-eye me-2"></i>
                                                View Record
                                            </a>
                                        </li>

                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <i class="bi bi-pencil me-2"></i>
                                                Edit Student
                                            </a>
                                        </li>

                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <i class="bi bi-journal-text me-2"></i>
                                                Enrollment History
                                            </a>
                                        </li>

                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>

                                        <li>
                                            <a class="dropdown-item text-warning" href="#">
                                                <i class="bi bi-person-dash me-2"></i>
                                                Drop Student
                                            </a>
                                        </li>

                                    </ul>

                                </div>

                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

        </div>


        <!-- Pagination -->
        <div class="card-footer bg-white border-0">

            <div class="d-flex justify-content-between align-items-center">

                <small class="text-muted">
                    Showing 1–10 of 1,248 students
                </small>

                <nav>
                    <ul class="pagination pagination-sm mb-0">

                        <li class="page-item disabled">
                            <a class="page-link" href="#">
                                Previous
                            </a>
                        </li>

                        <li class="page-item active">
                            <a class="page-link" href="#">1</a>
                        </li>

                        <li class="page-item">
                            <a class="page-link" href="#">2</a>
                        </li>

                        <li class="page-item">
                            <a class="page-link" href="#">3</a>
                        </li>

                        <li class="page-item">
                            <a class="page-link" href="#">
                                Next
                            </a>
                        </li>

                    </ul>
                </nav>

            </div>

        </div>

    </div>

</div>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('registrarStudent', () => ({
        errors: {},
        loading: false,
        addStudent: false,

    }));
});
</script>

<?= $this->endSection() ?>