<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::all(['name', 'avatar', 'email', 'tel', 'address']);
    }

    public function headings(): array
    {
        return [
            'Tên người dùng',
            'Avatar',
            'Email',
            'SDT',
            'Địa chỉ'
        ];
    }
}
