<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasbor Interaktif Pendaftaran Mahasiswa Baru</title>
    <!-- Chosen Palette: Academic Blue -->
    <!-- Application Structure Plan: Saya merancang aplikasi ini sebagai dasbor satu halaman (Single-Page Dashboard). Struktur ini dipilih karena paling efektif untuk menyajikan data agregat dan tren kepada pihak administrasi. Alur pengguna dimulai dengan ringkasan metrik utama (KPI) di bagian atas untuk informasi cepat. Di bawahnya, sebuah grid responsif menyajikan visualisasi data yang lebih mendalam, seperti sebaran program studi, tipe kelas, dan tren pendaftaran. Interaksi utama adalah sebuah filter tunggal di bagian atas yang memungkinkan pengguna untuk memilah seluruh data dasbor berdasarkan program studi. Pendekatan ini memungkinkan pengguna, dari gambaran umum, untuk melakukan analisis mendalam pada segmen tertentu dengan satu klik, menjadikannya sangat intuitif dan efisien untuk memahami data pendaftaran. -->
    <!-- Visualization & Content Choices: 
        - Metrik Utama (Total, Terverifikasi, Pending): Goal->Informasi Cepat; Method->Kartu Statistik (HTML/Tailwind); Interaction->Tidak ada, hanya tampilan; Justification->Menyajikan angka paling penting di awal.
        - Pendaftar per Program Studi: Goal->Perbandingan Proporsi; Method->Donut Chart (Chart.js); Interaction->Tooltip saat hover; Justification->Visual yang jelas untuk melihat program studi paling diminati.
        - Pendaftar per Lokal Kuliah: Goal->Perbandingan Proporsi; Method->Donut Chart (Chart.js); Interaction->Tooltip saat hover; Justification->Memudahkan melihat preferensi tipe kelas (reguler/eksekutif).
        - Tren Pendaftaran Harian: Goal->Melihat Perubahan Waktu; Method->Line Chart (Chart.js); Interaction->Tooltip saat hover; Justification->Menunjukkan momentum dan hari puncak pendaftaran.
        - Distribusi Usia Pendaftar: Goal->Memahami Demografi; Method->Bar Chart (Chart.js); Interaction->Tooltip saat hover; Justification->Memberikan wawasan tentang profil usia calon mahasiswa.
        - Tabel Pendaftar Terbaru: Goal->Informasi Spesifik; Method->Tabel HTML (Tailwind); Interaction->Tidak ada, hanya tampilan; Justification->Menyediakan data mentah terbaru sebagai referensi langsung.
    -->
    <!-- CONFIRMATION: NO SVG graphics used. NO Mermaid JS used. -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            /* slate-50 */
        }

        .chart-container {
            position: relative;
            width: 100%;
            height: 350px;
            max-height: 400px;
        }

        @media (min-width: 768px) {
            .chart-container {
                height: 400px;
            }
        }
    </style>
</head>

<body class="text-slate-800">

    <div class="container mx-auto p-4 md:p-8">
        <!-- HEADER -->
        <header class="mb-8">
            <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900">Dasbor Pendaftaran Mahasiswa Baru</h1>
            <p class="text-slate-600 mt-1">Analisis Data Pendaftaran Tahun Akademik 2025/2026</p>
        </header>

        <!-- MAIN CONTENT -->
        <div id="dashboard-content">

            <!-- FILTERS -->
            <div class="mb-6 bg-white p-4 rounded-lg shadow-sm">
                <label for="programStudiFilter" class="block text-sm font-medium text-slate-700 mb-1">Filter Berdasarkan Program Studi:</label>
                <select id="programStudiFilter" class="w-full md:w-1/3 bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5">
                    <option value="Semua">Tampilkan Semua</option>
                    <option value="S1 Ilmu Administrasi Negara">S1 Ilmu Administrasi Negara</option>
                    <option value="D3 Administrasi Perkantoran">D3 Administrasi Perkantoran</option>
                </select>
            </div>

            <!-- KEY METRICS (KPIs) -->
            <section id="kpi-section">
                <div class="mb-4">
                    <h2 class="text-xl font-bold text-slate-800">Ringkasan Utama</h2>
                    <p class="text-slate-500 text-sm">Metrik performa pendaftaran secara keseluruhan.</p>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-blue-500">
                        <h3 class="text-sm font-medium text-slate-500">TOTAL PENDAFTAR</h3>
                        <p id="totalPendaftar" class="text-4xl font-bold mt-1">0</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-green-500">
                        <h3 class="text-sm font-medium text-slate-500">TERVERIFIKASI</h3>
                        <p id="totalTerverifikasi" class="text-4xl font-bold mt-1">0</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-yellow-500">
                        <h3 class="text-sm font-medium text-slate-500">PENDING</h3>
                        <p id="totalPending" class="text-4xl font-bold mt-1">0</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-red-500">
                        <h3 class="text-sm font-medium text-slate-500">DITOLAK</h3>
                        <p id="totalDitolak" class="text-4xl font-bold mt-1">0</p>
                    </div>
                </div>
            </section>

            <!-- CHARTS GRID -->
            <section id="charts-section">
                <div class="mb-4">
                    <h2 class="text-xl font-bold text-slate-800">Visualisasi Data</h2>
                    <p class="text-slate-500 text-sm">Grafik interaktif untuk analisis yang lebih dalam.</p>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                    <!-- Chart 1: Program Studi -->
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <h3 class="font-bold mb-1">Pendaftar per Program Studi</h3>
                        <p class="text-sm text-slate-500 mb-4">Distribusi pendaftar berdasarkan program studi yang dipilih.</p>
                        <div class="chart-container">
                            <canvas id="programStudiChart"></canvas>
                        </div>
                    </div>
                    <!-- Chart 2: Lokal Kuliah -->
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <h3 class="font-bold mb-1">Pendaftar per Lokal Kuliah</h3>
                        <p class="text-sm text-slate-500 mb-4">Distribusi pendaftar berdasarkan tipe kelas yang dipilih.</p>
                        <div class="chart-container">
                            <canvas id="lokalKuliahChart"></canvas>
                        </div>
                    </div>
                    <!-- Chart 3: Tren Pendaftaran -->
                    <div class="bg-white p-6 rounded-lg shadow-sm lg:col-span-2">
                        <h3 class="font-bold mb-1">Tren Pendaftaran Harian (14 Hari Terakhir)</h3>
                        <p class="text-sm text-slate-500 mb-4">Jumlah pendaftar baru setiap harinya.</p>
                        <div class="chart-container">
                            <canvas id="trenPendaftaranChart"></canvas>
                        </div>
                    </div>
                    <!-- Chart 4: Distribusi Usia -->
                    <div class="bg-white p-6 rounded-lg shadow-sm lg:col-span-2">
                        <h3 class="font-bold mb-1">Distribusi Usia Pendaftar</h3>
                        <p class="text-sm text-slate-500 mb-4">Kelompok usia para calon mahasiswa baru.</p>
                        <div class="chart-container">
                            <canvas id="distribusiUsiaChart"></canvas>
                        </div>
                    </div>
                </div>
            </section>

            <!-- LATEST APPLICANTS TABLE -->
            <section id="table-section">
                <div class="mb-4">
                    <h2 class="text-xl font-bold text-slate-800">Pendaftar Terbaru</h2>
                    <p class="text-slate-500 text-sm">Daftar 10 pendaftar terakhir yang masuk ke sistem.</p>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-sm overflow-x-auto">
                    <table class="w-full text-sm text-left text-slate-500">
                        <thead class="text-xs text-slate-700 uppercase bg-slate-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">Nama Lengkap</th>
                                <th scope="col" class="px-6 py-3">Program Studi</th>
                                <th scope="col" class="px-6 py-3">Asal Sekolah</th>
                                <th scope="col" class="px-6 py-3">Tgl. Daftar</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                            </tr>
                        </thead>
                        <tbody id="pendaftarTableBody">
                            <!-- Rows will be injected by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </section>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // --- MOCK DATA ---
            // In a real application, this would come from an API call
            const mockData = generateMockData(85);

            // --- CHART INSTANCES ---
            let charts = {
                programStudi: null,
                lokalKuliah: null,
                trenPendaftaran: null,
                distribusiUsia: null,
            };

            // --- INITIALIZATION ---
            function init() {
                const filterElement = document.getElementById('programStudiFilter');
                filterElement.addEventListener('change', (e) => {
                    renderDashboard(e.target.value);
                });
                renderDashboard('Semua');
            }

            // --- RENDER FUNCTION ---
            function renderDashboard(programStudiFilter = 'Semua') {
                const filteredData = programStudiFilter === 'Semua' ?
                    mockData :
                    mockData.filter(p => p.program_studi === programStudiFilter);

                updateKPIs(filteredData);
                updateProgramStudiChart(filteredData);
                updateLokalKuliahChart(filteredData);
                updateTrenPendaftaranChart(filteredData);
                updateDistribusiUsiaChart(filteredData);
                updatePendaftarTable(filteredData);
            }

            // --- UPDATE FUNCTIONS ---

            function updateKPIs(data) {
                document.getElementById('totalPendaftar').textContent = data.length;
                document.getElementById('totalTerverifikasi').textContent = data.filter(p => p.status === 'Diverifikasi').length;
                document.getElementById('totalPending').textContent = data.filter(p => p.status === 'Pending').length;
                document.getElementById('totalDitolak').textContent = data.filter(p => p.status === 'Ditolak').length;
            }

            function updateProgramStudiChart(data) {
                const ctx = document.getElementById('programStudiChart').getContext('2d');
                const counts = data.reduce((acc, p) => {
                    acc[p.program_studi] = (acc[p.program_studi] || 0) + 1;
                    return acc;
                }, {});

                const labels = Object.keys(counts);
                const chartData = Object.values(counts);

                if (charts.programStudi) charts.programStudi.destroy();
                charts.programStudi = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Jumlah Pendaftar',
                            data: chartData,
                            backgroundColor: ['#3b82f6', '#10b981'],
                            borderColor: '#f8fafc',
                            borderWidth: 4,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        let label = context.label || '';
                                        if (label) {
                                            label += ': ';
                                        }
                                        if (context.parsed !== null) {
                                            const total = context.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                                            const percentage = total > 0 ? (context.parsed / total * 100).toFixed(1) : 0;
                                            label += `${context.raw} pendaftar (${percentage}%)`;
                                        }
                                        return label;
                                    }
                                }
                            }
                        }
                    }
                });
            }

            function updateLokalKuliahChart(data) {
                const ctx = document.getElementById('lokalKuliahChart').getContext('2d');
                const counts = data.reduce((acc, p) => {
                    acc[p.lokal_kuliah] = (acc[p.lokal_kuliah] || 0) + 1;
                    return acc;
                }, {});

                const labels = Object.keys(counts);
                const chartData = Object.values(counts);

                if (charts.lokalKuliah) charts.lokalKuliah.destroy();
                charts.lokalKuliah = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Jumlah Pendaftar',
                            data: chartData,
                            backgroundColor: ['#8b5cf6', '#f59e0b', '#ec4899'],
                            borderColor: '#f8fafc',
                            borderWidth: 4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });
            }

            function updateTrenPendaftaranChart(data) {
                const ctx = document.getElementById('trenPendaftaranChart').getContext('2d');
                const trendData = {};
                const today = new Date('2025-07-19T12:00:00.000Z');

                for (let i = 13; i >= 0; i--) {
                    const date = new Date(today);
                    date.setDate(today.getDate() - i);
                    const key = date.toISOString().split('T')[0];
                    trendData[key] = 0;
                }

                data.forEach(p => {
                    const tglDaftarKey = new Date(p.tgl_daftar).toISOString().split('T')[0];
                    if (trendData[tglDaftarKey] !== undefined) {
                        trendData[tglDaftarKey]++;
                    }
                });

                const labels = Object.keys(trendData).map(dateStr => new Date(dateStr).toLocaleDateString('id-ID', {
                    day: '2-digit',
                    month: 'short'
                }));
                const chartData = Object.values(trendData);

                if (charts.trenPendaftaran) charts.trenPendaftaran.destroy();
                charts.trenPendaftaran = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Pendaftar Baru',
                            data: chartData,
                            borderColor: '#3b82f6',
                            backgroundColor: 'rgba(59, 130, 246, 0.1)',
                            fill: true,
                            tension: 0.3,
                            pointBackgroundColor: '#3b82f6',
                            pointRadius: 4,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1
                                }
                            }
                        }
                    }
                });
            }

            function updateDistribusiUsiaChart(data) {
                const ctx = document.getElementById('distribusiUsiaChart').getContext('2d');
                const ageGroups = {
                    '17-18': 0,
                    '19-20': 0,
                    '21-22': 0,
                    '23-25': 0,
                    '26+': 0
                };

                const today = new Date('2025-07-19');
                data.forEach(p => {
                    const birthDate = new Date(p.tanggal_lahir);
                    let age = today.getFullYear() - birthDate.getFullYear();
                    const m = today.getMonth() - birthDate.getMonth();
                    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                        age--;
                    }

                    if (age >= 17 && age <= 18) ageGroups['17-18']++;
                    else if (age >= 19 && age <= 20) ageGroups['19-20']++;
                    else if (age >= 21 && age <= 22) ageGroups['21-22']++;
                    else if (age >= 23 && age <= 25) ageGroups['23-25']++;
                    else if (age >= 26) ageGroups['26+']++;
                });

                const labels = Object.keys(ageGroups);
                const chartData = Object.values(ageGroups);

                if (charts.distribusiUsia) charts.distribusiUsia.destroy();
                charts.distribusiUsia = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Jumlah Pendaftar',
                            data: chartData,
                            backgroundColor: '#8b5cf6',
                            borderRadius: 4,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }

            function updatePendaftarTable(data) {
                const tableBody = document.getElementById('pendaftarTableBody');
                tableBody.innerHTML = '';
                const recentData = data.sort((a, b) => new Date(b.tgl_daftar) - new Date(a.tgl_daftar)).slice(0, 10);

                if (recentData.length === 0) {
                    tableBody.innerHTML = `<tr><td colspan="5" class="text-center px-6 py-4 text-slate-500">Tidak ada data untuk ditampilkan.</td></tr>`;
                    return;
                }

                recentData.forEach(p => {
                    const statusClass = {
                        'Pending': 'bg-yellow-100 text-yellow-800',
                        'Diverifikasi': 'bg-green-100 text-green-800',
                        'Ditolak': 'bg-red-100 text-red-800'
                    } [p.status];

                    const row = `
                <tr class="bg-white border-b hover:bg-slate-50">
                    <th scope="row" class="px-6 py-4 font-medium text-slate-900 whitespace-nowrap">${p.nama_lengkap}</th>
                    <td class="px-6 py-4">${p.program_studi}</td>
                    <td class="px-6 py-4">${p.sekolah_asal}</td>
                    <td class="px-6 py-4">${new Date(p.tgl_daftar).toLocaleDateString('id-ID')}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 font-semibold leading-tight text-xs rounded-full ${statusClass}">
                            ${p.status}
                        </span>
                    </td>
                </tr>
            `;
                    tableBody.innerHTML += row;
                });
            }

            // --- MOCK DATA GENERATOR ---
            function generateMockData(count) {
                const data = [];
                const firstNames = ['Budi', 'Ani', 'Eko', 'Siti', 'Joko', 'Dewi', 'Putu', 'Made', 'Agus', 'Rina', 'Ahmad', 'Rizki', 'Indah', 'Yusuf', 'Nurul'];
                const lastNames = ['Santoso', 'Wijaya', 'Susanto', 'Halim', 'Pratama', 'Lestari', 'Nugroho', 'Wahyuni', 'Kusuma', 'Setiawan'];
                const schools = ['SMA Negeri 1 Jakarta', 'SMA Negeri 3 Bandung', 'SMA Taruna Nusantara', 'SMAK 1 Penabur', 'MAN 2 Model Medan', 'SMAN 8 Yogyakarta'];
                const prodi = ['S1 Ilmu Administrasi Negara', 'D3 Administrasi Perkantoran'];
                const lokal = ['Reguler', 'Eksekutif', 'Transfer/Pindahan'];
                const statuses = ['Pending', 'Diverifikasi', 'Ditolak'];
                const today = new Date('2025-07-19T12:00:00.000Z');

                for (let i = 0; i < count; i++) {
                    const tglDaftar = new Date(today);
                    tglDaftar.setDate(today.getDate() - Math.floor(Math.random() * 30));

                    const birthYear = 2025 - (17 + Math.floor(Math.random() * 10)); // Usia 17-26
                    const birthMonth = Math.floor(Math.random() * 12);
                    const birthDay = Math.floor(Math.random() * 28) + 1;

                    data.push({
                        nama_lengkap: `${firstNames[Math.floor(Math.random() * firstNames.length)]} ${lastNames[Math.floor(Math.random() * lastNames.length)]}`,
                        sekolah_asal: schools[Math.floor(Math.random() * schools.length)],
                        program_studi: prodi[Math.floor(Math.random() * prodi.length)],
                        lokal_kuliah: lokal[Math.floor(Math.random() * lokal.length)],
                        status: statuses[Math.floor(Math.random() * statuses.length)],
                        tgl_daftar: tglDaftar.toISOString(),
                        tanggal_lahir: new Date(birthYear, birthMonth, birthDay).toISOString()
                    });
                }
                return data;
            }

            // --- START THE APP ---
            init();
        });
    </script>

</body>

</html>