<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Penghuni - Kos Lalan</title>
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
                
                <a href="{{ route('admin.kamar.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.kamar.*') ? 'bg-cyan-400 border-black translate-x-1 shadow-[4px_4px_0_0_rgba(0,0,0,1)]' : 'bg-white border-transparent hover:bg-yellow-200 hover:border-black hover:translate-x-1 hover:shadow-[4px_4px_0_0_rgba(0,0,0,1)]' }} border-2 rounded-xl transition-all group text-black">
                    <svg class="w-6 h-6 mr-3 group-hover:scale-125 transition-transform origin-bottom-left" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    <span class="text-lg font-bold">Manajemen Kamar</span>
                </a>
                
                <!-- MENU AKTIF DI SINI -->
                <a href="{{ route('admin.penghuni.index') }}" class="flex items-center px-4 py-3 bg-cyan-400 border-black translate-x-1 shadow-[4px_4px_0_0_rgba(0,0,0,1)] border-2 rounded-xl transition-all group text-black">
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
        <main class="flex-1 flex flex-col h-screen relative z-10 overflow-hidden">
            
            <header class="h-20 bg-white border-b-4 border-black flex items-center justify-between px-8 z-30 shadow-[0_4px_0_0_rgba(0,0,0,1)] relative">
                <h2 class="text-2xl font-komik text-black tracking-widest drop-shadow-[1px_1px_0_#fff] mt-1">DAFTAR ANAK KOS 👨‍👩‍👧‍👦</h2>
                
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

                    <!-- ALERT AKUN PENGHUNI BARU (COMIC STYLE) -->
                    @if(session('success_akun'))
                    <div class="mb-8 p-6 bg-cyan-300 border-4 border-black shadow-[8px_8px_0_0_rgba(0,0,0,1)] flex items-start gap-4 animate-pop relative overflow-hidden transform rotate-1 comic-card">
                        <!-- Striped background -->
                        <div class="absolute inset-0 opacity-10 pointer-events-none" style="background-image: repeating-linear-gradient(45deg, #000 0, #000 2px, transparent 2px, transparent 8px);"></div>
                        
                        <div class="w-12 h-12 bg-white border-4 border-black rounded-full flex items-center justify-center text-black font-komik text-3xl shadow-[4px_4px_0_0_rgba(0,0,0,1)] transform -rotate-12 z-10 relative">!</div>
                        
                        <div class="z-10 w-full relative">
                            <h3 class="text-2xl font-komik text-black tracking-widest uppercase">AKUN PENGHUNI BERHASIL DIBIKIN!</h3>
                            <p class="text-base font-bold text-black mt-1">Copy text di bawah ini dan kirim ke WhatsApp penghuni biar dia bisa Login:</p>
                            
                            <div class="mt-4 bg-white p-4 rounded-xl border-4 border-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] inline-block transform -rotate-1">
                                <p class="text-lg font-bold text-black font-mono select-all">{{ session('success_akun') }}</p>
                            </div>
                        </div>
                        
                        <button onclick="this.parentElement.style.display='none'" class="absolute top-4 right-4 text-black hover:text-white bg-white hover:bg-red-500 border-2 border-black rounded p-1 transition-colors z-20 shadow-[2px_2px_0_0_rgba(0,0,0,1)]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                    @endif

                    <!-- ALERT NORMAL (SUCCESS/ERROR) -->
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

                    <!-- HEADER HALAMAN & TOMBOL TAMBAH PENGHUNI -->
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4 opacity-0 animate-pop">
                        <div class="bg-white border-4 border-black p-3 rounded-2xl shadow-[4px_4px_0_0_rgba(0,0,0,1)] transform rotate-1">
                            <h3 class="text-2xl font-komik text-black tracking-widest uppercase">Info Penghuni</h3>
                            <p class="text-sm text-black font-bold mt-1">Pantau & atur siapa aja yang ngekos di sini.</p>
                        </div>
                        
                        <button onclick="openModal()" class="w-full sm:w-auto bg-green-400 hover:bg-green-500 text-black border-4 border-black px-5 py-3 rounded-xl font-komik text-xl tracking-widest transition-all shadow-[4px_4px_0_0_rgba(0,0,0,1)] flex items-center justify-center gap-2 comic-button transform -rotate-1">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                            TAMBAH PENGHUNI BARU!
                        </button>
                    </div>

                    <!-- KARTU STATISTIK (COMIC STYLE) -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8 opacity-0 animate-pop delay-100">
                        
                        <!-- Total Penghuni -->
                        <div class="bg-cyan-200 p-6 rounded-3xl border-4 border-black shadow-[8px_8px_0_0_rgba(0,0,0,1)] flex items-center justify-between comic-card relative">
                            <div class="absolute -top-3 -left-3 bg-white border-4 border-black rounded-full px-2 text-sm font-bold transform -rotate-12 z-10">All</div>
                            <div>
                                <p class="text-sm font-bold text-black uppercase tracking-widest mb-1 border-b-2 border-black inline-block pb-1">TOTAL PENGHUNI</p>
                                <h4 class="count-up text-5xl font-komik text-black drop-shadow-[2px_2px_0_#fff] tracking-widest mt-2" data-target="{{ $penghunis->count() }}">0</h4>
                            </div>
                            <div class="w-16 h-16 rounded-full bg-white text-black border-4 border-black flex items-center justify-center transform rotate-6">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            </div>
                        </div>

                        <!-- Penghuni Aktif -->
                        <div class="bg-green-300 p-6 rounded-3xl border-4 border-black shadow-[8px_8px_0_0_rgba(0,0,0,1)] flex items-center justify-between comic-card relative">
                            <div>
                                <p class="text-sm font-bold text-black uppercase tracking-widest mb-1 border-b-2 border-black inline-block pb-1">PENGHUNI AKTIF</p>
                                <h4 class="count-up text-5xl font-komik text-black drop-shadow-[2px_2px_0_#fff] tracking-widest mt-2" data-target="{{ $penghunis->where('status', 'Aktif')->count() }}">0</h4>
                            </div>
                            <div class="w-16 h-16 rounded-full bg-white text-green-600 border-4 border-black flex items-center justify-center transform -rotate-6 animate-pulse">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                        </div>

                        <!-- Penghuni Keluar (Alumni) -->
                        <div onclick="openRiwayatModal()" class="bg-yellow-300 p-6 rounded-3xl border-4 border-black shadow-[8px_8px_0_0_rgba(0,0,0,1)] flex items-center justify-between comic-card cursor-pointer relative">
                            <div class="absolute -top-3 -right-3 w-8 h-8 bg-red-500 rounded-full border-2 border-black flex items-center justify-center animate-bounce z-10"><span class="text-white font-komik">?</span></div>
                            <div>
                                <p class="text-sm font-bold text-black uppercase tracking-widest mb-1 border-b-2 border-black inline-block pb-1">ALUMNI (KELUAR)</p>
                                <h3 class="text-5xl font-komik text-black drop-shadow-[2px_2px_0_#fff] tracking-widest mt-2">{{ $penghuniKeluar }}</h3>
                            </div>
                            <div class="w-16 h-16 rounded-2xl bg-white border-4 border-black flex items-center justify-center transform rotate-12 transition-transform hover:scale-110">
                                <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                            </div>
                        </div>
                    </div>

                    <!-- TABEL DATA PENGHUNI (COMIC STYLE) -->
                    <div class="bg-white rounded-3xl border-4 border-black shadow-[8px_8px_0_0_rgba(0,0,0,1)] overflow-hidden opacity-0 animate-pop delay-200 comic-card relative">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-red-400 border-b-4 border-black text-black">
                                        <th class="py-5 px-6 text-xl font-komik tracking-widest uppercase border-r-4 border-black">PROFIL PENGHUNI</th>
                                        <th class="py-5 px-6 text-xl font-komik tracking-widest uppercase border-r-4 border-black">KONTAK & PEKERJAAN</th>
                                        <th class="py-5 px-6 text-xl font-komik tracking-widest uppercase border-r-4 border-black">KAMAR</th>
                                        <th class="py-5 px-6 text-xl font-komik tracking-widest uppercase border-r-4 border-black text-center">STATUS</th>
                                        <th class="py-5 px-6 text-xl font-komik tracking-widest uppercase text-right">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y-4 divide-black bg-white">
                                    @foreach($penghunis as $penghuni)
                                    <tr class="hover:bg-yellow-50 transition-colors group">
                                        
                                        <!-- PROFIL -->
                                        <td class="py-5 px-6 border-r-4 border-black">
                                            <div class="flex items-center gap-4">
                                                <div class="w-12 h-12 rounded-full bg-cyan-200 border-2 border-black flex items-center justify-center text-black font-komik text-xl shadow-[2px_2px_0_0_rgba(0,0,0,1)] group-hover:bg-cyan-400 group-hover:scale-110 transition-all">
                                                    {{ strtoupper(substr($penghuni->nama, 0, 2)) }}
                                                </div>
                                                <div>
                                                    <span class="font-bold text-black text-lg block uppercase">{{ $penghuni->nama }}</span>
                                                    <span class="text-[11px] text-black font-bold mt-1 bg-white border-2 border-black px-2 inline-block transform rotate-1 shadow-[2px_2px_0_0_rgba(0,0,0,1)]">MASUK: {{ \Carbon\Carbon::parse($penghuni->tanggal_masuk)->format('d M Y') }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        
                                        <!-- KONTAK & PEKERJAAN -->
                                        <td class="py-5 px-6 border-r-4 border-black">
                                            <div class="mb-2 text-lg font-bold text-black font-mono bg-slate-100 inline-block px-2 border-2 border-black transform -rotate-1">{{ $penghuni->nomor_hp }}</div>
                                            <div>
                                                @if($penghuni->pekerjaan == 'Mahasiswa')
                                                    <span class="px-2 py-1 bg-blue-400 text-black text-xs font-bold border-2 border-black inline-flex items-center gap-1 uppercase transform rotate-1 shadow-[2px_2px_0_0_rgba(0,0,0,1)]">MAHASISWA 🎓</span>
                                                @elseif($penghuni->pekerjaan == 'Karyawan')
                                                    <span class="px-2 py-1 bg-purple-400 text-black text-xs font-bold border-2 border-black inline-flex items-center gap-1 uppercase transform -rotate-1 shadow-[2px_2px_0_0_rgba(0,0,0,1)]">KARYAWAN 💼</span>
                                                @else
                                                    <span class="px-2 py-1 bg-white text-black text-xs font-bold border-2 border-black inline-flex items-center uppercase shadow-[2px_2px_0_0_rgba(0,0,0,1)]">LAINNYA 🛠️</span>
                                                @endif
                                            </div>
                                        </td>
                                        
                                        <!-- KAMAR -->
                                        <td class="py-5 px-6 border-r-4 border-black text-center">
                                            @if($penghuni->kamar)
                                                <div class="inline-block bg-white border-4 border-black px-3 py-1 shadow-[4px_4px_0_0_rgba(0,0,0,1)] transform -rotate-2">
                                                    <span class="text-xl font-komik text-black uppercase">{{ $penghuni->kamar->nomor_kamar }}</span>
                                                </div>
                                                @if($penghuni->kamar->tipe_kamar == 'VIP')
                                                    <div class="mt-2"><span class="text-[10px] font-black text-red-600 bg-yellow-300 px-2 border-2 border-black rounded transform rotate-2 inline-block">VIP!</span></div>
                                                @endif
                                            @else
                                                <span class="text-lg font-komik text-red-500 bg-black px-2 py-1 transform rotate-2 inline-block shadow-[2px_2px_0_0_rgba(0,0,0,1)]">KOSONG</span>
                                            @endif
                                        </td>

                                        <!-- STATUS -->
                                        <td class="py-5 px-6 border-r-4 border-black text-center">
                                            @if($penghuni->status == 'Aktif')
                                                <span class="inline-block px-3 py-1 bg-green-400 text-black text-xs font-bold border-2 border-black uppercase shadow-[2px_2px_0_0_rgba(0,0,0,1)] transform rotate-2">AKTIF ✅</span>
                                            @else
                                                <span class="inline-block px-3 py-1 bg-white text-black text-xs font-bold border-2 border-black uppercase shadow-[2px_2px_0_0_rgba(0,0,0,1)] transform -rotate-2 text-slate-500">KELUAR 🏃‍♂️</span>
                                            @endif
                                        </td>
                                        
                                        <!-- AKSI -->
                                        <td class="py-5 px-6 text-right">
                                            <div class="flex items-center justify-end gap-3">
                                                <!-- Edit -->
                                                <button onclick="openEditModal({{ $penghuni->id }}, '{{ $penghuni->nama }}', '{{ $penghuni->nomor_hp }}', '{{ $penghuni->pekerjaan }}', '{{ $penghuni->kamar_id }}', '{{ $penghuni->status }}')" class="w-12 h-12 rounded-xl bg-yellow-300 text-black hover:bg-yellow-400 flex items-center justify-center transition-all border-2 border-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] comic-button transform rotate-2" title="Edit Penghuni">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                                </button>
                                                <!-- Hapus -->
                                                <button onclick="openDeleteModal({{ $penghuni->id }}, '{{ $penghuni->nama }}')" class="w-12 h-12 rounded-xl bg-red-500 text-white hover:bg-red-600 flex items-center justify-center transition-all border-2 border-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] comic-button transform -rotate-2" title="Hapus Penghuni">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
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
    <!-- KOTAK MODAL TAMBAH PENGHUNI (COMIC STYLE) -->
    <!-- ========================================== -->
    <div id="modalBox" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 w-full max-w-lg hidden">
        <div class="bg-cyan-200 rounded-[2rem] shadow-[12px_12px_0_0_rgba(0,0,0,1)] border-4 border-black overflow-hidden modal-enter w-full mx-4 sm:mx-0 p-8 transform rotate-1">
            <div class="flex justify-between items-center mb-6 border-b-4 border-black border-dashed pb-4">
                <h3 class="text-3xl font-komik text-black tracking-widest drop-shadow-[2px_2px_0_#fff]">PENGHUNI BARU! 🤩</h3>
                <button onclick="closeModal()" class="w-10 h-10 bg-white border-2 border-black text-black rounded-full flex items-center justify-center font-komik text-xl hover:bg-red-500 hover:text-white transition-colors shadow-[2px_2px_0_0_rgba(0,0,0,1)]">X</button>
            </div>
            
            <form action="{{ route('admin.penghuni.store') }}" method="POST" class="bg-white p-6 rounded-2xl border-4 border-black shadow-[4px_4px_0_0_rgba(0,0,0,1)]">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-6">
                    <div class="sm:col-span-2">
                        <label class="block text-lg font-bold text-black mb-2 uppercase">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="nama" required placeholder="Cth: Budi Santoso" class="w-full rounded-xl comic-input text-lg font-bold px-4 py-3 bg-slate-50">
                    </div>
                    <div>
                        <label class="block text-lg font-bold text-black mb-2 uppercase">No. WhatsApp <span class="text-red-500">*</span></label>
                        <input type="tel" name="nomor_hp" required placeholder="0812..." class="w-full rounded-xl comic-input text-lg font-bold px-4 py-3 bg-slate-50">
                    </div>
                    <div>
                        <label class="block text-lg font-bold text-black mb-2 uppercase">Pekerjaan <span class="text-red-500">*</span></label>
                        <select name="pekerjaan" required class="w-full rounded-xl comic-input text-lg font-bold px-4 py-3 bg-white appearance-none cursor-pointer">
                            <option value="" disabled selected>Pilih Status...</option>
                            <option value="Mahasiswa">Mahasiswa</option>
                            <option value="Karyawan">Karyawan</option>
                            <option value="Lainnya">Lainnya / Wirausaha</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-lg font-bold text-black mb-2 uppercase">Tgl Masuk <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_masuk" required value="{{ date('Y-m-d') }}" class="w-full rounded-xl comic-input text-lg font-bold px-4 py-3 bg-slate-50">
                    </div>
                    <div>
                        <label class="block text-lg font-bold text-black mb-2 uppercase">Pilih Kamar <span class="text-red-500">*</span></label>
                        <select name="kamar_id" required class="w-full rounded-xl comic-input text-lg font-bold px-4 py-3 bg-white appearance-none cursor-pointer">
                            <option value="" disabled selected>Pilih Kamar...</option>
                            @foreach($kamarKosong as $kamar)
                                <option value="{{ $kamar->id }}">KM. {{ $kamar->nomor_kamar }} @if($kamar->tipe_kamar == 'VIP') (VIP) @endif</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="flex gap-4">
                    <button type="button" onclick="closeModal()" class="w-1/3 px-4 py-3 rounded-xl border-4 border-black bg-white hover:bg-slate-200 text-lg font-bold text-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] comic-button transition-all">BATAL</button>
                    <button type="submit" class="w-2/3 px-4 py-3 rounded-xl bg-green-400 hover:bg-green-500 text-black text-xl font-komik tracking-widest border-4 border-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] comic-button transition-all">SIMPAN & ISI KAMAR!</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ========================================== -->
    <!-- KOTAK MODAL EDIT PENGHUNI -->
    <!-- ========================================== -->
    <div id="modalEditBox" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 w-full max-w-lg hidden">
        <div class="bg-yellow-300 rounded-[2rem] shadow-[12px_12px_0_0_rgba(0,0,0,1)] border-4 border-black overflow-hidden modal-enter w-full mx-4 sm:mx-0 p-8 transform -rotate-1 relative">
            <div class="absolute inset-0 opacity-10 pointer-events-none" style="background-image: repeating-linear-gradient(90deg, transparent, transparent 40px, #000 40px, #000 42px);"></div>
            <div class="flex justify-between items-center mb-6 border-b-4 border-black border-dashed pb-4 relative z-10">
                <h3 class="text-3xl font-komik text-black tracking-widest drop-shadow-[2px_2px_0_#fff]">EDIT DATA! ✏️</h3>
                <button onclick="closeEditModal()" class="w-10 h-10 bg-white border-2 border-black text-black rounded-full flex items-center justify-center font-komik text-xl hover:bg-red-500 hover:text-white transition-colors shadow-[2px_2px_0_0_rgba(0,0,0,1)]">X</button>
            </div>
            
            <form id="formEditPenghuni" method="POST" class="bg-white p-6 rounded-2xl border-4 border-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] relative z-10">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-6">
                    <div class="sm:col-span-2">
                        <label class="block text-lg font-bold text-black mb-2 uppercase">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" id="editNama" name="nama" required class="w-full rounded-xl comic-input text-lg font-bold px-4 py-3 bg-slate-50">
                    </div>
                    <div>
                        <label class="block text-lg font-bold text-black mb-2 uppercase">No. WhatsApp <span class="text-red-500">*</span></label>
                        <input type="tel" id="editHp" name="nomor_hp" required class="w-full rounded-xl comic-input text-lg font-bold px-4 py-3 bg-slate-50">
                    </div>
                    <div>
                        <label class="block text-lg font-bold text-black mb-2 uppercase">Pekerjaan <span class="text-red-500">*</span></label>
                        <select id="editPekerjaan" name="pekerjaan" required class="w-full rounded-xl comic-input text-lg font-bold px-4 py-3 bg-white appearance-none cursor-pointer">
                            <option value="Mahasiswa">Mahasiswa</option>
                            <option value="Karyawan">Karyawan</option>
                            <option value="Lainnya">Lainnya / Wirausaha</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-lg font-bold text-black mb-2 uppercase">Pindah Kamar</label>
                        <select id="editKamar" name="kamar_id" class="w-full rounded-xl comic-input text-lg font-bold px-4 py-3 bg-white appearance-none cursor-pointer">
                            @foreach($kamarKosong as $kamar)
                                <option value="{{ $kamar->id }}">KM. {{ $kamar->nomor_kamar }} (Kosong)</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-lg font-bold text-black mb-2 uppercase">Status Penghuni <span class="text-red-500">*</span></label>
                        <select id="editStatus" name="status" required class="w-full rounded-xl comic-input text-lg font-bold px-4 py-3 bg-white appearance-none cursor-pointer">
                            <option value="Aktif">AKTIF</option>
                            <option value="Keluar">KELUAR (Kamar Kosong)</option>
                        </select>
                    </div>
                </div>
                <div class="flex gap-4">
                    <button type="button" onclick="closeEditModal()" class="w-1/3 px-4 py-3 rounded-xl border-4 border-black bg-white hover:bg-slate-200 text-lg font-bold text-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] comic-button transition-all">BATAL</button>
                    <button type="submit" class="w-2/3 px-4 py-3 rounded-xl bg-yellow-400 hover:bg-yellow-500 text-black text-xl font-komik tracking-widest border-4 border-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] comic-button transition-all">UBAH DATA!</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ========================================== -->
    <!-- KOTAK MODAL HAPUS PENGHUNI -->
    <!-- ========================================== -->
    <div id="modalDeleteBox" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 w-full max-w-sm hidden">
        <div class="bg-red-500 rounded-[2rem] shadow-[12px_12px_0_0_rgba(0,0,0,1)] border-4 border-black overflow-hidden modal-enter w-full mx-4 sm:mx-0 text-center p-8 transform rotate-1">
            <div class="w-24 h-24 bg-white text-black border-4 border-black rounded-full flex items-center justify-center mx-auto mb-6 shadow-[4px_4px_0_0_rgba(0,0,0,1)] transform -rotate-12 animate-bounce">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            </div>
            <h3 class="text-3xl font-komik text-white mb-2 tracking-widest drop-shadow-[2px_2px_0_#000]">HAPUS DATA?!</h3>
            <p class="text-lg text-white font-bold mb-8">Yakin mau depak <span id="deleteNamaLabel" class="bg-yellow-300 text-black px-2 border-2 border-black inline-block transform -rotate-2"></span> dari kosan? Kamar otomatis kosong loh!</p>
            
            <form id="formDeletePenghuni" method="POST" class="flex gap-4">
                @csrf
                @method('DELETE')
                <button type="button" onclick="closeDeleteModal()" class="w-1/2 px-4 py-3 rounded-xl border-4 border-black bg-white hover:bg-slate-200 text-lg font-bold text-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] comic-button transition-all">BATAL</button>
                <button type="submit" class="w-1/2 px-4 py-3 rounded-xl bg-black hover:bg-slate-800 text-white text-xl font-komik tracking-widest border-4 border-white shadow-[4px_4px_0_0_#fff] comic-button transition-all">HANCURKAN! 💣</button>
            </form>
        </div>
    </div>

    <!-- BACKGROUND GELAP MODAL RIWAYAT -->
    <div id="modalOverlayRiwayat" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-40 hidden transition-opacity opacity-0 duration-300"></div>

    <!-- ========================================== -->
    <!-- KOTAK MODAL RIWAYAT (ALUMNI) -->
    <!-- ========================================== -->
    <div id="modalRiwayatBox" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 w-full max-w-lg hidden">
        <div class="bg-white rounded-[2rem] shadow-[12px_12px_0_0_rgba(0,0,0,1)] border-4 border-black overflow-hidden modal-enter w-full mx-4 sm:mx-0 p-8 transform -rotate-1 relative">
            <div class="absolute inset-0 opacity-20 pointer-events-none" style="background-image: radial-gradient(#000 2px, transparent 2px); background-size: 16px 16px;"></div>
            
            <div class="flex justify-between items-center mb-6 border-b-4 border-black pb-4 border-dashed relative z-10">
                <h3 class="text-3xl font-komik text-black tracking-widest uppercase">ALUMNI KOS (KELUAR) 🎒</h3>
                <button onclick="closeRiwayatModal()" class="w-10 h-10 bg-red-500 border-2 border-black text-white rounded-full flex items-center justify-center font-komik text-xl hover:scale-110 shadow-[2px_2px_0_0_rgba(0,0,0,1)] transition-transform">X</button>
            </div>

            <div class="max-h-64 overflow-y-auto pr-4 mb-6 space-y-4 relative z-10">
                @forelse($penghuniKeluarList as $pk)
                <div class="p-4 border-4 border-black bg-yellow-300 rounded-xl flex justify-between items-center shadow-[4px_4px_0_0_rgba(0,0,0,1)] comic-card-sm transform rotate-1">
                    <div>
                        <h4 class="text-xl font-komik text-black">{{ $pk->nama }}</h4>
                        <p class="text-sm font-bold text-slate-700 bg-white inline-block px-1 border-2 border-black mt-1">{{ $pk->nomor_hp }}</p>
                    </div>
                    <span class="px-3 py-1 bg-white border-2 border-black text-black rounded font-komik text-lg transform -rotate-3 shadow-[2px_2px_0_0_rgba(0,0,0,1)]">ALUMNI</span>
                </div>
                @empty
                <div class="text-center py-8 bg-cyan-50 border-4 border-black border-dashed rounded-2xl">
                    <p class="text-xl font-komik text-slate-500 tracking-widest">KOSONG MLOMPONG BRO! 👻</p>
                </div>
                @endforelse
            </div>

            <div class="flex justify-end border-t-4 border-black pt-6 relative z-10">
                <button type="button" onclick="openConfirmResetModal()" class="w-full px-4 py-4 rounded-xl bg-red-500 text-white hover:bg-red-600 border-4 border-black text-2xl font-komik tracking-widest shadow-[4px_4px_0_0_rgba(0,0,0,1)] comic-button transition-all" {{ $penghuniKeluarList->count() == 0 ? 'disabled' : '' }}>
                    BERSIHKAN RIWAYAT (RESET) 🧹
                </button>
            </div>
        </div>
    </div>

    <!-- KOTAK MODAL KONFIRMASI RESET ALUMNI -->
    <div id="modalConfirmResetBox" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 w-full max-w-sm hidden">
        <div class="bg-white rounded-[2rem] shadow-[12px_12px_0_0_rgba(0,0,0,1)] border-4 border-black overflow-hidden modal-enter w-full mx-4 sm:mx-0 text-center p-8 transform rotate-2">
            <div class="w-24 h-24 bg-red-500 text-white border-4 border-black rounded-full flex items-center justify-center mx-auto mb-6 shadow-[4px_4px_0_0_rgba(0,0,0,1)] transform -rotate-12 animate-pulse">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            </div>
            <h3 class="text-3xl font-komik text-red-600 mb-2 tracking-widest drop-shadow-[1px_1px_0_#000]">YAKIN RESET DATA?</h3>
            <p class="text-lg text-black font-bold mb-8">Data alumni bakal dihapus permanen dan angka balik jadi <span class="bg-red-500 text-white px-2 border-2 border-black inline-block font-komik text-2xl transform -rotate-3">0</span>. Gak bisa di-undo loh!</p>
            
            <form action="{{ route('admin.penghuni.clearKeluar') }}" method="POST" class="flex gap-4">
                @csrf
                <button type="button" onclick="closeConfirmResetModal()" class="w-1/2 px-4 py-3 rounded-xl border-4 border-black bg-white hover:bg-slate-200 text-lg font-bold text-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] comic-button transition-all">BATAL</button>
                <button type="submit" class="w-1/2 px-4 py-3 rounded-xl bg-red-500 hover:bg-red-600 text-white text-xl font-komik tracking-widest border-4 border-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] comic-button transition-all">SADIS! HAPUS!</button>
            </form>
        </div>
    </div>

    <!-- ========================================== -->
    <!-- SCRIPT GABUNGAN (BERSIH & ANTI ERROR)      -->
    <!-- ========================================== -->
    <script>
        const overlay = document.getElementById('modalOverlay');

        // Fungsi Global Modal
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

        // Modal Tambah
        function openModal() { showModal('modalBox', 'div'); }
        function closeModal() { hideModal('modalBox', 'div'); }

        // Modal Edit
        function openEditModal(id, nama, hp, pekerjaan, kamar_id, status) {
            document.getElementById('formEditPenghuni').action = `/admin/penghuni/${id}`;
            document.getElementById('editNama').value = nama;
            document.getElementById('editHp').value = hp;
            document.getElementById('editPekerjaan').value = pekerjaan;
            document.getElementById('editStatus').value = status;
            
            let selectKamar = document.getElementById('editKamar');
            if (!Array.from(selectKamar.options).some(opt => opt.value == kamar_id) && kamar_id) {
                let option = new Option('KAMAR SAAT INI (TETAP)', kamar_id, true, true);
                selectKamar.add(option, 0);
            }
            selectKamar.value = kamar_id;
            
            showModal('modalEditBox', 'div');
        }
        function closeEditModal() { hideModal('modalEditBox', 'div'); }

        // Modal Hapus
        function openDeleteModal(id, nama) {
            document.getElementById('formDeletePenghuni').action = `/admin/penghuni/${id}`;
            document.getElementById('deleteNamaLabel').innerText = nama;
            showModal('modalDeleteBox', 'div');
        }
        function closeDeleteModal() { hideModal('modalDeleteBox', 'div'); }

        // Modal Riwayat & Reset
        const overlayRiwayat = document.getElementById('modalOverlayRiwayat');
        const modalRiwayat = document.getElementById('modalRiwayatBox');
        const modalRiwayatContent = modalRiwayat ? modalRiwayat.querySelector('div') : null;
        const modalConfirmReset = document.getElementById('modalConfirmResetBox');
        const modalConfirmResetContent = modalConfirmReset ? modalConfirmReset.querySelector('div') : null;

        function openRiwayatModal() {
            overlayRiwayat.classList.remove('hidden');
            modalRiwayat.classList.remove('hidden');
            setTimeout(() => {
                overlayRiwayat.classList.remove('opacity-0');
                modalRiwayatContent.classList.remove('modal-enter');
                modalRiwayatContent.classList.add('modal-enter-active');
            }, 10);
        }

        function closeRiwayatModal() {
            overlayRiwayat.classList.add('opacity-0');
            modalRiwayatContent.classList.remove('modal-enter-active');
            modalRiwayatContent.classList.add('modal-leave-active');
            setTimeout(() => {
                overlayRiwayat.classList.add('hidden');
                modalRiwayat.classList.add('hidden');
                modalRiwayatContent.classList.remove('modal-leave-active');
                modalRiwayatContent.classList.add('modal-enter');
            }, 300);
        }

        function openConfirmResetModal() {
            modalRiwayat.classList.add('hidden');
            modalConfirmReset.classList.remove('hidden');
            setTimeout(() => {
                modalConfirmResetContent.classList.remove('modal-enter');
                modalConfirmResetContent.classList.add('modal-enter-active');
            }, 10);
        }

        function closeConfirmResetModal() {
            modalConfirmResetContent.classList.remove('modal-enter-active');
            modalConfirmResetContent.classList.add('modal-leave-active');
            setTimeout(() => {
                modalConfirmReset.classList.add('hidden');
                modalConfirmResetContent.classList.remove('modal-leave-active');
                modalConfirmResetContent.classList.add('modal-enter');
                overlayRiwayat.classList.add('opacity-0');
                setTimeout(() => { overlayRiwayat.classList.add('hidden'); }, 300);
            }, 300);
        }

        // Animasi Counter Up
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