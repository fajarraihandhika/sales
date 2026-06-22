<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PT Maju Jaya Enterprise</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --primary-dark: #0f172a;
            --secondary-dark: #1e293b;
            --accent-blue: #38bdf8;
            --gradient-start: #0f172a;
            --gradient-end: #1e293b;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(-45deg, #0f172a, #1e293b, #0f172a, #3b82f6);
            background-size: 400% 400%;
            animation: gradientBg 15s ease infinite;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            padding: 20px;
        }

        @keyframes gradientBg {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Glassmorphism Card Container */
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 450px;
            padding: 45px 35px;
            transition: all 0.3s ease;
        }

        .brand-logo {
            font-size: 1.8rem;
            font-weight: 800;
            letter-spacing: 2px;
            background: linear-gradient(to right, #3b82f6, #818cf8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 5px;
        }

        .brand-subtitle {
            font-size: 0.85rem;
            color: #64748b;
            font-weight: 600;
            letter-spacing: 1px;
            text-uppercase: true;
            margin-bottom: 35px;
        }

        /* Custom Modern Form Inputs */
        .form-label {
            font-size: 0.85rem;
            font-weight: 700;
            color: #334155;
            margin-bottom: 8px;
        }

        .input-group-custom {
            position: relative;
            margin-bottom: 25px;
        }

        .input-group-custom i.input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            transition: color 0.2s ease;
            z-index: 5;
        }

        .form-control-custom {
            width: 100%;
            padding: 14px 16px 14px 45px;
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            font-size: 0.95rem;
            font-weight: 500;
            color: #1e293b;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .form-control-custom:focus {
            background-color: #ffffff;
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15);
            outline: none;
        }

        .form-control-custom:focus + i.input-icon {
            color: #3b82f6;
        }

        /* Toggle Password Eye Icon */
        .toggle-password {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            cursor: pointer;
            z-index: 5;
            transition: color 0.2s ease;
        }
        .toggle-password:hover {
            color: #334155;
        }

        /* Custom Premium Submit Button */
        .btn-login {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            color: #ffffff;
            font-weight: 700;
            font-size: 1rem;
            padding: 14px;
            border: none;
            border-radius: 12px;
            width: 100%;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
            transition: all 0.2s ease;
            margin-top: 10px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.4);
            background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .register-link {
            font-size: 0.85rem;
            color: #64748b;
            margin-top: 30px;
            text-align: center;
        }

        .register-link a {
            color: #2563eb;
            font-weight: 700;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .register-link a:hover {
            color: #1d4ed8;
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="login-card text-center">
        <div class="brand-logo"><i class="fa-solid fa-bolt-lightning me-1"></i> PT MAJU JAYA</div>
        <div class="brand-subtitle">Sales Order Platform</div>

        <form action="<?= base_url('auth'); ?>" method="POST">
            
            <div class="text-start">
                <label class="form-label">Username Kontrak</label>
                <div class="input-group-custom">
                    <input type="text" name="username" placeholder="Masukkan username Anda" value="<?= set_value('username'); ?>" class="form-control-custom">
                    <i class="fa-solid fa-user-tie input-icon"></i>
                </div>
            </div>

            <div class="text-start">
                <label class="form-label">Kata Sandi</label>
                <div class="input-group-custom">
                    <input type="password" id="passwordField" name="password" placeholder="••••••••" class="form-control-custom">
                    <i class="fa-solid fa-lock input-icon"></i>
                    <i class="fa-regular fa-eye toggle-password" id="eyeIcon" onclick="togglePasswordVisibility()"></i>
                </div>
            </div>

            <button type="submit" class="btn-login">
                Masuk ke Dashboard <i class="fa-solid fa-arrow-right-to-bracket ms-2"></i>
            </button>
            
            <div class="register-link">
                Karyawan baru belum punya akun? <br>
                <a href="<?= base_url('auth/register'); ?>">Registrasi Akun Baru</a>
            </div>
        </form>
    </div>

    <!-- views/auth/login.php - bagian script saja -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        let validationUserError = "<?= strip_tags(form_error('username')); ?>";
        let validationPassError = "<?= strip_tags(form_error('password')); ?>";
        let flashMessage = "<?= strip_tags($this->session->flashdata('message')); ?>";
        let successMessage = "<?= $this->session->flashdata('success'); ?>";

        // Tampilkan notif sukses logout
        if (successMessage.trim() !== "") {
            Swal.fire({
                icon: 'success',
                title: 'Logout Berhasil',
                text: successMessage,
                confirmButtonColor: '#2563eb',
                background: '#ffffff',
                color: '#1e293b',
                timer: 2000,
                timerProgressBar: true
            });
        }

        // Tampilkan notif error login
        let errorResult = "";
        if (validationUserError) errorResult += validationUserError + " ";
        if (validationPassError) errorResult += validationPassError;
        if (flashMessage) errorResult += flashMessage;

        if (errorResult.trim() !== "") {
            Swal.fire({
                icon: 'error',
                title: 'Autentikasi Gagal',
                text: errorResult,
                confirmButtonColor: '#2563eb',
                background: '#ffffff',
                color: '#1e293b',
                timer: 4000,
                timerProgressBar: true
            });
        }
    });

    function togglePasswordVisibility() {
        const passwordField = document.getElementById("passwordField");
        const eyeIcon = document.getElementById("eyeIcon");
        
        if (passwordField.type === "password") {
            passwordField.type = "text";
            eyeIcon.classList.remove("fa-eye");
            eyeIcon.classList.add("fa-eye-slash");
        } else {
            passwordField.type = "password";
            eyeIcon.classList.remove("fa-eye-slash");
            eyeIcon.classList.add("fa-eye");
        }
    }
</script>
</body>
</html>