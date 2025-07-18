@extends('layouts.app')

@section('content')

<style>
    body {
        font-family: Arial, sans-serif;
        padding: 30px;
        background-image: url("../img/background.png"); /* sesuaikan path jika berbeda */
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: center;
    }

    .container {
        background-color: white;
        padding: 20px;
        max-width: 900px;
        margin: auto;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    /* === Header / Kop === */
    .kop {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }

    .logo {
        height: 100px;
        width: auto;
    }

    .text-header {
        text-align: center;
        flex: 1;
        padding: 0 20px;
    }

    /* === Garis Pembatas === */
    hr {
        border: 1px solid black;
        margin: 20px 0;
    }

    /* === Info Tanggal/Waktu/Tempat/Acara === */
    table.info {
        margin: 0 auto 20px auto;
        font-size: 14px;
        text-align: left;
    }

    table.info td {
        padding: 2px 10px 2px 0;
    }

    /* === Tabel Daftar Hadir === */
    table.daftar-hadir {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
    }

    table.daftar-hadir th,
    table.daftar-hadir td {
        border: 1px solid black;
        text-align: center;
        padding: 5px;
        height: 30px;
    }

    table.daftar-hadir th {
        background-color: #f2f2f2;
    }

    /* Kolom Nama dan Jabatan rata tengah (default) */
    table.daftar-hadir th:nth-child(2),
    table.daftar-hadir td:nth-child(2),
    table.daftar-hadir th:nth-child(5),
    table.daftar-hadir td:nth-child(5) {
        text-align: center !important;
        padding-left: 0;
    }

    /* Kolom Nama lebih lebar dan rata kiri (override) */
    table.daftar-hadir th:nth-child(2),
    table.daftar-hadir td:nth-child(2) {
        min-width: 200px;
        width: 220px;
        text-align: left !important;
        padding-left: 12px;
    }

    /* Kolom Jabatan lebih lebar dan rata kiri (override) */
    table.daftar-hadir th:nth-child(5),
    table.daftar-hadir td:nth-child(5) {
        min-width: 160px;
        width: 180px;
        text-align: left !important;
        padding-left: 10px;
    }

    @media print {
        table.daftar-hadir th:nth-child(2),
        table.daftar-hadir td:nth-child(2) {
            min-width: 220px;
            width: 250px;
            font-size: 15px;
        }

        table.daftar-hadir th:nth-child(5),
        table.daftar-hadir td:nth-child(5) {
            min-width: 180px;
            width: 200px;
            font-size: 15px;
        }
    }

    /* === Panel Tombol & Input === */
    .tombol-panel {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 20px;
        margin-top: 20px;
        margin-left: 10px;
        margin-bottom: 30px;
    }

    .input-baris {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        justify-content: flex-start;
        margin-bottom: 10px;
    }

    .input-baris input {
        padding: 8px 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        min-width: 150px;
        font-size: 14px;
    }

    .button-baris {
        display: flex;
        gap: 12px;
        justify-content: flex-start;
        margin-bottom: 10px;
    }

    .button-kolom {
        display: flex;
        flex-direction: row;
        gap: 10px;
        justify-content: center;
        margin-top: 10px;
    }

    /* === Tombol Admin === */
    .btn {
        padding: 8px 14px;
        font-size: 14px;
        cursor: pointer;
        border: none;
        color: white;
        border-radius: 5px;
        font-weight: bold;
    }

    .biru {
        background-color: #007bff;
    }
    .hijau {
        background-color: #28a745;
    }
    .merah {
        background-color: #dc3545;
    }

    .btn-admin {
        background: linear-gradient(90deg, #2563eb 0%, #1d4ed8 100%);
        color: #fff;
        padding: 10px 24px;
        border-radius: 6px;
        font-weight: 600;
        text-decoration: none;
        box-shadow: 0 2px 8px rgba(37, 99, 235, 0.15);
        transition: background 0.2s, box-shadow 0.2s;
        display: inline-block;
        margin-bottom: 20px;
    }
    .btn-admin:hover {
        background: linear-gradient(90deg, #1d4ed8 0%, #2563eb 100%);
        box-shadow: 0 4px 16px rgba(37, 99, 235, 0.25);
        color: #fff;
        text-decoration: none;
    }

    /* === Download Data === */
    .no-print {
        display: block;
    }

    @media print {
        .no-print {
            display: none !important;
        }

        body {
            background: white;
            margin: 0;
            padding: 20px;
        }

        .container {
            background: white;
            box-shadow: none;
            margin: 0;
            padding: 0;
        }

        .kop {
            margin-bottom: 20px;
        }

        .text-header {
            font-size: 16px;
            font-weight: bold;
        }

        .logo {
            max-width: 80px;
        }
    }

    @media (max-width: 600px) {
        body {
            padding: 8px;
        }
        .container {
            padding: 8px;
            max-width: 100vw;
            box-shadow: none;
        }
        .kop {
            flex-direction: column;
            align-items: center;
            gap: 10px;
            text-align: center;
        }
        .logo {
            height: 60px;
        }
        .text-header {
            padding: 0 4px;
            font-size: 0.95em;
        }
        table.info {
            font-size: 13px;
        }
        table.daftar-hadir {
            font-size: 12px;
            min-width: 600px;
        }
        .overflow-x-auto {
            overflow-x: auto;
        }
        .input-baris {
            flex-direction: column;
            gap: 8px;
            width: 100%;
        }
        .input-baris input {
            min-width: 0;
            width: 100%;
            font-size: 13px;
        }
        .no-print.d-flex.gap-2,
        form[name="bulk-download-form"] {
            display: flex !important;
            flex-direction: row !important;
            align-items: center !important;
            gap: 8px !important;
            width: 100%;
        }
        .btn, .btn-admin, .tombol-panel button, .button-baris button, .button-baris a, form[name="bulk-download-form"] button, form[name="bulk-download-form"] a {
            width: auto !important;
            min-width: 90px;
            font-size: 14px;
            padding: 8px 14px;
        }
        .button-baris {
            flex-direction: row !important;
            gap: 8px !important;
            width: 100%;
        }
        .mb-4.text-right.no-print {
            text-align: left !important;
        }
    }

    .footer {
        text-align: center;
        margin-top: 20px;
        font-size: 12px;
        color: #666;
    }
</style>

<div class="container">
    <div class="kop">
        <img src="{{ asset('img/logo-kiri.png') }}" alt="Logo Kiri" class="logo" />
        <div class="text-header">
            <h3>SEKRETARIAT DEWAN PERWAKILAN RAKYAT DAERAH</h3>
            <h3>KOTA BOGOR</h3>
            <p>
                Jln. Pemuda No. 25-29 Kelurahan Tanah Sareal Kecamatan
                Tanah Sareal
            </p>
        </div>
    </div>

    <hr />

    <h1 class="text-center font-bold mb-6">Data Tamu</h1>

    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: @json(session('success')),
                    confirmButtonText: 'OK',
                    timer: 2500,
                    timerProgressBar: true
                });
            });
        </script>
    @endif

    <!-- Tombol Menuju Web Print -->
    <div class="mb-4 text-right no-print">
        <a href="/index.html" class="btn biru">Web Print</a>
    </div>

    <form action="{{ route('admin.tamu.bulk-download') }}" method="POST" class="no-print d-flex gap-2" name="bulk-download-form" style="display:flex;gap:12px;align-items:center;">
        @csrf
        <button type="submit" class="btn hijau">
            Download Data
        </button>
        <a href="{{ route('admin.tamu.index') }}" class="btn btn-primary">Refresh Form</a>
    </form>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="daftar-hadir">
            <thead>
                <tr>
                    <th class="px-4 py-2 border">
                        <input type="checkbox" id="select-all">
                    </th>
                    <th class="px-2 py-2 border" style="width: 45px; min-width: 35px; max-width: 60px; text-align:center;">No</th>
                    <th class="px-4 py-2 border" style="width: 200px; min-width: 150px; max-width: 300px; text-align:center;">Nama</th>
                    <th class="px-4 py-2 border">Acara</th>
                    <th class="px-4 py-2 border">Tempat</th>
                    <th class="px-4 py-2 border">Waktu</th>
                    <th class="px-4 py-2 border">Nomor HP</th>
                    <th class="px-4 py-2 border">Jabatan</th>
                    <th class="px-4 py-2 border">Asal Daerah</th>
                    <th class="px-4 py-2 border no-print">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tamus as $index => $tamu)
                    <tr class="text-center">
                        <td class="px-4 py-2 border">
                            <input type="checkbox" name="selected_ids[]" value="{{ $tamu->id }}">
                        </td>
                        <td class="px-2 py-2 border" style="width: 45px; min-width: 35px; max-width: 60px; text-align:center;">{{ $index + 1 }}</td>
                        <td class="px-4 py-2 border" style="width: 200px; min-width: 150px; max-width: 300px; text-align:center;">{{ $tamu->nama }}</td>
                        <td class="px-4 py-2 border">{{ $tamu->acara }}</td>
                        <td class="px-4 py-2 border">{{ $tamu->tempat }}</td>
                        <td class="px-4 py-2 border">{{ $tamu->waktu }}</td>
                        <td class="px-4 py-2 border">{{ $tamu->nomor_hp }}</td>
                        <td class="px-4 py-2 border">{{ $tamu->jabatan }}</td>
                        <td class="px-4 py-2 border">{{ $tamu->asal_daerah }}</td>
                        <td class="px-4 py-2 border no-print">
                            <div class="flex justify-center items-center" style="display:flex;align-items:center;gap:8px;">
                                <a href="{{ route('admin.tamu.edit', $tamu->id) }}" class="btn biru" title="Edit" style="width:90px;height:38px;display:flex;align-items:center;justify-content:center;font-size:14px;padding:0;">
                                    <i class="bi bi-pencil-square"></i> <span style="margin-left:4px;">Edit</span>
                                </a>
                                <form action="{{ route('admin.tamu.destroy', $tamu->id) }}" method="POST" data-delete-form style="display:flex;align-items:center;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn merah" title="Hapus" style="width:90px;height:38px;display:flex;align-items:center;justify-content:center;font-size:14px;padding:0;">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="margin-right:4px;">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m2 0a2 2 0 00-2-2H9a2 2 0 00-2 2h10z" />
                                        </svg> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center py-4">Belum ada data tamu.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="text-center mt-3" style="font-size:0.9rem; color:#fff;">
    © 2025 Sekretariat DPRD Kota Bogor. All rights reserved.<br>
    By Mahasiswa Universitas Binaniaga
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        document
            .getElementById("select-all")
            .addEventListener("change", function () {
                const checkboxes = document.querySelectorAll(
                    'input[name="selected_ids[]"]'
                );
                for (let checkbox of checkboxes) {
                    checkbox.checked = this.checked;
                }
            });

        const bulkDownloadForm = document.querySelector(
            'form[name="bulk-download-form"]'
        );
        if (bulkDownloadForm) {
            bulkDownloadForm.addEventListener("submit", function (e) {
                const checkboxes = document.querySelectorAll(
                    'input[name="selected_ids[]"]:checked'
                );
                if (checkboxes.length === 0) {
                    alert("Pilih setidaknya satu data untuk diunduh.");
                    e.preventDefault();
                } else {
                    checkboxes.forEach(function (checkbox) {
                        const hiddenInput = document.createElement("input");
                        hiddenInput.type = "hidden";
                        hiddenInput.name = "selected_ids[]";
                        hiddenInput.value = checkbox.value;
                        e.target.appendChild(hiddenInput);
                    });
                }
            });
        }

        // SweetAlert2 untuk konfirmasi hapus
        document.querySelectorAll('form[data-delete-form]').forEach(function(form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Yakin hapus data ini?',
                    text: 'Data yang dihapus tidak bisa dikembalikan!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>

@endsection
