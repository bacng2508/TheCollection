<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Str;

// class UsersImport implements ToModel, WithHeadingRow
// {
//     /**
//     * @param array $row
//     *
//     * @return \Illuminate\Database\Eloquent\Model|null
//     */
//     public function model(array $row)
//     {
//         return new User([
//             'name'     => $row['name'],
//             'avatar'   => 'upload/client/avatar/default-avatar.png',
//             'email'    => $row['email'],
//             'password' => Hash::make(12345678),
//             'tel'      => $row['tel'],
//             'address'  => $row['address']
//         ]);
//     }
    
// }


class UsersImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            $user = User::where('email', $row['email'])->first();
            if ($user) {
                $user->update([
                    'name'     => $row['name'],
                    'email'    => $row['email'],
                    'tel'      => $row['tel'],
                    'address'  => $row['address']
                ]);
            } else {
                User::create([
                    'name'     => $row['name'],
                    'avatar'   => 'upload/client/avatar/default-avatar.png',
                    'email'    => $row['email'],
                    'password' => Hash::make(Str::password(10)),
                    'tel'      => $row['tel'],
                    'address'  => $row['address']
                ]);
            }
        }
    }
}