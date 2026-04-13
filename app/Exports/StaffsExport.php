<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StaffsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::where('role', 'staff')->get();
    }

    public function map($staff) : array
    {
       return [
         $staff->name,
         $staff->email,
         $staff->updated_at == $staff->created_at ? $staff->password : 'Staff sudah ganti password',
       ];
    }

    public function headings(): array
    {
        return [
            'name',
            'email',
            'password',
        ];
    }
}
