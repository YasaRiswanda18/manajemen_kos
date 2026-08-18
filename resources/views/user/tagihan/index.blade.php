<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tagihan Saya - Kos Lalan</title>
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
            background-color: #fef08a;
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
                
                <!-- Menu Tagihan (AKTIF) -->
                <a href="{{ route('user.tagihan') }}" class="flex items-center px-4 py-3 bg-cyan-400 border-black translate-x-1 shadow-[4px_4px_0_0_rgba(0,0,0,1)] border-2 rounded-xl transition-all group text-black">
                    <svg class="w-6 h-6 mr-3 group-hover:scale-125 transition-transform origin-bottom-left" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    <span class="text-lg font-bold">Tagihan Saya</span>
                </a>

                <!-- Menu Profil -->
                <a href="{{ route('user.profile') }}" class="flex items-center px-4 py-3 bg-white border-transparent hover:bg-yellow-200 hover:border-black hover:translate-x-1 hover:shadow-[4px_4px_0_0_rgba(0,0,0,1)] border-2 rounded-xl transition-all group text-black">
                    <svg class="w-6 h-6 mr-3 group-hover:scale-125 transition-transform origin-bottom-left" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    <span class="text-lg font-bold">Profil & Keamanan</span>
                </a>

                <!-- Menu Lapor Keluhan -->
                <a href="{{ route('user.pengaduan') }}" class="flex items-center px-4 py-3 bg-white border-transparent hover:bg-yellow-200 hover:border-black hover:translate-x-1 hover:shadow-[4px_4px_0_0_rgba(0,0,0,1)] border-2 rounded-xl transition-all group text-black">
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
                <h2 class="text-2xl font-komik text-black tracking-widest drop-shadow-[1px_1px_0_#fff]">TAGIHAN GUA</h2>
                <div class="flex items-center gap-3 bg-yellow-300 border-2 border-black py-2 px-5 rounded-full shadow-[2px_2px_0_0_rgba(0,0,0,1)] cursor-pointer hover:-translate-y-1 hover:shadow-[4px_4px_0_0_rgba(0,0,0,1)] transition-all">
                    <div class="w-8 h-8 bg-black rounded-full flex items-center justify-center">
                        <span class="text-white text-lg font-komik">{{ substr(Auth::user()->name, 0, 1) }}</span>
                    </div>
                    <span class="text-base font-bold text-black uppercase">{{ Auth::user()->name }}</span>
                </div>
            </header>

            <div class="flex-1 overflow-y-auto p-6 lg:p-10 scroll-smooth relative">
                <div class="w-full max-w-5xl mx-auto pb-20">

                    <!-- ALERT SUCCESS (COMIC STYLE) -->
                    @if(session('success'))
                    <div class="mb-8 p-4 bg-green-400 border-4 border-black shadow-[6px_6px_0_0_rgba(0,0,0,1)] flex items-start gap-4 animate-pop transform rotate-1">
                        <div class="w-10 h-10 rounded-full bg-white border-2 border-black flex items-center justify-center text-black shrink-0 font-komik text-xl shadow-[2px_2px_0_0_rgba(0,0,0,1)]">
                            OK!
                        </div>
                        <div>
                            <h4 class="text-xl font-komik text-black tracking-wide">BERHASIL BRO!</h4>
                            <p class="text-base font-bold text-black mt-1">{{ session('success') }}</p>
                        </div>
                    </div>
                    @endif

                    <!-- TABEL RIWAYAT TAGIHAN (COMIC STYLE) -->
                    <div class="bg-white rounded-3xl border-4 border-black shadow-[8px_8px_0_0_rgba(0,0,0,1)] overflow-hidden animate-pop comic-card relative">
                        
                        <!-- Ornamen Bintang -->
                        <div class="absolute -top-4 -right-4 bg-cyan-400 border-4 border-black w-14 h-14 rounded-full flex items-center justify-center transform rotate-12 shadow-[4px_4px_0_0_rgba(0,0,0,1)] z-10">
                            <span class="font-komik text-black text-xl">$$$</span>
                        </div>

                        <div class="p-6 border-b-4 border-black bg-yellow-300 flex justify-between items-center relative overflow-hidden">
                            <!-- Pola Dot Background -->
                            <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(#000 2px, transparent 2px); background-size: 16px 16px;"></div>
                            <h3 class="text-3xl font-komik text-black tracking-widest drop-shadow-[2px_2px_0_#fff] relative z-10">RIWAYAT PEMBAYARAN</h3>
                        </div>
                        
                        <div class="overflow-x-auto bg-white">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-slate-100 border-b-4 border-black">
                                        <th class="py-5 px-6 text-lg font-bold text-black uppercase tracking-wider border-r-4 border-black">Bulan / Tahun</th>
                                        <th class="py-5 px-6 text-lg font-bold text-black uppercase tracking-wider border-r-4 border-black">Total Tagihan</th>
                                        <th class="py-5 px-6 text-lg font-bold text-black uppercase tracking-wider border-r-4 border-black">Status</th>
                                        <th class="py-5 px-6 text-lg font-bold text-black uppercase tracking-wider text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y-4 divide-black">
                                    @forelse($tagihans as $tagihan)
                                    <tr class="hover:bg-cyan-50 transition-colors group">
                                        
                                        <!-- KOLOM BULAN -->
                                        <td class="py-5 px-6 font-bold text-black text-lg border-r-4 border-black">
                                            {{ $tagihan->bulan_tagihan }}
                                        </td>
                                        
                                        <!-- KOLOM HARGA -->
                                        <td class="py-5 px-6 font-komik text-green-600 text-2xl tracking-wider border-r-4 border-black drop-shadow-[1px_1px_0_#000]">
                                            Rp {{ number_format($tagihan->jumlah_bayar ?? $tagihan->total_tagihan, 0, ',', '.') }}
                                        </td>
                                        
                                        <!-- KOLOM STATUS (BADGES) -->
                                        <td class="py-5 px-6 border-r-4 border-black">
                                            @if($tagihan->status == 'Lunas')
                                                <span class="inline-block px-3 py-1 rounded-lg text-sm font-black bg-green-400 text-black border-2 border-black shadow-[2px_2px_0_0_rgba(0,0,0,1)] transform -rotate-2 uppercase">LUNAS ✅</span>
                                            @elseif($tagihan->status == 'Menunggu Konfirmasi')
                                                <span class="inline-block px-3 py-1 rounded-lg text-sm font-black bg-yellow-400 text-black border-2 border-black shadow-[2px_2px_0_0_rgba(0,0,0,1)] transform rotate-2 uppercase animate-pulse">VERIFIKASI... ⏳</span>
                                            @elseif($tagihan->status == 'Ditolak')
                                                <span class="inline-block px-3 py-1 rounded-lg text-sm font-black bg-red-500 text-white border-2 border-black shadow-[2px_2px_0_0_rgba(0,0,0,1)] transform -rotate-3 uppercase animate-bounce">DITOLAK ❌</span>
                                            @else
                                                <span class="inline-block px-3 py-1 rounded-lg text-sm font-black bg-white text-black border-2 border-black shadow-[2px_2px_0_0_rgba(0,0,0,1)] transform rotate-1 uppercase">BELUM LUNAS 💸</span>
                                            @endif
                                        </td>

                                        <!-- KOLOM AKSI -->
                                        <td class="py-5 px-6 text-right">
                                            @if($tagihan->status == 'Ditolak')
                                                <!-- TOMBOL DETAIL TOLAK -->
                                                <button onclick="openDetailTolakModal({{ $tagihan->id }}, '{{ $tagihan->bulan_tagihan }}', '{{ $tagihan->alasan_tolak }}')" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white text-sm font-bold uppercase rounded-xl border-2 border-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_rgba(0,0,0,1)] active:translate-y-0 active:shadow-none transition-all flex items-center justify-end gap-2 ml-auto transform -rotate-1">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                                    Cek Detail!
                                                </button>
                                            @elseif($tagihan->status == 'Belum Lunas')
                                                <!-- TOMBOL UPLOAD BIASA -->
                                                <button onclick="openUploadModal({{ $tagihan->id }}, '{{ $tagihan->bulan_tagihan }}')" class="px-4 py-2 bg-cyan-400 hover:bg-cyan-500 text-black text-sm font-bold uppercase rounded-xl border-2 border-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_rgba(0,0,0,1)] active:translate-y-0 active:shadow-none transition-all transform rotate-1 inline-block">
                                                    Kirim Bukti 🚀
                                                </button>
                                            @elseif($tagihan->status == 'Menunggu Konfirmasi')
                                                <span class="text-sm text-slate-500 font-bold italic">Sabar bro...</span>
                                            @else
                                                <span class="text-sm text-green-600 font-komik text-xl tracking-widest">BERES!</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <!-- JIKA KOSONG -->
                                    <tr>
                                        <td colspan="4" class="py-16 text-center bg-slate-50">
                                            <div class="flex flex-col items-center justify-center">
                                                <div class="w-20 h-20 bg-yellow-300 border-4 border-black rounded-full flex items-center justify-center mb-4 shadow-[4px_4px_0_0_rgba(0,0,0,1)] transform -rotate-6">
                                                    <svg class="w-10 h-10 text-black" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                                </div>
                                                <h3 class="text-3xl font-komik text-black tracking-widest uppercase">BELUM ADA TAGIHAN!</h3>
                                                <p class="text-lg font-bold text-slate-600 mt-1">Dompet aman bulan ini! 😎</p>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </main>
    </div>

    <!-- BACKGROUND GELAP MODAL -->
    <div id="modalOverlay" class="fixed inset-0 bg-slate-900/80 backdrop-blur-sm z-40 hidden transition-opacity opacity-0 duration-300"></div>
    
    <!-- ========================================== -->
    <!-- KOTAK MODAL UPLOAD (COMIC STYLE) -->
    <!-- ========================================== -->
    <div id="modalUploadBox" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 w-full max-w-md hidden">
        <div class="bg-white rounded-3xl shadow-[12px_12px_0_0_rgba(0,0,0,1)] border-4 border-black overflow-hidden w-full mx-4 sm:mx-0 transition-all transform scale-95 opacity-0" id="modalContent">
            
            <div class="flex justify-between items-center p-6 border-b-4 border-black bg-cyan-400 relative">
                <!-- Pola Striped -->
                <div class="absolute inset-0 opacity-20 pointer-events-none" style="background-image: repeating-linear-gradient(45deg, #000 0, #000 2px, transparent 2px, transparent 8px);"></div>
                <h3 class="text-2xl font-komik text-black tracking-widest relative z-10 flex items-center gap-2 drop-shadow-[1px_1px_0_#fff]">
                    <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                    UPLOAD BUKTI TRANSFER!
                </h3>
                <button onclick="closeUploadModal()" class="text-black hover:bg-white border-2 border-transparent hover:border-black p-1 rounded-xl transition-colors relative z-10">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            
            <form id="formUploadBukti" method="POST" enctype="multipart/form-data" class="p-8 bg-slate-50">
                @csrf
                @method('PUT')
                
                <div class="mb-6 bg-white p-4 rounded-xl border-4 border-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] transform -rotate-1">
                    <p class="text-sm font-bold text-slate-500 uppercase">Tagihan Bulan:</p>
                    <p id="labelBulan" class="font-komik text-2xl text-green-600 tracking-wider"></p>
                </div>

                <div class="mb-6">
                    <label class="block text-lg font-bold text-black mb-2 uppercase">Pilih File Bukti <span class="text-red-500">*</span></label>
                    <input type="file" name="bukti_bayar" required accept="image/*" class="w-full comic-input bg-white rounded-xl file:mr-4 file:py-3 file:px-4 file:border-0 file:border-r-4 file:border-black file:text-base file:font-bold file:bg-yellow-300 file:text-black hover:file:bg-yellow-400 cursor-pointer">
                    <p class="text-[11px] font-bold text-black mt-2 bg-white inline-block px-2 border-2 border-black transform rotate-1">*JPG/PNG. Maks 2MB.</p>
                </div>

                <div class="flex gap-4 mt-8">
                    <button type="button" onclick="closeUploadModal()" class="w-1/3 px-4 py-3 rounded-xl border-4 border-black bg-white hover:bg-slate-200 text-lg font-bold text-black transition-all shadow-[4px_4px_0_0_rgba(0,0,0,1)] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_rgba(0,0,0,1)] active:translate-y-0 active:shadow-none">BATAL</button>
                    
                    <button type="submit" class="w-2/3 px-4 py-3 rounded-xl bg-green-400 hover:bg-green-500 text-black text-xl font-komik tracking-widest border-4 border-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_rgba(0,0,0,1)] active:translate-y-0 active:shadow-none transition-all">KIRIM BUKTI!</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ========================================== -->
    <!-- KOTAK MODAL DETAIL TOLAK (COMIC STYLE) -->
    <!-- ========================================== -->
    <div id="modalDetailTolakBox" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 w-full max-w-md hidden">
        <div class="bg-white rounded-3xl shadow-[12px_12px_0_0_rgba(0,0,0,1)] border-4 border-black overflow-hidden w-full mx-4 sm:mx-0 transition-all transform scale-95 opacity-0" id="modalDetailTolakContent">
            
            <div class="flex justify-between items-center p-6 border-b-4 border-black bg-red-500 relative">
                <div class="absolute inset-0 opacity-20 pointer-events-none" style="background-image: radial-gradient(#000 2px, transparent 2px); background-size: 16px 16px;"></div>
                <h3 class="text-2xl font-komik text-white tracking-widest relative z-10 flex items-center gap-2 drop-shadow-[2px_2px_0_#000]">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    WADUH, DITOLAK!
                </h3>
                <button onclick="closeDetailTolakModal()" class="text-white hover:bg-black p-1 rounded-xl transition-colors relative z-10 border-2 border-transparent hover:border-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            
            <div class="p-8 bg-slate-50">
                <!-- Alasan Tolak Komik -->
                <div class="bg-white p-5 rounded-xl border-4 border-black mb-8 relative overflow-visible shadow-[4px_4px_0_0_rgba(0,0,0,1)] transform rotate-1">
                    <div class="absolute -top-4 -left-4 w-10 h-10 bg-yellow-400 border-2 border-black rounded-full flex items-center justify-center font-bold text-lg transform -rotate-12">?!</div>
                    <p class="text-sm font-bold text-slate-500 uppercase tracking-wider mb-2 border-b-2 border-black inline-block pb-1">Catatan Admin:</p>
                    <p id="labelAlasan" class="text-lg font-bold text-red-600 leading-relaxed"></p>
                </div>

                <form id="formUploadUlang" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <label class="block text-lg font-bold text-black mb-2 uppercase">Kirim Ulang Bukti <span class="text-red-500">*</span></label>
                    <input type="file" name="bukti_bayar" required accept="image/*" class="w-full mb-3 comic-input bg-white rounded-xl file:mr-4 file:py-3 file:px-4 file:border-0 file:border-r-4 file:border-black file:text-base file:font-bold file:bg-cyan-300 file:text-black hover:file:bg-cyan-400 cursor-pointer">
                    <p class="text-[11px] font-bold text-black mt-2 bg-white inline-block px-2 border-2 border-black transform -rotate-1 mb-6">*Pastikan gambarnya jelas bro!</p>

                    <button type="submit" class="w-full py-4 bg-yellow-400 hover:bg-yellow-500 text-black text-xl font-komik tracking-widest rounded-xl border-4 border-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_rgba(0,0,0,1)] active:translate-y-0 active:shadow-none transition-all">
                        KIRIM ULANG SEKARANG!
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- SCRIPT FUNGSI BUKA TUTUP MODAL -->
    <script>
        const overlay = document.getElementById('modalOverlay');
        const modal = document.getElementById('modalUploadBox');
        const content = document.getElementById('modalContent');

        const modalDetailTolak = document.getElementById('modalDetailTolakBox');
        const modalDetailTolakContent = document.getElementById('modalDetailTolakContent');

        // BUKA MODAL UPLOAD BIASA
        function openUploadModal(id, bulan) {
            document.getElementById('formUploadBukti').action = `/user/tagihan/${id}/upload-bukti`;
            document.getElementById('labelBulan').innerText = bulan;
            
            overlay.classList.remove('hidden');
            modal.classList.remove('hidden');
            
            setTimeout(() => {
                overlay.classList.remove('opacity-0');
                content.classList.remove('scale-95', 'opacity-0');
                content.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeUploadModal() {
            overlay.classList.add('opacity-0');
            content.classList.remove('scale-100', 'opacity-100');
            content.classList.add('scale-95', 'opacity-0');
            
            setTimeout(() => {
                overlay.classList.add('hidden');
                modal.classList.add('hidden');
            }, 300);
        }

        // BUKA MODAL DETAIL TOLAK
        function openDetailTolakModal(id, bulan, alasan) {
            document.getElementById('formUploadUlang').action = `/user/tagihan/${id}/upload-bukti`;
            document.getElementById('labelAlasan').innerText = alasan;
            
            overlay.classList.remove('hidden');
            modalDetailTolak.classList.remove('hidden');
            setTimeout(() => {
                overlay.classList.remove('opacity-0');
                modalDetailTolakContent.classList.remove('scale-95', 'opacity-0');
                modalDetailTolakContent.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeDetailTolakModal() {
            overlay.classList.add('opacity-0');
            modalDetailTolakContent.classList.remove('scale-100', 'opacity-100');
            modalDetailTolakContent.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                overlay.classList.add('hidden');
                modalDetailTolak.classList.add('hidden');
            }, 300);
        }
    </script>
</body>
</html>