<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $kategoriList = [
            ['code_category' => 'ELEC', 'name_category' => 'Elektronik'],
            ['code_category' => 'MECH', 'name_category' => 'Mekanik'],
            ['code_category' => 'FURN', 'name_category' => 'Furniture'],
            ['code_category' => 'OFFC', 'name_category' => 'Peralatan Kantor'],
            ['code_category' => 'CLTH', 'name_category' => 'Pakaian'],
            ['code_category' => 'BOOK', 'name_category' => 'Buku'],
            ['code_category' => 'FOOD', 'name_category' => 'Makanan'],
            ['code_category' => 'DRNK', 'name_category' => 'Minuman'],
            ['code_category' => 'SPRT', 'name_category' => 'Olahraga'],
            ['code_category' => 'MEDC', 'name_category' => 'Medis'],
            ['code_category' => 'LABS', 'name_category' => 'Laboratorium'],
            ['code_category' => 'CAMP', 'name_category' => 'Perkemahan'],
            ['code_category' => 'ELEC2', 'name_category' => 'Elektronik Lain'],
            ['code_category' => 'MECH2', 'name_category' => 'Mekanik Lain'],
            ['code_category' => 'FURN2', 'name_category' => 'Furniture Lain'],
            ['code_category' => 'TOYS', 'name_category' => 'Mainan'],
            ['code_category' => 'TOOL', 'name_category' => 'Peralatan Tangan'],
            ['code_category' => 'TECH', 'name_category' => 'Teknologi'],
            ['code_category' => 'AGRI', 'name_category' => 'Pertanian'],
            ['code_category' => 'VEHI', 'name_category' => 'Kendaraan'],
        ];

        foreach ($kategoriList as $kategori) {
            Category::create($kategori);
        }
    }
}
