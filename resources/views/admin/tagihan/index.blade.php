<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tagihan & Kas - Kos Lalan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- FONT KOMIK DARI GOOGLE -->
    <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Comic+Neue:wght@400;700&display=swap" rel="stylesheet">
    
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
        @keyframes popIn { 
            from { opacity: 0; transform: scale(0.8); }
            to { opacity: 1; transform: scale(1); }
        }
        
        .row-delay-1 { animation-delay: 50ms; }
        .row-delay-2 { animation-delay: 100ms; }
        
        /* Efek Hover Kartu Komik */
        .comic-card { transition: all 0.2s ease-in-out; }
        .comic-card:hover { transform: translate(-4px, -4px); box-shadow: 8px 8px 0px 0px rgba(0,0,0,1); }
        .comic-button:hover { transform: translate(-2px, -2px); box-shadow: 4px 4px 0px 0px rgba(0,0,0,1); }

        /* Input Komik */
        .comic-input {
            border: 3px solid black;
            box-shadow: 4px 4px 0px 0px rgba(0,0,0,1);
            transition: all 0.2s;
        }
        .comic-input:focus {
            outline: none;
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0px 0px rgba(0,0,0,1);
            background-color: #fef08a; /* Kuning pas ngetik */
        }

        /* Modal Animasi */
        .modal-enter { opacity: 0; transform: scale(0.9) rotate(-2deg); }
        .modal-enter-active { opacity: 1; transform: scale(1) rotate(0); transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
        .modal-leave { opacity: 1; transform: scale(1); }
        .modal-leave-active { opacity: 0; transform: scale(0.9) rotate(2deg); transition: all 0.2s ease-in; }

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
            <div class="h-20 flex items-center justify-center px-6 border-b-4 border-black bg-red-500 relative overflow-hidden">
                <div class="absolute inset-0 opacity-20 pointer-events-none" style="background-image: repeating-linear-gradient(45deg, #000 0, #000 2px, transparent 2px, transparent 8px);"></div>
                <div class="text-center transform rotate-2 hover:rotate-0 transition-transform cursor-pointer relative z-10">
                    <h1 class="font-komik text-3xl text-white drop-shadow-[2px_2px_0_#000]">KOSAN LALAN</h1>
                    <span class="bg-yellow-300 text-black text-[10px] px-2 py-1 font-bold uppercase tracking-widest border-2 border-black rounded-full">Markas Admin</span>
                </div>
            </div>

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
                
                <!-- AKTIF DI SINI -->
                <a href="{{ route('admin.tagihan.index') }}" class="flex items-center px-4 py-3 bg-cyan-400 border-black translate-x-1 shadow-[4px_4px_0_0_rgba(0,0,0,1)] border-2 rounded-xl transition-all group text-black">
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
                <h2 class="text-2xl font-komik text-black tracking-widest drop-shadow-[1px_1px_0_#fff] mt-1">BRANKAS & TAGIHAN 💸</h2>
                
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
                                <span class="w-2 h-2 rounded-full bg-black mr-2 opacity-0 group-hover:opacity-100 transition-opacity"></span> Pengaturan Profil
                            </a>
                        </div>
                        <div class="border-t-4 border-black bg-red-500">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full flex items-center justify-center px-4 py-3 text-sm font-komik tracking-widest text-white hover:bg-red-600 transition-colors">
                                    KABUUR! (LOGOUT)
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <div class="flex-1 overflow-y-auto p-6 lg:p-10 scroll-smooth relative pb-20">
                <div class="w-full max-w-6xl mx-auto">

                    <!-- ALERT SUCCESS (COMIC STYLE) -->
                    @if(session('success'))
                    <div class="mb-8 p-4 bg-green-400 border-4 border-black shadow-[6px_6px_0_0_rgba(0,0,0,1)] flex items-start gap-4 animate-pop transform rotate-1">
                        <div class="w-10 h-10 rounded-full bg-white border-2 border-black flex items-center justify-center text-black shrink-0 font-komik text-xl shadow-[2px_2px_0_0_rgba(0,0,0,1)]">OK!</div>
                        <div>
                            <h4 class="text-xl font-komik text-black tracking-wide">BERHASIL!</h4>
                            <p class="text-base font-bold text-black mt-1">{{ session('success') }}</p>
                        </div>
                    </div>
                    @endif

                    <!-- HEADER ACTIONS: TOMBOL SATUAN & MASSAL -->
                    <div class="flex flex-col md:flex-row justify-between items-end mb-8 opacity-0 animate-pop">
                        <div class="mb-4 md:mb-0 bg-white border-4 border-black p-3 rounded-2xl shadow-[4px_4px_0_0_rgba(0,0,0,1)] transform -rotate-1">
                            <h3 class="text-2xl font-komik text-black tracking-widest">PENGATURAN TAGIHAN</h3>
                            <p class="text-sm text-black font-bold mt-1">Pantau, nagih, dan kelola uang kas masuk.</p>
                        </div>
                        
                        <div class="flex flex-col sm:flex-row items-center gap-4">
                            <!-- Tombol Satuan -->
                            <button type="button" onclick="openSatuanModal()" class="w-full sm:w-auto bg-cyan-300 border-4 border-black hover:bg-cyan-400 text-black px-5 py-3 rounded-xl font-komik text-xl tracking-widest transition-all shadow-[4px_4px_0_0_rgba(0,0,0,1)] flex items-center justify-center gap-2 comic-button">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path></svg>
                                SATUAN AJA
                            </button>
                            
                            <!-- Tombol Massal -->
                            <form id="formGenerateTagihan" action="{{ route('admin.tagihan.generate') }}" method="POST" class="w-full sm:w-auto">
                                @csrf
                                <button type="button" onclick="openGenerateModal()" class="w-full bg-yellow-400 border-4 border-black hover:bg-yellow-500 text-black px-5 py-3 rounded-xl font-komik text-xl tracking-widest transition-all shadow-[4px_4px_0_0_rgba(0,0,0,1)] flex items-center justify-center gap-2 comic-button transform rotate-1">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                    TAGIH MASSAL!
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- KARTU STATISTIK (COMIC BRUTAL) -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8 opacity-0 animate-pop delay-100">
                        
                        <!-- Card Pemasukan -->
                        <div class="bg-green-400 rounded-3xl p-6 border-4 border-black shadow-[8px_8px_0_0_rgba(0,0,0,1)] flex flex-col justify-between relative overflow-hidden comic-card">
                            <div class="absolute -top-6 -right-6 font-komik text-6xl text-black opacity-10 pointer-events-none transform rotate-12">$$$$$$</div>
                            
                            <div class="flex justify-between items-center mb-4 relative z-10">
                                <h3 class="text-2xl font-komik text-black bg-white border-2 border-black px-3 py-1 rounded-lg transform -rotate-2">TOTAL PEMASUKAN</h3>
                                <button type="button" id="btn-toggle-saldo" class="bg-white border-2 border-black text-black hover:bg-yellow-300 p-2 rounded-xl transition-all shadow-[2px_2px_0_0_rgba(0,0,0,1)] hover:-translate-y-1">
                                    <svg id="icon-eye-closed" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>
                                    <svg id="icon-eye-open" class="w-6 h-6 hidden" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </button>
                            </div>
                            
                            <div class="h-12 flex items-center relative z-10 mb-2">
                                <h2 id="saldo-text" data-real="Rp {{ number_format($totalPemasukan, 0, ',', '.') }}" class="text-4xl font-komik text-white drop-shadow-[2px_2px_0_#000] tracking-widest transition-opacity duration-300">Rp &bull;&bull;&bull;&bull;&bull;&bull;&bull;</h2>
                            </div>
                            
                            <div class="relative z-10 mt-auto pt-2">
                                <span class="bg-white border-2 border-black text-black px-3 py-1 rounded font-bold text-sm uppercase shadow-[2px_2px_0_0_rgba(0,0,0,1)]">{{ $tagihans->where('status', 'Lunas')->count() }} LUNAS ✅</span>
                            </div>
                        </div>

                        <!-- Card Tunggakan -->
                        <div class="bg-white rounded-3xl p-6 border-4 border-black shadow-[8px_8px_0_0_rgba(0,0,0,1)] flex flex-col justify-between relative comic-card">
                            <div class="absolute -top-3 -right-3 w-12 h-12 bg-red-500 border-2 border-black rounded-full flex items-center justify-center font-komik text-white transform rotate-12 shadow-[2px_2px_0_0_rgba(0,0,0,1)] animate-pulse">!</div>
                            
                            <h3 class="text-2xl font-komik text-black mb-4">TOTAL TUNGGAKAN 🚨</h3>
                            <h4 class="text-4xl font-komik text-red-500 drop-shadow-[1px_1px_0_#000] tracking-widest mb-4">Rp {{ number_format($totalTunggakan, 0, ',', '.') }}</h4>
                            
                            <div class="mt-auto">
                                <span class="bg-yellow-300 border-2 border-black text-black px-3 py-1 rounded font-bold text-sm uppercase shadow-[2px_2px_0_0_rgba(0,0,0,1)] transform inline-block -rotate-1">{{ $tagihans->where('status', 'Belum Lunas')->count() }} BELUM BAYAR! 💸</span>
                            </div>
                        </div>

                    </div>

                    <!-- FILTER, SEARCH, DAN TOMBOL CETAK -->
                    <div class="bg-cyan-100 rounded-3xl border-4 border-black shadow-[8px_8px_0_0_rgba(0,0,0,1)] p-6 mb-8 opacity-0 animate-pop delay-200">
                        <form action="{{ route('admin.tagihan.index') }}" method="GET" class="flex flex-col xl:flex-row gap-6 items-center justify-between">
                            
                            <!-- Bagian Kiri: Search & Filter Bulan -->
                            <div class="flex flex-col sm:flex-row gap-4 w-full xl:w-auto">
                                <!-- Search -->
                                <div class="relative w-full sm:w-64">
                                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari penghuni..." class="w-full pl-4 pr-4 py-3 bg-white comic-input text-base font-bold rounded-xl placeholder-slate-400">
                                </div>

                                <!-- Filter Bulan -->
                                <div class="relative w-full sm:w-48">
                                    <select name="bulan" class="w-full pl-4 pr-4 py-3 bg-white comic-input text-base font-bold rounded-xl appearance-none cursor-pointer">
                                        <option value="">Semua Bulan</option>
                                        <option value="January" {{ request('bulan') == 'January' ? 'selected' : '' }}>Januari</option>
                                        <option value="February" {{ request('bulan') == 'February' ? 'selected' : '' }}>Februari</option>
                                        <option value="March" {{ request('bulan') == 'March' ? 'selected' : '' }}>Maret</option>
                                        <option value="April" {{ request('bulan') == 'April' ? 'selected' : '' }}>April</option>
                                        <option value="May" {{ request('bulan') == 'May' ? 'selected' : '' }}>Mei</option>
                                        <option value="June" {{ request('bulan') == 'June' ? 'selected' : '' }}>Juni</option>
                                        <option value="July" {{ request('bulan') == 'July' ? 'selected' : '' }}>Juli</option>
                                        <option value="August" {{ request('bulan') == 'August' ? 'selected' : '' }}>Agustus</option>
                                        <option value="September" {{ request('bulan') == 'September' ? 'selected' : '' }}>September</option>
                                        <option value="October" {{ request('bulan') == 'October' ? 'selected' : '' }}>Oktober</option>
                                        <option value="November" {{ request('bulan') == 'November' ? 'selected' : '' }}>November</option>
                                        <option value="December" {{ request('bulan') == 'December' ? 'selected' : '' }}>Desember</option>
                                    </select>
                                </div>
                                
                                <button type="submit" class="px-6 py-3 bg-black hover:bg-slate-800 text-white font-komik text-xl tracking-widest rounded-xl transition-colors shadow-[4px_4px_0_0_#94a3b8] comic-button">FILTER</button>
                                
                                @if(request('search') || request('bulan'))
                                    <a href="{{ route('admin.tagihan.index') }}" class="px-6 py-3 bg-white border-4 border-black text-black font-komik text-xl tracking-widest rounded-xl transition-colors hover:bg-slate-100 shadow-[4px_4px_0_0_rgba(0,0,0,1)] comic-button text-center">RESET</a>
                                @endif
                            </div>

                            <!-- Bagian Kanan: Cetak & Bersihkan -->
                            <div class="flex flex-col sm:flex-row gap-4 w-full xl:w-auto">
                                <a href="{{ route('admin.tagihan.cetak', ['search' => request('search'), 'bulan' => request('bulan')]) }}" target="_blank" class="w-full sm:w-auto px-6 py-3 bg-blue-500 border-4 border-black text-white text-xl font-komik tracking-widest rounded-xl transition-all shadow-[4px_4px_0_0_rgba(0,0,0,1)] flex items-center justify-center gap-2 comic-button transform -rotate-1">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                                    CETAK PDF!
                                </a>

                                <button type="button" onclick="openBersihkanModal('{{ request('bulan') }}')" class="w-full sm:w-auto px-6 py-3 bg-red-500 border-4 border-black text-white text-xl font-komik tracking-widest rounded-xl transition-all shadow-[4px_4px_0_0_rgba(0,0,0,1)] flex items-center justify-center gap-2 comic-button transform rotate-1">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    BERSIH ARSIP!
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- TABEL TAGIHAN (COMIC STYLE) -->
                    <div class="bg-white rounded-3xl border-4 border-black shadow-[8px_8px_0_0_rgba(0,0,0,1)] overflow-hidden opacity-0 animate-pop delay-300 comic-card">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-yellow-300 border-b-4 border-black">
                                        <th class="py-5 px-6 text-xl font-komik text-black tracking-widest uppercase border-r-4 border-black">Penghuni & Kamar</th>
                                        <th class="py-5 px-6 text-xl font-komik text-black tracking-widest uppercase border-r-4 border-black">Bulan</th>
                                        <th class="py-5 px-6 text-xl font-komik text-black tracking-widest uppercase border-r-4 border-black">Nominal</th>
                                        <th class="py-5 px-6 text-xl font-komik text-black tracking-widest uppercase border-r-4 border-black">Status</th>
                                        <th class="py-5 px-6 text-xl font-komik text-black tracking-widest uppercase text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y-4 divide-black bg-white">
                                    @foreach($tagihans as $tagihan)
                                    <tr class="hover:bg-cyan-50 transition-colors group">
                                        
                                        <!-- Penghuni & Kamar -->
                                            <td class="py-5 px-6 border-r-4 border-black">
                                                <div class="font-bold text-black text-lg uppercase">{{ $tagihan->penghuni->nama ?? 'PENGHUNI DIHAPUS' }}</div>
                                                <div class="mt-2">
                                                    @if($tagihan->penghuni && $tagihan->penghuni->kamar)
                                                        <span class="bg-black text-white px-2 py-1 rounded text-xs font-bold border-2 border-white shadow-[2px_2px_0_0_rgba(0,0,0,1)] uppercase">{{ $tagihan->penghuni->kamar->nomor_kamar }}</span>
                                                    @else
                                                        <span class="bg-slate-200 text-slate-500 px-2 py-1 rounded text-xs font-bold border-2 border-black">KOSONG</span>
                                                    @endif
                                                </div>
                                            </td>
                                        
                                        <!-- Bulan Tagihan -->
                                        <td class="py-5 px-6 border-r-4 border-black">
                                            <span class="text-base font-bold text-black uppercase">{{ $tagihan->bulan_tagihan }}</span>
                                        </td>
                                        
                                        <!-- Nominal -->
                                        <td class="py-5 px-6 border-r-4 border-black">
                                            <span class="text-2xl font-komik text-green-600 drop-shadow-[1px_1px_0_#000] tracking-wider">Rp {{ number_format($tagihan->jumlah_bayar, 0, ',', '.') }}</span>
                                        </td>
                                        
                                        <!-- Status Pembayaran -->
                                        <td class="py-5 px-6 border-r-4 border-black">
                                            @if($tagihan->status == 'Lunas')
                                                <div class="flex flex-col items-start gap-2">
                                                    <span class="inline-block px-3 py-1 rounded-lg text-sm font-black bg-green-400 text-black border-2 border-black shadow-[2px_2px_0_0_rgba(0,0,0,1)] transform -rotate-2 uppercase">LUNAS ✅</span>
                                                    @if($tagihan->tanggal_bayar)
                                                        <span class="text-[10px] font-bold text-black bg-yellow-200 px-2 border-2 border-black transform rotate-1">TGL: {{ \Carbon\Carbon::parse($tagihan->tanggal_bayar)->format('d M Y') }}</span>
                                                    @endif
                                                </div>
                                            @elseif($tagihan->status == 'Menunggu Konfirmasi')
                                                <span class="inline-block px-3 py-1 rounded-lg text-sm font-black bg-yellow-400 text-black border-2 border-black shadow-[2px_2px_0_0_rgba(0,0,0,1)] transform rotate-2 uppercase animate-pulse">VERIFIKASI... ⏳</span>
                                            @elseif($tagihan->status == 'Ditolak')
                                                <span class="inline-block px-3 py-1 rounded-lg text-sm font-black bg-red-500 text-white border-2 border-black shadow-[2px_2px_0_0_rgba(0,0,0,1)] transform -rotate-3 uppercase animate-bounce">DITOLAK ❌</span>
                                            @else
                                                <span class="inline-block px-3 py-1 rounded-lg text-sm font-black bg-white text-black border-2 border-black shadow-[2px_2px_0_0_rgba(0,0,0,1)] transform rotate-1 uppercase">BELUM LUNAS 💸</span>
                                            @endif
                                        </td>
                                        
                                        <!-- Aksi -->
                                        <td class="py-5 px-6 text-right">
                                            <div class="flex items-center justify-end gap-3">
                                                
                                                @if($tagihan->status == 'Menunggu Konfirmasi' && $tagihan->bukti_bayar)
                                                    <button type="button" onclick="openVerifikasiModal({{ $tagihan->id }}, '{{ asset('storage/' . $tagihan->bukti_bayar) }}', '{{ $tagihan->penghuni->nama ?? 'Penghuni' }}')" class="px-4 py-2 rounded-xl bg-orange-400 hover:bg-orange-500 text-black text-sm font-bold uppercase border-2 border-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] comic-button transition-all transform rotate-2">
                                                        CEK BUKTI! 👀
                                                    </button>
                                                @elseif($tagihan->status == 'Belum Lunas')
                                                    <button type="button" onclick="openBayarModal({{ $tagihan->id }}, '{{ $tagihan->penghuni->nama ?? 'Penghuni' }}', '{{ number_format($tagihan->jumlah_bayar, 0, ',', '.') }}')" class="px-4 py-2 rounded-xl bg-green-400 hover:bg-green-500 text-black text-sm font-bold uppercase border-2 border-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] comic-button transition-all transform -rotate-2">
                                                        LUNASIN! 💰
                                                    </button>

                                                    <!-- Edit -->
                                                    <button type="button" onclick="openEditTagihanModal({{ $tagihan->id }}, {{ $tagihan->jumlah_bayar }})" class="w-10 h-10 rounded-xl bg-yellow-300 text-black hover:bg-yellow-400 flex items-center justify-center transition-all border-2 border-black shadow-[2px_2px_0_0_rgba(0,0,0,1)] comic-button" title="Edit Tagihan">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                                    </button>

                                                    <!-- Hapus -->
                                                    <button type="button" onclick="openDeleteTagihanModal({{ $tagihan->id }})" class="w-10 h-10 rounded-xl bg-red-500 text-white hover:bg-red-600 flex items-center justify-center transition-all border-2 border-black shadow-[2px_2px_0_0_rgba(0,0,0,1)] comic-button" title="Hapus Tagihan">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    </button>
                                                @else
                                                    <!-- Selesai (Disabled) -->
                                                    <span class="font-komik text-xl text-slate-400 tracking-widest border-2 border-slate-300 bg-slate-100 px-4 py-1.5 rounded-lg transform rotate-2 inline-block">SELESAI 🔒</span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </main>
    </div>
    
    <!-- BACKGROUND GELAP GLOBAL MODAL -->
    <div id="modalOverlayGlobal" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-40 hidden transition-opacity opacity-0 duration-300"></div>

    <!-- ========================================== -->
    <!-- SEMUA MODAL (COMIC BRUTAL STYLE) -->
    <!-- ========================================== -->

    <!-- 1. MODAL KONFIRMASI PEMBAYARAN -->
    <div id="modalBayarBox" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 w-full max-w-sm hidden">
        <div class="bg-white rounded-[2rem] shadow-[12px_12px_0_0_rgba(0,0,0,1)] border-4 border-black overflow-hidden modal-enter w-full mx-4 sm:mx-0 text-center p-8 transform rotate-1 relative">
            <div class="absolute inset-0 bg-green-400 opacity-20 pointer-events-none" style="background-image: radial-gradient(#000 2px, transparent 2px); background-size: 16px 16px;"></div>
            
            <div class="w-24 h-24 bg-green-400 text-black border-4 border-black rounded-full flex items-center justify-center mx-auto mb-6 shadow-[4px_4px_0_0_rgba(0,0,0,1)] transform -rotate-12 animate-bounce relative z-10">
                <span class="font-komik text-4xl">💰</span>
            </div>
            
            <h3 class="text-3xl font-komik text-black mb-2 tracking-widest relative z-10">KONFIRMASI LUNAS?</h3>
            <p class="text-base text-black font-bold mb-8 relative z-10">Terima uang sewa dari <br><span id="bayarNamaLabel" class="bg-yellow-300 px-2 border-2 border-black inline-block transform -rotate-2 mt-1 uppercase text-lg"></span><br> sebesar <span id="bayarNominalLabel" class="font-komik text-2xl text-green-600 drop-shadow-[1px_1px_0_#000]"></span>?</p>
            
            <form id="formBayarTagihan" method="POST" class="flex gap-4 relative z-10">
                @csrf
                <button type="button" onclick="closeModal('modalBayarBox')" class="w-1/2 px-4 py-3 rounded-xl border-4 border-black bg-white hover:bg-slate-200 text-lg font-bold text-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] comic-button transition-all">BATAL</button>
                <button type="submit" class="w-1/2 px-4 py-3 rounded-xl bg-green-400 hover:bg-green-500 text-black text-xl font-komik tracking-widest border-4 border-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] comic-button transition-all">YA, LUNAS! ✅</button>
            </form>
        </div>
    </div>

    <!-- 2. MODAL GENERATE TAGIHAN MASSAL -->
    <div id="modalGenerateBox" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 w-full max-w-sm hidden">
        <div class="bg-white rounded-[2rem] shadow-[12px_12px_0_0_rgba(0,0,0,1)] border-4 border-black overflow-hidden modal-enter w-full mx-4 sm:mx-0 text-center p-8 transform -rotate-1 relative">
            <div class="w-24 h-24 bg-yellow-400 text-black border-4 border-black rounded-full flex items-center justify-center mx-auto mb-6 shadow-[4px_4px_0_0_rgba(0,0,0,1)] transform rotate-12 relative z-10">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            </div>
            <h3 class="text-3xl font-komik text-black mb-2 tracking-widest relative z-10">TAGIH SEMUA?!</h3>
            <p class="text-base text-black font-bold mb-8 relative z-10 border-t-4 border-black border-dashed pt-4">Sistem bakal otomatis bikinin tagihan buat semua penghuni <span class="bg-green-400 px-2 border-2 border-black inline-block transform -rotate-2 text-white font-bold">AKTIF</span> di bulan ini.</p>
            
            <div class="flex gap-4 relative z-10">
                <button type="button" onclick="closeModal('modalGenerateBox')" class="w-1/2 px-4 py-3 rounded-xl border-4 border-black bg-white hover:bg-slate-200 text-lg font-bold text-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] comic-button transition-all">BATAL</button>
                <button type="button" onclick="document.getElementById('formGenerateTagihan').submit()" class="w-1/2 px-4 py-3 rounded-xl bg-yellow-400 hover:bg-yellow-500 text-black text-xl font-komik tracking-widest border-4 border-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] comic-button transition-all">SADIS! GAS! 🔥</button>
            </div>
        </div>
    </div>

    <!-- 3. MODAL TAGIHAN SATUAN -->
    <div id="modalSatuanBox" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 w-full max-w-md hidden">
        <div class="bg-cyan-200 rounded-[2rem] shadow-[12px_12px_0_0_rgba(0,0,0,1)] border-4 border-black overflow-hidden modal-enter w-full mx-4 sm:mx-0 p-8 relative">
            <h3 class="text-4xl font-komik text-black mb-6 text-center tracking-widest drop-shadow-[2px_2px_0_#fff]">TAGIHAN SATUAN 🎯</h3>
            
            <form action="{{ route('admin.tagihan.storeManual') }}" method="POST" class="bg-white p-6 rounded-2xl border-4 border-black">
                @csrf
                <div class="space-y-5 mb-8">
                    <div>
                        <label class="block text-lg font-bold text-black mb-2 uppercase">Pilih Target / Penghuni</label>
                        <select name="penghuni_id" id="selectPenghuni" required onchange="setHargaOtomatis()" class="w-full comic-input bg-white text-black font-bold rounded-xl px-4 py-3 cursor-pointer text-lg appearance-none">
                            <option value="" data-harga="">-- Sikat Siapa Nih? --</option>
                            @foreach($penghuniAktifList as $p)
                                <option value="{{ $p->id }}" data-harga="{{ $p->kamar->harga ?? 0 }}">{{ $p->nama }} (Kamar {{ $p->kamar->nomor_kamar ?? '-' }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-lg font-bold text-black mb-2 uppercase">Bulan Tagihan</label>
                        <input type="date" name="tanggal_buat" required class="w-full comic-input bg-white text-black font-bold rounded-xl px-4 py-3 text-lg">
                    </div>
                    <div>
                        <label class="block text-lg font-bold text-black mb-2 uppercase">Uang Tagihan (Rp)</label>
                        <input type="number" name="jumlah_bayar" id="inputNominal" required placeholder="sesuai harga kamar" class="w-full comic-input bg-white text-black font-bold rounded-xl px-4 py-3 text-lg">
                    </div>
                </div>
                
                <div class="flex gap-4">
                    <button type="button" onclick="closeModal('modalSatuanBox')" class="w-1/3 px-4 py-3 rounded-xl border-4 border-black bg-white hover:bg-slate-200 text-lg font-bold text-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] comic-button transition-all text-center">BATAL</button>
                    <button type="submit" class="w-2/3 px-4 py-3 rounded-xl bg-cyan-400 hover:bg-cyan-500 text-black text-2xl font-komik tracking-widest border-4 border-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] comic-button transition-all">BUAT SEKARANG!</button>
                </div>
            </form>
        </div>
    </div>

    <!-- 4. MODAL EDIT TAGIHAN -->
    <div id="modalEditTagihanBox" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 w-full max-w-sm hidden">
        <div class="bg-yellow-300 rounded-[2rem] shadow-[12px_12px_0_0_rgba(0,0,0,1)] border-4 border-black overflow-hidden modal-enter w-full mx-4 sm:mx-0 p-8 transform rotate-1">
            <h3 class="text-4xl font-komik text-black mb-6 text-center tracking-widest drop-shadow-[2px_2px_0_#fff]">REVISI NOMINAL ✏️</h3>
            <form id="formEditTagihan" method="POST" class="bg-white p-6 rounded-2xl border-4 border-black">
                @csrf
                @method('PUT')
                <div class="mb-8">
                    <label class="block text-lg font-bold text-black mb-2 uppercase">Nominal Baru (Rp)</label>
                    <input type="number" id="editNominalInput" name="jumlah_bayar" required class="w-full comic-input bg-white text-black font-bold rounded-xl px-4 py-3 text-lg">
                </div>
                <div class="flex gap-4">
                    <button type="button" onclick="closeModal('modalEditTagihanBox')" class="w-1/2 px-4 py-3 rounded-xl border-4 border-black bg-white hover:bg-slate-200 text-lg font-bold text-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] comic-button transition-all text-center">BATAL</button>
                    <button type="submit" class="w-1/2 px-4 py-3 rounded-xl bg-yellow-400 hover:bg-yellow-500 text-black text-xl font-komik tracking-widest border-4 border-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] comic-button transition-all">SIMPAN!</button>
                </div>
            </form>
        </div>
    </div>

    <!-- 5. MODAL HAPUS TAGIHAN -->
    <div id="modalDeleteTagihanBox" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 w-full max-w-sm hidden">
        <div class="bg-white rounded-[2rem] shadow-[12px_12px_0_0_rgba(0,0,0,1)] border-4 border-black overflow-hidden modal-enter w-full mx-4 sm:mx-0 text-center p-8 transform -rotate-1 relative">
            <div class="absolute inset-0 bg-red-500 opacity-20 pointer-events-none" style="background-image: repeating-linear-gradient(45deg, #000 0, #000 2px, transparent 2px, transparent 8px);"></div>
            <div class="w-24 h-24 bg-red-500 text-white border-4 border-black rounded-full flex items-center justify-center mx-auto mb-6 shadow-[4px_4px_0_0_rgba(0,0,0,1)] transform rotate-12 relative z-10 animate-bounce">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            </div>
            <h3 class="text-3xl font-komik text-red-600 mb-2 tracking-widest drop-shadow-[1px_1px_0_#000] relative z-10">HAPUS DATA?!</h3>
            <p class="text-base text-black font-bold mb-8 relative z-10">Tagihan ini bakal kehapus! Yakin mau hapus?</p>
            
            <form id="formDeleteTagihan" method="POST" class="flex gap-4 relative z-10">
                @csrf
                @method('DELETE')
                <button type="button" onclick="closeModal('modalDeleteTagihanBox')" class="w-1/2 px-4 py-3 rounded-xl border-4 border-black bg-white hover:bg-slate-200 text-lg font-bold text-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] comic-button transition-all">BATAL</button>
                <button type="submit" class="w-1/2 px-4 py-3 rounded-xl bg-red-500 hover:bg-red-600 text-white text-xl font-komik tracking-widest border-4 border-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] comic-button transition-all">HANCURKAN! 💣</button>
            </form>
        </div>
    </div>

    <!-- 6. MODAL VERIFIKASI BUKTI TRANSFER -->
    <div id="modalVerifikasiBox" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 w-full max-w-lg hidden">
        <div class="bg-orange-300 rounded-[2rem] shadow-[12px_12px_0_0_rgba(0,0,0,1)] border-4 border-black overflow-hidden modal-enter w-full mx-4 sm:mx-0 p-8 transform rotate-1">
            
            <div class="flex justify-between items-center mb-6 border-b-4 border-black pb-4 border-dashed relative">
                <h3 class="text-3xl font-komik text-black tracking-widest flex items-center gap-2 drop-shadow-[2px_2px_0_#fff]">
                    <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    CEK BUKTI: <span id="namaPenghuniModal" class="bg-white border-2 border-black px-2 rounded transform -rotate-2 inline-block shadow-[2px_2px_0_0_rgba(0,0,0,1)] ml-2"></span>
                </h3>
                <button type="button" onclick="closeModal('modalVerifikasiBox')" class="text-black hover:bg-white border-2 border-transparent hover:border-black p-1 rounded-xl transition-colors relative z-10 bg-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            
            <div class="flex flex-col items-center">
                <!-- Tampilan Foto Struk -->
                <div class="w-full bg-white p-3 rounded-2xl border-4 border-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] mb-6 transform -rotate-1">
                    <a id="linkFullFoto" href="#" target="_blank" title="Klik untuk lihat full">
                        <img id="imgBukti" src="" alt="Bukti Transfer" class="w-full h-auto max-h-64 object-contain rounded-xl border-2 border-black hover:opacity-90 transition-opacity">
                    </a>
                    <p class="text-xs text-center text-black font-bold uppercase mt-2">*Klik gambar buat *zoom* bro!</p>
                </div>
                
                <div class="w-full grid grid-cols-1 gap-4">
                    <!-- Form Tolak -->
                    <form id="formTolakBukti" method="POST" class="bg-white p-4 rounded-xl border-4 border-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] flex flex-col gap-3">
                        @csrf
                        @method('PUT')
                        <label class="text-lg font-bold text-red-600 uppercase">⚠️ TOLAK PEMBAYARAN?</label>
                        <input type="text" name="alasan_tolak" required placeholder="Alasan: Struk buram / Kurang..." class="w-full comic-input bg-slate-50 px-4 py-3 rounded-xl text-lg font-bold">
                        <button type="submit" class="w-full py-3 bg-red-500 hover:bg-red-600 text-white text-xl font-komik tracking-widest rounded-xl border-4 border-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] comic-button transition-all">TOLAK SEKARANG! ❌</button>
                    </form>
                    
                    <!-- Form Terima -->
                    <form id="formKonfirmasi" method="POST" class="w-full mt-2">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="w-full py-4 bg-green-400 hover:bg-green-500 text-black text-2xl font-komik tracking-widest rounded-xl border-4 border-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] comic-button transition-all flex items-center justify-center gap-2 transform rotate-1">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                            BUKTI VALID, TERIMA LUNAS! ✅
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- 7. KOTAK MODAL BERSIHKAN ARSIP -->
    <div id="modalBersihkanBox" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 w-full max-w-sm hidden">
        <div class="bg-red-500 rounded-[2rem] shadow-[12px_12px_0_0_rgba(0,0,0,1)] border-4 border-black overflow-hidden modal-enter w-full mx-4 sm:mx-0 text-center p-8 transform rotate-2 relative">
            <div class="absolute inset-0 opacity-20 pointer-events-none" style="background-image: radial-gradient(#000 2px, transparent 2px); background-size: 16px 16px;"></div>
            
            <div class="w-24 h-24 bg-white text-red-600 border-4 border-black rounded-full flex items-center justify-center mx-auto mb-6 shadow-[4px_4px_0_0_rgba(0,0,0,1)] transform -rotate-12 animate-pulse relative z-10">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            </div>
            <h3 class="text-4xl font-komik text-white mb-2 tracking-widest drop-shadow-[2px_2px_0_#000] relative z-10">PERINGATAN ARSIP!</h3>
            <p class="text-lg text-white font-bold mb-4 relative z-10">Pastikan udah cetak <span class="bg-yellow-300 text-black px-1 border-2 border-black inline-block">Laporan PDF</span>. Aksi ini bakal ngehapus permanen SEMUA tagihan berstatus <span class="bg-green-400 text-black px-1 border-2 border-black inline-block">LUNAS</span>.</p>
            
            <p id="labelBulanBersih" class="text-sm font-bold text-black mb-8 bg-white py-2 px-4 rounded-xl border-4 border-black transform -rotate-2 relative z-10 inline-block shadow-[4px_4px_0_0_rgba(0,0,0,1)]"></p>
            
            <form id="formBersihkanArsip" action="{{ route('admin.tagihan.bersihkan') }}" method="POST" class="flex gap-4 relative z-10">
                @csrf
                @method('DELETE')
                <input type="hidden" name="bulan" id="inputBulanBersih" value="">
                
                <button type="button" onclick="closeModal('modalBersihkanBox')" class="w-1/2 px-4 py-3 rounded-xl border-4 border-black bg-white hover:bg-slate-200 text-lg font-bold text-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] comic-button transition-all">BATAL</button>
                <button type="submit" class="w-1/2 px-4 py-3 rounded-xl bg-black hover:bg-slate-800 text-white text-xl font-komik tracking-widest border-4 border-white shadow-[4px_4px_0_0_#fff] comic-button transition-all">BERSIHKAN! 🧹</button>
            </form>
        </div>
    </div>

    <!-- ========================================== -->
    <!-- SCRIPT GABUNGAN (BERSIH & ANTI ERROR)      -->
    <!-- ========================================== -->
    <script>
        const overlayGlobal = document.getElementById('modalOverlayGlobal');

        // Fungsi Global Modal
        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            const content = modal.querySelector('div');
            
            overlayGlobal.classList.remove('hidden');
            modal.classList.remove('hidden');
            
            setTimeout(() => {
                overlayGlobal.classList.remove('opacity-0');
                content.classList.remove('modal-enter');
                content.classList.add('modal-enter-active');
            }, 10);
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            const content = modal.querySelector('div');
            
            overlayGlobal.classList.add('opacity-0');
            content.classList.remove('modal-enter-active');
            content.classList.add('modal-leave-active');
            
            setTimeout(() => {
                overlayGlobal.classList.add('hidden');
                modal.classList.add('hidden');
                content.classList.remove('modal-leave-active');
                content.classList.add('modal-enter');
            }, 300);
        }

        // Panggil Modal Spesifik
        function openBayarModal(id, nama, nominal) {
            document.getElementById('formBayarTagihan').action = `/admin/tagihan/${id}/bayar`;
            document.getElementById('bayarNamaLabel').innerText = nama;
            document.getElementById('bayarNominalLabel').innerText = 'Rp ' + nominal;
            openModal('modalBayarBox');
        }

        function openGenerateModal() { openModal('modalGenerateBox'); }
        function openSatuanModal() { openModal('modalSatuanBox'); }

        function openEditTagihanModal(id, nominal) {
            document.getElementById('formEditTagihan').action = `/admin/tagihan/${id}`;
            document.getElementById('editNominalInput').value = nominal;
            openModal('modalEditTagihanBox');
        }

        function openDeleteTagihanModal(id) {
            document.getElementById('formDeleteTagihan').action = `/admin/tagihan/${id}`;
            openModal('modalDeleteTagihanBox');
        }

        function openVerifikasiModal(id, imgUrl, nama) {
            document.getElementById('formKonfirmasi').action = `/admin/tagihan/${id}/konfirmasi`;
            document.getElementById('formTolakBukti').action = `/admin/tagihan/${id}/tolak`;
            document.getElementById('imgBukti').src = imgUrl;
            document.getElementById('linkFullFoto').href = imgUrl;
            document.getElementById('namaPenghuniModal').innerText = nama;
            openModal('modalVerifikasiBox');
        }

        function setHargaOtomatis() {
            const select = document.getElementById('selectPenghuni');
            const harga = select.options[select.selectedIndex].getAttribute('data-harga');
            document.getElementById('inputNominal').value = harga;
        }

        function openBersihkanModal(bulan) {
            document.getElementById('inputBulanBersih').value = bulan;
            if(bulan) {
                document.getElementById('labelBulanBersih').innerText = "TARGET HAPUS: BULAN " + bulan;
            } else {
                document.getElementById('labelBulanBersih').innerText = "TARGET HAPUS: SEMUA BULAN";
            }
            openModal('modalBersihkanBox');
        }

        // Script Sensor Saldo Mata
        document.addEventListener('DOMContentLoaded', function() {
            const btnToggleSaldo = document.getElementById('btn-toggle-saldo');
            const saldoText = document.getElementById('saldo-text');
            const iconEyeClosed = document.getElementById('icon-eye-closed');
            const iconEyeOpen = document.getElementById('icon-eye-open');
            
            if (btnToggleSaldo && saldoText) {
                let isSaldoHidden = true;
                const textHidden = "Rp &bull;&bull;&bull;&bull;&bull;&bull;&bull;";
                const textShown = saldoText.getAttribute('data-real');

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
            }
        });

        // Dropdown Profil Admin
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
                setTimeout(() => { dropdown.classList.add('hidden'); }, 200); 
            }
        }

        window.addEventListener('click', function(e) {
            const button = document.getElementById('profilButton');
            const dropdown = document.getElementById('profilDropdown');
            if (!button.contains(e.target) && !dropdown.contains(e.target)) {
                if (!dropdown.classList.contains('hidden')) {
                    dropdown.classList.remove('opacity-100', 'scale-100');
                    dropdown.classList.add('opacity-0', 'scale-95');
                    setTimeout(() => { dropdown.classList.add('hidden'); }, 200);
                }
            }
        });
    </script>
</body>
</html>