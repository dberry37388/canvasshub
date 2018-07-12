<?php

namespace App\Http\Controllers\Exports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CountyExport extends Controller
{
    /**
     * @return mixed
     */
    public function export(Request $request)
    {
        return new \App\Exports\CountyExport($request);
    }
}
