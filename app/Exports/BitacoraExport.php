<?php

namespace App\Exports;
use App\Bitacora;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class BitacoraExport implements FromView
{
    public function view():View
    {
      $bitacora=Bitacora::get();
      return view('admin.seguridad.Reportes.bitacora.bitacoraExcel',['bitacora'=>$bitacora]);
    
    }
}
