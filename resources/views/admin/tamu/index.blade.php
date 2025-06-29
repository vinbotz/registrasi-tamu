@extends('layouts.app')

@section('content')
<!-- Link ke CSS yang baru -->
<link rel="stylesheet" href="{{ asset('css/style2.css') }}" />
<link rel="stylesheet" href="{{ asset('css/style-admin-webprint.css') }}">
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
        <img src="{{ asset('img/logo-kanan.png') }}" alt="Logo Kanan" class="logo" />
    </div>

    <hr />

    <h1 class="text-center font-bold mb-6">Data Tamu</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tombol Menuju Web Print -->
    <div class="mb-4 text-right no-print">
        <a href="/index.html" class="btn-webprint">Menuju Web Print</a>
    </div>

    <form action="{{ route('admin.tamu.bulk-download') }}" method="POST" class="no-print" name="bulk-download-form">
        @csrf
        <div class="mb-4">
            <button type="submit" class="btn hijau">
                Download Data
            </button>
        </div>
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
                                <form action="{{ route('admin.tamu.destroy', $tamu->id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus data ini?');" style="display:flex;align-items:center;">
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

<!-- Footer -->
<footer class="footer no-print">
    <hr />
    <p>© 2025 Sekretariat DPRD Kota Bogor. All rights reserved.</p>
    <p>By Mahasiswa Universitas Binaniaga</p>
</footer>
@endsection

<script>
    console.log("Script loaded and running."); // Log untuk debugging awal

    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('select-all').addEventListener('change', function () {
            const checkboxes = document.querySelectorAll('input[name="selected_ids[]"]');
            for (let checkbox of checkboxes) {
                checkbox.checked = this.checked;
            }
        });

        const bulkDownloadForm = document.querySelector('form[name="bulk-download-form"]');
        if (bulkDownloadForm) {
            bulkDownloadForm.addEventListener('submit', function(e) {
                const checkboxes = document.querySelectorAll('input[name="selected_ids[]"]:checked');
                
                console.log('Jumlah checkbox terpilih:', checkboxes.length); // Log jumlah checkbox yang terpilih

                if (checkboxes.length === 0) {
                    alert('Pilih setidaknya satu data untuk diunduh.');
                    e.preventDefault();
                } else {
                    checkboxes.forEach(function(checkbox) {
                        const hiddenInput = document.createElement('input');
                        hiddenInput.type = 'hidden';
                        hiddenInput.name = 'selected_ids[]';
                        hiddenInput.value = checkbox.value;
                        e.target.appendChild(hiddenInput);
                    });
                }
            });
        } else {
            console.log('Form bulk-download-form tidak ditemukan.');
        }
    });
</script>
