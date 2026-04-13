<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AdminsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::where('role', 'admin')->get();
    }

     public function map($admin) : array {
        return [
            $admin->name,
            $admin->email,
            $admin->created_at == $admin->updated_at ? $admin->password : 'User ini Sudah ganti password',
        ];
    }

    public function headings() : array {
        return [
            'Name',
            'Email',
            'Password',
        ];
    }
}
