<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Penghuni - Kos Lalan</title>
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
        @keyframes popIn { to { opacity: 1; transform: scale(1); } }
        
        .delay-1 { animation-delay: 150ms; }
        .delay-2 { animation-delay: 300ms; }
        
        /* Efek Hover Kartu Komik */
        .comic-card { transition: all 0.2s ease-in-out; }
        .comic-card:hover { transform: translate(-4px, -4px); box-shadow: 12px 12px 0px 0px rgba(0,0,0,1); }
    </style>
</head>

<body class="bg-halftone text-slate-900 antialiased overflow-hidden selection:bg-yellow-300 selection:text-black">
    <div class="flex h-screen w-full">
        
        <!-- SIDEBAR PENGHUNI (COMIC STYLE) -->
        <aside class="w-64 bg-white flex flex-col transition-all duration-300 z-30 hidden md:flex border-r-4 border-black shadow-[8px_0_0_0_rgba(0,0,0,1)]">
            
            <!-- Logo Sidebar -->
            <div class="h-20 flex items-center justify-center px-6 border-b-4 border-black bg-yellow-400">
                <div class="text-center transform -rotate-2 hover:rotate-0 transition-transform cursor-pointer">
                    <h1 class="font-komik text-3xl text-black drop-shadow-[2px_2px_0_#fff]">KOSAN LALAN</h1>
                    <span class="bg-black text-white text-[10px] px-2 py-1 uppercase tracking-widest border-2 border-white rounded-full">Panel Penghuni</span>
                </div>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-3">
                <!-- Menu Beranda -->
                <a href="{{ route('user.dashboard') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('user.dashboard') ? 'bg-cyan-400 border-black translate-x-1 shadow-[4px_4px_0_0_rgba(0,0,0,1)]' : 'bg-white border-transparent hover:bg-yellow-200 hover:border-black hover:translate-x-1 hover:shadow-[4px_4px_0_0_rgba(0,0,0,1)]' }} border-2 rounded-xl transition-all group text-black">
                    <svg class="w-6 h-6 mr-3 group-hover:scale-125 transition-transform origin-bottom-left" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    <span class="text-lg font-bold">Beranda</span>
                </a>
                
                <!-- Menu Tagihan -->
                <a href="{{ route('user.tagihan') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('user.tagihan') ? 'bg-cyan-400 border-black translate-x-1 shadow-[4px_4px_0_0_rgba(0,0,0,1)]' : 'bg-white border-transparent hover:bg-yellow-200 hover:border-black hover:translate-x-1 hover:shadow-[4px_4px_0_0_rgba(0,0,0,1)]' }} border-2 rounded-xl transition-all group text-black">
                    <svg class="w-6 h-6 mr-3 group-hover:scale-125 transition-transform origin-bottom-left" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    <span class="text-lg font-bold">Tagihan Saya</span>
                </a>

                <!-- Menu Profil -->
                <a href="{{ route('user.profile') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('user.profile') ? 'bg-cyan-400 border-black translate-x-1 shadow-[4px_4px_0_0_rgba(0,0,0,1)]' : 'bg-white border-transparent hover:bg-yellow-200 hover:border-black hover:translate-x-1 hover:shadow-[4px_4px_0_0_rgba(0,0,0,1)]' }} border-2 rounded-xl transition-all group text-black">
                    <svg class="w-6 h-6 mr-3 group-hover:scale-125 transition-transform origin-bottom-left" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    <span class="text-lg font-bold">Profil & Keamanan</span>
                </a>

                <!-- Menu Lapor Keluhan -->
                <a href="{{ route('user.pengaduan') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('user.pengaduan') ? 'bg-cyan-400 border-black translate-x-1 shadow-[4px_4px_0_0_rgba(0,0,0,1)]' : 'bg-white border-transparent hover:bg-yellow-200 hover:border-black hover:translate-x-1 hover:shadow-[4px_4px_0_0_rgba(0,0,0,1)]' }} border-2 rounded-xl transition-all group text-black">
                    <svg class="w-6 h-6 mr-3 group-hover:scale-125 transition-transform origin-bottom-left" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                    <span class="text-lg font-bold">Lapor Keluhan</span>
                </a>
            </nav>

            <!-- Tombol Keluar -->
            <div class="p-4 border-t-4 border-black bg-white">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center px-4 py-3 bg-red-500 border-2 border-black hover:-translate-y-1 hover:shadow-[4px_4px_0_0_rgba(0,0,0,1)] text-white rounded-xl text-lg font-bold transition-all active:translate-y-0 active:shadow-none">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        KABUUR! (Logout)
                    </button>
                </form>
            </div>
        </aside>

        <!-- KONTEN UTAMA -->
        <main class="flex-1 flex flex-col h-screen relative z-10 overflow-hidden">
            
            <!-- Header (Top Bar) -->
            <header class="h-20 bg-white border-b-4 border-black flex items-center justify-end px-8 z-20 shadow-[0_4px_0_0_rgba(0,0,0,1)] relative">
                <div class="flex items-center gap-3 bg-yellow-300 border-2 border-black py-2 px-5 rounded-full shadow-[2px_2px_0_0_rgba(0,0,0,1)] cursor-pointer hover:-translate-y-1 hover:shadow-[4px_4px_0_0_rgba(0,0,0,1)] transition-all">
                    <div class="w-8 h-8 bg-black rounded-full flex items-center justify-center">
                        <span class="text-white text-lg font-komik">{{ substr(Auth::user()->name, 0, 1) }}</span>
                    </div>
                    <span class="text-base font-bold text-black uppercase">{{ Auth::user()->name }}</span>
                </div>
            </header>

            <!-- Area Konten -->
            <div class="flex-1 overflow-y-auto p-6 lg:p-10 scroll-smooth relative">
                <div class="w-full max-w-5xl mx-auto pb-20">

                    <!-- BANNER SELAMAT DATANG (COMIC BURST) -->
                    <div class="mb-10 animate-pop relative">
                        <!-- Ornamen Bintang Komik -->
                        <div class="absolute -top-4 -left-4 bg-red-500 border-4 border-black w-16 h-16 rounded-full flex items-center justify-center transform -rotate-12 shadow-[4px_4px_0_0_rgba(0,0,0,1)] z-10">
                            <span class="font-komik text-white text-2xl">ZAP!</span>
                        </div>
                        
                        <div class="bg-cyan-400 border-4 border-black rounded-2xl p-8 lg:p-10 text-black shadow-[8px_8px_0_0_rgba(0,0,0,1)] relative overflow-hidden flex flex-col md:flex-row justify-between items-center gap-6 comic-card">
                            
                            <!-- Pola Strip Komik di Background Banner -->
                            <div class="absolute inset-0 opacity-20" style="background-image: repeating-linear-gradient(45deg, #000 25%, transparent 25%, transparent 75%, #000 75%, #000), repeating-linear-gradient(45deg, #000 25%, transparent 25%, transparent 75%, #000 75%, #000); background-position: 0 0, 10px 10px; background-size: 20px 20px;"></div>
                            
                            <div class="relative z-10 bg-white/90 border-2 border-black p-6 rounded-xl shadow-[4px_4px_0_0_rgba(0,0,0,1)] w-full transform rotate-1">
                                <p class="text-slate-800 text-lg uppercase tracking-wider mb-1 font-bold">Wassap Bro,</p>
                                <h2 class="text-4xl md:text-5xl font-komik text-red-500 tracking-wide drop-shadow-[2px_2px_0_#000]">{{ Auth::user()->name }}!</h2>
                                <p class="text-black mt-3 text-lg max-w-md leading-relaxed border-t-2 border-dashed border-black pt-2">
                                    Semoga harimu GGWP. Jangan lupa untuk selalu menjaga kebersihan kamar dan area kos ya!
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- GRID KARTU KONTEN -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        
                        <!-- KARTU INFO KAMAR -->
                        <div class="bg-white p-8 rounded-2xl border-4 border-black shadow-[8px_8px_0_0_rgba(0,0,0,1)] animate-pop delay-1 comic-card">
                            <div class="flex items-center gap-4 mb-8">
                                <div class="w-16 h-16 rounded-full bg-yellow-300 text-black flex items-center justify-center border-4 border-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] transform -rotate-6">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                                </div>
                                <div>
                                    <h3 class="text-3xl font-komik text-black tracking-wide">MARKAS LU</h3>
                                    <p class="text-sm font-bold text-slate-500 uppercase border-b-2 border-black inline-block">Info Kamar Saat Ini</p>
                                </div>
                            </div>
                            
                            @if($penghuni && $penghuni->kamar)
                            <div class="bg-slate-100 rounded-xl p-6 border-2 border-black relative">
                                <!-- Pin Ornamen -->
                                <div class="absolute -top-3 -right-3 w-6 h-6 bg-red-500 rounded-full border-2 border-black shadow-sm"></div>

                                <div class="flex justify-between items-center mb-4">
                                    <span class="text-lg font-bold text-black uppercase">No Kamar</span>
                                    <span class="text-3xl font-komik text-cyan-500 drop-shadow-[1px_1px_0_#000] bg-white border-2 border-black px-3 py-1 transform rotate-2">{{ $penghuni->kamar->nomor_kamar }}</span>
                                </div>
                                <div class="flex justify-between items-center mb-4">
                                    <span class="text-lg font-bold text-black uppercase">Tipe</span>
                                    @if($penghuni->kamar->tipe_kamar == 'VIP')
                                        <span class="px-3 py-1 bg-yellow-400 text-black text-xl font-komik border-2 border-black rounded-lg transform -rotate-2">VIP ⭐️</span>
                                    @else
                                        <span class="px-3 py-1 bg-white text-black text-xl font-komik border-2 border-black rounded-lg transform -rotate-2">REGULER</span>
                                    @endif
                                </div>
                                <div class="flex justify-between items-center pt-4 border-t-4 border-dotted border-black">
                                    <span class="text-lg font-bold text-black uppercase">Harga / Bln</span>
                                    <span class="text-2xl font-komik text-green-500 drop-shadow-[1px_1px_0_#000]">Rp {{ number_format($penghuni->kamar->harga, 0, ',', '.') }}</span>
                                </div>
                            </div>
                            @else
                            <div class="bg-red-400 text-black p-6 rounded-xl text-xl font-komik tracking-wide text-center border-4 border-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] transform rotate-1">
                                WADUH! DATA KAMAR BELUM TERSEDIA NIH BRO! 😱
                            </div>
                            @endif
                        </div>

                        <!-- KARTU STATUS TAGIHAN -->
                        <div class="bg-white p-8 rounded-2xl border-4 border-black shadow-[8px_8px_0_0_rgba(0,0,0,1)] animate-pop delay-2 comic-card relative">
                            
                            <!-- Ornamen Boom -->
                            <div class="absolute -top-6 -right-6 w-20 h-20 bg-yellow-400 font-komik text-black flex items-center justify-center text-xl border-4 border-black rounded-[50%_20%_40%_20%] transform rotate-12 shadow-[4px_4px_0_0_rgba(0,0,0,1)]">
                                NEW!
                            </div>

                            <div class="flex items-center gap-4 mb-8">
                                <div class="w-16 h-16 rounded-full bg-red-400 text-black flex items-center justify-center border-4 border-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] transform rotate-6">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <div>
                                    <h3 class="text-3xl font-komik text-black tracking-wide">STATUS DUIT</h3>
                                    <p class="text-sm font-bold text-slate-500 uppercase border-b-2 border-black inline-block">Bulan {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}</p>
                                </div>
                            </div>
                            
                            <div class="bg-cyan-100 rounded-xl p-8 border-4 border-black flex flex-col items-center justify-center text-center transform -rotate-1 relative overflow-hidden">
                                <!-- Garis Kecepatan di Background -->
                                <div class="absolute inset-0 opacity-10" style="background-image: linear-gradient(90deg, transparent 50%, #000 50%); background-size: 8px 100%;"></div>
                                
                                <div class="bg-white border-4 border-black rounded-full p-4 mb-4 shadow-[4px_4px_0_0_rgba(0,0,0,1)] relative z-10 animate-bounce">
                                    <svg class="w-12 h-12 text-black" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                </div>
                                <p class="text-3xl font-komik text-red-500 drop-shadow-[1px_1px_0_#000] relative z-10">SEGERA HADIR!</p>
                                <p class="text-lg text-black font-bold mt-2 relative z-10 bg-white px-2 border-2 border-black transform rotate-2">
                                    Sistem tagihan lagi dimasak! 🍳
                                </p>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </main>
    </div>
</body>
</html>