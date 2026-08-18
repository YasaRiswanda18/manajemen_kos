<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar - Manajemen Kos Lalan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Animasi CSS -->
    <style>
        @keyframes fadeUp {
            0% { opacity: 0; transform: translateY(40px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-up {
            animation: fadeUp 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        .animation-delay-200 { animation-delay: 200ms; }
        .animation-delay-800 { animation-delay: 800ms; }
        
        /* Efek kursor berkedip untuk teks ngetik */
        .typing-cursor::after {
            content: '|';
            color: #10b981; 
            animation: blink 1s step-start infinite;
        }
        @keyframes blink {
            50% { opacity: 0; }
        }
    </style>
</head>
<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex relative bg-gradient-to-br from-gray-50 via-emerald-50/20 to-emerald-100/40 overflow-hidden">
        
        <!-- SISI KIRI: Area Form -->
        <div class="w-full lg:w-[45%] min-h-screen flex flex-col justify-center items-center p-6 sm:p-12 relative z-10">
            
            <div class="absolute top-[20%] left-[20%] w-72 h-72 bg-emerald-400/20 rounded-full mix-blend-multiply filter blur-[80px]"></div>
            <div class="absolute bottom-[20%] right-[10%] w-72 h-72 bg-teal-300/20 rounded-full mix-blend-multiply filter blur-[80px]"></div>

            <div class="w-full max-w-md bg-white/95 backdrop-blur-3xl p-8 sm:p-10 rounded-[2.5rem] shadow-[0_0_50px_rgba(16,185,129,0.3)] border-2 border-emerald-400 relative z-10 transition-all duration-500 hover:shadow-[0_0_60px_rgba(16,185,129,0.45)]">
                
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-xl flex items-center justify-center shadow-lg shadow-emerald-200">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                    </div>
                    <h1 class="text-xl font-extrabold text-gray-800 tracking-tight">Kos Lalan</h1>
                </div>

                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Buat Akun Baru ✨</h2>
                    <p class="text-gray-500 mt-1 text-sm leading-relaxed">Silakan lengkapi data di bawah untuk mendaftar.</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <!-- Input NAMA LENGKAP -->
                    <div>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 text-gray-400 group-focus-within:text-emerald-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path>
                                </svg>
                            </div>
                            <!-- Perhatikan padding-nya agak dikurangi (py-3) agar form tidak terlalu panjang -->
                            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Nama Lengkap" 
                                class="block w-full pl-10 pr-4 py-3 bg-slate-50/50 border border-gray-200 rounded-2xl text-sm shadow-sm placeholder-gray-400 focus:outline-none focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all hover:bg-slate-50">
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-1 text-red-500 text-xs font-medium" />
                    </div>

                    <!-- Input USERNAME -->
                    <div>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 text-gray-400 group-focus-within:text-emerald-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <input id="username" type="text" name="username" value="{{ old('username') }}" required autocomplete="username" placeholder="Username" 
                                class="block w-full pl-10 pr-4 py-3 bg-slate-50/50 border border-gray-200 rounded-2xl text-sm shadow-sm placeholder-gray-400 focus:outline-none focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all hover:bg-slate-50">
                        </div>
                        <x-input-error :messages="$errors->get('username')" class="mt-1 text-red-500 text-xs font-medium" />
                    </div>

                    <!-- Input NOMOR KAMAR -->
                    <div>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 text-gray-400 group-focus-within:text-emerald-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                            </div>
                            <input id="nomor_kamar" type="text" name="nomor_kamar" value="{{ old('nomor_kamar') }}" required placeholder="Nomor Kamar (Contoh: Kamar 01)" 
                                class="block w-full pl-10 pr-4 py-3 bg-slate-50/50 border border-gray-200 rounded-2xl text-sm shadow-sm placeholder-gray-400 focus:outline-none focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all hover:bg-slate-50">
                        </div>
                        <x-input-error :messages="$errors->get('nomor_kamar')" class="mt-1 text-red-500 text-xs font-medium" />
                    </div>

                    <!-- Input PASSWORD -->
                    <div>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 text-gray-400 group-focus-within:text-emerald-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                            <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="Kata Sandi (Minimal 8 karakter)" 
                                class="block w-full pl-10 pr-4 py-3 bg-slate-50/50 border border-gray-200 rounded-2xl text-sm shadow-sm placeholder-gray-400 focus:outline-none focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all hover:bg-slate-50">
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-500 text-xs font-medium" />
                    </div>

                    <!-- Input KONFIRMASI PASSWORD -->
                    <div>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 text-gray-400 group-focus-within:text-emerald-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                            </div>
                            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi Kata Sandi" 
                                class="block w-full pl-10 pr-4 py-3 bg-slate-50/50 border border-gray-200 rounded-2xl text-sm shadow-sm placeholder-gray-400 focus:outline-none focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all hover:bg-slate-50">
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-red-500 text-xs font-medium" />
                    </div>

                    <!-- Tombol Submit -->
                    <div class="pt-2">
                        <button type="submit" class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-2xl shadow-lg shadow-emerald-600/30 text-sm font-extrabold text-white bg-gradient-to-r from-emerald-600 to-teal-500 hover:from-emerald-500 hover:to-teal-400 hover:shadow-xl hover:shadow-emerald-600/40 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transform hover:-translate-y-0.5 transition-all duration-300">
                            DAFTARKAN AKUN
                        </button>
                    </div>

                    <!-- Link ke Halaman Login -->
                    <p class="mt-6 text-center text-sm font-medium text-gray-600">
                        Sudah punya akun? 
                        <a href="{{ route('login') }}" class="font-bold text-emerald-600 hover:text-emerald-700 hover:underline transition duration-150 ease-in-out">
                            Masuk di sini
                        </a>
                    </p>
                </form>
            </div>
        </div>

        <!-- SISI KANAN: Area Gambar (SAMA PERSIS DENGAN LOGIN) -->
        <div class="hidden lg:block absolute inset-y-0 right-0 w-[65%] z-20 pointer-events-none" style="filter: drop-shadow(-20px 0px 40px rgba(4,47,46,0.3));">
            <div class="absolute inset-0 pointer-events-auto bg-emerald-950 flex flex-col items-center justify-center text-center" style="clip-path: circle(55vw at 100% 38%);">
                <img src="{{ asset('images/test.jpeg') }}" alt="Bangunan Kos Lalan" class="absolute inset-0 w-full h-full object-cover z-0">
                <div class="absolute inset-0 bg-emerald-950/40 z-10"></div>
                <div class="relative z-20 p-12 pl-24 max-w-xl text-white">
                    
                    <div class="opacity-0 animate-fade-up animation-delay-200 inline-flex items-center justify-center px-5 py-2 rounded-full bg-emerald-500/30 border border-emerald-400/50 text-emerald-50 text-xs font-bold tracking-wider uppercase mb-6 backdrop-blur-md shadow-sm">
                        Manajemen Properti
                    </div>
                    
                    <h2 id="typewriter-text" class="typing-cursor text-4xl font-extrabold mb-5 leading-tight text-white drop-shadow-lg min-h-[96px] whitespace-pre-line"></h2>
                    
                    <p class="opacity-0 animate-fade-up animation-delay-800 text-base text-emerald-50/90 leading-relaxed font-medium drop-shadow-md">
                        Sistem informasi modern untuk memantau kamar, data penghuni, hingga laporan pembayaran secara *real-time* khusus untuk Kos Lalan.
                    </p>
                </div>
            </div>
        </div>

    </div>

    <!-- SCRIPT EFEK MESIN TIK BERULANG (SAMA PERSIS DENGAN LOGIN) -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const textToType = "Kelola Kos Cerdas,\nNyaman, & Terpadu.";
            const targetElement = document.getElementById('typewriter-text');
            
            let i = 0;
            let isDeleting = false;

            function typeWriterSmooth() {
                let currentText = textToType.substring(0, i);
                targetElement.textContent = currentText;
                let typeSpeed = isDeleting ? 40 : 90;

                if (!isDeleting && i === textToType.length) {
                    typeSpeed = 3000; 
                    isDeleting = true; 
                } 
                else if (isDeleting && i === 0) {
                    isDeleting = false; 
                    typeSpeed = 500; 
                }

                if (isDeleting) {
                    i--; 
                } else {
                    i++; 
                }

                setTimeout(typeWriterSmooth, typeSpeed);
            }

            setTimeout(typeWriterSmooth, 400); 
        });
    </script>
</body>
</html>