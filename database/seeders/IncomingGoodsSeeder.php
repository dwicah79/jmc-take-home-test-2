<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\IncomingGoods;
use App\Models\IncomingGoodsDetile;

class IncomingGoodsSeeder extends Seeder
{
    public function run()
    {
        IncomingGoodsDetile::query()->delete();
        IncomingGoods::query()->delete();
        $ptList = [
            'PT. Maju Bersama',
            'PT. Cahaya Abadi',
            'PT. Sejahtera Sentosa',
            'PT. Global Mandiri',
            'PT. Bintang Jaya',
            'PT. Sinar Mas',
            'PT. Adi Karya',
            'PT. Bumi Laut',
            'PT. Cipta Karya',
            'PT. Duta Makmur',
            'PT. Era Baru',
            'PT. Fajar Sejahtera',
            'PT. Graha Indah',
            'PT. Harapan Jaya',
            'PT. Inti Makmur',
            'PT. Jaya Abadi',
            'PT. Kencana Mulia',
            'PT. Lestari Sentosa',
            'PT. Mitra Usaha',
            'PT. Nusantara Jaya'
        ];

        $kategoriId = 1;
        $subKategoriId = 1;

        foreach ($ptList as $pt) {
            $barangMasuk = IncomingGoods::create([
                'user_id' => 1,
                'category_id' => $kategoriId,
                'sub_category_id' => $subKategoriId,
                'origin_of_goods' => $pt,
                'unit' => 'Gudang Utama',
                'number_document' => 'SM-' . rand(1000, 9999),
                'attachment' => null,
                'total_price' => 0,
                'date' => now()->subDays(rand(1, 30)),
            ]);

            $details = [];
            $total = 0;
            for ($i = 1; $i <= 2; $i++) {
                $harga = rand(10000, 50000);
                $jumlah = rand(1, 5);
                $totalItem = $harga * $jumlah;

                $details[] = [
                    'incoming_goods_id' => $barangMasuk->id,
                    'goods_name' => 'Barang ' . chr(64 + $i),
                    'price' => $harga,
                    'volume' => $jumlah,
                    'unit' => 'pcs',
                    'status' => false,
                    'total' => $totalItem,
                    'expired_date' => now()->addMonths(rand(1, 12)),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                $total += $totalItem;
            }

            IncomingGoodsDetile::insert($details);
            $barangMasuk->update(['total_price' => $total]);
        }
    }
}

