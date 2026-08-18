<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keluhan Penghuni - Admin Kos</title>
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
                
                <a href="{{ route('admin.tagihan.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.tagihan.*') ? 'bg-cyan-400 border-black translate-x-1 shadow-[4px_4px_0_0_rgba(0,0,0,1)]' : 'bg-white border-transparent hover:bg-yellow-200 hover:border-black hover:translate-x-1 hover:shadow-[4px_4px_0_0_rgba(0,0,0,1)]' }} border-2 rounded-xl transition-all group text-black">
                    <svg class="w-6 h-6 mr-3 group-hover:scale-125 transition-transform origin-bottom-left" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    <span class="text-lg font-bold">Tagihan & Kas</span>
                </a>

                <!-- MENU AKTIF DI SINI -->
                <a href="{{ route('admin.pengaduan.index') }}" class="flex items-center px-4 py-3 bg-cyan-400 border-black translate-x-1 shadow-[4px_4px_0_0_rgba(0,0,0,1)] border-2 rounded-xl transition-all group text-black">
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
                <h2 class="text-2xl font-komik text-black tracking-widest drop-shadow-[1px_1px_0_#fff] mt-1">LAPORAN MASUK 🚨</h2>
                
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

                    <div class="mb-8 bg-white border-4 border-black p-4 rounded-2xl shadow-[4px_4px_0_0_rgba(0,0,0,1)] transform rotate-1 opacity-0 animate-pop">
                        <h3 class="text-2xl font-komik text-black tracking-widest uppercase">KOTAK KELUHAN ANAK KOS</h3>
                        <p class="text-sm text-black font-bold mt-1">Pantau kerusakan fasilitas dan langsung atur status perbaikannya.</p>
                    </div>

                    <!-- KOTAK DAFTAR KELUHAN (COMIC BRUTAL STYLE) -->
                    <div class="space-y-6 opacity-0 animate-pop delay-100">
                        @forelse($pengaduans as $item)
                        <div class="bg-white rounded-3xl border-4 border-black shadow-[8px_8px_0_0_rgba(0,0,0,1)] p-6 md:p-8 flex flex-col md:flex-row gap-6 comic-card relative overflow-hidden">
                            
                            <!-- Ornamen stiker sudut -->
                            <div class="absolute -top-3 -right-3 bg-yellow-300 border-2 border-black px-3 py-1 font-komik text-sm transform rotate-12 shadow-[2px_2px_0_0_rgba(0,0,0,1)] z-10">TICKET #{{ $item->id }}</div>

                            <!-- INFO PENGHUNI & KAMAR -->
                            <div class="md:w-1/4 shrink-0 border-b-4 md:border-b-0 md:border-r-4 border-black border-dashed pb-4 md:pb-0 md:pr-6 flex flex-col justify-between">
                                <div>
                                    <div class="flex items-center gap-3 mb-3">
                                        <div class="w-12 h-12 rounded-full bg-cyan-300 border-2 border-black flex items-center justify-center font-komik text-xl shadow-[2px_2px_0_0_rgba(0,0,0,1)]">
                                            {{ strtoupper(substr($item->penghuni->nama ?? 'U', 0, 1)) }}
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-black text-base uppercase">{{ $item->penghuni->nama ?? 'Penghuni' }}</h4>
                                            <span class="bg-black text-white px-2 py-0.5 rounded text-xs font-bold border border-white">KM. {{ $item->penghuni->kamar->nomor_kamar ?? '-' }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-xs font-bold text-slate-500 bg-slate-100 p-2 rounded-xl border-2 border-black mt-4">
                                    🕒 {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y, H:i') }}
                                </div>
                            </div>

                            <!-- ISI KELUHAN & FOTO -->
                            <div class="md:w-1/2 flex-1">
                                <h3 class="text-2xl font-komik text-black tracking-wide uppercase mb-2">{{ $item->judul }}</h3>
                                <p class="text-base text-black font-bold bg-yellow-50 p-4 rounded-xl border-2 border-black shadow-inner mb-4 leading-relaxed">"{{ $item->deskripsi }}"</p>
                                
                                @if($item->foto)
                                <div class="mt-2">
                                    <p class="text-xs font-black text-black uppercase tracking-wider mb-2 bg-yellow-300 inline-block px-2 border-2 border-black transform -rotate-1">FOTO BUKTI KERUSAKAN:</p>
                                    <br>
                                    <a href="{{ asset('storage/' . $item->foto) }}" target="_blank" class="inline-block relative group mt-1">
                                        <img src="{{ asset('storage/' . $item->foto) }}" alt="Bukti" class="w-36 h-28 object-cover rounded-xl border-4 border-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] group-hover:scale-105 transition-all">
                                    </a>
                                </div>
                                @endif
                            </div>

                            <!-- UPDATE STATUS & HAPUS -->
                            <div class="md:w-1/4 shrink-0 flex flex-col justify-between border-t-4 md:border-t-0 md:border-l-4 border-black border-dashed pt-4 md:pt-0 md:pl-6">
                                <div>
                                    <label class="block text-sm font-bold text-black mb-2 uppercase">STATUS PERBAIKAN:</label>
                                    
                                    <!-- FORM UBAH STATUS -->
                                    <form action="{{ route('admin.pengaduan.updateStatus', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" onchange="this.form.submit()" class="w-full rounded-xl comic-input font-bold px-3 py-3 cursor-pointer text-base
                                            @if($item->status == 'Menunggu') bg-slate-100 text-black
                                            @elseif($item->status == 'Diproses') bg-yellow-300 text-black
                                            @else bg-green-400 text-black @endif">
                                            <option value="Menunggu" {{ $item->status == 'Menunggu' ? 'selected' : '' }}>⏳ Menunggu</option>
                                            <option value="Diproses" {{ $item->status == 'Diproses' ? 'selected' : '' }}>🛠️ Diproses</option>
                                            <option value="Selesai" {{ $item->status == 'Selesai' ? 'selected' : '' }}>✅ Selesai</option>
                                        </select>
                                    </form>
                                </div>

                                <!-- TOMBOL HAPUS -->
                                <div class="mt-4 flex justify-end">
                                    <form action="{{ route('admin.pengaduan.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="konfirmasiHapus(this)" class="w-12 h-12 bg-red-500 hover:bg-red-600 text-white rounded-xl border-2 border-black flex items-center justify-center shadow-[4px_4px_0_0_rgba(0,0,0,1)] comic-button transition-all" title="Hapus Laporan">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </div>

                        </div>
                        @empty
                        <div class="bg-white rounded-3xl border-4 border-black shadow-[8px_8px_0_0_rgba(0,0,0,1)] p-16 text-center transform rotate-1">
                            <div class="w-24 h-24 bg-yellow-300 border-4 border-black rounded-full flex items-center justify-center mx-auto mb-4 shadow-[4px_4px_0_0_rgba(0,0,0,1)] transform -rotate-6 animate-pulse">
                                <svg class="w-12 h-12 text-black" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path></svg>
                            </div>
                            <h3 class="text-4xl font-komik text-black tracking-widest">AMAN JAYA BRO!</h3>
                            <p class="text-xl font-bold text-slate-600 mt-2">Belum ada laporan keluhan masuk. Kosan tentram! 😎</p>
                        </div>
                        @endforelse
                    </div>

                </div>
            </div>
        </main>
    </div>

    <!-- SCRIPT DROPDOWN PROFIL -->
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
    </script>

    <!-- SCRIPT SWEETALERT2 STYLING KOMIK -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function konfirmasiHapus(button) {
            Swal.fire({
                html: `
                    <div class="flex flex-col items-center mt-2">
                        <div class="w-20 h-20 bg-red-500 text-white border-4 border-black rounded-full flex items-center justify-center font-komik text-4xl mb-4 shadow-[4px_4px_0_0_rgba(0,0,0,1)] transform rotate-12">
                            !
                        </div>
                        <h2 class="text-3xl font-komik text-black tracking-widest mb-2">HAPUS LAPORAN?</h2>
                        <p class="text-base font-bold text-black text-center leading-relaxed px-4 bg-yellow-200 border-2 border-black p-2 rounded-xl transform -rotate-1">Data keluhan ini bakal musnah permanen!</p>
                    </div>
                `,
                showCancelButton: true,
                confirmButtonText: 'HANCURKAN!',
                cancelButtonText: 'BATAL',
                buttonsStyling: false,
                customClass: {
                    popup: 'rounded-[2rem] p-6 w-[28rem] border-4 border-black shadow-[12px_12px_0_0_rgba(0,0,0,1)] bg-white',
                    htmlContainer: 'p-0 m-0',
                    actions: 'flex w-full gap-4 mt-6 px-2',
                    cancelButton: 'flex-1 bg-white border-4 border-black text-black hover:bg-slate-200 rounded-xl py-3 font-bold text-lg shadow-[4px_4px_0_0_rgba(0,0,0,1)] transition-all',
                    confirmButton: 'flex-1 bg-red-500 hover:bg-red-600 text-white border-4 border-black rounded-xl py-3 font-komik text-2xl tracking-widest shadow-[4px_4px_0_0_rgba(0,0,0,1)] transition-all',
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    button.closest('form').submit();
                }
            });
        }
    </script>
</body>
</html>