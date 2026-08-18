<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Penghuni - Kos Lalan</title>
    <!-- Ini yang bikin desainnya nyala -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 font-sans text-gray-900 antialiased">
    
    <!-- Navbar Estetik -->
    <nav class="bg-gradient-to-r from-emerald-600 to-teal-600 shadow-lg shadow-emerald-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex-shrink-0 flex items-center gap-3">
                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-md">
                        <span class="text-emerald-600 font-extrabold text-2xl">K</span>
                    </div>
                    <span class="text-white font-extrabold text-xl tracking-tight">Kos Lalan</span>
                </div>
                <div>
                    <!-- Tombol Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-white/10 hover:bg-white/20 text-white font-bold px-5 py-2.5 rounded-full text-sm transition-all duration-300 backdrop-blur-sm border border-white/20 shadow-sm">
                            Keluar Akun
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Konten Utama -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Ucapan Selamat Datang Dinamis -->
            <div class="mb-10">
                <h2 class="text-4xl font-extrabold text-gray-900 tracking-tight">Halo, {{ Auth::user()->name }}! 👋</h2>
                <p class="mt-2 text-base text-gray-500 font-medium">Selamat datang kembali di dashboard penghuni Kos Lalan.</p>
            </div>

            <!-- Kartu Informasi Kamar -->
            <div class="bg-white overflow-hidden shadow-[0_20px_50px_-15px_rgba(0,0,0,0.05)] sm:rounded-[2rem] border border-gray-100 transition-all duration-300 hover:shadow-xl hover:shadow-emerald-600/10">
                <div class="p-8 sm:p-12">
                    <div class="flex items-center gap-5 mb-8">
                        <div class="w-16 h-16 bg-emerald-50 rounded-2xl flex items-center justify-center border border-emerald-100">
                            <svg class="w-8 h-8 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900">Informasi Kamar Anda</h3>
                            <p class="text-sm font-medium text-gray-500 mt-1">Detail kamar yang saat ini Anda tempati.</p>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-emerald-50/50 to-teal-50/30 rounded-3xl p-8 border border-emerald-100/50 relative overflow-hidden">
                        <!-- Hiasan Background -->
                        <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-emerald-500/10 rounded-full blur-2xl"></div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 relative z-10">
                            <div>
                                <p class="text-sm font-bold text-emerald-800/70 mb-2 uppercase tracking-wider">Nomor Kamar</p>
                                <!-- INI DIA KODE PEMANGGIL DATA KAMAR DARI DATABASE -->
                                <p class="text-4xl font-extrabold text-emerald-600 drop-shadow-sm">
                                    {{ Auth::user()->nomor_kamar ?? 'Belum ada kamar' }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-emerald-800/70 mb-3 uppercase tracking-wider">Fasilitas Standar</p>
                                <div class="flex flex-wrap gap-3">
                                    <span class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-bold bg-white text-emerald-700 shadow-sm border border-emerald-100">❄️ AC</span>
                                    <span class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-bold bg-white text-emerald-700 shadow-sm border border-emerald-100">🛏️ Kasur</span>
                                    <span class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-bold bg-white text-emerald-700 shadow-sm border border-emerald-100">🚪 Lemari</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>
</html>