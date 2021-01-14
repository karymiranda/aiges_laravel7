<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use Laracasts\Flash\Flash;
class DBController extends Controller
{
    public function respaldo()
    {
$lista[]=null;
$n=0;
$thefolder = "/MySQLBackups/backupfiles";
if (is_dir($thefolder)){
        // Abre un gestor de directorios para la ruta indicada
        $gestor = opendir($thefolder);
       // echo "<ul>";

        // Recorre todos los elementos del directorio
        while (($archivo = readdir($gestor)) !== false)  {
                
            $ruta_completa = $thefolder . "/" . $archivo;
            // Se muestran todos los archivos y carpetas excepto "." y ".."
            if ($archivo != "." && $archivo != "..") {
                // Si es un directorio se recorre recursivamente
                if (is_dir($ruta_completa)) {              	
                  
                    obtener_estructura_directorios($ruta_completa);
  //array_push($archivos, $archivo);
                } else {
                    //echo "<li>" . $archivo . "</li>";
$nombre_archivo = $ruta_completa;
if (file_exists($nombre_archivo)) {
   $fecha= date("F d Y H:i:s", filemtime($nombre_archivo));
}
$size= filesize ($ruta_completa); 
$lista[$n][0]=$archivo;
$lista[$n][1]=$fecha;
$lista[$n][2]=$size;
$archivos = collect($lista);
$n++;


                }
            }
        }
        
        // Cierra el gestor de directorios
        closedir($gestor);
       // echo "</ul>";
    } else {
        echo "No existe archivo .sql<br/>";
    }

    	//$datosrespaldos=Usuario::get();
    	return view('admin.seguridad.database.backupdb',compact('archivos','n'));
    }

    public function restaurardb($archivo)
    {
 try {
        $comando="C:\laragon\bin\mysql\mysql-5.7.19-winx64\bin --user=root --password='' pruebas_trigger < C:\MySQLBackups\backupfiles\restoredbprueba.sql ";
         system($comando);
    } catch (Throwable $e)
     {
        report($e);
        return false;
    }
      
      Flash::success("Base restaurada con éxito ")->important();

        return redirect()->route('respaldo');
    }
}
