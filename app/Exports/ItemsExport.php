<?php

namespace App\Exports;

use App\Models\ItemStock;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ItemsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ItemStock::with('category')->get();
    }

    public function map($item) : array {
        return [
            $item->category->name,
            $item->item_name,
            $item->total_stock,
            $item->total_repaired == 0 ? ' - ' : $item->total_repaired,
            $item->updated_at->format('F d, Y'),
        ];
    }

    public function headings() : array {
        return [
            'Category',
            'Item Name',
            'Total',
            'Repair Total',
            'Last Update',
        ];
    }
}
