<?php

namespace App\Imports;

use App\Model\Student;
use App\Model\Classes;
use App\Model\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class StudentImport implements ToCollection, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
//    public function model(array $row)
//    {
//        $user   = new User ([
//            'name'      => $row[1],
//            'username'  => $row[2],
//            'password'  => Hash::make($row[3]),
//            'roles_id'  => User::STUDENT,
//        ]);
//        return new Student([
//            'nis'       => $row[0],
//            'username'  => $row[2],
//            'class_id'  => $row[4],
//            'user_id'   => $user,
//            'path_downloadv'    => $row[5]
//        ]);
//    }

    public function startRow(): int
    {
        return 2;
    }

    public function collection(Collection $rows)
    {
        foreach($rows as $row) {
            $user   = User::create([
                'name'      => $row[1],
                'username'  => $row[2],
                'password'  => Hash::make($row[3]),
                'roles_id'  => User::STUDENT,
            ]);
            Student::create([
                'nis'       => $row[0],
                'username'  => $row[2],
                'class_id'  => $row[4],
                'user_id'   => $user->id,
                'path_download'    => $row[5]
            ]);

            $class  = Classes::find($row[4]);
            $class->total   += 1;
            $class->save();

        }


    }
}
