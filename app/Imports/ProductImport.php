<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProductImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'name' => $row['name'],
            'slug' => $row['slug'],
            'category_id' => $row['category_id'],
            'unit_id' => $row['unit_id'],
            'code' => $row['code'],
            'quantity' => $row['quantity'],
            'buying_price' => $row['buying_price'],
            'selling_price' => $row['selling_price'],
            'quantity_alert' => $row['quantity_alert'],
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'category_id' => 'required',
            'unit_id' => 'required',
            'code' => 'required',
            'quantity' => 'required', 
            'buying_price' => 'required',
            'selling_price' => 'required',
        ];
    }
}
