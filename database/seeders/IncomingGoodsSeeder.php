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
            'PT. Sejahtera Sentosa'
        ];

        $kategoriId = 1;
        $subKategoriId = 1;

        foreach ($ptList as $pt) {
            $barangMasuk = IncomingGoods::create([
                'user_id' => 1,
                'category_id' => $kategoriId,
                'sub_category_id' => $subKategoriId,
                'origin_of_goods' => $pt,
                'number_document' => 'SM-' . rand(1000, 9999),
                'attachment' => null,
                'total_price' => 0,
                'date' => now()->subDays(rand(1, 30)),
                'status' => false,
            ]);

            $details = [];

            $itemCount = rand(2, 3);
            $total = 0;

            for ($i = 1; $i <= $itemCount; $i++) {
                $harga = rand(10000, 50000);
                $jumlah = rand(1, 5);
                $totalItem = $harga * $jumlah;

                $details[] = [
                    'incoming_goods_id' => $barangMasuk->id,
                    'goods_name' => 'Barang ' . chr(64 + $i),
                    'price' => $harga,
                    'volume' => $jumlah,
                    'unit' => 'pcs',
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

