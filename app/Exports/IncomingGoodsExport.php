<?php

namespace App\Exports;

use App\Models\IncomingGoods;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class IncomingGoodsExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function query()
    {
        $query = IncomingGoods::with(['category', 'subcategory', 'goodsDetail', 'operator']);

        // Apply filters if they exist
        if (!empty($this->filters['category_id'])) {
            $query->where('category_id', $this->filters['category_id']);
        }

        if (!empty($this->filters['sub_category_id'])) {
            $query->where('sub_category_id', $this->filters['sub_category_id']);
        }

        if (!empty($this->filters['year'])) {
            $query->whereYear('created_at', $this->filters['year']);
        }

        if (!empty($this->filters['search'])) {
            $search = $this->filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('origin_of_goods', 'like', "%{$search}%")
                    ->orWhereHas('subcategory', function ($q2) use ($search) {
                        $q2->where('sub_category_name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('goodsDetail', function ($q3) use ($search) {
                        $q3->where('goods_name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('category', function ($q4) use ($search) {
                        $q4->where('name_category', 'like', "%{$search}%");
                    });
            });
        }

        return $query;
    }

    public function map($item): array
    {
        $goodsDetails = $item->goodsDetail->map(function ($detail) {
            return [
                'name' => $detail->goods_name,
                'quantity' => $detail->volume,
                'price' => number_format($detail->price, 0, ',', '.'),
                'total' => number_format($detail->total, 0, ',', '.'),
            ];
        });

        $goodsList = $goodsDetails->map(function ($detail) {
            return "{$detail['name']} (Qty: {$detail['quantity']}, Harga: Rp{$detail['price']}, Total: Rp{$detail['total']})";
        })->implode("\n");

        $totalAmount = $item->goodsDetail->sum('total');

        return [
            $item->created_at->format('d-m-Y'),
            $item->origin_of_goods,
            $item->operator->name ?? '-',
            $item->category->name_category ?? '-',
            $item->subcategory->sub_category_name ?? '-',
            $item->category->code_category ?? '-',
            $item->unit,
            $goodsList,
            'Rp' . number_format($totalAmount, 0, ',', '.'),
        ];
    }

    public function headings(): array
    {
        return [
            'Tanggal Masuk',
            'Asal Barang',
            'Penerima',
            'Kategori',
            'Sub Kategori',
            'Kode Kategori',
            'Unit',
            'Detail Barang',
            'Total Keseluruhan',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Header style
            1 => [
                'font' => ['bold' => true],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['argb' => 'FFD9D9D9']
                ]
            ],

            // Data rows style
            'A:I' => [
                'alignment' => [
                    'wrapText' => true,
                    'vertical' => 'top',
                ],
            ],

            // Numeric columns right alignment
            'I' => [
                'alignment' => [
                    'horizontal' => 'right',
                ],
            ],
        ];
    }
}
