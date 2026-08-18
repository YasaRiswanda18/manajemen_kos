<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manajemen Kamar - Kosan Pak Lalan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- FONT KOMIK DARI GOOGLE -->
    <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Comic+Neue:wght@400;700&display=swap" rel="stylesheet">
    
    <style>
        /* Pengaturan Font Dasar */
        body { font-family: 'Comic Neue', cursive; font-weight: 700; }
        .font-komik { font-family: 'Bangers', cursive; letter-spacing: 2px; }
        
        /* Background Halftone Kertas Komik */
        .bg-halftone {
            background-color: #f8fafc;
            background-image: radial-gradient(#94a3b8 2px, transparent 2px);
            background-size: 24px 24px;
        }

        /* Animasi Pop-up Komik */
        .animate-pop { animation: popIn 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards; opacity: 0; transform: scale(0.8); }
        @keyframes popIn { from { opacity: 0; transform: scale(0.8); } to { opacity: 1; transform: scale(1); } }
        
        .delay-100 { animation-delay: 100ms; }
        .delay-200 { animation-delay: 200ms; }
        
        /* Efek Hover Komik */
        .comic-card { transition: all 0.2s ease-in-out; }
        .comic-card:hover { transform: translate(-4px, -4px); box-shadow: 12px 12px 0px 0px rgba(0,0,0,1); }
        .comic-button:hover { transform: translate(-2px, -2px); box-shadow: 4px 4px 0px 0px rgba(0,0,0,1); }

        /* Input Komik */
        .comic-input { border: 3px solid black; box-shadow: 4px 4px 0px 0px rgba(0,0,0,1); transition: all 0.2s; }
        .comic-input:focus { outline: none; transform: translate(-2px, -2px); box-shadow: 6px 6px 0px 0px rgba(0,0,0,1); background-color: #fef08a; }

        /* Modal Animasi Komik */
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
                
                <!-- MENU AKTIF DI SINI -->
                <a href="{{ route('admin.kamar.index') }}" class="flex items-center px-4 py-3 bg-cyan-400 border-black translate-x-1 shadow-[4px_4px_0_0_rgba(0,0,0,1)] border-2 rounded-xl transition-all group text-black">
                    <svg class="w-6 h-6 mr-3 group-hover:scale-125 transition-transform origin-bottom-left" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    <span class="text-lg font-bold">Manajemen Kamar</span>
                </a>
                
                <a href="{{ route('admin.penghuni.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.penghuni.*') ? 'bg-cyan-400 border-black translate-x-1 shadow-[4px_4px_0_0_rgba(0,0,0,1)]' : 'bg-white border-transparent hover:bg-yellow-200 hover:border-black hover:translate-x-1 hover:shadow-[4px_4px_0_0_rgba(0,0,0,1)]' }} border-2 rounded-xl transition-all group text-black">
                    <svg class="w-6 h-6 mr-3 group-hover:scale-125 transition-transform origin-bottom-left" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    <span class="text-lg font-bold">Data Penghuni</span>
                </a>
                
                <a href="{{ route('admin.tagihan.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.tagihan.*') ? 'bg-cyan-400 border-black translate-x-1 shadow-[4px_4px_0_0_rgba(0,0,0,1)]' : 'bg-white border-transparent hover:bg-yellow-200 hover:border-black hover:translate-x-1 hover:shadow-[4px_4px_0_0_rgba(0,0,0,1)]' }} border-2 rounded-xl transition-all group text-black">
                    <svg class="w-6 h-6 mr-3 group-hover:scale-125 transition-transform origin-bottom-left" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    <span class="text-lg font-bold">Tagihan & Kas</span>
                </a>

                <a href="{{ route('admin.pengaduan.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.pengaduan.*') ? 'bg-cyan-400 border-black translate-x-1 shadow-[4px_4px_0_0_rgba(0,0,0,1)]' : 'bg-white border-transparent hover:bg-yellow-200 hover:border-black hover:translate-x-1 hover:shadow-[4px_4px_0_0_rgba(0,0,0,1)]' }} border-2 rounded-xl transition-all group text-black">
                    <svg class="w-6 h-6 mr-3 group-hover:scale-125 transition-transform origin-bottom-left" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
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
        <main class="flex-1 flex flex-col h-screen relative z-10 overflow-hidden">
            
            <header class="h-20 bg-white border-b-4 border-black flex items-center justify-between px-8 z-30 shadow-[0_4px_0_0_rgba(0,0,0,1)] relative">
                <h2 class="text-2xl font-komik text-black tracking-widest drop-shadow-[1px_1px_0_#fff] mt-1">DENAH & KAMAR 🛏️</h2>
                
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
                    
                    <!-- ALERT SUCCESS / ERROR -->
                    @if(session('success'))
                    <div class="mb-8 p-4 bg-green-400 border-4 border-black shadow-[6px_6px_0_0_rgba(0,0,0,1)] flex items-start gap-4 animate-pop transform -rotate-1">
                        <div class="w-10 h-10 rounded-full bg-white border-2 border-black flex items-center justify-center text-black font-komik text-xl shadow-[2px_2px_0_0_rgba(0,0,0,1)]">OK!</div>
                        <div>
                            <h4 class="text-xl font-komik text-black tracking-wide">MANTAP BRO!</h4>
                            <p class="text-base font-bold text-black mt-1">{{ session('success') }}</p>
                        </div>
                    </div>
                    @endif

                    @if($errors->any())
                    <div class="mb-8 p-4 bg-red-400 border-4 border-black shadow-[6px_6px_0_0_rgba(0,0,0,1)] flex items-start gap-4 animate-pop transform rotate-1">
                        <div class="w-10 h-10 rounded-full bg-white border-2 border-black flex items-center justify-center text-black font-komik text-xl shadow-[2px_2px_0_0_rgba(0,0,0,1)]">WTF!</div>
                        <div>
                            <h4 class="text-xl font-komik text-white tracking-wide drop-shadow-[1px_1px_0_#000]">Oops! Ada yang salah nih:</h4>
                            <ul class="text-sm font-bold text-white mt-2 list-disc list-inside bg-black/20 p-2 border-2 border-black rounded">
                                @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif

                    <!-- HEADER & TOMBOL TAMBAH KAMAR -->
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4 opacity-0 animate-pop">
                        <div class="bg-white border-4 border-black p-3 rounded-2xl shadow-[4px_4px_0_0_rgba(0,0,0,1)] transform -rotate-1">
                            <h3 class="text-2xl font-komik text-black tracking-widest uppercase">DAFTAR KAMAR KOS</h3>
                            <p class="text-sm text-black font-bold mt-1">Atur harga, tipe, dan status ketersediaan.</p>
                        </div>
                        
                        <button onclick="openModal()" class="w-full sm:w-auto bg-green-400 hover:bg-green-500 text-black border-4 border-black px-5 py-3 rounded-xl font-komik text-xl tracking-widest transition-all shadow-[4px_4px_0_0_rgba(0,0,0,1)] flex items-center justify-center gap-2 comic-button transform -rotate-1">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                            TAMBAH KAMAR BARU!
                        </button>
                    </div>

                    <!-- KARTU STATISTIK MINI (COMIC STYLE) -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8 opacity-0 animate-pop delay-100">
                        
                        <!-- Total Kamar -->
                        <div class="bg-cyan-200 p-6 rounded-3xl border-4 border-black shadow-[8px_8px_0_0_rgba(0,0,0,1)] flex items-center justify-between comic-card">
                            <div>
                                <p class="text-sm font-bold text-black uppercase tracking-widest mb-1 border-b-2 border-black inline-block pb-1">TOTAL KAMAR</p>
                                <h4 class="count-up text-5xl font-komik text-black drop-shadow-[2px_2px_0_#fff] tracking-widest mt-2" data-target="{{ $kamars->count() }}">0</h4>
                            </div>
                            <div class="w-16 h-16 rounded-full bg-white text-black border-4 border-black flex items-center justify-center transform -rotate-6">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            </div>
                        </div>

                        <!-- Kamar Terisi -->
                        <div class="bg-green-300 p-6 rounded-3xl border-4 border-black shadow-[8px_8px_0_0_rgba(0,0,0,1)] flex items-center justify-between comic-card">
                            <div>
                                <p class="text-sm font-bold text-black uppercase tracking-widest mb-1 border-b-2 border-black inline-block pb-1">KAMAR TERISI</p>
                                <h4 class="count-up text-5xl font-komik text-black drop-shadow-[2px_2px_0_#fff] tracking-widest mt-2" data-target="{{ $kamars->where('status', 'Terisi')->count() }}">0</h4>
                            </div>
                            <div class="w-16 h-16 rounded-full bg-white text-green-600 border-4 border-black flex items-center justify-center transform rotate-6 animate-pulse">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                        </div>

                        <!-- Kamar Kosong -->
                        <div class="bg-yellow-300 p-6 rounded-3xl border-4 border-black shadow-[8px_8px_0_0_rgba(0,0,0,1)] flex items-center justify-between comic-card">
                            <div>
                                <p class="text-sm font-bold text-black uppercase tracking-widest mb-1 border-b-2 border-black inline-block pb-1">KAMAR KOSONG</p>
                                <h4 class="count-up text-5xl font-komik text-red-500 drop-shadow-[2px_2px_0_#000] tracking-widest mt-2" data-target="{{ $kamars->where('status', 'Kosong')->count() }}">0</h4>
                            </div>
                            <div class="w-16 h-16 rounded-full bg-white text-black border-4 border-black flex items-center justify-center transform -rotate-12 animate-pulse">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
                            </div>
                        </div>

                    </div>

                    <!-- TABEL KAMAR (COMIC STYLE) -->
                    <div class="bg-white rounded-3xl border-4 border-black shadow-[8px_8px_0_0_rgba(0,0,0,1)] overflow-hidden opacity-0 animate-pop delay-200 comic-card">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-cyan-400 border-b-4 border-black text-black">
                                        <th class="py-5 px-6 text-xl font-komik tracking-widest uppercase border-r-4 border-black">NO. KAMAR</th>
                                        <th class="py-5 px-6 text-xl font-komik tracking-widest uppercase border-r-4 border-black">TIPE & HARGA SEWA</th>
                                        <th class="py-5 px-6 text-xl font-komik tracking-widest uppercase border-r-4 border-black text-center">STATUS</th>
                                        <th class="py-5 px-6 text-xl font-komik tracking-widest uppercase border-r-4 border-black">PENGHUNI</th>
                                        <th class="py-5 px-6 text-xl font-komik tracking-widest uppercase text-right">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y-4 divide-black bg-white">
                                    @foreach($kamars as $kamar)
                                    <tr class="hover:bg-yellow-50 transition-colors group">
                                        
                                        <!-- No Kamar -->
                                        <td class="py-5 px-6 border-r-4 border-black">
                                            <div class="flex items-center gap-3">
                                                <div class="w-12 h-12 rounded-xl bg-yellow-300 border-2 border-black flex items-center justify-center text-black font-komik text-xl shadow-[2px_2px_0_0_rgba(0,0,0,1)] group-hover:scale-110 transition-transform">
                                                    {{ trim(str_ireplace('kamar', '', $kamar->nomor_kamar)) }}
                                                </div>
                                                <span class="font-bold text-black text-lg uppercase">{{ $kamar->nomor_kamar }}</span>
                                            </div>
                                        </td>
                                        
                                        <!-- Tipe & Harga -->
                                        <td class="py-5 px-6 border-r-4 border-black">
                                            <div class="flex items-center gap-3">
                                                @if($kamar->tipe_kamar == 'VIP')
                                                    <span class="px-2 py-1 bg-red-500 text-white text-xs font-bold border-2 border-black uppercase shadow-[2px_2px_0_0_rgba(0,0,0,1)] transform rotate-2">VIP ⭐️</span>
                                                @else
                                                    <span class="px-2 py-1 bg-slate-200 text-black text-xs font-bold border-2 border-black uppercase shadow-[2px_2px_0_0_rgba(0,0,0,1)] transform -rotate-1">STANDAR</span>
                                                @endif
                                                <span class="text-xl font-komik text-green-600 drop-shadow-[1px_1px_0_#000] tracking-wider">Rp {{ number_format($kamar->harga, 0, ',', '.') }}<span class="text-xs text-black font-sans font-bold">/bln</span></span>
                                            </div>
                                        </td>
                                        
                                        <!-- Status -->
                                        <td class="py-5 px-6 border-r-4 border-black text-center">
                                            @if($kamar->status == 'Kosong')
                                                <span class="inline-block px-3 py-1 rounded-lg text-sm font-black bg-orange-400 text-black border-2 border-black shadow-[2px_2px_0_0_rgba(0,0,0,1)] transform rotate-2 uppercase animate-pulse">KOSONG 🚪</span>
                                            @else
                                                <span class="inline-block px-3 py-1 rounded-lg text-sm font-black bg-green-400 text-black border-2 border-black shadow-[2px_2px_0_0_rgba(0,0,0,1)] transform -rotate-2 uppercase">TERISI ✅</span>
                                            @endif
                                        </td> 
                                        
                                        <!-- Penghuni -->
                                        <td class="py-5 px-6 border-r-4 border-black">
                                            @if($kamar->penghuni)
                                                <span class="font-bold text-black uppercase bg-cyan-100 px-2 py-1 border-2 border-black inline-block shadow-[2px_2px_0_0_rgba(0,0,0,1)] transform rotate-1">{{ $kamar->penghuni->nama }}</span>
                                            @else
                                                <span class="text-slate-400 italic font-bold">Belum ada penghuni</span>
                                            @endif
                                        </td>
                                        
                                        <!-- Aksi -->
                                        <td class="py-5 px-6 text-right">
                                            <div class="flex items-center justify-end gap-3">
                                                <!-- Edit -->
                                                <button onclick="openEditModal({{ $kamar->id }}, '{{ $kamar->nomor_kamar }}', '{{ $kamar->tipe_kamar }}', {{ $kamar->harga }}, '{{ $kamar->status }}')" class="w-12 h-12 rounded-xl bg-yellow-300 text-black hover:bg-yellow-400 flex items-center justify-center transition-all border-2 border-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] comic-button transform rotate-2" title="Edit Kamar">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                                </button>
                                                <!-- Hapus -->
                                                <button onclick="openDeleteModal({{ $kamar->id }}, '{{ $kamar->nomor_kamar }}')" class="w-12 h-12 rounded-xl bg-red-500 text-white hover:bg-red-600 flex items-center justify-center transition-all border-2 border-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] comic-button transform -rotate-2" title="Hapus Kamar">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
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

    <!-- BACKGROUND GELAP GLOBAL -->
    <div id="modalOverlay" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-40 hidden transition-opacity opacity-0 duration-300"></div>
    
    <!-- ========================================== -->
    <!-- KOTAK MODAL TAMBAH KAMAR (COMIC STYLE) -->
    <!-- ========================================== -->
    <div id="modalBox" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 w-full max-w-md hidden">
        <div class="bg-cyan-200 rounded-[2rem] shadow-[12px_12px_0_0_rgba(0,0,0,1)] border-4 border-black overflow-hidden modal-enter w-full mx-4 sm:mx-0 p-8 transform rotate-1">
            <div class="flex justify-between items-center mb-6 border-b-4 border-black border-dashed pb-4">
                <h3 class="text-3xl font-komik text-black tracking-widest drop-shadow-[2px_2px_0_#fff]">KAMAR BARU! 🛏️</h3>
                <button onclick="closeModal()" class="w-10 h-10 bg-white border-2 border-black text-black rounded-full flex items-center justify-center font-komik text-xl hover:bg-red-500 hover:text-white transition-colors shadow-[2px_2px_0_0_rgba(0,0,0,1)]">X</button>
            </div>
            
            <form action="{{ route('admin.kamar.store') }}" method="POST" class="bg-white p-6 rounded-2xl border-4 border-black shadow-[4px_4px_0_0_rgba(0,0,0,1)]">
                @csrf
                <div class="space-y-5 mb-6">
                    <div>
                        <label class="block text-lg font-bold text-black mb-2 uppercase">Nomor Kamar <span class="text-red-500">*</span></label>
                        <input type="text" name="nomor_kamar" required placeholder="Cth: Kamar 21" class="w-full rounded-xl comic-input text-lg font-bold px-4 py-3 bg-slate-50">
                    </div>
                    <div>
                        <label class="block text-lg font-bold text-black mb-2 uppercase">Tipe Kamar <span class="text-red-500">*</span></label>
                        <select name="tipe_kamar" required onchange="setHargaOtomatis(this.value, 'inputHarga')" class="w-full rounded-xl comic-input text-lg font-bold px-4 py-3 bg-white appearance-none cursor-pointer">
                            <option value="" disabled selected>Pilih Tipe...</option>
                            <option value="Standar">Tipe Standar</option>
                            <option value="VIP">Tipe VIP</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-lg font-bold text-black mb-2 uppercase">Harga Sewa (Rp) <span class="text-red-500">*</span></label>
                        <input type="number" id="inputHarga" name="harga" required placeholder="Cth: 650000" class="w-full rounded-xl comic-input text-lg font-bold px-4 py-3 bg-slate-50">
                    </div>
                </div>

                <div class="flex gap-4">
                    <button type="button" onclick="closeModal()" class="w-1/3 px-4 py-3 rounded-xl border-4 border-black bg-white hover:bg-slate-200 text-lg font-bold text-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] comic-button transition-all">BATAL</button>
                    <button type="submit" class="w-2/3 px-4 py-3 rounded-xl bg-green-400 hover:bg-green-500 text-black text-xl font-komik tracking-widest border-4 border-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] comic-button transition-all">SIMPAN KAMAR! 🚀</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ========================================== -->
    <!-- KOTAK MODAL EDIT KAMAR -->
    <!-- ========================================== -->
    <div id="modalEditBox" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 w-full max-w-md hidden">
        <div class="bg-yellow-300 rounded-[2rem] shadow-[12px_12px_0_0_rgba(0,0,0,1)] border-4 border-black overflow-hidden modal-enter w-full mx-4 sm:mx-0 p-8 transform -rotate-1 relative">
            <div class="flex justify-between items-center mb-6 border-b-4 border-black border-dashed pb-4">
                <h3 class="text-3xl font-komik text-black tracking-widest drop-shadow-[2px_2px_0_#fff]">REVISI KAMAR! ✏️</h3>
                <button onclick="closeEditModal()" class="w-10 h-10 bg-white border-2 border-black text-black rounded-full flex items-center justify-center font-komik text-xl hover:bg-red-500 hover:text-white transition-colors shadow-[2px_2px_0_0_rgba(0,0,0,1)]">X</button>
            </div>
            
            <form id="formEditKamar" method="POST" class="bg-white p-6 rounded-2xl border-4 border-black shadow-[4px_4px_0_0_rgba(0,0,0,1)]">
                @csrf
                @method('PUT')
                <div class="space-y-5 mb-6">
                    <div>
                        <label class="block text-lg font-bold text-black mb-2 uppercase">Nomor Kamar <span class="text-red-500">*</span></label>
                        <input type="text" id="editNomor" name="nomor_kamar" required class="w-full rounded-xl comic-input text-lg font-bold px-4 py-3 bg-slate-50">
                    </div>
                    <div>
                        <label class="block text-lg font-bold text-black mb-2 uppercase">Tipe Kamar <span class="text-red-500">*</span></label>
                        <select id="editTipe" name="tipe_kamar" required onchange="setHargaOtomatis(this.value, 'editHarga')" class="w-full rounded-xl comic-input text-lg font-bold px-4 py-3 bg-white appearance-none cursor-pointer">
                            <option value="Standar">Tipe Standar</option>
                            <option value="VIP">Tipe VIP</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-lg font-bold text-black mb-2 uppercase">Harga Sewa (Rp) <span class="text-red-500">*</span></label>
                        <input type="number" id="editHarga" name="harga" required class="w-full rounded-xl comic-input text-lg font-bold px-4 py-3 bg-slate-50">
                    </div>
                    <div>
                        <label class="block text-lg font-bold text-black mb-2 uppercase">Status Kamar <span class="text-red-500">*</span></label>
                        <select id="editStatus" name="status" required class="w-full rounded-xl comic-input text-lg font-bold px-4 py-3 bg-white appearance-none cursor-pointer">
                            <option value="Kosong">KOSONG (TERSEDIA)</option>
                            <option value="Terisi">TERISI</option>
                        </select>
                    </div>
                </div>

                <div class="flex gap-4">
                    <button type="button" onclick="closeEditModal()" class="w-1/3 px-4 py-3 rounded-xl border-4 border-black bg-white hover:bg-slate-200 text-lg font-bold text-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] comic-button transition-all">BATAL</button>
                    <button type="submit" class="w-2/3 px-4 py-3 rounded-xl bg-yellow-400 hover:bg-yellow-500 text-black text-xl font-komik tracking-widest border-4 border-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] comic-button transition-all">UPDATE!</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ========================================== -->
    <!-- KOTAK MODAL HAPUS KAMAR -->
    <!-- ========================================== -->
    <div id="modalDeleteBox" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 w-full max-w-sm hidden">
        <div class="bg-red-500 rounded-[2rem] shadow-[12px_12px_0_0_rgba(0,0,0,1)] border-4 border-black overflow-hidden modal-enter w-full mx-4 sm:mx-0 text-center p-8 transform rotate-1">
            <div class="w-24 h-24 bg-white text-black border-4 border-black rounded-full flex items-center justify-center mx-auto mb-6 shadow-[4px_4px_0_0_rgba(0,0,0,1)] transform -rotate-12 animate-bounce">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            </div>
            <h3 class="text-3xl font-komik text-white mb-2 tracking-widest drop-shadow-[2px_2px_0_#000]">HAPUS KAMAR?!</h3>
            <p class="text-lg text-white font-bold mb-8">Yakin mau musnahkan <span id="deleteNomorLabel" class="bg-yellow-300 text-black px-2 border-2 border-black inline-block transform -rotate-2"></span>? Data bakal hilang permanen!</p>
            
            <form id="formDeleteKamar" method="POST" class="flex gap-4">
                @csrf
                @method('DELETE')
                <button type="button" onclick="closeDeleteModal()" class="w-1/2 px-4 py-3 rounded-xl border-4 border-black bg-white hover:bg-slate-200 text-lg font-bold text-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] comic-button transition-all">BATAL</button>
                <button type="submit" class="w-1/2 px-4 py-3 rounded-xl bg-black hover:bg-slate-800 text-white text-xl font-komik tracking-widest border-4 border-white shadow-[4px_4px_0_0_#fff] comic-button transition-all">HANCURKAN! 💣</button>
            </form>
        </div>
    </div>

    <!-- SCRIPT JS -->
    <script>
        const overlay = document.getElementById('modalOverlay');
        
        function showModal(modalId, contentSelector) {
            const m = document.getElementById(modalId);
            const content = m.querySelector(contentSelector);
            overlay.classList.remove('hidden');
            m.classList.remove('hidden');
            setTimeout(() => {
                overlay.classList.remove('opacity-0');
                content.classList.remove('modal-enter');
                content.classList.add('modal-enter-active');
            }, 10);
        }

        function hideModal(modalId, contentSelector) {
            const m = document.getElementById(modalId);
            const content = m.querySelector(contentSelector);
            overlay.classList.add('opacity-0');
            content.classList.remove('modal-enter-active');
            content.classList.add('modal-leave-active');
            setTimeout(() => {
                overlay.classList.add('hidden');
                m.classList.add('hidden');
                content.classList.remove('modal-leave-active');
                content.classList.add('modal-enter');
            }, 300);
        }

        function openModal() { showModal('modalBox', 'div'); }
        function closeModal() { hideModal('modalBox', 'div'); }

        function openEditModal(id, nomor, tipe, harga, status) {
            document.getElementById('formEditKamar').action = `/admin/kamar/${id}`;
            document.getElementById('editNomor').value = nomor;
            document.getElementById('editTipe').value = tipe;
            document.getElementById('editHarga').value = harga;
            document.getElementById('editStatus').value = status;
            showModal('modalEditBox', 'div');
        }
        function closeEditModal() { hideModal('modalEditBox', 'div'); }

        function openDeleteModal(id, nomor) {
            document.getElementById('formDeleteKamar').action = `/admin/kamar/${id}`;
            document.getElementById('deleteNomorLabel').innerText = nomor;
            showModal('modalDeleteBox', 'div');
        }
        function closeDeleteModal() { hideModal('modalDeleteBox', 'div'); }

        function setHargaOtomatis(tipe, inputId) {
            const inputTarget = document.getElementById(inputId);
            if(tipe === 'Standar') { inputTarget.value = 650000; } 
            else if(tipe === 'VIP') { inputTarget.value = 850000; }
        }

        // --- Animasi Counter Up ---
        document.addEventListener("DOMContentLoaded", () => {
            const counters = document.querySelectorAll('.count-up');
            counters.forEach(counter => {
                const target = +counter.getAttribute('data-target');
                let startTimestamp = null;
                const step = (timestamp) => {
                    if (!startTimestamp) startTimestamp = timestamp;
                    const progress = Math.min((timestamp - startTimestamp) / 1000, 1);
                    const easeOutProgress = 1 - Math.pow(1 - progress, 3);
                    counter.innerText = Math.floor(easeOutProgress * target);
                    if (progress < 1) window.requestAnimationFrame(step);
                    else counter.innerText = target; 
                };
                window.requestAnimationFrame(step);
            });
        });

        // Dropdown Profil
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