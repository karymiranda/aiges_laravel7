@extends('admin.menuprincipal')
@section('tittle', 'Configuraciones/Administración Académica/Grados')
@section('content')

<div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"><Strong>REGISTRAR GRADO</Strong></h3>
            </div>

             @if(count($errors) > 0)
      <div class="alert alert-danger" role="alert">
        <ul>
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
            <!-- /.box-header -->
            <!-- form start -->
           
              <div class="box-body">

                  {!! Form::open(['route'=>'guardargrado', 'method'=>'POST', 'class'=>'form-horizontal']) !!}


                 <div class="form-group">                                           
                {!! Form::label('grado', 'Grado',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-4">
                                                {!! Form::text('grado',null,['class'=>'form-control pull-right','placeholder'=>'Descripción','required']) !!}
                                                </div>
                </div>
               
                <div class="form-group">                                           
          {!! Form::label('nivel', 'Nivel acádemico',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-4">
         {!! Form::radio('nivel_educativo','Educación inicial',false, ['class'=>'flat-red'])!!}
         {!! Form::label('lbinicial', 'Educación inicial',['class'=>'col- control-label']) !!}<br> 
         {!! Form::radio('nivel_educativo','Educación parvularia',false, ['class'=>'flat-red'])!!}
         {!! Form::label('lbparvularia', 'Educación parvularia',['class'=>'col- control-label']) !!}
         <br>
         {!! Form::radio('nivel_educativo','Educación básica primer ciclo',true, ['class'=>'flat-red'])!!}
         {!! Form::label('lbbasica', 'Educación básica primer ciclo',['class'=>'control-label']) !!}<br>
         {!! Form::radio('nivel_educativo','Educación básica segundo ciclo',true, ['class'=>'flat-red'])!!}
         {!! Form::label('lbbasica', 'Educación básica segundo ciclo',['class'=>'control-label']) !!}
         <br>
         {!! Form::radio('nivel_educativo','Educación básica tercer ciclo',true, ['class'=>'flat-red'])!!}
         {!! Form::label('lbbasica', 'Educación básica tercer ciclo',['class'=>'control-label']) !!}
         <br>
            </div> 
            </div>
                 
                                           
          </div>

         
                
              <div class="box-footer" align="right">                
                 {!! Form::submit('Guardar',['class'=>'btn btn-primary ']) !!}
                  <a href="{{route('listagrados')}}" class="btn btn-default">Cancelar</a>
              </div>

                {!! Form::close() !!}
              <!-- /.box-footer -->
           
          </div>





@endsection
