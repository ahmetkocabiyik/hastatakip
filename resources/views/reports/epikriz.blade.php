<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <title>Epikriz</title>
    <style>
        * { font-family: DejaVu Sans, sans-serif; }
        @page { margin: 150px 45px 70px 45px; }

        body { font-size: 10pt; color: #000; line-height: 1.5; }

        header { position: fixed; top: -100px; left: 0; right: 0; text-align: center; }
        header img { width: 300px;}
        h1 { font-size: 14pt; text-align: center; margin: 0 0 25px 0; }
        footer { position: fixed; bottom: -50px; left: 0; right: 0; text-align: center; font-size: 8pt; color: #555; }

        table.fields { width: 100%; border-collapse: collapse; margin-bottom: 12px; }
        table.fields td { border: 1px solid #ddd; padding: 2px 6px; vertical-align: center;  }
        table.fields td.label { font-weight: bold; width: 110px; white-space: nowrap; }
        table.fields td.sep { width: 10px; }
        table.fields td.val { padding-right: 20px; }

        .section-bar { background: #e9e9e9; font-weight: bold; padding: 4px 8px; margin: 14px 0 8px 0; font-size: 10pt; line-height: 16px }

        table.grid { width: 100%; border-collapse: collapse; margin-bottom: 6px; }
        table.grid td, table.grid th { border: 1px solid #ddd; padding: 4px 6px; vertical-align: center; line-height: 16px  }
        table.grid th { background: #f4f4f4; font-weight: bold; }

        .field-line { margin: 3px 0; }
        .field-line .k { font-weight: bold; }

        .op-block { margin-bottom: 4px; page-break-inside: avoid; }
        .op-title { font-weight: bold; margin-bottom: 3px; }
        .op-desc { text-align: justify; margin: 3px 0; }
        .op-meta { margin: 2px 0; }
        .op-meta .k { font-weight: bold; }

        .signature { margin-top: 45px; text-align: right; line-height: 1.4; }
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
        <h1>EPİKRİZ</h1>
        {{-- Hasta kimlik bilgileri --}}
        <table class="fields">
            <tr>
                <td class="label">TC Kimlik No</td><td class="val">{{ $patient->id_no ?: '-' }}</td>
                <td class="label">Dosya / Protokol No</td><td class="val">{{ $patient->number }}</td>
            </tr>
            <tr>
                <td class="label">Hasta</td><td class="val">{{ $patient->name }}</td>
                <td class="label">Bölüm</td><td class="val">Genel Cerrahi</td>
            </tr>
            <tr>
                <td class="label">Cinsiyeti</td><td class="val">{{ $patient->gender?->getLabel() ?: '-' }}</td>
                <td class="label">Sosyal Güvence</td><td class="val">{{ $patient->sgk?->name ?: '-' }}</td>
            </tr>
            <tr>
                <td class="label">Doğum Tarihi</td><td class="val">{{ $patient->birth_date?->format('d.m.Y') ?: '-' }}</td>
                <td class="label">Telefon No</td><td class="val">{{ $patient->phone ?: '-' }}</td>
            </tr>
            <tr>
                <td class="label">Yaş</td><td class="val">{{ $patient->age !== null ? $patient->age : '-' }}</td>
                <td class="label">Rapor Tarihi</td><td class="val">{{ $date }}</td>
            </tr>
            <tr>
                <td class="label">Adres</td>
                <td class="val" colspan="3">{{ trim(collect([$patient->city?->name, $patient->country?->name])->filter()->implode(' / ')) ?: '-' }}</td>
            </tr>
        </table>

        {{-- Yatış / çıkış bilgileri --}}
        @if ($girisTarihi || $cikisTarihi || $yatisNedeni || $cikisNedeni)
            <div class="section-bar">Hastaneye Yatış / Çıkış Bilgileri</div>
            <table class="grid">
                <tr>
                    <th style="width: 25%;">Giriş Tarihi</th>
                    <th style="width: 25%;">Çıkış Tarihi</th>
                    <th style="width: 25%;">Yatış Nedeni</th>
                    <th style="width: 25%;">Çıkış Nedeni</th>
                </tr>
                <tr>
                    <td>{{ $girisTarihi ?: '-' }}</td>
                    <td>{{ $cikisTarihi ?: '-' }}</td>
                    <td>{{ $yatisNedeni ?: '-' }}</td>
                    <td>{{ $cikisNedeni ?: '-' }}</td>
                </tr>
            </table>
        @endif

        @if ($patient->diagnoses->isNotEmpty())
            <table class="grid" style="margin-top: 12px;">
                @foreach ($patient->diagnoses as $diagnosis)
                    <tr>
                        <td style="width: 120px; font-weight: bold;">Ayırıcı Tanı</td>
                        <td>{{ trim(($diagnosis->icd ? $diagnosis->icd . ' - ' : '') . $diagnosis->name) }}</td>
                    </tr>
                @endforeach
            </table>
        @endif

        {{-- Muayene bilgileri --}}
        <div class="section-bar">Muayene ve Anamnez Bilgileri</div>

        @if ($patient->complaint)
            <div class="field-line"><span class="k">Hikayesi &amp; Şikayeti:</span> {{ $patient->complaint }}</div>
        @endif
        @if ($patient->known_illness)
            <div class="field-line"><span class="k">Bilinen Hastalıklar / Sistemik Anamnez:</span> {{ $patient->known_illness }}</div>
        @endif
        @if ($patient->past_operations)
            <div class="field-line"><span class="k">Geçirdiği Operasyonlar:</span> {{ $patient->past_operations }}</div>
        @endif
        <div class="field-line"><span class="k">Kullandığı İlaçlar:</span> {{ $patient->drugs ?: 'Yok' }}</div>
        <div class="field-line"><span class="k">Alerji:</span> {{ $patient->allergies ?: 'Bilinen alerji yok' }}</div>
        <div class="field-line"><span class="k">Sigara Kullanımı:</span> {{ $patient->smoking ? 'Evet' : 'Hayır' }}</div>
        <div class="field-line"><span class="k">Alkol Kullanımı:</span> {{ $patient->alcohol ? 'Evet' : 'Hayır' }}</div>
        @if ($bilincDurumu)
            <div class="field-line"><span class="k">Bilinç Durumu:</span> {{ $bilincDurumu }}</div>
        @endif
        @if ($muayeneBulgulari)
            <div class="field-line"><span class="k">Muayene &amp; Bulgular:</span> {{ $muayeneBulgulari }}</div>
        @endif
        @if ($patient->diagnoses->isNotEmpty())
            <div class="field-line"><span class="k">Tanı:</span> {{ $patient->diagnoses->pluck('name')->implode(', ') }}</div>
        @endif
        @if ($tedaviPlani)
            <div class="field-line"><span class="k">Tedavi Planı:</span> {{ $tedaviPlani }}</div>
        @endif
        @if ($cikisOnerileri)
            <div class="field-line"><span class="k">Çıkış Önerileri:</span> {{ $cikisOnerileri }}</div>
        @endif

        {{-- Uygulanan işlemler / ameliyatlar --}}
        @if ($patient->transactions->isNotEmpty())
            <div class="section-bar">Uygulanan İşlemler</div>
            @foreach ($patient->transactions as $transaction)
                <div class="op-block">
                    <div class="op-title">
                        {{ $transaction->name }}
                        @if ($transaction->pivot->date)
                            ({{ \Illuminate\Support\Carbon::parse($transaction->pivot->date)->format('d.m.Y') }})
                        @endif
                    </div>
                    @if ($transaction->pivot->note)
                        <div class="op-desc">{{ $transaction->pivot->note }}</div>
                    @endif
                    @if ($transaction->pivot->special_material)
                        <div class="op-meta"><span class="k">Özel Malzeme:</span> {{ $transaction->pivot->special_material }}</div>
                    @endif
                </div>
            @endforeach
        @endif

        <div class="signature">
            <div class="name">Op.Dr. Mustafa GÖZTOK</div>
            <div>Genel Cerrahi Kliniği</div>
        </div>
    </main>
</body>
</html>
