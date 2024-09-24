<?php

namespace App\Imports;

use App\Models\Inventory;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductsImport implements ToModel
{
    public function model(array $row)
    {
        return new Inventory([
            'product_name' => $row[0],
            'quantity' => $row[1],
            'price' => $row[2],
        ]);
    }
}
