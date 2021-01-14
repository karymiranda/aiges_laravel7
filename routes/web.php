<?php
 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/*
Route::group(['prefix'=>'admin/academica'], function(){
	Route::resource('grados','AgregargradoController');
});

*/
use App\Expedienteestudiante;
use App\Periodoactivo;
use App\Seccion;
use App\Empleado;
use App\Transaccionesbono;

Route::get('/', function () {
   //
   if(Auth::user()){

    return redirect('/admin/inicio');
   }
   return view('admin.login'); 
})->name('iniciarsesion');

Route::group(['prefix'=>'admin', 'middleware'=>'auth'], function(){

Route::get('/inicio', function () {
   //return view('admin.slide'); 
$periodoescolaractivo = Periodoactivo::orderBy('id','ASC')->where([['estado','=','1'],['tipo_periodo','like','ACADEMICO']])->get();
//dd($periodoescolaractivo);
if(!count($periodoescolaractivo)>0)
{
$periodoescolaractivo = Periodoactivo::where('tipo_periodo','like','ACADEMICO')->first();
}
$anio=$periodoescolaractivo[0]->anio;


$countsecciones=Seccion::where('estado','=','1')->get()->count();
$countestudiantesactivos=Expedienteestudiante::where('estado','=','1')->get()->count();
$countmatriculas=Expedienteestudiante::whereHas('estudiante_seccion',function($q) use ($anio){
$q->where([['tb_matriculaestudiante.estado','=','1'],['tb_matriculaestudiante.v_estadomatricula','like','aprobada'],['tb_matriculaestudiante.anio','=',$anio]]);})->where('estado','=','1')->get()->count();
$countmatriculasonline=Expedienteestudiante::whereHas('estudiante_seccion',function($q) use ($anio){
$q->where([['tb_matriculaestudiante.estado','=','1'],['tb_matriculaestudiante.v_estadomatricula','like','pendiente'],['tb_matriculaestudiante.anio','=',$anio],['tb_matriculaestudiante.modalidad','like','online']]);})->where('estado','=','1')->get()->count();

$countrrhhactivos=Empleado::where('estado','=','1')->get()->count();
$saldobancos=Transaccionesbono::all()->last();
$ciclosacademicos=Periodoactivo::orderBy('anio','DESC')->where('tipo_periodo','like','ACADEMICO')->pluck('anio','id');

/*foreach (Auth::user()->usuario_rol as $key => $value) {
  dd($value);
}*/
$alcance=$countmatriculas;

//$alcance=($countmatriculas/$countestudiantesactivos)*100;
//$alcance=number_format($alcance,2,'.','.');

     $mes=date("m");
    if(Auth::user()->empleado!=null){
    return view('admin.paginainicial_administradores', compact('anio','mes','countsecciones','countmatriculas','countestudiantesactivos','countmatriculasonline','countrrhhactivos','saldobancos','ciclosacademicos','alcance'));	
    }

 	if(Auth::user()->estudiante!=null){
    return view('admin.paginainicial_estudiantes'); 	
    }

    if(Auth::user()->familiar!=null){
    return view('admin.paginainicial_padresdefamilia'); 	
    }

    return view('admin.slide'); //retorna esto cuando no es empleado (pporAHORITA) 

})->name('menu');

//Route::get('slide', ['as' => 'slide', 'uses' => 'IndexController@index']);

Route::group(['middleware'=>'Familiar'], function(){
Route::get('misestudiantes/{idfamiliar}/view', ['as' => 'estudiantes_familiares', 'uses' => 'ModulopadresdefamiliaonlineController@misestudiantes']);
Route::get('historialcalificaciones/{idestudiante}/view', ['as' => 'historialcalificaciones', 'uses' => 'ModulopadresdefamiliaonlineController@historialcalificaciones']);
Route::get('horariosdeclases/{idestudiante}/view', ['as' => 'horariosdeclases', 'uses' => 'ModulopadresdefamiliaonlineController@horariosdeclases']);
Route::get('matriculaenlinea/{idestudiante}', ['as' => 'matricula_online', 'uses' => 'ModulopadresdefamiliaonlineController@matriculaenlinea']);
Route::get('asistenciasestudiantes/{idestudiante}/view', ['as' => 'asistencias_estudiantes', 'uses' => 'ModulopadresdefamiliaonlineController@asistenciasestudiantes']);
Route::get('avisoexceptionmatricula/{tipoerror}/view', ['as' => 'avisoerror', 'uses' => 'ModulopadresdefamiliaonlineController@avisoerror']);
Route::get('avisosindatos', ['as' => 'avisosindatos', 'uses' => 'ModulopadresdefamiliaonlineController@avisosindatos']);
Route::get('seccionmatricula/{id}', ['as' => 'seccionmatricula', 'uses' => 'ModulopadresdefamiliaonlineController@seccionmatricula']);
Route::get('turnomatriculaonline/{id}', ['as' => 'turnomatriculaonline', 'uses' => 'ModulopadresdefamiliaonlineController@turnomatriculaonline']);
Route::post('guardarsolicitud', ['as' => 'guardarsolicitudpadresmatricula','uses' => 'ModulopadresdefamiliaonlineController@guardarsolicitudmatriculaonline']);
Route::get('comprobantematricula/{id}/pdf', ['as' => 'comprobantematricula', 'uses' => 'ConsultasyreportesController@comprobantematriculaenlinea_pdf']);
Route::get('expedientefamiliar/{id}/view', ['as' => 'expedienteonline', 'uses' => 'ModulopadresdefamiliaonlineController@expedienteonline']);
Route::get('asesordeseccion/{id}/view', ['as' => 'asesordeseccion', 'uses' => 'ModulopadresdefamiliaonlineController@asesorseccion']);

Route::get('editarexpedientepadresonline/{id}/view', ['as' => 'actualizarexpedientefamiliaronline', 'uses' => 'ModulopadresdefamiliaonlineController@editarexpedienteenlinea']);

Route::put('actualizarexpedientepadresonline/{id}/edit', ['as' => 'modificarexpedientefamiliaronline', 'uses' => 'ModulopadresdefamiliaonlineController@actualizarexpedienteenlinea']);

});// FIN GRUPO DE RUTAS PARA MODULO PADRES DE FAMILIA

Route::group(['middleware'=>'Docente'], function(){
//MODULO PERSONAL DOCENTE 
 
	//ACTIVIDADES EVALUADAS
Route::get('listacompetenciasciudadanas', ['as' => 'listacompetenciasciudadanas', 'uses' => 'EvaluacionesPeriodoController@listacompetenciasciudadanas']);
Route::get('listaevaluacionesperiodo', ['as' => 'listaevaluacionesperiodo', 'uses' => 'EvaluacionesPeriodoController@index']);
Route::post('listadoevaluaciones/{idperiodo}', ['as' => 'listadoevaluaciones', 'uses' => 'EvaluacionesPeriodoController@listadoevaluaciones']);
Route::get('agregarevaluacionesperiodo', ['as' => 'agregarevaluacionesperiodo', 'uses' => 'EvaluacionesPeriodoController@agregarevaluacionesperiodo']);
Route::post('guardarevaluacionesperiodo', ['as' => 'guardarevaluacionesperiodo', 'uses' => 'EvaluacionesPeriodoController@guardarevaluacionesperiodo']);
Route::get('asignaturas/{idseccion}/{idperiodo}', ['as' => 'asignaturas', 'uses' => 'EvaluacionesPeriodoController@asignaturas']);
Route::post('actualizarevaluacionesperiodo', ['as' => 'actualizarevaluacionesperiodo', 'uses' => 'EvaluacionesPeriodoController@actualizarevaluacionesperiodo']);
Route::post('eliminarevaluacionesperiodo/{id}', ['as' => 'eliminarevaluacionesperiodo', 'uses' => 'EvaluacionesPeriodoController@eliminarevaluacionesperiodo']);


//gestion de nominas
Route::get('missecciones', ['as' => 'missecciones', 'uses' => 'GestiondenominasController@missecciones']);

//Route::get('seccionesmodulodocentes', ['as' => 'secciondocente', 'uses' => 'GestiondenominasController@secciondocente']);
Route::get('vernominadeestudiantes/{id}', ['as' => 'nominadeestudiantes', 'uses' => 'GestiondenominasController@nominadeestudiantes']);

Route::get('vernominanotas/{seccion}/{asignatura}', ['as' => 'vernominanotas', 'uses' => 'GestiondenominasController@vernotasdeestudiantes']);


Route::get('expedientecompleto_modulodocente/{id}/{seccion_id}', ['as' => 'expedientecompleto_modulodocente', 'uses' => 'GestiondenominasController@expedientecompleto_modulodocente']);

Route::get('vercalificaciones_anio/{idestudiante}/{anio}/view', ['as' => 'calificaciones_estudiante', 'uses' => 'CalificacionesindividualadminController@vercalificaciones']);

//calificaciones

Route::get('registrarcalificacion', ['as' => 'registrarcalificaciones', 'uses' => 'CalificacionesController@registrarcalificaciones']);
Route::post('guardarcalificaciones', ['as' => 'guardarcalificaciones', 'uses' => 'CalificacionesController@guardarcalificaciones']); 
Route::post('listadoasignaturas/{idsec}', ['as' => 'listadoasignaturas', 'uses' => 'CalificacionesController@listadoasignaturas']); 
Route::post('listadoestudiantes/{id}', ['as' => 'listadoestudiantes', 'uses' => 'CalificacionesController@listadoestudiantes']);


//Consultar calificaiones individual
Route::get('vercalificacionesonline/{id}', 'CalificacionesindividualadminController@vercalificacionesonline')->name("vercalificacionesonline");


//expediente
Route::get('expedientedocente', ['as' => 'verexpedientedocente', 'uses' => 'PersonaldocenteController@verexpediente']);
//permisos
Route::post('permisosacumuladosdocentes/{id}/view', ['as' => 'permisosacumuladosdocentes', 'uses' => 'HistorialpermisosController@permisosacumuladosdocentes']);
Route::get('mihorariodeclases',['as'=>'mihorariodeclases', 'uses'=>'PersonaldocenteController@mihorariodeclases']);

Route::get('comprobantepermisodocente/{idsolicitud}', ['as' => 'comprobantepermisodocente', 'uses' => 'ConsultasyreportesController@comprobantepermisodocente']);

Route::get('historialsolicitudespermiso', ['as' => 'historialpermisos', 'uses' => 'HistorialpermisosController@verhistorial']);
Route::get('crearsolicitud', ['as' => 'crearsolicitud', 'uses' => 'HistorialpermisosController@crearsolicitud']);
Route::post('agregarsolicitud', ['as' => 'agregarsolicitud', 'uses' => 'HistorialpermisosController@agregarsolicitud']);
Route::get('verdetallesolicitud/{id}', ['as' => 'versolicitud', 'uses' => 'HistorialpermisosController@versolicitud']);
Route::get('editarsolicitud/{id}', ['as' => 'editarsolicitud', 'uses' => 'HistorialpermisosController@editarsolicitud']);
Route::put('actualizarsolicitud/{id}', ['as' => 'actualizarsolicitud', 'uses' => 'HistorialpermisosController@actualizarsolicitud']);
//asistencias estudiantes
Route::get('listaasistencias', ['as' => 'listaasistencias', 'uses' => 'ControlAsistenciaController@index']);
Route::get('tomarasistencialista', ['as' => 'tomarasistencialista', 'uses' => 'ControlAsistenciaController@tomarasistencialista']);
Route::post('tomarasistencia', ['as' => 'tomarasistencia', 'uses' => 'ControlAsistenciaController@tomarasistencia']);
Route::get('regresarasistencia/{id}/{fecha}/view', ['as' => 'regresarasistencia', 'uses' => 'ControlAsistenciaController@regresarasistencia']);
Route::get('agregarasistencia/{id}', ['as' => 'agregarasistencia', 'uses' => 'ControlAsistenciaController@agregarasistencia']);
Route::get('agregarausencia/{id}', ['as' => 'agregarausencia', 'uses' => 'ControlAsistenciaController@agregarausencia']);
Route::get('agregarpermiso/{id}', ['as' => 'agregarpermiso', 'uses' => 'ControlAsistenciaController@agregarpermiso']);
Route::post('listadoasistencia', ['as' => 'listadoasistencia', 'uses' => 'ControlAsistenciaController@listadoasistencia']);
//////////////////

//ASISTENCIA MEJORADA 
Route::get("/asistencia/tomarasistencia", "ControlAsistenciaController@marcarasistencia")->name("marcarasistencia_view");
Route::post('marcarasistencialista', ['as' => 'marcarasistencialistaestudiantes_view', 'uses' => 'ControlAsistenciaController@marcarasistencialistaestudiantes_view']);
Route::post('guardarasistenciasteacher', ['as' => 'guardarasistenciasteacher', 'uses' => 'ControlAsistenciaController@guardarasistenciasteacher']);
//Route::post("/inasistencia_estudiantes",  

//REPORTES PDF
Route::get('listareportesmodulodocentes','ConsultasyreportesController@listareportesmodulodocentes')->name('listareportes');

});//fin grupo de rutas para docente 

Route::group(['middleware'=>'BonoAdmin'], function(){
//BONOESCOLAR
//REPORTES PDF Y EXCEL
	
Route::post('cuadroresumendegastos_pdf', [
	'as' => 'cuadroresumendegastos_pdf', 
	'uses' => 'ConsultasyreportesController@cuadroresumendegastos_pdf'
]);

Route::get('cuadroresumendegastos_pdf', ['as' => 'cuadroresumendegastos_pdf', 'uses' => 'ConsultasyreportesController@cuadroresumendegastos_pdf']);//filtros para llamar al pdf

Route::get('librooperacionyfuncionamiento', ['as' => 'librooperacionyfuncionamiento', 'uses' => 'ConsultasyreportesController@librooperacionyfuncionamiento']);//filtros para llamar al pdf
Route::post('librooperacionyfuncionamiento_pdf', [
	'as' => 'librooperacionyfuncionamiento_pdf', 
	'uses' => 'ConsultasyreportesController@librooperacionyfuncionamiento_pdf'
]);


Route::post('historialperacionyfuncionamiento', ['as' => 'historialperacionyfuncionamiento', 'uses' => 'ConsultasyreportesController@historialperacionyfuncionamiento']);

Route::post('historialbancos', ['as' => 'historialbancos', 'uses' => 'ConsultasyreportesController@historialbancos']);

Route::get('librobancos', ['as' => 'librobancos', 'uses' => 'ConsultasyreportesController@librobancos']);

Route::post('librobancos_pdf', [
	'as' => 'librobancos_pdf', 
	'uses' => 'ConsultasyreportesController@librobancos_pdf'
]);


//TRANSACCIONES
Route::get('historialtransacciones', ['as' => 'historialtransacciones', 'uses' => 'TransaccionesbonoController@index']);
Route::get('vertransaccion/{id}', ['as' => 'vertransaccion', 'uses' => 'TransaccionesbonoController@vertransaccion']);
Route::get('editartransaccion/{id}', ['as' => 'editartransaccion', 'uses' => 'TransaccionesbonoController@editartransaccion']);
Route::get('eliminartransaccion/{id}', ['as' => 'eliminartransaccion', 'uses' => 'TransaccionesbonoController@eliminartransaccion']);

//INGRESOS
Route::get('listadeingresos', ['as' => 'historialingresos', 'uses' => 'IngresosController@index']);
Route::post('agregaringresos', ['as' => 'agregaringresos', 'uses' => 'IngresosController@agregaringresos']);
Route::post('guardaringresos', ['as' => 'guardaringresos', 'uses' => 'IngresosController@guardaringresos']);
Route::get('veringresos/{id}', ['as' => 'verdetalleingresos', 'uses' => 'IngresosController@verdetalleingresos']);
Route::get('editaringresos/{id}', ['as' => 'editardetalleingresos', 'uses' => 'IngresosController@editardetalleingresos']);
Route::put('actualizaringresos', ['as' => 'actualizardetalleingresos', 'uses' => 'IngresosController@actualizardetalleingresos']);
Route::post('listacuentasingresos', ['as' => 'listacuentasingresos', 'uses' => 'IngresosController@listacuentasingresos']);
Route::get('eliminaringreso/{id}', ['as' => 'eliminaringreso', 'uses' => 'IngresosController@eliminaringreso']);


//GASTOS
Route::get('listadegastos', ['as' => 'historialgastos', 'uses' => 'GastosController@index']);
Route::post('agregargastos', ['as' => 'agregargastos', 'uses' => 'GastosController@agregargastos']);
Route::post('guardargastos', ['as' => 'guardargastos', 'uses' => 'GastosController@guardargastos']);
Route::get('vergastos/{id}', ['as' => 'verdetallegastos', 'uses' => 'GastosController@verdetallegastos']);
Route::get('editargastos/{id}', ['as' => 'editardetallegastos', 'uses' => 'GastosController@editardetallegastos']);
Route::put('actualizargastos', ['as' => 'actualizargastos', 'uses' => 'GastosController@actualizargastos']);
Route::get('eliminargasto/{id}', ['as' => 'eliminargasto', 'uses' => 'GastosController@eliminargasto']);
Route::post('listacuentasgastos', ['as' => 'listacuentasgastos', 'uses' => 'GastosController@listacuentasgastos']);

//CHEQUES NULOS
Route::post('agregardocumentonulo', ['as' => 'agregardocumentonulo', 'uses' => 'TransaccionesbonoController@agregardocumentonulo']);
Route::post('guardardocumentonulo', ['as' => 'guardardocumentonulo', 'uses' => 'TransaccionesbonoController@guardardocumentonulo']);
Route::get('editardocumentonulo/{id}', ['as' => 'editardocumentonulo', 'uses' => 'TransaccionesbonoController@editardocumentonulo']);
Route::put('actualizardocumentonulo', ['as' => 'actualizardocumentonulo', 'uses' => 'TransaccionesbonoController@actualizardocumentonulo']);
Route::get('eliminardocumentonulo/{id}', ['as' => 'eliminardocumentonulo', 'uses' => 'TransaccionesbonoController@eliminardocumentonulo']);

//cotizaciones 
Route::get('listacotizaciones', ['as' => 'listacotizaciones', 'uses' => 'CotizacionesController@index']);
Route::get('agregarcotizacion', ['as' => 'agregarcotizacion', 'uses' => 'CotizacionesController@agregarcotizacion']);

Route::get('agregardetallecotizacion/{id}', ['as' => 'agregardetallecotizacion', 'uses' => 'CotizacionesController@agregardetallecotizacion']);

Route::post('guardarcotizacion', ['as' => 'guardarcotizacion', 'uses' => 'CotizacionesController@guardarcotizacion']);
Route::post('guardardetallecotizacion/{id}', ['as' => 'guardardetallecotizacion', 'uses' => 'CotizacionesController@guardardetallecotizacion']);
Route::get('editarcotizacion/{id}', ['as' => 'editarcotizacion', 'uses' => 'CotizacionesController@editarcotizacion']);
Route::put('actualizarcotizacion/{id}', ['as' => 'actualizarcotizacion', 'uses' => 'CotizacionesController@actualizarcotizacion']);

Route::get('editardetallecotizacion/{id}', ['as' => 'editardetallecotizacion', 'uses' => 'CotizacionesController@editardetallecotizacion']);

Route::put('actualizardetallecotizacion/{id}', ['as' => 'actualizardetallecotizacion', 'uses' => 'CotizacionesController@actualizardetallecotizacion']);
Route::get('vercotizacion/{id}', ['as' => 'vercotizacion', 'uses' => 'CotizacionesController@vercotizacion']);

Route::get('borrardetallecotizacion/{id}', ['as' => 'borrardetallecotizacion', 'uses' => 'CotizacionesController@borrardetallecotizacion']);
Route::get('borrarcotizacion/{id}', ['as' => 'borrarcotizacion', 'uses' => 'CotizacionesController@borrarcotizacion']);//borrar toda la cotizacion y detallecotizacion


Route::get('detallecotizacion/{id}', ['as' => 'detallecotizacion', 'uses' => 'CotizacionesController@detallecotizacion']);



//FONDOS DISPONIBLES (EJERCICIOS CONTABLE CUENTA OPERACION Y FUNCIONAMIENTO)
Route::get('listadepositodefondos', ['as' => 'listadepositodefondos', 'uses' => 'FondodisponibleController@index']);
Route::get('agregarregistrodefondo', ['as' => 'registrarfondo', 'uses' => 'FondodisponibleController@agregarregistrodefondo']);
Route::post('guardaregistrodefondo', ['as' => 'guardaregistrodefondo', 'uses' => 'FondodisponibleController@guardaregistrodefondo']);
Route::get('editarregistrodefondo/{id}', ['as' => 'editarregistrodefondo', 'uses' => 'FondodisponibleController@editarregistrodefondo']);
Route::put('actualizarregistrodefondo', ['as' => 'actualizarregistrodefondo', 'uses' => 'FondodisponibleController@actualizarregistrodefondo']);
Route::get('eliminarregistrodefondo/{id}', ['as' => 'eliminarregistrodefondo', 'uses' => 'FondodisponibleController@eliminarregistrodefondo']);
Route::get('liquidarfondo/{id}', ['as' => 'liquidarfondo', 'uses' => 'FondodisponibleController@liquidarfondo']);

//periodocontable
Route::get('periodocontable', ['as' => 'periodocontable', 'uses' => 'PeriodocontableController@index']);
Route::get('listadeperiodoscontable', ['as' => 'listaperiodocontable', 'uses' => 'PeriodocontableController@listaperiodocontable']);
Route::get('registrarperiodocontable', ['as' => 'registrarperiodocontable', 'uses' => 'PeriodocontableController@registrarperiodocontable']);
Route::post('guardarperiodocontable', ['as' => 'guardarperiodocontable', 'uses' => 'PeriodocontableController@guardarperiodocontable']);
Route::get('editarperiodocontable/{id}', ['as' => 'editarperiodocontable', 'uses' => 'PeriodocontableController@editarperiodocontable']);
Route::put('actualizarperiodocontable/{i}', ['as' => 'actualizarperiodocontable', 'uses' => 'PeriodocontableController@actualizarperiodocontable']);
Route::get('cerrarperiodocontable', ['as' => 'cerrarperiodocontable', 'uses' => 'PeriodocontableController@cerrarperiodocontable']);


//tipodecuentas
Route::get('listatipocuenta', ['as' => 'listatipocuenta', 'uses' => 'TipocuentascatalogoController@index']);
Route::get('creartipocuenta', ['as' => 'creartipocuenta', 'uses' => 'TipocuentascatalogoController@creartipocuenta']);
Route::get('editartipocuenta', ['as' => 'editartipocuenta', 'uses' => 'TipocuentascatalogoController@editartipocuenta']);
});//fin de grupo bonoescolar


//periodo matricula online
Route::get('controlperiodosdeinscripcion', ['as' => 'periododeinscripcionenlinea', 'uses' => 'PeriododeinscripcionController@index']);
Route::get('periododeinscripcionenlinea', ['as' => 'agregarperiodo', 'uses' => 'PeriododeinscripcionController@agregarperiodo']);
Route::get('editarperiododeinscripcion/{id}', ['as' => 'editarperiododeinscripcion', 'uses' => 'PeriododeinscripcionController@editarperiododeinscripcion']);
Route::put('actualizarperiododeinscripcion/{id}', ['as' => 'actualizarperiododeinscripcion', 'uses' => 'PeriododeinscripcionController@actualizarperiododeinscripcion']);
Route::post('guardarperiodoinscripcion', ['as' => 'guardarperiodoinscripcion', 'uses' => 'PeriododeinscripcionController@guardarperiodoinscripcion']);
Route::get('desactivarperiododeinscripcion/{id}', ['as' => 'desactivarperiododeinscripcion', 'uses' => 'PeriododeinscripcionController@desactivarperiododeinscripcion']);
 

//CICLO ACADEMICO
Route::get('controlciclosacademicos', ['as' => 'ciclosacademicos', 'uses' => 'PeriodoactivoController@index']);
Route::get('clausurarcicloacademico/{id}', ['as' => 'clausurarcicloacademico', 'uses' => 'PeriodoactivoController@clausurarcicloacademico']);
Route::get('registrarcicloacademico', ['as' => 'registrarcicloacademico', 'uses' => 'PeriodoactivoController@registrarcicloacademico']);
Route::post('guardarcicloacademico', ['as' => 'guardarcicloacademico', 'uses' => 'PeriodoactivoController@guardarcicloacademico']);
Route::get('editarcicloacademico/{id}', ['as' => 'editarcicloacademico', 'uses' => 'PeriodoactivoController@editarcicloacademico']);
Route::put('actualizarcicloacademico/{id}', ['as' => 'actualizarcicloacademico', 'uses' => 'PeriodoactivoController@actualizarcicloacademico']);
Route::get('definircicloacademicoactivo/{id}', ['as' => 'definircicloacademicoactivo', 'uses' => 'PeriodoactivoController@definircicloacademicoactivo']);

//PERIODOS DE EVALUACION
Route::get('listaperiodosdeevaluacion', ['as' => 'listaperiodosdeevaluacion', 'uses' => 'PeriodoevaluacionController@index']);
Route::get('registrarperiodoevaluacion', ['as' => 'registrarperiodoevaluacion', 'uses' => 'PeriodoevaluacionController@registrarperiodoevaluacion']);
Route::post('guardarperiodoevaluacion', ['as' => 'guardarperiodoevaluacion', 'uses' => 'PeriodoevaluacionController@guardarperiodoevaluacion']);
Route::get('editarperiodoevaluacion/{id}', ['as' => 'editarperiodoevaluacion', 'uses' => 'PeriodoevaluacionController@editarperiodoevaluacion']);
Route::put('actualizarperiodoevaluacion/{id}', ['as' => 'actualizarperiodoevaluacion', 'uses' => 'PeriodoevaluacionController@actualizarperiodoevaluacion']);
Route::get('eliminarperiodoevaluacion/{id}', ['as' => 'eliminarperiodoevaluacion', 'uses' => 'PeriodoevaluacionController@eliminarperiodoevaluacion']);



Route::group(['middleware'=>'RecursoHumanoAdmin'], function(){
//REPORTES
Route::get('expedienterh_pdf/{id}', [
	'as' => 'expedienterh_pdf', 
	'uses' => 'ConsultasyreportesController@expedienterh_pdf'
]);


//cuentausuario Recurso humano
Route::get('crearcuentausuariorrhh', ['as' => 'crearusuariorh', 'uses' => 'CrearcuentausuariorrhhController@index']);
Route::get('editarcuentausuariorrhh', ['as' => 'editarcuentausuariorh', 'uses' => 'CrearcuentausuariorrhhController@editarcuentausuario']);

// Asistencias recurso humano
Route::get('listaasistenciasrrhh', ['as' => 'listaasistenciasrh', 'uses' => 'AsistenciasrhController@index']);

Route::get('rrhh_tomarasistencia', ['as' => 'rrhh_tomarasistencia', 'uses' => 'AsistenciasrhController@rrhh_tomarasistencia']);


Route::get('tomarasistenciarrhh', ['as' => 'tomarasistenciarh', 'uses' => 'AsistenciasrhController@tomarasistenciarh']);

Route::post('agregarasistenciarrhh', ['as' => 'agregarasistenciarh', 'uses' => 'AsistenciasrhController@agregarasistenciarh']);

//Route::get('agregarasistenciarrhh', ['as' => 'agregarasistenciarh', 'uses' => 'AsistenciasrhController@agregarasistenciarh']);

Route::get('agregarausenciarrhh/{id}', ['as' => 'agregarausenciarh', 'uses' => 'AsistenciasrhController@agregarausenciarh']);
Route::post('listadoasistenciarrhh', ['as' => 'listadoasistenciarh', 'uses' => 'AsistenciasrhController@listadoasistenciarh']);
//AKIU


//Estudios y capacitaciones
Route::get('estudiosycapacitacionesrrhh/{id}', ['as' => 'estudiosycapacitacionesrrhh', 'uses' => 'EstudiosycapacitacionesrrhhController@index']);
Route::get('agregarestudios/{id}', ['as' => 'agregarestudios', 'uses' => 'EstudiosycapacitacionesrrhhController@agregarestudios']);
Route::post('guardarestudios', ['as' => 'guardarestudios', 'uses' => 'EstudiosycapacitacionesrrhhController@guardarestudios']);
Route::get('editarestudios/{id}', ['as' => 'editarestudios', 'uses' => 'EstudiosycapacitacionesrrhhController@editarestudios']);
Route::put('actualizarestudios', ['as' => 'actualizarestudios', 'uses' => 'EstudiosycapacitacionesrrhhController@actualizarestudios']);


// Expedientes recurso humano
Route::get('listaexpedientesrrhh', ['as' => 'listaexpedientesrh', 'uses' => 'ExpedientesrrhhController@index']);
Route::get('crearexpedientesrrhh', ['as' => 'crearexpedientesrh', 'uses' => 'ExpedientesrrhhController@crearexpedienterh']);
Route::get('crearusuariorrhh/{id}', ['as' => 'crearusuariorh', 'uses' => 'ExpedientesrrhhController@crearusuariorh']);
Route::get('verexpedienterrhh/{id}', ['as' => 'verexpedienterh', 'uses' => 'ExpedientesrrhhController@verexpedienterh']);
Route::get('editarexpedienterrhh/{id}', ['as' => 'editarexpedienterh', 'uses' => 'ExpedientesrrhhController@editarexpedienterh']);
Route::get('editarusuariorrhh/{id}', ['as' => 'editarusuariorh', 'uses' => 'ExpedientesrrhhController@editarusuariorh']);
Route::put('actualizarexpedienterh/{id}', ['as' => 'actualizarexpedienterh', 'uses' => 'ExpedientesrrhhController@actualizarexpedienterh']);
Route::put('actualizarusuariorh/{id}', ['as' => 'actualizarusuariorh', 'uses' => 'ExpedientesrrhhController@actualizarusuariorh']);
Route::post('agregarexpedienterh', ['as' => 'agregarexpedienterh', 'uses' => 'ExpedientesrrhhController@agregarexpedienterh']);
Route::post('agregarusuariorh', ['as' => 'agregarusuariorh', 'uses' => 'ExpedientesrrhhController@agregarusuariorh']);
Route::get('eliminarexpedienterh/{id}', ['as' => 'eliminarexpedienterh', 'uses' => 'ExpedientesrrhhController@eliminarexpedienterh']);
Route::get('cargorh', ['as' => 'cargorh', 'uses' => 'ExpedientesrrhhController@cargo']);
Route::get('esperh', ['as' => 'esperh', 'uses' => 'ExpedientesrrhhController@espe']);
Route::get('tiporh', ['as' => 'tiporh', 'uses' => 'ExpedientesrrhhController@tipo']);
Route::get('listaexpedientesdesactivadosrrhh', ['as' => 'listaexpedientesdesactivadosrh', 'uses' => 'ExpedientesrrhhController@listadodesactivado']);
Route::get('activarexpedienterrhh/{id}', ['as' => 'activarexpedienterh', 'uses' => 'ExpedientesrrhhController@activarexpedienterh']);
Route::get('verexpedientedesactivadorrhh/{id}', ['as' => 'verexpedientedesactivadorh', 'uses' => 'ExpedientesrrhhController@verexpedientedesactivadorh']);

Route::get('horariodeclases_docente/{id}', ['as' => 'horariodeclases_docente', 'uses' => 'ExpedientesrrhhController@horariodeclases_docente']); 
Route::get('consultahistorialasistencia_docente', ['as' => 'consultahistorialasistencia_docente', 'uses' => 'AsistenciasrhController@consultahistorialasistencia_docente']);  
Route::post('consultalistadoasistenciarh', ['as' => 'consultalistadoasistenciarh', 'uses' => 'AsistenciasrhController@consultalistadoasistenciarh']); 

Route::post('historialasistencia_docente', ['as' => 'historialasistencia_docente', 'uses' => 'ExpedientesrrhhController@historialasistencia_docente']); 


//Horarios Recurso Humano
Route::get('listaempleados', ['as' => 'listaempleados', 'uses' => 'HorariosEmpleadosController@index']);
Route::get('crearhorario/{id}', ['as' => 'crearhorario', 'uses' => 'HorariosEmpleadosController@crearhorario']);
Route::post('agregarhorario', ['as' => 'agregarhorario', 'uses' => 'HorariosEmpleadosController@agregarhorario']);
Route::get('editarhorario/{id}', ['as' => 'editarhorario', 'uses' => 'HorariosEmpleadosController@editarhorario']);
Route::put('actualizarhorario/{id}', ['as' => 'actualizarhorario', 'uses' => 'HorariosEmpleadosController@actualizarhorario']);
Route::get('verhorario/{id}', ['as' => 'verhorario', 'uses' => 'HorariosEmpleadosController@verhorario']);

//Permisos  recurso humano
Route::get('listasolicitudespermiso', ['as' => 'listapermisosrh', 'uses' => 'SolicitudespermisosrhController@index']);
Route::get('versolicitudpermiso/{id}', ['as' => 'versolicitudespermisorh', 'uses' => 'SolicitudespermisosrhController@versolicitud']);
Route::get('crearsolicitudpermiso', ['as' => 'crearsolicitudespermisorh', 'uses' => 'SolicitudespermisosrhController@crearsolicitud']);
Route::get('editarsolicitudpermiso/{id}', ['as' => 'editarsolicitudespermisorh', 'uses' => 'SolicitudespermisosrhController@editarsolicitud']);
Route::post('agregarsolicitudpermiso', ['as' => 'agregarsolicitudespermisorh', 'uses' => 'SolicitudespermisosrhController@agregarsolicitud']);
Route::put('actualizarsolicitudpermiso/{id}', ['as' => 'actualizarsolicitudespermisorh', 'uses' => 'SolicitudespermisosrhController@actualizarsolicitud']);
Route::get('aprobarsolicitudpermiso/{id}', ['as' => 'aprobarsolicitudespermisorh', 'uses' => 'SolicitudespermisosrhController@aprobarsolicitud']);
Route::get('denegarsolicitudpermiso/{id}', ['as' => 'denegarsolicitudespermisorh', 'uses' => 'SolicitudespermisosrhController@denegarsolicitud']);
Route::post('resumenpermisosrh', ['as' => 'resumenpermisosrh', 'uses' => 'SolicitudespermisosrhController@resumenpermisosrh']);

Route::get('imprimircomprobantepermiso/{id}', ['as' => 'imprimircomprobantepermiso', 'uses' => 'ConsultasyreportesController@imprimircomprobantepermiso']);

Route::get('rptpermisosrrhh/{mes}/{anio}/pdf', ['as' => 'reportePermisosrrhh', 'uses' => 'ConsultasyreportesController@permisosrrhh_pdf']);

Route::post('horarioclasesrrhh/{docente}/{anio}/pdf', ['as' => 'horarioclasesrrhh', 'uses' => 'ConsultasyreportesController@horarioclasesrrhh']);

Route::get('/rptpermisosexcelrrhh/{mes}/{anio}/excel', ['as' => 'reportePermisosrrhhexcel', 'uses' => 'ExcelController@permisosrrhh_excel']);

Route::post("reporteAsistenciarrhh/{mes}/pdf", ['as'=>'reporteAsistenciarrhh','uses'=>'ConsultasyreportesController@reporteAsistenciarrhh_pdf']);

Route::post("asistenciamensualrh/{mes}/{anio}/pdf", ['as'=>'asistenciamensualrh','uses'=>'ConsultasyreportesController@asistenciamensualrh']);

Route::get('/rptasistenciaexcelrrhh/{mes}/{anio}/excel', ['as' => 'rptasistenciaexcelrrhh', 'uses' => 'ExcelController@rptasistenciaexcelrrhh']);

});//fin group RRHH

//configuraciones recurso humano - tipo cargo
Route::get('listatipocargorh', ['as' => 'listatipocargorh', 'uses' => 'CargosrhController@index']);
Route::get('creartipocargorh', ['as' => 'creartipocargorh', 'uses' => 'CargosrhController@creartipocargo']);
Route::get('editartipocargorh/{id}', ['as' => 'editartipocargorh', 'uses' => 'CargosrhController@editartipocargo']);
Route::post('agregartipocargorh', ['as' => 'agregartipocargorh', 'uses' => 'CargosrhController@agregartipocargo']);
Route::put('actualizartipocargorh/{id}', ['as' => 'actualizartipocargorh', 'uses' => 'CargosrhController@actualizartipocargo']);
Route::get('eliminartipocargorh/{id}', ['as' => 'eliminartipocargorh', 'uses' => 'CargosrhController@eliminartipocargo']);

//configuraciones recurso humano - tipo personal
Route::get('listatipopersonalrh', ['as' => 'listatipopersonalrh', 'uses' => 'TipopersonalrhController@index']);
Route::get('creartipopersonalrh', ['as' => 'creartipopersonalrh', 'uses' => 'TipopersonalrhController@creartipopersonal']);
Route::get('editartipopersonalrh/{id}', ['as' => 'editartipopersonalrh', 'uses' => 'TipopersonalrhController@editartipopersonal']);
Route::post('agregartipopersonalrh', ['as' => 'agregartipopersonalrh', 'uses' => 'TipopersonalrhController@agregartipopersonal']);
Route::put('actualizartipopersonalrh/{id}', ['as' => 'actualizartipopersonalrh', 'uses' => 'TipopersonalrhController@actualizartipopersonal']);
Route::get('eliminartipopersonalrh/{id}', ['as' => 'eliminartipopersonalrh', 'uses' => 'TipopersonalrhController@eliminartipopersonal']);

//configuraciones recurso humano - especialidades
Route::get('listaespecialidadrh', ['as' => 'listaespecialidadrh', 'uses' => 'EspecialidadesrhController@index']);
Route::get('crearespecialidadrh', ['as' => 'crearespecialidadrh', 'uses' => 'EspecialidadesrhController@crearespecialidad']);
Route::get('editarespecialidadrh/{id}', ['as' => 'editarespecialidadrh', 'uses' => 'EspecialidadesrhController@editarespecialidad']);
Route::post('agregarespecialidadrh', ['as' => 'agregarespecialidadrh', 'uses' => 'EspecialidadesrhController@agregarespecialidad']);
Route::put('actualizarespecialidadrh/{id}', ['as' => 'actualizarespecialidadrh', 'uses' => 'EspecialidadesrhController@actualizarespecialidad']);
Route::get('eliminarespecialidadrh/{id}', ['as' => 'eliminarespecialidadrh', 'uses' => 'EspecialidadesrhController@eliminarespecialidad']);

//configuraciones recurso humano - tipo permisos
Route::get('listatipopermisosrh', ['as' => 'listatipopermisosrh', 'uses' => 'TipopermisorhController@index']);
Route::get('creartipopermisosrh', ['as' => 'creartipopermisosrh', 'uses' => 'TipopermisorhController@creartipopermisos']);
Route::get('editartipopermisosrh/{id}', ['as' => 'editartipopermisosrh', 'uses' => 'TipopermisorhController@editartipopermisos']);
Route::post('agregartipopermisosrh', ['as' => 'agregartipopermisosrh', 'uses' => 'TipopermisorhController@agregartipopermisos']);
Route::put('actualizartipopermisosrh/{id}', ['as' => 'actualizartipopermisosrh', 'uses' => 'TipopermisorhController@actualizartipopermisos']);
Route::get('eliminartipopermisosrh/{id}', ['as' => 'eliminartipopermisosrh', 'uses' => 'TipopermisorhController@eliminartipopermisos']);


//configuraciones recurso humano -MOTIVO PERMISOS
Route::get('listamotivopermisosrh', ['as' => 'listamotivopermisosrh', 'uses' => 'MotivopermisosrhController@index']);
Route::get('crearmotivopermisosrh', ['as' => 'crearmotivopermisosrh', 'uses' => 'MotivopermisosrhController@crearmotivopermisos']);




///////////////////////////////////////////////////////////////////

//configuraciones activo fijo - instituciones destino
Route::get('listainstituciones', ['as' => 'listainstituciones', 'uses' => 'InstitucionesDestinoController@index']);
Route::get('crearinstitucion', ['as' => 'crearinstitucion', 'uses' => 'InstitucionesDestinoController@crearinstitucion']);
Route::get('editarinstitucion/{id}', ['as' => 'editarinstitucion', 'uses' => 'InstitucionesDestinoController@editarinstitucion']);
Route::post('agregarinstitucion', ['as' => 'agregarinstitucion', 'uses' => 'InstitucionesDestinoController@agregarinstitucion']);
Route::put('actualizarinstitucion/{id}', ['as' => 'actualizarinstitucion', 'uses' => 'InstitucionesDestinoController@actualizarinstitucion']);
Route::get('eliminarinstitucion/{id}', ['as' => 'eliminarinstitucion', 'uses' => 'InstitucionesDestinoController@eliminarinstitucion']);
Route::get('verinstitucion/{id}', ['as' => 'verinstitucion', 'uses' => 'InstitucionesDestinoController@verinstitucion']);

Route::group(['middleware'=>'Estudiante'], function(){
//MODULO ONLINE ESTUDIANTES
Route::get('solicitudmatriculaenlinea', ['as' => 'llenarsolicitudmatricula','uses' => 'ModuloestudianteonlineController@registrarsolicitudmatricula']);
Route::get('avisoprimeramatricula', ['as' => 'avisoprimeramatricula','uses' => 'ModuloestudianteonlineController@avisoprimeramatricula']);
Route::get('avisomatriculaonline', ['as' => 'avisomatriculaonline','uses' => 'ModuloestudianteonlineController@avisomatriculaonline']);
Route::get('aviso_estudiantematriculado', ['as' => 'aviso_estudiantematriculado','uses' => 'ModuloestudianteonlineController@aviso_estudiantematriculado']);
Route::get('avisohorarioclases', ['as' => 'avisohorarioclases','uses' => 'ModuloestudianteonlineController@avisohorarioclases']);
Route::post('guardarsolicitudmatriculaonline', ['as' => 'guardarsolicitudmatriculaonline','uses' => 'ModuloestudianteonlineController@guardarsolicitudmatriculaonline']);
Route::get('comprobantematriculaenlinea/{idestudiante}/pdf', ['as' => 'comprobantematricula_pdf','uses' => 'ConsultasyreportesController@comprobantematriculaenlinea_pdf']);
Route::get('verexpedienteonline/{id}', ['as' => 'verexpedienteonline','uses' => 'ModuloestudianteonlineController@verexpedienteonline']);
Route::get('seccionesonline/{id}', ['as' => 'seccionesonline', 'uses' => 'ModuloestudianteonlineController@seccionesonline']);
Route::get('turnosonline/{id}', ['as' => 'turnosonline', 'uses' => 'ModuloestudianteonlineController@turnosonline']);
Route::get('horariodeclasesestudianteonline/{id}', ['as' => 'horariodeclases_estudiante', 'uses' => 'ModuloestudianteonlineController@horariodeclasesestudianteonline']);

Route::get('historialcalificacionesestudiante/{id}/view', ['as' => 'historialcalificacionesestudianteonline', 'uses' => 'ModuloestudianteonlineController@calificacionesestudianteonline']);
Route::get('trimestres/{id}', ['as' => 'trimestres', 'uses' => 'ModuloestudianteonlineController@trimestres']);
Route::post('detallecalificacionesonline', ['as' => 'calificacionesonline', 'uses' => 'ModuloestudianteonlineController@detallecalificacionesonline']);


});//fin GRUPO MODULO ONLINE ESTUDIANTES

 Route::group(['middleware'=>'AcademicoAdmin'], function(){

//ESTADISTICAS ACADEMICA
Route::get('listaestadisticas', ['as' => 'listaestadisticas', 'uses' => 'EstadisticasController@index']);
	Route::get('matriculadosGrado', ['as' => 'matriculadosGrado', 'uses' => 'EstadisticasController@matriculadosGrado']);
	Route::post('buscarMatriculadosGrado', ['as' => 'buscarMatriculadosGrado', 'uses' => 'EstadisticasController@buscarMatriculadosGrado']);
	Route::get('matriculadosAño', ['as' => 'matriculadosAño', 'uses' => 'EstadisticasController@matriculadosAño']);
	Route::post('buscarMatriculadosAño', ['as' => 'buscarMatriculadosAño', 'uses' => 'EstadisticasController@buscarMatriculadosAño']);

	 Route::get('estadisticamatriculaescolarCE_pdf/{anio}/viewrpt', [
	'as' => 'estadisticamatriculaescolarCE_pdf', 
	'uses' => 'ConsultasyreportesController@estadisticamatriculaescolarCE_pdf']);
    
    Route::get('historialmatriculaescolarCE_pdf', [
  'as' => 'historialmatriculaescolarCE_pdf', 
  'uses' => 'ConsultasyreportesController@historialmatriculaescolarCE_pdf']);

/*
	//GRAFICOS CON FILTRO
Route::get('listado_graficas', ['as' => 'estadisticasgraficas', 'uses' => 'GraficasController@index']);
Route::get('grafica_registros/{anio}/{mes}', 'GraficasController@registros_mes');
//GRAFICOS LOAD PAGINA DE INCIO

Route::get('graficobarra_matriculasporgrado', ['as' => 'matriculasporgrado_graphics', 'uses' => 'GraficasController@matriculaporgrado_onload']);
Route::get('graficadebarras_historialmatricula/{anio}', 'GraficasController@matriculaporanio_graphics');
Route::get('graficadelineasmatriculaanual/{anio}', 'GraficasController@matriculasanuales_graphics');
Route::get('graficadepastel_estudiantesactivos', 'GraficasController@estudiantesactivos_graphics');
*/

 	//Horarios-Clases
Route::get('listadohorariosclase', ['as' => 'listadohorariosclase', 'uses' => 'HorariosClaseController@index']);
Route::get('crearhorariosclase', ['as' => 'crearhorariosclase', 'uses' => 'HorariosClaseController@crearhorariosclase']);	
Route::get('cargarhorarios', ['as' => 'cargarhorarios','uses' => 'HorariosClaseController@cargarhorarios']);
Route::post('guardarhorarios', ['as' => 'guardarhorarios','uses' => 'HorariosClaseController@guardarhorarios']);
Route::get('verhorariosclase/{id}', ['as' => 'verhorariosclase', 'uses' => 'HorariosClaseController@verhorariosclase']);	
Route::get('editarhorariosclase/{id}', ['as' => 'editarhorariosclase', 'uses' => 'HorariosClaseController@editarhorariosclase']);
Route::put('actualizarhorarios', ['as' => 'actualizarhorarios','uses' => 'HorariosClaseController@actualizarhorarios']);
Route::get('eliminarhorariosclase/{id}', ['as' => 'eliminarhorariosclase', 'uses' => 'HorariosClaseController@eliminarhorariosclase']);

// gestion de matricula
Route::get('listadealumnosmatriculados', ['as' => 'listadematriculados', 'uses' => 'MatriculasController@index']);//ok
Route::get('matricula', ['as' => 'matricula','uses' => 'MatriculasController@registrarmatricula']);
Route::post('guardarmatricula', ['as' => 'guardarmatricula','uses' => 'MatriculasController@guardarmatricula']);
Route::get('familiaresporestudiante/{id}', ['as' => 'familiaresporestudiante', 'uses' => 'MatriculasController@familiaresporestudiante']);
Route::get('matriculaestudianteanio/{anio}', ['as' => 'prematricula', 'uses' => 'MatriculasController@matriculaestudianteanio']);

Route::get('vermatricula/{idestudiante}/{idmatricula}/{idseccion}', ['as' => 'vermatricula','uses' => 'MatriculasController@vermatricula']);
Route::get('editarmatricula/{idestudiante}/{idmatricula}/{idseccion}', ['as' => 'editarmatricula','uses' => 'MatriculasController@editarmatricula']);
Route::put('actualizarmatricula/{idestudiante}/{idmatricula}/{idseccion}', ['as' => 'actualizarmatricula','uses' => 'MatriculasController@actualizarmatricula']);
Route::get('retirarmatricula/{idestudiante}/{idseccion}', ['as' => 'retirarmatricula','uses' => 'MatriculasController@retirarmatricula']);
//REPORTES
Route::get('alumnosmatriculados/{id}/acadrpt', ['as' => 'alumnosmatriculados', 'uses' => 'ConsultasyreportesController@alumnosmatriculadosporseccion']);



//gestion solicitudes online
Route::get('solicitudespendientesdeaprobar', ['as' => 'listasolicitudesmatricula','uses' => 'MatriculasController@listadesolicitudesenlinea']);
Route::get('verdetallematriculaonline/{id}', ['as' => 'vermatriculaonline','uses' => 'MatriculasController@verdetallematriculaonline']);
Route::get('aprobarsolicitudmatriculaonline/{idestudiante}/{idseccion}', ['as' => 'aprobarsolicitudmatriculaonline','uses' => 'MatriculasController@aprobarsolicitudmatriculaonline']);
Route::get('eliminarsolicitudmatriculaonline/{idestudiante}/{idseccion}', ['as' => 'eliminarsolicitudmatriculaonline','uses' => 'MatriculasController@eliminarsolicitudmatriculaonline']);
Route::get('editarsolicitudmatriculaonline/{idestudiante}/{idmatricula}/{idseccion}', ['as' => 'editarsolicitudmatriculaonline','uses' => 'MatriculasController@editarsolicitudmatriculaonline']);
Route::put('actualizarmatriculaonline/{idestudiante}/{idmatricula}/{idseccion}', ['as' => 'actualizarmatriculaonline','uses' => 'MatriculasController@actualizarmatriculaonline']);

Route::get('secciones/{id}', ['as' => 'secciones', 'uses' => 'MatriculasController@secciones']);
Route::get('turnos/{id}', ['as' => 'turnos', 'uses' => 'MatriculasController@turnos']);

// gestion de Expediente estudiantes
Route::get('listadeexpedientesinactivos', ['as' => 'listadeexpedientesinactivos', 'uses' => 'GestionexpedientesestudiantesController@listadeexpedientesinactivos']);
Route::get('activarexpedientesinactivosest/{id}', ['as' => 'activarexpedientesinactivosest', 'uses' => 'GestionexpedientesestudiantesController@activarexpedientesinactivosest']);

Route::get('listadeexpedientesactivos', ['as' => 'listaexpedientes', 'uses' => 'GestionexpedientesestudiantesController@index']);
Route::get('registrardatospersonalestudiante', ['as' => 'registrardatospersonalesexpediente', 'uses' => 'GestionexpedientesestudiantesController@registrardatospersonales']);
Route::post('guardardatospersonalesestudiante', ['as' => 'guardardatospersonalesestudiante', 'uses' => 'GestionexpedientesestudiantesController@guardardatospersonalesestudiante']);
Route::get('registrarusuarioestudiante/{id}', ['as' => 'registrarcuentadeusuarioestudiante', 'uses' => 'GestionexpedientesestudiantesController@registrarcuentausuarioestudiante']);
Route::post('guardarcuentausuarioestudiante', ['as' => 'guardarcuentausuarioestudiante', 'uses' => 'GestionexpedientesestudiantesController@guardarcuentausuarioestudiante']);
Route::get('registrardatosmedicosestudiante/{id}', ['as' => 'registrardatosmedicosestudiante', 'uses' => 'GestionexpedientesestudiantesController@registrardatosmedicos']);
Route::post('guardardatosmedicosestudiante', ['as' => 'guardardatosmedicosestudiante', 'uses' => 'GestionexpedientesestudiantesController@guardardatosmedicosestudiante']);
Route::get('registrarfamiliaresestudiantes/{id}', ['as' => 'registrarfamiliares', 'uses' => 'GestionexpedientesestudiantesController@registrarfamiliares']);
Route::post('guardarfamiliaresestudiantes', ['as' => 'guardarfamiliaresestudiantes', 'uses' => 'GestionexpedientesestudiantesController@guardarfamiliaresestudiantes']);
Route::get('municipios/{id}', ['as' => 'municipios', 'uses' => 'GestionexpedientesestudiantesController@municipios']);
Route::get('colonias/{id}', ['as' => 'colonias', 'uses' => 'GestionexpedientesestudiantesController@colonias']);
Route::get('vercalificacionesexpediente/{id}/{anio}/view', ['as' => 'vercalificacionesexpediente', 'uses' => 'CalificacionesindividualadminController@vercalificacionexpedienteadmin']);

Route::get('verexpedienteestudiantes/{id}', ['as' => 'verexpedienteestudiantes', 'uses' => 'GestionexpedientesestudiantesController@verexpedienteestudiantes']);
Route::get('editarexpedienteestudiante/{id}', ['as' => 'editarexpedienteestudiante', 'uses' => 'GestionexpedientesestudiantesController@editarexpedienteestudiante']);

Route::get('editardatospersonalesestudiante/{id}', ['as' => 'editardatospersonalesestudiante', 'uses' => 'GestionexpedientesestudiantesController@editardatospersonalesestudiante']);
Route::put('actualizardatospersonalesestudiante/{id}', ['as' => 'actualizardatospersonalesestudiante', 'uses' => 'GestionexpedientesestudiantesController@actualizardatospersonalesestudiante']);
Route::get('editardatosmedicosestudiante/{id}', ['as' => 'editardatosmedicosestudiante', 'uses' => 'GestionexpedientesestudiantesController@editardatosmedicosestudiante']);
Route::put('actualizardatosmedicosestudiante/{id}', ['as' => 'actualizardatosmedicosestudiante', 'uses' => 'GestionexpedientesestudiantesController@actualizardatosmedicosestudiante']);
Route::get('listadofamiliares', ['as' => 'listadofamiliares', 'uses' => 'GestionexpedientesestudiantesController@listadofamiliares']);


/*
Route::get('editarexpedienteestudiante/{id}', ['as' => 'editarexpedienteestudiante', 'uses' => 'GestionexpedientesestudiantesController@editarexpedienteestudiante']);
Route::put('actualizarexpedienteestudiante/{id}', ['as' => 'actualizarexpedienteestudiante', 'uses' => 'GestionexpedientesestudiantesController@actualizarexpedienteestudiante']);
*/


Route::POST('eliminarexpedienteestudiante', ['as' => 'eliminarexpedienteestudiante', 'uses' => 'GestionexpedientesestudiantesController@eliminarexpedienteestudiante']);
Route::get('eliminarrelacionfamiliarestudiante/{id}', ['as' => 'eliminarrelacionfamiliarestudiante', 'uses' => 'GestionexpedientesestudiantesController@eliminarrelacionfamiliarestudiante']);


//padres de familia
Route::get('gestionarpadresdefamilia', ['as' => 'listafamiliares', 'uses' => 'GestionpadresdefamiliaController@index']);
Route::get('agregarpadredefamilia', ['as' => 'agregarfamiliar', 'uses' => 'GestionpadresdefamiliaController@agregarfamiliar']);
Route::post('guardarpadredefamilia', ['as' => 'guardarfamiliar', 'uses' => 'GestionpadresdefamiliaController@guardarfamiliar']);
Route::get('agregarusuariofamiliar/{id}', ['as' => 'agregarusuariofamiliar', 'uses' => 'GestionpadresdefamiliaController@agregarusuariofamiliar']);
Route::post('guardarusuariofamiliar', ['as' => 'guardarusuariofamiliar', 'uses' => 'GestionpadresdefamiliaController@guardarusuariofamiliar']);
Route::get('editarpadredefamilia/{id}', ['as' => 'editarpadredefamilia', 'uses' => 'GestionpadresdefamiliaController@editarpadredefamilia']);
Route::put('actualizarpadredefamilia/{id}', ['as' => 'actualizarpadredefamilia', 'uses' => 'GestionpadresdefamiliaController@actualizarpadredefamilia']);
Route::get('verpadredefamilia/{id}', ['as' => 'verpadredefamilia', 'uses' => 'GestionpadresdefamiliaController@verpadredefamilia']);
Route::get('eliminarpadredefamilia/{id}', ['as' => 'eliminarpadredefamilia', 'uses' => 'GestionpadresdefamiliaController@eliminarpadredefamilia']);
Route::get('gestionpadresdefamiliainactivos', ['as' => 'listafamiliaresinactivos', 'uses' => 'GestionpadresdefamiliaController@gestiondepadresdefamiliainactivos']);
Route::get('activarexpedientesinactivos/{id}', ['as' => 'activarexpedientesinactivos', 'uses' => 'GestionpadresdefamiliaController@activarexpedientesinactivos']);


//BLOQUE HORARIOS DE CLASES
Route::get('listabloquehorarios', ['as' => 'listabloquehorarios', 'uses' => 'BloqueHorariosController@index']);
Route::get('agregarbloquehorarios', ['as' => 'agregarbloquehorarios', 'uses' => 'BloqueHorariosController@agregarbloquehorarios']);
Route::post('guardarbloquehorarios', ['as' => 'guardarbloquehorarios', 'uses' => 'BloqueHorariosController@guardarbloquehorarios']);
Route::get('editarbloquehorarios/{id}', ['as' => 'editarbloquehorarios', 'uses' => 'BloqueHorariosController@editarbloquehorarios']);
Route::put('actualizarbloquehorarios/{id}', ['as' => 'actualizarbloquehorarios', 'uses' => 'BloqueHorariosController@actualizarbloquehorarios']);
Route::get('eliminarbloquehorarios/{id}', ['as' => 'eliminarbloquehorarios', 'uses' => 'BloqueHorariosController@eliminarbloquehorarios']);

//Grados
Route::get('agregargrado', ['as' => 'agregargrado', 'uses' => 'GradosController@agregargrado']);
Route::post('guardargrado', ['as' => 'guardargrado', 'uses' => 'GradosController@guardargrado']);
Route::get('listagrados', ['as' => 'listagrados', 'uses' => 'GradosController@index']);
Route::get('editargrado/{id}', ['as' => 'editargrado', 'uses' => 'GradosController@editargrado']);
Route::put('actualizargrado/{id}', ['as' => 'actualizargrado', 'uses' => 'GradosController@actualizargrado']);
Route::get('desactivargrado/{id}', ['as' => 'desactivargrado', 'uses' => 'GradosController@desactivargrado']);

//Turnos
Route::get('agregarturno', ['as' => 'agregarturno', 'uses' => 'TurnosController@agregarturno']);
Route::post('guardarturno', ['as' => 'guardarturno', 'uses' => 'TurnosController@guardarturno']);
Route::get('listaturnos', ['as' => 'listaturnos', 'uses' => 'TurnosController@index']);
Route::get('editarturno/{id}', ['as' => 'editarturno', 'uses' => 'TurnosController@editarturno']);
Route::put('actualizarturno/{id}', ['as' => 'actualizarturno', 'uses' => 'TurnosController@actualizarturno']);
Route::get('desactivarturno/{id}', ['as' => 'desactivarturno', 'uses' => 'TurnosController@desactivarturno']);

//Secciones
Route::get('agregarseccion', ['as' => 'agregarseccion', 'uses' => 'SeccionesController@agregarseccion']);
Route::post('agregarseccion', ['as' => 'guardarseccion', 'uses' => 'SeccionesController@guardarseccion']);
Route::get('listasecciones', ['as' => 'listasecciones', 'uses' => 'SeccionesController@index']);

Route::get('duplicarsecciones', ['as' => 'duplicarsecciones', 'uses' => 'SeccionesController@duplicarsecciones']);

Route::get('asignarsesordeseccion/{id}/view', ['as' => 'asignarasesor', 'uses' => 'SeccionesController@asignarasesordeseccion']);

Route::get('verseccion/{id}', ['as' => 'verseccion', 'uses' => 'SeccionesController@verseccion']);
Route::get('editarseccion/{id}', ['as' => 'editarseccion', 'uses' => 'SeccionesController@editarseccion']);
Route::put('actualizarseccion/{id}', ['as' => 'actualizarseccion', 'uses' => 'SeccionesController@actualizarseccion']);
Route::get('desactivarseccion/{id}', ['as' => 'desactivarseccion', 'uses' => 'SeccionesController@desactivarseccion']);

Route::get('asesorseccionnormal', ['as' => 'asesorseccionnormal', 'uses' => 'SeccionesController@asesorseccionnormal']);
Route::get('asesorseccionintegrada', ['as' => 'asesorseccionintegrada', 'uses' => 'SeccionesController@asesorseccionintegrada']);
Route::get('asesorseccionnormaledit/id', ['as' => 'asesorseccionnormaledit', 'uses' => 'SeccionesController@asesorseccionnormaledit']);

//Asignaturas
Route::get('listaasignaturas', ['as' => 'listaasignaturas', 'uses' => 'AsignaturasController@index']);
Route::get('agregarasignatura', ['as' => 'agregarasignatura', 'uses' => 'AsignaturasController@agregarasignatura']);
Route::post('guardarasignatura', ['as' => 'guardarasignatura', 'uses' => 'AsignaturasController@guardarasignatura']);
Route::get('editarasignatura/{id}', ['as' => 'editarasignatura', 'uses' => 'AsignaturasController@editarasignatura']);
Route::put('actualizarasignatura/{id}', ['as' => 'actualizarasignatura', 'uses' => 'AsignaturasController@actualizarasignatura']);
Route::get('desactivarasignatura/{id}', ['as' => 'desactivarasignatura', 'uses' => 'AsignaturasController@desactivarasignatura']);
Route::get('asignarasignaturaporseccion/{id}', ['as' => 'asignarasignaturaporseccion', 'uses' => 'AsignaturasController@asignarasignaturaporseccion']);
Route::post('guardarasignaturaporseccion', ['as' => 'guardarasignaturaporseccion', 'uses' => 'AsignaturasController@guardarasignaturaporseccion']);
});//fin del grupo de rutas para adminacademico

//SACARE RUTAS DE REPORTES FUERA DEL MIDDLEWARE ACADEMICA, PARA PODER ACCEDER A ELLOS DESDE DIFERENTES NIVELES DE USUARIO(DOCENTES, ADMIN ACADEMICO, ADIMISTRADOR GLOBAL SIN PROBLEMAS DE PRIVILEGIOS)

Route::get('listado_graficas', ['as' => 'estadisticasgraficas', 'uses' => 'GraficasController@index']);
Route::get('grafica_registros/{anio}/{mes}', 'GraficasController@registros_mes');

//GRAFICOS LOAD PAGINA DE INCIO

Route::get('graficobarra_matriculasporgrado', ['as' => 'matriculasporgrado_graphics', 'uses' => 'GraficasController@matriculaporgrado_onload']);
Route::get('graficadebarras_historialmatricula/{anio}', 'GraficasController@matriculaporanio_graphics');
Route::get('graficadelineasmatriculaanual/{anio}', 'GraficasController@matriculasanuales_graphics');
Route::get('graficadepastel_estudiantesactivos', 'GraficasController@estudiantesactivos_graphics');


//REPORTES PDF Y EXCEL
//REPORTES POR SECCION
  Route::get('listarptporseccion', [
	'as' => 'listareportes/secciones', 
	'uses' => 'ConsultasyreportesController@reportesacademicosporseccion'
]);
 Route::get('listarptinstitucional', [
	'as' => 'listareportes/institucional', 
	'uses' => 'ConsultasyreportesController@reportesacademicosinstitucional'
]);

 Route::get('consultasacademicaadmin',['as'=>'academicaconsultasadmin','uses'=>'ConsultasyreportesController@consultasacademica']);
 Route::get('filtroestudiantes/{estado}/{genero}/{anio}/{grado}/{seccion}/{edadinicio}/{edadfin}',['as'=>'filtroestudiantes','uses'=>'ConsultasyreportesController@filtroestudiantes']);
 Route::get('filtropadresdefamilia/{estado}/{genero}/{apellido}/{parentesco}/{profesion}',['as'=>'filtropadresdefamilia','uses'=>'ConsultasyreportesController@filtropadresdefamilia']);
  Route::get('filtromatric/{anio}/{grado}/{genero}/{ingreso}/{modalidad}',['as'=>'filtromatriculas','uses'=>'ConsultasyreportesController@filtromatriculas']);
   Route::get('filtrocalificaciones/{anio}/{grado}/{genero}/{criterio}/{asignatura}',['as'=>'filtrocalificaciones','uses'=>'ConsultasyreportesController@filtrocalificaciones']);

Route::get('filtroestadisticas/{anio}/{grado}/{genero}/{criterio}',['as'=>'filtroestadisticas','uses'=>'ConsultasyreportesController@filtroestadisticas']);


//PADRES DE FAMILIA
 Route::get('expedientefamiliar_pdf/{id}', [
	'as' => 'expedientefamiliar_pdf', 
	'uses' => 'ConsultasyreportesController@expedientefamiliar_pdf'
]);
 
 Route::post('nominadepadresdefamilia_pdf', [
	'as' => 'nominadepadresdefamilia_pdf', 
	'uses' => 'ConsultasyreportesController@nominadepadresdefamilia_pdf'
]);

 Route::get('nominafamiliaresactivosCE_pdf', [
	'as' => 'nominafamiliaresactivosCE_pdf', 
	'uses' => 'ConsultasyreportesController@nominafamiliaresactivosCE_pdf'
]);


//MATRICULA
 Route::get('comprobantematriculapdf/{idestudiante}/{idmatricula}/{idseccion}', ['as' => 'comprobantematriculapdf', 'uses' => 'ConsultasyreportesController@comprobantematriculapdf']);

//HORARIOS DE CLASES
 
Route::get('horariosdeclases_pdf/{idseccion}/acadrpt', ['as' => 'horariosdeclases_pdf', 'uses' => 'ConsultasyreportesController@horariosdeclases_pdf']);


//ACADEMICA
Route::get('nominadeestudiantespdf', ['as' => 'nominadeestudiantespdf', 'uses' => 'ConsultasyreportesController@nominadeestudiantespdf']);

Route::post('nominadeestudiantes_pdf', [
	'as' => 'nominadeestudiantes_pdf', 
	'uses' => 'ConsultasyreportesController@nominadeestudiantes_pdf'
]);
//ruta para cargar la nomina de estudiantes desde el formulario nomina de estudiantes, mis secciones en modulo docentes
Route::get('/nominadeestudiantes_pdf/{idseccion}/view', [
	'as' => 'docentesnominadeestudiantes_pdf', 
	'uses' => 'ConsultasyreportesController@docentesnominadeestudiantes_pdf'
]);

//RENDIMIENTO ESCOLAR DOCENTES
Route::get('/rendimientoescolar_pdf/{idseccion}/{idmateria}/view', [//no esta en uso esta ruta
	'as' => 'docenterendimientoescolar_pdf', 
	'uses' => 'ConsultasyreportesController@docentesrendimientoescolar_pdf'
]);

Route::get('/cuadrorendimientoescolar_pdf/{idseccion}/{idmateria}/view', [
	'as' => 'cuadrorendimientoescolar_pdf', 
	'uses' => 'pdfcuadrorendimientoController@rendimientoescolar'
]);

//CUADRO FINAL DE EVALUACIONES
Route::get('/cuadrofinaldeevaluaciones_pdf/{idseccion}/view', [
	'as' => 'docentecuadrofinaldeevaluaciones_pdf', 
	'uses' => 'cuadrofinaldeevaluacionesestudiantesController@docentescuadrofinal_pdf'
]); 




Route::get('nominaestudiantesactivosCE_pdf', [
	'as' => 'nominaestudiantesactivosCE_pdf', 
	'uses' => 'ConsultasyreportesController@nominaestudiantesactivosCE_pdf'
]);

Route::post('periodoevaluacionporaniolectivo', ['as' => 'periodoevaluacionporaniolectivo', 'uses' => 'ConsultasyreportesController@periodoevaluacionporaniolectivo']);


Route::post('listadoseccionesporaniolectivo', ['as' => 'listadoseccionesporaniolectivo', 'uses' => 'ConsultasyreportesController@listadoseccionesporaniolectivo']);

Route::get('expedienteestudiante_pdf/{id}', [
	'as' => 'expedienteestudiante_pdf', 
	'uses' => 'ConsultasyreportesController@expedienteestudiante_pdf'
]);

///////////////////////////////////////////////////////////////////////////////


Route::get('listausuariosactivos', ['as' => 'listausuariosactivos','uses' => 'UsuariosController@index']);
Route::get('listaroles', ['as' => 'listaroles','uses' => 'RolesController@index']);
Route::get('verusuario/{id}', ['as' => 'verusuario', 'uses' => 'UsuariosController@verusuario']);
Route::get('editarusuario/{id}', ['as' => 'editarusuario', 'uses' => 'UsuariosController@editarusuario']);
Route::put('actualizarusuario/{id}', ['as' => 'actualizarusuario', 'uses' => 'UsuariosController@actualizarusuario']);
Route::get('eliminarusuario/{id}', ['as' => 'eliminarusuario', 'uses' => 'UsuariosController@eliminarusuario']);
Route::get('editarcuenta', ['as' => 'editarcuenta', 'uses' => 'UsuariosController@editarcuenta']);
Route::put('actualizarcuenta', ['as' => 'actualizarcuenta', 'uses' => 'UsuariosController@actualizarcuenta']);
Route::get('bitacoradelsistema', ['as' => 'bitacora', 'uses' => 'BitacoraController@indexbitacora']);
////

//PDF's
Route::get('listareportesrrhh', ['as' => 'listareportesrrhh', 'uses' => 'ConsultasyreportesController@listareportesrrhh']);
Route::get('nominarhpdf', ['as' => 'nominarhpdf', 'uses' => 'ConsultasyreportesController@nominarhpdf']);

	Route::get('listadoconsultasyreportes', ['as' => 'listadoconsultasyreportes', 'uses' => 'ConsultasyreportesController@listadoconsultasyreportes']);
	Route::get('descargarpdfusuarios', ['as' => 'descargarpdfusuarios', 'uses' => 'PDFController@crearpdfusuarios']);
	Route::get('descargarpdfrrhh', ['as' => 'descargarpdfrrhh', 'uses' => 'PDFController@crearpdfrrhh']);
	//consultas
	Route::get('verlistausuarios', ['as' => 'verlistausuarios', 'uses' => 'PDFController@verlistausuarios']);
	Route::get('verlistarecursohumano', ['as' => 'verlistarecursohumano', 'uses' => 'PDFController@verlistarecursohumano']);

	//Excel
  Route::get('exportBitacora', ['as' => 'exportBitacora', 'uses' =>'ExcelController@exportBitacora']);
	Route::get('exportUsuarios', ['as' => 'exportUsuarios', 'uses' =>'ExcelController@exportUsuarios']);
	Route::get('exportRrhh', ['as' => 'exportRrhh', 'uses' =>'ExcelController@exportRrhh']);


	/////

Route::group(['middleware'=>'ActivoFijoAdmin'], function(){
  Route::post("consultacatalogo","ConsultasyreportesController@consultacatalogo")->name("consultacatalogo");
  Route::post("consultalistabienes","ConsultasyreportesController@consultalistabienes")->name("consultacatalogo");
   Route::post("consultatrasladosactivo","ConsultasyreportesController@consultatrasladosactivo")->name("consultatrasladosactivo");

//subir archivo excel a base de datos
Route::get('subirarchivoactivofijo', ['as' => 'subirarchivoactivofijo', 'uses' => 'ImportsController@subirarchivoactivofijo']);
Route::post('subirarchivoAF','ImportsController@store')->name('store');

//Activo fijo
Route::get('gestionaractivofijo', ['as' => 'activofijo', 'uses' => 'GestionaractivofijoController@index']);
Route::get('crearactivo', ['as' => 'crearactivofijo', 'uses' => 'GestionaractivofijoController@crearactivo']);
Route::get('editaractivo/{id}', ['as' => 'editaractivofijo', 'uses' => 'GestionaractivofijoController@editaractivo']);
Route::get('verdetalleactivo/{id}', ['as' => 'verdetalleactivofijo', 'uses' => 'GestionaractivofijoController@verdetalleactivo']);
Route::get('descargaractivo/{id}', ['as' => 'descargaractivo', 'uses' => 'GestionaractivofijoController@descargaractivo']);
Route::post('correlativoactivo',['as'=>'correlativoactivo','uses'=>'GestionaractivofijoController@correlativo']);
Route::post('agregaractivo', ['as' => 'agregaractivo', 'uses' => 'GestionaractivofijoController@agregaractivo']);
Route::put('actualizaractivo/{id}', ['as' => 'actualizaractivo', 'uses' => 'GestionaractivofijoController@actualizaractivo']);
Route::post('guardardescargo', ['as' => 'guardardescargo', 'uses' => 'GestionaractivofijoController@guardardescargo']);
Route::get('creartrasladoactivo/{id}', ['as' => 'creartrasladoactivo', 'uses' => 'GestionaractivofijoController@creartraslado']);
Route::post('agregartraslado', ['as' => 'agregartraslado', 'uses' => 'GestionaractivofijoController@agregartraslado']);

//Rutas Traslados
Route::get('listatraslado', ['as' => 'listatraslado', 'uses' => 'GestionartrasladoactivofijoController@index']);
Route::get('creartraslado', ['as' => 'creartraslado', 'uses' => 'GestionartrasladoactivofijoController@creartraslado']);
Route::get('verdetalletraslado/{id}', ['as' => 'verdetalletraslado', 'uses' => 'GestionartrasladoactivofijoController@verdetalletraslado']);
Route::get('editartraslado/{id}', ['as' => 'editartraslado', 'uses' => 'GestionartrasladoactivofijoController@editartraslado']);
Route::post('guardartraslado', ['as' => 'guardartraslado', 'uses' => 'GestionartrasladoactivofijoController@guardartraslado']);
Route::put('actualizartraslado/{id}', ['as' => 'actualizartraslado', 'uses' => 'GestionartrasladoactivofijoController@actualizartraslado']);
Route::get('eliminartraslado/{id}', ['as' => 'eliminartraslado', 'uses' => 'GestionartrasladoactivofijoController@eliminartraslado']);
Route::get('crearretorno/{id}', ['as' => 'crearretorno', 'uses' => 'GestionartrasladoactivofijoController@crearretorno']);
Route::post('guardarretorno', ['as' => 'guardarretorno', 'uses' => 'GestionartrasladoactivofijoController@guardarretorno']);

//Rutas Catalogo Activo fijo
Route::get('gestionarcatalogoactivo', ['as' => 'catalogoactivo', 'uses' => 'GestionarcatalogoactivoController@index']);
Route::get('crearcatalogoactivo', ['as' => 'crearcatalogoactivo', 'uses' => 'GestionarcatalogoactivoController@crearcatalogoactivo']);
Route::post('agregarcatalogoactivo', ['as' => 'agregarcatalogoactivo', 'uses' => 'GestionarcatalogoactivoController@agregarcatalogoactivo']);
Route::get('editarcatalogoactivo/{id}', ['as' => 'editarcatalogoactivo', 'uses' => 'GestionarcatalogoactivoController@editarcatalogoactivo']);
Route::put('actualizarcatalogoactivo/{id}', ['as' => 'actualizarcatalogoactivo', 'uses' => 'GestionarcatalogoactivoController@actualizarcatalogoactivo']);
Route::get('eliminarcatalogoactivo/{id}', ['as' => 'eliminarcatalogoactivo', 'uses' => 'GestionarcatalogoactivoController@eliminarcatalogoactivo']);
Route::get('cuentasnivel3',array('as'=>'cuentasnivel3','uses'=>'GestionarcatalogoactivoController@cuentasnivel3'));
});//cierro middleware AFijo


//Route::get('reporteBoleta/{id}/{periodo_id}',['as'=>'reporteBoleta','uses'=>'ResporteController@index']);
Route::post('certificados/{seccion_id}/{formato}',['as'=>'certificados','uses'=>'CertificadosController@generarcertificados']);
Route::get('reporteBoleta/{id}',['as'=>'reporteBoleta','uses'=>'ResporteController@index']);

Route::post("reporteAsistencia/{idestudiante}/{anio}", ['as'=>'reporteAsistencia','uses'=>'ConsultasyreportesController@reporteAsistencia']);//asistencia PDF
Route::post("reporteAsistenciamensual/{id}/{anio}", ['as'=>'reporteAsistenciamensual','uses'=>'ConsultasyreportesController@reporteAsistenciamensual']);//asistencia PDF

//BOLETA INDIVIDUAL MODULOS ONLINE
Route::get('reporteBoletaestudiante/{id}/{anio}',['as'=>'reporteBoletaestudiante','uses'=>'ReporteBoletaonlineController@index']);
//ASISTENCIA INDIVIDUAL ONLINE
Route::get("reporteAsistenciaonline/{id}/{mes}", ['as'=>'reporteAsistenciaonline','uses'=>'ConsultasyreportesController@reporteAsistenciaonline']);


//REPPORTES EXCEL MODULO DOCENTE
/*Route::get("/asistencia/{fecha}/excel", ['as'=>'asistencia_Excel','uses'=>'ExcelController@asistencia_Excel']);//asistencia EXCEL*/
Route::get("/asistencia/{fechadesde}/{fechahasta}/{idseccion}/excel", ['as'=>'asistencia_Excel','uses'=>'ExcelController@asistencia_Excel']);//asistencia EXCEL

Route::get("/calificacionesexcel/{idseccion}/{periodo_id}/{asignatura_id}/excel", ['as'=>'calificaciones_Excel','uses'=>'ExcelController@calificaciones_Excel']);//asistencia EXCEL

//Route::get("/nominaestudiantes/{idseccion}/excel", ['as'=>'nominaestudiantes_Excel','uses'=>'ExcelController@nominaestudiantes_Excel']);//nomina estudiantes EXCEL
Route::get("/formato_nominaestudiantesExcel/{idseccion}/excel", ['as'=>'nominaestudiantes_excelView','uses'=>'ExcelController@nominaestudiantes_excelView']);//nomina estudiantes a una vista para pasar a excel
Route::get("/nominafamiliaresExcel/{idseccion}/excel", ['as'=>'nominafamiliares_excelView','uses'=>'ExcelController@nominafamiliares_excelView']);//nomina estudiantes a una vista para pasar a excel

//FORMULARIOS PDF

}); ///cierro middleware

///////////////ACTIVO FIJO ////////////
Route::get("/admin/activofijo", "ConsultasyreportesController@listareportesactivofijo")->name("reportesactivos_view");
Route::post("/admin/listadoactivofijo_pdf", "ConsultasyreportesController@listadoactivofijo_pdf")->name("listadoactivofijo_pdf");
Route::post("/admin/catalogoactivofijo_pdf", "ConsultasyreportesController@catalogoactivofijo_pdf")->name("catalogoactivofijo_pdf");
Route::post("/admin/trasladosactivofijo_pdf", "ConsultasyreportesController@trasladosactivofijo_pdf")->name("trasladosactivofijo_pdf");


//excel activo fijo
Route::get('/admin/exportListadoactivofijo_excel/{categoria}/{estado}', ['as' => 'exportListadoactivofijo_excel', 'uses' =>'ExcelController@exportListadoactivofijo_excel']);
//Route::get('/admin/exportActivosdescargados_excel', ['as' => 'exportActivosdescargados_excel', 'uses' =>'ExcelController@exportActivosdescargados_excel']);
Route::get('/admin/exportcatalogoactivos_excel/{categoria}/{tipotraslado}', ['as' => 'exportcatalogoactivos_excel', 'uses' =>'ExcelController@exportcatalogoactivos_excel']);
Route::get('/admin/exportrasladosactivos_excel/{categoria}/{estado}', ['as' => 'exportrasladosactivos_excel', 'uses' =>'ExcelController@exportrasladosactivos_excel']);


//ASISTENCIA MENU SUPER ADMINISTRADOR
Route::get("/asistenciaadmin/{id}/tomarasistencia", "ControlAsistenciaController@tomarasistenciaadmin")->name("tomarasistencia_view");
Route::post("/asistenciaadmin/listaestudiantes", "ControlAsistenciaController@tomarasistencia_listaestudiantes")->name("tomarasistencialistaestudiantes_view");
Route::post("guardarasistencias", "ControlAsistenciaController@guardarasistenciaadmin")->name("guardarasistenciaadmin");

Route::get("/view_asistencias", "SeccionesController@view_asistencias")->name("view_asistencias");


//COMETENCIAS CIUDADANAS DOCENTES
Route::get("/missecciones_teacher/", "PersonaldocenteController@missecciones_teacher")->name("missecciones_teacher");
Route::get("/asignarponderacionteacher/{id}/competencia", "PersonaldocenteController@asignarponderacionteacher")->name("asignarponderacionteacher");
Route::post("/seccioncompetenciateacher", "PersonaldocenteController@agregarCompetenciateacher")->name("agregarcompetenciateacher");

Route::get('/seccionescompetenciasteacher/{id}/view/{idperiodo}', 'PersonaldocenteController@viewCompetenciasteacher')->name("ViewCompetenciasteacher");
Route::get('/editCompetenciateacher/{id}/{idseccion}/{periodo}/view', 'PersonaldocenteController@editCompetenciasteacher')->name("editCompetenciateacher");


Route::post("/seccionescompetenciasteacher/add", 'PersonaldocenteController@addSaveCompetenciateacher')->name("addSaveCompetenciateacher");
  
//INGRESO DE NOTAS INDIVIDUAL ADMIN
Route::get('listnotessingleadmin/{id}/{modulo}', 'CalificacionesindividualadminController@index')->name("listnotessingleadmin");
Route::post('addnotessingleadmin', 'CalificacionesindividualadminController@addnotessingleadmin')->name("addnotessingleadmin");
Route::post('savenotessingleadmin', 'CalificacionesindividualadminController@savenotessingleadmin')->name("savenotessingleadmin");
Route::get('seenotessingleadmin', 'CalificacionesindividualadminController@seenotessingleadmin')->name("seenotessingleadmin");
Route::get('editnotessingleadmin/{id}/{idnota}/{modulo}/update', 'CalificacionesindividualadminController@editnotessingleadmin')->name("editnotessingleadmin");
Route::post('updatenotessingleadmin', 'CalificacionesindividualadminController@updatenotessingleadmin')->name("updatenotessingleadmin");

//REGISTRO DE FALTAS ESTUDIANTIL ADMIN
Route::get('faltaestudiante_admin/{idestudiante}','FaltasestudiantesController@addconductaestudiante_admin')->name("addfaltaestudiante_admin");

//REGISTRO DE FALTAS ESTUDIANTIL DOCENTES
Route::get('faltaestudiante_doc/{idestudiante}/{seccion}','FaltasestudiantesController@addfaltaestudiante_docentes')->name("addfaltaestudiante_doc");
Route::post('storefaltaestudiante_docentes','FaltasestudiantesController@storefaltaestudiante_docentes')->name("storefaltaestudiante_docentes");




//INGRESO DE CO0MPETENCIAS CIUDADANAS INDIVIDUAL ADMIN
Route::get('listcompsingleadmin/{id}/{modulo}', 'CalificacionesindividualadminController@periodocompetenciasingleadmin')->name("listcompsingleadmin");
Route::post('addcompetenciassingleadmin', 'CalificacionesindividualadminController@addcompetenciassingleadmin')->name("addcompetenciassingleadmin");
Route::get('seecompsingleadmin/{id}/{periodo}/{modulo}', 'CalificacionesindividualadminController@seecompetenciasingleadmin')->name("seecompsingleadmin");
Route::get('Editcompsingleadmin/{idestudiante}/{periodo}/{modulo}', 'CalificacionesindividualadminController@Editcompetenciasingleadmin')->name("Editcompsingleadmin");
Route::post('addSaveCompetenciasingleadmin', 'CalificacionesindividualadminController@addSaveCompetenciasingleadmin')->name("addSaveCompetenciasingleadmin");
Route::post('UpdateCompetenciasingleadmin', 'CalificacionesindividualadminController@UpdateCompetenciasingleadmin')->name("UpdateCompetenciasingleadmin");
 

//NOTAS MODULO DOCENTES
Route::get("/missecciones/teacher", "PersonaldocenteController@misseccionesteacher")->name("misseccionesteacher");
Route::get("/asignarnotasteacher/{id}/notas", "PersonaldocenteController@asignarnotasteacher")->name("asignarnotasteacher");
Route::post("/seccionnotasteacher", "PersonaldocenteController@agregarNotateacher")->name("agregarnotasteacher");
Route::get('/seccionesnotasteacher/{id}/view', 'PersonaldocenteController@viewNotasteacher');
Route::post("/seccionesnotasteacher/add", 'PersonaldocenteController@addSaveNotateacher')->name("addSaveNotateacher");
Route::get('/seccionesnotasteacher/{id}/edit/{nota_id}', 'PersonaldocenteController@editarNota')->name('editarNotasStudentTeacher');
Route::post("docentesnotas/update", 'PersonaldocenteController@updateNota')->name("updatenotasTeacher");


//COMPETENCIAS CIUDADANAS SUPER ADMIN
Route::get("/asignarponderacion/{id}/competencia", "SeccionesController@asignarponderacioncompetencia")->name("asignarponderacioncompetencia");
Route::post("/seccioncompetenciaadmin", "SeccionesController@agregarCompetenciaadmin")->name("agregarcompetenciaadmin");
Route::get('/seccionescompetenciasadmin/{id}/view', 'SeccionesController@viewCompetenciasadmin')->name("ViewCompetenciasadmin");

Route::post("/seccionescompetenciasadmin/add", 'SeccionesController@addSaveCompetenciaadmin')->name("addSaveCompetenciaadmin");

Route::post("docentescompetencias/update", 'PersonaldocenteController@updateCompetencia')->name("updateCompetencia");

//NOTAS ADMIN ACADEMICA - SUPER ADMIN
// agregando las nuevas rutas.
Route::post("/seccionnotas", "SeccionesController@agregarNota")->name("agregarnotas");
Route::get("/listasecciones/{id}/notas", "SeccionesController@asignarnotas")->name("asignarnotas");
Route::post("/seccionesnotas/add", 'SeccionesController@addSaveNota')->name("addSaveNotaSeccion");

//NOTAS DE RECUPERACION ADMIN
Route::post("refuerzonotas", "RefuerzoacademicoadminController@refuerzonotas")->name("refuerzonotas");
Route::get("periodorefuerzonotas/{id}/{modulo}/view", "RefuerzoacademicoadminController@periodorefuerzonotas")->name("periodorefuerzonotas");

Route::get("addrefuerzo/{estudiante}/{materia}/{seccion}/{periodo}/{modulo}/view", "RefuerzoacademicoadminController@addrefuerzo")->name("addrefuerzo");



// para el crud de notas
Route::get('/seccionesnotas/{id}/view', 'SeccionesController@viewNotas')->name("viewNotas");;
Route::post("seccionesnotas/update", 'SeccionesController@updateNota')->name("updatenotas");
Route::get('/seccionesnotas/{id}/edit/{nota_id}', 'SeccionesController@editarNota')->name('editarNotasStudent');
#Route::post('/reportes/notas/boleta/{id}/{periodo_id}', 'ResporteController@index')->name('reporteBoleta');

//CAMBIAR COMTRASEÑA
Route::get('/passwordchange/{id}/view','UsuariosController@passwordchange')->name('passwordchange');
Route::post('/myaccountchangepassword/edit','UsuariosController@myaccountchangepassword')->name('myaccountchangepassword');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/accesorestringido', function (){
 // echo "acceso restringido";
  return view('admin.accesorestringido');
})->name('restringido');

Route::get('/seccionescompetenciasadmin/{id}/view/{peridoo}', 'SeccionesController@viewCompetenciasadmin')->name("ViewCompetenciasadmin");


Route::resource('cuadroFinal', 'CuadroFinalController');
Route::post('/cuadroFinal/closeexpedient', 'CuadroFinalController@closeexpedient');
Route::post('/cuadroFinal/getEstadistica', 'CuadroFinalController@getEstadistica');
Route::get('/cuadro_final/{id}', 'CuadroFinalController@getCuadroFinalSeccion')->name('ver-cuadro');
Route::post('/cuadroFinal/getGenerateNotes', 'CuadroFinalController@getGenerateNotes')->name('auto-generate');
Route::post('/cuadroFinal/recalcularCuadro', 'CuadroFinalController@recalcularCuadro');
 
Route::post('/cuadroFinal/eliminarCuadro/{id}', 'CuadroFinalController@eliminarCuadro')->name('eliminarCuadro');
Route::get('cerrarSeccion/{id}', 'CuadroFinalController@cerrarSeccion')->name('cerrarSeccion');

//PARVULARIA CONTROLER
Route::get('cerrarSeccionParvularia/{id}', 'ParvulariaController@cerrarSeccionParvularia')->name('cerrarSeccionParvularia');

// BACKUP LARAVEL-GOOGLEDRIVE






//Route::get('admin/cuadro_final/{id}', 'CuadroFinalController@getCuadroFinalSeccion');


//Route::get('agregarseccion', 'SeccionesController@agregarseccion');

// Rutas para los reportes
/*
Route::get("/reportes", function (Codedge\Fpdf\Fpdf\Fpdf $fpdf) {
	$datos = Expedienteestudiante::with('estudiante_seccion')
		->whereHas('estudiante_seccion', function($q){
			$q->where([
				['v_estadomatricula','like','aprobada'],
				['tb_matriculaestudiante.seccion_id','=', "2"]
			]);
		})->get();

	$fpdf->AddPage();
    $fpdf->SetFont('Courier', '', 12);//OBLIGATORIO DEFINIR TIPOGRAFIA
    $fpdf->SetFillColor(0,128,128);//DEFINE EL COLOR DE FONDO DE LAS CELDAS Q LO REQIOERA
    $fpdf->Cell(0, 5, "CENTRO ESCOLAR CATOLICO SAN MARIA DEL CAMINO", 1, 0, "C");
    $fpdf->Ln(10);

	$fpdf->SetFont('Courier', '', 10);
    foreach ($datos as $value) {
    	$fpdf->Cell(90, 5, $value->v_nombres, 1, 0, "R", 0); 
    	$fpdf->Cell(70, 5, $value->v_apellidos, 1, 0, "C"); 
    	$fpdf->Cell(0, 5, $value->f_fnacimiento, 1, 1, "C"); 
    }

	$response = response($fpdf->Output());
	$response->header('Content-Type', 'application/pdf');
	return $response;
});
*/

/*Route::get('test', function() {
    Storage::disk('google')->put('test.txt', 'Hello World');
});*/
Route::get('respaldodb', 'DBController@respaldo')->name('respaldo');
Route::get('restaurardb/{archivo}', 'DBController@restaurardb')->name('restaurardb');
Route::get('acercade', 'AcercadeController@index')->name('acercade');
Route::get('ayuda', 'HelpController@index')->name('ayuda');
Route::get('ayuda_estudiante', 'HelpController@ayuda_estudiante')->name('ayuda_estudiante');
Route::get('ayuda_docente', 'HelpController@ayuda_docente')->name('ayuda_docente');
Route::get('ayuda_bonoescolar', 'HelpController@ayuda_bonoescolar')->name('ayuda_bonoescolar');
Route::get('ayuda_adminacademica', 'HelpController@ayuda_adminacademica')->name('ayuda_adminacademica');
Route::get('ayuda_adminactivofijo', 'HelpController@ayuda_adminactivofijo')->name('ayuda_adminactivofijo');
Route::get('ayuda_padredefamilia', 'HelpController@ayuda_padredefamilia')->name('ayuda_padredefamilia');
Route::get('ayuda_adminrrhh', 'HelpController@ayuda_adminrrhh')->name('ayuda_adminrrhh');
Route::resource('reset', 'ResetPasswordController');




