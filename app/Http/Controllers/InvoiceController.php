<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            [
                'quantity' => 2,
                'description' => 'Gold',
                'price' => '$500.00'
            ],
            [
                'quantity' => 3,
                'description' => 'Silver',
                'price' => '$300.00'
            ],
            [
                'quantity' => 5,
                'description' => 'Platinum',
                'price' => '$200.00'
            ]
        ];
        
        $pdf = Pdf::loadView('invoice', ['data' => $data]);
        return $pdf->download();
    }

    public function upload(Request $request)
    {
        $file = $request->file('file');
        return $request;
        $fileName = $file->getClientOriginalName();
        return $fileName;

        return response()->json(['success' => true]);
    }
}
