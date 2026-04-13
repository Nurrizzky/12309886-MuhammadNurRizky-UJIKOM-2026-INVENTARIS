<?php

namespace App\Exports;

use App\Models\BorrowedItem;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LendingsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return BorrowedItem::with('returned')->get();
    }

    public function map($lendings) : array
    {
       return [
         $lendings->item->item_name,
         $lendings->total_item,
         $lendings->staff->name,
         $lendings->returned ? $lendings->returned->notes : $lendings->notes,
         $lendings->date->format('F d, Y'),
         $lendings->returned ? $lendings->returned->return_date : 'Belum di kembalikan',
         $lendings->staff->role,
       ];
    }

    public function headings(): array
    {
        return [
            'Nama item',
            'Totla',
            'Name',
            'Deskripsi',
            'Date',
            'Return date',
            'edited by',
        ];
    }
}
