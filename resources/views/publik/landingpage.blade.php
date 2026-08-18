<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kosan Pak Lalan - Eksklusif & Strategis</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FONT KOMIK DARI GOOGLE -->
    <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Comic+Neue:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Comic Neue', cursive; font-weight: 700; }
        .font-komik { font-family: 'Bangers', cursive; letter-spacing: 2px; }
        
        /* Background Halftone Kertas Komik */
        .bg-halftone {
            background-color: #f8fafc;
            background-image: radial-gradient(#94a3b8 2px, transparent 2px);
            background-size: 24px 24px;
        }

        /* Animasi Modal Komik */
        .modal-active { display: flex !important; animation: popIn 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards; }
        @keyframes popIn { 
            from { opacity: 0; transform: scale(0.8); } 
            to { opacity: 1; transform: scale(1); } 
        }

        .comic-hover:hover { transform: translate(-4px, -4px); box-shadow: 8px 8px 0px 0px rgba(0,0,0,1); }
    </style>
</head>
<body class="bg-halftone text-black antialiased selection:bg-yellow-300 selection:text-black overflow-x-hidden">

    <!-- NAVBAR KOMIK -->
    <nav class="fixed w-full z-40 top-0 bg-white border-b-4 border-black shadow-[0_4px_0_0_rgba(0,0,0,1)] transition-all duration-300">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-3 cursor-pointer group">
                <div class="w-12 h-12 bg-yellow-400 border-2 border-black rounded-full flex items-center justify-center font-komik text-2xl text-black shadow-[2px_2px_0_0_rgba(0,0,0,1)] group-hover:rotate-12 transition-transform">
                    KL
                </div>
                <span class="font-komik text-3xl tracking-widest text-black drop-shadow-[2px_2px_0_#fff]">KOSAN LALAN</span>
            </div>
            
            <a href="{{ route('login') }}" class="px-6 py-2.5 font-komik text-xl tracking-widest text-black bg-cyan-400 border-4 border-black rounded-xl shadow-[4px_4px_0_0_rgba(0,0,0,1)] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_rgba(0,0,0,1)] active:translate-y-0 active:shadow-none transition-all flex items-center gap-2">
                MASUK PORTAL! 🚀
            </a>
        </div>
    </nav>

    <!-- HERO SECTION (TEKS KIRI + FOTO KANAN) -->
    <section class="relative pt-36 pb-20 lg:pt-48 lg:pb-24 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                
                <!-- Teks Kiri -->
                <div class="text-center lg:text-left relative z-20">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-yellow-300 border-4 border-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] text-black font-bold mb-8 transform -rotate-2 animate-bounce mx-auto lg:mx-0">
                        <span class="text-xl font-komik">🔥 SISA 2 KAMAR KOSONG!</span>
                    </div>
                    
                    <h1 class="text-6xl md:text-7xl font-komik text-black tracking-widest leading-[1.1] mb-6 drop-shadow-[4px_4px_0_#fff]">
                        TINGGAL NYAMAN,<br>
                        <span class="text-red-500 drop-shadow-[4px_4px_0_#000] text-7xl md:text-8xl">FOKUS MASA DEPAN!</span>
                    </h1>
                    
                    <p class="text-xl text-black font-bold mb-10 leading-relaxed max-w-lg mx-auto lg:mx-0 bg-white p-4 border-4 border-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] rounded-2xl transform rotate-1">
                        Fasilitas lengkap, manajemen cerdas, dan lingkungan tenang!
                    </p>
                    
                    <div class="flex flex-col sm:flex-row justify-center lg:justify-start gap-6">
                        <a href="#tipe-kamar" class="px-8 py-4 bg-green-400 text-black font-komik text-2xl tracking-widest rounded-xl border-4 border-black shadow-[6px_6px_0_0_rgba(0,0,0,1)] hover:-translate-y-1 hover:shadow-[8px_8px_0_0_rgba(0,0,0,1)] active:translate-y-0 active:shadow-none transition-all text-center">
                            LIHAT KAMAR 👀
                        </a>
                        <a href="#kontak" class="px-8 py-4 bg-white text-black font-komik text-2xl tracking-widest rounded-xl border-4 border-black shadow-[6px_6px_0_0_rgba(0,0,0,1)] hover:-translate-y-1 hover:shadow-[8px_8px_0_0_rgba(0,0,0,1)] active:translate-y-0 active:shadow-none transition-all text-center transform rotate-1">
                            LOKASI & KONTAK 📍
                        </a>
                    </div>
                </div>

                <!-- Gambar Kanan -->
                <div class="relative mt-10 lg:mt-0">
                    <!-- Aksen Starburst -->
                    <div class="absolute -top-10 -right-10 bg-red-500 w-32 h-32 rounded-full border-4 border-black flex items-center justify-center shadow-[4px_4px_0_0_rgba(0,0,0,1)] transform rotate-12 z-20 animate-pulse">
                        <span class="font-komik text-white text-3xl">BOOM!</span>
                    </div>

                    <!-- Foto Utama -->
                    <div class="relative rounded-3xl overflow-hidden border-8 border-black shadow-[12px_12px_0_0_rgba(0,0,0,1)] group bg-white comic-hover">
                        <div class="absolute inset-0 bg-cyan-400 opacity-20 pointer-events-none" style="background-image: repeating-linear-gradient(45deg, #000 0, #000 2px, transparent 2px, transparent 8px);"></div>
                        <img src="{{ asset('images/kos.jpeg') }}" alt="Depan Kosan" class="w-full h-[400px] lg:h-[500px] object-cover group-hover:scale-105 transition-transform duration-500 relative z-10 opacity-90">
                        
                        <!-- Label Melayang -->
                        <div class="absolute bottom-6 left-6 bg-yellow-300 border-4 border-black px-4 py-2 rounded-xl shadow-[4px_4px_0_0_rgba(0,0,0,1)] font-komik text-xl text-black z-20 transform -rotate-3">
                            TAMPAK DEPAN KOSAN
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- GALERI KOMIK -->
    <section class="py-20 bg-cyan-100 border-y-4 border-black relative overflow-hidden">
        <!-- Pola Garis Kecepatan -->
        <div class="absolute inset-0 opacity-10 pointer-events-none" style="background-image: repeating-linear-gradient(90deg, transparent, transparent 40px, #000 40px, #000 42px);"></div>
        
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="text-center mb-16 relative inline-block left-1/2 transform -translate-x-1/2 bg-white border-4 border-black px-10 py-4 rounded-3xl shadow-[8px_8px_0_0_rgba(0,0,0,1)] -rotate-1">
                <h2 class="text-5xl font-komik text-black tracking-widest">INTIP SUASANA KOSANLALAN</h2>
                <p class="text-lg font-bold mt-2 text-slate-600">Bersih, rapi, dan fasilitas bersama selalu terawat!</p>
            </div>

            <!-- Grid Foto Masonry Brutal -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <!-- Foto 1 -->
                <div class="col-span-2 row-span-2 group overflow-hidden rounded-2xl border-4 border-black shadow-[6px_6px_0_0_rgba(0,0,0,1)] relative h-80 md:h-[420px] comic-hover bg-white p-2">
                    <img src="https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?auto=format&fit=crop&w=800&q=80" alt="Kamar" class="w-full h-full object-cover rounded-xl group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute top-4 left-4 bg-yellow-300 border-4 border-black font-komik text-2xl px-3 py-1 rounded shadow-[2px_2px_0_0_rgba(0,0,0,1)] transform -rotate-3 z-10">KAMAR NYAMAN</div>
                </div>
                <!-- Foto 2 -->
                <div class="group overflow-hidden rounded-2xl border-4 border-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] relative h-40 md:h-52 comic-hover bg-white p-2">
                    <img src="https://images.unsplash.com/photo-1556910103-1c02745aae4d?auto=format&fit=crop&w=600&q=80" alt="Dapur" class="w-full h-full object-cover rounded-xl group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute bottom-2 left-2 bg-white border-2 border-black font-komik text-lg px-2 py-0.5 rounded shadow-[2px_2px_0_0_rgba(0,0,0,1)] z-10">DAPUR BERSAMA</div>
                </div>
                <!-- Foto 3 -->
                <div class="group overflow-hidden rounded-2xl border-4 border-black shadow-[4px_4px_0_0_rgba(0,0,0,1)] relative h-40 md:h-52 comic-hover bg-white p-2">
                    <img src="https://images.unsplash.com/photo-1584622650111-993a426fbf0a?auto=format&fit=crop&w=600&q=80" alt="Kamar Mandi" class="w-full h-full object-cover rounded-xl group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute bottom-2 left-2 bg-white border-2 border-black font-komik text-lg px-2 py-0.5 rounded shadow-[2px_2px_0_0_rgba(0,0,0,1)] z-10">WC BERSIH</div>
                </div>
                <!-- Foto 4 -->
                <div class="col-span-2 group overflow-hidden rounded-2xl border-4 border-black shadow-[6px_6px_0_0_rgba(0,0,0,1)] relative h-40 md:h-52 comic-hover bg-white p-2">
                    <img src="https://images.unsplash.com/photo-1513694203232-719a280e022f?auto=format&fit=crop&w=800&q=80" alt="Parkir" class="w-full h-full object-cover rounded-xl group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute bottom-4 right-4 bg-green-400 border-4 border-black font-komik text-xl px-3 py-1 rounded shadow-[2px_2px_0_0_rgba(0,0,0,1)] transform rotate-2 z-10">PARKIRAN LUAS!</div>
                </div>
            </div>
        </div>
    </section>

    <!-- TIPE KAMAR (KARTU KOMIK 3 GRID) -->
    <section id="tipe-kamar" class="py-24 bg-white relative">
        <div class="max-w-5xl mx-auto px-6 relative z-10">
            <div class="text-center mb-16 relative inline-block left-1/2 transform -translate-x-1/2 bg-yellow-300 border-4 border-black px-10 py-4 rounded-3xl shadow-[8px_8px_0_0_rgba(0,0,0,1)] rotate-1">
                <h2 class="text-5xl font-komik text-black tracking-widest">PILIHAN Kamar Kamu</h2>
                <p class="text-lg font-bold mt-2 text-slate-700">Klik kartu buat lihat fasilitas super lengkapnya!</p>
            </div>

            <div class="grid md:grid-cols-2 gap-10">
                
                <!-- CARD STANDAR -->
                <div onclick="bukaModal('modal-standar')" class="bg-yellow-200 border-4 border-black rounded-[2rem] overflow-hidden shadow-[8px_8px_0_0_rgba(0,0,0,1)] cursor-pointer group flex flex-col comic-hover relative">
                    
                    <div class="h-56 grid grid-cols-3 gap-1 bg-black p-1 border-b-4 border-black">
                        <!-- Foto Utama -->
                        <div class="col-span-2 relative overflow-hidden bg-white">
                            <img src="https://images.unsplash.com/photo-1554995207-c18c203602cb?auto=format&fit=crop&w=800&q=80" class="w-full h-full object-cover opacity-90 group-hover:scale-105 transition-transform duration-500">
                        </div>
                        <!-- Foto Kecil -->
                        <div class="col-span-1 grid grid-rows-2 gap-1">
                            <div class="relative overflow-hidden bg-white">
                                <img src="https://images.unsplash.com/photo-1556910103-1c02745aae4d?auto=format&fit=crop&w=400&q=80" class="w-full h-full object-cover opacity-90 group-hover:scale-110 transition-transform duration-500">
                            </div>
                            <div class="relative overflow-hidden bg-white">
                                <img src="https://images.unsplash.com/photo-1584622650111-993a426fbf0a?auto=format&fit=crop&w=400&q=80" class="w-full h-full object-cover opacity-90 group-hover:scale-110 transition-transform duration-500">
                            </div>
                        </div>
                        
                        <!-- Overlay Klik -->
                        <div class="absolute inset-0 z-10 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <span class="bg-white border-4 border-black font-komik text-2xl px-6 py-2 rounded-xl transform -rotate-3 shadow-[4px_4px_0_0_rgba(0,0,0,1)]">CEK DETAIL! 👀</span>
                        </div>
                    </div>
                    
                    <div class="p-8 text-center bg-white relative">
                        <div class="absolute -top-6 left-1/2 transform -translate-x-1/2 bg-white border-4 border-black font-komik text-xl px-4 py-1 rounded-full shadow-[2px_2px_0_0_rgba(0,0,0,1)]">3x3 Meter</div>
                        <h3 class="text-4xl font-komik text-black mb-2 mt-4 tracking-widest">STANDAR ROOM</h3>
                        <p class="font-komik text-3xl text-green-500 drop-shadow-[1px_1px_0_#000]">Rp 650.000 <span class="text-lg text-black font-sans font-bold">/ bulan</span></p>
                    </div>
                </div>

                <!-- CARD VIP -->
                <div onclick="bukaModal('modal-vip')" class="bg-cyan-200 border-4 border-black rounded-[2rem] overflow-hidden shadow-[8px_8px_0_0_rgba(0,0,0,1)] cursor-pointer group flex flex-col relative comic-hover transform md:-translate-y-6">
                    
                    <!-- Laris Badge -->
                    <div class="absolute -top-4 -left-4 bg-red-500 border-4 border-black text-white font-komik text-xl px-4 py-2 rounded-xl transform -rotate-12 shadow-[4px_4px_0_0_rgba(0,0,0,1)] z-20 animate-pulse">
                        🔥 PALING LARIS!
                    </div>

                    <div class="h-56 grid grid-cols-3 gap-1 bg-black p-1 border-b-4 border-black relative">
                        <div class="col-span-2 relative overflow-hidden bg-white">
                            <img src="https://images.unsplash.com/photo-1505691938895-1758d7feb511?auto=format&fit=crop&w=800&q=80" class="w-full h-full object-cover opacity-90 group-hover:scale-105 transition-transform duration-500">
                        </div>
                        <div class="col-span-1 grid grid-rows-2 gap-1">
                            <div class="relative overflow-hidden bg-white">
                                <img src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?auto=format&fit=crop&w=400&q=80" class="w-full h-full object-cover opacity-90 group-hover:scale-110 transition-transform duration-500">
                            </div>
                            <div class="relative overflow-hidden bg-white">
                                <img src="https://images.unsplash.com/photo-1620626011761-996317b8d101?auto=format&fit=crop&w=400&q=80" class="w-full h-full object-cover opacity-90 group-hover:scale-110 transition-transform duration-500">
                            </div>
                        </div>
                        
                        <div class="absolute inset-0 z-10 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <span class="bg-yellow-300 border-4 border-black font-komik text-2xl px-6 py-2 rounded-xl transform rotate-3 shadow-[4px_4px_0_0_rgba(0,0,0,1)]">INTIP VIP! ✨</span>
                        </div>
                    </div>
                    
                    <div class="p-8 text-center bg-white relative">
                        <div class="absolute -top-6 left-1/2 transform -translate-x-1/2 bg-black border-4 border-white text-white font-komik text-xl px-4 py-1 rounded-full shadow-[2px_2px_0_0_rgba(0,0,0,1)]">4x4 Meter</div>
                        <h3 class="text-4xl font-komik text-black mb-2 mt-4 tracking-widest">VIP ROOM ⭐️</h3>
                        <p class="font-komik text-3xl text-red-500 drop-shadow-[1px_1px_0_#000]">Rp 850.000 <span class="text-lg text-black font-sans font-bold">/ bulan</span></p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- LOKASI & KONTAK -->
    <section id="kontak" class="py-24 bg-red-400 border-y-4 border-black relative overflow-hidden">
        <!-- Halftone Pattern Over Red -->
        <div class="absolute inset-0 opacity-20 pointer-events-none" style="background-image: radial-gradient(#000 2px, transparent 2px); background-size: 24px 24px;"></div>

        <div class="max-w-6xl mx-auto px-6 relative z-10">
            <div class="grid md:grid-cols-2 gap-12 items-center bg-white border-4 border-black rounded-[3rem] p-8 md:p-12 shadow-[12px_12px_0_0_rgba(0,0,0,1)] transform rotate-1">
                
                <!-- Info Kontak -->
                <div class="transform -rotate-1">
                    <h2 class="text-5xl font-komik text-black mb-6 tracking-widest">MINAT NGEKOS?</h2>
                    <p class="text-xl font-bold text-slate-700 mb-8 bg-yellow-100 p-4 border-4 border-black rounded-xl">Jangan sampai kehabisan kamar Bro! Langsung WA Pak Lalan buat janjian survei sekarang juga!</p>
                    
                    <div class="mb-8 p-4 border-4 border-black rounded-2xl flex items-start gap-4 bg-cyan-50">
                        <div class="w-12 h-12 bg-black text-white rounded-full flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                        </div>
                        <div>
                            <h4 class="font-komik text-2xl text-black tracking-wider">LOKASI KITA</h4>
                            <p class="font-bold text-slate-700 mt-1">Jl. Cijati Asri Jayawaras Kec. Tarogong Kidul, Kabupaten Garut, Jawa Barat 44151<br>Perumahan Cijati Asri Kosan Pak Lalan</p>
                        </div>
                    </div>

                    <a href="https://wa.me/6281234567890?text=Halo%20Pak%20Lalan,%20saya%20tertarik%20dengan%20kamar%20kosannya." target="_blank" class="inline-flex items-center gap-3 px-8 py-4 bg-[#25D366] text-white font-komik text-2xl tracking-widest rounded-xl border-4 border-black shadow-[6px_6px_0_0_rgba(0,0,0,1)] hover:-translate-y-1 hover:shadow-[8px_8px_0_0_rgba(0,0,0,1)] active:translate-y-0 active:shadow-none transition-all w-full md:w-auto justify-center">
                        <svg class="w-8 h-8 fill-current" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 00-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                        CHAT WHATSAPP
                    </a>
                </div>

                <!-- Google Maps (Brutalist Wrapper) -->
                <div class="h-[400px] w-full rounded-2xl overflow-hidden border-8 border-black shadow-[8px_8px_0_0_rgba(0,0,0,1)] bg-white p-2 transform rotate-1">
                    <div class="w-full h-full rounded-xl overflow-hidden relative border-4 border-black">
                        <iframe src="https://www.google.com/maps/embed?pb=!4v1786828455189!6m8!1m7!1s6277B_FKrK8irFHeZO4qgw!2m2!1d-7.208838030695027!2d107.8933190213667!3f153.82080548712665!4f-18.106931647398326!5f0.7820865974627469" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- FOOTER KOMIK -->
    <footer class="bg-black py-8 text-center">
        <h2 class="font-komik text-2xl text-white tracking-widest mb-2">KOSAN LALAN © 2026</h2>
        <p class="text-sm font-bold text-slate-400">Dibangun dengan brutalitas koding oleh Sistem Manajemen Kos.</p>
    </footer>

    <!-- ============================================== -->
    <!-- MODAL POPUP DETAIL KAMAR (COMIC STYLE) -->
    <!-- ============================================== -->

    <!-- Modal Standar -->
    <div id="modal-standar" class="fixed inset-0 z-[100] hidden flex-col items-center justify-center bg-black/60 backdrop-blur-sm p-4 transition-all">
        <div class="bg-white rounded-[2rem] w-full max-w-2xl border-4 border-black shadow-[12px_12px_0_0_rgba(0,0,0,1)] relative overflow-hidden transform -rotate-1">
            <button onclick="tutupModal('modal-standar')" class="absolute top-4 right-4 z-20 w-12 h-12 bg-red-500 border-4 border-black text-white rounded-full flex items-center justify-center font-komik text-xl hover:scale-110 shadow-[4px_4px_0_0_rgba(0,0,0,1)] transition-transform">X</button>
            
            <div class="h-64 grid grid-cols-3 gap-1 bg-black p-1 border-b-4 border-black relative">
                <div class="absolute inset-0 bg-yellow-400 opacity-20 pointer-events-none" style="background-image: repeating-linear-gradient(45deg, #000 0, #000 2px, transparent 2px, transparent 8px);"></div>
                <div class="col-span-2 relative bg-white"><img src="https://images.unsplash.com/photo-1554995207-c18c203602cb?auto=format&fit=crop&w=800&q=80" class="w-full h-full object-cover opacity-90"><div class="absolute bottom-2 left-2 bg-yellow-300 border-2 border-black font-komik px-2 py-1 rounded text-black text-lg">KAMAR</div></div>
                <div class="col-span-1 grid grid-rows-2 gap-1">
                    <div class="relative bg-white"><img src="https://images.unsplash.com/photo-1556910103-1c02745aae4d?auto=format&fit=crop&w=400&q=80" class="w-full h-full object-cover opacity-90"><div class="absolute bottom-2 left-2 bg-white border-2 border-black font-komik px-2 py-1 rounded text-black">DAPUR</div></div>
                    <div class="relative bg-white"><img src="https://images.unsplash.com/photo-1584622650111-993a426fbf0a?auto=format&fit=crop&w=400&q=80" class="w-full h-full object-cover opacity-90"><div class="absolute bottom-2 left-2 bg-white border-2 border-black font-komik px-2 py-1 rounded text-black">WC</div></div>
                </div>
            </div>
            
            <div class="p-8 bg-yellow-50 relative">
                <h3 class="text-5xl font-komik text-black mb-2 tracking-widest drop-shadow-[2px_2px_0_#fff]">STANDAR ROOM</h3>
                <p class="text-3xl font-komik text-green-600 mb-6 drop-shadow-[1px_1px_0_#000]">Rp 650.000 / bln</p>
                
                <div class="bg-white border-4 border-black p-4 rounded-xl shadow-[4px_4px_0_0_rgba(0,0,0,1)]">
                    <h4 class="font-komik text-2xl text-black mb-3 border-b-4 border-dotted border-black pb-2">FASILITAS:</h4>
                    <ul class="grid grid-cols-2 gap-4 text-black font-bold text-lg">
                        <li class="flex gap-2 items-center">✅ Kasur Busa</li>
                        <li class="flex gap-2 items-center">✅ Kipas Angin</li>
                        <li class="flex gap-2 items-center">✅ WC Luar</li>
                        <li class="flex gap-2 items-center">✅ Lemari Baju</li>
                        <li class="flex gap-2 items-center">✅ Meja Lesehan</li>
                        <li class="flex gap-2 items-center">✅ Free Listrik Air</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal VIP -->
    <div id="modal-vip" class="fixed inset-0 z-[100] hidden flex-col items-center justify-center bg-black/60 backdrop-blur-sm p-4 transition-all">
        <div class="bg-cyan-100 rounded-[2rem] w-full max-w-2xl border-4 border-black shadow-[12px_12px_0_0_rgba(0,0,0,1)] relative overflow-hidden transform rotate-1">
            <button onclick="tutupModal('modal-vip')" class="absolute top-4 right-4 z-20 w-12 h-12 bg-red-500 border-4 border-black text-white rounded-full flex items-center justify-center font-komik text-xl hover:scale-110 shadow-[4px_4px_0_0_rgba(0,0,0,1)] transition-transform">X</button>
            
            <div class="h-64 grid grid-cols-3 gap-1 bg-black p-1 border-b-4 border-black relative">
                <div class="col-span-2 relative bg-white"><img src="https://images.unsplash.com/photo-1505691938895-1758d7feb511?auto=format&fit=crop&w=800&q=80" class="w-full h-full object-cover opacity-90"><div class="absolute bottom-2 left-2 bg-yellow-300 border-2 border-black font-komik px-2 py-1 rounded text-black text-lg">KAMAR VIP</div></div>
                <div class="col-span-1 grid grid-rows-2 gap-1">
                    <div class="relative bg-white"><img src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?auto=format&fit=crop&w=400&q=80" class="w-full h-full object-cover opacity-90"><div class="absolute bottom-2 left-2 bg-white border-2 border-black font-komik px-2 py-1 rounded text-black">LIVING AREA</div></div>
                    <div class="relative bg-white"><img src="https://images.unsplash.com/photo-1620626011761-996317b8d101?auto=format&fit=crop&w=400&q=80" class="w-full h-full object-cover opacity-90"><div class="absolute bottom-2 left-2 bg-white border-2 border-black font-komik px-2 py-1 rounded text-black">WC DALAM</div></div>
                </div>
            </div>
            
            <div class="p-8 relative">
                <h3 class="text-5xl font-komik text-black mb-2 tracking-widest drop-shadow-[2px_2px_0_#fff]">VIP ROOM ⭐️</h3>
                <p class="text-3xl font-komik text-red-500 mb-6 drop-shadow-[1px_1px_0_#000]">Rp 1.200.000 / bln</p>
                
                <div class="bg-white border-4 border-black p-4 rounded-xl shadow-[4px_4px_0_0_rgba(0,0,0,1)]">
                    <h4 class="font-komik text-2xl text-black mb-3 border-b-4 border-dotted border-black pb-2">FASILITAS SULTAN:</h4>
                    <ul class="grid grid-cols-2 gap-4 text-black font-bold text-lg">
                        <li class="flex gap-2 items-center">✨ Springbed Queen</li>
                        <li class="flex gap-2 items-center">✨ AC Dingin Pol</li>
                        <li class="flex gap-2 items-center">✨ WC Dalam Eksklusif</li>
                        <li class="flex gap-2 items-center">✨ Meja Kerja Besar</li>
                        <li class="flex gap-2 items-center">✨ Lemari 2 Pintu</li>
                        <li class="flex gap-2 items-center">✨ Free Listrik Air</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- SCRIPT BUKA TUTUP MODAL -->
    <script>
        function bukaModal(id) {
            document.getElementById(id).classList.remove('hidden');
            document.getElementById(id).classList.add('modal-active');
            document.body.style.overflow = 'hidden'; 
        }
        function tutupModal(id) {
            document.getElementById(id).classList.add('hidden');
            document.getElementById(id).classList.remove('modal-active');
            document.body.style.overflow = 'auto'; 
        }
        window.onclick = function(event) {
            if (event.target.id === 'modal-standar') tutupModal('modal-standar');
            if (event.target.id === 'modal-vip') tutupModal('modal-vip');
        }
    </script>

</body>
</html>