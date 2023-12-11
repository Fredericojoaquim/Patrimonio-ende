<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class testePdfController extends Controller
{
    
    public function teste()
    {
        $pdf=App::make('dompdf.wrapper');
        $pdf->loadHtml('<h1> Hello world </h1>');
        return $pdf->stream();
    }
}
