<?php

namespace App\Http\Controllers;
use App\Models\Driver;
use Illuminate\Http\Request;
use PDF;

class PdfMaker extends Controller
{
    public function showEmployees(){
        $drivers = Driver::all();
        return view('pdf', compact('drivers'));
      }


      public function createPDF() {
        // retreive all records from db
        $data = Driver::all();
  
        // share data to view
        view()->share('drivers',$data);
        $pdf = PDF::loadView('pdf_view', $data);
  
        // download PDF file with download method
        return $pdf->download('pdf_file.pdf');
      } 
}
