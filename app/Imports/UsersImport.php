<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'name'     => $row[0],
            'avatar'   => 'upload/client/avatar/default-avatar.png',
            'email'    => $row[1],
            'password' => Hash::make(12345678),
            'tel'      => $row[3],
            'address'  => $row[4]
        ]);
    }
}
