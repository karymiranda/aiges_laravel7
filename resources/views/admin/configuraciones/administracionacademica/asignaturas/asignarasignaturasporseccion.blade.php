@extends('admin.menuprincipal')
@section('tittle', 'Configuraciones/Administración Académica/Asignaturas')
@section('content')

<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><Strong>ASIGNATURAS A IMPARTIR POR SECCION </Strong></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
      @if(count($errors) > 0)
      <div class="alert alert-danger" role="alert">
        <ul>
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
              <div class="box-body">
                  {!! Form::open(['route'=>'guardarasignaturaporseccion', 'method'=>'POST', 'class'=>'form-horizontal']) !!}


                 <div class="form-group">                                           
                                                {!! Form::label('Asignatura', 'Asignatura',['class'=>'col-sm-2 control-label']) !!}
                                                <div class="col-sm-4">
                                                {!! Form::select('asignatura_id',$asignatura,null,['class'=>'form-control','required'])!!}
                                                </div>
               
                    {!! Form::label('secciones', 'Será impartida en',['class'=>'col-sm-2 control-label']) !!}                  
                <div class="col-sm-4">
                  {!! Form::select('secciones[]',$secciones,1,['class'=>'form-control','multiple'=>'true','size'=>'10'])!!}
                </div>                 
               </div>
                              
                                           
          </div>        
         <div class="box-footer" align="right">                
        {!! Form::submit('Guardar',['class'=>'btn btn-primary ']) !!}
         <a href="{{route('listaasignaturas')}}" class="btn btn-default">Cancelar</a>
        </div>

        {!! Form::close() !!}
              <!-- /.box-footer -->
           
          </div>





@endsection
