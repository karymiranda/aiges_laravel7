@extends('admin.menuprincipal')
@section('tittle', 'Estudiantes Online - Horario de Clases')
@section('content')

<div class="box box-warning box-solid">
            <div class="box-header with-border">
              <h2 class="box-title"> <i class="icon fa fa-warning"></i> <Strong>AVISO</Strong></h2>
            </div>         
            
              <div class="box-body">

              {!! Form::open(['route'=>'listaexpedientes', 'method'=>'GET', 'class'=>'form-horizontal']) !!}
              
             <div class="form-group">
              <div class="col-sm-12">
                 <h4>No hay información para mostrar.</h4>
             </div>                                       
            </div>
           </div>       
         

          {!! Form::close() !!}  
          <!-- /.box-footer -->
          </div>
@endsection
