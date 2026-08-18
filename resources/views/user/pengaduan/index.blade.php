<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lapor Keluhan - Kos Lalan</title>
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
            background-color: #fef08a; /* Kuning pas diketik */
        }
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
                <a href="{{ route('user.dashboard') }}" class="flex items-center px-4 py-3 bg-white border-transparent hover:bg-yellow-200 hover:border-black hover:translate-x-1 hover:shadow-[4px_4px_0_0_rgba(0,0,0,1)] border-2 rounded-xl transition-all group text-black">
                    <svg class="w-6 h-6 mr-3 group-hover:scale-125 transition-transform origin-bottom-left" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    <span class="text-lg font-bold">Beranda</span>
                </a>
                
                <!-- Menu Tagihan -->
                <a href="{{ route('user.tagihan') }}" class="flex items-center px-4 py-3 bg-white border-transparent hover:bg-yellow-200 hover:border-black hover:translate-x-1 hover:shadow-[4px_4px_0_0_rgba(0,0,0,1)] border-2 rounded-xl transition-all group text-black">
                    <svg class="w-6 h-6 mr-3 group-hover:scale-125 transition-transform origin-bottom-left" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    <span class="text-lg font-bold">Tagihan Saya</span>
                </a>

                <!-- Menu Profil -->
                <a href="{{ route('user.profile') }}" class="flex items-center px-4 py-3 bg-white border-transparent hover:bg-yellow-200 hover:border-black hover:translate-x-1 hover:shadow-[4px_4px_0_0_rgba(0,0,0,1)] border-2 rounded-xl transition-all group text-black">
                    <svg class="w-6 h-6 mr-3 group-hover:scale-125 transition-transform origin-bottom-left" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    <span class="text-lg font-bold">Profil & Keamanan</span>
                </a>

                <!-- Menu Lapor Keluhan (AKTIF) -->
                <a href="{{ route('user.pengaduan') }}" class="flex items-center px-4 py-3 bg-cyan-400 border-black translate-x-1 shadow-[4px_4px_0_0_rgba(0,0,0,1)] border-2 rounded-xl transition-all group text-black">
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
            <header class="h-20 bg-white border-b-4 border-black flex items-center justify-between px-8 z-20 shadow-[0_4px_0_0_rgba(0,0,0,1)] relative">
                <h2 class="text-2xl font-komik text-black tracking-widest drop-shadow-[1px_1px_0_#fff]">LAPOR KELUHAN</h2>
                <div class="flex items-center gap-3 bg-yellow-300 border-2 border-black py-2 px-5 rounded-full shadow-[2px_2px_0_0_rgba(0,0,0,1)] cursor-pointer hover:-translate-y-1 hover:shadow-[4px_4px_0_0_rgba(0,0,0,1)] transition-all">
                    <div class="w-8 h-8 bg-black rounded-full flex items-center justify-center">
                        <span class="text-white text-lg font-komik">{{ substr(Auth::user()->name, 0, 1) }}</span>
                    </div>
                    <span class="text-base font-bold text-black uppercase">{{ Auth::user()->name }}</span>
                </div>
            </header>

            <!-- Area Konten -->
            <div class="flex-1 overflow-y-auto p-6 lg:p-10 scroll-smooth relative">
                <div class="w-full max-w-6xl mx-auto pb-20">

                    <!-- ALERT SUKSES (COMIC STYLE) -->
                    @if(session('success'))
                    <div class="mb-8 p-4 bg-green-400 border-4 border-black shadow-[6px_6px_0_0_rgba(0,0,0,1)] flex items-start gap-4 animate-pop transform rotate-1">
                        <div class="w-10 h-10 rounded-full bg-white border-2 border-black flex items-center justify-center text-black shrink-0 font-komik text-xl shadow-[2px_2px_0_0_rgba(0,0,0,1)]">
                            OK!
                        </div>
                        <div>
                            <h4 class="text-xl font-komik text-black tracking-wide">MANTAP BRO! Laporan Terkirim!</h4>
                            <p class="text-base font-bold text-black mt-1">{{ session('success') }}</p>
                        </div>
                    </div>
                    @endif

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                        
                        <!-- FORM PENGADUAN (KIRI) -->
                        <div class="lg:col-span-1">
                            <div class="bg-cyan-200 border-4 border-black shadow-[8px_8px_0_0_rgba(0,0,0,1)] rounded-3xl p-8 sticky top-6 animate-pop comic-card relative">
                                <!-- Ornamen -->
                                <div class="absolute -top-5 -left-5 bg-yellow-400 border-4 border-black w-14 h-14 rounded-full flex items-center justify-center transform -rotate-12 shadow-[4px_4px_0_0_rgba(0,0,0,1)] z-10">
                                    <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </div>

                                <h3 class="text-3xl font-komik text-black tracking-wide mb-2 mt-2">ADA MASALAH?</h3>
                                <p class="text-base text-black font-bold mb-6 border-b-4 border-black pb-4 border-dotted">Fasilitas kos rusak? Air mati? Ketik di sini, Admin bakal langsung sikat!</p>

                                <form action="{{ route('user.pengaduan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                                    @csrf
                                    <div>
                                        <label class="block text-lg font-bold text-black mb-2 uppercase">Judul Laporan <span class="text-red-600">*</span></label>
                                        <input type="text" name="judul" required placeholder="Cth: Keran Kamar Mandi Bocor!" class="w-full px-4 py-3 rounded-xl comic-input text-lg bg-white">
                                    </div>
                                    
                                    <div>
                                        <label class="block text-lg font-bold text-black mb-2 uppercase">Deskripsi Detail <span class="text-red-600">*</span></label>
                                        <textarea name="deskripsi" required rows="4" placeholder="Jelasin kerusakannya sedetail mungkin bro..." class="w-full px-4 py-3 rounded-xl comic-input text-lg bg-white resize-none"></textarea>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-lg font-bold text-black mb-2 uppercase">Foto Bukti <span class="text-sm normal-case">(Opsional)</span></label>
                                        <input type="file" name="foto" accept="image/*" class="w-full comic-input bg-white rounded-xl file:mr-4 file:py-3 file:px-4 file:border-0 file:border-r-4 file:border-black file:text-base file:font-bold file:bg-yellow-300 file:text-black hover:file:bg-yellow-400 cursor-pointer overflow-hidden">
                                        <p class="text-sm font-bold text-black mt-2 bg-white inline-block px-2 border-2 border-black transform rotate-1">*Format: JPG, PNG. Maks: 2MB.</p>
                                    </div>

                                    <button type="submit" class="w-full py-4 bg-red-500 hover:bg-red-600 text-white font-komik text-2xl tracking-widest rounded-xl border-4 border-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_rgba(0,0,0,1)] active:translate-y-0 active:shadow-none transition-all mt-4">
                                        KIRIM LAPORAN!
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- RIWAYAT PENGADUAN (KANAN) -->
                        <div class="lg:col-span-2">
                            <div class="bg-white border-4 border-black rounded-3xl shadow-[8px_8px_0_0_rgba(0,0,0,1)] overflow-hidden animate-pop delay-1 comic-card">
                                
                                <!-- Header Riwayat -->
                                <div class="p-6 border-b-4 border-black bg-yellow-300 flex items-center justify-between">
                                    <h3 class="text-3xl font-komik text-black tracking-widest drop-shadow-[2px_2px_0_#fff]">JEJAK LAPORAN LU</h3>
                                    <div class="w-10 h-10 bg-white border-4 border-black rounded-full flex items-center justify-center font-bold text-black animate-bounce shadow-[2px_2px_0_0_rgba(0,0,0,1)]">
                                        !
                                    </div>
                                </div>

                                <div class="p-6 md:p-8 bg-slate-50">
                                    @forelse($pengaduans as $item)
                                        <div class="mb-6 p-6 border-4 border-black rounded-2xl bg-white shadow-[6px_6px_0_0_rgba(0,0,0,1)] relative overflow-hidden transition-all hover:-translate-y-1 hover:shadow-[8px_8px_0_0_rgba(0,0,0,1)]">
                                            
                                            <!-- Pola Latar Belakang Garis -->
                                            <div class="absolute right-0 top-0 bottom-0 w-32 opacity-10 pointer-events-none" style="background-image: repeating-linear-gradient(45deg, #000 0, #000 2px, transparent 2px, transparent 8px);"></div>
                                            
                                            <div class="flex flex-col sm:flex-row justify-between items-start gap-4 mb-4 relative z-10">
                                                <div>
                                                    <h4 class="text-2xl font-komik text-black tracking-wide uppercase">{{ $item->judul }}</h4>
                                                    <p class="text-sm font-bold text-slate-500 mt-1 border-b-2 border-black inline-block pb-1">{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y, H:i') }} WIB</p>
                                                </div>
                                                
                                                <!-- BADGE STATUS KOMIK -->
                                                <div>
                                                    @if($item->status == 'Menunggu')
                                                        <span class="inline-flex items-center px-4 py-1.5 rounded-lg text-sm font-black bg-slate-200 text-black border-2 border-black shadow-[2px_2px_0_0_rgba(0,0,0,1)] transform -rotate-2 uppercase">Menunggu Respon...</span>
                                                    @elseif($item->status == 'Diproses')
                                                        <span class="inline-flex items-center px-4 py-1.5 rounded-lg text-sm font-black bg-yellow-400 text-black border-2 border-black shadow-[2px_2px_0_0_rgba(0,0,0,1)] transform rotate-2 uppercase animate-pulse">Sedang Diproses 🛠️</span>
                                                    @else
                                                        <span class="inline-flex items-center px-4 py-1.5 rounded-lg text-sm font-black bg-green-400 text-black border-2 border-black shadow-[2px_2px_0_0_rgba(0,0,0,1)] transform -rotate-1 uppercase">Selesai Diperbaiki ✅</span>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                            <!-- ISI DESKRIPSI -->
                                            <div class="text-lg text-black font-bold bg-cyan-50 p-4 rounded-xl border-2 border-black shadow-inner relative z-10">
                                                "{{ $item->deskripsi }}"
                                            </div>
                                            
                                            <!-- LAMPIRAN FOTO -->
                                            @if($item->foto)
                                                <div class="mt-4 relative z-10">
                                                    <p class="text-sm font-black text-black uppercase tracking-wider mb-2 bg-yellow-200 inline-block px-2 border-2 border-black transform rotate-1">Lampiran Bukti:</p>
                                                    <br>
                                                    <a href="{{ asset('storage/' . $item->foto) }}" target="_blank" class="inline-block mt-1">
                                                        <img src="{{ asset('storage/' . $item->foto) }}" alt="Bukti Rusak" class="w-40 h-32 object-cover rounded-xl border-4 border-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] hover:scale-105 transition-all">
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    @empty
                                        <!-- KONDISI KOSONG -->
                                        <div class="text-center py-16 bg-white border-4 border-black border-dashed rounded-2xl">
                                            <div class="w-24 h-24 bg-yellow-300 border-4 border-black rounded-full flex items-center justify-center mx-auto mb-4 shadow-[4px_4px_0_0_rgba(0,0,0,1)] transform rotate-6 animate-pulse">
                                                <svg class="w-12 h-12 text-black" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                                            </div>
                                            <h3 class="text-3xl font-komik text-black tracking-widest">KOSONG MLOMPONG!</h3>
                                            <p class="text-lg font-bold text-slate-600 mt-2">Belum ada laporan keluhan.<br>Kos Lalan aman terkendali! 😎</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>