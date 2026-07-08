<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <title>Durum Bildirir Tek Hekim Raporu</title>
    <style>
        * { font-family: DejaVu Sans, sans-serif; }
        @page { margin: 150px 60px 90px 60px; }

        body { font-size: 10pt; color: #000; line-height: 1.5; }

        header { position: fixed; top: -100px; left: 0; right: 0; text-align: center; }
        header img { width: 300px;}
        footer { position: fixed; bottom: -60px; left: 0; right: 0; text-align: center; font-size: 9pt; color: #555; }

        h1 { font-size: 14pt; text-align: center; margin: 0 0 25px 0; }

        table.fields { width: 100%; border-collapse: collapse; margin-bottom: 25px; }
        table.fields td { padding: 4px 0; font-size: 10pt; vertical-align: top; }
        table.fields td.label { font-weight: bold; width: 130px; white-space: nowrap; }

        .body-text { text-align: justify; margin: 20px 0; }

        .signature { margin-top: 60px; text-align: right; line-height: 1.4; }
        .signature .name { font-weight: bold; }
    </style>
</head>
<body>
    <header>
        <img src="{{ $logo }}" alt="Logo">
    </header>

    <footer>
        Op.Dr. Mustafa GÖZTOK &nbsp;|&nbsp; Genel Cerrahi Kliniği &nbsp;|&nbsp; İletişim No: +90 501 068 66 25 &nbsp;|&nbsp; Bayraklı/İZMİR
    </footer>

    <main>
        <h1>DURUM BİLDİRİR TEK HEKİM RAPORU</h1>

        <table class="fields">
            <tr>
                <td class="label">Hasta Protokol No:</td>
                <td>{{ $patient->number }}</td>
                <td class="label" style="width: 70px; text-align: right;">Tarih:</td>
                <td style="width: 110px; text-align: right;">{{ $date }}</td>
            </tr>
            <tr>
                <td class="label">T.C. No:</td>
                <td colspan="3">{{ $patient->id_no }}</td>
            </tr>
            <tr>
                <td class="label">Ad-Soyad:</td>
                <td colspan="3">{{ $patient->name }}</td>
            </tr>
            <tr>
                <td class="label">Tanı:</td>
                <td colspan="3">{{ $tani ?: '' }}</td>
            </tr>
        </table>

        <p class="body-text">
            Yukarıda bilgileri yazılı olan hasta kliniğimizde muayene edilmiş olup
            {{ $taniKodu ?: '…………' }} tanı kodu ile
            {{ $islem ?: '……………………………………………………………………………..' }} işlemi uygulanmıştır.
            Hastanın {{ $istirahatGun !== null && $istirahatGun !== '' ? $istirahatGun : '…' }} gün
            ({{ $istirahatGunYazi ?: '' }}) istirahati uygundur.
            Durum bildirir rapor olup hasta isteği üzerine düzenlenmiştir.
        </p>

        <div class="signature">
            <div class="name">Op.Dr. Mustafa GÖZTOK</div>
            <div>Genel Cerrahi Kliniği</div>
            <div>İletişim No: +90 501 068 66 25</div>
            <div>Bayraklı/İZMİR</div>
        </div>
    </main>
</body>
</html>
