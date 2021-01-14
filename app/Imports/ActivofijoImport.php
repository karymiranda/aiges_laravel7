<?php

namespace App\Imports;

use App\ActivoFijo;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Validators\Failure;
use Carbon\Carbon;

class ActivofijoImport implements ToModel,WithHeadingRow,WithValidation
{
    use Importable,SkipsErrors,SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
      

        return new ActivoFijo([
            'cuentacatalogo_id'=>$row['cuentacatalogo_id'],
            'v_nombre'=>$row[ 'v_nombre'],
            'v_codigoactivo'=>$row['v_codigoactivo'],
            'f_fecha_adquisicion'=>\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['f_fecha_adquisicion']),
            'v_serie'=>$row['v_serie'],
            'v_modelo'=>$row['v_modelo'],
            'v_marca'=>$row['v_marca'],
            'v_estado'=>$row['v_estado'],
            'd_valor'=>$row[ 'd_valor'],
            'v_ubicacion'=>$row['v_ubicacion'],
            'v_vidautil'=>$row['v_vidautil'],
            'v_medida'=>$row['v_medida'],
            'v_materialdeconstruccion'=>$row[ 'v_materialdeconstruccion'],
            'v_condicionactivo'=>$row['v_condicionactivo'],
            'v_observaciones'=>$row['v_observaciones'],
            'v_trasladadoSN'=>$row['v_trasladadosn'],
        ]);

    }

/*con este metodo no me va a mopstrar los errores que hayan al tratar de subir el archivo, si quito esta funcion si los mostrara
    public function OnError(Throwable $error)
    {

    }*/

    public function rules():array
    {
return [
'*.cuentacatalogo_id'=>['numeric'],
'*.v_nombre'=>['required','max:150'],
'*.v_codigoactivo'=>['required','unique:tb_activofijo,v_codigoactivo'],
'*.f_fecha_adquisicion'=>['required'],
'*.v_estado'=>['required','max:1'],
'*.d_valor'=>['required','numeric'],
'*.v_marca'=>['required'],
'*.v_observaciones'=>['max:150'],
        ];
    }

}
