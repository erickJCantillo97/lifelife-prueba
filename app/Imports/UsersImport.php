<?php

namespace App\Imports;

use App\Models\Departament;
use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Employee([
            'employee_id' => $row['employee_id'],
                'firstname' => $row['firstname'],
                'lastname' => $row['lastname'],
                'departament_id' => Departament::firstOrCreate(['name' => $row['departament']])->id,
        ]);
    }
}
