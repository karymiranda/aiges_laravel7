extends('admin.menuprincipal')
@section('tittle','Estudiantes/Expediente')
@section('content')

<div class="box box-primary">
            <div class="box-header with-border">
              <h2 class="box-title"><strong>MIS SECCIONES / NOMINA DE ESTUDIANTES</strong></h2>


             </div> 

             <div class="box-body" align="center">
              {!! Form::open(['route'=>'missecciones', 'method'=>'POST','class'=>'form-horizontal']) !!}
 
              </div><!-- /.box-body -->         
            <div class="box-footer" align="right" >           
           </div>
 {!! Form::close() !!}
            </div>

@endsection
