<?php

namespace App\Imports;

use App\Tahanan;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class TahananImport implements ToModel, WithStartRow, WithValidation
{
    use Importable;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $tahanan = new Tahanan();
        // check if no_reg_instansi exist
        $tahanan = $tahanan->where('no_reg_instansi', $row[1])->first();

        if ($tahanan && $row[1]) {
            $tahanan->update([
                'name' => $row[2],
                'alamat' => $row[3],
                'tempat_lahir' => $row[4],
                'tanggal_lahir' => $row[5],
                'tanggal_ekspirasi' => $row[6],
                'tanggal_bebas' => $row[7],
                'keterangan' => $row[8],
            ]);

            return $tahanan;
        } else {
            return new Tahanan([
                'no_reg_instansi' => $row[1],
                'name' => $row[2],
                'alamat' => $row[3],
                'tempat_lahir' => $row[4],
                'tanggal_lahir' => $row[5],
                'tanggal_ekspirasi' => $row[6],
                'tanggal_bebas' => $row[7],
                'keterangan' => $row[8],
            ]);
        }
    }

    public function startRow(): int
    {
        return 4;
    }

    public function rules(): array
    {
        return [
            '1' => 'required',
        ];
    }
}
