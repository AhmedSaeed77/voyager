<?php
      
namespace App\Http\Controllers;
       
use Illuminate\Http\Request;
use Spatie\PdfToText\Pdf;
    
class PDFController extends Controller
{
       
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $path = 'H:\dashboard\voyager\voyager\public';
        $text = Pdf::getText('invoice59 (3).pdf', $path);
        // $text = Pdf::getText(public_path('invoice59 (3).pdf'));
        dd($text);
    }
     
}   