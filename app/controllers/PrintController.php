<?php
class PrintController extends BaseController
{
    public function index()
    {
        $pdf = App::make('dompdf');
        $pdf->loadHTML('<h1>Hello World!!</h1>');
        return $pdf->stream();
    }
    public function pdfz()
    {
        $pdf = PDF::loadHTML('<h1>Hello World!!</h1>');
        return $pdf->stream();
        //$pdf = PDF::loadView('<h1>Hello World!!</h1>');
        //return $pdf->download('test.pdf');
    }
    function temedet(){
        //echo substr(date('Y-m-d'),8,6);
        echo date('Y-m-d');
    }
}

