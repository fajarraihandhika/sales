<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'PT Maju Jaya - Executive Dashboard'; ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-dark: #0f172a;
            --secondary-dark: #1e293b;
            --accent-blue: #38bdf8;
            --accent-green: #10b981;
            --bg-light: #f8fafc;
            --text-main: #334155;
            --card-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.04), 0 8px 16px -6px rgba(15, 23, 42, 0.04);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-main);
            overflow-x: hidden;
        }

        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        .navbar-premium {
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            padding: 15px 30px;
        }
        .navbar-premium .navbar-brand {
            font-weight: 800;
            font-size: 1.25rem;
            letter-spacing: 1.5px;
            background: linear-gradient(to right, #38bdf8, #818cf8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Pengganti class Bootstrap yang sebelumnya invalid (bg-secondary-dark, py-1.5, dst) */
        .user-pill {
            display: flex;
            align-items: center;
            background-color: var(--secondary-dark);
            padding: 6px 14px 6px 6px;
            border-radius: 999px;
            border: 1px solid rgba(255,255,255,0.1);
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
        }
        .user-pill .user-name {
            display: block;
            color: #ffffff;
            font-weight: 700;
            font-size: 0.85rem;
            line-height: 1.1;
            margin-bottom: 2px;
        }
        .user-pill .user-role-badge {
            font-size: 0.6rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .user-pill .avatar-circle {
            width: 36px;
            height: 36px;
            background: var(--accent-blue);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            margin-left: 10px;
        }

        /* Animasi pulse buat icon brand (sebelumnya pakai class animate-pulse yang nggak exist) */
        @keyframes pulseGlow {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.4; }
        }
        .brand-pulse-icon { animation: pulseGlow 2s ease-in-out infinite; }

        .card {
            background: #ffffff;
            border-radius: 16px;
            border: 1px solid rgba(241, 245, 249, 0.8);
            box-shadow: var(--card-shadow);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(15, 23, 42, 0.08), 0 10px 10px -6px rgba(15, 23, 42, 0.08);
        }

        .form-control, .form-select {
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            padding: 10px 16px;
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }
        .form-control:focus, .form-select:focus {
            border-color: #38bdf8;
            box-shadow: 0 0 0 4px rgba(56, 189, 248, 0.15);
        }

        .table { border-collapse: separate; border-spacing: 0 8px; }
        .table tbody tr {
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.01);
            border-radius: 8px;
            transition: all 0.2s ease;
        }
        .table tbody tr:hover { background-color: #f8fafc !important; transform: scale(1.005); }
        .table th {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            color: #64748b;
            border: none;
            padding: 12px 20px;
        }
        .table td { padding: 16px 20px; border-top: 1px solid #f1f5f9; border-bottom: 1px solid #f1f5f9; }
        .table td:first-child { border-left: 1px solid #f1f5f9; border-top-left-radius: 8px; border-bottom-left-radius: 8px; }
        .table td:last-child { border-right: 1px solid #f1f5f9; border-top-right-radius: 8px; border-bottom-right-radius: 8px; }

        .badge-premium { padding: 6px 12px; border-radius: 30px; font-weight: 700; font-size: 0.75rem; letter-spacing: 0.5px; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-premium sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <i class="fa-solid fa-bolt-lightning me-2 text-info brand-pulse-icon"></i> PT MAJU JAYA
            </a>

            <div class="ms-auto d-flex align-items-center">
                <div class="user-pill">
                    <div class="text-end">
                        <span class="user-name"><?= $this->session->userdata('nama_lengkap'); ?></span>
                        <span class="badge bg-info text-dark font-monospace user-role-badge"><?= $this->session->userdata('role'); ?></span>
                    </div>
                    <div class="avatar-circle">
                        <i class="fa-solid fa-user-tie"></i>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">