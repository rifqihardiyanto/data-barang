<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Imports\ProductImport;
use Exception;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ProductImportController extends Controller
{
    public function create()
    {
        return view('products.import');
    }

    public function store(Request $request)
    {
        $file = $request->file('file')->store('public/import');
        $import = new ProductImport;
        $import->import($file);

        if ($import->failures())
        {
            return back()->withFailures($import->failures());
        }
        return redirect()
            ->route('products.index')
            ->with('success', 'Data product has been imported!');
    }
}
