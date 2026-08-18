<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - Kos Lalan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- FONT KOMIK DARI GOOGLE -->
    <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Comic+Neue:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        /* Pengaturan Font Dasar */
        body { font-family: 'Comic Neue', cursive; font-weight: 700; }
        .font-komik { font-family: 'Bangers', cursive; letter-spacing: 2px; }
        
        /* Background Titik-Titik Ala Kertas Komik (Halftone) */
        .bg-halftone {
            background-color: #f8fafc;
            background-image: radial-gradient(#94a3b8 2px, transparent 2px);
            background-size: 24px 24px;
        }

        /* Animasi Pop-up Komik */
        .animate-pop { animation: popIn 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards; opacity: 0; transform: scale(0.8); }
        @keyframes popIn { to { opacity: 1; transform: scale(1); } }
        
        .delay-100 { animation-delay: 100ms; }
        .delay-200 { animation-delay: 200ms; }
        .delay-300 { animation-delay: 300ms; }
        .delay-400 { animation-delay: 400ms; }
        
        /* Efek Hover Kartu Komik */
        .comic-card { transition: all 0.2s ease-in-out; }
        .comic-card:hover { transform: translate(-4px, -4px); box-shadow: 12px 12px 0px 0px rgba(0,0,0,1); }
        .comic-card-sm:hover { transform: translate(-2px, -2px); box-shadow: 6px 6px 0px 0px rgba(0,0,0,1); }

        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #fff; border-left: 2px solid #000; }
        ::-webkit-scrollbar-thumb { background: #000; border-radius: 0px; }
    </style>
</head>
<body class="bg-halftone text-black antialiased overflow-hidden selection:bg-yellow-300 selection:text-black">
    
    <div class="flex h-screen w-full">
        
        <!-- ========================================== -->
        <!-- SIDEBAR ADMIN (COMIC STYLE) -->
        <!-- ========================================== -->
        <aside class="w-64 bg-white flex flex-col transition-all duration-300 z-30 hidden md:flex border-r-4 border-black shadow-[8px_0_0_0_rgba(0,0,0,1)]">
            
            <!-- Logo Sidebar -->
            <div class="h-20 flex items-center justify-center px-6 border-b-4 border-black bg-red-500 relative overflow-hidden">
                <div class="absolute inset-0 opacity-20 pointer-events-none" style="background-image: repeating-linear-gradient(45deg, #000 0, #000 2px, transparent 2px, transparent 8px);"></div>
                <div class="text-center transform rotate-2 hover:rotate-0 transition-transform cursor-pointer relative z-10">
                    <h1 class="font-komik text-3xl text-white drop-shadow-[2px_2px_0_#000]">KOSAN LALAN</h1>
                    <span class="bg-yellow-300 text-black text-[10px] px-2 py-1 font-bold uppercase tracking-widest border-2 border-black rounded-full">Markas Admin</span>
                </div>
            </div>

            <!-- Navigasi Menu -->
            <nav class="flex-1 px-4 py-6 space-y-3 overflow-y-auto bg-white">
                
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.dashboard') ? 'bg-cyan-400 border-black translate-x-1 shadow-[4px_4px_0_0_rgba(0,0,0,1)]' : 'bg-white border-transparent hover:bg-yellow-200 hover:border-black hover:translate-x-1 hover:shadow-[4px_4px_0_0_rgba(0,0,0,1)]' }} border-2 rounded-xl transition-all group text-black">
                    <svg class="w-6 h-6 mr-3 group-hover:scale-125 transition-transform origin-bottom-left" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    <span class="text-lg font-bold">Dashboard</span>
                </a>
                
                <a href="{{ route('admin.kamar.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.kamar.*') ? 'bg-cyan-400 border-black translate-x-1 shadow-[4px_4px_0_0_rgba(0,0,0,1)]' : 'bg-white border-transparent hover:bg-yellow-200 hover:border-black hover:translate-x-1 hover:shadow-[4px_4px_0_0_rgba(0,0,0,1)]' }} border-2 rounded-xl transition-all group text-black">
                    <svg class="w-6 h-6 mr-3 group-hover:scale-125 transition-transform origin-bottom-left" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    <span class="text-lg font-bold">Manajemen Kamar</span>
                </a>
                
                <a href="{{ route('admin.penghuni.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.penghuni.*') ? 'bg-cyan-400 border-black translate-x-1 shadow-[4px_4px_0_0_rgba(0,0,0,1)]' : 'bg-white border-transparent hover:bg-yellow-200 hover:border-black hover:translate-x-1 hover:shadow-[4px_4px_0_0_rgba(0,0,0,1)]' }} border-2 rounded-xl transition-all group text-black">
                    <svg class="w-6 h-6 mr-3 group-hover:scale-125 transition-transform origin-bottom-left" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    <span class="text-lg font-bold">Data Penghuni</span>
                </a>
                
                <a href="{{ route('admin.tagihan.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.tagihan.*') ? 'bg-cyan-400 border-black translate-x-1 shadow-[4px_4px_0_0_rgba(0,0,0,1)]' : 'bg-white border-transparent hover:bg-yellow-200 hover:border-black hover:translate-x-1 hover:shadow-[4px_4px_0_0_rgba(0,0,0,1)]' }} border-2 rounded-xl transition-all group text-black">
                    <svg class="w-6 h-6 mr-3 group-hover:scale-125 transition-transform origin-bottom-left" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    <span class="text-lg font-bold">Tagihan & Kas</span>
                </a>

                <a href="{{ route('admin.pengaduan.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.pengaduan.*') ? 'bg-cyan-400 border-black translate-x-1 shadow-[4px_4px_0_0_rgba(0,0,0,1)]' : 'bg-white border-transparent hover:bg-yellow-200 hover:border-black hover:translate-x-1 hover:shadow-[4px_4px_0_0_rgba(0,0,0,1)]' }} border-2 rounded-xl transition-all group text-black">
                    <svg class="w-6 h-6 mr-3 group-hover:scale-125 transition-transform origin-bottom-left" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                    <span class="text-lg font-bold">Laporan Keluhan</span>
                </a>

                <a href="{{ route('admin.akun.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.akun.*') ? 'bg-cyan-400 border-black translate-x-1 shadow-[4px_4px_0_0_rgba(0,0,0,1)]' : 'bg-white border-transparent hover:bg-yellow-200 hover:border-black hover:translate-x-1 hover:shadow-[4px_4px_0_0_rgba(0,0,0,1)]' }} border-2 rounded-xl transition-all group text-black">
                    <svg class="w-6 h-6 mr-3 group-hover:scale-125 transition-transform origin-bottom-left" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8V7a4 4 0 00-8 0v4h8z"></path></svg>
                    <span class="text-lg font-bold">Kelola Akun</span>
                </a>
            </nav>
        </aside>

        <!-- ========================================== -->
        <!-- KONTEN UTAMA -->
        <!-- ========================================== -->
        <main class="flex-1 flex flex-col h-screen relative z-10">
            
            <!-- Header (Top Bar) -->
            <header class="h-20 bg-white border-b-4 border-black flex items-center justify-between px-8 z-30 shadow-[0_4px_0_0_rgba(0,0,0,1)] relative">
                <h2 class="text-2xl font-komik text-black tracking-widest drop-shadow-[1px_1px_0_#fff] mt-1">MARKAS UNTUK ADMIN!</h2>
                
                <!-- PROFIL DROPDOWN -->
                <div class="relative">
                    <button type="button" onclick="toggleDropdown()" id="profilButton" class="flex items-center gap-3 bg-yellow-300 border-2 border-black py-2 px-5 rounded-full shadow-[2px_2px_0_0_rgba(0,0,0,1)] hover:-translate-y-1 hover:shadow-[4px_4px_0_0_rgba(0,0,0,1)] transition-all focus:outline-none">
                        @if(Auth::user()->foto_profil)
                            <img src="{{ asset('storage/profil/' . Auth::user()->foto_profil) }}" alt="Profil" class="w-8 h-8 rounded-full object-cover border-2 border-black shrink-0 bg-white">
                        @else
                            <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center border-2 border-black shrink-0">
                                <span class="text-base font-komik text-black">{{ substr(Auth::user()->name ?? 'P', 0, 1) }}</span>
                            </div>
                        @endif
                        <span class="text-base font-bold text-black uppercase">{{ Auth::user()->name ?? 'Pak Lalan' }}</span>
                    </button>

                    <!-- ISI DROPDOWN -->
                    <div id="profilDropdown" class="absolute right-0 mt-3 w-56 bg-white rounded-2xl shadow-[6px_6px_0_0_rgba(0,0,0,1)] border-4 border-black overflow-hidden hidden opacity-0 transition-all duration-200 transform origin-top-right scale-95 z-50">
                        <div class="p-4 border-b-4 border-black bg-cyan-200">
                            <p class="text-[10px] font-bold uppercase tracking-wider text-black mb-0.5">Masuk sebagai</p>
                            <p class="text-base font-komik text-black truncate tracking-wide">{{ Auth::user()->username ?? 'admin_lalan' }}</p>
                        </div>
                        
                        <div class="py-2 bg-white">
                            <a href="{{ route('admin.profil.index') }}" class="flex items-center px-4 py-2 text-base font-bold text-black hover:bg-yellow-200 transition-colors group">
                                <span class="w-2 h-2 rounded-full bg-black mr-2 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                                Pengaturan Profil
                            </a>
                        </div>
                        
                        <div class="border-t-4 border-black bg-red-500">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full flex items-center justify-center px-4 py-3 text-sm font-komik tracking-widest text-white hover:bg-red-600 transition-colors">
                                    KELUAR! (LOGOUT)
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <div class="flex-1 overflow-y-auto p-6 lg:p-10 scroll-smooth relative pb-20">
                
                <!-- BARIS 1: KARTU STATISTIK (COMIC BRUTAL) -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    
                    <!-- Kartu 1: Total Kamar -->
                    <div class="bg-white rounded-3xl p-6 border-4 border-black shadow-[8px_8px_0_0_rgba(0,0,0,1)] animate-pop flex items-center justify-between comic-card relative">
                        <div class="absolute -top-3 -right-3 w-10 h-10 bg-yellow-400 border-2 border-black rounded-full flex items-center justify-center font-komik text-black transform rotate-12 shadow-[2px_2px_0_0_rgba(0,0,0,1)]">1</div>
                        <div>
                            <p class="text-sm font-bold text-slate-500 uppercase tracking-widest mb-1 border-b-2 border-black inline-block pb-1">TOTAL KAMAR</p>
                            <h3 class="counter text-5xl font-komik text-black tracking-widest mt-2" data-target="{{ $totalKamar }}">0</h3>
                        </div>
                        <div class="w-16 h-16 rounded-full bg-cyan-300 border-4 border-black flex items-center justify-center transform -rotate-6">
                            <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                    </div>

                    <!-- Kartu 2: Terisi -->
                    <div class="bg-cyan-400 rounded-3xl p-6 border-4 border-black shadow-[8px_8px_0_0_rgba(0,0,0,1)] animate-pop delay-100 flex items-center justify-between comic-card relative overflow-hidden">
                        <div class="absolute inset-0 opacity-20 pointer-events-none" style="background-image: repeating-linear-gradient(45deg, #000 0, #000 2px, transparent 2px, transparent 8px);"></div>
                        <div class="relative z-10">
                            <p class="text-sm font-bold text-black uppercase tracking-widest mb-1 border-b-2 border-black inline-block pb-1">KAMAR TERISI</p>
                            <h3 class="counter text-5xl font-komik text-white drop-shadow-[2px_2px_0_#000] tracking-widest mt-2" data-target="{{ $kamarTerisi }}">0</h3>
                        </div>
                        <div class="relative z-10 w-16 h-16 rounded-full bg-white border-4 border-black flex items-center justify-center transform rotate-6">
                            <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>

                    <!-- Kartu 3: Kosong -->
                    <div class="bg-yellow-300 rounded-3xl p-6 border-4 border-black shadow-[8px_8px_0_0_rgba(0,0,0,1)] animate-pop delay-200 flex items-center justify-between comic-card relative">
                        <div>
                            <p class="text-sm font-bold text-black uppercase tracking-widest mb-1 border-b-2 border-black inline-block pb-1">KAMAR KOSONG</p>
                            <h4 class="counter text-5xl font-komik text-red-500 drop-shadow-[2px_2px_0_#000] tracking-widest mt-2" data-target="{{ $kamarKosong }}">0</h4>
                        </div>
                        <div class="w-16 h-16 rounded-full bg-white border-4 border-black flex items-center justify-center transform -rotate-12 animate-pulse">
                            <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
                        </div>
                    </div>

                </div>

                <!-- BARIS 2: GRAFIK & AKTIVITAS -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
                    
                    <!-- Grafik Okupansi -->
                    <div class="bg-white rounded-3xl p-8 border-4 border-black shadow-[8px_8px_0_0_rgba(0,0,0,1)] col-span-1 flex flex-col items-center animate-pop delay-300 comic-card relative">
                        <div class="absolute -top-4 -left-4 w-12 h-12 bg-red-500 border-4 border-black rounded-full flex items-center justify-center font-komik text-white text-xl transform -rotate-12 shadow-[4px_4px_0_0_rgba(0,0,0,1)] z-20">CHART</div>
                        <h3 class="text-2xl font-komik text-black mb-6 w-full text-center tracking-widest border-b-4 border-dashed border-black pb-4">INFO KAMAR 📊</h3>
                        
                        <div class="relative w-full max-w-[220px] aspect-square">
                            <!-- CHART.JS CANVAS -->
                            <canvas id="okupansiChart"></canvas>
                            
                            <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                                <span class="text-4xl font-komik text-black drop-shadow-[2px_2px_0_#fff] mt-2">
                                    <span class="counter" data-target="{{ $totalKamar > 0 ? round(($kamarTerisi / $totalKamar) * 100) : 0 }}">0</span>%
                                </span>
                                <span class="text-sm font-bold text-slate-500 uppercase bg-white border-2 border-black px-2 rounded transform rotate-2">TERISI</span>
                            </div>
                        </div>
                    </div>

                    <!-- Tabel Penghuni Terbaru -->
                    <div class="bg-white rounded-3xl p-0 border-4 border-black shadow-[8px_8px_0_0_rgba(0,0,0,1)] col-span-1 lg:col-span-2 flex flex-col animate-pop delay-400 overflow-hidden comic-card">
                        
                        <div class="flex justify-between items-center p-6 bg-yellow-300 border-b-4 border-black">
                            <h3 class="text-2xl font-komik text-black tracking-widest drop-shadow-[1px_1px_0_#fff]">PENGHUNI BARU 👨‍👩‍👧‍👦</h3>
                            <a href="{{ route('admin.penghuni.index') }}" class="bg-white border-2 border-black px-4 py-1.5 rounded-xl font-bold text-black hover:bg-cyan-300 hover:-translate-y-1 shadow-[2px_2px_0_0_rgba(0,0,0,1)] transition-all text-sm transform rotate-1">Lihat Semua!</a>
                        </div>
                        
                        <div class="overflow-x-auto bg-white p-4">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="border-b-4 border-black">
                                        <th class="pb-3 pt-2 px-2 text-lg font-komik text-slate-500 uppercase tracking-wider">Nama</th>
                                        <th class="pb-3 pt-2 px-2 text-lg font-komik text-slate-500 uppercase tracking-wider">Kamar</th>
                                        <th class="pb-3 pt-2 px-2 text-lg font-komik text-slate-500 uppercase tracking-wider">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y-4 divide-black">
                                    @forelse($penghunisTerbaru as $p)
                                    <tr class="hover:bg-cyan-50 transition-colors group">
                                        <td class="py-4 px-2">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 rounded-full bg-white border-2 border-black flex items-center justify-center text-sm font-komik text-black shadow-[2px_2px_0_0_rgba(0,0,0,1)] group-hover:scale-110 group-hover:bg-yellow-300 transition-all">
                                                    {{ strtoupper(substr($p->nama, 0, 2)) }}
                                                </div>
                                                <span class="text-base font-bold text-black uppercase">{{ $p->nama }}</span>
                                            </div>
                                        </td>
                                        <td class="py-4 px-2">
                                            <span class="text-base font-komik text-cyan-600 text-xl">{{ $p->kamar ? $p->kamar->nomor_kamar : 'Kosong' }}</span>
                                        </td>
                                        <td class="py-4 px-2">
                                            @if($p->status == 'Aktif')
                                                <span class="inline-block px-3 py-1 rounded bg-green-400 text-black font-bold border-2 border-black shadow-[2px_2px_0_0_rgba(0,0,0,1)] text-xs uppercase transform -rotate-2">Aktif ✅</span>
                                            @else
                                                <span class="inline-block px-3 py-1 rounded bg-white text-black font-bold border-2 border-black shadow-[2px_2px_0_0_rgba(0,0,0,1)] text-xs uppercase transform rotate-2">Keluar 🏃‍♂️</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="py-10 text-center text-lg font-bold text-slate-400 uppercase">Belum ada penghuni, kosan masih sepi! 👻</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

                <!-- BARIS 3: KEUANGAN & KOMPLAIN TIKET -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    <!-- KARTU KEUANGAN (BRANKAS KOMIK) -->
                    <div class="bg-green-400 rounded-3xl p-8 border-4 border-black shadow-[8px_8px_0_0_rgba(0,0,0,1)] col-span-1 flex flex-col justify-between relative overflow-hidden animate-pop delay-400 comic-card">
                        
                        <!-- Pattern Mata Uang -->
                        <div class="absolute inset-0 opacity-20 font-komik text-4xl leading-loose pointer-events-none break-words overflow-hidden text-black" style="line-height: 1;">
                            $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
                        </div>
                        
                        <div class="relative z-10">
                            <div class="flex justify-between items-center mb-6">
                                <h3 class="text-2xl font-komik text-black bg-white px-3 py-1 border-4 border-black rounded-lg transform -rotate-3 shadow-[2px_2px_0_0_rgba(0,0,0,1)]">BRANKAS DUIT 💰</h3>
                                <button id="btn-toggle-saldo" class="bg-white border-2 border-black text-black hover:bg-yellow-300 p-2 rounded-xl transition-all shadow-[2px_2px_0_0_rgba(0,0,0,1)] hover:-translate-y-1">
                                    <!-- Eye Closed -->
                                    <svg id="icon-eye-closed" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>
                                    <!-- Eye Open -->
                                    <svg id="icon-eye-open" class="w-6 h-6 hidden" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </button>
                            </div>
                            
                            <p class="text-sm font-bold text-black uppercase mb-2 bg-white inline-block px-2 border-2 border-black">Bulan {{ $bulanIni }}</p>
                            
                            <div class="h-16 flex items-center">
                                <h2 id="saldo-text" class="text-4xl font-komik text-white drop-shadow-[2px_2px_0_#000] tracking-widest transition-opacity duration-300">Rp &bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;</h2>
                            </div>
                        </div>

                        <div class="mt-8 relative z-10 flex justify-end">
                            <a href="{{ route('admin.tagihan.index') }}" class="bg-black text-white font-komik text-xl px-5 py-2 rounded-xl hover:bg-slate-800 transition-colors transform rotate-2">BONGKAR KAS &rarr;</a>
                        </div>
                    </div>

                    <!-- KARTU KOMPLAIN TIKET (COMIC) -->
                    <div class="bg-white rounded-3xl p-8 border-4 border-black shadow-[8px_8px_0_0_rgba(0,0,0,1)] col-span-1 lg:col-span-2 flex flex-col animate-pop delay-400 comic-card">
                        <div class="flex justify-between items-center mb-6 border-b-4 border-black pb-4 border-dashed">
                            <h3 class="text-2xl font-komik text-black tracking-widest uppercase">LAPORAN BOCOR! 🚨</h3>
                            <a href="{{ route('admin.pengaduan.index') }}" class="bg-yellow-300 border-2 border-black px-4 py-2 rounded-xl font-bold text-black hover:bg-yellow-400 shadow-[2px_2px_0_0_rgba(0,0,0,1)] hover:-translate-y-1 transition-all text-xs uppercase transform -rotate-2">Kelola Semua</a>
                        </div>
                        
                        <div class="space-y-4">
                            @forelse($pengaduanTerbaru as $pengaduan)
                                <!-- KOTAK ITEM PENGADUAN -->
                                <div class="flex items-start gap-4 p-4 rounded-2xl border-4 border-black bg-white shadow-[4px_4px_0_0_rgba(0,0,0,1)] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_rgba(0,0,0,1)] transition-all cursor-pointer comic-card-sm">
                                    
                                    <!-- Ikon -->
                                    <div class="w-12 h-12 rounded-full bg-red-400 text-white flex items-center justify-center border-2 border-black shrink-0 font-komik text-xl transform rotate-6">
                                        ?!
                                    </div>
                                    
                                    <!-- Konten Teks -->
                                    <div class="flex-1">
                                        <div class="flex justify-between items-start mb-1">
                                            <h4 class="text-lg font-bold text-black uppercase">{{ $pengaduan->judul ?? 'Keluhan Baru' }}</h4>
                                            <span class="bg-slate-100 border border-black px-2 py-0.5 rounded text-[10px] font-bold text-black">{{ $pengaduan->created_at->diffForHumans() }}</span>
                                        </div>
                                        <p class="text-sm text-slate-600 mb-2 line-clamp-1 font-bold">{{ $pengaduan->deskripsi ?? 'Detail keluhan tidak tersedia.' }}</p>
                                        
                                        <span class="inline-block px-2.5 py-1 rounded bg-cyan-300 text-black font-bold border-2 border-black text-[10px] uppercase shadow-[2px_2px_0_0_rgba(0,0,0,1)]">{{ $pengaduan->status ?? 'Menunggu Teknisi' }}</span>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-6 bg-cyan-50 rounded-2xl border-4 border-black border-dashed">
                                    <p class="text-lg font-komik text-slate-500 tracking-widest">ALHAMDULILAH GAK ADA KOMPLAIN! 🎉</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                </div>

            </div>
        </main>
    </div>

    <!-- SCRIPT GRAFIK, COUNTER, SENSOR SALDO & DROPDOWN -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            // 1. ANIMASI ANGKA NAIK (COUNTER)
            const counters = document.querySelectorAll('.counter');
            setTimeout(() => {
                counters.forEach(counter => {
                    const updateCount = () => {
                        const target = +counter.getAttribute('data-target');
                        const count = +counter.innerText;
                        const inc = target / 20;

                        if (count < target) {
                            counter.innerText = Math.ceil(count + inc);
                            setTimeout(updateCount, 40); 
                        } else {
                            counter.innerText = target; 
                        }
                    };
                    updateCount();
                });
            }, 600); 

            // 2. GRAFIK CHART.JS (DIUBAH TEMA KOMIK)
            const ctx = document.getElementById('okupansiChart').getContext('2d');
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Kamar Terisi', 'Kamar Kosong'],
                    datasets: [{
                        data: [{{ $kamarTerisi }}, {{ $kamarKosong }}], 
                        backgroundColor: ['#22d3ee', '#f8fafc'], // Cyan & White
                        borderColor: '#000000', // BORDER HITAM KOMIK
                        borderWidth: 3, // TEBAL BORDER KOMIK
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    cutout: '70%', 
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#fff',
                            titleColor: '#000',
                            bodyColor: '#000',
                            borderColor: '#000',
                            borderWidth: 3,
                            padding: 10,
                            titleFont: { size: 14, family: "'Comic Neue', cursive", weight: 'bold' },
                            bodyFont: { size: 16, family: "'Bangers', cursive" },
                            cornerRadius: 0,
                            displayColors: true
                        }
                    },
                    animation: {
                        animateScale: true,
                        animateRotate: true,
                        duration: 1500, 
                        easing: 'easeOutQuart'
                    }
                }
            });

            // 3. SENSOR SALDO (TOGGLE MATA)
            const btnToggleSaldo = document.getElementById('btn-toggle-saldo');
            const saldoText = document.getElementById('saldo-text');
            const iconEyeClosed = document.getElementById('icon-eye-closed');
            const iconEyeOpen = document.getElementById('icon-eye-open');
            
            let isSaldoHidden = true;
            const textHidden = "Rp &bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;";
            const textShown = "Rp {{ number_format($pemasukan, 0, ',', '.') }}";

            btnToggleSaldo.addEventListener('click', () => {
                saldoText.style.opacity = '0';
                
                setTimeout(() => {
                    isSaldoHidden = !isSaldoHidden;
                    
                    if(isSaldoHidden) {
                        saldoText.innerHTML = textHidden;
                        iconEyeClosed.classList.remove('hidden');
                        iconEyeOpen.classList.add('hidden');
                    } else {
                        saldoText.innerHTML = textShown;
                        iconEyeClosed.classList.add('hidden');
                        iconEyeOpen.classList.remove('hidden');
                    }
                    
                    saldoText.style.opacity = '1';
                }, 150);
            });
        });

        // 4. DROPDOWN PROFIL ADMIN
        function toggleDropdown() {
            const dropdown = document.getElementById('profilDropdown');
            if (dropdown.classList.contains('hidden')) {
                dropdown.classList.remove('hidden');
                setTimeout(() => {
                    dropdown.classList.remove('opacity-0', 'scale-95');
                    dropdown.classList.add('opacity-100', 'scale-100');
                }, 10);
            } else {
                dropdown.classList.remove('opacity-100', 'scale-100');
                dropdown.classList.add('opacity-0', 'scale-95');
                setTimeout(() => {
                    dropdown.classList.add('hidden');
                }, 200); 
            }
        }

        window.addEventListener('click', function(e) {
            const button = document.getElementById('profilButton');
            const dropdown = document.getElementById('profilDropdown');
            if (!button.contains(e.target) && !dropdown.contains(e.target)) {
                if (!dropdown.classList.contains('hidden')) {
                    dropdown.classList.remove('opacity-100', 'scale-100');
                    dropdown.classList.add('opacity-0', 'scale-95');
                    setTimeout(() => {
                        dropdown.classList.add('hidden');
                    }, 200);
                }
            }
        });
    </script>
</body>
</html>