<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STIA-NUSA | Portal Penerimaan Mahasiswa Baru</title>
    <meta name="description" content="Selamat datang di Portal Resmi PMB STIA-NUSA Sungai Penuh. Daftarkan diri Anda sekarang.">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    <!-- Fonts: Plus Jakarta Sans & Sora -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Sora:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (CDN for easy deployment on Hostinger) -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                        display: ['Sora', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#f0f7ff',
                            100: '#e0effe',
                            200: '#badffd',
                            300: '#7cc2fc',
                            400: '#38a3f8',
                            500: '#0e87e9',
                            600: '#026bc7',
                            700: '#0356a1',
                            800: '#074885',
                            900: '#0c4a6e', // Deep Academic Navy
                        },
                        accent: '#F59E0B', // Amber Gold
                    }
                }
            }
        }
    </script>

    <style>
        .glass-nav {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        .dark .glass-nav {
            background: rgba(15, 23, 42, 0.9);
        }
        .hero-pattern {
            background-image: radial-gradient(#0c4a6e 0.5px, transparent 0.5px);
            background-size: 24px 24px;
            opacity: 0.1;
        }
        .img-mask {
            border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
            animation: morph 8s ease-in-out infinite;
        }
        @keyframes morph {
            0% { border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; }
            50% { border-radius: 30% 60% 70% 40% / 50% 60% 30% 60%; }
            100% { border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; }
        }
        .gradient-border {
            border: 2px solid;
            border-image: linear-gradient(to right, #0c4a6e, #F59E0B) 1;
        }
    </style>
</head>

<body class="bg-white dark:bg-slate-900 font-sans antialiased text-slate-900 dark:text-slate-100 transition-colors duration-300">

    <div x-data="{ mobileMenu: false, dark: false }" class="min-h-screen flex flex-col relative">
        
        <!-- Navigation -->
        <header class="fixed inset-x-0 top-0 z-50 glass-nav border-b border-slate-200/50 dark:border-slate-700/50">
            <nav class="flex items-center justify-between p-4 lg:px-12 max-w-7xl mx-auto" aria-label="Global">
                <div class="flex lg:flex-1">
                    <a href="#" class="flex items-center gap-3">
                        <img class="h-12 w-auto" src="{{ asset('storage/poto/LOGOSTIA.png') }}" alt="STIA-NUSA Logo" onerror="this.src='https://placehold.co/100x100?text=LOGO'">
                        <div class="flex flex-col">
                            <span class="text-lg font-extrabold leading-none tracking-tight text-brand-900 dark:text-white uppercase">STIA-NUSA</span>
                            <span class="text-[10px] font-bold text-brand-600 tracking-[0.2em] uppercase mt-1">Sungai Penuh</span>
                        </div>
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden lg:flex lg:gap-x-12">
                    <a href="#" class="text-sm font-bold tracking-wide text-brand-900 dark:text-white hover:text-brand-600 transition-colors">BERANDA</a>
                    <a href="/pendaftaran" class="text-sm font-bold tracking-wide text-slate-600 dark:text-slate-300 hover:text-brand-600 transition-colors">PENDAFTARAN</a>
                    <a href="https://siakad.stianusa.ac.id/" class="text-sm font-bold tracking-wide text-slate-600 dark:text-slate-300 hover:text-brand-600 transition-colors uppercase">Siakad</a>
                </div>

                <div class="hidden lg:flex lg:flex-1 lg:justify-end items-center gap-6">
                    <button id="theme-toggle" class="p-2 text-slate-500 hover:text-brand-600 transition-all">
                        <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                        <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 100 2h1z"></path></svg>
                    </button>
                    <a href="/login" class="px-6 py-2.5 rounded-full bg-brand-900 dark:bg-brand-600 text-white text-sm font-bold hover:shadow-lg hover:shadow-brand-900/20 hover:scale-105 transition-all">LOGIN PORTAL</a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="flex lg:hidden">
                    <button @click="mobileMenu = true" type="button" class="p-2 text-slate-700 dark:text-slate-200">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                    </button>
                </div>
            </nav>

            <!-- Mobile Menu Overlay -->
            <div x-show="mobileMenu" x-transition.opacity class="fixed inset-0 z-[60] bg-slate-900/60 backdrop-blur-sm"></div>
            <div x-show="mobileMenu" @click.away="mobileMenu = false" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0" class="fixed inset-y-0 right-0 z-[70] w-full max-w-sm bg-white dark:bg-slate-900 p-6 shadow-2xl">
                <div class="flex items-center justify-between mb-10">
                    <img class="h-10" src="{{ asset('storage/poto/LOGOSTIA.png') }}" alt="" onerror="this.src='https://placehold.co/100x100?text=LOGO'">
                    <button @click="mobileMenu = false" class="p-2 text-slate-500"><svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M6 18L18 6M6 6l12 12" /></svg></button>
                </div>
                <div class="flex flex-col gap-6 text-2xl font-bold tracking-tight">
                    <a @click="mobileMenu = false" href="#" class="hover:text-brand-600">BERANDA</a>
                    <a @click="mobileMenu = false" href="/pendaftaran" class="hover:text-brand-600">PENDAFTARAN</a>
                    <a @click="mobileMenu = false" href="https://siakad.stianusa.ac.id/" class="hover:text-brand-600">SIAKAD</a>
                    <div class="pt-6 border-t dark:border-slate-800">
                        <a @click="mobileMenu = false" href="/login" class="text-brand-600">MASUK PORTAL →</a>
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-grow flex flex-col pt-20 lg:pt-0">
            <!-- Hero Section -->
            <section class="relative min-h-[90vh] flex items-center px-6 lg:px-12 overflow-hidden">
                <div class="absolute inset-0 hero-pattern -z-10"></div>
                
                <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center w-full">
                    
                    <!-- Left: Content -->
                    <div class="animate__animated animate__fadeInUp">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-lg bg-brand-50 dark:bg-brand-900/30 text-brand-700 dark:text-brand-300 text-[10px] font-black tracking-widest uppercase mb-8">
                            <span class="w-2 h-2 rounded-full bg-brand-600 animate-pulse"></span>
                            TAHUN AKADEMIK {{ date('Y') }}/{{ date('Y') + 1 }}
                        </div>
                        
                        <h1 class="font-display text-5xl lg:text-7xl font-extrabold text-slate-900 dark:text-white leading-[1.05] mb-8">
                            Raih Masa <br> Depan Di <br> <span class="text-brand-600 underline decoration-accent/40 underline-offset-8">STIA-NUSA.</span>
                        </h1>
                        
                        <p class="text-lg lg:text-xl text-slate-600 dark:text-slate-400 mb-10 leading-relaxed max-w-lg">
                            Pusat unggulan pendidikan administrasi yang membentuk pemimpin berintegritas dan profesional. Daftarkan diri Anda dan jadilah bagian dari perubahan.
                        </p>

                        <div class="flex flex-col sm:flex-row gap-5">
                            <a href="/pendaftaran" class="px-10 py-4 bg-brand-900 dark:bg-brand-600 text-white font-extrabold rounded-2xl shadow-2xl shadow-brand-900/30 hover:-translate-y-1 hover:shadow-brand-900/50 transition-all text-center">
                                Daftar Sekarang
                            </a>
                            <a href="/login" class="px-10 py-4 bg-white dark:bg-slate-800 border-2 border-slate-200 dark:border-slate-700 text-slate-800 dark:text-white font-extrabold rounded-2xl hover:bg-slate-50 dark:hover:bg-slate-700 transition-all text-center">
                                Login Dashboard
                            </a>
                        </div>

                        <!-- Stats Badge -->
                        <div class="mt-12 pt-8 border-t border-slate-200 dark:border-slate-800 flex items-center gap-8">
                            <div class="flex flex-col">
                                <span class="text-2xl font-black text-brand-900 dark:text-white">A</span>
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Akreditasi</span>
                            </div>
                            <div class="w-px h-10 bg-slate-200 dark:bg-slate-800"></div>
                            <div class="flex flex-col">
                                <span class="text-2xl font-black text-brand-900 dark:text-white">500+</span>
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Pendaftar</span>
                            </div>
                            <div class="w-px h-10 bg-slate-200 dark:bg-slate-800"></div>
                            <div class="flex flex-col">
                                <span class="text-2xl font-black text-brand-900 dark:text-white">95%</span>
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Lulusan Kerja</span>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Aesthetic Image -->
                    <div class="relative animate__animated animate__fadeInRight animate__delay-1s flex justify-center lg:justify-end">
                        <!-- Decorations -->
                        <div class="absolute -top-10 -right-10 w-32 h-32 bg-accent opacity-10 rounded-full blur-3xl animate-pulse"></div>
                        <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-brand-500 opacity-10 rounded-full blur-3xl"></div>

                        <!-- Main Image -->
                        <div class="relative z-10 w-full max-w-md aspect-[4/5] img-mask bg-slate-200 dark:bg-slate-800 shadow-2xl overflow-hidden group">
                            <!-- Professional Academic Image -->
                            <img src="https://images.unsplash.com/photo-1523050853021-eb651c003453?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                                 alt="Kampus STIA-NUSA" 
                                 class="w-full h-full object-cover transition-transform duration-[2s] group-hover:scale-110">
                            
                            <!-- Overlay Info -->
                            <div class="absolute inset-x-0 bottom-0 p-8 bg-gradient-to-t from-black/80 to-transparent text-white translate-y-4 group-hover:translate-y-0 transition-transform">
                                <p class="text-xs font-bold uppercase tracking-[0.3em] text-accent mb-2">Unggul & Terpercaya</p>
                                <h4 class="text-xl font-bold italic">"Kualitas Pendidikan Adalah Prioritas Kami"</h4>
                            </div>
                        </div>

                        <!-- Floating Card -->
                        <div class="absolute -bottom-6 -right-6 lg:-right-10 bg-white dark:bg-slate-800 p-5 rounded-3xl shadow-2xl border border-slate-100 dark:border-slate-700 z-20 animate__animated animate__fadeInUp animate__delay-2s">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-2xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Sistem</p>
                                    <p class="text-sm font-black dark:text-white">Terverifikasi Online</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <!-- Footer -->
        <footer class="bg-brand-900 dark:bg-slate-950 text-white py-16 px-6 lg:px-12 mt-auto">
            <div class="max-w-7xl mx-auto">
                <div class="flex flex-col md:flex-row justify-between items-center gap-10">
                    <div class="flex items-center gap-4">
                        <img class="h-10 brightness-0 invert" src="{{ asset('storage/poto/LOGOSTIA.png') }}" alt="" onerror="this.src='https://placehold.co/100x100?text=LOGO'">
                        <div class="flex flex-col">
                            <span class="text-xl font-black">STIA-NUSA</span>
                            <span class="text-[10px] text-brand-300 font-bold uppercase tracking-widest">Sungai Penuh - Jambi</span>
                        </div>
                    </div>
                    
                    <div class="flex gap-8 text-xs font-black uppercase tracking-widest text-brand-300">
                        <a href="#" class="hover:text-white transition-colors">Facebook</a>
                        <a href="#" class="hover:text-white transition-colors">Instagram</a>
                        <a href="#" class="hover:text-white transition-colors">Twitter</a>
                    </div>
                </div>
                
                <div class="mt-12 pt-8 border-t border-brand-800 flex flex-col md:flex-row justify-between items-center gap-4 text-[10px] font-bold text-brand-400 uppercase tracking-[0.2em]">
                    <p>&copy; {{ date('Y') }} STIA-NUSA Sungai Penuh. Hak Cipta Dilindungi.</p>
                    <p>Designed for Excellence</p>
                </div>
            </div>
        </footer>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Dark Mode Script
            const themeToggle = document.getElementById('theme-toggle');
            const darkIcon = document.getElementById('theme-toggle-dark-icon');
            const lightIcon = document.getElementById('theme-toggle-light-icon');

            if (localStorage.getItem('color-theme') === 'dark' || (!localStorage.getItem('color-theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
                lightIcon.classList.remove('hidden');
            } else {
                document.documentElement.classList.remove('dark');
                darkIcon.classList.remove('hidden');
            }

            themeToggle.addEventListener('click', function() {
                darkIcon.classList.toggle('hidden');
                lightIcon.classList.toggle('hidden');
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                }
            });
        });
    </script>
</body>

</html>