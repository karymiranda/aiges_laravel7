@extends('admin.menuprincipal')
@section('tittle', 'Familiares / Matricula Online ')
@section('content')

<div class="box box-danger box-solid">
            <div class="box-header with-border">
              <h2 class="box-title"> <i class="icon fa fa-warning"></i> <Strong>AVISO</Strong></h2>
            </div>         
            
              <div class="box-body">

              {!! Form::open(['route'=>'listaexpedientes', 'method'=>'GET', 'class'=>'form-horizontal']) !!}
              
             <div class="form-group">
              <div class="col-sm-12">
                 <h4>Actualmente no se encuentra disponible ésta opción. Para mayor información verifique la calendarización de inscripciones en linea haciendo<a href="http://wordpressprueba1.test/" target="__blank"> click aquí</a></h4>
             </div>                                       
            </div>
           </div>       
         

          {!! Form::close() !!}  
          <!-- /.box-footer -->
          </div>
@endsection
