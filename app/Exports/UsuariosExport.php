<?php

namespace App\Exports;

use App\Usuario;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UsuariosExport implements FromView
{
    public function view(): View
    {
    	$usuarios=Usuario::orderBy('id','ASC')->where('estado','=','1')->get();
		$usuarios->each(function($usuarios){ 
			$usuarios->usuario_rol;
			$usuarios->familiar; 
			$usuarios->empleado;
			$usuarios->estudiante; 
		});
        return view('admin.seguridad.Reportes.usuarios.usuariosExcel', [
            'usuarios' => $usuarios
        ]);
    }
}
