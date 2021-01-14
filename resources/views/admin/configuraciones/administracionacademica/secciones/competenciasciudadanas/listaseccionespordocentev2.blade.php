@extends('admin.menuprincipal')
@section('tittle','Configuraciones/Secciones/Competencias Ciudadanas')
@section('content')

<div class="box box-primary box-solid">
            <div class="box-header">
              <h2 class="box-title"><strong>COMPETENCIAS CIUDADANAS/ MIS SECCIONES</strong></h2>
             </div> 

             <div class="box-body" align="center">
              {!! Form::open(['route'=>'missecciones', 'method'=>'POST','class'=>'form-horizontal']) !!}
 
  <div class="row">
 <div class="col-md-8">
              <div class="box-body table-responsive">
             <table class="table table-bordered table-striped"  data-form="deleteForm" style="width: 20%">               
                <tbody align="center">

                @if($secciones->isEmpty())

               <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-warning"></i> No tiene secciones asignadas.</h4>
               
                </div>

               @else
                 @foreach($secciones as $secciones)                      
                <tr> 
                <td> <a href="{{ route( 'asignarponderacionteacher', ['id' => $secciones->id]) }}" title="Ingresar calificaciones" class="btn btn-block btn-primary btn-lg"><i class="fa fa-group"> {{$secciones->grado}}</i></a></td>
                 </tr>                          
                @endforeach              
                @endif                            
              </tbody>
            </table>
            </div>
</div>
<div class="col-md-4">
<div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-warning"></i> Indicaciones</h4>
                Unicamente muestra las secciones  en las que imparte una o más asignaturas según carga académica (horario de clases).
</div>
</div>
              </div>
              </div>
            

            <!-- /.box-body -->

            <div class="box-footer" align="right" >           
           </div>
 {!! Form::close() !!}
            </div>

@endsection
