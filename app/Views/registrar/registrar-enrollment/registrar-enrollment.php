<?= $this->extend('registrar/layout') ?>

<?= $this->section('active-enrollment') ?>
active
<?= $this->endSection() ?>

<?= $this->section('page-title') ?>
Enrollment
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container-fluid" x-data="registrarEnrollment">

    <!-- Page Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-2">

        <div>
            <h4 class="mb-1 fw-semibold">Enrollment</h4>
            <p class="text-muted mb-0">
                Register students and manage their enrollment.
            </p>
        </div>

    </div>



    <!-- Enrollment Card -->
    <div class="card border-0 shadow-sm">

        <div class="card-body p-4">

            <div class="mb-1">

                <div class="d-flex align-items-center mb-3">

                    <!-- <div class="rounded-3 bg-primary-subtle text-primary p-2 me-2">
                        <i class="bi bi-search"></i>
                    </div> -->

                    <div>
                        <h6 class="mb-0 fw-semibold">
                            Enrolled Students
                        </h6>

                        <small class="text-muted">
                            Displays all enrolled students within this month.
                        </small>
                    </div>

                </div>


                <div class="row g-3">

                    <div class="col-md-8">

                        <label class="form-label">
                            Search Student
                        </label>

                        <div class="input-group">

                            <span class="input-group-text bg-white">
                                <i class="bi bi-search"></i>
                            </span>

                            <input type="text" class="form-control" placeholder="Search student number or name..."
                                name="student_search">

                            <button type="button" class="btn btn-primary">
                                Search
                            </button>

                        </div>

                    </div>


                    <div class="col-md-4 d-flex align-items-end">

                        <button type="button" class="btn btn-outline-primary w-100" data-bs-toggle="modal"
                            data-bs-target="#selectStudentType">
                            <i class="bi bi-person-plus me-1"></i>
                            Enroll Student
                        </button>

                    </div>

                </div>

                <div class="modal fade" id="selectStudentType">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <span class="modal-title fw-semibold">Select Student Type</span>
                                <span class="btn-close" data-bs-dismiss="modal"></span>
                            </div>
                            <div class="modal-body">
                                <div class="d-flex justify-content-center gap-2">
                                    <button class="btn btn-light border shadow-sm w-100 py-4"
                                        @click="form.student_type = 'new'; enrollMode = true"
                                        data-bs-dismiss="modal">New Student</button>
                                    <button class="btn btn-light border shadow-sm w-100 py-4"
                                        @click="form.student_type = 'transferee'; enrollMode = true"
                                        data-bs-dismiss="modal">Transferee Student</button>
                                    <button class="btn btn-light border shadow-sm w-100 py-4"
                                        @click="form.student_type = 'returning'; enrollMode = true"
                                        data-bs-dismiss="modal">Returning Student</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <form @submit.prevent="enroll">

                <!-- New/Transferee Student Information -->
                <div x-show="enrollMode" x-cloak x-transition>


                    <div class="" x-show="form.student_type == 'new' || form.student_type === 'transferee'">
                        <!-- Student Information -->
                        <div class="mb-4">

                            <div class="d-flex align-items-center mb-3">

                                <div class="rounded-3 bg-primary-subtle text-primary p-2 me-2">
                                    <i class="bi bi-person-vcard"></i>
                                </div>

                                <div>
                                    <h6 class="mb-0 fw-semibold">
                                        Student Information
                                    </h6>

                                    <small class="text-muted">
                                        Basic information of the student being registered.
                                    </small>
                                </div>

                            </div>


                            <div class="row g-3">

                                <!-- Student Number -->
                                <div class="col-md-4" x-show="form.student_type !== 'returning'" x-cloak x-transition>

                                    <label class="form-label">
                                        Student ID Number
                                    </label>

                                    <div class="form-control text-muted bg-light bg-gradient">
                                        <i class="bi bi-magic me-1"></i>
                                        This will generate automatically
                                    </div>

                                </div>

                                <!-- First Name -->
                                <div class="col-md-4">

                                    <label class="form-label">
                                        First Name
                                        <span class="text-danger">*</span>
                                    </label>

                                    <input type="text" class="form-control" placeholder="Enter first name"
                                        x-model="form.firstname">

                                </div>


                                <!-- Middle Name -->
                                <div class="col-md-4">

                                    <label class="form-label">
                                        Middle Name
                                    </label>

                                    <input type="text" class="form-control" placeholder="Enter middle name"
                                        x-model="form.middlename">

                                </div>


                                <!-- Last Name -->
                                <div class="col-md-4">

                                    <label class="form-label">
                                        Last Name
                                        <span class="text-danger">*</span>
                                    </label>

                                    <input type="text" class="form-control" placeholder="Enter last name"
                                        x-model="form.lastname">

                                </div>


                                <!-- Suffix -->
                                <div class="col-md-2">

                                    <label class="form-label">
                                        Suffix
                                    </label>

                                    <select class="form-select" x-model="form.suffix">

                                        <option value="">None</option>
                                        <option value="Jr.">Jr.</option>
                                        <option value="Sr.">Sr.</option>
                                        <option value="II">II</option>
                                        <option value="III">III</option>

                                    </select>

                                </div>


                                <!-- Date of Birth -->
                                <div class="col-md-3">

                                    <label class="form-label">
                                        Date of Birth
                                        <span class="text-danger">*</span>
                                    </label>

                                    <input type="date" class="form-control" x-model="form.birthdate">

                                </div>


                                <!-- Sex -->
                                <div class="col-md-3">

                                    <label class="form-label">
                                        Sex
                                        <span class="text-danger">*</span>
                                    </label>

                                    <select class="form-select" x-model="form.sex">

                                        <option value="">
                                            Select sex
                                        </option>

                                        <option value="Male">
                                            Male
                                        </option>

                                        <option value="Female">
                                            Female
                                        </option>

                                    </select>

                                </div>


                                <!-- Email -->
                                <div class="col-md-6">

                                    <label class="form-label">
                                        Email Address
                                    </label>

                                    <input type="email" class="form-control" placeholder="student@example.com"
                                        x-model="form.email">

                                </div>


                                <!-- Contact Number -->
                                <div class="col-md-6">

                                    <label class="form-label">
                                        Contact Number
                                    </label>

                                    <input type="text" class="form-control" placeholder="09XXXXXXXXX"
                                        x-model="form.contact_no" max_length="11">

                                </div>


                                <!-- Address -->
                                <div class="col-12">

                                    <label class="form-label">
                                        Address
                                    </label>

                                    <textarea class="form-control" rows="2" placeholder="Enter complete address"
                                        x-model="form.address"></textarea>

                                </div>

                            </div>

                        </div>

                        <hr class="my-4">

                        <!-- Enrollment Information -->
                        <div class="mb-4">

                            <div class="d-flex align-items-center mb-3">

                                <div class="rounded-3 bg-info-subtle text-info p-2 me-2">
                                    <i class="bi bi-journal-check"></i>
                                </div>

                                <div>
                                    <h6 class="mb-0 fw-semibold">
                                        Enrollment Information
                                    </h6>

                                    <small class="text-muted">
                                        Specify the student's enrollment details.
                                    </small>
                                </div>

                            </div>


                            <div class="row g-3">

                                <!-- Academic Year -->
                                <div class="col-md-4">

                                    <label class="form-label">
                                        Academic Year
                                        <span class="text-danger">*</span>
                                    </label>

                                    <select x-model="form.academic_year" class="form-select">
                                        <option value="">Select academic year</option>

                                        <?php
                                        $currentYear = date('Y');

                                        for ($i = 0; $i < 3; $i++) {
                                            $startYear = $currentYear + $i;
                                            $endYear = $startYear + 1;
                                            $academicYear = $startYear . '-' . $endYear;
                                            ?>

                                            <option value="<?= $academicYear ?>">
                                                <?= $academicYear ?>
                                            </option>

                                        <?php } ?>


                                    </select>

                                </div>


                                <!-- Semester -->
                                <div class="col-md-4">

                                    <label class="form-label">
                                        Semester
                                        <span class="text-danger">*</span>
                                    </label>

                                    <select class="form-select" x-model="form.semester">

                                        <option value="">
                                            Select semester
                                        </option>

                                        <option value="1st">
                                            1st Semester
                                        </option>

                                        <option value="2nd">
                                            2nd Semester
                                        </option>

                                    </select>

                                </div>


                                <!-- Program -->
                                <div class="col-md-4">

                                    <label class="form-label">
                                        Program
                                        <span class="text-danger">*</span>
                                    </label>

                                    <select class="form-select" x-model="form.course">

                                        <option value="">
                                            Select Program
                                        </option>

                                        <option value="1">
                                            DIPLOMA PROGRAM IN INFORMATION TECHNOLOGY (DPIT)
                                        </option>

                                        <option value="2">
                                            DIPLOMA PROGRAM IN TOURISM AND HOSPITALITY TECHNOLOGY (DPTHT)
                                        </option>

                                        <option value="3">
                                            DIPLOMA PROGRAM IN ELECTRICAL TECHNOLOGY (DPET)
                                        </option>

                                        <option value="4">
                                            DIPLOMA PROGRAM IN FISHERY TECHNOLOGY (DPFT)
                                        </option>

                                        <option value="5">
                                            DIPLOMA PROGRAM IN WELDING TECHNOLOGY (DPWT)
                                        </option>

                                    </select>

                                </div>


                                <!-- Year Level -->
                                <div class="col-md-4">

                                    <label class="form-label">
                                        Year Level
                                        <span class="text-danger">*</span>
                                    </label>

                                    <select class="form-select" x-model="form.year_level">

                                        <option value="">
                                            Select year level
                                        </option>

                                        <option value="1">
                                            1st Year
                                        </option>

                                        <option value="2">
                                            2nd Year
                                        </option>

                                        <option value="3">
                                            3rd Year
                                        </option>

                                    </select>

                                </div>


                                <!-- Section -->
                                <div class="col-md-4">

                                    <label class="form-label">
                                        Section
                                    </label>

                                    <select class="form-select" x-model="form.section">

                                        <option value="">
                                            Select section
                                        </option>

                                        <option value="BLOCK-A">
                                            BLOCK-A
                                        </option>

                                        <option value="BLOCK-B">
                                            BLOCK-B
                                        </option>

                                    </select>

                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="" x-show="form.student_type == 'returning'">
                        <div class="mb-4">

                            <div class="d-flex align-items-center mb-3">

                                <div class="rounded-3 bg-primary-subtle text-primary p-2 me-2">
                                    <i class="bi bi-person-vcard"></i>
                                </div>

                                <div>
                                    <h6 class="mb-0 fw-semibold">
                                        Student Information
                                    </h6>

                                    <small class="text-muted">
                                        Basic information of the student being registered.
                                    </small>
                                </div>

                            </div>


                            <div class="row g-3">

                                <!-- Student Number -->
                                <div class="col-md-4">

                                    <label class="form-label">
                                        Student ID Number
                                    </label>

                                    <input type="text" class="form-control" x-model="form.student_id"
                                        placeholder="Enter Student ID No. (eg. 2026-080001)" max_length="11">

                                </div>

                            </div>

                        </div>

                        <hr class="my-4">

                        <!-- Enrollment Information -->
                        <div class="mb-4">

                            <div class="d-flex align-items-center mb-3">

                                <div class="rounded-3 bg-info-subtle text-info p-2 me-2">
                                    <i class="bi bi-journal-check"></i>
                                </div>

                                <div>
                                    <h6 class="mb-0 fw-semibold">
                                        Enrollment Information
                                    </h6>

                                    <small class="text-muted">
                                        Specify the student's enrollment details.
                                    </small>
                                </div>

                            </div>


                            <div class="row g-3">

                                <!-- Academic Year -->
                                <div class="col-md-4">

                                    <label class="form-label">
                                        Academic Year
                                        <span class="text-danger">*</span>
                                    </label>

                                    <select x-model="form.academic_year" class="form-select">
                                        <option value="">Select academic year</option>

                                        <?php
                                        $currentYear = date('Y');

                                        for ($i = 0; $i < 3; $i++) {
                                            $startYear = $currentYear + $i;
                                            $endYear = $startYear + 1;
                                            $academicYear = $startYear . '-' . $endYear;
                                            ?>

                                            <option value="<?= $academicYear ?>">
                                                <?= $academicYear ?>
                                            </option>

                                        <?php } ?>


                                    </select>

                                </div>


                                <!-- Semester -->
                                <div class="col-md-4">

                                    <label class="form-label">
                                        Semester
                                        <span class="text-danger">*</span>
                                    </label>

                                    <select class="form-select" x-model="form.semester">

                                        <option value="">
                                            Select semester
                                        </option>

                                        <option value="1st">
                                            1st Semester
                                        </option>

                                        <option value="2nd">
                                            2nd Semester
                                        </option>

                                    </select>

                                </div>


                                <!-- Year Level -->
                                <div class="col-md-4">

                                    <label class="form-label">
                                        Year Level
                                        <span class="text-danger">*</span>
                                    </label>

                                    <select class="form-select" x-model="form.year_level">

                                        <option value="">
                                            Select year level
                                        </option>

                                        <option value="1">
                                            1st Year
                                        </option>

                                        <option value="2">
                                            2nd Year
                                        </option>

                                        <option value="3">
                                            3rd Year
                                        </option>

                                    </select>

                                </div>


                                <!-- Section -->
                                <div class="col-md-4">

                                    <label class="form-label">
                                        Section
                                    </label>

                                    <select class="form-select" x-model="form.section">

                                        <option value="">
                                            Select section
                                        </option>

                                        <option value="BLOCK-A">
                                            BLOCK-A
                                        </option>

                                        <option value="BLOCK-B">
                                            BLOCK-B
                                        </option>

                                    </select>

                                </div>

                            </div>

                        </div>
                    </div>

                    <hr class="my-4">


                    <!-- Form Actions -->
                    <div class="d-flex justify-content-end gap-2">

                        <span class="btn btn-outline-danger" x-on:click="enrollMode = false">
                            Cancel
                        </span>

                        <button type="reset" class="btn btn-light border">
                            Clear
                        </button>

                        <button type="submit" class="btn btn-primary" :disabled="loading">
                            <template x-if="!loading">
                                <span>
                                    <i class="bi bi-check2-circle me-1"></i>
                                    Submit Enrollment
                                </span>
                            </template>

                            <template x-if="loading">
                                <span>
                                    <span class="spinner-border spinner-border-sm me-1"></span>
                                    Processing...
                                </span>
                            </template>
                        </button>

                    </div>
                </div>

        </div>


        </form>

    </div>

    <div class="mt-4" x-show="!enrollMode">
        <div class="card shadow-sm rounded-xl">
            <!-- Table -->
            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">

                            <tr class="text-center">
                                <th class="px-3">Student No.</th>
                                <th>Student Name</th>
                                <th>Program</th>
                                <th>Year</th>
                                <th>Section</th>
                                <th>Type</th>
                                <th>Date Enrolled</th>
                            </tr>

                        </thead>

                        <tbody>

                            <template x-for="record in records" :key="record.id">
                                <tr style="cursor: pointer;" class="text-center" @click="window.location.href='<?= base_url('/registrar/manage-enrollment/') ?>' + record.id">

                                    <td class="px-3 fw-medium" x-text="record.student_id"></td>

                                    <td>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <div class="fw-medium">
                                                <span x-text="record.firstname"></span>
                                                <span x-text="record.middlename ? record.middlename : ''"></span>
                                                <span x-text="record.lastname"></span>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <span x-text="course[record.course_id] || ''"></span>
                                    </td>

                                    <td>
                                        <span x-text="record.year_level"></span>
                                    </td>

                                    <td>
                                        <span x-text="record.section"></span>
                                    </td>

                                    <td class="text-center">
                                        <span :class="student_type[record.student_type]"
                                            x-text="record.student_type">

                                        </span>
                                    </td>

                                    <td class="text-center">
                                        <span x-text="record.created_at" class=""></span>
                                    </td>

                                </tr>
                            </template>

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
</div>



<script>
    document.addEventListener('alpine:init', () => {

        Alpine.data('registrarEnrollment', () => ({

            enrollMode: false,
            errors: {},
            loading: false,
            records: {},
            form: {
                student_id: '',
                firstname: '',
                lastname: '',
                middlename: '',
                suffix: '',
                sex: '',
                birthdate: '',
                email: '',
                contact_no: '',
                contact_person: '',
                address: '',
                course: '',
                section: '',
                student_type: '',
                year_level: '',
                academic_year: '',
                semester: '',

            },

            init() {
                this.getNewEnrollment();
            },

            course: {
                1: 'DPIT',
                2: 'DPTHT',
                3: 'DPET',
                4: 'DPFT',
                5: 'DPWT',
            },
            student_type: {
                'new' : 'badge text-bg-primary text-capitalize',
                'transferee' : 'badge text-bg-warning text-capitalize',
                'returning' : 'badge text-bg-success text-capitalize',
            },
            async enroll() {

                this.loading = true;
                this.errors = {};

                try {

                    const formData = new FormData();

                    formData.append('student_id', this.form.student_id);
                    formData.append('firstname', this.form.firstname);
                    formData.append('lastname', this.form.lastname);
                    formData.append('middlename', this.form.middlename);
                    formData.append('suffix', this.form.suffix);
                    formData.append('sex', this.form.sex);
                    formData.append('birthdate', this.form.birthdate);
                    formData.append('email', this.form.email);
                    formData.append('contact_no', this.form.contact_no);
                    formData.append('contact_person', this.form.contact_person);
                    formData.append('address', this.form.address);
                    formData.append('course', this.form.course);
                    formData.append('section', this.form.section);
                    formData.append('student_type', this.form.student_type);
                    formData.append('year_level', this.form.year_level);
                    formData.append('academic_year', this.form.academic_year);
                    formData.append('semester', this.form.semester);

                    const res = await fetch(
                        '<?= base_url('registrar/manage-enrollment') ?>',
                        {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        }
                    );

                    const data = await res.json();

                    if (!res.ok) {
                        throw new Error(data.message || 'Enrollment failed.');
                    }

                    if (data.status === 200) {

                        Swal.fire({
                            icon: 'success',
                            title: 'Enrollment Successful',
                            text: data.message,
                            confirmButtonText: 'OK'
                        });

                        this.resetForm();

                    } else {

                        this.errors = data.errors || {};

                        Swal.fire({
                            icon: 'error',
                            title: 'Enrollment Failed',
                            text: data.message || 'Please check the form.'
                        });

                    }

                } catch (error) {

                    console.error(error);

                    Swal.fire({
                        icon: 'error',
                        title: 'Something went wrong',
                        text: error.message || 'Unable to process the enrollment.'
                    });

                } finally {

                    this.loading = false;

                }
            },

            resetForm() {
                this.form = {
                    student_id: '',
                    firstname: '',
                    lastname: '',
                    middlename: '',
                    suffix: '',
                    sex: '',
                    birthdate: '',
                    email: '',
                    contact_no: '',
                    contact_person: '',
                    address: '',
                    course_id: '',
                    section: '',
                    student_type: '',
                    year_level: '',
                    academic_year: '',
                    semester: '',
                };

                this.errors = {};
                this.enrollMode = false;
            },

            async getNewEnrollment() {
                const res = await fetch(`<?= base_url('/registrar/manage-enrollment/records') ?>`);

                const data = await res.json();

                if (data.records) {
                    this.records = data.records;
                    console.log(this.records);
                }
            },

        }));

    });

</script>

<?= $this->endSection() ?>