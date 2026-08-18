<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan - Kos Lalan</title>
    
    <!-- FONT KOMIK -->
    <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Comic+Neue:wght@400;700&display=swap" rel="stylesheet">
    
    <style>
        /* Paksa Printer Cetak Warna Background! */
        * {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        body { 
            font-family: 'Comic Neue', cursive; 
            font-weight: 700; 
            color: #000; 
            line-height: 1.5; 
            padding: 30px; 
            background-color: #fff;
        }
        
        .font-komik { font-family: 'Bangers', cursive; letter-spacing: 2px; }

        /* HEADER KOMIK BRUTAL */
        .header-box { 
            text-align: center; 
            margin-bottom: 30px; 
            border: 4px solid #000; 
            background-color: #fde047; /* Kuning Komik */
            padding: 15px; 
            box-shadow: 8px 8px 0px 0px #000;
            transform: rotate(-1deg);
        }
        .header-box h1 { margin: 0; font-size: 36px; color: #000; }
        .header-box p { margin: 5px 0 0 0; color: #000; font-size: 16px; border-top: 3px dashed #000; padding-top: 5px; text-transform: uppercase; }
        
        /* INFO FILTER */
        .info-filter { 
            margin-bottom: 20px; 
            font-size: 14px; 
            border: 3px solid #000;
            padding: 10px 15px;
            display: inline-block;
            box-shadow: 4px 4px 0px 0px #000;
            transform: rotate(1deg);
        }

        /* TABEL KOMIK */
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-bottom: 30px; 
            border: 4px solid #000;
            box-shadow: 8px 8px 0px 0px #000;
        }
        th, td { border: 3px solid #000; padding: 12px; text-align: left; }
        th { 
            background-color: #22d3ee; /* Cyan Komik */
            color: #000; 
            font-family: 'Bangers', cursive;
            font-size: 20px; 
            letter-spacing: 1px;
            text-transform: uppercase; 
        }
        td { font-size: 15px; background-color: #fff; }
        
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        
        /* BADGE STATUS */
        .badge { 
            padding: 4px 8px; 
            border: 3px solid #000; 
            font-weight: bold; 
            font-size: 12px;
            text-transform: uppercase;
            box-shadow: 3px 3px 0px 0px #000;
            display: inline-block;
            transform: rotate(-2deg);
        }
        .badge-lunas { background-color: #4ade80; color: #000; }
        .badge-tunggak { background-color: #ef4444; color: #fff; transform: rotate(2deg); }
        
        /* KOTAK TOTAL DUIT */
        .total-box { 
            float: right; 
            border: 4px solid #000; 
            padding: 15px 30px; 
            background-color: #4ade80; /* Hijau Duit */
            box-shadow: 6px 6px 0px 0px #000;
            transform: rotate(-1deg);
        }
        .total-box span { display: block; font-size: 14px; font-weight: bold; color: #000; text-transform: uppercase; border-bottom: 3px dashed #000; padding-bottom: 5px; margin-bottom: 5px; }
        .total-box strong { font-family: 'Bangers', cursive; font-size: 28px; letter-spacing: 1px; }
        
        .clear { clear: both; }
        
        /* TANDA TANGAN ADMIN */
        .footer { margin-top: 60px; float: right; text-align: center; width: 250px; }
        .ttd-box { 
            border: 4px solid #000; 
            padding: 10px; 
            margin-top: 60px; 
            background-color: #fff;
            box-shadow: 4px 4px 0px 0px #000;
            transform: rotate(2deg);
            font-size: 16px;
        }
        .ttd-stamp {
            position: absolute;
            color: red;
            font-family: 'Bangers', cursive;
            font-size: 24px;
            border: 3px solid red;
            padding: 2px 10px;
            border-radius: 10px;
            transform: rotate(-15deg);
            margin-top: -45px;
            margin-left: 20px;
            opacity: 0.8;
        }
    </style>
</head>
<body onload="window.print()">

    <!-- HEADER LAPORAN -->
    <div class="header-box">
        <h1 class="font-komik">KOS LALAN</h1>
        <p>LAPORAN REKAPITULASI TAGIHAN & KAS 💸</p>
    </div>

    <!-- FILTER INFO -->
    <div class="info-filter">
        <b>PERIODE:</b> {{ request('bulan') ? request('bulan') : 'SEMUA WAKTU' }} <br>
        <b>PENCARIAN:</b> {{ request('search') ? request('search') : 'KESELURUHAN' }} <br>
        <b>DICETAK:</b> {{ \Carbon\Carbon::now()->format('d M Y, H:i') }}
    </div>

    <!-- TABEL UTAMA -->
    <table>
        <thead>
            <tr>
                <th class="text-center" width="5%">NO</th>
                <th width="20%">PENGHUNI</th>
                <th width="15%">KAMAR</th>
                <th width="20%">BULAN</th>
                <th class="text-right" width="20%">NOMINAL</th>
                <th class="text-center" width="20%">STATUS</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tagihans as $index => $t)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td><strong>{{ $t->penghuni->nama ?? 'PENGHUNI DIHAPUS' }}</strong></td>
                <td>{{ $t->penghuni->kamar->nomor_kamar ?? 'KOSONG' }}</td>
                <td>{{ strtoupper($t->bulan_tagihan) }}</td>
                <td class="text-right font-komik" style="font-size: 18px;">Rp {{ number_format($t->jumlah_bayar, 0, ',', '.') }}</td>
                <td class="text-center">
                    @if($t->status == 'Lunas')
                        <span class="badge badge-lunas">LUNAS ✅</span>
                    @else
                        <span class="badge badge-tunggak">{{ strtoupper($t->status) }} ❌</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center font-komik" style="padding: 40px; font-size: 24px; color: #555;">
                    KOSONG MLOMPONG BRO! GAK ADA DATA! 👻
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- KOTAK TOTAL PEMASUKAN -->
    <div class="total-box text-right">
        <span>TOTAL PEMASUKAN LUNAS</span>
        <strong>Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</strong>
    </div>
    
    <div class="clear"></div>

    <!-- TANDA TANGAN (COMIC STYLE) -->
    <div class="footer">
        <p style="margin-bottom: 5px;">Mengetahui,</p>
        <div class="ttd-box">
            <div class="ttd-stamp">APPROVED!</div>
            <strong>ADMIN KOS LALAN</strong>
        </div>
    </div>

</body>
</html>