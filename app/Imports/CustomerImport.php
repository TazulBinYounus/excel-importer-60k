<?php

namespace App\Imports;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class CustomerImport implements ToModel, WithHeadingRow, WithChunkReading, ShouldQueue
{

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Customer([
            'branch_id'     => $row['branch_id'],
            'first_name'    => $row['first_name'],
            'last_name'    => $row['last_name'],
            'email'    => $row['email'],
            'phone'    => $row['phone'],
            'gender'    => $row['gender'],
        ]);

    }
    public function chunkSize(): int
    {
        return 1000;
    }


}
