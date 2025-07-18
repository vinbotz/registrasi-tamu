<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Tamu Kunjungan Kerja</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            background-image: url('/images/foto_gedung.jpg'); /* lokasi foto*/
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
            font-family: 'Segoe UI', sans-serif;
        }

        .overlay {
            background-color: rgba(255, 255, 255, 0.9); /* Agar form tetap mudah dibaca */
            padding: 3rem;
            border-radius: 1rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .card {
            border: none;
        }

        h1 {
            font-weight: 600;
        }

        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13,110,253,.25);
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="overlay bg-white p-6 shadow-lg rounded-lg">
            @auth
                <form method="POST" action="{{ route('admin.logout') }}" style="text-align: right; margin-bottom: 1rem;">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            @endauth
            @yield('content')
        </div>
    </div>
    <div class="text-center mt-3" style="font-size:0.9rem; color:#fff;">
        © 2025 Sekretariat DPRD Kota Bogor. All rights reserved.<br>
        By Mahasiswa Universitas Binaniaga
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
