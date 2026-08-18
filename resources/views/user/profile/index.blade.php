<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profil & Keamanan - Kos Lalan</title>
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
            background-color: #fef08a; /* Kuning pas ngetik */
        }
        .comic-input:disabled {
            background-color: #e2e8f0;
            cursor: not-allowed;
            box-shadow: 2px 2px 0px 0px rgba(0,0,0,1);
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

                <!-- Menu Profil (AKTIF) -->
                <a href="{{ route('user.profile') }}" class="flex items-center px-4 py-3 bg-cyan-400 border-black translate-x-1 shadow-[4px_4px_0_0_rgba(0,0,0,1)] border-2 rounded-xl transition-all group text-black">
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
                <h2 class="text-2xl font-komik text-black tracking-widest drop-shadow-[1px_1px_0_#fff]">PROFIL GUA</h2>
                <div class="flex items-center gap-3 bg-yellow-300 border-2 border-black py-2 px-5 rounded-full shadow-[2px_2px_0_0_rgba(0,0,0,1)] cursor-pointer hover:-translate-y-1 hover:shadow-[4px_4px_0_0_rgba(0,0,0,1)] transition-all">
                    <div class="w-8 h-8 bg-black rounded-full flex items-center justify-center">
                        <span class="text-white text-lg font-komik">{{ substr(Auth::user()->name, 0, 1) }}</span>
                    </div>
                    <span class="text-base font-bold text-black uppercase">{{ Auth::user()->name }}</span>
                </div>
            </header>

            <div class="flex-1 overflow-y-auto p-6 lg:p-10 scroll-smooth relative">
                <div class="w-full max-w-4xl mx-auto pb-20">

                    <!-- ALERT SUCCESS (COMIC STYLE) -->
                    @if(session('success'))
                    <div class="mb-8 p-4 bg-green-400 border-4 border-black shadow-[6px_6px_0_0_rgba(0,0,0,1)] flex items-start gap-4 animate-pop transform rotate-1">
                        <div class="w-10 h-10 rounded-full bg-white border-2 border-black flex items-center justify-center text-black shrink-0 font-komik text-xl shadow-[2px_2px_0_0_rgba(0,0,0,1)]">
                            SIP!
                        </div>
                        <div>
                            <h4 class="text-xl font-komik text-black tracking-wide">MANTAP BRO!</h4>
                            <p class="text-base font-bold text-black mt-1">{{ session('success') }}</p>
                        </div>
                    </div>
                    @endif
                    
                    <!-- ALERT ERROR (COMIC STYLE) -->
                    @if($errors->any())
                    <div class="mb-8 p-4 bg-red-400 border-4 border-black shadow-[6px_6px_0_0_rgba(0,0,0,1)] flex items-start gap-4 animate-pop transform -rotate-1">
                        <div class="w-10 h-10 rounded-full bg-white border-2 border-black flex items-center justify-center text-black shrink-0 font-komik text-xl shadow-[2px_2px_0_0_rgba(0,0,0,1)]">
                            WAGELASEH!
                        </div>
                        <div>
                            <h4 class="text-xl font-komik text-white tracking-wide drop-shadow-[1px_1px_0_#000]">Oops! Ada kesalahan nih:</h4>
                            <ul class="text-sm font-bold text-white mt-1 list-disc list-inside bg-black/20 p-2 rounded border border-black">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif

                    <!-- CARD PROFIL UTAMA -->
                    <div class="bg-white rounded-3xl border-4 border-black shadow-[8px_8px_0_0_rgba(0,0,0,1)] overflow-hidden animate-pop comic-card relative">
                        
                        <!-- Ornamen Profil -->
                        <div class="absolute top-6 right-6 w-24 h-24 bg-cyan-300 border-4 border-black rounded-[50%_20%_40%_20%] flex items-center justify-center transform rotate-12 shadow-[4px_4px_0_0_rgba(0,0,0,1)] z-10 hidden sm:flex">
                            <span class="font-komik text-black text-2xl tracking-widest transform -rotate-12">TOP<br>SECRET!</span>
                        </div>

                        <form action="{{ route('user.profile.update') }}" method="POST" class="p-8">
                            @csrf
                            @method('PUT')
                            
                            <!-- BAGIAN 1: INFORMASI AKUN (TIDAK BISA DIUBAH) -->
                            <div class="mb-10 relative z-20">
                                <h3 class="text-3xl font-komik text-black tracking-widest flex items-center gap-3 mb-6 drop-shadow-[2px_2px_0_#fff]">
                                    <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4"></path></svg>
                                    DATA IDENTITAS
                                </h3>
                                
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 bg-slate-100 p-6 rounded-2xl border-4 border-black border-dashed relative">
                                    <div class="absolute -top-3 -left-3 bg-red-500 text-white font-bold px-2 py-1 text-xs border-2 border-black transform -rotate-6 shadow-[2px_2px_0_0_rgba(0,0,0,1)]">KUNCI ADMIN 🔒</div>
                                    
                                    <div>
                                        <label class="block text-lg font-bold text-black mb-2 uppercase">Nama Lengkap</label>
                                        <input type="text" value="{{ $user->name }}" disabled class="w-full px-4 py-3 rounded-xl comic-input text-lg font-bold text-slate-500">
                                    </div>
                                    <div>
                                        <label class="block text-lg font-bold text-black mb-2 uppercase">Username Login</label>
                                        <input type="text" value="{{ $user->username }}" disabled class="w-full px-4 py-3 rounded-xl comic-input text-lg font-bold text-slate-500">
                                    </div>
                                    <div class="sm:col-span-2">
                                        <p class="text-sm font-bold text-slate-500 italic border-l-4 border-black pl-3">*Nama dan Username udah fix dari Pak Lalan. Gak bisa diubah ya Bro!</p>
                                    </div>
                                </div>
                            </div>

                            <!-- BAGIAN 2: KONTAK & PASSWORD (BISA DIUBAH) -->
                            <div class="mb-8 relative z-20">
                                <h3 class="text-3xl font-komik text-black tracking-widest flex items-center gap-3 mb-6 drop-shadow-[2px_2px_0_#fff]">
                                    <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    UBAH KEAMANAN
                                </h3>
                                
                                <div class="space-y-6">
                                    <!-- No WA -->
                                    <div class="bg-yellow-200 p-6 rounded-2xl border-4 border-black relative">
                                        <label class="block text-lg font-bold text-black mb-2 uppercase">Nomor WhatsApp Aktif</label>
                                        <input type="tel" name="nomor_hp" value="{{ $penghuni->nomor_hp ?? '' }}" required class="w-full px-4 py-3 rounded-xl comic-input text-lg bg-white">
                                    </div>

                                    <!-- Area Password Baru -->
                                    <div class="bg-cyan-200 p-6 rounded-2xl border-4 border-black relative">
                                        
                                        <!-- Note Komik -->
                                        <div class="absolute -top-5 right-4 bg-white border-2 border-black p-2 rounded shadow-[2px_2px_0_0_rgba(0,0,0,1)] transform rotate-2 z-10 w-48 text-center">
                                            <p class="text-xs font-bold text-black uppercase">Kosongin aja kalau nggak mau ganti password!</p>
                                        </div>

                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-4">
                                            <div>
                                                <label class="block text-lg font-bold text-black mb-2 uppercase">Password Baru</label>
                                                <input type="password" name="password" placeholder="Minimal 6 karakter" class="w-full px-4 py-3 rounded-xl comic-input text-lg bg-white">
                                            </div>
                                            <div>
                                                <label class="block text-lg font-bold text-black mb-2 uppercase">Ketik Ulang Password</label>
                                                <input type="password" name="password_confirmation" placeholder="Biar nggak salah ketik" class="w-full px-4 py-3 rounded-xl comic-input text-lg bg-white">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- TOMBOL SIMPAN -->
                            <div class="flex justify-end pt-6 border-t-4 border-black">
                                <button type="submit" class="px-8 py-4 bg-green-400 hover:bg-green-500 text-black font-komik text-2xl tracking-widest rounded-xl border-4 border-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_rgba(0,0,0,1)] active:translate-y-0 active:shadow-none transition-all flex items-center gap-3">
                                    <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                                    SIMPAN PERUBAHAN! 💥
                                </button>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </main>
    </div>
</body>
</html>