<?= $this->extend('registrar/layout') ?>

<?= $this->section('active-enrollment') ?>
active
<?= $this->endSection() ?>

<?= $this->section('page-title') ?>
Enrollment
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div x-data="ViewRecord" class="container-fluid shadow-sm rounded bg-white p-3">


    <!-- Loading -->
    <div
        x-show="loading"
        class="text-center py-5">
        <div class="spinner-border text-primary"></div>
        <div class="mt-2 text-muted">
            Loading enrollment record...
        </div>
    </div>


    <!-- Error -->
    <div
        x-show="errors"
        x-cloak
        class="alert alert-danger"
        x-text="errors"></div>


    <!-- Record -->
    <div
        x-show="!loading && record"
        x-cloak
        class="row" x-transition>

        <!-- LEFT SIDE -->
        <div class="col-lg-4 border-end">
            <a
                href="/registrar/manage-enrollment"
                class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i>
                Back
            </a>
            <!-- Avatar -->
            <div class="text-center">

                <img
                    :src="record.photo
                        ? '/uploads/students/' + record.photo
                        : '/img/default_avatar.jpg'"
                    class="rounded-circle border"
                    width="250"
                    height="250"
                    style="object-fit: cover;"
                    alt="Student Photo">

                <h4
                    class="mt-3 mb-1"
                    x-text="record.firstname + ' ' + record.lastname"></h4>

                <div
                    class="text-muted fw-semibold"
                    x-text="record.student_id"></div>

                <!-- Status -->
                <div class="mt-3">
                    <span
                        class="badge text-capitalize"
                        :class="record.student_status === 'active'
                            ? 'bg-success'
                            : 'bg-secondary'"
                        x-text="record.student_status"></span>
                </div>

            </div>


            <!-- Actions -->
            <div class="d-grid gap-2 mt-4">

                <button
                    type="button"
                    class="btn btn-primary" x-show="!editMode" @click="editMode = true">
                    <i class="bi bi-pencil"></i>
                    Edit Enrollment
                </button>

                <button type="button" class="btn btn-dark" x-show="editMode" @click="editMode = false">Cancel Edit</button>

            </div>

        </div>


        <!-- RIGHT SIDE -->
        <div class="col-lg-8" x-show="!editMode">

            <h5 class="border-bottom pb-2 mb-3">
                Student Information
            </h5>

            <div class="row">

                <!-- Student ID -->
                <div class="col-md-6 mb-3">
                    <label class="form-label text-muted fw-semibold">
                        Student ID
                    </label>

                    <div class="fw-semibold bg-light rounded p-2 shadow-sm">
                        <span x-text="record.student_id"></span>
                    </div>
                </div>


                <!-- Full Name -->
                <div class="col-md-6 mb-3">
                    <label class="form-label text-muted fw-semibold">
                        Full Name
                    </label>

                    <div class="fw-semibold bg-light rounded p-2 shadow-sm">
                        <span x-text="
                            record.firstname +
                            ' ' +
                            (record.middlename ?? '') +
                            ' ' +
                            record.lastname +
                            ' ' +
                            (record.suffix ?? '')
                        "></span>
                    </div>
                </div>


                <!-- Sex -->
                <div class="col-md-6 mb-3">
                    <label class="form-label text-muted fw-semibold">
                        Sex
                    </label>

                    <div class="fw-semibold bg-light rounded p-2 shadow-sm">
                        <span x-text="record.sex"></span>
                    </div>
                </div>


                <!-- Birthdate -->
                <div class="col-md-6 mb-3">
                    <label class="form-label text-muted fw-semibold">
                        Birthdate
                    </label>

                    <div class="fw-semibold bg-light rounded p-2 shadow-sm">
                        <span x-text="formatDate(record.birthdate)"></span>
                    </div>
                </div>


                <!-- Email -->
                <div class="col-md-6 mb-3">
                    <label class="form-label text-muted fw-semibold">
                        Email
                    </label>

                    <div class="fw-semibold bg-light rounded p-2 shadow-sm">
                        <span x-text="record.email || '—'"></span>
                    </div>
                </div>


                <!-- Contact -->
                <div class="col-md-6 mb-3">
                    <label class="form-label text-muted fw-semibold">
                        Contact Number
                    </label>

                    <div class="fw-semibold bg-light rounded p-2 shadow-sm">
                        <span x-text="record.contact_no || '—'"></span>
                    </div>
                </div>

            </div>


            <h5 class="border-bottom pb-2 mb-3 mt-3">
                Enrollment Information
            </h5>

            <div class="row">

                <!-- Course -->
                <div class="col-md-6 mb-3">
                    <label class="form-label text-muted fw-semibold">
                        Course
                    </label>

                    <div class="fw-semibold bg-light rounded p-2 shadow-sm">
                        <span x-text="record.course_name"></span>
                    </div>
                </div>


                <!-- Student Type -->
                <div class="col-md-6 mb-3">
                    <label class="form-label text-muted fw-semibold">
                        Student Type
                    </label>

                    <div>
                        <span :class="student_type[record.student_type]" x-text="record.student_type" class="text-capitalize shadow-sm"></span>
                    </div>
                </div>


                <!-- Year Level -->
                <div class="col-md-6 mb-3">
                    <label class="form-label text-muted fw-semibold">
                        Year Level
                    </label>

                    <div class="fw-semibold bg-light rounded p-2 shadow-sm">
                        <span x-text="record.year_level"></span>
                    </div>
                </div>


                <!-- Section -->
                <div class="col-md-6 mb-3">
                    <label class="form-label text-muted fw-semibold">
                        Section
                    </label>

                    <div class="fw-semibold bg-light rounded p-2 shadow-sm">
                        <span x-text="record.section"></span>
                    </div>
                </div>


                <!-- Academic Year -->
                <div class="col-md-6 mb-3">
                    <label class="form-label text-muted fw-semibold">
                        Academic Year
                    </label>

                    <div class="fw-semibold bg-light rounded p-2 shadow-sm">
                        <span x-text="record.academic_year"></span>
                    </div>
                </div>


                <!-- Semester -->
                <div class="col-md-6 mb-3">
                    <label class="form-label text-muted fw-semibold">
                        Semester
                    </label>

                    <div class="fw-semibold bg-light rounded p-2 shadow-sm">
                        <span x-text="record.semester"></span>
                    </div>
                </div>


                <!-- Enrolled By -->
                <div class="col-md-6 mb-3">
                    <label class="form-label text-muted fw-semibold">
                        Enrolled By
                    </label>

                    <div class="fw-semibold bg-light rounded p-2 shadow-sm">
                        <span x-text="record.username || '—'"></span>
                    </div>
                </div>


                <!-- Created -->
                <div class="col-md-6 mb-3">
                    <label class="form-label text-muted fw-semibold">
                        Date Enrolled
                    </label>

                    <div class="fw-semibold bg-light rounded p-2 shadow-sm">
                        <span x-text="formatDate(record.created_at)"></span>
                    </div>
                </div>

            </div>

        </div>

        <div class="col-lg-8" x-show="editMode" x-cloak>
            <h5 class="border-bottom pb-2 mb-3">
                Student Information
            </h5>

            <div class="row">

                <!-- Student ID -->
                <div class="col-md-12 mb-3">
                    <label class="form-label text-muted fw-semibold">
                        Student ID
                    </label>

                    <div class="fw-semibold bg-light rounded p-2 shadow-sm">
                        <span x-text="record.student_id"></span>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label text-muted fw-semibold">
                        Last Name
                    </label>
                    <input type="text" class="form-control" :value="record.lastname">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label text-muted fw-semibold">
                        First Name
                    </label>
                    <input type="text" class="form-control" :value="record.firstname">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label text-muted fw-semibold">
                        Middle Name
                    </label>
                    <input type="text" class="form-control" :value="record.middlename ?? ''">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label text-muted fw-semibold">
                        Suffix
                    </label>
                    <input type="text" class="form-control" :value="record.suffix ?? ''">
                </div>


                <!-- Sex -->
                <div class="col-md-6 mb-3">
                    <label class="form-label text-muted fw-semibold">
                        Sex
                    </label>

                    <div class="fw-semibold">
                        <select name="" :value="record.sex" class="form-control">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                </div>


                <!-- Birthdate -->
                <div class="col-md-6 mb-3">
                    <label class="form-label text-muted fw-semibold">
                        Birthdate
                    </label>

                    <div class="fw-semibold">
                        <input type="date" name="" :value="record.birthdate" class="form-control">
                    </div>
                </div>


                <!-- Email -->
                <div class="col-md-6 mb-3">
                    <label class="form-label text-muted fw-semibold">
                        Email
                    </label>

                    <div class="fw-semibold">
                        <input type="email" name="" :value="record.email || '—'" class="form-control">
                    </div>
                </div>


                <!-- Contact -->
                <div class="col-md-6 mb-3">
                    <label class="form-label text-muted fw-semibold">
                        Contact Number
                    </label>

                    <div class="fw-semibold">
                        <span x-text=""></span>
                        <input type="text" maxlength="11" class="form-control">
                    </div>
                </div>

            </div>


            <h5 class="border-bottom pb-2 mb-3 mt-3">
                Enrollment Information
            </h5>

            <div class="row">

                <!-- Course -->
                <div class="col-md-6 mb-3">
                    <label class="form-label text-muted fw-semibold">
                        Course
                    </label>

                    <div class="fw-semibold">
                        <span x-text=""></span>
                        <select :value="record.course_id" class="form-select">

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
                </div>


                <!-- Student Type -->
                <div class="col-md-6 mb-3">
                    <label class="form-label text-muted fw-semibold">
                        Student Type
                    </label>

                    <div>
                        <select name="" :value="record.student_type" class="form-control">
                            <option value="new">New</option>
                            <option value="transferee">Transferee</option>
                            <option value="returning">Returning</option>
                        </select>
                    </div>
                </div>


                <!-- Year Level -->
                <div class="col-md-6 mb-3">
                    <label class="form-label text-muted fw-semibold">
                        Year Level
                    </label>

                    <div class="fw-semibold">
                        <select name="" id="" :value="record.year_level" class="form-control">
                            <option value="1">1st year</option>
                            <option value="2">2nd year</option>
                            <option value="3">3rd year</option>
                        </select>
                    </div>
                </div>


                <!-- Section -->
                <div class="col-md-6 mb-3">
                    <label class="form-label text-muted fw-semibold">
                        Section
                    </label>

                    <div class="fw-semibold">
                        <select name="" id="" class="form-control" :value="record.section">
                            <option value="BLOCK-A">BLOCK-A</option>
                            <option value="BLOCK-B">BLOCK-B</option>
                        </select>
                    </div>
                </div>


                <!-- Academic Year -->
                <div class="col-md-6 mb-3">
                    <label class="form-label text-muted fw-semibold">
                        Academic Year
                    </label>

                    <div class="fw-semibold">

                        <select name="" :value="record.academic_year" class="form-control">
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
                </div>


                <!-- Semester -->
                <div class="col-md-6 mb-3">
                    <label class="form-label text-muted fw-semibold">
                        Semester
                    </label>

                    <div class="">
                        <select id="" class="form-control" :value="record.semester">
                            <option value="1st">1st Sem</option>
                            <option value="2nd">2nd Sem</option>
                        </select>
                    </div>
                </div>

            </div>
        </div>

    </div>

</div>


<script>
    function ViewRecord() {

        return {

            record: {},

            errors: '',

            student_type: {
                'new': 'badge bg-primary',
                'transferee': 'badge bg-warning',
                'returning': 'badge bg-success',
            },
            loading: true,

            editMode: false,

            init() {
                this.getRecord();
            },

            async getRecord() {

                this.loading = true;
                this.errors = '';

                try {

                    const res = await fetch('/registrar/manage-enrollment/get-record/<?= esc($record_id) ?>');


                    // Check HTTP status
                    if (!res.ok) {

                        throw new Error(
                            'Failed to load enrollment record.'
                        );

                    }


                    // Convert response to JSON
                    const data = await res.json();


                    // Check API response
                    if (data.status !== 200) {

                        throw new Error(
                            data.message ||
                            'Unable to load record.'
                        );

                    }


                    // Store record
                    this.record = data.record;

                } catch (error) {

                    console.error(error);

                    this.errors = error.message;

                } finally {

                    this.loading = false;

                }

            }

        }

    }
</script>

<?= $this->endSection() ?>