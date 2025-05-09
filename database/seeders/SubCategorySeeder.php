<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();

        $namaList = [
            'Laptop',
            'Monitor',
            'Kabel',
            'Meja Lipat',
            'Kursi Kantor',
            'Obeng',
            'Palu',
            'Tang',
            'Printer',
            'Scanner',
            'AC',
            'Kulkas',
            'Whiteboard',
            'Proyektor',
            'Lemari Arsip',
            'Rak Buku',
            'Alat Ukur',
            'Peralatan Safety',
            'Lampu LED',
            'Alat Pembersih'
        ];

        foreach (range(0, 19) as $i) {
            SubCategory::create([
                'category_id' => $categories->random()->id,
                'sub_category_name' => $namaList[$i],
                'price_range' => rand(500000, 15000000),
            ]);
        }
    }
}
