<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pengaturan Profil - Kosan Pak Lalan</title>
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
        
        /* Efek Hover Kartu Komik */
        .comic-card { transition: all 0.2s ease-in-out; }
        .comic-card:hover { transform: translate(-4px, -4px); box-shadow: 12px 12px 0px 0px rgba(0,0,0,1); }
        .comic-button:hover { transform: translate(-2px, -2px); box-shadow: 4px 4px 0px 0px rgba(0,0,0,1); }

        /* Input Komik */
        .comic-input { border: 3px solid black; box-shadow: 4px 4px 0px 0px rgba(0,0,0,1); transition: all 0.2s; }
        .comic-input:focus { outline: none; transform: translate(-2px, -2px); box-shadow: 6px 6px 0px 0px rgba(0,0,0,1); background-color: #fef08a; }

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
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 bg-white border-transparent hover:bg-yellow-200 hover:border-black hover:translate-x-1 hover:shadow-[4px_4px_0_0_rgba(0,0,0,1)] border-2 rounded-xl transition-all group text-black">
                    <svg class="w-6 h-6 mr-3 group-hover:scale-125 transition-transform origin-bottom-left" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    <span class="text-lg font-bold">Dashboard</span>
                </a>
                
                <a href="{{ route('admin.kamar.index') }}" class="flex items-center px-4 py-3 bg-white border-transparent hover:bg-yellow-200 hover:border-black hover:translate-x-1 hover:shadow-[4px_4px_0_0_rgba(0,0,0,1)] border-2 rounded-xl transition-all group text-black">
                    <svg class="w-6 h-6 mr-3 group-hover:scale-125 transition-transform origin-bottom-left" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    <span class="text-lg font-bold">Manajemen Kamar</span>
                </a>
                
                <a href="{{ route('admin.penghuni.index') }}" class="flex items-center px-4 py-3 bg-white border-transparent hover:bg-yellow-200 hover:border-black hover:translate-x-1 hover:shadow-[4px_4px_0_0_rgba(0,0,0,1)] border-2 rounded-xl transition-all group text-black">
                    <svg class="w-6 h-6 mr-3 group-hover:scale-125 transition-transform origin-bottom-left" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    <span class="text-lg font-bold">Data Penghuni</span>
                </a>
                
                <a href="{{ route('admin.tagihan.index') }}" class="flex items-center px-4 py-3 bg-white border-transparent hover:bg-yellow-200 hover:border-black hover:translate-x-1 hover:shadow-[4px_4px_0_0_rgba(0,0,0,1)] border-2 rounded-xl transition-all group text-black">
                    <svg class="w-6 h-6 mr-3 group-hover:scale-125 transition-transform origin-bottom-left" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    <span class="text-lg font-bold">Tagihan & Kas</span>
                </a>

                <a href="{{ route('admin.pengaduan.index') }}" class="flex items-center px-4 py-3 bg-white border-transparent hover:bg-yellow-200 hover:border-black hover:translate-x-1 hover:shadow-[4px_4px_0_0_rgba(0,0,0,1)] border-2 rounded-xl transition-all group text-black">
                    <svg class="w-6 h-6 mr-3 group-hover:scale-125 transition-transform origin-bottom-left" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                    <span class="text-lg font-bold">Laporan Keluhan</span>
                </a>

                <a href="{{ route('admin.akun.index') }}" class="flex items-center px-4 py-3 bg-white border-transparent hover:bg-yellow-200 hover:border-black hover:translate-x-1 hover:shadow-[4px_4px_0_0_rgba(0,0,0,1)] border-2 rounded-xl transition-all group text-black">
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
                <h2 class="text-2xl font-komik text-black tracking-widest drop-shadow-[1px_1px_0_#fff] mt-1">PENGATURAN PROFIL ⚙️</h2>
                
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
                <div class="w-full max-w-3xl mx-auto">

                    <!-- ALERT SUCCESS -->
                    @if(session('success'))
                    <div class="mb-8 p-4 bg-green-400 border-4 border-black shadow-[6px_6px_0_0_rgba(0,0,0,1)] flex items-start gap-4 animate-pop transform -rotate-1">
                        <div class="w-10 h-10 rounded-full bg-white border-2 border-black flex items-center justify-center text-black font-komik text-xl shadow-[2px_2px_0_0_rgba(0,0,0,1)]">OK!</div>
                        <div>
                            <h4 class="text-xl font-komik text-black tracking-wide">MANTAP BRO!</h4>
                            <p class="text-base font-bold text-black mt-1">{{ session('success') }}</p>
                        </div>
                    </div>
                    @endif

                    <!-- ALERT ERROR -->
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

                    <div class="bg-white border-4 border-black p-6 rounded-3xl shadow-[8px_8px_0_0_rgba(0,0,0,1)] mb-8 animate-pop comic-card text-center">
                        <h3 class="text-3xl font-komik text-black tracking-widest uppercase">EDIT PROFIL ADMIN</h3>
                        <p class="text-base font-bold text-slate-700 mt-1">Ubah foto ganteng, nama, atau sandi rahasia lu di sini.</p>
                    </div>

                    <!-- FORM PROFIL (COMIC BRUTAL STYLE) -->
                    <form action="{{ route('admin.profil.update') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-3xl border-4 border-black shadow-[8px_8px_0_0_rgba(0,0,0,1)] p-8 animate-pop delay-100 comic-card relative">
                        @csrf
                        @method('PUT')

                        <!-- UPLOAD FOTO PROFIL KAPSUL -->
                        <div class="flex flex-col items-center justify-center mb-10">
                            <div class="relative group cursor-pointer w-32 h-32 rounded-full border-4 border-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] transition-transform duration-300 hover:scale-105">
                                <div id="fotoPreviewContainer" class="w-full h-full rounded-full bg-yellow-300 flex items-center justify-center overflow-hidden relative">
                                    <span class="absolute text-5xl font-komik text-black z-0">{{ substr(Auth::user()->name ?? 'P', 0, 1) }}</span>
                                    @if(!empty(Auth::user()->foto_profil))
                                        <img src="{{ asset('storage/profil/' . Auth::user()->foto_profil) }}" class="w-full h-full object-cover relative z-10" onerror="this.style.display='none'">
                                    @endif
                                </div>
                                <div class="absolute inset-0 z-20 bg-black/40 rounded-full opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center">
                                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </div>
                                <input type="file" name="foto_profil" accept="image/*" onchange="previewImage(event)" class="absolute inset-0 z-30 w-full h-full opacity-0 cursor-pointer rounded-full" title="Ganti Foto">
                            </div>
                            <span class="mt-4 px-4 py-1 bg-cyan-300 border-2 border-black text-black text-sm font-bold uppercase tracking-wider rounded-full shadow-[2px_2px_0_0_rgba(0,0,0,1)] transform -rotate-2">GANTI FOTO 📸</span>
                        </div>

                        <!-- INFORMASI DASAR -->
                        <div class="mb-8 space-y-6 bg-cyan-50 p-6 rounded-2xl border-4 border-black">
                            <h4 class="text-2xl font-komik text-black tracking-widest border-b-4 border-black border-dashed pb-2">IDENTITAS UTAMA</h4>
                            
                            <div>
                                <label class="block text-lg font-bold text-black mb-2 uppercase">Nama Lengkap</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full px-4 py-3 bg-white comic-input text-lg font-bold">
                            </div>

                            <div>
                                <label class="block text-lg font-bold text-black mb-2 uppercase">Username Login</label>
                                <input type="text" name="username" value="{{ old('username', $user->username) }}" required class="w-full px-4 py-3 bg-white comic-input text-lg font-bold">
                                <p class="text-xs font-bold text-slate-600 mt-2 bg-white inline-block px-2 border-2 border-black transform rotate-1">*Dipakai buat masuk sistem.</p>
                            </div>
                        </div>

                        <!-- GANTI PASSWORD -->
                        <div class="mb-8 space-y-6 bg-yellow-100 p-6 rounded-2xl border-4 border-black relative">
                            
                            <!-- Note Komik -->
                            <div class="absolute -top-4 right-4 bg-white border-2 border-black px-3 py-1 rounded font-bold text-xs shadow-[2px_2px_0_0_rgba(0,0,0,1)] transform rotate-2">
                                Kosongin kalau gak mau ganti sandi!
                            </div>

                            <h4 class="text-2xl font-komik text-black tracking-widest border-b-4 border-black border-dashed pb-2">GANTI SANDI 🔑</h4>
                            
                            <div>
                                <label class="block text-lg font-bold text-black mb-2 uppercase">Password Lama</label>
                                <input type="password" name="password_lama" placeholder="••••••••" class="w-full px-4 py-3 bg-white comic-input text-lg font-bold">
                            </div>

                            <div>
                                <label class="block text-lg font-bold text-black mb-2 uppercase">Password Baru</label>
                                <input type="password" name="password_baru" placeholder="Minimal 8 karakter..." class="w-full px-4 py-3 bg-white comic-input text-lg font-bold">
                            </div>

                            <div>
                                <label class="block text-lg font-bold text-black mb-2 uppercase">Konfirmasi Password Baru</label>
                                <input type="password" name="password_baru_confirmation" placeholder="Ketik ulang password baru..." class="w-full px-4 py-3 bg-white comic-input text-lg font-bold">
                            </div>
                        </div>

                        <!-- TOMBOL SUBMIT -->
                        <div class="flex justify-end pt-4 border-t-4 border-black">
                            <button type="submit" class="w-full py-4 bg-green-400 hover:bg-green-500 text-black font-komik text-2xl tracking-widest rounded-xl border-4 border-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_rgba(0,0,0,1)] active:translate-y-0 active:shadow-none transition-all flex items-center justify-center gap-3">
                                <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                                SIMPAN PERUBAHAN PROFIL! 💥
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </main>
    </div>

    <!-- SCRIPT DROPDOWN & LIVE PREVIEW -->
    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById('profilDropdown');
            if (dropdown) {
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
        }

        window.addEventListener('click', function(e) {
            const button = document.getElementById('profilButton');
            const dropdown = document.getElementById('profilDropdown');
            if (button && dropdown && !button.contains(e.target) && !dropdown.contains(e.target)) {
                if (!dropdown.classList.contains('hidden')) {
                    dropdown.classList.remove('opacity-100', 'scale-100');
                    dropdown.classList.add('opacity-0', 'scale-95');
                    setTimeout(() => { dropdown.classList.add('hidden'); }, 200);
                }
            }
        });

        // Script untuk Live Preview Foto
        function previewImage(event) {
            const container = document.getElementById('fotoPreviewContainer');
            const file = event.target.files[0];
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    container.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover">`;
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>
</html>