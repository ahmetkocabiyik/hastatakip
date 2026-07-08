<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PatientReportController extends Controller
{
    public function durumBildirir(Request $request, Patient $patient)
    {
        $istirahatGun = $request->query('istirahat_gun');

        $pdf = Pdf::loadView('reports.durum-bildirir', [
            'patient' => $patient,
            'date' => Carbon::today()->format('d.m.Y'),
            'logo' => public_path('img/logo.svg'),
            'tani' => $request->query('tani'),
            'taniKodu' => $request->query('tani_kodu'),
            'islem' => $request->query('islem'),
            'istirahatGun' => $istirahatGun,
            'istirahatGunYazi' => is_numeric($istirahatGun)
                ? $this->sayiYaziya((int) $istirahatGun)
                : null,
        ])->setPaper('a4', 'portrait');

        $fileName = 'durum-bildirir-raporu-' . $patient->number . '.pdf';

        return $pdf->stream($fileName);
    }

    public function epikriz(Request $request, Patient $patient)
    {
        $patient->load(['sgk', 'city', 'country', 'diagnoses', 'transactions']);

        $pdf = Pdf::loadView('reports.epikriz', [
            'patient' => $patient,
            'date' => Carbon::today()->format('d.m.Y'),
            'logo' => public_path('img/logo.svg'),
            'girisTarihi' => $this->formatTarih($request->query('giris_tarihi')),
            'cikisTarihi' => $this->formatTarih($request->query('cikis_tarihi')),
            'yatisNedeni' => $request->query('yatis_nedeni'),
            'cikisNedeni' => $request->query('cikis_nedeni'),
            'bilincDurumu' => $request->query('bilinc_durumu'),
            'muayeneBulgulari' => $request->query('muayene_bulgulari'),
            'tedaviPlani' => $request->query('tedavi_plani'),
            'cikisOnerileri' => $request->query('cikis_onerileri'),
        ])->setPaper('a4', 'portrait');

        $fileName = 'epikriz-' . $patient->number . '.pdf';

        return $pdf->stream($fileName);
    }

    private function formatTarih(?string $tarih): ?string
    {
        if (! $tarih) {
            return null;
        }

        return Carbon::parse($tarih)->format('d.m.Y');
    }

    /**
     * 0-999 arası tam sayıyı Türkçe yazıya çevirir (ör. 10 => "on", 125 => "yüz yirmi beş").
     */
    private function sayiYaziya(int $sayi): string
    {
        if ($sayi === 0) {
            return 'sıfır';
        }

        $birler = ['', 'bir', 'iki', 'üç', 'dört', 'beş', 'altı', 'yedi', 'sekiz', 'dokuz'];
        $onlar = ['', 'on', 'yirmi', 'otuz', 'kırk', 'elli', 'altmış', 'yetmiş', 'seksen', 'doksan'];

        $sayi = min($sayi, 999);
        $parcalar = [];

        $yuz = intdiv($sayi, 100);
        if ($yuz > 0) {
            $parcalar[] = ($yuz === 1 ? '' : $birler[$yuz] . ' ') . 'yüz';
        }

        $kalan = $sayi % 100;
        if ($onlar[intdiv($kalan, 10)] !== '') {
            $parcalar[] = $onlar[intdiv($kalan, 10)];
        }
        if ($birler[$kalan % 10] !== '') {
            $parcalar[] = $birler[$kalan % 10];
        }

        return implode(' ', $parcalar);
    }
}
