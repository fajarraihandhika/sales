<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Sales - PT Maju Jaya</title>

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
            padding: 20px;
        }

        @keyframes gradientBg {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 460px;
            padding: 45px 35px;
        }

        .brand-logo {
            font-size: 1.8rem;
            font-weight: 800;
            letter-spacing: 2px;
            background: linear-gradient(to right, #3b82f6, #818cf8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 5px;
            text-align: center;
        }

        .brand-subtitle {
            font-size: 0.85rem;
            color: #64748b;
            font-weight: 600;
            letter-spacing: 1px;
            margin-bottom: 8px;
            text-align: center;
        }

        .role-tag {
            display: inline-block;
            background: #e0f2fe;
            color: #0369a1;
            font-size: 0.75rem;
            font-weight: 700;
            padding: 5px 14px;
            border-radius: 999px;
            margin: 0 auto 30px auto;
            text-align: center;
        }
        .role-tag-wrap { text-align: center; }

        .form-label {
            font-size: 0.85rem;
            font-weight: 700;
            color: #334155;
            margin-bottom: 8px;
        }

        .input-group-custom {
            position: relative;
            margin-bottom: 22px;
        }

        .input-group-custom i.input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
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
            transition: all 0.2s ease;
        }

        .form-control-custom:focus {
            background-color: #ffffff;
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15);
            outline: none;
        }

        .toggle-password {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            cursor: pointer;
            z-index: 5;
        }

        .btn-register {
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
            margin-top: 6px;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.4);
        }

        .login-link {
            font-size: 0.85rem;
            color: #64748b;
            margin-top: 28px;
            text-align: center;
        }

        .login-link a {
            color: #2563eb;
            font-weight: 700;
            text-decoration: none;
        }
        .login-link a:hover { text-decoration: underline; }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="brand-logo"><i class="fa-solid fa-bolt-lightning me-1"></i> PT MAJU JAYA</div>
        <div class="brand-subtitle">Sales Order Platform</div>
        <div class="role-tag-wrap">
            <span class="role-tag"><i class="fa-solid fa-route me-1"></i> Pendaftaran khusus Tim Sales Lapangan</span>
        </div>

        <form action="<?= base_url('auth/register'); ?>" method="POST">

            <div class="text-start">
                <label class="form-label">Nama Lengkap</label>
                <div class="input-group-custom">
                    <input type="text" name="nama_lengkap" placeholder="Nama lengkap sesuai identitas" value="<?= set_value('nama_lengkap'); ?>" class="form-control-custom">
                    <i class="fa-solid fa-id-badge input-icon"></i>
                </div>
            </div>

            <div class="text-start">
                <label class="form-label">Username</label>
                <div class="input-group-custom">
                    <input type="text" name="username" placeholder="Untuk login ke dashboard" value="<?= set_value('username'); ?>" class="form-control-custom">
                    <i class="fa-solid fa-user-tie input-icon"></i>
                </div>
            </div>

            <div class="text-start">
                <label class="form-label">Kata Sandi</label>
                <div class="input-group-custom">
                    <input type="password" id="passwordField" name="password" placeholder="Minimal 5 karakter" class="form-control-custom">
                    <i class="fa-solid fa-lock input-icon"></i>
                    <i class="fa-regular fa-eye toggle-password" id="eyeIcon" onclick="togglePasswordVisibility()"></i>
                </div>
            </div>

            <button type="submit" class="btn-register">
                Daftar Sebagai Sales <i class="fa-solid fa-arrow-right ms-2"></i>
            </button>

            <div class="login-link">
                Sudah punya akun? <a href="<?= base_url('auth'); ?>">Masuk di sini</a>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let validationNamaError = "<?= strip_tags(form_error('nama_lengkap')); ?>";
            let validationUserError = "<?= strip_tags(form_error('username')); ?>";
            let validationPassError = "<?= strip_tags(form_error('password')); ?>";
            let flashMessage = "<?= $this->session->flashdata('message'); ?>";

            let errorResult = "";
            if (validationNamaError) errorResult += validationNamaError + " ";
            if (validationUserError) errorResult += validationUserError + " ";
            if (validationPassError) errorResult += validationPassError;

            if (errorResult.trim() !== "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Registrasi Gagal',
                    text: errorResult,
                    confirmButtonColor: '#2563eb'
                });
            } else if (flashMessage.trim() !== "") {
                let isSuccess = flashMessage.toLowerCase().includes('berhasil');
                Swal.fire({
                    icon: isSuccess ? 'success' : 'error',
                    title: isSuccess ? 'Berhasil!' : 'Gagal',
                    text: flashMessage,
                    confirmButtonColor: '#2563eb',
                    timer: isSuccess ? 2000 : undefined,
                    timerProgressBar: isSuccess
                });
            }
        });

        function togglePasswordVisibility() {
            const passwordField = document.getElementById("passwordField");
            const eyeIcon = document.getElementById("eyeIcon");
            if (passwordField.type === "password") {
                passwordField.type = "text";
                eyeIcon.classList.replace("fa-eye", "fa-eye-slash");
            } else {
                passwordField.type = "password";
                eyeIcon.classList.replace("fa-eye-slash", "fa-eye");
            }
        }
    </script>
</body>
</html>