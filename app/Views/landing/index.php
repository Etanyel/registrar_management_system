<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?= base_url('bootstrap/dist/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('bootstrap-icons/font/bootstrap-icons.css') ?>">
    <script defer src="<?= base_url('/alpinejs/dist/cdn.min.js') ?>"></script>
    <link rel="stylesheet" href="<?= base_url('sweetalert2/dist/sweetalert2.min.css') ?>">

    <title>Login</title>
</head>

<body>
    <div x-data="loginApp()" class="container d-flex justify-content-center align-items-center min-vh-100">
        <form @submit.prevent="login" action="" class="form p-3 shadow-sm rounded">
            <h3 class="form-title text-center">Login</h3>
            <div class="mb-2">
                <label for=""
                    :class="errors.username ? 'form-label mb-0 text-danger fw-semibold' : 'form-label mb-0 fw-semibold'">Username</label>
                <input type="text" x-model="form.username" :class="errors.username   ? 'border-danger' : ''" name=""
                    id="" class="form-control" placeholder="Enter Username">
                <div class="mt-0 mb-0 text-danger" x-show="errors.username" style="font-size: 12px;">
                    <i class="bi bi-exclamation-circle me-1"></i> <span x-text="errors.username"></span>
                </div>
            </div>

            <div class="mb-2">
                <label for=""
                    :class="errors.password ? 'form-label mb-0 text-danger fw-semibold' : 'form-label mb-0 fw-semibold'">Password</label>
                <input type="password" x-model="form.password" id=""
                    :class="errors.password ? 'form-control border-danger' : 'form-control'"
                    placeholder="Enter Password">
                <div class="text-danger mt-0 mb-0" x-show="errors.password" style="font-size: 12px">
                    <i class="bi bi-exclamation-circle me-1"></i> <span x-text="errors.password"></span>
                </div>
            </div>

            <button class="btn btn-dark form-control" :disable="loading">
                <span x-text="loading ? 'Logging In...' : 'Login'"></span>
            </button>
        </form>
    </div>

    <script src="<?= base_url('sweetalert2/dist/sweetalert2.all.min.js') ?>"></script>

    <script>
        document.addEventListener('alpine:init', () => {

            Alpine.data('loginApp', () => ({
                errors: {},
                showPass: false,
                loading: false,
                form: {
                    username: '',
                    password: ''
                },
                async login() {
                    this.errors = {};
                    this.loading = true;

                    try {
                        const formData = new FormData();
                        formData.append('username', this.form.username.trim());
                        formData.append('password', this.form.password);

                        const response = await fetch('<?= base_url('login') ?>', {
                            method: 'POST',
                            body: formData,
                        });
                        const data = await response.json();

                        if (data.status == 200) {

                            if (data.role === 'admin') {
                                window.location.href = '<?= base_url('/admin') ?>';
                            } else if (data.role === 'registrar') {
                                window.location.href = '<?= base_url('/registrar') ?>';
                            }else if (data.role === 'instructor') {
                                window.location.href = '<?= base_url('/instructor') ?>';
                            } else {
                                Swal.fire('Not Authorized', 'Invalid User!', 'error');
                                this.loading = false;
                            }

                        }

                        if (data.status == 401) {
                            this.errors = {
                                'username': data.errors.username,
                                'password': data.errors.password
                            };
                        }

                    } catch (error) {
                        console.error(err);
                        Swal.fire('Error', 'Something went wrong.', 'error');
                        this.loading = false;
                    }finally{
                        this.loading = false;
                    }
                },
            }));
        });
    </script>
</body>

</html>