<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Manajemen Kosan Pak Lalan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- FONT KOMIK DARI GOOGLE -->
    <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Comic+Neue:wght@400;700&display=swap" rel="stylesheet">
    
    <style>
        /* Pengaturan Font Komik */
        body { font-family: 'Comic Neue', cursive; font-weight: 700; }
        .font-komik { font-family: 'Bangers', cursive; letter-spacing: 2px; }
        
        /* Background Titik-Titik Ala Kertas Komik (Halftone) */
        .bg-halftone {
            background-color: #f8fafc;
            background-image: radial-gradient(#94a3b8 2px, transparent 2px);
            background-size: 24px 24px;
        }

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

        /* Efek kursor berkedip untuk teks ngetik */
        .typing-cursor::after {
            content: '|';
            color: #fbbf24; /* Warna kuning komik */
            animation: blink 1s step-start infinite;
        }
        @keyframes blink { 50% { opacity: 0; } }

        /* =========================================
           ANIMASI SWAP KIRI-KANAN (WEB3 STYLE)
           ========================================= */
        .slide-active #form-panel { transform: translateX(100%); }
        .slide-active #image-panel { transform: translateX(-100%); }
        
        /* Transisi Konten Dalam Form (Grid Trick) */
        .slide-active #login-content { opacity: 0; pointer-events: none; transform: translateX(-2rem) scale(0.95); transition-delay: 0ms; z-index: 0; }
        .slide-active #forgot-content { opacity: 1; pointer-events: auto; transform: translateX(0) scale(1); transition-delay: 200ms; z-index: 10; }
        
        /* Default state form */
        #forgot-content { opacity: 0; pointer-events: none; transform: translateX(2rem) scale(0.95); transition-delay: 0ms; z-index: 0; }
        #login-content { opacity: 1; transform: translateX(0) scale(1); transition-delay: 200ms; z-index: 10; }
    </style>
</head>
<body class="bg-halftone text-black antialiased overflow-hidden">
    
    <!-- WRAPPER UTAMA -->
    <div id="main-wrapper" class="min-h-screen relative w-full flex">
        
        <!-- ========================================== -->
        <!-- SISI KIRI: PANEL FORM (Bergeser ke Kanan) -->
        <!-- ========================================== -->
        <div id="form-panel" class="absolute top-0 left-0 w-full lg:w-1/2 h-screen flex flex-col justify-center items-center p-6 sm:p-10 z-30 transition-transform duration-[800ms] ease-[cubic-bezier(0.16,1,0.3,1)] overflow-y-auto">
            
            <!-- CARD GLASSMORPHISM -> BERUBAH JADI CARD KOMIK BRUTAL -->
            <div class="w-full max-w-md bg-white p-10 sm:p-12 rounded-[2rem] border-4 border-black shadow-[12px_12px_0_0_rgba(0,0,0,1)] relative z-10 transition-all duration-500 hover:-translate-y-1 hover:shadow-[16px_16px_0_0_rgba(0,0,0,1)]">
                
                <!-- HEADER LOGO -->
                <div class="flex items-center gap-4 mb-10 relative z-20">
                    <div class="w-14 h-14 bg-yellow-400 border-4 border-black rounded-full flex items-center justify-center shadow-[4px_4px_0_0_rgba(0,0,0,1)] shrink-0 transform -rotate-12">
                        <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                    </div>
                    <h1 class="text-4xl font-komik text-black tracking-widest drop-shadow-[2px_2px_0_#fff] mt-2">KOS LALAN</h1>
                </div>

                <!-- WRAPPER KONTEN (Pakai Grid Trick) -->
                <div class="relative w-full grid" style="grid-template-columns: 1fr;">
                    
                    <!-- ================================== -->
                    <!-- 1. KONTEN LOGIN -->
                    <!-- ================================== -->
                    <div id="login-content" class="row-start-1 col-start-1 w-full transition-all duration-500 ease-out">
                        <div class="mb-8">
                            <h2 class="text-4xl font-komik text-red-500 tracking-widest drop-shadow-[2px_2px_0_#000]">MASUK PORTAL! 🚀</h2>
                            <p class="text-black font-bold mt-2 text-lg border-b-4 border-black inline-block pb-1">Ketik username & sandi kamu di sini.</p>
                        </div>

                        <x-auth-session-status class="mb-4" :status="session('status')" />

                        @if (session('sukses'))
                            <div class="mb-6 p-4 rounded-xl bg-green-400 border-4 border-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] flex items-center gap-3 transform rotate-1">
                                <div class="w-8 h-8 bg-white border-2 border-black rounded-full flex items-center justify-center shrink-0 font-komik text-xl">!</div>
                                <p class="text-base font-bold text-black">{{ session('sukses') }}</p>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}" class="space-y-6">
                            @csrf
                            <div>
                                <label class="block text-xl font-komik text-black mb-2 tracking-wide">USERNAME</label>
                               <!-- Perhatikan class 'focus:placeholder-transparent' di bawah ini -->
                                <input type="text" name="username" placeholder="Username yang udah di buat" class="w-full px-4 py-3 bg-white comic-input text-lg font-bold placeholder-slate-400 focus:placeholder-transparent">
                                <x-input-error :messages="$errors->get('username')" class="mt-2 text-red-600 bg-red-100 border-2 border-red-600 px-2 py-1 inline-block font-bold text-sm transform -rotate-1" />
                            </div>

                            <div>
                                <label class="block text-xl font-komik text-black mb-2 tracking-wide">KATA SANDI</label>
                                <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" class="block w-full px-4 py-3 bg-white comic-input text-lg font-bold placeholder-slate-400">
                                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 bg-red-100 border-2 border-red-600 px-2 py-1 inline-block font-bold text-sm transform rotate-1" />
                            </div>

                            <div class="flex items-center justify-between pt-2">
                                <label class="flex items-center cursor-pointer group">
                                    <input type="checkbox" name="remember" class="w-5 h-5 border-4 border-black rounded-none text-black focus:ring-0 cursor-pointer shadow-[2px_2px_0_0_rgba(0,0,0,1)]">
                                    <span class="ml-3 text-base text-black font-bold group-hover:text-red-500 transition-colors">Ingat Saya</span>
                                </label>
                                
                                <!-- TRIGGER GESER KE KANAN -->
                                <button type="button" onclick="toggleSlide()" class="text-lg font-komik tracking-wider text-cyan-500 hover:text-cyan-600 drop-shadow-[1px_1px_0_#000] transition-colors transform hover:scale-110">
                                    LUPA SANDI?
                                </button>
                            </div>

                            <div class="pt-4">
                                <button type="submit" class="w-full flex justify-center py-4 px-4 border-4 border-black rounded-xl shadow-[6px_6px_0_0_rgba(0,0,0,1)] text-2xl tracking-widest font-komik text-black bg-yellow-400 hover:bg-yellow-500 transform hover:-translate-y-1 hover:shadow-[8px_8px_0_0_rgba(0,0,0,1)] active:translate-y-0 active:shadow-none transition-all">
                                    GAS MASUK! 💥
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- ================================== -->
                    <!-- 2. KONTEN LUPA PASSWORD -->
                    <!-- ================================== -->
                    <div id="forgot-content" class="row-start-1 col-start-1 w-full transition-all duration-500 ease-out flex flex-col justify-center relative">
                        
                        <!-- Ornamen Komik -->
                        <div class="absolute -top-6 -right-6 w-16 h-16 bg-red-500 border-4 border-black rounded-full flex items-center justify-center font-komik text-2xl text-white transform rotate-12 shadow-[4px_4px_0_0_rgba(0,0,0,1)] animate-bounce">
                            ?!
                        </div>

                        <div class="mb-8">
                            <h2 class="text-4xl font-komik text-cyan-500 tracking-widest drop-shadow-[2px_2px_0_#000]">WADUH LUPA? 🔐</h2>
                            <p class="text-black font-bold mt-2 text-lg">Tenang, hubungi Admin Kos Lalan buat reset sandi lu secara manual.</p>
                        </div>

                        <div class="p-6 rounded-2xl bg-cyan-100 border-4 border-black mb-8 shadow-[6px_6px_0_0_rgba(0,0,0,1)] transform -rotate-1">
                            <p class="text-base text-black font-bold leading-relaxed mb-6 text-center bg-white border-2 border-black p-2 rounded-lg transform rotate-2">
                                Klik tombol di bawah ini buat *chat* langsung ke WhatsApp Admin Kosan.
                            </p>
                            <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Kos%20Lalan,%20saya%20ingin%20meminta%20bantuan%20reset%20password." target="_blank" class="w-full flex items-center justify-center gap-2 py-4 bg-[#25D366] text-black text-xl font-komik tracking-widest rounded-xl border-4 border-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_rgba(0,0,0,1)] transition-all">
                                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 00-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                                CHAT ADMIN
                            </a>
                        </div>
                        
                        <button type="button" onclick="toggleSlide()" class="w-full py-4 bg-white border-4 border-black hover:bg-slate-100 text-black font-komik text-xl tracking-widest rounded-xl transition-all shadow-[4px_4px_0_0_rgba(0,0,0,1)] hover:-translate-y-1 active:translate-y-0 active:shadow-none">
                            BALIK KE LOGIN ⬅️
                        </button>
                    </div>

                </div> <!-- End Wrapper Konten -->
            </div>
        </div>

        <!-- ========================================== -->
        <!-- SISI KANAN: PANEL GAMBAR (Bergeser ke Kiri) -->
        <!-- ========================================== -->
        <div id="image-panel" class="hidden lg:block absolute top-0 right-0 w-1/2 h-screen z-20 pointer-events-none transition-transform duration-[800ms] ease-[cubic-bezier(0.16,1,0.3,1)] border-l-8 border-black">
            
            <div class="absolute inset-0 pointer-events-auto bg-cyan-500 flex flex-col items-center justify-center text-center overflow-hidden">
                <!-- Overlay Halftone Putih -->
                <div class="absolute inset-0 opacity-20 z-10 pointer-events-none" style="background-image: radial-gradient(#fff 3px, transparent 3px); background-size: 16px 16px;"></div>
                
                <img src="{{ asset('images/kos.jpeg') }}" alt="Bangunan Kos Lalan" class="absolute inset-0 w-full h-full object-cover z-0 mix-blend-multiply opacity-60 grayscale-[30%] contrast-125">
                
                <!-- Kotak Teks Komik -->
                <div class="relative z-20 p-10 max-w-xl text-black bg-yellow-300 border-4 border-black rounded-3xl shadow-[12px_12px_0_0_rgba(0,0,0,1)] transform rotate-2">
                    
                    <div class="absolute -top-5 -left-5 bg-red-500 text-white font-komik text-xl px-4 py-2 border-4 border-black rounded-full shadow-[4px_4px_0_0_rgba(0,0,0,1)] transform -rotate-12">
                        PROPERTI
                    </div>
                    
                    <!-- EFEK MESIN TIK KOMIK -->
                    <h2 id="typewriter-text" class="typing-cursor text-5xl font-komik tracking-widest mb-4 leading-tight text-black drop-shadow-[2px_2px_0_#fff] min-h-[96px] whitespace-pre-line mt-4"></h2>
                    
                    <p class="text-xl text-black font-bold leading-relaxed border-t-4 border-black border-dashed pt-4">
                        Sistem informasi modern untuk mantau kamar, penghuni, sampai tagihan secara <span class="bg-white px-1 border-2 border-black transform inline-block rotate-1">*real-time*</span> khusus Kos Lalan.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- SCRIPT ANIMASI & EFEK MESIN TIK -->
    <script>
        // FUNGSI SWAP WEB3 STYLE
        function toggleSlide() {
            const wrapper = document.getElementById('main-wrapper');
            wrapper.classList.toggle('slide-active');
        }

        // MESIN TIK SMOOTH
        document.addEventListener('DOMContentLoaded', function() {
            const textToType = "KELOLA KOS CERDAS,\nNYAMAN & TERPADU!";
            const targetElement = document.getElementById('typewriter-text');
            
            let i = 0;
            let isDeleting = false;

            function typeWriterSmooth() {
                let currentText = textToType.substring(0, i);
                targetElement.textContent = currentText;

                let typeSpeed = isDeleting ? 40 : 80;

                if (!isDeleting && i === textToType.length) {
                    typeSpeed = 2500; 
                    isDeleting = true; 
                } else if (isDeleting && i === 0) {
                    isDeleting = false; 
                    typeSpeed = 500; 
                }

                if (isDeleting) { i--; } else { i++; }
                setTimeout(typeWriterSmooth, typeSpeed);
            }

            setTimeout(typeWriterSmooth, 400); 
        });
    </script>
</body>
</html>