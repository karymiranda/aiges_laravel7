@extends('admin.menuprincipal')
@section('tittle', 'Configuraciones/Administración académica/Asignaturas')
@section('content')

<div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"><Strong>ACTUALIZAR ASIGNATURA</Strong></h3>
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
                  {!! Form::open(['route'=>['actualizarasignatura',$asignatura->id], 'method'=>'PUT', 'class'=>'form-horizontal']) !!}


                 <div class="form-group">                                           
                                                {!! Form::label('Asignatura', 'Asignatura',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                                {!! Form::text('asignatura',$asignatura->asignatura,['class'=>'form-control pull-right','placeholder'=>'Nombre de asignatura','required']) !!}
                                                </div>
                </div>
                <div class="form-group">                                           
                                                {!! Form::label('Código', 'Código',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                                {!! Form::text('descripcion',$asignatura->descripcion,['class'=>'form-control pull-right','placeholder'=>'Código asignatura para plantilla siges [requerido]','required']) !!}
                                                </div>
                </div>


              
    <div class="form-group">                                           
          {!! Form::label('', '',['class'=>'col-sm-4 control-label']) !!}
    <div class="col-sm-5">
    <div class="checkbox">
  <label><input type="checkbox" name="tercerciclo"<?php if($asignatura->tercerciclo==1){ ?> checked="checked" value="1" <?php } ?>>Es asignatura de tercer ciclo</label>
    </div> 
    </div> 
    </div> 


        <div class="form-group">                                         
  {!! Form::label('', '',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
 <div class="checkbox">
  <label><input type="checkbox" name="is_cuadro"  class="check"<?php if($asignatura->is_cuadro==1){ ?> checked="checked" value="1" <?php } ?>>Es asignatura de cuadro final</label>
    </div> 

    
          </div> 
          </div>

 <div   id="datoscuadrofinal">     
              <div class="form-group">                                           
                     {!! Form::label('', 'Nombre corto',['class'=>'col-sm-4 control-label']) !!}
                    <div class="col-sm-5">
                      {!! Form::text('name_short',$asignatura->name_short,['class'=>'form-control pull-right','placeholder'=>'Nombre corto con el que aparecerá ésta asignatura en el cuadro final','id'=>'name_short']) !!}
              </div>
  </div>

            
            <div class="form-group">                                           
                     {!! Form::label('', 'Orden',['class'=>'col-sm-4 control-label']) !!}
                    <div class="col-sm-5">
                      {!! Form::text('orden',$asignatura->orden,['class'=>'form-control pull-right','placeholder'=>'Orden en que aparecerá la asignatura en el cuadro final','id'=>'orden']) !!}
                   </div>
                </div>           
                 
                                           
          </div>        
         <div class="box-footer" align="right">                
        {!! Form::submit('Actualizar',['class'=>'btn btn-primary ']) !!}
         <a href="{{route('listaasignaturas')}}" class="btn btn-default">Cancelar</a>
        </div>

        {!! Form::close() !!}
              <!-- /.box-footer -->
           
          </div>





@endsection
