@extends('admin.menuprincipal')
@section('tittle', 'Estudiantes / Matricula Online')
@section('content')

<div class="box box-danger box-solid">
            <div class="box-header with-border">
              <h1 class="box-title"> <i class="icon fa fa-warning"></i> <Strong>AVISO</Strong></h1>
            </div>         
            
              <div class="box-body">

              {!! Form::open(['route'=>'listaexpedientes', 'method'=>'GET', 'class'=>'form-horizontal']) !!}
              
             <div class="form-group">
              <div class="col-sm-12">
             <h4> Usted ya cuenta con un proceso de matrícula activo. Para mayor información puede contactarnos al teléfono 2393-5482 o visitar  las instalaciones del Centro Escolar.
              </h4> 
             </div>                                       
            </div>
           </div>       
          {!! Form::close() !!}  
          <!-- /.box-footer -->
          </div>
@endsection
