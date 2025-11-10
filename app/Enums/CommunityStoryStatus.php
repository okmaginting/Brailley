<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum CommunityStoryStatus: string implements HasLabel
{
    case Pengecekan = 'pengecekan';
    case Ditolak = 'ditolak';
    case Diterima = 'diterima';
    case Proses = 'proses';
    case Dipublish = 'dipublish';
    case RequestHapus = 'request_hapus';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Pengecekan => 'Dalam Pengecekan',
            self::Ditolak => 'Ditolak',
            self::Diterima => 'Diterima (Menunggu Proses)',
            self::Proses => 'Dalam Proses (Pembuatan Braille)',
            self::Dipublish => 'Sudah Dipublish',
            self::RequestHapus => 'Minta Hapus (Menunggu Persetujuan)',
        };
    }
}