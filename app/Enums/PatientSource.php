<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum PatientSource : string implements HasLabel,HasColor
{
    case Unknown = "unknown";
    case GoogleAds = "google-ads";
    case Facebook = "facebook";
    case Instagram = "instagram";
    case Tiktok = "tiktok";
    case Youtube = "youtube";
    case RecommendPatient= "recommend-patient";
    case Phone= "phone";




    public function getLabel(): ?string
    {
        return match($this) {
            self::Unknown => "Bilinmiyor",
            self::GoogleAds => "Google Reklam",
            self::Facebook => "Facebook",
            self::Instagram => "Instagram",
            self::Tiktok => "Tiktok",
            self::Youtube => "Youtube",
            self::RecommendPatient => "Hasta Önerisi",
            self::Phone => "Telefon",

        };
    }


    public function getColor(): string | array | null
    {
        return match ($this) {
            self::Unknown => 'gray',
            self::GoogleAds => 'success',
            self::Facebook => 'info',
            self::Instagram => 'danger',
            self::Tiktok => 'dark-gray',
            self::Youtube => 'danger',
            self::RecommendPatient => 'primary',
            self::Phone => 'primary',

        };
    }
}
