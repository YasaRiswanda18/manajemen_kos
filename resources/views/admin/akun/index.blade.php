<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelola Akun - Kosan Pak Lalan</title>
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
        @keyframes popIn { from { opacity: 0; transform: scale(0.8); } to { opacity: 1; transform: scale(1); } }
        
        /* Efek Hover Kartu Komik */
        .comic-card { transition: all 0.2s ease-in-out; }
        .comic-card:hover { transform: translate(-4px, -4px); box-shadow: 12px 12px 0px 0px rgba(0,0,0,1); }
        .comic-button:hover { transform: translate(-2px, -2px); box-shadow: 4px 4px 0px 0px rgba(0,0,0,1); }

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
        
        <!-- SIDEBAR ADMIN -->
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

                <!-- MENU AKTIF -->
                <a href="{{ route('admin.akun.index') }}" class="flex items-center px-4 py-3 bg-cyan-400 border-black translate-x-1 shadow-[4px_4px_0_0_rgba(0,0,0,1)] border-2 rounded-xl transition-all group text-black">
                    <svg class="w-6 h-6 mr-3 group-hover:scale-125 transition-transform origin-bottom-left" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8V7a4 4 0 00-8 0v4h8z"></path></svg>
                    <span class="text-lg font-bold">Kelola Akun</span>
                </a>
            </nav>
        </aside>

        <!-- KONTEN UTAMA -->
        <main class="flex-1 flex flex-col h-screen relative z-10 overflow-hidden">
            
            <header class="h-20 bg-white border-b-4 border-black flex items-center justify-between px-8 z-30 shadow-[0_4px_0_0_rgba(0,0,0,1)] relative">
                <h2 class="text-2xl font-komik text-black tracking-widest drop-shadow-[1px_1px_0_#fff] mt-1">KELOLA AKUN LOGIN 🔐</h2>
                
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
                <div class="w-full max-w-5xl mx-auto">

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

                    <div class="bg-white border-4 border-black p-6 rounded-3xl shadow-[8px_8px_0_0_rgba(0,0,0,1)] mb-8 animate-pop comic-card">
                        <h3 class="text-3xl font-komik text-black tracking-widest uppercase">DAFTAR AKUN LOGIN</h3>
                        <p class="text-base font-bold text-slate-700 mt-1">Kelola akses sistem. Reset sandi kalau penghuni lupa password.</p>
                    </div>

                    <!-- TABEL AKUN -->
                    <div class="bg-white rounded-3xl border-4 border-black shadow-[8px_8px_0_0_rgba(0,0,0,1)] overflow-hidden animate-pop delay-100 comic-card">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-yellow-300 border-b-4 border-black text-black">
                                        <th class="py-5 px-6 text-xl font-komik tracking-widest uppercase border-r-4 border-black">NAMA AKUN</th>
                                        <th class="py-5 px-6 text-xl font-komik tracking-widest uppercase border-r-4 border-black">USERNAME</th>
                                        <th class="py-5 px-6 text-xl font-komik tracking-widest uppercase border-r-4 border-black">TANGGAL DAFTAR</th>
                                        <th class="py-5 px-6 text-xl font-komik tracking-widest uppercase text-right">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y-4 divide-black bg-white">
                                    @foreach($users as $user)
                                    <tr class="hover:bg-cyan-50 transition-colors group">
                                        <td class="py-5 px-6 border-r-4 border-black">
                                            <div class="flex items-center gap-4">
                                                <div class="w-12 h-12 rounded-full bg-cyan-300 border-2 border-black flex items-center justify-center font-komik text-xl shadow-[2px_2px_0_0_rgba(0,0,0,1)]">
                                                    {{ substr($user->name, 0, 1) }}
                                                </div>
                                                <span class="text-lg font-bold text-black uppercase">{{ $user->name }}</span>
                                            </div>
                                        </td>
                                        <td class="py-5 px-6 border-r-4 border-black">
                                            <span class="text-base font-bold text-black bg-slate-100 px-3 py-1 border-2 border-black rounded-lg">{{ $user->username }}</span>
                                        </td>
                                        <td class="py-5 px-6 border-r-4 border-black">
                                            <span class="text-base font-bold text-slate-700">{{ $user->created_at->format('d M Y') }}</span>
                                        </td>
                                        <td class="py-5 px-6 text-right">
                                            <div class="flex items-center justify-end gap-3">
                                                <button type="button" onclick="openResetModal({{ $user->id }}, '{{ $user->name }}')" class="px-4 py-2 bg-yellow-400 hover:bg-yellow-500 text-black text-sm font-bold uppercase rounded-xl border-2 border-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] comic-button transition-all">
                                                    RESET PASSWORD
                                                </button>
                                                @if($user->id != 1)
                                                <button type="button" onclick="openDeleteModal({{ $user->id }}, '{{ $user->name }}')" class="w-10 h-10 rounded-xl bg-red-500 text-white hover:bg-red-600 flex items-center justify-center border-2 border-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] comic-button transition-all">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
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

    <!-- BACKGROUND GELAP OVERLAY (PENTING BIAR MODAL MUNCUL) -->
    <div id="modalOverlay" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-40 hidden transition-opacity opacity-0 duration-300"></div>

    <!-- MODAL RESET PASSWORD -->
    <div id="modalResetBox" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 w-full max-w-sm hidden">
        <div class="bg-white rounded-[2rem] shadow-[12px_12px_0_0_rgba(0,0,0,1)] border-4 border-black overflow-hidden modal-enter w-full mx-4 sm:mx-0 text-center p-8 transform rotate-1">
            <div class="w-20 h-20 bg-yellow-300 text-black border-4 border-black rounded-full flex items-center justify-center mx-auto mb-6 shadow-[4px_4px_0_0_rgba(0,0,0,1)]">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
            </div>
            <h3 class="text-3xl font-komik text-black mb-2 tracking-widest">RESET PASSWORD?</h3>
            <p class="text-base font-bold text-black mb-6">Akun <span id="resetNamaLabel" class="bg-cyan-200 px-2 border-2 border-black inline-block transform rotate-1"></span> bakal balik ke setelan pabrik.</p>
            <div class="bg-black text-white p-4 rounded-xl mb-8 font-komik text-2xl tracking-widest transform -rotate-1">PASS: kos123</div>
            <form id="formReset" method="POST" class="flex gap-4">
                @csrf @method('PUT')
                <button type="button" onclick="closeModal('modalResetBox')" class="w-1/2 px-4 py-3 rounded-xl border-4 border-black bg-white hover:bg-slate-200 text-lg font-bold text-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] comic-button transition-all">BATAL</button>
                <button type="submit" class="w-1/2 px-4 py-3 rounded-xl bg-yellow-400 hover:bg-yellow-500 text-black text-xl font-komik tracking-widest border-4 border-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] comic-button transition-all">RESET!</button>
            </form>
        </div>
    </div>

    <!-- MODAL HAPUS AKUN -->
    <div id="modalDeleteBox" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 w-full max-w-sm hidden">
        <div class="bg-white rounded-[2rem] shadow-[12px_12px_0_0_rgba(0,0,0,1)] border-4 border-black overflow-hidden modal-enter w-full mx-4 sm:mx-0 text-center p-8 transform rotate-1">
            <div class="w-20 h-20 bg-red-500 text-white border-4 border-black rounded-full flex items-center justify-center mx-auto mb-6 shadow-[4px_4px_0_0_rgba(0,0,0,1)]">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            </div>
            <h3 class="text-3xl font-komik text-black mb-2 tracking-widest drop-shadow-[2px_2px_0_#fff]">HAPUS AKUN?!</h3>
            <p class="text-base font-bold text-black mb-8">Data <span id="deleteNamaLabel" class="bg-red-500 text-white px-2 border-2 border-black inline-block transform rotate-1"></span> bakal lenyap dari database!</p>
            <form id="formDelete" method="POST" class="flex gap-4">
                @csrf @method('DELETE')
                <button type="button" onclick="closeModal('modalDeleteBox')" class="w-1/2 px-4 py-3 rounded-xl border-4 border-black bg-white hover:bg-slate-200 text-lg font-bold text-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] comic-button transition-all">BATAL</button>
                <button type="submit" class="w-1/2 px-4 py-3 rounded-xl bg-red-500 hover:bg-red-600 text-white text-xl font-komik tracking-widest border-4 border-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] comic-button transition-all">HANCURKAN! 💣</button>
            </form>
        </div>
    </div>

    <!-- SCRIPT MODAL LENGKAP & AMAN -->
    <script>
        const overlay = document.getElementById('modalOverlay');

        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            const content = modal.querySelector('div');
            
            overlay.classList.remove('hidden');
            modal.classList.remove('hidden');
            
            setTimeout(() => {
                overlay.classList.remove('opacity-0');
                content.classList.remove('modal-enter');
                content.classList.add('modal-enter-active');
            }, 10);
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            const content = modal.querySelector('div');
            
            overlay.classList.add('opacity-0');
            content.classList.remove('modal-enter-active');
            content.classList.add('modal-leave-active');
            
            setTimeout(() => {
                overlay.classList.add('hidden');
                modal.classList.add('hidden');
                content.classList.remove('modal-leave-active');
                content.classList.add('modal-enter');
            }, 300);
        }

        function openResetModal(id, nama) {
            document.getElementById('formReset').action = `/admin/akun/${id}/reset-password`;
            document.getElementById('resetNamaLabel').innerText = nama;
            openModal('modalResetBox');
        }

        function openDeleteModal(id, nama) {
            document.getElementById('formDelete').action = `/admin/akun/${id}`;
            document.getElementById('deleteNamaLabel').innerText = nama;
            openModal('modalDeleteBox');
        }

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