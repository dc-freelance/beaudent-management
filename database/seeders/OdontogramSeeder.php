<?php

namespace Database\Seeders;

use App\Models\Odontogram;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OdontogramSeeder extends Seeder
{
    public function run(): void
    {
        $odontograms = [
            [
                'name'        => 'Sound',
                'symbol'      => 'sou',
                'description' => 'Gigi sehat, normal, dan tanpa kelainan',
                'placement'   => 'full',
                'is_outside'  => 'no',
            ],
            [
                'name'        => 'No Information',
                'symbol'      => 'nou',
                'description' => 'Tidak diketahui informasi tentang gigi tersebut',
                'placement'   => 'full',
                'is_outside'  => 'yes',
            ],
            [
                'name'        => 'Unerupted',
                'symbol'      => 'une',
                'description' => 'Gigi tidak/belum erupsi.',
                'placement'   => 'full',
                'is_outside'  => 'yes',
            ],
            [
                'name'        => 'Partial Erupted',
                'symbol'      => 'pre',
                'description' => 'Gigi terlihat sebagian atau belum tumbuh sempurna.',
                'placement'   => 'full',
                'is_outside'  => 'yes',
            ],
            [
                'name'        => 'Impacted non Visible',
                'symbol'      => 'imx',
                'description' => 'Gigi impaksi tidak terlihat secara klinis',
                'placement'   => 'full',
                'is_outside'  => 'yes',
            ],
            [
                'name'        => 'Anomali',
                'symbol'      => 'ano',
                'description' => 'Gigi mengalami kelainan anatomis atau morfologis',
                'placement'   => 'full',
                'is_outside'  => 'yes',
            ],
            [
                'name'        => 'Diastema',
                'symbol'      => 'dia',
                'description' => 'Gigi renggang/terdapat celah dalam relasi mesial dan/atau distal',
                'placement'   => 'full',
                'is_outside'  => 'yes',
            ],
            [
                'name'        => 'Attrition',
                'symbol'      => '',
                'description' => 'Gigi mengalami keausan di mahkota karena gesekan',
                'placement'   => 'full',
                'is_outside'  => 'yes',
            ],
            [
                'name'        => 'Carries',
                'symbol'      => 'car',
                'description' => 'Gigi mengalami karies/terdapat lubang pada gigi',
                'placement'   => 'partial',
                'is_outside'  => 'no',
            ],
            [
                'name'        => 'Crown Factured',
                'symbol'      => 'cfr',
                'description' => 'Fraktur pada mahkota gigi',
                'placement'   => 'full',
                'is_outside'  => 'yes',
            ],
            [
                'name'        => 'Non Vital Tooth',
                'symbol'      => 'nvt',
                'description' => 'Gigi non vital karena perubahan warna mahkota atau dari radiograf',
                'placement'   => 'full',
                'is_outside'  => 'yes',
            ],
            [
                'name'        => 'Root Canal Treatment',
                'symbol'      => 'rct',
                'description' => 'Gigi telah atau sedang menjalani perawatan saluran akar',
                'placement'   => 'full',
                'is_outside'  => 'yes',
            ],
            [
                'name'        => 'Retainer Root',
                'symbol'      => 'rrx',
                'description' => 'Sisa akar gigi',
                'placement'   => 'full',
                'is_outside'  => 'no',
            ],
            [
                'name'        => 'Missing',
                'symbol'      => 'mis',
                'description' => 'Gigi dicabut sampai akar dengan alasan patologis maupun perawatan',
                'placement'   => 'full',
                'is_outside'  => 'no',
            ],
            [
                'name'        => 'Missing ante Mortem',
                'symbol'      => 'mam',
                'description' => 'Gigi dicabut sampai akar dengan alasan patologis maupun perawatan',
                'placement'   => 'full',
                'is_outside'  => 'no',
            ],
            [
                'name'        => 'Missing post Mortem',
                'symbol'      => 'mpm',
                'description' => 'Gigi tercabut sampai akar setelah kematian',
                'placement'   => 'full',
                'is_outside'  => 'no',
            ],
            [
                'name'        => 'Amalgam Filling',
                'symbol'      => 'amf',
                'description' => 'Tumpatan/tambalan amalgam',
                'placement'   => 'partial',
                'is_outside'  => 'no',
            ],
            [
                'name'        => 'Glass Ionomer Filling',
                'symbol'      => 'gif',
                'description' => 'Tumpatan/tambalan GIC sewarna gigi',
                'placement'   => 'partial',
                'is_outside'  => 'no',
            ],
            [
                'name'        => 'Fissure Sealant',
                'symbol'      => 'fis',
                'description' => 'Tumpatan/tambalan komposit/GIC sewarna gigi yang digunakan untuk menutupi pit dan fissure pada gigi yang sehat',
                'placement'   => 'partial',
                'is_outside'  => 'no',
            ],
            [
                'name'        => 'In (Inlay)',
                'symbol'      => 'inl',
                'description' => 'Terdapat restorasi inlay atau onlay pada gigi',
                'placement'   => 'partial',
                'is_outside'  => 'no',
            ],
            [
                'name'        => 'On (Onlay)',
                'symbol'      => 'onl',
                'description' => 'Terdapat restorasi inlay atau onlay pada gigi',
                'placement'   => 'partial',
                'is_outside'  => 'no',
            ],
            [
                'name'        => 'Full metal crown',
                'symbol'      => 'fmcs',
                'description' => 'Terdapat restorasi mahkota logam secara keseluruhan',
                'placement'   => 'full',
                'is_outside'  => 'no',
            ],
            [
                'name'        => 'Porcelain Crown',
                'symbol'      => 'poc',
                'description' => 'Terdapat restorasi mahkota porcelen/keramik',
                'placement'   => 'full',
                'is_outside'  => 'no',
            ],
            [
                'name'        => 'Metal Porcelain Crown',
                'symbol'      => 'mpc',
                'description' => 'Terdapat restorasi mahkota porcelain/keramik diperkuat logam',
                'placement'   => 'full',
                'is_outside'  => 'no',
            ],
            [
                'name'        => 'Gold Porcelain Crown',
                'symbol'      => 'gmc',
                'description' => 'Terdapat restorasi mahkota porcelain/keramik diperkuat logam emas',
                'placement'   => 'full',
                'is_outside'  => 'no',
            ],
            [
                'name'        => 'Implant',
                'symbol'      => 'ipx',
                'description' => 'Implan gigi',
                'placement'   => 'full',
                'is_outside'  => 'no',
            ],
            [
                'name'        => 'Metal Bridge',
                'symbol'      => 'meb',
                'description' => 'Restorasi jembatan selain dari bahan tidak sewarna gigi',
                'placement'   => 'full',
                'is_outside'  => 'no',
            ],
            [
                'name'        => 'Porcelain Bridge',
                'symbol'      => 'pob',
                'description' => 'Restorasi jembatan yang terbuat dari porselen atau bahan sewarna gigi',
                'placement'   => 'full',
                'is_outside'  => 'no',
            ],
            [
                'name'        => 'Pontic',
                'symbol'      => 'pon',
                'description' => 'Mahkota gigi yang menggantikan gigi asli yang telah dicabut/tidak ada.',
                'placement'   => 'full',
                'is_outside'  => 'no',
            ],
            [
                'name'        => 'Abutment',
                'symbol'      => 'abu',
                'description' => 'Gigi penjangkar/penyangga restorasi jembatan',
                'placement'   => 'full',
                'is_outside'  => 'no',
            ],
            [
                'name'        => 'Partial Denture',
                'symbol'      => 'prd',
                'description' => 'Gigi tiruan sebagian lepasan',
                'placement'   => 'full',
                'is_outside'  => 'no',
            ],
            [
                'name'        => 'Full Denture',
                'symbol'      => 'fld',
                'description' => 'Gigi tiruan lengkap',
                'placement'   => 'full',
                'is_outside'  => 'no',
            ],
            [
                'name'        => 'Acrylic',
                'symbol'      => 'acr',
                'description' => 'Gigi tiruan bahan keramik',
                'placement'   => 'full',
                'is_outside'  => 'no',
            ],
        ];

        Odontogram::insert($odontograms);
    }
}
